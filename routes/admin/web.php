<?php

use App\Http\Controllers\Admin\Photo\IndexController as PhotoIndexController;
use App\Http\Controllers\Admin\Photo\CreateController as PhotoCreateController;
use App\Http\Controllers\Admin\Photo\DeleteController as PhotoDeleteController;
use App\Http\Controllers\Admin\Photo\UpdateController as PhotoUpdateController;
use App\Http\Controllers\Admin\Photo\RemoveController as PhotoRemoveController;
use App\Http\Controllers\Admin\Selector\IndexController as SelectorIndexController;
use App\Http\Controllers\Admin\Subject\CreateController as SubjectCreateController;
use App\Http\Controllers\Admin\Grade\CreateController as GradeCreateController;
use App\Http\Controllers\Admin\Topic\CreateController as TopicCreateController;
use App\Http\Controllers\Admin\Subject\CloseController as SubjectCloseController;
use App\Http\Controllers\Admin\Grade\CloseController as GradeCloseController;
use App\Http\Controllers\Admin\Topic\CloseController as TopicCloseController;
use App\Http\Controllers\Admin\FeatureImage\IndexController as FeatureImageIndexController;
use App\Http\Controllers\Admin\FeatureImage\CreateController as FeatureImageCreateController;
use App\Http\Controllers\Admin\FeatureImage\RemoveController as FeatureImageRemoveController;
use App\Http\Controllers\Admin\FeatureImage\DeleteController as FeatureImageDeleteController;
use App\Http\Controllers\User\Photo\IndexController;
use Illuminate\Support\Facades\Route;



Route::get('/', IndexController::class)->name('photo.index');


Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('admin/photo', PhotoIndexController::class)->name('admin.photo.index');
    Route::post('admin/photo/create', PhotoCreateController::class)->name('admin.photo.create');
    Route::delete('admin/photo/delete/{photo}', PhotoDeleteController::class)->name('admin.photo.delete');
    Route::post('admin/photo/update/{photo}', PhotoUpdateController::class)->name('admin.photo.update');
    Route::post('admin/photo/remove/{photo}', PhotoRemoveController::class)->name('admin.photo.remove');

    Route::get('admin/selector', SelectorIndexController::class)->name('admin.selector.index');


    Route::post('admin/subject/create', SubjectCreateController::class)->name('admin.subject.create');
    Route::post('admin/grade/create', GradeCreateController::class)->name('admin.grade.create');
    Route::post('admin/topic/create', TopicCreateController::class)->name('admin.topic.create');

    Route::post('admin/subject/close', SubjectCloseController::class)->name('admin.subject.close');
    Route::post('admin/grade/close', GradeCloseController::class)->name('admin.grade.close');
    Route::post('admin/topic/close', TopicCloseController::class)->name('admin.topic.close');


    Route::get('admin/feature-image', FeatureImageIndexController::class)->name('admin.feature_image.index');
    Route::post('admin/feature-image/create', FeatureImageCreateController::class)->name('admin.feature_image.create');
    Route::post('admin/feature-image/remove/{feature_image}', FeatureImageRemoveController::class)->name('admin.feature_image.remove');
    Route::delete('admin/feature-image/delete/{feature_image}', FeatureImageDeleteController::class)->name('admin.feature_image.delete');

});
