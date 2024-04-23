<?php

namespace Modules\Products\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Products\app\Models\ProductGroup;
use Yajra\DataTables\Facades\DataTables;

class ProductGroupController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['name', 'name'],
            ['code', 'code'],
            ['description', 'description'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = ProductGroup::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'group-edit' => auth()->user()->hasPermissionTo('group-edit'),
            'group-delete' => auth()->user()->hasPermissionTo('group-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($groups)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($group) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $group->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['group-edit']) {
                            $actions .= '<a href="' . route('product-groups.edit', $group->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['group-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('product-groups.destroy', $group->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('products::groups.index', [
                'title' => 'Product Group',
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
        $title = "Create Product Group";
        $code = uniqueCode(6, 'PG-', 'product_groups', 'id');

        return view('products::groups.create', compact('title', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $group = new ProductGroup();
            $group->fill($request->all());
            $group->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Product Group created successfully', 'product-groups.index');
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
        $title = "Product Group Show";

        $group = ProductGroup::findOrFail($id);

        return view('products::groups.show', compact('group', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Product Group Edit";

        $group = ProductGroup::findOrFail($id);

        return view('products::groups.edit', compact('group', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'code' => "required",
        ]);


        DB::beginTransaction();
        try {
            $group = ProductGroup::findOrFail($id);
            $group->fill($request->all());
            $group->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Product Group updated successfully', 'product-groups.index');
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
            $group = ProductGroup::findOrFail($id);
            $group->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product Group has been deleted successfully',
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
