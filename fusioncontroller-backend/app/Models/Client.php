<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'userweb',
        'passweb',
        'uservpn',
        'passvpn',
        'state',
        'city',
        'blocked',
        'cpe_id',
    ];

    public function cpe() {
        return $this->belongsTo(Cpe::class);
    }

    public function provider() {
        return $this->hasMany(Provider::class);
    }
}
