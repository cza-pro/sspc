<?php

use App\Http\Controllers\Admin\Photo\IndexController as PhotoIndexController;
use App\Http\Controllers\Admin\Selector\IndexController as SelectorIndexController;
use App\Http\Controllers\Admin\Subject\CreateController as SubjectCreateController;
use App\Http\Controllers\Admin\Grade\CreateController as GradeCreateController;
use App\Http\Controllers\Admin\Topic\CreateController as TopicCreateController;
use App\Http\Controllers\Admin\Subject\CloseController as SubjectCloseController;
use App\Http\Controllers\User\Photo\IndexController;
use Illuminate\Support\Facades\Route;



Route::get('/', IndexController::class)->name('photo.index');


Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('admin/photo', PhotoIndexController::class)->name('admin.photo.index');

    Route::get('admin/selector', SelectorIndexController::class)->name('admin.selector.index');


    Route::post('admin/subject/create', SubjectCreateController::class)->name('admin.subject.create');
    Route::post('admin/grade/create', GradeCreateController::class)->name('admin.grade.create');
    Route::post('admin/topic/create', TopicCreateController::class)->name('admin.topic.create');

    Route::post('admin/subject/close', SubjectCloseController::class)->name('admin.subject.close');

});
