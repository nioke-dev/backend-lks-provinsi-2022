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
        Schema::create('societies', function (Blueprint $table) {
            $table->id();
            $table->integer('id_card_number');
            $table->string('password');
            $table->string('name');
            $table->date('born_date');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->foreignId('regional_id')->constrained('regionals');
            $table->text('login_tokens');
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
        Schema::dropIfExists('societies');
    }
};
