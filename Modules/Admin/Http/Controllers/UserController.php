<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\ModelHasPermission;
use Illuminate\Support\Facades\DB, Illuminate\Support\Facades\Hash, Illuminate\Support\Facades\Validator, Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function headerColumns($deleted = false)
    {
        $array = array(
            ['SL', 'SL', 'text-center', 'width: 8% !important'],
            ['name', 'name'],
            ['email', 'email'],
            ['username', 'username'],
            ['phone', 'phone'],
            ['company_name', 'company_name'],
            ['location', 'location'],
            ['website', 'website'],
            ['role', 'role'],
            ['created_at', 'created_at', 'text-center', 'width: 8% !important']
        );

        if ($deleted) {
            array_push($array, ['deleted_at', 'deleted_at', 'text-center', 'width: 8% !important']);
        }

        array_push($array, ['actions', 'actions', 'text-center', 'width: 20% !important']);

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $usersList = User::with(['roles'])->when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        })->where('type', 'admin');

        try {
            if (request()->ajax()) {
                return Datatables::of($usersList)
                    ->addIndexColumn()
                    ->addColumn('role', function ($user) {
                        return implode(', ', $user->getRoleNames()->toArray());
                    })
                    ->filterColumn('role', function ($query, $keyword) {
                        return $query->whereHas('roles', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                    })
                    ->editColumn('created_at', function ($user) {
                        return date('d-m-Y', strtotime($user->created_at));
                    })
                    ->addColumn('actions', function ($user) {
                        $actions = '<a href="javascript:void(0)" onclick="return showUserDetails(' . $user->id . ')" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-eye" title="Click to view details"></i></a>
                    <a href="' . route('acl.users.edit', $user->id) . '" class="btn btn-warning btn-sm mb-2"><i class="mdi mdi-pencil-box" title="Click to Edit"></i></a>
                    <a class="btn btn-sm btn-danger mb-2" onclick="deleteFromCRUD($(this))" data-src="' . route('acl.users.destroy', $user->id) . '"><i class="mdi mdi-trash-can"></i></a>';

                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            return view('admin::users.index', [
                'title' => 'Users',
                'headerColumns' => $this->headerColumns()
            ]);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function create(Request $request)
    {

        $title = 'Create New User';
        $roles = Role::whereNotIn('name', ['Super-Admin', 'Customer'])->orderBy('id', 'DESC')->pluck('name', 'name')->all();

        $modules = Permission::whereNotNull('module')->groupBy('module')->orderBy('module', 'ASC')->pluck('module')->toArray();
        $permissions = collect(Permission::whereNull('module')->orderBy('id', 'DESC')->get())->chunk(12);

        return view('admin::users.create', compact('title', 'roles', 'modules', 'permissions'));
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
            'name' => 'required',
            'email' => "nullable|unique:users|email|max:100",
            'phone' => "nullable|unique:users|max:15",
            'user_id' => ['nullable', 'string', 'max:200', "unique:users"],
            'avatar' => 'image|mimes:jpeg,jpg,png,gif|nullable|max:5048',
            'password' => 'required|same:confirm_password',
            'roles' => 'required',

        ]);

        $input = $request->except('_token');
        $employee = User::where('email', $input['email'])->first();

        if ($employee) {
            return $this->backWithError('This mail is already registered.');
        }

        $input['password'] = Hash::make($input['password']);
        DB::beginTransaction();
        try {

            $avatarPath = '';
            if ($request->hasFile('avatar')) {
                $avatarPath = $this->photoUpload($request->file('avatar'), 'uploads/users', 170);
                $input['avatar'] = $avatarPath;
            }

            $user = User::create($input);
            $user->assignRole($request->input('roles'));

            if (isset($request->permission[0])) {
                ModelHasPermission::where([
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id
                ])->delete();
                foreach ($request->permission as $key => $permission_id) {
                    ModelHasPermission::create([
                        'model_type' => 'App\Models\User',
                        'model_id' => $user->id,
                        'permission_id' => $permission_id
                    ]);
                }
            }

            DB::commit();

            return $this->redirectBackWithSuccess('User created successfully', 'acl.users.index');
        } catch (\Exception $e) {
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

        $user = User::findOrFail($id);
        $userRole = $user->roles->pluck('name')->toArray();

        return view('admin::users.show', compact('user', 'userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */

    public function edit($id)
    {

        $title = 'Edit User Data';
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'developer')->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        $modules = Permission::whereNotNull('module')->groupBy('module')->orderBy('module', 'ASC')->pluck('module')->toArray();

        $permissions = collect(Permission::whereNull('module')->orderBy('id', 'DESC')->get())->chunk(12);
        $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();

        return view('admin::users.edit', compact('title', 'user', 'roles', 'userRole', 'modules', 'permissions', 'userPermissions'));
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
            'phone' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($id)],
            'email' => ['nullable', 'string', 'max:100', Rule::unique('users')->ignore($id)],
            'user_id' => ['nullable', 'string', 'max:50', Rule::unique('users')->ignore($id)],
            'avatar' => 'image|mimes:jpeg,jpg,png,gif|nullable|max:5048',
            'roles' => 'required',
        ]);

        $input = $request->except('password', '_token');
        $employee = User::where('email', $input['email'])->first();
        if (!$employee) {
            return $this->backWithError('This associate is not registered yet.');
        }

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $avatarPath = '';
            if ($request->hasFile('avatar')) {
                $avatarPath = $this->photoUpload($request->file('avatar'), 'uploads/users', 170);

                if (!empty($userProfile) && file_exists($userProfile->avatar)) {
                    unlink($userProfile->avatar);
                }
                $input['avatar'] = $avatarPath;
            }

            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));

            if (isset($request->permission[0])) {
                ModelHasPermission::where([
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id
                ])->delete();
                foreach ($request->permission as $key => $permission_id) {
                    ModelHasPermission::create([
                        'model_type' => 'App\Models\User',
                        'model_id' => $user->id,
                        'permission_id' => $permission_id
                    ]);
                }
            }

            DB::commit();
            return $this->redirectBackWithSuccess('User Data Update successfully', 'acl.users.index');

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
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            User::find($id)->delete();

            if (!empty($user) && file_exists($user->avatar)) {
                unlink($user->avatar);
            }

            DB::table('model_has_roles')->where('model_id', $id)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User has been deleted successfully',
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    protected function changeUserPassword($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin::users.change-user-password', compact('user'));
    }


    function photoUpload($photoData, $folderName, $width = null, $height = null)
    {

        $photoOrgName = $photoData->getClientOriginalName();
        $photoType = $photoData->getClientOriginalExtension();
        $fileName = substr($photoOrgName, 0, -4) . date('d-m-Y-i-s') . '.' . $photoType;
        $path2 = $folderName . date('/Y/m/d/');
        if (!is_dir(public_path($path2))) {
            mkdir(public_path($path2), 0777, true);
        }

        $photoData->move(public_path($path2), $fileName);
        if ($width != null && $height != null) { // width & height mention-------------------
            $img = \Image::make(public_path($path2 . $fileName));
            $img->encode('webp', 75)->resize($width, $height);
            $img->save(public_path($path2 . $fileName));
            return $photoUploadedPath = $path2 . $fileName;

        } elseif ($width != null) { // only width mention-------------------

            $img = \Image::make(public_path($path2 . $fileName));
            $img->encode('webp', 75)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($path2 . $fileName));

            return $photoUploadedPath = $path2 . $fileName;

        } else {
            $img = \Image::make(public_path($path2 . $fileName));
            $img->save(public_path($path2 . $fileName));
            return $photoUploadedPath = $path2 . $fileName;
        }
    }


}
