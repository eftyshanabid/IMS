<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WarehouseController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['name', 'name'],
            ['code', 'code'],
            ['phone', 'phone'],
            ['email', 'email'],
            ['location', 'location'],
            ['address', 'address'],
            ['status', 'status'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouse = Warehouse::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'warehouse-edit' => auth()->user()->hasPermissionTo('warehouse-edit'),
            'warehouse-delete' => auth()->user()->hasPermissionTo('warehouse-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($warehouse)
                ->addIndexColumn()
                ->editColumn('status', function ($warehouse) {
                        return ucfirst($warehouse->status);
                    })
                    ->addColumn('actions', function ($warehouse) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $warehouse->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['warehouse-edit']) {
                            $actions .= '<a href="' . route('warehouses.edit', $warehouse->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['warehouse-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('warehouses.destroy', $warehouse->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::warehouses.index', [
                'title' => 'Warehouses',
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
        $title = "Create Warehouses";
        $code = uniqueCode(6, 'WH-', 'warehouses', 'id');

        return view('ims::warehouses.create', compact('title', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'address' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $warehouse = new Warehouse();
            $warehouse->fill($request->all());
            $warehouse->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Warehouse created successfully', 'warehouses.index');
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
        $title = "Warehouses Show";

        $warehouse = Warehouse::findOrFail($id);

        return view('ims::warehouses.show', compact('warehouse', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Warehouses Edit";

        $warehouse = Warehouse::findOrFail($id);

        return view('ims::warehouses.edit', compact('warehouse', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'code' => "required",
            'address' => 'required',
        ]);


        DB::beginTransaction();
        try {
            $warehouse = Warehouse::findOrFail($id);
            $warehouse->fill($request->all());
            $warehouse->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Warehouses updated successfully', 'warehouses.index');
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
            $warehouse = Warehouse::findOrFail($id);
            $warehouse->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Warehouses has been deleted successfully',
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
