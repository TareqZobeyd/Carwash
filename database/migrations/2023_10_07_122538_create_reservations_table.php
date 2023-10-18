<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracking_code')->unique();
            $table->string('name');
            $table->string('service_type');
            $table->decimal('price')->nullable();
            $table->boolean('is_fastest');
            $table->dateTime('reservation_datetime')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('reservation_count')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
