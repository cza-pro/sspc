<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\CreateRequest;
use Illuminate\Http\Request;
use App\Models\Subject;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {

        Subject::create([
            'name' => $request->name
        ]);

        return to_route('admin.selector.index')->with('toast', 'Subject Created !');

    }


}
