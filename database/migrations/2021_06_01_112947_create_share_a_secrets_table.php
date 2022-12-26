<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareASecretsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_a_secrets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->longText('text')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file')->nullable();
            $table->boolean('one_time_use')->default(false);
            $table->string('guest_email')->nullable();
            $table->boolean('two_factor_validation')->default(false);
            $table->boolean('login')->default(false);
            $table->integer('valid_till')->nullable();
            $table->integer('view_count')->default(0);
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
        Schema::dropIfExists('share_a_secrets');
    }
}
