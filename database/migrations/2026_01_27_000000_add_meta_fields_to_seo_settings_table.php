<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('seo_settings', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('seo_description');
            }
            if (!Schema::hasColumn('seo_settings', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('seo_settings', 'meta_image')) {
                $table->string('meta_image')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('seo_settings', 'author')) {
                $table->string('author')->nullable()->after('meta_image');
            }
            if (!Schema::hasColumn('seo_settings', 'publisher')) {
                $table->string('publisher')->nullable()->after('author');
            }
            if (!Schema::hasColumn('seo_settings', 'copyright')) {
                $table->string('copyright')->nullable()->after('publisher');
            }
            if (!Schema::hasColumn('seo_settings', 'site_name')) {
                $table->string('site_name')->nullable()->after('copyright');
            }
            if (!Schema::hasColumn('seo_settings', 'keywords')) {
                $table->text('keywords')->nullable()->after('site_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('seo_settings', 'meta_title')) {
                $columns[] = 'meta_title';
            }
            if (Schema::hasColumn('seo_settings', 'meta_description')) {
                $columns[] = 'meta_description';
            }
            if (Schema::hasColumn('seo_settings', 'meta_image')) {
                $columns[] = 'meta_image';
            }
            if (Schema::hasColumn('seo_settings', 'author')) {
                $columns[] = 'author';
            }
            if (Schema::hasColumn('seo_settings', 'publisher')) {
                $columns[] = 'publisher';
            }
            if (Schema::hasColumn('seo_settings', 'copyright')) {
                $columns[] = 'copyright';
            }
            if (Schema::hasColumn('seo_settings', 'site_name')) {
                $columns[] = 'site_name';
            }
            if (Schema::hasColumn('seo_settings', 'keywords')) {
                $columns[] = 'keywords';
            }
            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
