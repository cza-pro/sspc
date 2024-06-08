<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class RemoveController extends Controller
{
    public function __invoke(Photo $photo)
    {
        $photo->update([
            'public' => 'off'
        ]);

        return to_route('admin.photo.index')->with('toast', 'Photo Remove !');

    }
}
