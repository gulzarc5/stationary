<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',256);
            $table->string('slug',256);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('level')->nullable();
            $table->char('status', 1)->default(1)->comment('1 = Activated, 2 = deactivated');
            $table->string('image',256);
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
        Schema::dropIfExists('categories');
    }
}
