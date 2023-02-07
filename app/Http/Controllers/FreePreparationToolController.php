<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class FreePreparationToolController extends Controller
{
    public function add_question_paper_subjects()
    {

        if (request()->isMethod('get')) {

            $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();

            return view('question_paper_subjects.add_question_paper_subjects', compact('streams'));
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('question_paper_subjects')
                ->where('course_id', $input['course_id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This Question Paper Subject name already exists with this stream');
            }

            $image = '';
            if(!empty(request('image'))){
                $file = request('image');

                $thumbnailPath = public_path('question_paper_subjects/');

                $fileName = 'question_paper_subjects-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            if( request()->has('brochure_or_pdf') ) {
                
                $pdf = '';

                $file = request('brochure_or_pdf');

                $thumbnailPath = public_path('question_paper_subjects/');

                $fileName = 'question_paper_subjects-' . time() . random_int(0, 10);

                $input['brochure_or_pdf'] = Helpers::upload_pdf($file, $thumbnailPath, $fileName);

                if ($input['brochure_or_pdf'] == '') {
                    return redirect()->back()->with('error', 'invalid pdf provided');
                }
                
            }

            try {
                DB::table('question_paper_subjects')->insert($input);
            } catch(\Exception $e) {
                dd($e->getMessage());
                return redirect()
                            ->back()
                            ->with('error', 'Please fill out all the fields');
            }

            return redirect()
                        ->action('FreePreparationToolController@view_question_paper_subjects')
                        ->with('success', 'Question Paper Subject Added successfully');
        }
    }

    public function edit_question_paper_subjects()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('FreePreparationToolController@view_question_paper_subjects');
            }

            $streams = DB::table('streams')->where('status','enable')
                ->select('id', 'name')
                ->get();

            $question_paper_subjects = DB::table('question_paper_subjects')
                ->where('id', $input['id'])
                ->first();

            return view('question_paper_subjects.edit_question_paper_subjects', compact('streams', 'question_paper_subjects'));
        } else {

            $is_exists = DB::table('question_paper_subjects')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->where('course_id', $input['course_id'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'Question paper subject already exists with this name');
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('question_paper_subjects')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/question_paper_subjects/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('question_paper_subjects/');

                $fileName = 'question_paper_subjects-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            if (!request()->file('brochure_or_pdf')) {

                unset($input['brochure_or_pdf']);
            } else {

                $brochure_or_pdf = DB::table('question_paper_subjects')->where('id', $input['id'])->value('brochure_or_pdf');

                @unlink(asset('/public/question_paper_subjects/' . $brochure_or_pdf));

                $file = request('brochure_or_pdf');

                $thumbnailPath = public_path('question_paper_subjects/');

                $fileName = 'question_paper_subjects-' . time() . random_int(0, 10);

                $input['brochure_or_pdf'] = Helpers::upload_pdf($file, $thumbnailPath, $fileName);

                if ($input['brochure_or_pdf'] == '') {
                    return redirect()->back()->with('error', 'invalid pdf provided');
                }
            }

            DB::table('question_paper_subjects')->where('id', $input['id'])->update($input);

            return redirect()
                        ->action('FreePreparationToolController@view_question_paper_subjects')
                        ->with('success', 'Question paper subject updated successfully');
        }
    }

    public function delete_question_paper_subjects()
    {

        $input = request()->except('_token');

        $old_status = DB::table('question_paper_subjects')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('question_paper_subjects')->where('id', $input['id'])->update(['status' => $new_status]);

        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Question paper subject ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Question paper subject ' . $new_status . ' successfully');
    }

    public function view_question_paper_subjects()
    {

        $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();

        return view('question_paper_subjects.view_question_paper_subjects', compact('streams'));
    }

    public function view_question_paper_subjects_dt(Request $request)
    {

        $columns = array(
            0 => 'question_paper_subjects.id',
            1 => 'streams.name',
            2 => 'courses.name',
            3 => 'question_paper_subjects.name',
            4 => 'question_paper_subjects.created_at',
            5 => 'question_paper_subjects.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('question_paper_subjects')
            ->join('streams', 'streams.id', 'question_paper_subjects.stream_id')
            ->join('courses', 'courses.id', 'question_paper_subjects.course_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('question_paper_subjects.name', $name);
            }
        }

        if (request()->has('stream_id')) {
            $stream_id = request('stream_id');
            if ($stream_id != "") {
                $query->where('question_paper_subjects.stream_id', $stream_id);
            }
        }

        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('question_paper_subjects.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('question_paper_subjects.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            ->select('question_paper_subjects.*', 'streams.name as stream', 'courses.name as course')
            ->get();

        $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();

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

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm mx-1 btn-danger" href="' . action('FreePreparationToolController@delete_question_paper_subjects', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm mx-1 btn-outline-danger" href="' . action('FreePreparationToolController@delete_question_paper_subjects', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['stream'] = $post->stream;
                $nestedData['course'] = $post->course;
                if( strlen($post->name) >= 40 ) {
                    $nestedData['name'] = '<span data-balloon-length="xlarge" aria-label="' . $post->name . '" data-balloon-pos="up">' . substr($post->name, 0, 40) . '...</span>';
                } else {
                    $nestedData['name'] = $post->name;
                }
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                
                $nestedData['status'] = '<span class="text-capitalize">' . $post->status . '</span>';
                $nestedData['action'] = '
                <div class="row">
                <a class="btn btn-sm mx-1 w-35px h-35px rounded-pill d-grid align-items-center justify-content-center btn-success" href="' . action('FreePreparationToolController@edit_question_paper_subjects', 'id=' . $post->id) . '" data-balloon-pos="up" aria-label="Edit"><i class="fad fa-pencil-alt"></i></a>
                ' . $new_status . '
                <a class="btn btn-sm mx-1 w-35px h-35px rounded-pill d-grid align-items-center justify-content-center btn-info" href="' . action('QuestionAnswerController@add_question_answer', 'id=' . $post->id) . '" data-balloon-pos="up" aria-label="Add MCQs"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm mx-1 w-35px h-35px rounded-pill d-grid align-items-center justify-content-center btn-warning" href="' . action('QuestionAnswerController@view_question_answer', 'id=' . $post->id) . '" data-balloon-pos="up" aria-label="View MCQs"><i class="fas fa-eye"></i></a>
               </div>';

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
}