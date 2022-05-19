<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->id();
            $table->string('zip_code')->nullable();
            $table->string('locality')->nullable();

            // $table->unsignedBigInteger('admin_user_id')->nullable();
            // $table->foreign('admin_user_id')->references('id')->on('admin_users');

            // $table->foreign('parent_id')->references('id')->on('federal_entities');
            
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
        Schema::dropIfExists('zip_codes');
    }
}
