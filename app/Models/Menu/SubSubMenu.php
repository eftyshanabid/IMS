<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubMenu extends Model
{
    use SoftDeletes;


    const ACTIVE='Active';
    const INACTIVE='Inactive';

    const OPEN_NEW_TAB='Open New Tab';
    const NO_OPEN_NEW_TAB='No Open New Tab';

    const ADMIN_MENU='Sub Sub Menu for admin';
    const USER_MENU='Sub sub Menu for user';
    const CLIENT_MENU='Sub sub menu for Client';

    protected $table='sub_sub_menus';
    protected $fillable=['menu_id','sub_menu_id','name','name_bn','url','icon_class','icon','big_icon', 'status','slug','serial_num','menu_for','open_new_tab'];

}
