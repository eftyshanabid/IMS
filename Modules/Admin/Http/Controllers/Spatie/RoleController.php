<?php

namespace Modules\Admin\Http\Controllers\Spatie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator, DB, Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $title = 'Role';

        return view('admin::spatie.roles.index', compact('title'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Roles data import
     */

    public function rolesData()
    {
        $allData = Role::whereNotIn('name', ['Customer'])->orderBy('id', 'DESC')->select('roles.*');

        return DataTables::of($allData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('action', '
           {!! Form::open(array(\'route\'=> [\'acl.roles.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id")) !!}
           {{ Form::hidden(\'id\',$id)}}
           <a href="javascript:void(0)" onclick="return showRoleWithPermission({{$id}})" class="btn btn-info btn-sm"><i class="mdi mdi-eye" title="Click to view details"></i> Show</a>
           <a href="{{route(\'acl.roles.edit\',$id)}}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil-box" title="Click to Edit"></i> Edit</a>
           <button type="button" onclick=\'return deleteConfirm("deleteForm{{$id}}");\' class="btn btn-danger btn-sm">
           <i class="mdi mdi-trash-can"></i> Delete
           </button>
           {!! Form::close() !!}
           ')
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = 'Role';
        $modules = Permission::whereNotNull('module')->groupBy('module')->orderBy('module', 'ASC')->pluck('module')->toArray();
        $permissions = collect(Permission::whereNull('module')->orderBy('id', 'DESC')->get())->chunk(10);
        return view('admin::spatie.roles.create', compact('modules', 'permissions', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        //dd($request->permission);
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->input('name'),
                'word_restrictions' => json_encode(array_map(function ($value) {
                    return strtolower(trim($value));
                }, explode(',', $request->input('word_restrictions'))))
            ]);

            $role->syncPermissions($request->input('permission'));

            DB::commit();
            return $this->backWithSuccess('Role created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        $title = 'Role with Permission';
        $role = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)->get();

        return view('admin::spatie.roles.show', compact('title', 'role', 'rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {

        $role = Role::find($id);

        $modules = Permission::whereNotNull('module')->groupBy('module')->orderBy('module', 'ASC')->pluck('module')->toArray();
        $permissions = collect(Permission::whereNull('module')->orderBy('id', 'DESC')->get())->chunk(10);

        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        $title = 'Update Role and Permission';

        return view('admin::spatie.roles.edit', compact('role', 'modules', 'permissions', 'rolePermissions', 'title'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($id);

        DB::beginTransaction();
        try {

            $role->name = $request->input('name');
            $role->word_restrictions = json_encode(array_map(function ($value) {
                return strtolower(trim($value));
            }, explode(',', $request->input('word_restrictions'))));
            $role->save();

            $role->syncPermissions($request->input('permission'));

            DB::commit();
            return $this->backWithSuccess('Role and Permission Update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        try {
            $result = Role::find($id);

            if ($result == NULL) //check if no record found
            {
                return redirect()->back()->with('error', 'Something Error Found !, Please try again.');
            }

            if ($result->name == 'developer') // for admin and developer account
            {
                return $this->backWithError('This Role Can not be delete');
            }

            DB::table("roles")->where('id', $id)->delete();
            return $this->backWithSuccess('Permission created successfully');
        } catch (\Exception $e) {

            return $this->backWithError($e->getMessage());
        }

    }
}
