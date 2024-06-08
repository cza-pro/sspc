<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Photo $photo)
    {
        $photo->update([
            'name' => $request->name,
            'subject_id' => $request->subject_id,
            'grade_id' => $request->grade_id,
            'topic_id' => $request->topic_id
        ]);

        return to_route('admin.photo.index')->with('toast', 'Photo Update !');

    }
}
