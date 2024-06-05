<?php

namespace App\Http\Controllers\Admin\FeatureImage;

use App\Http\Controllers\Controller;
use App\Models\FeatureImage;
use Illuminate\Http\Request;
use App\Services\Image\ImageService;
use Illuminate\Support\Str;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {

        if($request->hasFile('feature_image')) {

            $feature_image = FeatureImage::create([
                'name' => $request->file('feature_image')->getClientOriginalName()
            ]);

            $category_image_path = ImageService::singleUpload($request->file('feature_image'), 'feature-image/'.Str::slug($request->name), 'public');
            $feature_image->update(['photo_url' => $category_image_path]);
        }

    }
}
