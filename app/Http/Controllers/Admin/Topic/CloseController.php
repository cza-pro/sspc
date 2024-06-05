<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;

class CloseController extends Controller
{
    public function __invoke(Request $request)
    {
        foreach($request->checkedTopic as $checktop) {

            $topic = Topic::where('id', $checktop)->first();

                $topic->update([
                    'available' => 'off'
                ]);

        }


    }
}
