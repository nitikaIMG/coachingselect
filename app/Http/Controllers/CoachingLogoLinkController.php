<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class CoachingLogoLinkController extends Controller
{

    public function add_coaching_logo_link()
    {

        if (request()->isMethod('get')) {

            return view('coaching_logo_link.add_coaching_logo_link');
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('coaching_logo_link')
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This Coaching Logo Link already exists');
            }

            $image = '';

            $file = request('image');

            $thumbnailPath = public_path('coaching_logo_link/');

            $fileName = 'coaching_logo_link-' . time() . random_int(0, 10);

            $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

            if ($input['image'] == '') {
                return redirect()->back()->with('error', 'invalid image provided');
            }

            DB::table('coaching_logo_link')->insert($input);

            return redirect()
                    ->action('CoachingLogoLinkController@view_coaching_logo_link')
                    ->with('success', 'Coaching Logo Link Added successfully');
        }
    }

    public function edit_coaching_logo_link()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('coaching_logo_link')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This Coaching Logo Link already exists');
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('coaching_logo_link')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/coaching_logo_link/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('coaching_logo_link/');

                $fileName = 'coaching_logo_link-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('coaching_logo_link')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Coaching Logo Link Updated successfully');
        }
    }

    public function delete_coaching_logo_link()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_logo_link')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_logo_link')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'enable')
            return redirect()->back()->with('success', 'Coaching Logo Link ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('danger', 'Coaching Logo Link ' . $new_status . ' successfully');
    }

    public function view_coaching_logo_link()
    {

        return view('coaching_logo_link.view_coaching_logo_link');
    }

    public function view_coaching_logo_link_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_logo_link.id',
            1 => 'coaching_logo_link.name',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('coaching_logo_link');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_logo_link.name', 'LIKE', '%' . $name . '%');
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
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";
                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $image = asset('public/coaching_logo_link/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingLogoLinkController@delete_coaching_logo_link', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingLogoLinkController@delete_coaching_logo_link', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a></div>';

                $nestedData['name'] = $post->name;
                $nestedData['image'] = '<img src="' . asset('public/coaching_logo_link/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                
                if( strlen($post->url) >= 40 ) {
                    $nestedData['url'] = '<span data-balloon-length="xlarge" aria-label="' . $post->url . '" data-balloon-pos="up">' . substr($post->url, 0, 40) . '...</span>';
                } else {
                    $nestedData['url'] = $post->url;
                }
                
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
				<i class="fad fa-pencil"></i>
				</button>
				<div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Name" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongName">Edit Coaching Logo Link</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
                            <form action="' . action('CoachingLogoLinkController@edit_coaching_logo_link') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">  
                                <input type="text" class="form-control" value="' . $post->name . '" name="name" required placeholder="Enter Coaching Name">
                                
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url(' . $image . ');" upload-pic="" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>

                                <div class="form-group">
                                    <input type="url" class="form-control" name="url" placeholder="Enter url" value="' . $post->url . '" required>
                                </div>
                                
                                <input type="submit" class="btn btn-sm btn-primary btn-sm btn-block my-2" value="Update">
                            </form>
						</div>
					</div>
					</div>
				</div>
                </div>
                ' . $new_status;

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