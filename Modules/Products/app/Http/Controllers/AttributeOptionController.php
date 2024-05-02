<?php

namespace Modules\Products\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Products\app\Models\Attribute;
use Modules\Products\app\Models\AttributeOption;
use Yajra\DataTables\Facades\DataTables;

class AttributeOptionController extends Controller
{
    public function headerColumns($value = '')
    {
        return array(
            ['SL', 'SL'],
            ['attribute_code', 'attribute_code'],
            ['attribute_name', 'attribute_name'],
            ['name', 'name', 'text-left'],
            ['description', 'description', 'text-left'],
            ['actions', 'actions', 'text-center']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $attributeOptions = AttributeOption::with('attribute')->where('attribute_id', request()->get('attribute_id'))
                ->when(!datatableOrdering(), function ($query) {
                    return $query->orderby('id', 'desc');
                });

            $options = [
                'attribute-option-edit' => auth()->user()->hasPermissionTo('attribute-option-edit'),
                'attribute-option-delete' => auth()->user()->hasPermissionTo('attribute-option-delete')
            ];

            if (request()->ajax()) {

                return Datatables::of($attributeOptions)
                    ->addIndexColumn()
                    ->addColumn('attribute_code', function ($option) {
                        return isset ($option->attribute->code) ? $option->attribute->code : '';
                    })
                    ->filterColumn('attribute_code', function ($query, $keyword) {
                        return $query->whereHas('attribute', function ($query) use ($keyword) {
                            $query->where('code', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->addColumn('attribute_name', function ($option) {
                        return isset ($option->attribute->name) ? $option->attribute->name : '';
                    })
                    ->filterColumn('attribute_name', function ($query, $keyword) {
                        return $query->whereHas('attribute', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->addColumn('actions', function ($option) use ($options) {
                        $actions = '';
                        if ($options['attribute-option-edit']) {
                            $actions .= '<a class="btn btn-warning btn-xs m-1" href="' . url('admin/attribute-options/' . $option->id . '/edit') . '"><i class="mdi mdi-pencil-box"></i></a>';
                        }
                        if ($options['attribute-option-delete']) {
                            $actions .= '<a href="javascript:void(0)" class="btn btn-xs btn-danger m-1" data-src="' .
                                route('attribute-options.destroy', $option->id) . '" onclick="deleteFromCRUD($(this))"><i class="mdi mdi-trash-can"></i></a>';
                        }
                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            $data = [
                'title' => "Attribute Options",
                'attributes' => Attribute::all(),
                'headerColumns' => $this->headerColumns()
            ];
            return view('products::attributes.options.index', $data);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => "New Attribute Option",
            'attributes' => Attribute::all(),
        ];
        return view('products::attributes.options.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'attribute_id' => 'required',
            'name' => ['required', 'string', 'max:255'],
        ]);
        try {
            $search = AttributeOption::where('attribute_id', $request->attribute_id)->where('name', $request->name)->first();
            if (isset($search->id)) {
                return $this->backWithError("Attribute Option #" . $request->name . ' already exists for Attribute #' . Attribute::find($request->attribute_id)->name);
            }

            AttributeOption::create($request->all());
            return $this->backWithSuccess('Attribute Option created successfully');
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
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
        $data = [
            'title' => "Edit Attribute Option",
            'attributes' => Attribute::all(),
            'attributeOption' => AttributeOption::find($id),
        ];
        return view('products::attributes.options.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttributeOption $attributeOption)
    {
        $this->validate($request, [
            'attribute_id' => 'required',
            'name' => ['required', 'string', 'max:255'],
        ]);
        try {
            $search = AttributeOption::where('attribute_id', $request->attribute_id)->where('name', $request->name)->where('id', '!=', $attributeOption->id)->first();
            if (isset($search->id)) {
                return $this->backWithError("Attribute Option #" . $request->name . ' already exists for Attribute #' . Attribute::find($request->attribute_id)->name);
            }

            $attributeOption->fill($request->all())->save();
            return $this->urlRedirectBack('Attribute Option updated successfully', 'admin/attribute-options?attribute_id=' . $request->attribute_id, 'success');
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeOption $attributeOption)
    {
        try {
            if ($attributeOption->products->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Attribute option can not be deleted.'
                ]);
            }

            $attributeOption->delete();
            return response()->json([
                'success' => true,
                'message' => "Attribute Option has been deleted"
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
