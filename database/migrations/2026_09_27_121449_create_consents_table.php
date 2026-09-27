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
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['terms', 'pd_processing', 'pd_distribution', 'cookies', 'age_confirmation']);
            $table->string('document_version', 20);
            $table->json('fields')->nullable();
            $table->string('ip', 45);
            $table->string('user_agent', 255);
            $table->timestamp('given_at');
            $table->timestamp('withdrawn_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consents');
    }
};
