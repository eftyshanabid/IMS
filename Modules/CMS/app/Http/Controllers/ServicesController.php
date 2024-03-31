<?php

namespace Modules\CMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\CMS\app\Models\Services;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL', 'text-center', 'width: 8% !important'],
            ['title', 'title'],
            ['price', 'price'],
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
        $services = Services::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        });

        $options = [
            'service-edit' => auth()->user()->hasPermissionTo('service-edit'),
            'service-delete' => auth()->user()->hasPermissionTo('service-delete'),
        ];

        try {
            if (request()->ajax()) {
                return Datatables::of($services)
                    ->addIndexColumn()
                    ->editColumn('title', function ($service) {
                        return languageValues($service->title);
                    })
                    ->editColumn('type', function ($service) {
                        return serviceTypes()[$service->type];
                    })
                    ->editColumn('status', function ($service) {
                        return ucfirst($service->status);
                    })
                    ->addColumn('actions', function ($service) use ($options) {
                        $actions = '';

                        $actions .= '<a href="javascript:void(0)" onclick="return showDetails(' . $service->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a> ';

                        if ($options['service-edit']) {
                            $actions .= '<a href="' . route('services.edit', $service->id) . '" class="btn btn-warning btn-sm mb-2"><i
                        class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }
                        if ($options['service-delete']) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('services.destroy', $service->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['title', 'actions'])
                    ->make(true);
            }

            return view('cms::services.index', [
                'title' => 'Services',
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
        $title = "Create Services";
        $service = new Services();

        return view('cms::services.create', compact('title', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'title.*' => 'required',
            'type' => "required",
            'price' => "required"
        ]);

        DB::beginTransaction();
        try {
            $service = new Services();
            $service->fill($request->all());
            $service->title = json_encode($request->title);
            $service->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Service created successfully', 'services.index');
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
        $title = "Service Show";

        $service = Services::findOrFail($id);

        return view('cms::services.show', compact('service', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Service Edit";

        $service = Services::findOrFail($id);

        return view('cms::services.edit', compact('service', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'title.*' => 'required',
            'type' => "required",
            'price' => "required",
        ]);


        DB::beginTransaction();
        try {
            $service = Services::findOrFail($id);
            $service->fill($request->all());
            $service->title = json_encode($request->title);
            $service->save();

            DB::commit();
            return $this->redirectBackWithSuccess('Services updated successfully', 'services.index');
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
            $service = Services::findOrFail($id);
            $service->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Service has been deleted successfully',
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
