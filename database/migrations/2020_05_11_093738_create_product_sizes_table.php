<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',500);
            $table->unsignedBigInteger('product_id');  
            $table->double('mrp', 10, 2)->default(0);
            $table->double('customer_price', 10, 2)->default(0);
            $table->double('customer_discount', 10, 2)->default(0)->comment('Discount is in Percentage');
            $table->double('retailer_price', 10, 2)->default(0);
            $table->double('retailer_discount', 10, 2)->default(0)->comment('Discount is in Percentage');
            $table->bigInteger('min_ord_quantity')->default(0)->comment('Minimum order Quantity is used for retailer for giving more discount');  
            $table->bigInteger('stock')->default(0);  
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
        Schema::dropIfExists('product_sizes');
    }
}
