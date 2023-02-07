<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class StudentQuestionsAnswersController extends Controller
{
  public function delete_student_questions()
  {
   

    $input = request()->except('_token');

    $old_status = DB::table('student_questions')->where('id', $input['id'])->value('status');

    $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

    DB::table('student_questions')->where('id', $input['id'])->update(['status' => $new_status]);

    if($new_status == 'enable')
      return redirect()->back()->with('success', 'Student Question ' . $new_status . ' successfully');
    else
      return redirect()->back()->with('danger', 'Student Question ' . $new_status . ' successfully');
  }

  public function view_student_questions()
  {
    
    return view('student_questions_answers.view_student_questions');
  }

  public function view_student_questions_dt(Request $request)
  {
    $columns = array(
      0 => 'student_questions.id',
      1 => 'students.name',
      2 => 'student_questions.name',
      3 => 'student_questions.total_answered',
      4 => 'student_questions.views',
      5 => 'student_questions.report',
      6 => 'student_questions.created_at',
    );

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $query = DB::table('student_questions')
      ->join('students', 'students.id', 'student_questions.user_id')
      ->select('student_questions.*', 'students.name as student_name');

    if (request()->has('name')) {
      $name = request('name');
      if ($name != "") {
        $query->where('student_questions.name', 'LIKE', '%' . $name . '%');
      }
    }

    if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('student_questions.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('student_questions.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
        $posts = $posts
                    ->orderBy('student_questions.created_at', 'desc');
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

        $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('StudentQuestionsAnswersController@delete_student_questions', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('StudentQuestionsAnswersController@delete_student_questions', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

        $nestedData['student_name'] = $post->student_name;
        
        if( strlen($post->name) >= 40 ) {
            $nestedData['name'] = '<span data-balloon-length="xlarge" aria-label="' . $post->name . '" data-balloon-pos="up">' . substr($post->name, 0, 40) . '...</span>';
        } else {
            $nestedData['name'] = $post->name;
        }

        $nestedData['total_answered'] = $post->total_answered;
        $nestedData['views'] = $post->views;
        $nestedData['report'] = $post->report;
        $nestedData['status'] = $post->status;

        $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
        $nestedData['action'] = '
        <div class="d-flex"><a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('StudentQuestionsAnswersController@view_student_answers', 'id=' . $post->id) . '" aria-label="View Answers" data-balloon-pos="up"><i class="fad fa-eye"></i></a>
        ' . $new_status . '</div>';

        // report background change and seen
        
        $nestedData['is_pending'] = DB::table('student_questions_report')
                                    ->where('student_questions_id', $post->id)
                                    ->where('is_seen', 0)
                                    ->count();

        DB::table('student_questions_report')
          ->where('student_questions_id', $post->id)
          ->update([
              'is_seen' => 1
          ]);
          
        $nestedData['is_pending_answers'] = DB::table('student_answers')
                                            ->where('student_answers.student_question_id', $post->id)
                                            ->join(
                                            'student_answers_report', 
                                            'student_answers_report.student_answers_id',
                                            'student_answers.id'
                                            )
                                            ->where('student_answers_report.is_seen', 0)
                                            ->count();
          
        // report background change and seen

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


  public function view_student_answers()
  {
  

    $input = request()->except('_token');

    if (empty($input['id'])) {
      return redirect()->action('StudentQuestionsAnswersController@view_student_questions');
    }

    return view('student_questions_answers.view_student_answers', [
      'id' => $input['id']
    ]);
  }

  public function view_student_answers_dt(Request $request)
  {
    
    $columns = array(
      0 => 'student_answers.id',
      1 => 'student_answers.name',
      2 => 'student_answers.name',
      3 => 'student_answers.report',
      4 => 'student_answers.created_at',
      5 => 'student_answers.status',
      6 => 'student_answers.status',
    );

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $query = DB::table('student_answers')
      ->where('student_question_id', request()->get('id'))
      ->join('students', 'students.id', 'student_answers.user_id')
      ->select('student_answers.*', 'students.name as student_name');

    if (request()->has('name')) {
      $name = request('name');
      if ($name != "") {
        $query->where('student_answers.name', 'LIKE', '%' . $name . '%');
      }
    }

    if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('student_answers.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('student_answers.created_at', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}

    $posts = $query;

      if(
          $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
      ) {
          $posts = $posts
                    ->orderBy('student_answers.created_at', 'desc');
      } else {
          $posts = $posts->orderBy($order, $dir);
      }
      

    $totalData = $query->count();
    $totalFiltered = $totalData;
    
    $posts = $posts
            ->offset($start)
            ->limit($limit);
    
    $posts = $posts
            ->get();

    if (!empty($posts)) {
      $data = array();
      $count = 1;

      foreach ($posts as $post) {

        $confirm = "return confirmation('Are you sure?') ";

        $nestedData['id'] = $count;

        $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('StudentQuestionsAnswersController@delete_student_answers', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('StudentQuestionsAnswersController@delete_student_answers', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

        $nestedData['student_name'] = $post->student_name;

        if( strlen($post->name) >= 40 ) {
            $nestedData['name'] = '<span data-balloon-length="xlarge" aria-label="' . $post->name . '" data-balloon-pos="up">' . substr($post->name, 0, 40) . '...</span>';
        } else {
            $nestedData['name'] = $post->name;
        }

        $nestedData['status'] = $post->status;

        $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
        $nestedData['action'] = $new_status;

        // report background change and seen
        
        $nestedData['is_pending'] = DB::table('student_answers_report')
                                    ->where('student_answers_id', $post->id)
                                    ->where('is_seen', 0)
                                    ->count();

        DB::table('student_answers_report')
          ->where('student_answers_id', $post->id)
          ->update([
              'is_seen' => 1
          ]);
          
        // report background change and seen
        
        $nestedData['report'] = $post->report;


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
    echo json_encode($json_data);
  }

  public function delete_student_answers()
  {

    $input = request()->except('_token');

    $old_status = DB::table('student_answers')->where('id', $input['id'])->value('status');

    $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

    DB::table('student_answers')->where('id', $input['id'])->update(['status' => $new_status]);

    if($new_status == 'enable')
      return redirect()->back()->with('success', 'Student Answer ' . $new_status . ' successfully');
    else
      return redirect()->back()->with('danger', 'Student Answer ' . $new_status . ' successfully');
  }
}