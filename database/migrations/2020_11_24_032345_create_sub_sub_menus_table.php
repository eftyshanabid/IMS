<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_menus', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('menu_id',false,20);
            $table->bigInteger('sub_menu_id',false,20);


            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('url');
            $table->string('icon_class')->nullable();
            $table->string('icon')->nullable();
            $table->string('big_icon')->nullable();
            $table->tinyInteger('serial_num',false,4);

            $table->string('status')->default(\App\Models\Menu\SubSubMenu::ACTIVE);
            $table->string('slug')->nullable();
            $table->string('menu_for')->default(\App\Models\Menu\SubSubMenu::ADMIN_MENU);
            $table->string('open_new_tab')->default(\App\Models\Menu\SubSubMenu::NO_OPEN_NEW_TAB);

            $table->softDeletes();

            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('sub_menu_id')->references('id')->on('sub_menus');

            $table->unsignedBigInteger('created_by', false);
            $table->unsignedBigInteger('updated_by', false)->nullable();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_sub_menus',function (Blueprint $table){
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['sub_menu_id']);
        });


        Schema::dropIfExists('sub_sub_menus');
    }
}
