<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('response_actions', function (Blueprint $table) {
            $table->id();
            $table->string('alert_signature')->index();
            $table->string('rule_id')->nullable();
            $table->string('rule_description')->nullable();
            $table->string('source_ip')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('action')->default('block_ip');
            $table->string('status')->default('pending');
            $table->timestamp('executed_at')->nullable();
            $table->foreignId('executed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('response_actions');
    }
};
