<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbt_purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('purchase_order_id');
            $table->unsignedMediumInteger('item_id');
            $table->decimal('quantity', $precision = 15, $scale = 2);
            $table->decimal('unit_cost', $precision = 15, $scale = 2);
            $table->decimal('total_amount', $precision = 15, $scale = 2)->nullable();
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
        Schema::dropIfExists('tbt_purchase_order_details');
    }
}
