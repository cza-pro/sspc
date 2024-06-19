<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\ImportRequest;
use App\Imports\PhotoImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public function __invoke(ImportRequest $request)
    {
        if($request->file('import_file')) {
            Excel::import(new PhotoImport(), $request->file('import_file'));
         }
    }
}
