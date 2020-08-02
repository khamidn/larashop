<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpanduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spanduks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique;
            $table->string('image');
            $table->string('creator');
            $table->string('category');
            $table->text('description');
            $table->enum('status', ['PUBLISH', 'DRAFT']);
            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spanduks');
    }
}
