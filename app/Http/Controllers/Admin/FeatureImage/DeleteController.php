<?php

namespace App\Http\Controllers\Admin\FeatureImage;

use App\Models\FeatureImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(FeatureImage $feature_image)
    {
        Storage::disk("public")->delete($feature_image->photo_url);
        $feature_image->delete();

        return to_route('admin.feature_image.index')->with('toast', 'Feature Image deleted !');

    }
}
