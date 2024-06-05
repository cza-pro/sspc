<?php

namespace App\Http\Controllers\Admin\Grade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class CloseController extends Controller
{
    public function __invoke(Request $request)
    {
        foreach($request->checkedGrade as $checkgrad) {

            $grade = Grade::where('id', $checkgrad)->first();

                $grade->update([
                    'available' => 'off'
                ]);

        }


    }
}
