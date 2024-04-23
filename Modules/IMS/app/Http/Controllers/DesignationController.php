<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Designations;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DesignationController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL'],
            ['name', 'name'],
            ['code', 'code'],
            ['status', 'status'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designations::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'designation-edit' => auth()->user()->hasPermissionTo('designation-edit'),
            'designation-delete' => auth()->user()->hasPermissionTo('designation-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($designations)
                ->addIndexColumn()  
                    ->editColumn('status', function ($designation) {
                        return ucfirst($designation->status);
                    })
                    ->addColumn('actions', function ($designation) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $designation->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['designation-edit']) {
                            $actions .= '<a href="' . route('designations.edit', $designation->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['designation-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('designations.destroy', $designation->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::designations.index', [
                'title' => 'designations',
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
        {
            $title = "Create Designations";
            $code = uniqueCode(6, 'D-', 'designations', 'id');
    
            return view('ims::designations.create', compact('title', 'code'));
        }
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
            $designation = new Designations();
            $designation->fill($request->all());
            $designation->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Designations created successfully', 'designations.index');
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
        $title = "Designations Show";

        $designation = Designations::findOrFail($id);

        return view('ims::designations.show', compact('designation', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Designation Edit";

        $designation = Designations::findOrFail($id);

        return view('ims::designations.edit', compact('designation', 'title'));
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
            $designation = Designations::findOrFail($id);
            $designation->fill($request->all());
            $designation->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Designations updated successfully', 'designations.index');
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
            $designation = Designations::findOrFail($id);
            $designation->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Designations has been deleted successfully',
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
