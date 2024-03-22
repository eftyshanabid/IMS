<?php

namespace Modules\Admin\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Menu\Menu;
use App\Models\Menu\SubMenu;
use App\Models\Menu\SubSubMenu;
use App\Models\Menu\Page;
use \Spatie\Permission\Models\Permission;
use Validator,MyHelper;

class SubSubMenuController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $input = $request->all();
        if(isset($input['page'])){
            $page=Page::select('name','name_bn')->where('link',$input['page'])->first();
            $input['name']=$page['name'];
            $input['name_bn']=$page['name_bn'];
            $input['url']="page/".$input['page'];
        }

        $validator = Validator::make($input, [   
                    'name'=> 'required',
                    'url'=> 'required',
                    'icon' => 'mimes:jpeg,jpg,bmp,png'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

        try{
            $input['slug']=json_encode($request->slug);

            if ($request->hasFile('icon')){
                $input['icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/sub-sub-menu/icon/',32);
                $input['big_icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/sub-sub-menu/big-icon/',128);
            }


            SubSubMenu::create($input);

                $bug=0;
             }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect()->back()->with('success','Successfully Inserted');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
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

        $allData=SubSubMenu::leftJoin('sub_menus','sub_sub_menus.sub_menu_id','=','sub_menus.id')
           ->leftJoin('menus','sub_menus.menu_id','=','menus.id')
           ->select('sub_sub_menus.*','menus.name as menu_name','sub_menus.name as sub_menu_name')
           ->where('sub_sub_menus.sub_menu_id',$id)->orderBy('sub_sub_menus.serial_num','DESC')->paginate(20);

        $subMenu=SubMenu::findOrFail($id);
        $menu=Menu::findOrFail($subMenu->menu_id);

        $max_serial=SubSubMenu::where('sub_menu_id',$id)->max('serial_num');

        $permissions =Permission::orderBy('id','DESC')->pluck('name', 'name');

        return view('admin.menu.subSubMenu',compact('allData','max_serial','menu','subMenu','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=SubSubMenu::leftJoin('sub_menus','sub_sub_menus.sub_menu_id','=','sub_menus.id')
            ->leftJoin('menus','sub_menus.menu_id','=','menus.id')
            ->select('sub_sub_menus.*','menus.name as menu_name','sub_menus.name as sub_menu_name')
            ->where('sub_sub_menus.id',$id)->orderBy('sub_sub_menus.serial_num','DESC')->first();

        $subMenu=SubMenu::findOrFail($data->sub_menu_id);
        $menu=Menu::findOrFail($subMenu->menu_id);

        $max_serial=SubSubMenu::where('sub_menu_id',$id)->max('serial_num');

        $permissions =Permission::orderBy('id','DESC')->pluck('name', 'name');

        return view('admin.menu.subSubMenuEdit',compact('data','max_serial','menu','subMenu','permissions'));
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
       $input = $request->all();
        $data=SubSubMenu::findOrFail($id);
        
        $validator = Validator::make($input, [
                    'name'    => 'required',
                    'url'    => 'required',
                    'icon' => 'mimes:jpeg,jpg,bmp,png'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

        try{

            $input['slug']=json_encode($request->slug);

            if ($request->hasFile('icon')){
                $input['icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/sub-sub-menu/icon/',32);
                $input['big_icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/sub-sub-menu/big-icon/',128);
                if (file_exists($data->icon)){unlink($data->icon);}
                if (file_exists($data->big_icon)){unlink($data->big_icon);}
            }

            $data->update($input);
                
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect()->back()->with('success','Successfully Update');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
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
        
        $data=SubSubMenu::findOrFail($id);
       try{
            $data->delete();
            $bug=0;

//           if (file_exists($data->icon)){unlink($data->icon);}
//           if (file_exists($data->big_icon)){unlink($data->big_icon);}
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect()->back()->with('success','Successfully Deleted!');
        }elseif($bug==1451){
       return redirect()->back()->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        }
    }
}
