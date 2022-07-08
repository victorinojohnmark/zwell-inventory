<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbtReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbt_releases', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code', 20)->nullable();
            $table->unsignedMediumInteger('location_id');
            $table->unsignedMediumInteger('company_id');
            $table->unsignedMediumInteger('contractor_id');
            $table->date('release_date');
            $table->unsignedMediumInteger('prepared_by_id')->nullable();
            $table->string('received_by', 20)->nullable();
            $table->string('notes', 255)->nullable();
            $table->boolean('complete_status')->default(false);
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
        Schema::dropIfExists('tbt_releases');
    }
}
