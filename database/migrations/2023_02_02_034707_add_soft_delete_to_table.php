<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function tables()
    {
        return [
            'users',
        ];
    }

    public function up()
    {
        $tables = $this->tables();
        if(isset($tables[0])){
            foreach($tables as $key => $table_name){
                Schema::table($table_name, function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
        }

    }

    public function down()
    {
        $tables = $this->tables();
        if(isset($tables[0])){
            foreach($tables as $key => $table_name){
                Schema::table($table_name, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
            }
        }
    }
}
