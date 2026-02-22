<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('google_analytics', function (Blueprint $table) {
            if (!Schema::hasColumn('google_analytics', 'analytic_script')) {
                $table->longText('analytic_script')->nullable()->after('analytic_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('google_analytics', function (Blueprint $table) {
            if (Schema::hasColumn('google_analytics', 'analytic_script')) {
                $table->dropColumn('analytic_script');
            }
        });
    }
};
