<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMenu extends Model
{
    use SoftDeletes;


    const ACTIVE='Active';
    const INACTIVE='Inactive';

    const OPEN_NEW_TAB='Open New Tab';
    const NO_OPEN_NEW_TAB='No Open New Tab';

    const ADMIN_MENU='Sub menu for admin';
    const USER_MENU='Sub menu for user';
    const CLIENT_MENU='Sub Menu for Client';

    protected $table='sub_menus';
    protected $fillable=['menu_id','name','name_bn','url','icon_class','icon','big_icon', 'status','slug','serial_num','menu_for','open_new_tab'];


    public function activeSubSubMenu(){
        return $this->hasMany(SubSubMenu::class,'sub_menu_id','id')->orderBy('serial_num','ASC')
            ->where(['status'=>SubSubMenu::ACTIVE,]);;
    }


    public function subSubMenu(){
        return $this->hasMany(SubSubMenu::class,'sub_menu_id','id')->orderBy('serial_num','ASC');
    }

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id','id');
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
