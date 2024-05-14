<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gif_favourites', function (Blueprint $table) {
            $table->integer('id', 100)->primary()->autoIncrement();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('gif_id')->nullable(false);
            $table->string('alias')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gif_favourites');
    }
};
