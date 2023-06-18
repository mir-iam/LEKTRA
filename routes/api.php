<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ChildParentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ImageController;

use App\Models\ChildParent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return $request->user();
   // Route::get('/appointment', [AppointmentController::class, 'index']) 
});




//////////////doctor///////////////
 
Route::group(['prefix'=>'doctor'], function($router){
   Route::post('/login' ,[DoctorController::class,'login']);
   Route::post('/register' ,[DoctorController::class,'register']);
});

Route::group(['middleware'=>'jwt.role:doctor','jwt.auth' ,'prefix'=>'doctor'], function($router){
    Route::post('/logout' ,[DoctorController::class,'logout']);
    Route::get('/user-profile' ,[DoctorController::class,'userProfile']);
    Route::post('/update', [DoctorController::class, 'update']); 

    Route::get('/reports', [ReportController::class, 'index']); // all reports
    Route::post('/reports', [ReportController::class, 'store']); // create report
    Route::get('/reports/{report_id}', [ReportController::class, 'show']); // get single report
    Route::put('/reports/{report_id}', [ReportController::class, 'update']); // update report
    Route::delete('/reports/{report_id}', [ReportController::class, 'destroy']); // delete report


    //images

    Route::get('/reports/{report_id}/images', [ImageController::class, 'index']); // all images of a report
    Route::get('/images/{doctor_id}', [ImageController::class, 'show']); // get single image
    Route::post('/AddImage', [ImageController::class, 'store']); // create image in a report
    Route::put('/images/{image_id}', [ImageController::class, 'update']); // update a image
    Route::delete('/images/{image_id}', [ImageController::class, 'destroy']); // delete a image

   // posts

    Route::get('/posts', [PostController::class, 'index_1']); // all posts
    Route::post('/posts', [PostController::class, 'store_1']); // create post
    Route::get('/posts/{post_id}', [PostController::class, 'show_1']); // get single post
    Route::put('/posts/{post_id}', [PostController::class, 'update_1']); // update post
    Route::delete('/posts/{post_id}', [PostController::class, 'destroy_1']); // delete post
    
    
    // Comment
     Route::get('/posts/{post_id}/comments', [CommentController::class, 'index_1']); // all comments of a post
     Route::post('/AddComment', [CommentController::class, 'store_1']); // create comment on a post
     Route::put('/comments/{comment_id}', [CommentController::class, 'update_1']); // update a comment
     Route::delete('/comments/{comment_id}', [CommentController::class, 'destroy_1']); // delete a comment
  
    //reply
     Route::get('/comments/{comment_id}/replies', [ReplyController::class, 'index_1']); // all replies on a comment
     Route::post("AddReply",[ReplyController::class, 'store_1']); // create a reply on a comment
     Route::put('/replies/{reply_id}', [ReplyController::class, 'update_1']); // update a reply
     Route::delete('/replies/{reply_id}', [ReplyController::class, 'destroy_1']); // delete a reply

     // Like
     Route::post('AddLike', [LikeController::class, 'likeOrUnlike_1']); // like or dislike back a post

     // doctor appointments
 Route::post('/appointments',[AppointmentController::class, 'store_1']); // create an appointment
 Route::get('/appointments',[AppointmentController::class,'index_1']); //retreive all appointments
 Route::get('/appointments/{appointment_id}',[AppointmentController::class,'show_1']); //retrieve a specific appointment
 Route::put('/appointments/{appointment_id}',[AppointmentController::class,'update_1']); //update (delay) an appointments
 Route::delete('/appointments/{appointment_id}',[AppointmentController::class,'destroy_1']); //delete (cancel) an appointments
 });

 



////////parent/////////


 Route::group(['prefix'=>'ChildParent'], function($router){
    Route::post('/login' ,[ChildParentController::class,'login']);
    Route::post('/register' ,[ChildParentController::class,'register']);
    
 });

 Route::group(['middleware'=>'jwt.role:ChildParent','jwt.auth' ,'prefix'=>'ChildParent'], function($router){
    Route::post('/logout' ,[ChildParentController::class,'logout']);
    Route::get('/user-profile' ,[ChildParentController::class,'userProfile']);
    Route::get('/hospitals' ,[HospitalController::class,'index']);// all hospitals
    Route::post('/hospitals' ,[HospitalController::class,'store']);// create hospital
    Route::delete('/hospitals/{hospital_id}' ,[HospitalController::class,'destroy']);// delete a hospital
    Route::get('/hospitals/{hospital_id}', [HospitalController::class, 'show']); // get single hospital
    Route::put('/hospitals/{hospital_id}', [HospitalController::class, 'update']); // update hospital
    Route::get('/reports/{report_id}', [ReportController::class, 'show_1']); // get single report

    Route::post('/update', [ChildParentController::class, 'update']); 



    Route::get('/posts', [PostController::class, 'index']); // all posts
    Route::post('/posts', [PostController::class, 'store']); // create post
    Route::get('/posts/{child_parent_id}', [PostController::class, 'show']); // get single post
    Route::put('/posts/{post_id}', [PostController::class, 'update']); // update post
    Route::delete('/posts/{post_id}', [PostController::class, 'destroy']); // delete post
 
    // Comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
    Route::post('/AddComment', [CommentController::class, 'store']); // create comment on a post
    Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment
 
   //reply
    Route::get('/comments/{id}/replies', [ReplyController::class, 'index']); // all replies on a comment
    Route::post("AddReply",[ReplyController::class, 'store']); // create a reply on a comment
    Route::put('/replies/{id}', [ReplyController::class, 'update']); // update a reply
    Route::delete('/replies/{id}', [ReplyController::class, 'destroy']); // delete a reply

    // Like
    Route::post('AddLike', [LikeController::class, 'likeOrUnlike']); // like or dislike back a post

// parent appointments
//Route::post('/appointments',[AppointmentController::class, 'store']); // create an appointment
Route::get('/appointments',[AppointmentController::class,'index']); //retreive all appointments
Route::get('/appointments/{appointment_id}',[AppointmentController::class,'show']); //retrieve a specific appointment
 Route::put('/appointments/{appointment_id}',[AppointmentController::class,'update']); //update (delay) an appointments
 Route::delete('/appointments/{appointment_id}',[AppointmentController::class,'destroy']); //delete (cancel) an appointments

 Route::get('/appointments',[ChildParentController::class,'index']); //retreive all doctors

    



 });





 //Route::group(['middleware'=>'jwt.role:ChildParent','jwt.auth' ,'prefix'=>'ChildParent'], function($router){
   

//});

// uploadimage
Route::post('/uploadimage', [ImageController::class, 'uploadimage']);
   