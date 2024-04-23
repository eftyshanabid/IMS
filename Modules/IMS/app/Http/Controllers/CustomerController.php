<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Customer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
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
        $customer = Customer::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'customer-edit' => auth()->user()->hasPermissionTo('customer-edit'),
            'customer-delete' => auth()->user()->hasPermissionTo('customer-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($customer)
                    ->addIndexColumn()
                    ->editColumn('status', function ($customer) {
                        return ucfirst($customer->status);
                    })
                    ->addColumn('actions', function ($customer) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $customer->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['customer-edit']) {
                            $actions .= '<a href="' . route('customers.edit', $customer->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['customer-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('customers.destroy', $customer->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::customers.index', [
                'title' => 'Customer',
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
        $title = "Create Customer";
        $code = uniqueCode(6, 'CUS-', 'customers', 'id');

        return view('ims::customers.create', compact('title', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'phone' => 'required',
            'tin' => 'required',
            'bin' => 'required',
            'vat' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $customer = new Customer();
            $customer->fill($request->all());
            $customer->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Customer created successfully', 'customers.index');
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
        $title = "Customers Show";

        $customer = customer::findOrFail($id);

        return view('ims::customers.show', compact('customer', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Customer Edit";

        $customer = Customer::findOrFail($id);

        return view('ims::customers.edit', compact('customer', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'phone' => 'required',
            'tin' => 'required',
            'bin' => 'required',
            'vat' => 'required',
        ]);


        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($id);
            $customer->fill($request->all());
            $customer->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Customer updated successfully', 'customers.index');
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
            $customer = Customer::findOrFail($id);
            $customer->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Customers has been deleted successfully',
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
