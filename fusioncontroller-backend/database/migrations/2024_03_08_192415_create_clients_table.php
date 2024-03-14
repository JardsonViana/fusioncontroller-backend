<?php

use App\Models\Cpe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Colors\Rgb\Channels\Blue;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('userweb')->unique();
            $table->string('passweb');
            $table->string('uservpn')->unique();
            $table->string('passvpn');
            $table->string('state');
            $table->string('city');
            $table->boolean('is_blocked')->default(false);
            $table->foreignIdFor(Cpe::class)->nullable()->constrained('cpes')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpes', function(Blueprint $table){
            $table->dropForeignIdFor(Cpe::class);
        });
        Schema::dropIfExists('clients');
    }
};
