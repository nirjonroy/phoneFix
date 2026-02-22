<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'seo_title')) {
                $table->string('seo_title')->nullable();
            }
            if (!Schema::hasColumn('categories', 'seo_description')) {
                $table->text('seo_description')->nullable();
            }
            if (!Schema::hasColumn('categories', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('categories', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('categories', 'meta_image')) {
                $table->string('meta_image')->nullable();
            }
            if (!Schema::hasColumn('categories', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('categories', 'publisher')) {
                $table->string('publisher')->nullable();
            }
            if (!Schema::hasColumn('categories', 'copyright')) {
                $table->string('copyright')->nullable();
            }
            if (!Schema::hasColumn('categories', 'site_name')) {
                $table->string('site_name')->nullable();
            }
            if (!Schema::hasColumn('categories', 'keywords')) {
                $table->text('keywords')->nullable();
            }
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_categories', 'seo_title')) {
                $table->string('seo_title')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'seo_description')) {
                $table->text('seo_description')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'meta_image')) {
                $table->string('meta_image')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'publisher')) {
                $table->string('publisher')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'copyright')) {
                $table->string('copyright')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'site_name')) {
                $table->string('site_name')->nullable();
            }
            if (!Schema::hasColumn('sub_categories', 'keywords')) {
                $table->text('keywords')->nullable();
            }
        });

        Schema::table('child_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('child_categories', 'seo_title')) {
                $table->string('seo_title')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'seo_description')) {
                $table->text('seo_description')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'meta_image')) {
                $table->string('meta_image')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'publisher')) {
                $table->string('publisher')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'copyright')) {
                $table->string('copyright')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'site_name')) {
                $table->string('site_name')->nullable();
            }
            if (!Schema::hasColumn('child_categories', 'keywords')) {
                $table->text('keywords')->nullable();
            }
        });
    }

    public function down(): void
    {
        $categoryColumns = [];
        foreach (['seo_title','seo_description','meta_title','meta_description','meta_image','author','publisher','copyright','site_name','keywords'] as $col) {
            if (Schema::hasColumn('categories', $col)) {
                $categoryColumns[] = $col;
            }
        }
        if ($categoryColumns) {
            Schema::table('categories', function (Blueprint $table) use ($categoryColumns) {
                $table->dropColumn($categoryColumns);
            });
        }

        $subColumns = [];
        foreach (['seo_title','seo_description','meta_title','meta_description','meta_image','author','publisher','copyright','site_name','keywords'] as $col) {
            if (Schema::hasColumn('sub_categories', $col)) {
                $subColumns[] = $col;
            }
        }
        if ($subColumns) {
            Schema::table('sub_categories', function (Blueprint $table) use ($subColumns) {
                $table->dropColumn($subColumns);
            });
        }

        $childColumns = [];
        foreach (['seo_title','seo_description','meta_title','meta_description','meta_image','author','publisher','copyright','site_name','keywords'] as $col) {
            if (Schema::hasColumn('child_categories', $col)) {
                $childColumns[] = $col;
            }
        }
        if ($childColumns) {
            Schema::table('child_categories', function (Blueprint $table) use ($childColumns) {
                $table->dropColumn($childColumns);
            });
        }
    }
};
