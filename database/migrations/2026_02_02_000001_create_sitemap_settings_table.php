<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sitemap_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('include_home')->default(true);
            $table->boolean('include_services_page')->default(true);
            $table->boolean('include_categories')->default(true);
            $table->boolean('include_sub_categories')->default(true);
            $table->boolean('include_child_categories')->default(true);
            $table->boolean('include_products')->default(true);
            $table->boolean('include_blogs')->default(true);
            $table->boolean('include_pages')->default(true);
            $table->boolean('include_manual')->default(true);
            $table->string('default_changefreq')->nullable()->default('weekly');
            $table->decimal('default_priority', 2, 1)->nullable()->default(0.7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sitemap_settings');
    }
};
