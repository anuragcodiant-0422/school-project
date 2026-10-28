<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('parent_name');
            $table->string('student_name');
            $table->string('class_applying_for');
            $table->string('mobile', 10);
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->string('status', 20)->default('new')->index();
            $table->string('crm_status', 20)->default('pending')->index();
            $table->text('crm_response')->nullable();
            $table->timestamps();

            $table->index('mobile');
            $table->index(['mobile', 'class_applying_for', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_enquiries');
    }
};
