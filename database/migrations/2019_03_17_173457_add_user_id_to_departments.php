<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        //add the extra column name
        Schema::table('departments',function($table){
            $table->integer('added_by_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //drop the extra column name
          Schema::table('departments',function($table){
            $table->dropColumn('added_by_id');
        });
    }
}
