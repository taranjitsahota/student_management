<?php

namespace App\Http\Controllers;

use App\Models\Mymodel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Mycontroller extends Controller
{
    public function login(){
        if (Session::has('email') && Session::has('password')) {
            return redirect("/home");
            }
            else{
                return view("auth.login");
            }
            
            return view("auth.login");
    }
    public function registerpost(Request $request){
        $email = $request->input('email');

        if (User::where('email', $email)->exists()) {
            return response()->json(['message' => 'Email is already registered'], 422);
        }
        // dd('reached');
        $request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "password"=>['required', Password::min(8)->mixedCase()]
         ]);

        $data = Mymodel::registerpost($request);
        return response()->json(['message' => 'User registered successfully'], 200);
    }
    public function loginpost(Request $request){
        // dd('reach');
        $data = Mymodel::loginpost($request);
        if($data){
            Session::put('email',$data->email);
            Session::put('password',$data->password);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success'=>false]);
    }
    public function logout(){
        Session::flush();
        return redirect("/login");
    }
    public function studentform(){
        $data['standards'] = Mymodel::student_form();
        // dd($data);
        return view('student.student_form',$data);
    }
    public function storestudent(Request $request){
        // dd('reach');
        $request->validate([
           'name'=>'required',
           'age'=>'required',
           'standard'=>'required',
           'division'=>'required',
           'roll_no' => [
        'required',
        Rule::unique('students', 'roll_no')->where(function ($query) use ($request) {
            return $query->where('standard', $request->standard)
                         ->where('division', $request->division);
        })
    ],
           'subject.*' => 'required',
           'marks.*' => 'required'
        ]);
        $data['candidates']=Mymodel::storestudent($request);
        // dd($data);
        return response()->json(['message' => 'User registered successfully'], 200);
        
    }
    public function home(){
        return view('student.home');
    }
    
    public function studendata(){
        $data['students'] = Mymodel::studentdata();
        // dd($data);
        return view('student.student_data',$data);
    }
    public function editstudent($id){
        $data['students']= Mymodel::editstudent($id);
        // $data['subjects']=Mymodel::subjectsedit($id);
        $data['standards']=Mymodel::student_form();
        // dd($data);
        return view('student.edit_student',$data);

    }
    public function deletestudent($id){
        $data = Mymodel::deletestudent($id);
        return back();
    }
    public function searchstudent(){
        // $data['students'] = Mymodel::searchstudent();
        // dd($data);
        return view('student.search_student');
    }
    public function viewStudents(Request $request)
{
    $request->validate([
        'standard' => 'required|integer|between:1,12',
        'division' => 'required|in:A,B,C',
    ]);
    $standard = $request->input('standard');
    $division = $request->input('division');
    $data['students'] = Mymodel::viewStudents($request);
    $data['standard'] = $standard;
    $data['division'] = $division;

    // dd($data);
        return view('student.search_student',$data);
}

public function updatestudent(Request $request){
    $data = Mymodel::updatestudent($request);
    return response()->json(['message' => 'User registered successfully'], 200);
}
public function subject_store(Request $request){
    // dd("hey");
    $request->validate([
        'student_id'=>'required',
        'subject'=>'required',
        'marks'=>'required'
    ]);
    $users = Mymodel::subject_store($request);
    // dd($users);
    return response()->json($users);
}
}
