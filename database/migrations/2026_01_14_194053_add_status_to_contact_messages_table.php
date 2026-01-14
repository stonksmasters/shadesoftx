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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('status')->default('unread'); // unread, read, replied, archived
            $table->text('admin_notes')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'admin_notes',
                'read_at',
                'assigned_to',
            ]);
        });
    }
};
