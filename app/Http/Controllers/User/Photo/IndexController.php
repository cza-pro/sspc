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
                $query->whereIn('subject_id', $filterSubject);
            })
            ->when($request->filterGrade, function ($query, $filterGrade) {
                $query->whereIn('grade_id', $filterGrade);
            })
            ->when($request->filterTopic, function ($query, $filterTopic) {
                $query->whereIn('topic_id', $filterTopic);
            })
            ->when($request->filterName, function ($query, $filterName) {
                $query->whereIn('name', $filterName);
            })
            ->get();


        $subjects = Subject::where('available', 'on')->get();
        $grades = Grade::where('available', 'on')->get();
        $topics = Topic::where('available', 'on')->get();

        $photos = PhotoResource::collection($data);

        return Inertia::render('User/Photo/Index',[
            'photos' => $photos,
            'subjects' => $subjects,
            'grades' => $grades,
            'topics' => $topics,
            'filters' => $request->only(['filterSubject','filterGrade', 'filterTopic', 'filterName']),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')

        ]);

    }
}
