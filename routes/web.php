<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

# for survey
use App\Http\Controllers\SurveyController;

# for calendar
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# show notes list 
Route::get('/notes', [PostController::class, 'show_list'] );

# creating page
Route::get('/notes/create', [PostController::class, 'create']);

# store inputs to table
Route::post('/notes', [PostController::class, 'store']);

# edit a note
# Don't use DI function. 
Route::get('/notes/{note_id}/edit', [PostController::class, 'edit']);
Route::put('/notes/{note}/', [PostController::class, 'update']);

# show a note
Route::get('/notes/{note}', [PostController::class, 'show']);


# show survey list 
Route::get('/survey', [SurveyController::class, 'show_list'] );

# jump to creating page of survey
Route::get('/survey/create', [SurveyController::class, 'create']);

# save url and others to 'surveys' table
Route::post('/survey', [SurveyController::class,'store']);

# show a survey detail
Route::get('/survey/{survey}', [SurveyController::class, 'show']);


# show a calender
Route::get('/calendar', [CalendarController::class, 'show']);

# register an event
Route::post('/calendar/schedule-add', [CalendarController::class, 'scheduleAdd'])->name('schedule-add');

# get an event info
Route::post('/calendar/schedule-get', [CalendarController::class, 'scheduleGet'])->name('schedule-get');

# edit an event period
Route::post('/calendar/schedule-edit-period', [CalendarController::class, 'scheduleEditPeriod'])->name('schedule-edit-period');

# delete an event
Route::delete('/calendar/schedule-delete', [CalendarController::class, 'scheduleDelete'])->name('schedule-delete');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
