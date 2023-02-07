<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class TrendingTodayController extends Controller
{

    public function add_trending_today()
    {

        if (request()->isMethod('get')) {

            return view('trending_today.add_trending_today');
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('trending_today')
                ->where('title', $input['title'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This trending today already exists');
            }

            if( 
                !empty($input['type']) and $input['type'] == 'url' 
            ) {
                if(
                    empty($input['url'])
                ) {
                    return back()->with('error', 'Url is required');
                }

                $input['description'] = '';
            }
            
            if( 
                !empty($input['type']) and $input['type'] == 'content' 
            ) {
                if(
                    empty($input['description'])
                ) {
                    return back()->with('error', 'Content is required');
                }
                
                $input['url'] = '';
            }

            DB::table('trending_today')->insert($input);

            return redirect()
                    ->action('TrendingTodayController@view_trending_today')
                    ->with('success', 'Trending Today Added successfully');
        }
    }

    public function edit_trending_today()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('trending_today')
                ->where('id', '!=', $input['id'])
                ->where('title', $input['title'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This trending today already exists');
            }
            
            if( 
                !empty($input['type']) and $input['type'] == 'url' 
            ) {
                if(
                    empty($input['url'])
                ) {
                    return back()->with('error', 'Url is required');
                }

                $input['description'] = '';
            }
            
            if( 
                !empty($input['type']) and $input['type'] == 'content' 
            ) {
                if(
                    empty($input['description'])
                ) {
                    return back()->with('error', 'Content is required');
                }
                
                $input['url'] = '';
            }


            DB::table('trending_today')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Trending Today Updated successfully');
        }
    }

    public function delete_trending_today()
    {

        $input = request()->except('_token');

        $old_status = DB::table('trending_today')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('trending_today')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'enable')
            return redirect()->back()->with('success', 'Trending Today ' . $new_status . ' successfully');
        else 
            return redirect()->back()->with('danger', 'Trending Today ' . $new_status . ' successfully');
    }

    public function view_trending_today()
    {

        return view('trending_today.view_trending_today');
    }

    public function view_trending_today_dt(Request $request)
    {

        $columns = array(
            0 => 'trending_today.id',
            1 => 'trending_today.title',
            2 => 'trending_today.url',
            3 => 'trending_today.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('trending_today');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('trending_today.title', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('trending_today.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('trending_today.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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

                $is_url_selected = '';
                $is_url_selected_show_hide = 'style="display:none;"';
                if($post->type == 'url') {
                    $is_url_selected = 'selected';
                    $is_url_selected_show_hide = '';
                }
                
                $is_content_selected = '';
                $is_content_selected_show_hide = 'style="display:none;"';
                if($post->type == 'content') {
                    $is_content_selected = 'selected';       
                    $is_content_selected_show_hide = '';                 
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('TrendingTodayController@delete_trending_today', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('TrendingTodayController@delete_trending_today', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a></div>';

                if( strlen($post->title) >= 40 ) {
                    $nestedData['title'] = '<span data-balloon-length="xlarge" aria-label="' . $post->title . '" data-balloon-pos="up">' . substr($post->title, 0, 40) . '...</span>';
                } else {
                    $nestedData['title'] = $post->title;
                }
                
                if( strlen($post->url) >= 40 ) {
                    $nestedData['url'] = '<span data-balloon-length="xlarge" aria-label="' . $post->url . '" data-balloon-pos="up">' . substr($post->url, 0, 40) . '...</span>';
                } else {
                    $nestedData['url'] = $post->url;
                }

                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '
                <script>
                CKEDITOR.replace( "description'.$post->id.'" );
                </script>
                <div class="d-flex"><button type="button" class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
				<i class="fad fa-pencil"></i>
				</button>
				<div class="modal fade bd-example-modal-xl" id="exampleModalCenter' . $post->id . '" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit Trending Today</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
                            <form action="' . action('TrendingTodayController@edit_trending_today') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">  
                                
                                <div class="form-group">
                                    <label class="control-label">Meta Title</label>
                                    <input type="text" class="form-control" name="metatitle" placeholder="Enter Meta Title"
                                    value="'.$post->metatitle.'"
                                    >
                                </div>
                            
                                <div class="form-group">
                                    <label class="control-label">Meta Description</label>
                                    <textarea class="form-control" name="metadescription" placeholder="Enter Meta Description">'.$post->metadescription.'</textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <textarea class="form-control" name="metakeywords" placeholder="Enter Meta Keywords">'.$post->metakeywords.'</textarea>
                                </div>

                                <div class="form-group">
                                <input type="text" class="form-control" value="' . $post->title . '" name="title" required placeholder="Enter trending today Title">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            
                                            <select 
                                            onchange="switch_between(this)"
                                            required
                                            name="type"
                                            class="form-control form-control-solid selectpicker show-tick switch mb-3" 
                                            data-id="'.$post->id.'">
                                                <option value="">Select Url or Write Content</option>
                                                <option 
                                                    '.$is_url_selected.'
                                                value="url">Url</option>
                                                <option 
                                                    '.$is_content_selected.'
                                                value="content">Write Content</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" '.$is_url_selected_show_hide.' 
                                    id="url_box'.$post->id.'">
                                        <div class="form-group">
                                            <input 
                                            id="url'.$post->id.'"
                                            type="url" 
                                            class="form-control" 
                                            name="url" 
                                            placeholder="Enter url" 
                                            value="' . $post->url . '">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12" '.$is_content_selected_show_hide.' 
                                    id="content_box'.$post->id.'">
                                        <div class="form-group">
                                            <textarea 
                                                name="description"
                                                id="description'.$post->id.'"
                                                class="form-control ckeditor" 
                                                placeholder="Enter description">'.$post->description.'</textarea>    
                                        </div>
                                    </div>
                                </div>

                                <div class="row">                                    
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