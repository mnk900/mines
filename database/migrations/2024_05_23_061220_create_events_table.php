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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('eventName');
            $table->text('eventDescription')->nullable();
            $table->date('eventDate');
            $table->time('eventTime')->nullable();
            $table->string('eventLocation')->nullable();
            $table->string('eventOrganizer')->nullable();
            $table->string('eventImage')->nullable();
            $table->string('eventImageThumbnail')->nullable();
            $table->string('eventURL')->nullable();
            $table->decimal('ticketPrice', 10, 2)->nullable();
            $table->integer('availableSeats')->nullable();
            $table->string('eventCategory')->nullable();
            $table->string('eventTags')->nullable();
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
        Schema::dropIfExists('events');
    }
};
