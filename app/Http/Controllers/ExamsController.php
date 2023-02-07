<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class ExamsController extends Controller
{

    public function add_exam()
    {

        if (request()->isMethod('get')) {

            $streams = DB::table('streams')->where('status','enable')
                ->select('id', 'name')
                ->get();

            return view('exams.add_exam', compact('streams'));
        } else {

            $input = request()->except('_token');

            if (!empty($input)) {

                $is_exists = DB::table('exams')
                    ->where('title', $input['title'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'A Exam with this title already exists');
                }

                if( request()->has('image') ) {
                
                    $image = '';

                    $file = request('image');

                    $thumbnailPath = public_path('exams/');

                    $fileName = 'exam-' . time() . random_int(0, 10);

                    $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                    if ($input['image'] == '') {
                        return redirect()->back()->with('error', 'invalid image provided');
                    }
                
                }

                if( request()->has('brochure_or_pdf') ) {
                
                    $pdf = '';

                    $file = request('brochure_or_pdf');

                    $thumbnailPath = public_path('exams/');

                    $fileName = 'exam-' . time() . random_int(0, 10);

                    $input['brochure_or_pdf'] = Helpers::upload_pdf($file, $thumbnailPath, $fileName);

                    if ($input['brochure_or_pdf'] == '') {
                        return redirect()->back()->with('error', 'invalid pdf provided');
                    }
                    
                }

                if( !empty($input['exam_language']) ) {

                    $input['exam_language'] = implode(',', $input['exam_language']);
                }

                try {
                    DB::table('exams')->insert($input);
                } catch(\Exception $e) {
                    return redirect()
                                ->back()
                                ->with('error', 'Please fill out required fields');
                }

                return redirect()
                            ->action('ExamsController@view_exam')
                            ->with('success', 'Exam Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_exam()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('ExamsController@view_exam');
            }

            $streams = DB::table('streams')->where('status','enable')
                ->select('id', 'name')
                ->get();

            $exam = DB::table('exams')
                ->where('id', $input['id'])
                ->first();

            return view('exams.edit_exam', compact('exam', 'streams'));
        } else {

            $is_exists = DB::table('exams')
                ->where('id', '!=', $input['id'])
                ->where('title', $input['title'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A Exam with this title already exists');
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('exams')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/exams/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('exams/');

                $fileName = 'exam-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            if (!request()->file('brochure_or_pdf')) {

                unset($input['brochure_or_pdf']);
            } else {

                $brochure_or_pdf = DB::table('exams')->where('id', $input['id'])->value('brochure_or_pdf');

                @unlink(asset('/public/exams/' . $brochure_or_pdf));

                $file = request('brochure_or_pdf');

                $thumbnailPath = public_path('exams/');

                $fileName = 'exam-' . time() . random_int(0, 10);

                $input['brochure_or_pdf'] = Helpers::upload_pdf($file, $thumbnailPath, $fileName);

                if ($input['brochure_or_pdf'] == '') {
                    return redirect()->back()->with('error', 'invalid pdf provided');
                }
            }

            if( !empty($input['exam_language']) ) {

                $input['exam_language'] = implode(',', $input['exam_language']);
            } else {
                $input['exam_language'] = '';
            }

            DB::table('exams')->where('id', $input['id'])->update($input);

            return redirect()->action('ExamsController@view_exam')->with('success', 'Exam Updated successfully');
        }
    }

    public function delete_exam()
    {

        $input = request()->except('_token');

        $old_status = DB::table('exams')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('exams')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Exam ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Exam ' . $new_status . ' successfully');
    }

    public function view_exam()
    {
        $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();
        return view('exams.view_exam', compact('streams'));
    }

    public function view_exam_dt(Request $request)
    {

        $columns = array(
            0 => 'exams.id',
            1 => 'streams.name',
            2 => 'courses.name',
            3 => 'exams.title',
            4 => 'exams.title',
            5 => 'exams.created_at',
            6 => 'exams.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('exams')
            ->join('courses', 'courses.id', 'exams.course_id')
            ->join('streams', 'streams.id', 'courses.stream_id');

        if (request()->has('title')) {
            $title = request('title');
            if ($title != "") {
                $query->where('exams.title', 'LIKE', '%' . $title . '%');
            }
        }
        
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('exams.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('exams.created_at', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}
        if(request()->has('stream_id')){
            $stream_id = request('stream_id');
            if($stream_id!=""){
                $query =  $query->where('exams.stream_id', $stream_id);
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
                ->select('exams.*', 'courses.name as course','streams.name as stream')
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

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('ExamsController@delete_exam', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('ExamsController@delete_exam', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';
                $default_img = "
                this.src='"  .asset('/public/s_img_new.php').'?image='. asset("public/logo.png") . "&width=60&height=60&zc=0'";
                
                if( strlen($post->title) >= 40 ) {
                    $nestedData['title'] = '<span data-balloon-length="xlarge" aria-label="' . $post->title . '" data-balloon-pos="up">' . substr($post->title, 0, 40) . '...</span>';
                } else {
                    $nestedData['title'] = $post->title;
                }

                $nestedData['stream'] = $post->stream;
                $nestedData['course'] = $post->course;
                $nestedData['image'] = '<img src="' .asset('/public/s_img_new.php').'?image='.asset('public/exams/' . $post->image) .'&width=60&height=60&zc=0"  onerror="' . $default_img . '">';
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '
                <div class="d-flex"><a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('ExamsController@edit_exam', 'id=' . $post->id) . '" aria-label="Edit" data-balloon-pos="up"><i class="fad fa-pencil"></i></a>
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

    public function stream_course()
    {   
        if(!empty(request()->get('type'))){
            $courses = DB::table('courses')->where('status','enable')
            ->where('stream_id', request()->get('stream_id'))
            ->where('type',request()->get('type'))->get();
        }
        else{

            $courses = DB::table('courses')->where('status','enable')
            ->where('stream_id', request()->get('stream_id'))
            ->get();
        }
        

        return $courses;
    }
}