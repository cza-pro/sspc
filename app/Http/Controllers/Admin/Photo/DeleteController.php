<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class DeleteController extends Controller
{
    public function __invoke(Photo $photo)
    {
        $photo->delete();

        return to_route('admin.photo.index')->with('toast', 'Photo deleted !');

    }
}
