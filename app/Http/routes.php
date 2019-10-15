<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use App\Photo;
use App\Staff;
//use Illuminate\Routing\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
   $staff = Staff::find(1);

   $staff->photos()->create(['path'=>'example.jpg']);
});

Route::get('/read', function () {
   $staff =  Staff::findOrFail(1);

    foreach ($staff->photos as $photo) {
        return $photo->path;
    }
});

Route::get('/update', function () {
   $staff = Staff::findOrFail(1);

   $photo = $staff->photos()->whereId(1)->first();

   $photo->path = "Update exemplaple.jpg";

   $photo->save();
});

Route::get('/delete', function () {
    $staff = Staff::find(1);

    $staff->photos()->whereId(2)->delete();
});

Route::get('/assign', function () {
   $staff =  Staff::findOrFail(1);

   $photo = Photo::findOrFail(3);

   $staff->photos()->save($photo);
});

Route::get('/un-assign', function () {
    $staff =  Staff::findOrFail(1);
    $staff->photos()->whereId(3)->update(['imageable_id'=>'', 'imageable_type'=>'']);
});