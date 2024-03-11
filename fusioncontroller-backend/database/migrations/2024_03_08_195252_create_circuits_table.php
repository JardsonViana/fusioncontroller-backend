<?php

use App\Models\Provider;
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
            $table->integer('traffic')->nullable();
            $table->float('price')->nullable();
            $table->integer('expiration')->nullable();
            $table->foreignIdFor(Provider::class)->references('id')->on('providers')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function(Blueprint $table) {
            $table->dropForeignIdFor(Provider::class);
        });
        Schema::dropIfExists('circuits');
    }
};
