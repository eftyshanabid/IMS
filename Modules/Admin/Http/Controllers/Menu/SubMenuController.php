<?php

namespace Modules\Admin\Http\Controllers\Menu;

use App\Http\Controllers\Controller;

use App\Models\Menu\Menu;
use App\Models\Menu\SubMenu;
use App\Models\Menu\SubSubMenu;
use Illuminate\Http\Request;

use App\Http\Requests;

use Validator,Image;
use Spatie\Permission\Models\Permission;

class SubMenuController extends Controller
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


        $validator = Validator::make($input, [   
                    'name'          => 'required',
                    'url'    => 'required',
                    'icon' => 'mimes:jpeg,jpg,bmp,png'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

        try{
            $input['slug']=json_encode($request->slug);

            if ($request->hasFile('icon')){
                $input['icon']=$this->photoUpload($request->file('icon'),'images/menu/sub-menu/icon/',32);
                //$input['big_icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/sub-menu/big-icon/',128);

            }

            SubMenu::create($input);

            return $this->backWithSuccess('Menu created successfully');
        }catch(\Exception $e){
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
        //$page=Page::where('status',1)->pluck('name','link');
        $allData=SubMenu::leftJoin('menus','sub_menus.menu_id','=','menus.id')->select('sub_menus.*','menus.name as menu_name')->where('menu_id',$id)->orderBy('serial_num','DESC')->paginate(20);

        $menu=Menu::findOrFail($id);
        $title='Create submenu under the ('.$menu->name.') Main Menu';
        $max_serial=SubMenu::where('menu_id',$id)->max('serial_num');
        $permissions = Permission::orderBy('id','DESC')->pluck('name', 'name');
        $menuFor=[
            SubMenu::ADMIN_MENU => SubMenu::ADMIN_MENU,
            SubMenu::CLIENT_MENU => SubMenu::CLIENT_MENU,
            SubMenu::USER_MENU => SubMenu::USER_MENU
        ];
        $status=[SubMenu::ACTIVE  => SubMenu::ACTIVE ,
            SubMenu::INACTIVE  => SubMenu::INACTIVE];

        $openTab=[SubMenu::NO_OPEN_NEW_TAB  => SubMenu::NO_OPEN_NEW_TAB ,
            SubMenu::OPEN_NEW_TAB  => SubMenu::OPEN_NEW_TAB];

        return view('admin::menu.submenu',compact('title','allData','max_serial','menu','permissions','menuFor','status','openTab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data=SubMenu::leftJoin('menus','sub_menus.menu_id','=','menus.id')->select('sub_menus.*','menus.name as menu_name')
            ->where('sub_menus.id',$id)->orderBy('serial_num','DESC')->first(20);

        $menu=Menu::findOrFail($data->menu_id);
        $max_serial=SubMenu::where('menu_id',$data->menu_id)->max('serial_num');
        $permissions = Permission::orderBy('id','DESC')->pluck('name', 'name');

        $menuFor=[
            SubMenu::ADMIN_MENU => SubMenu::ADMIN_MENU,
            SubMenu::CLIENT_MENU => SubMenu::CLIENT_MENU,
            SubMenu::USER_MENU => SubMenu::USER_MENU
        ];
        $status=[SubMenu::ACTIVE  => SubMenu::ACTIVE ,
            SubMenu::INACTIVE  => SubMenu::INACTIVE];

        $openTab=[SubMenu::NO_OPEN_NEW_TAB  => SubMenu::NO_OPEN_NEW_TAB ,
            SubMenu::OPEN_NEW_TAB  => SubMenu::OPEN_NEW_TAB];
        $title='Edit submenu under the ('.$menu->name.') Main Menu';
        return view('admin::menu.submenuEdit',compact('data','max_serial','menu','permissions','menuFor','status','openTab','title'));
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
        $data=SubMenu::findOrFail($id);
        
        $validator = Validator::make($input, [
                    'name'    => 'required',
                    'url'          => 'required',
                    'icon' => 'mimes:jpeg,jpg,bmp,png'
                   // 'icon' => 'mimes:jpeg,jpg,bmp,png|dimensions:min_width=128,max_width=256'
                ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            //$input['slug']=json_encode($request->slug);
            if ($request->hasFile('icon')){
                $input['icon']=$this->photoUpload($request->file('icon'),'images/menu/sub-menu/icon/',32);
                //$input['big_icon']=MyHelper::photoUpload($request->file('icon'),'images/menu/big-icon/',128);
                if (file_exists(asset($data->icon))){ unlink(asset($data->icon));  }
                if (file_exists(asset($data->big_icon))){ unlink(asset($data->big_icon));  }
            }
            $data->update($input);

            return $this->backWithSuccess('Menu created successfully');
        }catch(\Exception $e){
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
        
        $data=SubMenu::findOrFail($id);
       try{

           $subSubMenus=SubSubMenu::whereIn('sub_menu_id',[$id])->delete();

            $data->delete();

           if (file_exists($data->icon)){ unlink(asset($data->icon));  }
           if (file_exists($data->big_icon)){ unlink(asset($data->big_icon));  }

           return $this->backWithSuccess('Menu created successfully');

       }catch(\Exception $e){
           return $this->backWithError($e->getMessage());
       }

    }
}
