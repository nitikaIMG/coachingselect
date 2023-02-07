<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class QuestionAnswerController extends Controller
{
    public function add_question_answer()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('QuestionAnswerController@view_question_answer');
            }

            $id = $input['id'];

            $subject_name = DB::table('question_paper_subjects')
                            ->where('id', $id)
                            ->value('name');
                            
            $course_name = DB::table('question_paper_subjects')
                            ->join('courses', 'courses.id', 'question_paper_subjects.course_id')
                            ->where('question_paper_subjects.id', $id)
                            ->value('courses.name');

            return view('question_answer.add_question_answer', compact('id', 'subject_name', 'course_name'));
        } else {

            $questions = $input['questions'];
            $question_paper_subject_id = $input['question_paper_subject_id'];

            if (!empty($questions)) {
                foreach ($questions as $question) {                    
                
                    $is_exists = DB::table('question_answer')
                        ->where('question', $question['question'])
                        ->where('question_paper_subject_id', $input['question_paper_subject_id'])
                        ->exists();

                    $input = array();
                            
                    $input['question_paper_subject_id'] = $question_paper_subject_id;

                    if (empty($question['image'])) {
                        $input['image'] = '';
                    } else {
                        $image = '';

                        $file = $question['image'];

                        $thumbnailPath = public_path('question_answer/');

                        $fileName = 'question_answer-' . time() . random_int(0, 10);

                        $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                        if ($input['image'] == '') {
                            return redirect()->back()->with('error', 'invalid image provided');
                        }
                    }

                    $options = [ 
                        'a' => $question['a_type'],
                        'b' => $question['b_type'],
                        'c' => $question['c_type'],
                        'd' => $question['d_type'],
                    ];

                    foreach($options as $option => $type) {

                        if( $type == 'image' ) {

                            # options images
                            $image = '';

                            $file = $question[$option];

                            $thumbnailPath = public_path('question_answer/');

                            $fileName = 'question_answer-' . time() . random_int(0, 10);

                            $input[$option] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                            if ($input[$option] == '') {
                                return redirect()->back()->with('error', 'invalid image provided');
                            }
                        } else {
                            $input[$option] = $question[$option];
                        }

                    }
                            
                    if( empty($question['answer']) ) {
                        return redirect()->back()->with('error', 'Please choose an answer');
                    }

                    $input['marks'] = $question['marks'];
                    $input['negative_marks'] = $question['negative_marks'];
                    $input['question'] = $question['question'];
                    $input['a_type'] = $question['a_type'];
                    $input['b_type'] = $question['b_type'];
                    $input['c_type'] = $question['c_type'];
                    $input['d_type'] = $question['d_type'];
                    $input['answer'] = implode(',', $question['answer']);
                    $input['is_mcq'] = ( count($question['answer']) >= 2 ) ?
                                        'true' :
                                        'false';
                    
                    DB::table('question_answer')->insert($input);
                }
            }

            return redirect()->action('QuestionAnswerController@view_question_answer', "id=".$input['question_paper_subject_id'])->with('success', 'Question Paper Added successfully');
        }
    }

    public function edit_question_answer()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('QuestionAnswerController@view_question_answer');
            }

            $question_answer = DB::table('question_answer')
                ->where('id', $input['id'])
                ->first();

            if( empty($question_answer) ) {
                abort(404);
            }

            return view('question_answer.edit_question_answer', compact('question_answer'));
        } else {

            $is_exists = DB::table('question_answer')
                ->where('id', '!=', $input['id'])
                ->where('question', $input['question'])
                ->where('question_paper_subject_id', $input['question_paper_subject_id'])
                ->exists();

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('question_answer')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/question_answer/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('question_answer/');

                $fileName = 'question_answer-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            
            $options = [ 
                'a' => $input['a_type'],
                'b' => $input['b_type'],
                'c' => $input['c_type'],
                'd' => $input['d_type'],
            ];

            foreach($options as $option => $type) {

                if( $type == 'image' ) {

                    if (!request()->file($option)) {

                        unset($input[$option]);
                        
                    } else {

                        # options images
                        $image = DB::table('question_answer')->where('id', $input['id'])->value($option);

                        @unlink(asset('/public/question_answer/' . $image));

                        $file = $input[$option];

                        $thumbnailPath = public_path('question_answer/');

                        $fileName = 'question_answer-' . time() . random_int(0, 10);

                        $input[$option] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                        if ($input[$option] == '') {
                            return redirect()->back()->with('error', 'invalid image provided');
                        }

                    }
                }

            }

            if( empty($input['answer']) ) {
                return redirect()->back()->with('error', 'Please choose an answer');
            }

            $input['is_mcq'] = ( count($input['answer']) >= 2 ) ?
                                'true' :
                                'false';
            $input['answer'] = implode(',', $input['answer']);

            DB::table('question_answer')->where('id', $input['id'])->update($input);

            return redirect()->action('QuestionAnswerController@view_question_answer', 'id='. $input['question_paper_subject_id'])->with('success', 'Question answer updated successfully');
        }
    }

    public function delete_question_answer()
    {

        $input = request()->except('_token');

        $old_status = DB::table('question_answer')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('question_answer')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Question answer ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Question answer ' . $new_status . ' successfully');
    }

    public function view_question_answer()
    {

        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('FreePreparationToolController@view_question_paper_subjects');
        }

        $question_paper_subject_id = $input['id'];
        
        $subject_name = DB::table('question_paper_subjects')
                        ->where('id', $question_paper_subject_id)
                        ->value('name');
                        
        $course_name = DB::table('question_paper_subjects')
                        ->join('courses', 'courses.id', 'question_paper_subjects.course_id')
                        ->where('question_paper_subjects.id', $question_paper_subject_id)
                        ->value('courses.name');

        return view('question_answer.view_question_answer', compact('question_paper_subject_id', 'subject_name', 'course_name'));
    }

    public function view_question_answer_dt(Request $request)
    {

        $columns = array(
            0 => 'question_answer.id',
            1 => 'question_answer.question',
            2 => 'question_answer.question',
            3 => 'question_answer.a',
            4 => 'question_answer.marks',
            5 => 'question_answer.negative_marks',
            6 => 'question_answer.created_at',
            7 => 'question_answer.answer',
            8 => 'question_answer.marks',
            9 => 'question_answer.negative_marks',
            10 => 'question_answer.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('question_answer')
            ->join('question_paper_subjects', 'question_paper_subjects.id', 'question_answer.question_paper_subject_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('question_answer.question', 'LIKE', '%'.$name.'%');
            }
        }

        if (request()->has('question_paper_subject_id')) {
            $question_paper_subject_id = request('question_paper_subject_id');
            if ($question_paper_subject_id != "") {
                $query->where('question_paper_subjects.id', $question_paper_subject_id);
            }
        }
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('question_answer.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('question_answer.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            $posts = $posts->orderBy('created_at', 'asc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->select('question_answer.*', 'question_paper_subjects.name as question_paper_subjects')
            ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('QuestionAnswerController@delete_question_answer', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('QuestionAnswerController@delete_question_answer', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['question_paper_subjects'] = $post->question_paper_subjects;
                
                $post->question = "$post->question";
                
                if( strlen($post->question) >= 40 ) {
                    $nestedData['question'] = '<span data-balloon-length="xlarge" aria-label="' . $post->question . '" data-balloon-pos="up">' . substr($post->question, 0, 40) . '...</span>';
                } else {
                    $nestedData['question'] = $post->question;
                }

                $nestedData['a'] = ($post->a_type == 'image') ? 
                                   ('<img src="' . asset('public/question_answer/' . $post->a) . '" width=60 onerror="' . $default_img . '">') :
                                   $post->a ;
                                   
                $nestedData['b'] = ($post->b_type == 'image') ? 
                                   ('<img src="' . asset('public/question_answer/' . $post->b) . '" width=60 onerror="' . $default_img . '">') :
                                   $post->b ;
                                   
                $nestedData['c'] = ($post->c_type == 'image') ? 
                                   ('<img src="' . asset('public/question_answer/' . $post->c) . '" width=60 onerror="' . $default_img . '">') :
                                   $post->c ;
                                   
                $nestedData['d'] = ($post->d_type == 'image') ? 
                                   ('<img src="' . asset('public/question_answer/' . $post->d) . '" width=60 onerror="' . $default_img . '">') :
                                   $post->d ;
                
                $nestedData['answer'] = $post->answer;
                $nestedData['marks'] = $post->marks;
                $nestedData['negative_marks'] = $post->negative_marks;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '
                <div class="d-flex"><a class="btn btn-sm mx-1 w-35px h-35px rounded-pill d-grid align-items-center justify-content-center btn-success" href="' . action('QuestionAnswerController@edit_question_answer', 'id=' . $post->id) . '" data-balloon-pos="up" aria-label="Edit"><i class="fad fa-pencil-alt"></i></a>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        $json_data = mb_convert_encoding($json_data, "UTF-8", "auto");

        return response()->json($json_data);
    }
}