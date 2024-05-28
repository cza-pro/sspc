<?php

namespace App\Http\Controllers\User\Photo;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Photo\PhotoResource;
use App\Models\Photo;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
       $data = Photo::paginate(10)
                ->withQueryString();;

        $photos = PhotoResource::collection($data);

            return Inertia::render('User/Photo/Index',[
               'photos' => $photos,
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register')

            ]);

    }
}
