<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Units;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnitsController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['unit_name', 'unit_name'],
            ['unit_code', 'unit_code'],
            ['status', 'status'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Units::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'unit-edit' => auth()->user()->hasPermissionTo('unit-edit'),
            'unit-delete' => auth()->user()->hasPermissionTo('unit-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($units)
                ->addIndexColumn()
                ->editColumn('status', function ($unit) {
                        return ucfirst($unit->status);
                    })
                    ->addColumn('actions', function ($unit) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $unit->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['unit-edit']) {
                            $actions .= '<a href="' . route('units.edit', $unit->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['unit-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('units.destroy', $unit->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::units.index', [
                'title' => 'units',
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
        $title = "Create Units";
        $code = uniqueCode(6, 'U-', 'units', 'id');

        return view('ims::units.create', compact('title', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $unit = new Units();
            $unit->fill($request->all());
            $unit->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Unit created successfully', 'units.index');
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
        $title = "Units Show";

        $unit = Units::findOrFail($id);

        return view('ims::units.show', compact('unit', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Unit Edit";

        $unit = Units::findOrFail($id);

        return view('ims::units.edit', compact('unit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'unit_name' => 'required',
            'unit_code' => "required",
        ]);


        DB::beginTransaction();
        try {
            $unit = Units::findOrFail($id);
            $unit->fill($request->all());
            $unit->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Units updated successfully', 'units.index');
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
            $unit = Units::findOrFail($id);
            $unit->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Units has been deleted successfully',
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
