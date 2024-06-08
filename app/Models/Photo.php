<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Topic;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'generate_number','subject_id', 'grade_id', 'topic_id','public', 'photo_url', 'photo_type', 'photo_format', 'photo_size'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    protected $appends = ['upload_photo_url'];

    public function getUploadPhotoUrlAttribute()
    {
        return url($this->photo_url);
    }

}
