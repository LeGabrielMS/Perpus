<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('borrow_books', function (Blueprint $table) {
            $table->date('borrow_date')->nullable();
            $table->date('return_date')->nullable();
            $table->date('actual_return_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_books', function (Blueprint $table) {
            $table->dropColumn(['borrow_date', 'return_date', 'actual_return_date']);
        });
    }
};
