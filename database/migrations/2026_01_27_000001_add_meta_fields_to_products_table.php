<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('products', 'meta_image')) {
                $table->string('meta_image')->nullable();
            }
            if (!Schema::hasColumn('products', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('products', 'publisher')) {
                $table->string('publisher')->nullable();
            }
            if (!Schema::hasColumn('products', 'copyright')) {
                $table->string('copyright')->nullable();
            }
            if (!Schema::hasColumn('products', 'site_name')) {
                $table->string('site_name')->nullable();
            }
            if (!Schema::hasColumn('products', 'keywords')) {
                $table->text('keywords')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('products', 'meta_title')) {
                $columns[] = 'meta_title';
            }
            if (Schema::hasColumn('products', 'meta_description')) {
                $columns[] = 'meta_description';
            }
            if (Schema::hasColumn('products', 'meta_image')) {
                $columns[] = 'meta_image';
            }
            if (Schema::hasColumn('products', 'author')) {
                $columns[] = 'author';
            }
            if (Schema::hasColumn('products', 'publisher')) {
                $columns[] = 'publisher';
            }
            if (Schema::hasColumn('products', 'copyright')) {
                $columns[] = 'copyright';
            }
            if (Schema::hasColumn('products', 'site_name')) {
                $columns[] = 'site_name';
            }
            if (Schema::hasColumn('products', 'keywords')) {
                $columns[] = 'keywords';
            }
            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
