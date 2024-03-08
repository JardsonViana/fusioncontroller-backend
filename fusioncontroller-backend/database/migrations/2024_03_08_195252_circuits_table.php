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
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->enum('protocol', ['pppoe', 'dhcp', 'static']);
            $table->string('userppp')->nullable();
            $table->string('passppp')->nullable();
            $table->string('ipclient')->nullable();
            $table->string('ipgateway')->nullable();
            $table->string('netmask')->nullable();
            $table->int('traffic')->nullable();
            $table->float('price')->nullable();
            $table->int('expiration')->nullable();
            $table->int('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circuits');
    }
};
