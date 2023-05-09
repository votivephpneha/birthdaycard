<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_type',
        'card_size',       
    ];
}
