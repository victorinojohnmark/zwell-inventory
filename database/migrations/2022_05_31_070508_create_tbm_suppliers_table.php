<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbmSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbm_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name', 255)->unique();
            $table->string('supplier_code', 50)->unique();
            $table->string('contact_person', 50);
            $table->string('contact_no', 50);
            $table->string('email', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('notes', 255)->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('tbm_suppliers');
    }
}
