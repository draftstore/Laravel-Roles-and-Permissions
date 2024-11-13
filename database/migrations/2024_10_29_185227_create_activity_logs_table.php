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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who made the change
            $table->string('table_name'); // Name of the table modified
            $table->json('changed_columns')->nullable(); // Column name and changes (before & after values)
            $table->string('action'); // Type of action (created, updated, deleted)
            $table->timestamps(); // Created and updated at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
