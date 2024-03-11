<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocol',
        'userppp',
        'passppp',
        'ipclient',
        'ipgateway',
        'netmask',
        'traffic',
        'price',
        'expiration',
        'provider_id',
    ];

    public function provider() {
        return $this->belongsTo(Provider::class);
    }
}
