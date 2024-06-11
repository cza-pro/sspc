<?php

namespace App\Http\Controllers\Admin\PhotoType;

use Inertia\Inertia;
use App\Models\PhotoType;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $photo_typess = PhotoType::where('available', 'on')->get();

        return Inertia::render('Admin/PhotoType/Index', [
            'photo_typess' => $photo_typess
        ]);
    }
}
