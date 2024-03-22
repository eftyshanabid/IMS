<?php

namespace App\Providers;

use App\Models\Menu\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.navbar'],function ($view){
            // if( Cache::has('menus')) {
            //     $menus = Cache::get('menus');
            // }else{
            $menus=Menu::with(['subMenu', 'activeSubMenu'])
                ->where(['menu_for'=>Menu::ADMIN_MENU,'status'=>Menu::ACTIVE])
                ->orderBy('serial_num','ASC')
                ->get();

            //Cache::put('menus',$menus,'60');
            // $menus = Cache::get('menus');
            // }
            $view->with(['menus'=>$menus]);
        });
    }
}
