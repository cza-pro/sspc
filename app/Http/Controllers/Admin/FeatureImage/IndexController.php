<?php

namespace App\Http\Controllers\Admin\FeatureImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeatureImage;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {

        $feature_images = FeatureImage::get();

        return Inertia::render('Admin/FeatureImage/Index', [
            'feature_images' => $feature_images
        ]);
    }
}
