<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class StudentController extends Controller
{

    
    public function view_students()
    {

        return view('students.view_students');
    }

    public function view_students_dt(Request $request)
    {

        $columns = array(
            0 => 'students.id',
            1 => 'students.name',
            2 => 'students.mobile',
            3 => 'students.email',
            4 => 'students.alternative_mobile',
            5 => 'students.name',
            6 => 'students.pincode',
            7 => 'students.has_disability',
            8 => 'students.code',
            9 => 'students.is_email_verified',
            10 => 'students.category',
            11 => 'students.address1',
            12 => 'students.city',
            13 => 'students.state',
            14 => 'students.dob',
            15 => 'students.gender',
            16 => 'students.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('students');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('students.name', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('students.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('students.created_at', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $nestedData['name'] = $post->name;                
                $nestedData['mobile'] = $post->mobile;  
                $nestedData['alternative_mobile'] = $post->alternative_mobile; 
                if(!empty($post->image)){
                    $nestedData['image'] = '<img src="'.$post->image.'" style="width: 60px;
                    height: 60px;" >';
                } 
                else{
                    $nestedData['image'] = 'Not Available';
                }
                $nestedData['pincode'] = $post->pincode;  
                $nestedData['category'] = $post->category;  
                             
                $nestedData['city'] = $post->city;                
                $nestedData['state'] = $post->state;                
                
                if( strlen($post->address1) >= 40 ) {
                    $nestedData['address'] = '<span data-balloon-length="xlarge" aria-label="' . $post->address1 . '" data-balloon-pos="up">' . substr($post->address1, 0, 40) . '...</span>';
                } else {
                    $nestedData['address'] = $post->address1;
                }

                if( strlen($post->email) >= 40 ) {
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 40) . '...</span>';
                } else {
                    $nestedData['email'] = $post->email;
                }
                $status='';
                if($post->status ==0){
                    $status="Enabled";
                }else{
                    $status="Disabled";
                }

                $nestedData['dob'] = $post->dob;     
                $nestedData['gender'] = $post->gender;  
                $nestedData['has_disability'] = $post->has_disability;  
                $nestedData['code'] = $post->code;  
                $nestedData['status'] = $status;  
                if(($post->is_email_verified == 0)){
                    $nestedData['is_email_verified'] = 'No';
                } 
                else{
                    $nestedData['is_email_verified'] ='Yes';
                }  
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));   
                
                $nestedData['action'] = 
                '<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('StudentController@view_student_details', $post->id) . '" aria-label="View Student Details" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                ';
                if($nestedData['status']=='Enabled'){
                $nestedData['block'] = 
                '<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('StudentController@block_student', $post->id) . '"  data-balloon-pos="up"><i class="fas fa-user-lock"></i></a>
                ';}
                else{
                    $nestedData['block'] = 
                    '<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-red" href="' . action('StudentController@block_student', $post->id) . '"  data-balloon-pos="up"><i class="fas fa-user-lock"></i></a>
                    ';
                }
               

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function view_student_details($user_id)
    {

        $student_academic_details = DB::table('student_academic_details')
                                    ->where('student_academic_details.user_id', $user_id)     
                                    ->get();                       

        $student_education_level_information = DB::table('student_education_level_information')
                                    ->where('student_education_level_information.user_id', $user_id)     
                                    ->get();                       

        return view('students.view_student_details', compact('student_academic_details', 'student_education_level_information'));
    }
    public function block_student($id){
        $status=DB::table('students')->where('id',$id)->first('status');
        if($status->status==0){
            DB::table('students')->where('id',$id)->update(['status'=>1]);
            session()->forget('student');
            return redirect()->back();
        }else{
            DB::table('students')->where('id',$id)->update(['status'=>0]);
            
            return redirect()->back();
        }
        
    }
}