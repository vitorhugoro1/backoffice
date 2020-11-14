<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'int',
        'start_at' => 'date:Y-m-d',
        'expiration_at' => 'date:Y-m-d'
    ];
}
