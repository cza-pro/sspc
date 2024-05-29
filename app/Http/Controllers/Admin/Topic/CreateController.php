<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Topic\CreateRequest;
use App\Models\Topic;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {

        Topic::create([
            'name' => $request->name
        ]);

        return to_route('admin.selector.index')->with('toast', 'Topic Created !');

    }
}
