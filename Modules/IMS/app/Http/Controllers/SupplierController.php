<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['name', 'name'],
            ['code', 'code'],
            ['phone', 'phone'],
            ['email', 'email'],
            ['trade', 'trade'],
            ['bin', 'bin'],
            ['vat', 'vat'],
            ['agreement', 'agreement'],
            ['status', 'status'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'supplier-edit' => auth()->user()->hasPermissionTo('supplier-edit'),
            'supplier-delete' => auth()->user()->hasPermissionTo('supplier-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($supplier)
                    ->addIndexColumn()
                    ->editColumn('segments', function ($supplier) {
                        return ucfirst($supplier->segments);
                    })
                    ->editColumn('status', function ($supplier) {
                        return ucfirst($supplier->status);
                    })
                    ->addColumn('actions', function ($supplier) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $supplier->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['supplier-edit']) {
                            $actions .= '<a href="' . route('suppliers.edit', $supplier->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['supplier-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('suppliers.destroy', $supplier->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::suppliers.index', [
                'title' => 'Supplier',
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
        $title = "Create Suppliers";
        $code = uniqueCode(6, 'SPL-', 'suppliers', 'id');

        return view('ims::suppliers.create', compact('title', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'segments' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $supplier = new Supplier();
            $supplier->fill($request->all());
            $supplier->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Supplier created successfully', 'suppliers.index');
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
        $title = "Suppliers Show";

        $supplier = Supplier::findOrFail($id);

        return view('ims::suppliers.show', compact('supplier', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Supplier Edit";

        $supplier = Supplier::findOrFail($id);

        return view('ims::suppliers.edit', compact('supplier', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'segments' => 'required',
        ]);


        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->fill($request->all());
            $supplier->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Supplier updated successfully', 'suppliers.index');
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
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Suppliers has been deleted successfully',
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
