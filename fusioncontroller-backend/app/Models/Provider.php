<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Geometry\Circle;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'phone',
        'client_id',
    ];

    public function client() {
        return $this->hasMany(Client::class);
    }

    public function circuit() {
        return $this->hasMany(Circuit::class);
    }
}
