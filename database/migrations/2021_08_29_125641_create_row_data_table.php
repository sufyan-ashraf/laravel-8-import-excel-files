<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('row_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_row_id');
            // $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->foreign('file_row_id')->references('id')->on('file_rows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('row_data');
    }
}
