<?php

use App\Models\Equipament;
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
        Schema::create('cpes', function (Blueprint $table) {
            $table->id();
            $table->string('serialnumber');
            $table->foreignIdFor(Equipament::class)->references('id')->on('equipaments')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipaments', function(Blueprint $table) {
            $table->dropForeignIdFor(Equipament::class);
        });
        Schema::dropIfExists('cpes');
    }
};
