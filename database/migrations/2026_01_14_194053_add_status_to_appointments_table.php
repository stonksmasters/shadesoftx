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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled, no_show
            $table->text('admin_notes')->nullable();
            $table->string('source_page')->nullable();
            $table->decimal('quote_amount', 10, 2)->nullable();
            $table->decimal('sale_amount', 10, 2)->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'admin_notes',
                'source_page',
                'quote_amount',
                'sale_amount',
                'assigned_to',
                'confirmed_at',
                'completed_at',
            ]);
        });
    }
};
