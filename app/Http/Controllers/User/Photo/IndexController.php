<?php

namespace App\Http\Controllers\User\Photo;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
       $data = Post::paginate(10)
                ->withQueryString();;

        $posts = PostResource::collection($data);

            return Inertia::render('User/Photo/Index',[
               'posts' => $posts
            ]);

    }
}
