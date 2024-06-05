<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureImage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'public', 'photo_url', 'photo_type', 'photo_format', 'photo_size'];

    protected $appends = ['feature_photo_url'];

    public function getFeaturePhotoUrlAttribute()
    {
        return url($this->photo_url);
    }
}
