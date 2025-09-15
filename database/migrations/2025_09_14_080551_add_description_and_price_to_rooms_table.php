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
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'description')) {
                $table->string('description')->nullable();
            }

            if (!Schema::hasColumn('rooms', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['description', 'price']);
        });
    }

};