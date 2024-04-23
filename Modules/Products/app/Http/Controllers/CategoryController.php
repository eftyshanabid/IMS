<?php

namespace Modules\Products\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Modules\IMS\app\Models\Departments;
use Modules\Products\app\Models\Attribute;
use Modules\Products\app\Models\AttributeOption;
use Modules\Products\app\Models\Category;
use Modules\Products\app\Models\CategoryAttribute;
use Modules\Products\app\Models\CategoryDepartment;
use Modules\Products\app\Models\ProductAttribute;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function headerColumns($value = '')
    {
        return array(
            ['SL', 'SL'],
            ['code', 'code'],
            ['name', 'name'],
            ['department', 'department'],
            ['attributes', 'attributes'],
            ['description', 'description', 'text-center'],
            ['actions', 'actions', 'text-center']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = 'Category';

            $options = [
                'category-edit' => auth()->user()->hasPermissionTo('category-edit'),
                'category-delete' => auth()->user()->hasPermissionTo('category-delete'),
            ];

            $categories = Category::doesntHave('category')
                ->with(['category', 'departmentsList', 'departmentsList.department'])
                ->when(!datatableOrdering(), function ($query) {
                    return $query->orderby('code', 'desc');
                });

            if (request()->ajax()) {
                $attributeOptions = AttributeOption::all();

                return Datatables::of($categories)
                    ->addIndexColumn()
                    ->addColumn('department', function ($category) {
                        $department = '';
                        foreach ($category->departmentsList as $values) {
                            $department .= '<a href="javascript:void(0)"><span class="m-1 badge bg-primary btn-sm">' .
                                (isset($values->department->name) ? $values->department->name : '') . '</span></a>';
                        }
                        return $department;
                    })
                    ->filterColumn('department', function ($query, $keyword) {
                        return $query->whereHas('departmentsList.department', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->orderColumn('department', function ($query, $order) {
                        return pleaseSortMe($query, $order, CategoryDepartment::select('departments.name')
                            ->join('departments', 'departments.id', '=', 'categories_departments.department_id')
                            ->whereColumn('categories_departments.category_id', 'categories.id')
                            ->take(1)
                        );
                    })
                    ->addColumn('attributes', function ($subCategory) use($attributeOptions){
                        $attr ='';
                        $attributes = isset($subCategory->attributes[0]) ? collect($subCategory->attributes)->sortBy('serial')->values()->all() : [];
                        if (isset($attributes[0])) {
                            $attr .='<ul>';
                            foreach($attributes as $key => $categoryAttribute){
                                $attr .='<li><strong>'.$categoryAttribute->attribute->name.':</strong> '.$attributeOptions->where('attribute_id', $categoryAttribute->attribute_id)->whereIn('id', (!empty($categoryAttribute->options) ? json_decode($categoryAttribute->options, true) : []))->pluck('name')->implode(', ').'</li>';
                            }
                            $attr .='</ul>';
                        }
                        return $attr;
                    })
                    ->filterColumn('attributes', function ($query, $keyword) {
                        return $query->whereHas('attributes.attribute', function ($query) use($keyword) {
                            $query->where('name', 'LIKE', '%'.$keyword.'%');
                        })->orWhereHas('attributes.attribute.options', function ($query) use($keyword) {
                            $query->where('name', 'LIKE', '%'.$keyword.'%');
                        });
                    })
                    ->orderColumn('attributes', function ($query, $order) {
                        return pleaseSortMe($query, $order, CategoryAttribute::select('attributes.code')
                            ->join('attributes', 'attributes.id', '=', 'categories_attributes.attribute_id')
                            ->whereColumn('categories_attributes.category_id', 'categories.id')
                            ->take(1)
                        );
                    })
                    ->addColumn('actions', function ($category) use ($options) {
                        $actions = '';

                        $actions .='<a href="'.url('admin/categories/'.$category->id.'/create-attributes').'" class="btn btn-success btn-sm m-1"><i class="mdi mdi-sitemap"></i></a>';

                        if ($options['category-edit']) {
                            $url = route('categories.edit', $category->id);
                            $actions .= '<a class="btn btn-warning btn-sm m-1" href="' . $url . '"><i class="mdi mdi-pencil-box"></i></a>';
                        }
                        if ($options['category-delete']) {
                            $actions .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger m-1" data-src="' .
                                route('categories.destroy', $category->id) . '" onclick="deleteFromCRUD($(this))"><i class="mdi mdi-trash-can"></i></a>';
                        }
                        return $actions;
                    })
                    ->rawColumns(['attributes','department', 'actions'])
                    ->make(true);
            }

            return view('products::category.index', [
                'title' => $title,
                'headerColumns' => $this->headerColumns(),
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
        if (request()->has('update-category-departments')) {
            $categories = Category::doesntHave('category')->doesntHave('departmentsList')->get();
            $departments = Departments::all();
            if ($categories->count() > 0) {
                foreach ($categories as $category) {
                    $category->department()->sync($departments->pluck('hr_department_id')->toArray());
                }
            }
        }

        $title = 'Category Add';

        $code = uniqueCode(7, 'CT-', 'categories', 'id');
        $departments = Departments::all();

        return view('products::category.create', compact('title', 'departments', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => ['required', 'string', 'max:255', 'unique:categories'],
            'name' => ['required', 'string', 'max:255'],
            'parent' => ['nullable', 'integer'],
            'department_id' => ['required'],
        ]);

        try {
            $inputs = $request->all();
            unset($inputs['_token']);
            unset($inputs['_method']);

            $category = Category::create($inputs);

            $departments = $request->department_id;
            $category->department()->sync($departments);

            return $this->urlRedirectBack('Category created successfully', 'admin/categories', 'success');

        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
        return back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('products::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = Category::with([
                'departmentsList'
            ])->findOrFail($id);
            $category->parent_id = !$category->category ? null : $category->category;

            $data = [
                'title' => 'Category Edit',
                'category' => $category,
                'departmentsId' => $category->departmentsList->pluck('department_id')->toArray(),
                'departments' => Departments::all(),
            ];

            return view('products::category.edit', $data);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'code' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer'],
        ]);
        try {
            $inputs = $request->all();
            unset($inputs['_token']);
            unset($inputs['_method']);
            $category->update($inputs);

            $departments = $request->department_id;
            $category->department()->sync($departments);

            return $this->urlRedirectBack('Category updated successfully', 'admin/categories', 'success');

        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            if (isset($category->subCategory) && $category->subCategory->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category can not be deleted.'
                ]);
            }

            $category->subCategory->each->delete();
            CategoryDepartment::where('category_id', $category->id)->delete();
            $category->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Departments has been deleted successfully',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAttributes($category_id)
    {
        $category = Category::findOrFail($category_id);
        $data = [
            'title' => "Attributes for #".$category->name,
            'subcategory' => $category,
            'attributes' => Attribute::has('options')->with(['options'])->get(),
            'categoryAttributes' => CategoryAttribute::where('category_id', $category->id)->pluck('attribute_id')->toArray(),
        ];

        return view('products::category.attributes', $data);
    }

    public function updateAttributes(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $category->fill($request->all())->save();

            if(isset($request->productAttributes[0])){
                foreach ($request->productAttributes as $key => $attribute_id) {
                    CategoryAttribute::updateOrCreate([
                        'category_id' => $category->id,
                        'attribute_id' => $attribute_id
                    ], [
                        'serial' => $request->attributeSerials[$attribute_id],
                        'options' => json_encode($request->attributeOptions[$attribute_id]),
                    ]);
                }
            }

            CategoryAttribute::where('category_id', $category->id)
                ->whereNotIn('attribute_id', $request->productAttributes)
                ->delete();

            $productAttributes = ProductAttribute::whereHas('attributeOption.attribute.categories', function($query) use($category){
                return $query->where('category_id', $category->id);
            })->get();

            if(isset($productAttributes[0])){
                foreach($productAttributes as $key => $productAttribute){
                    $serial = CategoryAttribute::where('category_id', $category->id)
                        ->whereHas('attribute.options', function($query) use($productAttribute){
                            return $query->where('id', $productAttribute->attribute_option_id);
                        })
                        ->first();
                    $productAttribute->serial_no = (isset($serial->serial) ? $serial->serial : 0);
                    $productAttribute->save();
                }
            }

            DB::commit();
            return $this->backWithSuccess('Sub Category Attributes have benn updated. ');
        }catch (\Throwable $th){
            DB::rollback();
            return $this->backWithError($th->getMessage());
        }
    }
}
