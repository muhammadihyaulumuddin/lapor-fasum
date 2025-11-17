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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            // $table->string('report_code')->unique();
            // $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            // $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('photo')->nullable();
            $table->string('contact');
            $table->enum('status', ['terkirim', 'diproses', 'selesai'])->default('terkirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
};
