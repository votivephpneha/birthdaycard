<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gift_gallery_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'gift_id',
        'gift_gall_images',
    ];
}
