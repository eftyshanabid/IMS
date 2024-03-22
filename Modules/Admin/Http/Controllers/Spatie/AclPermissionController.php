<?php

namespace Modules\Admin\Http\Controllers\Spatie;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use App\Models\Menu\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Validator;
use DB;
use Yajra\DataTables\DataTables;

class AclPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        //$this->middleware('role:developer');
    }

    public function index()
    {
        $menus=Menu::where(['menu_for'=>Menu::ADMIN_MENU,'status'=>Menu::ACTIVE])->orderBy('serial_num','ASC')->pluck('name','id');

        $title='Permission';

        $modules = Permission::whereNotNull('module')->groupBy('module')->pluck('module')->toArray();

        return view('admin::spatie.permission.index',compact('title','menus', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Permission::whereNotNull('module')->groupBy('module')->pluck('module')->toArray();
        $allData=Permission::orderBy('id','DESC')->select('permissions.*');

        return DataTables::of($allData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('action', function($permission) use($modules){
                return view('admin::spatie.permission.action', compact('permission', 'modules'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name.*' => 'required|unique:permissions,name'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
//            if($request->type==1){
//                Permission::createResource($request->name,1);
//            }

            foreach ($request->name as $key=>$name){
                Permission::create([
                    'name' => $name,
                    'guard_name' => 'web',
                    'module' => $request->module
                ]);
            }


            if (!is_null($request->submenu_id)){
                $subMenu=SubMenu::with('menu')->findOrFail($request->submenu_id);
                $subMenu->menu->update(['slug'=>json_encode($request->name)]);
                $subMenu->update(['slug'=>json_encode($request->name)]);
            }
            if(!is_null($request->menu_id)){

                $menu=Menu::findOrFail($request->menu_id)->update(['slug'=>json_encode($request->name)]);
            }

            DB::commit();
            return $this->backWithSuccess('Permission created successfully');
        } catch (Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submenus=SubMenu::where(['menu_id'=>$id])->orderBy('id','DESC')->get();

        return view('admin::spatie.permission.submenu-list',compact('submenus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alldata=Permission::paginate('10');
        $permission=Permission::findOrFail($id);
        $modules = Permission::whereNotNull('module')->groupBy('module')->pluck('module')->toArray();
        return view('admin::spatie.permission.edit',compact('alldata','permission', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    
        $data = Permission::findOrFail($id);
        $input = $request->except('_token');
        $validator = Validator::make($request->all(),[
            'name' => "required|unique:permissions,name,$id"

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        try {
            $data->update($input);

            return $this->backWithSuccess('Permission created successfully');
        } catch (\Exception $e) {
            return $this->backWithError($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::findOrFail($id);

        try {
            $data->delete();

            return $this->backWithSuccess('Permission created successfully');
        } catch (\Exception $e) {
            return $this->backWithError($e->getMessage());
        }

    }


    public function storeRole(Request $request)
    {
        $input=$request->except('_token');
        $validator = Validator::make($request->all(),[
            'role_id' => 'required',
            'permission_id' => 'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            DB::table('permissions')->where('role_id',$input['role_id'])->delete();
            for ($i=0; $i <sizeof($input['permission_id']) ; $i++) {
                $permissionId=$input['permission_id'][$i];
                \DB::table('permissions')->insert([
                    'role_id'=>$input['role_id'],
                    'permission_id'=>$permissionId
                ]);
            }
            Artisan::call('cache:clear');
            DB::commit();
            return $this->backWithSuccess('Role created successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }

    }

    public function approvalSettings()
    {
        try {

        }catch (\Throwable $th){
            return $this->backWithError($th->getMessage());
        }
    }
}
