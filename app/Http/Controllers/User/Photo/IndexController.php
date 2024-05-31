<?php

namespace App\Http\Controllers\User\Photo;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Photo\PhotoResource;
use App\Models\Photo;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Topic;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {

        $data = Photo::query()
            ->when($request->filterSubject, function ($query, $filterSubject) {
                $query->where('subject_id', $filterSubject);
            })
            ->when($request->filterGrade, function ($query, $filterGrade) {
                $query->where('grade_id', $filterGrade);
            })
            ->when($request->filterTopic, function ($query, $filterTopic) {
                $query->where('topic_id', $filterTopic);
            })
            ->get();


        $subjects = Subject::get();
        $grades = Grade::get();
        $topics = Topic::get();

        $photos = PhotoResource::collection($data);

        return Inertia::render('User/Photo/Index',[
            'photos' => $photos,
            'subjects' => $subjects,
            'grades' => $grades,
            'topics' => $topics,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')

        ]);

    }
}
