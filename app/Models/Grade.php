<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Photo;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'available'];

    public function photo()
    {
        return $this->HasMany(Photo::class);
    }

}
