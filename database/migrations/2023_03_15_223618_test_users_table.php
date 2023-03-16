<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (!Schema::hasTable('test_user')) {
            Schema::create('test_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('goods_name');
                $table->string('goods_price');
                $table->string('goods_maker');
                $table->string('goods_count');
                $table->string('goods_image');
                $table->string('goods_comment');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_users');
    }
}
