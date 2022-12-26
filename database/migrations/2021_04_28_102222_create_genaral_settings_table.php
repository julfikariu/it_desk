<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenaralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genaral_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_tag_line')->nullable();
            $table->string('site_sub_tag_line')->nullable();
            $table->string('author_name')->nullable();
            $table->string('footer_copy_right')->nullable();
            $table->string('og_meta_title')->nullable();
            $table->text('og_meta_description')->nullable();
            $table->string('og_meta_image')->nullable();
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
        Schema::dropIfExists('genaral_settings');
    }
}
