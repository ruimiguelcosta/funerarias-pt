<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $hasColumn = Schema::hasColumn('post_ideas', 'tenant_id');

        if (! $hasColumn) {
            Schema::table('post_ideas', function (Blueprint $table) {
                $table->foreignId('tenant_id')->nullable()->after('id');
            });
        }

        $firstTenant = DB::table('tenants')->first();
        if ($firstTenant) {
            DB::table('post_ideas')
                ->where(function ($query) {
                    $query->whereNull('tenant_id')
                        ->orWhere('tenant_id', 0);
                })
                ->update(['tenant_id' => $firstTenant->id]);
        }

        Schema::table('post_ideas', function (Blueprint $table) use ($hasColumn) {
            if (! $hasColumn) {
                $table->foreignId('tenant_id')->nullable(false)->change();
            }
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('post_ideas', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};
