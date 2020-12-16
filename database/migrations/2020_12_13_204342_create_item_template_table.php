<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_template', function (Blueprint $table) {
            $table->id();

            $table->foreignId('template_id')->unsigned();
            $table->foreignId('item_id')->unsigned();

            $table->integer('sorting')->default(0);

            $table->unique(['template_id', 'item_id']);

            $table->foreign('template_id')->references('id')->on('templates')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_template');
    }
}
