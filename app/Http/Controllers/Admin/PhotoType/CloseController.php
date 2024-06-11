<?php

namespace App\Http\Controllers\Admin\PhotoType;

use App\Http\Controllers\Controller;
use App\Models\PhotoType;
use Illuminate\Http\Request;

class CloseController extends Controller
{
    public function __invoke(Request $request)
    {
        foreach($request->checkedPhotoType as $checktype) {

            $photo_type = PhotoType::where('id', $checktype)->first();

                $photo_type->update([
                    'available' => 'off'
                ]);

        }


    }
}
