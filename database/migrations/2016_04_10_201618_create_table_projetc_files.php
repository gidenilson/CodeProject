<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjetcFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id', false, true);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('original_file');
            $table->string('storage_file');
            $table->string('extension');
            $table->string('mime');
            $table->integer('size', false, true);
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
        Schema::drop('project_files');
    }
}
