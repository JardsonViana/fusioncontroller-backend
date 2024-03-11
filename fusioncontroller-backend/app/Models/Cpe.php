<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpe extends Model
{
    use HasFactory;

    protected $fillable = [
        'serialnumber',
        'equipament_id',
    ];

    public function equipament() {
        return $this->belongsTo(Equipament::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
