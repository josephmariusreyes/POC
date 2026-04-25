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
        Schema::create('customers', function(Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                  ->constrained('events')
                  ->cascadeOnDelete();    

            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->timestamps();
            $table->timestamp('accepted_on');
            $table->timestamp('ended_on');
            $table->integer('que_number');

            $table->foreignId('customer_status')
                  ->constrained('lookup.customer_status', 'value')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
