<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class GeneralController extends Controller
{

    public function view_contact_us()
    {

        return view('general.view_contact_us');
    }

    public function view_contact_us_dt(Request $request)
    {

        $columns = array(
            0 => 'contactus.id',
            1 => 'contactus.fullname',
            2 => 'contactus.phone',
            3 => 'contactus.email',
            4 => 'contactus.franchise',
            5 => 'contactus.message',
            6 => 'contactus.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('contactus');

        if (request()->has('email')) {
            $email = request('email');
            if ($email != "") {
                $query->where('contactus.email', 'LIKE', '%' . $email . '%');
            }
        }
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('contactus.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('contactus.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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

                $nestedData['id'] = $count;

                $email = $post->email;

                $function = "showcontactus1(".$post->id.", '".$post->email."')";

                $new_status = ($post->status == 0) ? '<b class="btn btn-sm btn-danger" onClick="'.$function.'">Reply</b>' : '<b class="btn btn-sm btn-outline-danger">Replied</b>';

                $nestedData['fullname'] = $post->fullname;                
                $nestedData['phone'] = $post->phone;               
                
                if( strlen($post->email) >= 40 ) {
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 40) . '...</span>';
                } else {
                    $nestedData['email'] = $post->email;
                }
                
                if( strlen($post->franchise) >= 40 ) {
                    $nestedData['franchise'] = '<span data-balloon-length="xlarge" aria-label="' . $post->franchise . '" data-balloon-pos="up">' . substr($post->franchise, 0, 40) . '...</span>';
                } else {
                    $nestedData['franchise'] = $post->franchise;
                }
                if( strlen($post->message) >= 40 ) {
                    $nestedData['message'] = '<span data-balloon-length="xlarge" aria-label="' . $post->message . '" data-balloon-pos="up">' . substr($post->message, 0, 40) . '...</span>';
                } else {
                    $nestedData['message'] = $post->message;
                }

                $nestedData['action'] = $new_status ;

                $nestedData['created_at'] = $post->created_at;      

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

    public function contact_mail(Request $request){
        
        $id = $request->id;
        $email = $request->email;
        $replymessage = $request->message;

        if( 
            !empty($email)
            and
            !empty($replymessage)
        ) {

            try {
                // send mail
                $subject = 'Reply from CoachingSelect';
        
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
                    $datamessage['subject']=$subject;

                    $content = $replymessage;
                                    
                    \Mail::send('mails.commonmail', compact('content'), function ($m) use ($datamessage){
                        $m->from('support@coachingselect.com', 'CoachingSelect');
                        $m->to($datamessage['email'])->subject($datamessage['subject']);
                    });
                    
                }
            } catch(\Exception $e) {
            }

            return redirect()
                    ->back()
                    ->with('success', 'You successfully replied on mail @'.$email);
        }

        return redirect()->back();
    }
    public function reqcallback_mail(Request $request){
        $id = $request->id;
        $replymessage = $request->message;
        $data = DB::table('request_callback')->where('id',$id)->first();
        dd($data);

    }

    public function view_requestcallback()
    {

        $data = $this->view_requestcallback_dt(
                    request()
                );

        $data = ( json_decode($data, true) );

        return view('general.view_requestcallback', compact('data'));
    }

    public function view_requestcallback_dt(Request $request)
    {

        $columns = array(
            0 => 'request_callback.id',
            1 => 'request_callback.name',
            2 => 'request_callback.status',
        );

        $query = DB::table('request_callback');

        if (request()->has('email')) {
            $email = request('email');
            if ($email != "") {
                $query->where('request_callback.email', 'LIKE', '%' . $email . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('request_callback.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('request_callback.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $q2 = DB::table('student_request_callback')
            ->join('students', 'students.id', '=', 'student_request_callback.user_id')
            ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
            ->whereNotNull('student_request_callback.name')
            ->whereNotNull('student_request_callback.email')
            ->whereNotNull('student_request_callback.mobile')
            ->where('is_purchase_lead', 0);
            
        $q2 = $q2
        ->select('students.name as name','students.email as email','students.mobile as mobile','coaching.name as coachingname', 'student_request_callback.*')
        ->get();   
        
        $q3 = DB::table('student_request_callback')
            ->join('students', 'students.id', '=', 'student_request_callback.user_id')
            ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
            ->whereNull('student_request_callback.name')
            ->whereNull('student_request_callback.email')
            ->whereNull('student_request_callback.mobile')
            ->where('is_purchase_lead', 0);

        $q3 = $q3
        ->select('coaching.name as coachingname', 'student_request_callback.*','students.name as name','students.email as email','students.mobile as mobile')
        ->get();  

        $posts = $query
            ;

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
        }
    
        $posts = $posts
                ->get();

        $posts = $posts->merge($q2);
        
        $posts = $posts->merge($q3);

        $totalData = $posts->count();

        $posts = $posts
                ->sortByDesc('created_at');
        
        $totalFiltered = $totalData;
        
        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = 1;
            } else {
                $count = 1;
            }

            foreach ($posts as $post) {

                $nestedData['id'] = $count;

                $email = $post->email;

                $function = "showcontactus1(".$post->id.", '".$post->email."')";

                $new_status = ($post->status == 0) ? '<b class="btn btn-sm btn-danger" onClick="'.$function.'">Reply</b>' : '<b class="btn btn-sm btn-outline-danger">Replied</b>';

                $nestedData['name'] = $post->name;                
                $nestedData['mobile'] = $post->mobile; 
                
                if( strlen($post->email) >= 40 ) {
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 40) . '...</span>';
                } else {
                    $nestedData['email'] = $post->email;
                }

                $nestedData['city'] = $post->city ?? '';                
                $nestedData['class'] = $post->class ?? '';                
                $nestedData['action'] = '
                <div class="d-flex">
                ' . $new_status . '</div>';   
                
                $nestedData['coaching_id'] = $post->coaching_id;                
                
                $nestedData['coaching_counselling_name'] = 'Counselling Callback'; 
                         
                if($post->coaching_id != 0) {
                    $nestedData['coaching_counselling_name'] = DB::table('coaching')
                                                                ->where('id', $post->coaching_id)
                                                                ->value('name');   
                }

                
                $nestedData['created_at'] = $post->created_at; 

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
        return json_encode($json_data);
    }

    public function view_studentrequestcallback()
    {

        return view('general.view_studentrequestcallback');
    }

    public function view_studentrequestcallback_dt(Request $request)
    {

        $columns = array(
            0 => 'request_callback.id',
            1 => 'request_callback.name',
            2 => 'request_callback.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('student_request_callback')
            ->join('students', 'students.id', '=', 'student_request_callback.user_id')
            ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id');

        if (request()->has('email')) {
            $email = request('email');
            if ($email != "") {
                $query->where('students.email', 'LIKE', '%' . $email . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('request_callback.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('request_callback.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            ->select('student_request_callback.*','students.name as name','students.email as email','students.mobile as mobile','coaching.name as coachingname')
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $nestedData['id'] = $count;

                $email = $post->email;

                $function = "showcontactus1(".$post->id.", '".$post->email."')";

                $new_status = ($post->status == 0) ? '<b class="btn btn-sm btn-danger" onClick="'.$function.'">Reply</b>' : '<b class="btn btn-sm btn-outline-danger">Replied</b>';

                $nestedData['name'] = $post->name;                
                $nestedData['mobile'] = $post->mobile;  
                
                if( strlen($post->email) >= 40 ) {
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 40) . '...</span>';
                } else {
                    $nestedData['email'] = $post->email;
                }

                $nestedData['coachingname'] = $post->coachingname;             
                $nestedData['action'] = '
                <div class="d-flex">
                ' . $new_status . '</div>';

                $nestedData['created_at'] = $post->created_at; 

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

    public function view_requestcallback_purchase()
    {

        $data = $this->view_requestcallback_purchase_dt(
                    request()
                );

        $data = ( json_decode($data, true) );

        return view('general.view_requestcallback_purchase', compact('data'));
    }

    public function view_requestcallback_purchase_dt(Request $request)
    {

        $columns = array(
            0 => 'request_callback.id',
            1 => 'request_callback.name',
        );


        $query = DB::table('student_request_callback')
                ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
                ->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'student_request_callback.coaching_courses_detail_id')
                ->select('coaching.name as cname', 'coaching_courses_detail.name as ccname', 'student_request_callback.*')
                ->where('is_purchase_lead', 1);

        if (request()->has('email')) {
            $email = request('email');
            if ($email != "") {
                $query->where('email', 'LIKE', '%' . $email . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('student_request_callback.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('student_request_callback.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }
     

        $posts = $query
            ;

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('student_request_callback.created_at', 'desc');
        } else {
        }
        
        // counselling
        
        $query1 = DB::table('student_request_callback')
                ->join('counselling', 'counselling.id', '=', 'student_request_callback.counselling_id')
                ->select('counselling.name as cname', 'student_request_callback.*')
                ->where('is_purchase_lead', 1);

        if (request()->has('email')) {
            $email = request('email');
            if ($email != "") {
                $query1->where('email', 'LIKE', '%' . $email . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query1 = $query1->whereDate('student_request_callback.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query1 = $query1->whereDate('student_request_callback.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }
     

        $posts1 = $query1
            ;

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts1 = $posts1->orderBy('student_request_callback.created_at', 'desc');
        } else {
        }
    
        $posts = $posts
                ->get();
                
        $posts1 = $posts1
                ->get();

        $posts = $posts->merge($posts1);
        
        $totalData = $posts->count();

        $posts = $posts
                ->sortByDesc('created_at');
        
        $totalFiltered = $totalData;
        
        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = 1;
            } else {
                $count = 1;
            }

            foreach ($posts as $post) {

                $nestedData['id'] = $count;

                $function = "showcontactus1(".$post->id.", '".$post->email."')";

                $new_status = ($post->status == 0) ? '<b class="btn btn-sm btn-danger" onClick="'.$function.'">Reply</b>' : '<b class="btn btn-sm btn-outline-danger">Replied</b>';

                $nestedData['type'] = $post->type;   
                
                $nestedData['name'] = $post->name;   
                
                $nestedData['cname'] = $post->cname;                
                $nestedData['ccname'] = $post->ccname ?? '';                
                $nestedData['mobile'] = $post->mobile;    
                $nestedData['parent_name'] = $post->parent_name;    
                
                if( strlen($post->email) >= 40 ) {
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 40) . '...</span>';
                } else {
                    $nestedData['email'] = $post->email;
                }
                $nestedData['action'] = '
                <div class="d-flex">
                ' . $new_status . '</div>';   
                
                $nestedData['created_at'] = $post->created_at; 
                
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
        return json_encode($json_data);
    }

    public function view_search_lead()
    {

        return view('general.view_search_lead');
    }

    public function view_search_lead_dt(Request $request)
    {

        $columns = array(
            0 => 'search_lead.id',
            1 => 'search_lead.text',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('search_lead');

        if (request()->has('email')) {
            $email = request('email');
            if ($email != "") {
                $query->where('email', 'LIKE', '%' . $email . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('search_lead.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('search_lead.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }
     

        $posts = $query
            ;

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('search_lead.created_at', 'desc');
        } else {
        }
    
        $posts = $posts
                ->get();

        $totalData = $posts->count();

        $posts = $posts
                ->skip($start)
                ->take($limit)
                ->sortByDesc('created_at');
        
        $totalFiltered = $totalData;
        
        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = 1;
            } else {
                $count = 1;
            }

            foreach ($posts as $post) {

                $nestedData['id'] = $count;

                $nestedData['text'] = $post->text;                
                $nestedData['is_found'] = $post->is_found;                
                $nestedData['location'] = $post->location;                
                
                $nestedData['created_at'] = $post->created_at; 
                
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
        return json_encode($json_data);
    }
}