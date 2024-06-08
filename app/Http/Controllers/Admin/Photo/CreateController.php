<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\CreateRequest;
use App\Models\Photo;
use App\Services\Image\ImageService;
use Illuminate\Support\Str;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {

        if($request->hasFile('photo_url')) {

            $photo = Photo::create([
                'name' => $request->name,
                'generate_number' => mt_rand(100000000000, 999999999999),
                'subject_id' => $request->subject_id,
                'grade_id' => $request->grade_id,
                'topic_id' => $request->topic_id,
                'photo_format' => $request->file('photo_url')->getClientOriginalExtension(),
                'photo_size' => getimagesize($request->file('photo_url'))[0] . 'x'. getimagesize($request->file('photo_url'))[1]
            ]);

            $photo_url = ImageService::singleUpload($request->file('photo_url'), 'photo/'.Str::slug($request->name), 'public');
            $photo->update(['photo_url' => $photo_url]);
        }


        return to_route('admin.photo.index')->with('toast', 'Photo Create !');

    }
}
