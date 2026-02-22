<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('source_url');
            $table->string('destination_url')->nullable();
            $table->string('match_type')->default('exact'); // exact, starts_with
            $table->boolean('ignore_case')->default(true);
            $table->unsignedSmallInteger('redirect_type')->default(301); // 301,302,307,410,451
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redirects');
    }
};
