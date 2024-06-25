<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class Mymodel extends Model
{
    use HasFactory;
    public static function registerpost($request)
    {


        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ];
        //  dd($user);
        $data = DB::table('users')
            ->insert($user);
    }

    public static function loginPost($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $users = DB::table('users')
            ->where('email', $email)
            ->first();
        if ($users) {
            if (Hash::check($password, $users->password)) {
                return $users;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public static function student_form()
    {
        $data = Db::table('standard')
            ->select(
                'id',
                'standard'
            )
            ->get();
        return $data;
    }
    public static function storestudent($request)
    {
        // dd($request);
        $total = 0;
        if ($request->subject) {

            foreach ($request->subject as $key => $subject) {



                if (isset($subject['marks'])) {
                    $marks[] = $subject['marks'];
                    $total += $subject['marks'];
                }
            }
        }
        // dd($total);
        // $totalmarks = $request->subject->marks;
        $data = array(
            "name" => $request->name,
            "age" => $request->age,
            "standard" => $request->standard,
            "division" => $request->division,
            "roll_no" => $request->roll_no,
            'total_marks' => $total

        );
        $subjects = [];
        if (!$request->subject) {
            $user = DB::table('students')
                ->insert($data);
            return $user;
        } else {
            foreach ($request->subject as $subjectData) {
                if (!empty($subjectData['name'])) {
                    $subjects[] = [
                        'subjectname' => $subjectData['name'],
                        'marks' => $subjectData['marks']
                    ];
                }
            }
            $user = DB::table('students')
                ->insertGetId($data);
            if ($user) {
                foreach ($subjects as $subject) {
                    $subject['student_id'] = $user;
                    DB::table('subjects')
                        ->insert($subject);
                }
                return 'Candidate registered!';
            } else {
                return 'Candidate not registered!';
            }
        }
    }
    public static function studentdata()
    {
        $users = DB::table('students')
            ->select(
                "students.*",
                // "subjects.subjectname as subject",
                // "subjects.marks as marks"
            )
            // ->Join('subjects', 'subjects.student_id', '=', 'students.id')
            ->whereNull('is_deleted')
            ->orderBy('id', 'desc')
            ->get();
        // dd($users);
        return $users;
    }
    public static function editstudent($id)
    {
        $users = DB::table('students')
            ->where('id', $id)
            ->first();
        $data = DB::table('subjects')
            ->where('student_id', $id)
            ->get();
        //    dd($users);
        // dd($data);
        return [
            'students' => $users,
            'subjects' => $data
        ];
        //    dd($id);
        // return $users;
    }
    public static function subjectsedit($id)
    {
        $users = DB::table('subjects')
            ->where('student_id', $id)
            ->get();
        //    dd($users);
        return $users;
    }
    public static function subjects()
    {
        $users = DB::table('subjects')
            ->get();
        //    dd($id);
        return $users;
    }
    public static function deletestudent($id)
    {
        // dd($id);
        $users = DB::table('students')
            ->where('id', $id)
            ->update(["is_deleted" => 1]);
        //    dd( $users);
        return $users;
    }

    public static function viewStudents($request)
    {
        $standard = $request->input('standard');
        $division = $request->input('division');
        if ($standard && $division) {
            $data = collect(DB::table('students')
                ->select(
                    "students.*",
                    "subjects.subjectname as subject",
                    "subjects.marks as marks"
                )
                ->Join('subjects', 'subjects.student_id', '=', 'students.id')
                ->whereNull('is_deleted')
                ->where('standard', $standard)
                ->where('division', $division)
                ->get())
                ->groupBy('id')
                ->map(function ($group) {
                    $student = $group->first();
                    $student->subjects = $group->map(function ($item) {
                        return [
                            'subject' => $item->subject,
                            'marks' => $item->marks,
                        ];
                    })->all();
                    return $student;
                });
            // dd($data);
        }
        return $data;
    }
    public static function updatestudent($request)
    {
        // dd($request);
            $user = DB::table('subjects')
            ->where('id',$request->student_id)
                ->delete();

                $user = DB::table('students')
            ->where('id',$request->student_id)
                ->delete();
            
       // dd($request);
       $total = 0;
       if ($request->subject) {

           foreach ($request->subject as $key => $subject) {



               if (isset($subject['marks'])) {
                   $marks[] = $subject['marks'];
                   $total += $subject['marks'];
               }
           }
       }
       // dd($total);
       // $totalmarks = $request->subject->marks;
       $data = array(
           "name" => $request->name,
           "age" => $request->age,
           "standard" => $request->standard,
           "division" => $request->division,
           "roll_no" => $request->roll_no,
           'total_marks' => $total

       );
       $subjects = [];
       if (!$request->subject) {
           $user = DB::table('students')
               ->insert($data);
           return $user;
       } else {
           foreach ($request->subject as $subjectData) {
               if (!empty($subjectData['name'])) {
                   $subjects[] = [
                       'subjectname' => $subjectData['name'],
                       'marks' => $subjectData['marks']
                   ];
               }
           }
           $user = DB::table('students')
               ->insertGetId($data);
           if ($user) {
               foreach ($subjects as $subject) {
                   $subject['student_id'] = $user;
                   DB::table('subjects')
                       ->insert($subject);
               }
               return 'Candidate registered!';
           } else {
               return 'Candidate not registered!';
           }
       }
    }
    public static function subject_store($request)
    {
        // dd($request);
        $data = [
            'student_id' => $request->student_id,
            'subjectname' => $request->subject,
            'marks' => $request->marks
        ];
        $users = DB::table('subjects')
            ->insert($data);
        // dd($data);
        return $data;
    }
}
