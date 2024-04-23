<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Charges;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChargesController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['charge_name', 'charge_name'],
            ['charge_code', 'charge_code'],
            ['type', 'type'],
            ['status', 'status'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $charges = Charges::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'charge-edit' => auth()->user()->hasPermissionTo('charge-edit'),
            'charge-delete' => auth()->user()->hasPermissionTo('charge-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($charges)
                    ->addIndexColumn()
                    ->editColumn('type', function ($charge) {
                        return ucfirst($charge->type);
                    })
                    ->editColumn('status', function ($charge) {
                        return ucfirst($charge->status);
                    })
                    ->addColumn('actions', function ($charge) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $charge->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['charge-edit']) {
                            $actions .= '<a href="' . route('charges.edit', $charge->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['charge-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('charges.destroy', $charge->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::charges.index', [
                'title' => 'Charges',
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
        $title = "Create Charges";
        $code = uniqueCode(6, 'CHG-', 'charges', 'id');

        return view('ims::charges.create', compact('title', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'charge_name' => 'required',
            'charge_code' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $charge = new Charges();
            $charge->fill($request->all());
            $charge->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Charge created successfully', 'charges.index');
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
        $title = "Charges Show";

        $charge = Charges::findOrFail($id);

        return view('ims::charges.show', compact('charge', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Charges Edit";

        $charge = Charges::findOrFail($id);

        return view('ims::charges.edit', compact('charge', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'charge_name' => 'required',
            'charge_code' => 'required',
        ]);


        DB::beginTransaction();
        try {
            $charge = Charges::findOrFail($id);
            $charge->fill($request->all());
            $charge->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Charges updated successfully', 'charges.index');
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
            $charge = Charges::findOrFail($id);
            $charge->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Charges has been deleted successfully',
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
