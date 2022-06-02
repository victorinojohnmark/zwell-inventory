<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbmItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbm_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 255)->unique();
            $table->string('item_code', 50)->nullable()->unique();
            $table->string('description', 255)->nullable();
            $table->string('unit', 30);
            $table->unsignedMediumInteger('minimum_stock_qty');
            $table->string('notes', 255)->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('tbm_items');
    }
}
