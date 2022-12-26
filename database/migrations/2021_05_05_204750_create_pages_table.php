<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->longText('page_content')->nullable();
            $table->string('slug');
            $table->boolean('status')->default(true)->comment('1=true 0=false');
            $table->longText('key_words')->nullable();
            $table->boolean('delete_able')->default(true)->comment('1=true 0=false');
            $table->boolean('menu_location')->default(false)->comment('1=main menu, 0=footer menu');
            $table->boolean('on_page_menu')->default(true)->comment('1=true 0=false');
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
        Schema::dropIfExists('pages');
    }
}
