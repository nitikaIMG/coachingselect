<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use URL;

class CollegeController extends Controller
{

    public function add_college(Request $request)
    {
        if (request()->isMethod('get')) {
            $allstate = DB::table('states')->get();
            $allcountry = DB::table('countries')->get();
            $allfacility = DB::table('facility')->where('status','enable')->get();
            $allstream = DB::table('streams')->where('status','enable')->get();
            $allcourses = DB::table('courses')->where('type','college')->where('status','enable')->get(['id', 'stream_id', 'name']);
            
            $college_category = DB::table('college_category')
                                ->whereStatus('enable')
                                ->get();

            $exams = $this->exams();

            return view('college.add_college', compact('allcountry','allstate', 'allfacility', 'allstream', 'allcourses', 'college_category', 'exams'));
        } else {
            $input = request()->except(['_token', 'faq']);

            if (!empty($input)) {
                $is_exists = DB::table('college')
                    ->where('college_name', $input['college_name'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'This college already exists');
                }
                
                $input['facilities'] = array_unique($input['facilities']);
                $facilities = implode(',', $input['facilities']);
                $input['facilities'] = $facilities;
                
                if ($request->file('images')) {
                    $img = $request->file('images');
                    $destination = public_path() . '/' . '/college_image/';
                    $filename = 'clg-I-' . time();
                    $input['images'] = Helpers::imageUpload($img, $destination, $filename);
                    $imgg = $input['images'];
                    if ($imgg == '') {
                        return redirect()->back()->with('danger', 'Invalid extension of file you uploaded. You can only upload image or pdf.');
                    }
                    $input['images'] = $imgg;
                }
                
                if ( !empty($input['videos']) ) {
                    $input['videos'] = json_encode($input['videos']);
                }

                if ( !empty($input['course']) ) {

                    $coursee = $input['course'];
                    $c_id = json_encode($coursee);
                    $input['stream_id'] = implode(',', array_keys($coursee));
                    $input['courses_details'] = $c_id;
                    unset($input['course']);
                }
            
                if ( !empty($input['course_fee']) ) {
                    # course fee
                    $course_fee = $input['course_fee'];
                    $c_fee = json_encode($course_fee);
                    $input['course_fee'] = $c_fee;
                }
                
                if ( !empty($input['course_seats']) ) {
                    # course seats
                    $course_seats = $input['course_seats'];
                    $c_seats = json_encode($course_seats);
                    $input['course_seats'] = $c_seats;
                }

                if ( !empty($input['course_eligibility']) ) {
                    # course eligibility
                    $course_eligibility = $input['course_eligibility'];
                    $c_eligibility = json_encode($course_eligibility);
                    $input['course_eligibility'] = $c_eligibility;
                }

                if( !empty($input['exams_accepted']) ) {
                    $exams_acceptede = $input['exams_accepted'];
                    $c_id = json_encode($exams_acceptede);
                    $input['exams_accepted'] = $c_id;
                }

                if (empty(request('image'))) {
                    $input['image'] = '';
                } else {
                    $image = '';

                    $file = request('image');

                    $thumbnailPath = public_path('college/');

                    $fileName = 'college-' . time() . random_int(0, 10);

                    $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                    if ($input['image'] == '') {
                        return redirect()->back()->with('error', 'invalid image provided');
                    }
                }

                if( request()->has('brochure_or_pdf') ) {
                
                    $pdf = '';

                    $file = request('brochure_or_pdf');

                    $thumbnailPath = public_path('college/');

                    $fileName = 'college-' . time() . random_int(0, 10);

                    $input['brochure_or_pdf'] = Helpers::upload_pdf($file, $thumbnailPath, $fileName);

                    if ($input['brochure_or_pdf'] == '') {
                        return redirect()->back()->with('error', 'invalid pdf provided');
                    }
                    
                }

                if (empty(request('background_image'))) {
                    $input['background_image'] = '';
                } else {
                    $background_image = '';

                    $file = request('background_image');

                    $thumbnailPath = public_path('college/');

                    $fileName = 'college-' . time() . random_int(0, 10);

                    $input['background_image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                    if ($input['background_image'] == '') {
                        return redirect()->back()->with('error', 'invalid background image provided');
                    }
                }

                try {
                    $college_id = DB::table('college')->insertGetId($input);

                    $faq = request()->get('faq');

                    if (!empty($faq)) {
                        foreach ($faq as $specific) {

                            $specific_data = array();
                            $specific_data['college_id'] = $college_id;
                            $specific_data['name'] = $specific['name'];
                            $specific_data['value'] = $specific['value'];
                            
                            if( 
                                !empty($specific_data['name'])
                                or
                                !empty($specific_data['value'])
                            ) {
                                DB::table('college_faq')->insert($specific_data);
                            }
                        }
                    }

                } catch(\Exception $e) {
                    return redirect()
                                ->back()
                                ->with('danger', 'Please choose required fields');
                }

                return redirect()
                    ->action('CollegeController@view_college')
                    ->with('success', 'College Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function get_allcity(Request $request)
    {
        $var = $request->all();
        $inp = $var['x'];

        $state_id = DB::table('states')
                ->where('name', $inp)
                ->value('id');

        $data = DB::table('cities')
                ->where('state_id', $inp)
                ->orWhere('state_id', $state_id)                
                ->get();
        $allname = '<option value="">Select Cities</option>';
        foreach ($data as $user) {
            if (isset($var['x1'])) {
                $cii = $var['x1'];
                if ($cii == $user->id) {
                    $select = "selected";
                } else {
                    $select = "";
                }
            } else {
                $select = "";
            }
            $allname .= '<option ' . $select . '  value="' . $user->id . '">' . $user->name . '</option>';
        }
        echo $allname;
    }
    public function get_allstate(Request $request)
    {
        $var = $request->all();
        $inp = $var['x'];
        $country_id = DB::table('countries')
                ->where('name', $inp)
                ->value('id');

        $data = DB::table('states')
                ->where('country_id', $inp)
                ->orWhere('country_id', $country_id)
                ->get();
        $allname = '<option value="">Select States</option>';
        foreach ($data as $user) {
            if (isset($var['x1'])) {
                $sta = $var['x1'];
                if ($sta == $user->id) {
                    $select = "selected";
                } else {
                    $select = "";
                }
            } else {
                $select = "";
            }
            $allname .= '<option ' . $select . '  value="' . $user->id . '">' . $user->name . '</option>';
        }
        echo $allname;
    }

    public function get_course(Request $request)
    {
        $var = $request->all();
        $inp = $var['x'];
        $data = DB::table('courses')->where('stream_id', $inp)->get();

        echo $data;
    }

    public function view_college()
    {
        $getallstate = DB::table('states')
                         ->where('states.status', 1)
                        ->get();
        $colleges_categories = DB::table('college_category')
                            ->where('status', 'enable')
                            ->get();
        return view('college.view_college', compact('getallstate', 'colleges_categories'));
    }

    public function view_college_datatable(Request $request)
    {
        $columns = array(
            0 => 'college.id',
            1 => 'college.featured',
            2 => 'college.category',
            3 => 'college.college_name',
            4 => 'states.name',
            5 => 'college.year',
            6 => 'college.total_enrollment',
            7 => 'college.created_at',
            8 => 'college.college_name',
            9 => 'college.college_name',
            10 => 'college.about_college',
            11 => 'college.admissions_details',
            12 => 'college.placement_details',
            13 => 'college.facilities',
            14 => 'college.scholarship',
            15 => 'college.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $query = DB::table('college')->join('states', 'states.id', 'college.state_id')->join('cities', 'cities.id', 'college.city_id')->leftJoin('facility', 'facility.id', 'college.facilities');
        // search for the series name //
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            if ($name != "") {
                $query =  $query->where('college_name', 'LIKE', '%' . $name . '%');
            }
        }
        if (isset($_GET['state'])) {
            $state = $_GET['state'];
            if ($state != "") {
                $query =  $query->where('college.state_id', 'LIKE', '%' . $state . '%');
            }
        }
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('college.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('college.created_at', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}

        if (request()->has('college_category_id')) {
            $college_category_id = request('college_category_id');
            if ($college_category_id != "") {
                $query->where('college.category', $college_category_id);
            }
        }

        $count = $query->count();

        $query = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $query = $query->orderBy('created_at', 'desc');
        } else {
            $query = $query->orderBy($order, $dir);
        }
    
        $titles = $query
                    ->select('college.*', 'states.name as sname', 'cities.name as cname', 'facility.name as fname')
                    ->get();
        
        $totalTitles = $count;
        $totalFiltered = $totalTitles;
        if (!empty($titles)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }
            foreach ($titles as $title) {

                $confirm = "return confirmation('Are you sure?') ";
                $ena = action('CollegeController@updatecolgstatus', [($title->id), '0']);
                $dis = action('CollegeController@updatecolgstatus', [($title->id), '1']);
                if ($title->status == 'closed') {
                    $statuss = '<a class="btn btn-sm btn-outline-danger" href="' . $dis . '" onclick="' . $confirm . '">Enable</a>';
                } else {
                    $statuss = '<a class="btn btn-sm btn-danger" href="' . $ena . '" onclick="' . $confirm . '">Disable</a>';
                }
                $is_featured = '';
                if($title->featured) {
                   $is_featured = 'active'; 
                }

                $is_featured = '
                <form 
                    class="is_featured"
                    method="post"
                    action="'.action('CollegeController@is_college_featured').'?id='.$title->id.'">'
                .csrf_field().'
                <input type="hidden" name="id" value="'.$title->id.'" />
                <button 
                type="submit" 
                class="'.$is_featured.' btn-sm btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path>
                    </svg>
                    <span class="visually-hidden"></span>
                </button>';

                $facidata = explode(',', $title->facilities);
                $j = 1;
                $faci = '';
                foreach ($facidata as $facidatas) {
                    $getnme = DB::table('facility')->where('id', $facidatas)->first();
                    if (!empty($getnme)) {
                        $getnme = $getnme->name;
                        $faci .= ($facidata != '') ? $getnme . ', ' : $getnme;
                        $j++;
                    }
                }
                $strdata = explode(',', $title->stream_id);
                $j = 1;
                $str = '';
                if (!empty($title->stream_id)) {
                    foreach ($strdata as $strams) {
                        $getnme = DB::table('streams')->where('id', $strams)->first()->name;
                        $str .= ($strdata != '') ? $getnme . ', ' : $getnme;
                        $j++;
                    }
                }

                $course = json_decode($title->courses_details);
                $cour = '';
                if (!empty($course)) {
                    $p = 1;
                    foreach ($course as $key => $courses) {
                        $getnme = DB::table('courses')->where('courses.id', $courses)->first()->name;
                        $cour .= ($cour != '') ? $getnme . ', ' : $getnme;
                        $p++;
                    }
                }

                $nestedData['id'] = $count;

                if( strlen($title->college_name) >= 40 ) {
                    $nestedData['college_name'] = '<span data-balloon-length="xlarge" aria-label="' . $title->college_name . '" data-balloon-pos="up">' . substr($title->college_name, 0, 40) . '...</span>';
                } else {
                    $nestedData['college_name'] = $title->college_name;
                }
                
                if( strlen($title->category) >= 40 ) {
                    $nestedData['college_category'] = '<span data-balloon-length="xlarge" aria-label="' . $title->category . '" data-balloon-pos="up">' . substr($title->category, 0, 40) . '...</span>';
                } else {
                    $nestedData['college_category'] = $title->category;
                }

                $nestedData['is_featured'] = $is_featured;
                $nestedData['state'] = $title->sname;
                $nestedData['city'] = $title->cname;
                $nestedData['address'] = $title->address;
                $nestedData['year'] = $title->year;
                $nestedData['enrollment'] = $title->total_enrollment;
                $nestedData['ranking'] = $title->ranking;
                $nestedData['stream'] =  $str;
                $nestedData['courses'] = $cour;
                $nestedData['about'] = substr($title->about_college, 0, 40);
                $nestedData['admission'] = substr($title->admissions_details, 0, 40);
                $nestedData['placement'] = substr($title->placement_details, 0, 40);
                $nestedData['facilities'] = $faci;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($title->created_at));


                $nestedData['images'] = '
                <div class="d-flex">
                <a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('CollegeController@add_colgimages', $title->id) . '" aria-label="Add Photos" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CollegeController@view_colgimage', $title->id) . '" aria-label="View Photos" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                

                $nestedData['valuable'] = '
                <div class="d-flex">
                <a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('CollegeController@add_valuable', 'id=' . $title->id) . '" aria-label="Add Valuable" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CollegeController@view_college_valuable', 'id=' . $title->id) . '" aria-label="View Valuable" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['scholarship'] = substr($title->scholarship, 0, 40);
                $nestedData['status'] = ($title->status == '1') ? 'Enable' : 'Disable';
                $nestedData['action'] = '
                <div class="d-flex">
                <a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('CollegeController@edit_college', $title->id) . '"  aria-label="Edit" data-balloon-pos="up"><i class="fad fa-pencil"></i></a>
                ' . $statuss . '</div>';

                

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalTitles),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);
    }

    public function edit_college(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $input = request()->except(['_token', 'faq']);

            $input['facilities'] = array_unique($input['facilities']);
            $facilities = implode(',', $input['facilities']);
            $input['facilities'] = $facilities;
            if ($request->file('images')) {
                $img = $request->file('images');
                $destination = public_path() . '/' . '/college_image/';
                $filename = 'clg-I-' . time();
                $input['images'] = Helpers::imageUpload($img, $destination, $filename);
                $imgg = $input['images'];
                if ($imgg == '') {
                    return redirect()->back()->with('danger', 'Invalid extension of file you uploaded. You can only upload image or pdf.');
                }
                $input['images'] = $imgg;
            }

            if ( !empty($input['videos']) ) {
                $input['videos'] = json_encode($input['videos']);
            }
            
            if ( !empty($input['course']) ) {
                
                $coursee = $input['course'];            
                $c_id = json_encode($coursee);
                $input['stream_id'] = implode(',', array_keys($coursee));
                $input['courses_details'] = $c_id;
                unset($input['course']);
            }
        
            if ( !empty($input['course_fee']) ) {
                # course fee
                $course_fee = $input['course_fee'];
                $c_fee = json_encode($course_fee);
                $input['course_fee'] = $c_fee;
            }

            if ( !empty($input['course_seats']) ) {
                # course seats
                $course_seats = $input['course_seats'];
                $c_seats = json_encode($course_seats);
                $input['course_seats'] = $c_seats;
            }
            
            if ( !empty($input['course_eligibility']) ) {
                # course eligibility
                $course_eligibility = $input['course_eligibility'];
                $c_eligibility = json_encode($course_eligibility);
                $input['course_eligibility'] = $c_eligibility;
            }

            if( !empty($input['exams_accepted']) ) {
                $exams_acceptede = $input['exams_accepted'];
                $c_id = json_encode($exams_acceptede);
                $input['exams_accepted'] = $c_id;
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('college')->where('id', $id)->value('image');

                @unlink(asset('/public/college/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('college/');

                $fileName = 'college-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            if (!request()->file('brochure_or_pdf')) {

                unset($input['brochure_or_pdf']);
            } else {

                $brochure_or_pdf = DB::table('college')->where('id', $id)->value('brochure_or_pdf');

                @unlink(asset('/public/college/' . $brochure_or_pdf));

                $file = request('brochure_or_pdf');

                $thumbnailPath = public_path('college/');

                $fileName = 'college-' . time() . random_int(0, 10);

                $input['brochure_or_pdf'] = Helpers::upload_pdf($file, $thumbnailPath, $fileName);

                if ($input['brochure_or_pdf'] == '') {
                    return redirect()->back()->with('error', 'invalid pdf provided');
                }
            }

            if (!request()->file('background_image')) {

                unset($input['background_image']);
            } else {

                $background_image = DB::table('college')->where('id', $id)->value('background_image');

                @unlink(asset('/public/college/' . $background_image));

                $file = request('background_image');

                $thumbnailPath = public_path('college/');

                $fileName = 'college-' . time() . random_int(0, 10);

                $input['background_image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['background_image'] == '') {
                    return redirect()->back()->with('error', 'invalid background image provided');
                }
            }

            $faq = request()->get('faq');

            if (!empty($faq)) {
                    
                DB::table('college_faq')
                    ->where('college_id', $id)
                    ->delete();    
                    
                foreach ($faq as $specific) {

                    $specific_data = array();
                    $specific_data['college_id'] = $id;
                    $specific_data['name'] = $specific['name'];
                    $specific_data['value'] = $specific['value'];
                    
                    if( 
                        !empty($specific_data['name'])
                        or
                        !empty($specific_data['value'])
                    ) {
                        DB::table('college_faq')->insert($specific_data);
                    }
                }
            }

            DB::table('college')->where('id', $id)->update($input);

            return redirect()->action('CollegeController@view_college')->with('success', 'College Updated successfully');
        } else {
            $getcollege = DB::table('college')->where('id', $id)->first();
            $allstate = DB::table('states')->get();
            $allcountry = DB::table('countries')->get();
            $allfacility = DB::table('facility')->where('status','enable')->get();
            $allstream = DB::table('streams')->where('status','enable')->get();
            $allcourses = DB::table('courses')->where('type','college')->where('status','enable')->get(['id', 'stream_id', 'name']);
            $allcities = DB::table('cities')->get();

            if( empty($getcollege) ) {
                abort(404);
            }
  
            $getcollege->faq = DB::table('college_faq')
                                ->where('college_id', $id)
                                ->get();
            
            $college_category = DB::table('college_category')
                                ->whereStatus('enable')
                                ->get();

            $exams = $this->exams();
            
            return view('college.edit_college', compact('allcountry','allstate', 'allfacility', 'allstream', 'allcourses', 'getcollege', 'allcities', 'college_category', 'exams'));
        }
    }

    public function allstreams(Request $request)
    {
        return DB::table('streams')->select('name as text', 'id as value')->get();
    }

    public function updatecolgstatus($id, $status)
    {
        $Cities = DB::table('college')->where('id', $id)->first();
        if (!empty($Cities)) {
            $data['status'] = $status;
            $getcities = DB::table('college')->where('id', $id)->update($data);
        }

        if($status == 1)
            return redirect()
                        ->action('CollegeController@view_college')
                        ->with('success', 'College enable successfully!');
        else
            return redirect()
                        ->action('CollegeController@view_college')
                        ->with('error', 'College disable successfully!');
    }

    public function add_colgimages(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $photo['id'] = $input['colgid'];
            if ($request->file('images')) {
                $img = $request->file('images');
                $destination = public_path() . '/' . '/college_image/';
                $filename = 'clg-I-' . time();
                $input['images'] = Helpers::imageUpload($img, $destination, $filename);
                $imgg = $input['images'];
                if ($imgg == '') {
                    return redirect()->back()->with('danger', 'Invalid extension of file you uploaded. You can only upload image.');
                }
                $data['images'] = $imgg;
            }
            $getimg = DB::table('college')->where('id', $photo['id'])->first()->images;
            $photo['images'] = $getimg . '{$}' . $data['images'];
            DB::table('college')->where('id', $photo['id'])->update($photo);
            return redirect()
                    ->action('CollegeController@view_colgimage', $photo['id'])
                    ->with('success', 'Image upload successfully');
        } else {
            return view('college.add_collegeimage', compact('id'));
        }
    }

    public function view_colgimage($cid)
    {
        $getimage = DB::table('college')->where('id', $cid)->select('images')->first();
        return view('college.view_collegeimage', compact('cid', 'getimage'));
    }

    public function delete_colgimage(Request $request, $id, $cid)
    {
        $getimg = DB::table('college')->where('id', $cid)->select('images')->first();
        $abc = explode('{$}', $getimg->images);
        foreach ($abc as $key => $test) {
            if ($key == $id) {
                unset($abc[$key]);
            }
        }
        $data1 = array_values(array_filter($abc));
        $image_field['images'] = implode('{$}', $data1);
        DB::table('college')->where('id', $cid)->update($image_field);
        return redirect()->back()->with('danger', 'Image Removed');
    }

    public function add_colgvideo(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $videos['id'] = $input['colgid'];
            if ($request->file('videos')) {
                $img = $request->file('videos');
                $destination = public_path() . '/' . '/college_video/';
                $filename = 'clg-V-' . time();
                $input['videos'] = Helpers::videoUpload($img, $destination, $filename);
                $imgg = $input['videos'];
                if ($imgg == '') {
                    return redirect()->back()->with('danger', 'Invalid extension of file you uploaded. You can only upload mp3 or mkv.');
                }
                $input['videos'] = $imgg;
            }
            $getimg = DB::table('college')->where('id', $videos['id'])->first()->videos;
            $videos['videos'] = $getimg . '{$}' . $input['videos'];
            DB::table('college')->where('id', $videos['id'])->update($videos);
            return redirect()
                    ->action('CollegeController@view_colgvideo', $videos['id'])
                    ->with('success', 'Video upload successfully');
        } else {
            return view('college.add_collegevideo', compact('id'));
        }
    }

    public function view_colgvideo($cid)
    {
        $getimage = DB::table('college')->where('id', $cid)->select('videos')->first();
        return view('college.view_collegevideo', compact('cid', 'getimage'));
    }

    public function delete_colgvideo(Request $request, $id, $cid)
    {
        $getvideo = DB::table('college')->where('id', $cid)->select('videos')->first();
        $abc = explode('{$}', $getvideo->videos);
        foreach ($abc as $key => $test) {
            if ($key == $id) {
                unset($abc[$key]);
            }
        }
        $data1 = array_values(array_filter($abc));
        $videos_field['videos'] = implode('{$}', $data1);
        DB::table('college')->where('id', $cid)->update($videos_field);
        return redirect()->back()->with('danger', 'Video Removed');
    }

    public function delete_facility($id, $i)
    {
        $facidata = DB::table('college')->where('id', $id)->first();
        $facility = explode(',', $facidata->facilities);
        if (!empty($facility)) {
            foreach ($facility as $key => $value) {
                if ($key == $i) {
                    unset($facility[$key]);
                }
            }
            $data1 = array_values(array_filter($facility));
            $facility_field['facilities'] = implode(',', $data1);
        }
        DB::table('college')->where('id', $id)->update($facility_field);
        return redirect()->back()->with('warning', 'Remove One Field');
    }

    public function college_category()
    {
        return DB::table('college_category')->get();
    }

    # college valuable
    public function add_valuable()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CollegeController@view_college');
            }

            $college = DB::table('college')
                ->where('id', $input['id'])
                ->first();

            if (empty($college)) {
                return back()->with('error', 'Invalid college id provided');
            } else {
                $college_id = $input['id'];
            }

            $college_name = $college->college_name;

            $college_courses = '';

            return view('college.add_valuable', compact('college_courses', 'college_id', 'college_name'));
        } else {

            $is_exists = DB::table('college')
                ->where('id', $input['college_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'College does not exists');
            }

            $valuable = $input['valuable'];

            if (!empty($valuable)) {
                foreach ($valuable as $valuable) {

                    $valuable_data = array();
                    $valuable_data['college_id'] = $input['college_id'];
                    $valuable_data['name'] = $valuable['name'];
                    $valuable_data['description'] = !empty($valuable['description']) ? $valuable['description'] : '';

                    $image = '';

                    $file = $valuable['image'];

                    $thumbnailPath = public_path('college_valuable/');

                    $fileName = 'college_valuable-' . time() . random_int(0, 10);

                    $valuable_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                    if ($valuable_data['image'] == '') {
                        return redirect()->back()->with('error', 'invalid image provided');
                    }

                    DB::table('college_valuable')->insert($valuable_data);
                }
            }

            return redirect()
                    ->action('CollegeController@view_college')
                    ->with('success', 'College valuable Added successfully');
        }
    }

    public function view_college_valuable()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CollegeController@view_college');
        }

        $college = DB::table('college')
            ->where('id', $input['id'])
            ->first();

        if (empty($college)) {
            return back()->with('error', 'Invalid college id provided');
        } else {
            $college_id = $input['id'];
        }

        $college_name = $college->college_name;

        return view('college.view_college_valuable', compact('college_id', 'college_name'));
    }

    public function view_college_valuable_dt(Request $request)
    {

        $columns = array(
            0 => 'college_valuable.id',
            1 => 'college_valuable.name',
            2 => 'college_valuable.name',
            3 => 'college_valuable.created_at',
            4 => 'college_valuable.category',
            5 => 'college_valuable.year',
            6 => 'college_valuable.status',
            7 => 'college_valuable.image',
            8 => 'college_valuable.description',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $college_id = $request->input('college_id');

        $query = DB::table('college_valuable')
            ->where('college_valuable.college_id', $college_id);

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('college_valuable.name', 'LIKE', '%' . $name . '%');
            }
        }

        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('college_valuable.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('college_valuable.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            ->select('college_valuable.*')
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

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $image = asset('public/college_valuable/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CollegeController@delete_college_valuable', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CollegeController@delete_college_valuable', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['description'] = '<div aria-label="'.$post->description.'" data-balloon-pos="up">'.substr($post->description, 0, 20).'</div>';
                $nestedData['image'] = '<img src="' . asset('public/college_valuable/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
				<i class="fad fa-pencil"></i>
				</button>
				<div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit valuable</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
                            <form action="' . action('CollegeController@edit_college_valuable') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url(' . $image . ');" upload-pic="" name="image">
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="' . $post->name . '" name="name" required placeholder="Enter Name">
                                </div>                          
                                <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="Enter description">
                                    '. $post->description .'
                                    </textarea>
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary my-2" value="Update">
                            </form>
						</div>
					</div>
					</div>
				</div>
                </div>
                ' . $new_status . '</div>';

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

    public function edit_college_valuable()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('college_valuable')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This valuable already exists');
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('college_valuable')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/college_valuable/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('college_valuable/');

                $fileName = 'valuable-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('college_valuable')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'College valuable Updated successfully');
        }
    }

    public function delete_college_valuable()
    {

        $input = request()->except('_token');

        $old_status = DB::table('college_valuable')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('college_valuable')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'College valuable ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'College valuable ' . $new_status . ' successfully');
    }

    public function is_college_featured()
    {
        if(
            request()->isMethod('post')
        ) {

            $input = request()->except('_token');

            $old_is_featured = DB::table('college')->where('id', $input['id'])->value('featured');

            $new_is_featured = ($old_is_featured == '0') ? '1' : '0';

            DB::table('college')->where('id', $input['id'])->update(['featured' => $new_is_featured]);
            return redirect()->back();
        } else {
            return back();
        }
    }

    public function exams() {
        return DB::table('exams')
                ->join('streams', 'streams.id', 'exams.stream_id')
                ->join('courses', 'courses.id', 'exams.course_id')
                ->where('exams.status', 'enable')
                ->where('streams.status', 'enable')
                ->where('courses.status', 'enable')
                ->orWhere('exams.status', 1)
                ->select('streams.id as sid', 'streams.name', 'exams.title', 'exams.id')
                ->orderby('exams.created_at', 'desc')
                ->get()
                ->groupBy(function ($query) {
                    return $query->name;
                });
    }
}