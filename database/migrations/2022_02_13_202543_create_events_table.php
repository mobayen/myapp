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

            $table->string('name', 64);
            $table->timestamp('date');
            $table->string('image');
            $table->string('hostname', 32);
            $table->string('location', 32);
            $table->string('place', 32);
            $table->integer('showorder');
            $table->enum('active', ['y', 'n']);
            $table->double('event_length_in_hours', 5, 2)->unsigned();
            $table->double('seat_cost', 5, 2);
            $table->integer('event_size')->unsigned();

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
