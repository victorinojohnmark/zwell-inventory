<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbt_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('po_no');
            $table->string('transaction_code', 20);
            $table->string('requisition_slip_no', 20);
            $table->unsignedMediumInteger('contractor_id');
            $table->unsignedMediumInteger('supplier_id');
            $table->date('purchase_date');
            $table->decimal('purchase_cost', $precision = 15, $scale = 2)->nullable();
            $table->unsignedMediumInteger('prepared_by_id');
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
        Schema::dropIfExists('tbt_purchase_order');
    }
}
