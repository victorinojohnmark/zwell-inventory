<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbt_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code', 20)->nullable();
            $table->unsignedMediumInteger('purchase_order_id');
            $table->unsignedMediumInteger('supplier_id');
            $table->string('dr_no', 20);
            $table->date('delivery_date');
            $table->decimal('total_amount', $precision = 15, $scale = 2)->nullable();
            $table->string('recieved_by', 255);
            $table->boolean('complete_status')->default(false);
            $table->string('notes', 255);
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
        Schema::dropIfExists('tbt_deliveries');
    }
}
