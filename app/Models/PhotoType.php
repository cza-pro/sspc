<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'available'];

    public function photo()
    {
        return $this->HasMany(Photo::class);
    }

}
