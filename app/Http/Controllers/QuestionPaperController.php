<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class QuestionPaperController extends Controller
{

    public function add_course_subject() {

        $input = request()->except('_token');

        if(request()->isMethod('get')) {
            
            if( empty($input['id']) ) {
                return redirect()->action('QuestionPaperController@view_question_paper');
            }

            $course_id = $input['id'];

            return view('question_papers.add_course_subject', compact('course_id'));

        } else {

            $is_exists = DB::table('question_papers')
                            ->where('stream_id', $input['stream_id'])
                            ->where('name', $input['name'])
                            ->exists();

            if($is_exists) {
                return back()->with('error', 'This question_paper already exists with this stream');
            }

            DB::table('question_papers')->insert($input);

            return redirect()->back()->with('success', 'Question paper Added successfully');
        }
    }

    public function edit_question_paper() {

        if(request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('question_papers')
                            ->where('id', '!=', $input['id'])
                            ->where('stream_id', $input['stream_id'])
                            ->where('name', $input['name'])
                            ->exists();

            if($is_exists) {
                return back()->with('error', 'This question_paper already exists with this stream');
            }

            DB::table('question_papers')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Question paper Updated successfully');
        }
    }

    public function delete_question_paper() {

        $input = request()->except('_token');

        DB::table('question_papers')->where('id', $input['id'])->delete();

        return redirect()->back()->with('success', 'Question paper deleted successfully');
    }

    public function view_question_paper() {

        $streams = DB::table('streams')->select('id', 'name')->get();

        return view('question_papers.view_question_paper', compact('streams'));

    }
    
    public function view_question_paper_dt(Request $request) {

		$columns = array(
			0 => 'question_papers.id',
			1 => 'question_papers.name',
			2 => 'streams.id',
		);

		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $query = DB::table('question_papers')
                    ->join('streams', 'streams.id', 'question_papers.stream_id');
        
          if(request()->has('name')){
            $name=request('name');
            if($name!=""){
              $query->where('question_papers.name',$name);
            }
          }
          
          if(request()->has('stream_id')){
            $stream_id=request('stream_id');
            if($stream_id!=""){
              $query->where('question_papers.stream_id',$stream_id);
            }
          }

		$totalData = $query->count();
        $totalFiltered = $totalData;

		$posts = $query
				->offset($start)
				->limit($limit)
                ->orderBy($order, $dir)
                ->select('question_papers.*', 'streams.name as stream')
                ->get();   
                
        $streams = DB::table('streams')->select('id', 'name')->get();
        
		if (!empty($posts)) {
            $data = array();
            $count = 1;
            
			foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

				$nestedData['id'] = $count;
				
                $nestedData['name'] = $post->name;
                $nestedData['stream'] = $post->stream;
                $nestedData['action'] = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter'.$post->id.'">
				Edit
				</button>
				<div class="modal fade" id="exampleModalCenter'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter'.$post->id.'Title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit Question paper</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
                            <form action="'.action('QuestionPaperController@edit_question_paper').'" class="form" enctype="multipart/form-data" method="post">                                
                                '.csrf_field().'
                                <input type="hidden" class="form-control" value="'.$post->id.'" name="id">
                                <select name="stream_id" id="stream_id" class="form-control my-2" required>
                                    <option value="">Select Stream</option>';

                                    if( !empty($streams) ) {
                                        foreach($streams as $stream) {

                                            $is_selected = '';

                                            if($stream->name == $post->stream) {
                                                $is_selected = 'selected';
                                            }

                                            $nestedData['action'] .='<option value="'.$stream->id.'" '.$is_selected.'>'.$stream->name.'</option>';
                                        }
                                    }
                                    
                $nestedData['action'] .='</select>
                                <input type="text" class="form-control" value="'.$post->name.'" name="name" required>
                                
                                <input type="submit" class="btn btn-sm btn-primary btn-sm btn-block my-2" value="Update">
                            </form>
						</div>
					</div>
					</div>
				</div>
                </div>
                <a class="btn btn-sm btn-danger" href="'.action('QuestionPaperController@delete_question_paper', 'id='.$post->id).'" onclick="'.$confirm.'">Delete</a>
                <a class="btn btn-sm btn-info" href="'.action('QuestionPaperController@add_course_subject', 'id='.$post->id).'" onclick="'.$confirm.'">Add Question Paper</a>';
                
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

}