<?php

namespace Modules\Language\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Language\app\Models\Language;
use DB, DataTables;

class LanguageController extends Controller
{
    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL', 'text-center', 'width: 8% !important'],
            ['code', 'code', 'text-center'],
            ['name', 'name', 'text-center'],
            ['flag', 'flag', 'text-center'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (request()->ajax()) {
                return DataTables::of(
                    Language::when(!datatableOrdering(), function ($query) {
                        return $query->orderby('id', 'desc');
                    })
                )
                    ->addIndexColumn()
                    ->editColumn('flag', function ($language) {
                        return '<img src="https://flagsapi.com/'.$language->flag.'/flat/64.png" />';
                    })
                    ->addColumn('actions', function ($language) {
                        $actions = '';
                        if (auth()->user()->hasPermissionTo('language-edit')) {
                            $actions .= '<a href="' . route('languages.edit', $language->id) . '" class="btn btn-warning btn-sm mb-2"><i class="mdi mdi-pencil-box" title="Click to Edit"></i></a> ';
                        }

                        if (auth()->user()->hasPermissionTo('language-edit')) {
                            $actions .= '<a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('languages.destroy', $language->id) . '"><i class="mdi mdi-trash-can"></i></a>';
                        }

                        return $actions;
                    })
                    ->rawColumns(['flag', 'actions'])
                    ->toJson();
            }

            return view('language::languages.index', [
                'title' => 'Language',
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
        return view('language::languages.create', [
            'title' => "New Language"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'code' => 'required|max:120|unique:languages',
            'name' => "required",
            'flag' => "required",
        ]);

        DB::beginTransaction();
        try {
            Language::create($request->all());

            session()->forget('language-lists');
            DB::commit();
            return $this->redirectBackWithSuccess('Language created successfully', 'languages.index');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('language::languages.edit', [
            'title' => "Edit Language",
            'language' => Language::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'code' => 'required|max:120|unique:languages,code,'.$id,
            'name' => "required",
            'flag' => "required",
        ]);

        DB::beginTransaction();
        try {
            $language = Language::findOrFail($id);
            $language->fill($request->all());
            $language->save();

            session()->forget('language-lists');
            DB::commit();
            return $this->redirectBackWithSuccess('Language updated successfully', 'languages.index');
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
            Language::findOrFail($id)->delete();

            session()->forget('language-lists');
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Language has been deleted successfully',
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
