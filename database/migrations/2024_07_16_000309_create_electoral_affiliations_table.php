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
        Schema::create('electoral_affiliations', function (Blueprint $table) {
            $table->id();
            $table->string("electoral_number");
            $table->string('electoral_zone');
            $table->string('polling_station');
            $table->foreignId('partie_id')->constrained('parties')->onDelete('cascade');
            $table->string('candidate_registration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electoral_affiliations');
    }
};