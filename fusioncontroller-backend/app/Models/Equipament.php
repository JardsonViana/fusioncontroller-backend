<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    use HasFactory;

    protected $fillable = [
        'hardware',
    ];

    public function cpe() {
        return $this->hasMany(Cpe::class);
    }
}
