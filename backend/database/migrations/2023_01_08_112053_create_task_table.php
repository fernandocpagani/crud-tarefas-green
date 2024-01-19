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
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('description'); 
            $table->date('finishdate'); 
            $table->enum('status', ['pending','completed']); 
            $table->timestamps();
            $table->integer('users_id')->unsigned()->index()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
