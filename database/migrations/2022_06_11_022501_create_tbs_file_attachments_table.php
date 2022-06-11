<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbsFileAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbs_file_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type', 20);
            $table->unsignedMediumInteger('transaction_id');
            $table->unsignedMediumInteger('prepared_by_id');
            $table->string('folder_name');
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
        Schema::dropIfExists('tbs_file_attachments');
    }
}
