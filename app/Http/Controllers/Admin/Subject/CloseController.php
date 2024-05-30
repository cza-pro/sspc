<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class CloseController extends Controller
{
    public function __invoke(Request $request)
    {
        foreach($request->checkedSubject as $checksub) {

            $subject = Subject::where('id', $checksub)->first();

                $subject->update([
                    'available' => 'off'
                ]);

        }


    }
}
