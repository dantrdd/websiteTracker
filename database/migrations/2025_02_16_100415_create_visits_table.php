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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('page_url');
            $table->string('ip_address');
            $table->text('user_agent');
            $table->string('session_id');
            $table->timestamp('visit_time')->useCurrent();
            $table->timestamps();

            $table->index('page_url');
            $table->index('visit_time');
            $table->index(['session_id', 'page_url', 'visit_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
