<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class CoursesController extends Controller
{

    public function add_course()
    {

        if (request()->isMethod('get')) {

            $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();

            return view('courses.add_course', compact('streams'));
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('courses')
                            ->where('name', $input['name'])
                            ->exists();

            if ($is_exists) {
                return back()->with('error', 'This course already exists with this stream');
            }

            DB::table('courses')->insert($input);

            return redirect()
                        ->action('CoursesController@view_course')
                        ->with('success', 'Course Added successfully');
        }
    }

    public function edit_course($id)
    {

        if (request()->isMethod('get')) {
            $getCourse = DB::table('courses')->where('id', $id)->first();
            $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();
            return view('courses.edit_course', compact('streams','getCourse'));
        } else {

            $input = request()->except('_token','oldName');
            $oldName=request()->oldName;
            $is_exists = DB::table('courses')
                ->where('id', '!=', $input['id'])
                ->where('stream_id', $input['stream_id'])
                ->where('name', $input['name'])
                ->where('type', $input['type'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This course already exists with this stream');
            }

            DB::table('courses')->where('id', $input['id'])->update($input);
            $exist =  DB::table('coaching_courses')->where('name',$oldName)->first();
            if($exist!=null){
                $quri_2=DB::table('coaching_courses')->where('name', $oldName)->update(['name'=>$input['name']]);
            }

            return redirect()
                        ->action('CoursesController@view_course')
                        ->with('success', 'Course Updated successfully');
        }
    }

    public function delete_course()
    {

        $input = request()->except('_token');

        $old_status = DB::table('courses')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('courses')->where('id', $input['id'])->update(['status' => $new_status]);

        // disable its courses and coaching courses
        
        $coaching_courses_id = DB::table('courses')
                                ->join('coaching_courses', 'coaching_courses.name', 'courses.name')
                                ->where('courses.id', $input['id'])
                                ->value('coaching_courses.id');
                                
        $coaching_courses_name = DB::table('courses')
                                ->join('coaching_courses', 'coaching_courses.name', 'courses.name')
                                ->where('courses.id', $input['id'])
                                ->value('coaching_courses.name');

        DB::table('coaching_courses')
        ->where('coaching_courses.name', $coaching_courses_name)
        ->update([
            'status' => $new_status
        ]);
        
        DB::table('coaching_courses')
        ->where('coaching_courses.id', $coaching_courses_id)
        ->update([
            'status' => $new_status
        ]);

        DB::table('coaching_courses_detail')
        ->where('coaching_courses_detail.coaching_courses_id', $coaching_courses_id)
        ->update([
            'status' => $new_status
        ]);

        DB::table('coaching_results')
        ->where('coaching_results.coaching_courses_id', $coaching_courses_id)
        ->update([
            'status' => $new_status
        ]);

        DB::table('coaching_testimonials')
        ->where('coaching_testimonials.coaching_courses_id', $coaching_courses_id)
        ->update([
            'status' => $new_status
        ]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Course ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Course ' . $new_status . ' successfully');
    }

    public function view_course()
    {

        $streams = DB::table('streams')->where('status','enable')->select('id', 'name')->get();

        return view('courses.view_course', compact('streams'));
    }

    public function view_course_dt(Request $request)
    {

        $columns = array(
            0 => 'courses.id',
            1 => 'streams.name',
            2 => 'courses.name',
            3 => 'courses.type'
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('courses')
            ->join('streams', 'streams.id', 'courses.stream_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('courses.name', 'Like', '%'.$name.'%');
            }
        }

        if (request()->has('stream_id')) {
            $stream_id = request('stream_id');
            if ($stream_id != "") {
                $query->where('courses.stream_id', $stream_id);
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
                    ->select('courses.*', 'streams.name as stream')
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

                $is_selected_coaching = ($post->type == 'coaching') ? 'selected' : '';
                $is_selected_college = ($post->type == 'college') ? 'selected' : '';

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoursesController@delete_course', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoursesController@delete_course', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a></div>';

                $nestedData['name'] = $post->name;
                $nestedData['stream'] = $post->stream;
                $nestedData['status'] = $post->status;
                $nestedData['type'] = $post->type;
                $nestedData['action'] = '<div class="d-flex"><a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success"  aria-label="Edit" data-balloon-pos="up" href="'.asset('coaching_admin/edit_course/'.$post->id).'">
				<i class="fad fa-pencil"></i>
				</a>
                ' . $new_status. '</div>';

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