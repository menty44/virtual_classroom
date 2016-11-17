<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends Controller
{
    //Show all courses of a student

    public function showAllCourses(Request $req){
    	$student_id = $req->user()->id;
    	$courses = \DB::table('courses')
    				->join('course_enrolled', function($join){
    					 $join->on('courses.id','=','course_enrolled.course_id');
    				})
    				->where('course_enrolled.student_id','=',$student_id)
    				->get();
    	

    	return view('courses.courses')->with(['courses' => $courses,'type' => 'student']);

    }

    //single material course page
    public function singleCourseMaterialPage($id){
    	return view('courses.course-material');
    }


    //Get the private profile of Student
    public function getPrivateProfile(Request $req){
        $st_information = $req->user();
        if(!empty($st_information) || count($st_information) > 0) {
            return view('student.profile-private')->with(['user' => $st_information]);
        }
    }



}