<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HealthCareController;
use App\Http\Controllers\RecordingsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\MedicalPostsController;
use App\Http\Controllers\TrafficPostsController;
use App\Http\Controllers\SpecializationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(MainController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('health-center/{healthCenterId}','center')->name('center');
    Route::get('contact-us','contactus')->name('contact-us');
    Route::post('contact-us/store','contactStore')->name('contact-us.store');
    Route::get('all-doctors','doctor')->name('all.doctors');
    Route::get('{trafficPostId}/traffic-post','trafficPost')->name('trafficPost');
    Route::get('{medicalPostId}/medical-post','medicalPost')->name('medicalPost');
    Route::get('all-traffic-posts','trafficPosts')->name('all.traffic.posts');
    Route::get('all-medical-posts','medicalPosts')->name('all.medical.posts');
});



Route::middleware('auth')->group(function () {

    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::name('traffic.posts.')->prefix('traffic/posts')->controller(TrafficPostsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/show', 'show')->name('show');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getTrafficPostsData')->name('getTrafficPostsData');
    });

    Route::name('medical.posts.')->prefix('medical/posts')->controller(MedicalPostsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/show', 'show')->name('show');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getMedicalPostsData')->name('getMedicalPostsData');
    });

    Route::name('recordings.')->prefix('recordings')->controller(RecordingsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/show', 'show')->name('show');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getRecordingData')->name('getRecordingData');
    });

    Route::name('appointments.')->prefix('appointments')->controller(AppointmentsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/show', 'show')->name('show');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getAppointmentsData')->name('getAppointmentsData');
        Route::post('change/status','changeStatus')->name('changeStatus');
    });


    Route::name('specialization.')->prefix('specialization')->controller(SpecializationsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getSpecializationData')->name('getSpecializationData');
        Route::get('fetchSpecialization','fetchSpecialization')->name('fetchSpecialization');
    });

    Route::name('doctors.')->prefix('doctors')->controller(DoctorController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getDoctorData')->name('getDoctorData');
        Route::get('doctor/fetch/specialization','fetchDoctorWithSpecialization')->name('fetch.withspecialization');
    });

    Route::name('healthcare.')->prefix('healthcare')->controller(HealthCareController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
        Route::get('data','getHealthCareData')->name('getHealthCareData');
        Route::get('/doctor/specialization','fetchDoctorUsingSpecialization')->name('doctor.specialization');
    });

    Route::name('usertype.')->prefix('usertype')->controller(UserTypeController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('data','getUserTypeData')->name('getUserTypeData');
        Route::get('/permisions/{id}/edit','edit')->name('permissions.edit');
        Route::post('/permisions/{id}/update','update')->name('permissions.update');
    });

    Route::name('users.')->prefix('users')->controller(UserController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getUserData')->name('getUserData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('theme/change/{theme}',[ThemeController::class,'changeTheme'])->name('theme.change');

});

require __DIR__.'/auth.php';
