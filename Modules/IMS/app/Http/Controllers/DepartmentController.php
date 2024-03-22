<?php

namespace Modules\IMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\IMS\app\Models\Departments;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
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
        $departments = Departments::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'department-edit' => auth()->user()->hasPermissionTo('department-edit'),
            'department-delete' => auth()->user()->hasPermissionTo('department-delete'),
        ];
        try {
            if (request()->ajax()) {
                return Datatables::of($departments)
                    ->addIndexColumn()
                    ->editColumn('status', function ($department) {
                        return ucfirst($department->status);
                    })
                    ->addColumn('actions', function ($department) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $department->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['department-edit']) {
                            $actions .= '<a href="' . route('departments.edit', $department->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['department-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('departments.destroy', $department->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('ims::departments.index', [
                'title' => 'Departments',
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
        $title = "Create Departments";
        $code = uniqueCode(6, 'D-', 'departments', 'id');

        return view('ims::departments.create', compact('title', 'code'));
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
            $department = new Departments();
            $department->fill($request->all());
            $department->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Department created successfully', 'departments.index');
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
        $title = "Departments Show";

        $department = Departments::findOrFail($id);

        return view('ims::departments.show', compact('department', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Department Edit";

        $department = Departments::findOrFail($id);

        return view('ims::departments.edit', compact('department', 'title'));
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
            $department = Departments::findOrFail($id);
            $department->fill($request->all());
            $department->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Departments updated successfully', 'departments.index');
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
            $department = Departments::findOrFail($id);
            $department->delete();

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

}