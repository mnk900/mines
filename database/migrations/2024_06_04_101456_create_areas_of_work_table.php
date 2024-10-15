<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas_of_work', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('tags');
            $table->string('theme_image');
            $table->string('theme_image_thumbnail');
            $table->string('link')->unique();
            $table->integer('user_id');
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
        Schema::dropIfExists('areas_of_work');
    }
};
