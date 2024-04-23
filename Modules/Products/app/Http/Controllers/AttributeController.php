<?php

namespace Modules\Products\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Modules\Products\app\Models\Attribute;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'title' => "Attributes",
                'attributes' => Attribute::all()
            ];
            return view('products::attributes.index', $data);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = [
            'title' => "New Attribute",
        ];
        return view('products::attributes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'code' => ['required', 'string', 'max:255', 'unique:attributes'],
            'name' => ['required', 'string', 'max:255', 'unique:attributes'],
        ]);
        try {
            $attribute = Attribute::create($request->all());

            $notification = [
                'message' => 'Attribute created successfully',
                'alert-type' => 'success'
            ];
            return redirect('admin/attribute-options?attribute_id=' . $attribute->id)->with($notification);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('products::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'title' => "Edit Attribute",
            'attribute' => Attribute::find($id)
        ];
        return view('products::attributes.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute): RedirectResponse
    {
        $this->validate($request, [
            'code' => ['required', 'string', 'max:255', Rule::unique('attributes')->ignore($attribute->id)],
            'name' => ['required', 'string', 'max:255', Rule::unique('attributes')->ignore($attribute->id)],
        ]);
        try {
            $attribute->fill($request->all())->save();
            return $this->backWithSuccess('Attribute updated successfully');
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        try {

            if ($attribute->options->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Attribute can not be deleted.'
                ]);
            }

            $attribute->options->each->delete();
            $attribute->delete();

            return response()->json([
                'success' => true,
                'message' => "Attribute has been deleted"
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
