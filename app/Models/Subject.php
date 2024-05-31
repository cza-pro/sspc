<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'available'];

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

}
