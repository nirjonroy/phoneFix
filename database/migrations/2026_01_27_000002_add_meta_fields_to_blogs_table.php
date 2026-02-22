<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'meta_image')) {
                $table->string('meta_image')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'publisher')) {
                $table->string('publisher')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'copyright')) {
                $table->string('copyright')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'site_name')) {
                $table->string('site_name')->nullable();
            }
            if (!Schema::hasColumn('blogs', 'keywords')) {
                $table->text('keywords')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('blogs', 'meta_title')) {
                $columns[] = 'meta_title';
            }
            if (Schema::hasColumn('blogs', 'meta_description')) {
                $columns[] = 'meta_description';
            }
            if (Schema::hasColumn('blogs', 'meta_image')) {
                $columns[] = 'meta_image';
            }
            if (Schema::hasColumn('blogs', 'author')) {
                $columns[] = 'author';
            }
            if (Schema::hasColumn('blogs', 'publisher')) {
                $columns[] = 'publisher';
            }
            if (Schema::hasColumn('blogs', 'copyright')) {
                $columns[] = 'copyright';
            }
            if (Schema::hasColumn('blogs', 'site_name')) {
                $columns[] = 'site_name';
            }
            if (Schema::hasColumn('blogs', 'keywords')) {
                $columns[] = 'keywords';
            }
            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
