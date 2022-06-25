<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbt_delivery_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('delivery_id');
            $table->unsignedMediumInteger('item_id');
            $table->unsignedMediumInteger('purchase_order_detail_id');
            $table->decimal('quantity', $precision = 15, $scale = 2);
            $table->decimal('unit_price', $precision = 15, $scale = 2);
            $table->string('notes', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbt_delivery_details');
    }
}
