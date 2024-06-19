<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Photo $photo)
    {
        Storage::disk("public")->delete($photo->photo_url);
        $photo->delete();

        return to_route('admin.photo.index')->with('toast', 'Photo deleted !');

    }
}
