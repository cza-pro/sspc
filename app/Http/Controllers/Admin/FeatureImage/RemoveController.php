<?php

namespace App\Http\Controllers\Admin\FeatureImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeatureImage;

class RemoveController extends Controller
{
    public function __invoke(FeatureImage $feature_image)
    {
        $feature_image->update([
            'public' => 'off'
        ]);

        return to_route('admin.feature_image.index')->with('toast', 'Feature Image Remove !');

    }
}
