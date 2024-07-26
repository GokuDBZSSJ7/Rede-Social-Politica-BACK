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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('education');
            $table->text('experience');
            $table->foreignId('position_id')->constrained('positions')->onDelete('cascade');
            $table->foreignId('party_id')->constrained('parties')->onDelete('cascade');
            $table->string('electoral_affiliation')->nullable();
            $table->string('electoral_number')->nullable();
            $table->string('status')->default('pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};