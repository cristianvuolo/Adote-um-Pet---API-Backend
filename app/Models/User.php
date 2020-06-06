<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @method static create(array $all)
 */
class User extends Authenticatable implements HasMedia
{
    use HasMediaTrait;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'latitude',
        'longitude',
        'city',
        'uf',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_clients_pivot');
    }
}
