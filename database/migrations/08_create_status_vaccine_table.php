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
        Schema::create('status_vaccine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccine_id')->constrained('vaccines');
            $table->foreignId('spot_id')->constrained('spots');
            $table->enum('Sinovac', ['true', 'false']);
            $table->enum('AstraZeneca', ['true', 'false']);
            $table->enum('Moderna', ['true', 'false']);
            $table->enum('Pfizer', ['true', 'false']);
            $table->enum('Sinnopharm', ['true', 'false']);
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
        Schema::dropIfExists('status_vaccine');
    }
};
