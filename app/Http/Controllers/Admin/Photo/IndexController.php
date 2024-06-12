<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Photo;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\PhotoType;
use App\Models\Topic;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {

        $photos = Photo::query()
            ->when($request->filterSubject, function ($query, $filterSubject) {
                $query->whereIn('subject_id', $filterSubject);
            })
            ->when($request->filterGrade, function ($query, $filterGrade) {
                $query->whereIn('grade_id', $filterGrade);
            })
            ->when($request->filterTopic, function ($query, $filterTopic) {
                $query->whereIn('topic_id', $filterTopic);
            })
            ->when($request->filterPhotoType, function ($query, $filterPhotoType) {
                $query->whereIn('photo_type_id', $filterPhotoType);
            })
            ->with('grade', 'subject', 'topic', 'photoType')
            ->get();

        $subjectss = Subject::where('available', 'on')->get();
        $gradess = Grade::where('available', 'on')->get();
        $topicss = Topic::where('available', 'on')->get();
        $photo_typess = PhotoType::where('available', 'on')->get();

        return Inertia::render('Admin/Photo/Index', [
            'photos' => $photos,
            'subjectss' => $subjectss,
            'gradess' => $gradess,
            'topicss' => $topicss,
            'photo_typess' => $photo_typess
        ]);

    }
}
