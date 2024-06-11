<?php

namespace App\Http\Controllers\Admin\Selector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\PhotoType;
use App\Models\Topic;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {

        $subjects = Subject::get();
        $grades = Grade::get();
        $topics = Topic::get();
        $photo_types = PhotoType::get();

        return Inertia::render('Admin/Selector/Index', [
            'subjects' => $subjects,
            'grades' => $grades,
            'topics' => $topics,
            'photo_types' => $photo_types
        ]);

    }
}
