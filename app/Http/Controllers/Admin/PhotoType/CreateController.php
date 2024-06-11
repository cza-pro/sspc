<?php

namespace App\Http\Controllers\Admin\PhotoType;

use App\Models\PhotoType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoType\CreateRequest;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {

        PhotoType::create([
            'name' => $request->name
        ]);

        return to_route('admin.selector.index')->with('toast', 'Subject Created !');

    }
}
