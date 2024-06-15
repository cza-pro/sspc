<?php

namespace App\Http\Controllers\Admin\FeatureImage;

use Illuminate\Support\Str;
use App\Models\FeatureImage;
use App\Http\Controllers\Controller;
use App\Services\Image\ImageService;
use App\Http\Requests\FeatureImage\CreateRequest;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {

        if($request->hasFile('feature_image')) {

            $feature_image = FeatureImage::create([
                'name' => $request->file('feature_image')->getClientOriginalName(),
                'photo_format' => $request->file('feature_image')->getClientOriginalExtension(),
                'photo_size' => getimagesize($request->file('feature_image'))[0] . 'x'. getimagesize($request->file('feature_image'))[1]
            ]);

            $feature_image_path = ImageService::singleUpload($request->file('feature_image'), 'feature-image'.Str::slug($request->name), 'public');
            $feature_image->update(['photo_url' => $feature_image_path]);
        }


        return to_route('admin.feature_image.index')->with('toast', 'Feature Image Create !');

    }
}
