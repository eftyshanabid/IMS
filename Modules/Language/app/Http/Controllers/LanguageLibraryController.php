<?php

namespace Modules\Language\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Models\LanguageLibrary;
use Illuminate\Support\Facades\DB, Yajra\DataTables\Facades\DataTables;

class LanguageLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('language::language-library', [
                'title' => 'Language Library',
                'slugs' => LanguageLibrary::groupBy('slug')->get(['slug']),
                'libraries' => LanguageLibrary::with([
                    'language'
                ])->where('slug', request()->get('slug'))->get(),
                'languages' => Language::all(),
            ]);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'slug' => 'required',
            'languages' => "required",
            'languages.*' => "required"
        ]);

        DB::beginTransaction();
        try {
            if(isset($request->languages) && count($request->languages) > 0){
                foreach ($request->languages as $language_id => $translation) {
                    LanguageLibrary::updateOrCreate([
                        'slug' => $request->slug,
                        'language_id' => $language_id
                    ], [
                        'translation' => $translation
                    ]);
                }
            }

            session()->forget('languages');
            session()->forget('language-lists');
            DB::commit();
            return $this->backWithSuccess('Language Library updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }
}
