<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class StreamsController extends Controller
{

    public function add_stream()
    {
        // 
        if (request()->isMethod('get')) {

            return view('streams.add_stream');
        } else {

            $input = request()->except('_token');

            if (!empty($input)) {

                $is_exists = DB::table('streams')
                    ->where('name', $input['name'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'This stream already exists');
                }
                
                DB::table('streams')->insert($input);
    
                return redirect()
                            ->action('StreamsController@view_stream')
                            ->with('success', 'Stream Added successfully');

            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_stream()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('streams')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This stream already exists');
            }

            if (!empty($input['image'])) {
                $input['image'] = $input['image'];
            } else {
                unset($input['image']);
            }

            DB::table('streams')->where('id', $input['id'])->update($input);

            return redirect()
                        ->action('StreamsController@view_stream')
                        ->with('success', 'Stream Updated successfully');
        }
    }

    public function delete_stream()
    {

        $input = request()->except('_token');

        $old_status = DB::table('streams')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('streams')->where('id', $input['id'])->update(['status' => $new_status]);
                
        // disable its courses and coaching courses
        DB::table('courses')->where('stream_id', $input['id'])->update([
            'status' => $new_status ]);
        DB::table('courses')
        ->join('coaching_courses', 'coaching_courses.name', 'courses.name')
        ->join('coaching_courses_detail', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
        ->where('courses.stream_id', $input['id'])
        ->update([
            'courses.status' => $new_status,
            'coaching_courses.status' => $new_status,
            'coaching_courses_detail.status' => $new_status
        ]);
     
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Stream ' . $new_status . ' successfully');
        else
        return redirect()->back()->with('success', 'Stream ' . $new_status . ' successfully');
    }

    public function view_stream()
    {
        return view('streams.view_stream');
    }

    public function view_stream_dt(Request $request)
    {

        $columns = array(
            0 => 'streams.id',
            1 => 'streams.name',
            2 => 'streams.name',
            3 => 'streams.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('streams');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('streams.name', 'LIKE', '%' . $name . '%');
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
            $posts = $posts->orderBy('streams.created_at', 'desc');
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

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('StreamsController@delete_stream', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('StreamsController@delete_stream', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a></div>';

                $nestedData['name'] = $post->name;
                $nestedData['status'] = $post->status;
                $nestedData['image'] = $post->image;
                $nestedData['action'] = '<button type="button" class="btn btn-sm btn-success h-35px w-35px" aria-label="Edit" data-balloon-pos="up" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '"><i class="fad fa-pencil-alt"></i></button>
				<div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit stream</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
                            <form action="' . action('StreamsController@edit_stream') . '" class="form" enctype="multipart/form-data" method="post" id="edit_stream' . $post->id . '"
                                onsubmit="return verify_icon('.$post->id.', this)"
                            >                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">



                                <div class="row align-items-center">
                                <div class="col-auto align-self-stretch">
                                    <div class="row h-100 w-80px ml-0 align-items-center bg-secondary rounded-10 text-white">
                                        <div class="col text-center fs-35" id="icon' . $post->id . '">
                                        ' . $post->image . '
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Stream Icon</label>
                                                <div class="input-group">
                                                    <input type="text" name="image" oninput="show_icon(' . $post->id . ',this)" class="form-control" placeholder="Enter icon code" onchange="check_icon(' . $post->id . ',this)">
                                                    <div class="input-group-append">
                                                        <a href="https://fontawesome.com/icons?d=gallery" class="btn btn-sm btn-primary" target="_blank"><i class="fad fa-icons"></i>&nbsp; All Icons</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Stream Name</label>
                                                <input type="text" value="' . $post->name . '" class="form-control" name="name" placeholder="Enter Stream Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            </form>
						</div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success text-uppercase"
                        form="edit_stream' . $post->id . '"
                        >Update</button>
                    </div>
					</div>
				</div>
                </div>
                '. $new_status . '
                <a class="btn btn-sm btn-info h-35px w-35px" aria-label="Add course" data-balloon-pos="up" href="' . action('CoursesController@add_course', 'stream_id=' . $post->id) . '"><i class="fas fa-plus"></i></a>';

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