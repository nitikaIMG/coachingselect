<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class FacilityController extends Controller
{

    public function add_facility()
    {

        if (request()->isMethod('get')) {

            return view('facility.add_facility');
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('facility')
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This facility already exists');
            }

            DB::table('facility')->insert($input);

            return redirect()
                        ->action('FacilityController@view_facility')
                        ->with('success', 'Facility Added successfully');
        }
    }

    public function edit_facility()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('facility')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This facility already exists');
            }

            if (!empty($input['image'])) {
                $input['image'] = $input['image'];
            } else {
                unset($input['image']);
            }
            
            DB::table('facility')->where('id', $input['id'])->update($input);

            return redirect()
                        ->action('FacilityController@view_facility')
                        ->with('success', 'Facility Updated successfully');
        }
    }

    public function delete_facility()
    {

        $input = request()->except('_token');

        $old_status = DB::table('facility')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('facility')->where('id', $input['id'])->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Facility ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Facility ' . $new_status . ' successfully');
    }

    public function view_facility()
    {

        return view('facility.view_facility');
    }

    public function view_facility_dt(Request $request)
    {

        $columns = array(
            0 => 'facility.id',
            1 => 'facility.type',
            2 => 'facility.name',
            3 => 'facility.name',
            4 => 'facility.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('facility');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('facility.name', 'LIKE', '%' . $name . '%');
            }
        }
        if (request()->has('type')) {
            $type = request('type');
            if ($type != "") {
                $query->where('facility.type', 'LIKE', '%' . $type . '%');
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
                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $is_selected_online = ($post->type == 'online') ? 'selected' : '';
                $is_selected_classroom = ($post->type == 'classroom') ? 'selected' : '';

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('FacilityController@delete_facility', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('FacilityController@delete_facility', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a></div>';

                $image = asset('public/facility/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['name'] = $post->name;
                $nestedData['type'] = $post->type;
                $nestedData['status'] = $post->status;
                $nestedData['image'] = $post->image;
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
				<i class="fad fa-pencil"></i>
				</button>
				<div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit facility</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
                            <form action="' . action('FacilityController@edit_facility') . '" class="form" enctype="multipart/form-data" method="post"
                            onsubmit="return verify_icon('.$post->id.', this)"
                            >                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">  
                                
                                <div class="row align-items-center">  
                                    <div class="col-12">                            
                                        <div class="form-group">
                                            <select name="type" id="type" class="form-control my-2 selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                                <option value="">Select Facility Type</option>
                                                <option 
                                                    value="online"
                                                    ' . $is_selected_online . '
                                                >Online</option>
                                                <option 
                                                    value="classroom"
                                                    ' . $is_selected_classroom . '
                                                >Classroom</option>
                                            </select>
                                        </div>
                                    </div>
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
                                                    <label class="control-label">Facility Icon</label>
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
                                                    <input type="text" class="form-control" value="' . $post->name . '" name="name" required placeholder="Enter facility Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <input type="submit" class="btn btn-sm btn-primary btn-sm btn-block my-2" value="Update">
                                
                                </div>
                            </form>
						</div>
					</div>
					</div>
				</div>
                </div>
                ' . $new_status;

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