<?php

namespace App\Http\Controllers\Admin\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\CreateRequest;
use Illuminate\Http\Request;
use App\Models\Grade;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        Grade::create([
            'name' => $request->name
        ]);

        return to_route('admin.selector.index')->with('toast', 'Grade Created !');

    }
}
