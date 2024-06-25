<?php

use App\Http\Controllers\Mycontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get("/home",[Mycontroller::class,"home"])->name("home");
Route::get("/login",[Mycontroller::class,"login"])->name("login");
Route::post("/registerpost",[Mycontroller::class,"registerPost"])->name("register.post");
Route::post("/loginpost",[Mycontroller::class,"loginPost"])->name("login.post");
Route::get('/logout',[Mycontroller::class,"logout"]);
Route::get("/student_form",[Mycontroller::class,"studentform"]);
Route::get("/student_data",[Mycontroller::class,"studendata"])->name("studentdata");
Route::post("/storestudent",[Mycontroller::class,"storestudent"])->name("storestudent");
Route::get("/editstudent/{id}",[Mycontroller::class,"editstudent"])->name("editstudent");
Route::post("/updatestudent",[Mycontroller::class,"updatestudent"])->name("updatestudent");
Route::get("/deletestudent/{id}",[Mycontroller::class,"deletestudent"])->name("deletestudent");
Route::get("/searchstudent",[Mycontroller::class,"searchstudent"])->name("searchstudent");
Route::get('/view-students', [Mycontroller::class,"viewStudents"])->name('view-students');
Route::post('/subject_store',[Mycontroller::class,"subject_store"])->name('subject_store');


