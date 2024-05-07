<?php

namespace Modules\Products\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Supplier;
use Modules\Products\app\Models\Attribute;
use Modules\Products\app\Models\CategoryAttribute;
use Modules\Products\app\Models\Product;
use Illuminate\Support\Facades\DB;
use Modules\Products\app\Models\ProductAttribute;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use \Modules\Products\app\Models\Category;
use \Modules\Products\app\Models\ProductGroup;
use \Modules\Products\app\Models\Unit;

class ProductsController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['category', 'category'],
            ['product_group', 'product_group'],
            ['unit', 'unit'],
            ['sku', 'sku'],
            ['name', 'name'],
            ['attributes', 'attributes', 'text-center'],
            ['unit_price', 'unit_price'],
            ['tax', 'tax'],
            ['vat', 'vat'],
            ['sales_price', 'sales_price'],
            ['status', 'status'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'product-edit' => auth()->user()->hasPermissionTo('product-edit'),
            'product-delete' => auth()->user()->hasPermissionTo('product-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($product)
                    ->addIndexColumn()
                    ->addColumn('category', function ($product) {
                        return isset ($product->category->name) ? $product->category->name : '';
                    })
                    ->filterColumn('category', function ($query, $keyword) {
                        return $query->whereHas('category', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->orderColumn('category', function ($query, $order) {
                        return pleaseSortMe($query, $order, Category::select('name')
                            ->whereColumn('categories.id', 'products.category_id'));
                    })
                    ->addColumn('product_group', function ($product) {
                        return isset ($product->productGroup->name) ? $product->productGroup->name : '';
                    })
                    ->filterColumn('product_group', function ($query, $keyword) {
                        return $query->whereHas('productGroup', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->orderColumn('product_group', function ($query, $order) {
                        return pleaseSortMe($query, $order, ProductGroup::select('product_groups.name')
                            ->whereColumn('product_groups.id', 'products.product_group_id'));
                    })
                    ->addColumn('unit', function ($product) {
                        return isset ($product->productUnit->unit_name) ? $product->productUnit->unit_name : '';
                    })
                    ->filterColumn('unit', function ($query, $keyword) {
                        return $query->whereHas('productUnit', function ($query) use ($keyword) {
                            $query->where('unit_name', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->orderColumn('unit', function ($query, $order) {
                        return pleaseSortMe($query, $order, Unit::select('units.unit_name')
                            ->whereColumn('units.id', 'products.product_group_id'));
                    })
                    ->addColumn('attributes', function ($product) {
                        return getProductAttributesFaster($product);
                    })
                    ->filterColumn('attributes', function ($query, $keyword) {
                        return $query->whereHas('attributes.attributeOption', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%');
                        })
                            ->orWhereHas('attributes.attributeOption.attribute', function ($query) use ($keyword) {
                                $query->where('name', 'LIKE', '%' . $keyword . '%');
                            });
                    })
                    ->orderColumn('attributes', function ($query, $order) {
                        $query = pleaseSortMe(
                            $query,
                            $order,
                            ProductAttribute::select('attributes.code')
                                ->join('attribute_options', 'attribute_options.id', '=', 'product_attributes.attribute_option_id')
                                ->join('attributes', 'attributes.id', '=', 'attribute_options.attribute_id')
                                ->whereColumn('product_attributes.product_id', 'products.id')
                                ->take(1)
                        );

                        $query = pleaseSortMe(
                            $query,
                            $order,
                            ProductAttribute::select('attribute_options.name')
                                ->join('attribute_options', 'attribute_options.id', '=', 'product_attributes.attribute_option_id')
                                ->whereColumn('product_attributes.product_id', 'products.id')
                                ->take(1)
                        );

                        return $query;
                    })
                    ->editColumn('unit_price', function ($product) {
                        return systemMoneyFormat($product->unit_price);
                    })->editColumn('sales_price', function ($product) {
                        return systemMoneyFormat($product->sales_price);
                    })
                    ->editColumn('status', function ($product) {
                        return ucfirst($product->status);
                    })
                    ->addColumn('actions', function ($product) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $product->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['product-edit']) {
                            $actions .= '<a href="' . route('products.edit', $product->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['product-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('products.destroy', $product->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions', 'attributes'])
                    ->make(true);
            }

            return view('products::products.index', [
                'title' => 'Products',
                'headerColumns' => $this->headerColumns()
            ]);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prefix = 'P-' . date('y', strtotime(date('Y-m-d'))) . '-TRU-';
        $sku = uniqueCode(14, $prefix, 'products', 'id');
        $data = [
            'title' => "Create Product",
            "categories" => Category::pluck('name', 'id')->all(),
            "productGroups" => ProductGroup::pluck('name', 'id')->all(),
            "units" => Unit::pluck('unit_name', 'id')->all(),
            'suppliers' => Supplier::where('status', 'active')->select('name', 'id')->get(),
            'attributes' => Attribute::with('options')->get(),
            'sku' => $sku,
        ];

        return view('products::products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required',
            'product_group_id' => 'required',
            'tax' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'vat' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'unit_price' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'sales_price' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'supplier' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->fill($request->all());
            $product->save();

            $suppliers = $request->supplier;
            $product->suppliers()->sync($suppliers);

            if (isset($request->productAttributes[0])) {
                foreach ($request->productAttributes as $key => $attribute_id) {
                    $serial_no = CategoryAttribute::where([
                        'category_id' => $request->category_id,
                        'attribute_id' => $attribute_id
                    ])->sum('serial');
                    if (isset($request->attribute_option_id[$attribute_id]) && $request->attribute_option_id[$attribute_id] != 0) {
                        ProductAttribute::create([
                            'product_id' => $product->id,
                            'attribute_option_id' => $request->attribute_option_id[$attribute_id],
                            'serial' => $serial_no,
                        ]);
                    }
                }
            }

            $productAttributes = getProductAttributesFaster($product);

            $products = Product::with([
                'attributes.attributeOption.attribute'
            ])
                ->where([
                    ['id', '!=', $product->id],
                    ['name', $product->name],
                ])
                ->whereHas('attributes', function ($query) use ($product) {
                    $query->whereIn('attribute_option_id', $product->attributes->pluck('attribute_option_id')->toArray());
                })
                ->get();

            $count = 0;
            if (isset($products[0])) {
                foreach ($products as $key => $this_product) {
                    if ($productAttributes == getProductAttributesFaster($this_product)) {
                        return $this->backWithError($this_product->name . ' ' . getProductAttributesFaster($this_product)
                            . ' already exists!');
                    }
                }
            }

            DB::commit();
            return $this->redirectBackWithSuccess('Product created successfully', 'products.index');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $title = "Products Show";

        $product = Product::findOrFail($id);
        $suppliers = Supplier::where('status', 'active')->whereIn('id', $product->suppliers->pluck('pivot.supplier_id')->toArray())->select('name', 'id')->get();


        return view('products::products.show', compact('product', 'title', 'suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Products Edit";

        $product = Product::findOrFail($id);

        try {

            $categoryAttributes = CategoryAttribute::where('category_id', $product->category_id)->get();
            $attributes = [];
            $attributeOptions = [];
            if (isset($categoryAttributes[0])) {
                foreach ($categoryAttributes as $key => $categoryAttribute) {
                    array_push($attributes, $categoryAttribute->attribute_id);
                    $attributeOptions = array_merge($attributeOptions, (is_array(json_decode($categoryAttribute->options, true)) ? json_decode($categoryAttribute->options, true) : []));
                }
            }

            $data = [
                'title' => "Edit Product",
                "categories" => Category::pluck('name', 'id')->all(),
                "productGroups" => ProductGroup::pluck('name', 'id')->all(),
                "units" => Unit::pluck('unit_name', 'id')->all(),
                'suppliers' => Supplier::where('status', 'active')->select('name', 'id')->get(),
                'attributes' => Attribute::with('options')->get(),
                'product' => $product,
                'productAttributes' => $product->attributes->pluck('attributeOption.attribute_id')->toArray(),
                'existedSuppliers' => $product->suppliers->pluck('pivot.supplier_id')->toArray(),
                'categoryAttributes' => $attributes,
                'categoryAttributeOptions' => $attributeOptions,
            ];

            return view('products::products.edit', $data);
        } catch (\Exception $e) {
            return $this->backWithError($e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required',
            'product_group_id' => 'required',
            'tax' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'vat' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'unit_price' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'sales_price' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
            'supplier' => ['required'],
        ]);


        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->fill($request->all());
            $product->save();

            $suppliers = $request->supplier;
            $product->suppliers()->sync($suppliers);

            ProductAttribute::where('product_id', $product->id)->delete();
            if (isset($request->productAttributes[0])) {
                foreach ($request->productAttributes as $key => $attribute_id) {
                    $serial_no = CategoryAttribute::where([
                        'category_id' => $request->category_id,
                        'attribute_id' => $attribute_id
                    ])->sum('serial');
                    if (isset($request->attribute_option_id[$attribute_id]) && $request->attribute_option_id[$attribute_id] != 0) {
                        ProductAttribute::create([
                            'product_id' => $product->id,
                            'attribute_option_id' => $request->attribute_option_id[$attribute_id],
                            'serial' => $serial_no,
                        ]);
                    }
                }
            }

            $products = Product::with([
                'attributes.attributeOption.attribute'
            ])
                ->where([
                    ['id', '!=', $product->id],
                    ['name', $product->name],
                ])
                ->whereHas('attributes', function ($query) use ($product) {
                    $query->whereIn('attribute_option_id', $product->attributes->pluck('attribute_option_id')->toArray());
                })
                ->get();
            $count = 0;
            if (isset($products[0])) {
                foreach ($products as $key => $this_product) {
                    if (getProductAttributesFaster($product) == getProductAttributesFaster($this_product)) {
                        return $this->backWithError($this_product->name . ' ' . getProductAttributesFaster($this_product) . ' already exists!');
                    }
                }
            }

            DB::commit();
            return $this->redirectBackWithSuccess('Product has been updated successfully', 'products.index');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $product = product::findOrFail($id);

            $product->suppliers()->sync([]);
            ProductAttribute::where('product_id', $product->id)->delete();
            $product->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'products has been deleted successfully',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
