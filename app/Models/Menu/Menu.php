<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    const ACTIVE='Active';
    const INACTIVE='Inactive';

    const OPEN_NEW_TAB='Open New Tab';
    const NO_OPEN_NEW_TAB='No Open New Tab';

    const ADMIN_MENU='Menu for admin';
    const USER_MENU='Menu for user';
    const CLIENT_MENU='Menu for Client';

    protected $table='menus';
    protected $fillable=['name','name_bn','url','icon_class','icon','big_icon', 'status','slug','serial_num','menu_for','open_new_tab'];

    public function activeSubMenu(){
        return $this->hasMany(SubMenu::class,'menu_id','id')->orderBy('serial_num','ASC')->where(['status'=>Menu::ACTIVE,]);
    }

    public function subMenu(){
        return $this->hasMany(SubMenu::class,'menu_id','id')->orderBy('serial_num','ASC');
    }

    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(\Auth::check()){
                $query->created_by = @\Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(\Auth::check()){
                $query->updated_by = @\Auth::user()->id;
            }
        });
    }

}
