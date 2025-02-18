<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'origin_url',
    ];

    public static function isWhiteListedByOrigin(string $origin_url): bool
    {
        return self::query()->where('origin_url', $origin_url)->exists();
    }
}