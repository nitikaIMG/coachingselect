<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class BlogsController extends Controller
{

    public function add_blog()
    {

        if (request()->isMethod('get')) {

            $tags = DB::table('tags')->get();
            $blogs_category = DB::table('blogs_category')
                                ->where('status', 'enable')
                                ->get();

            return view('blogs.add_blog', compact('tags', 'blogs_category'));
        } else {

            $input = request()->except('_token');

            if (!empty($input)) {

                $is_exists = DB::table('blogs')
                    ->where('title', $input['title'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'A Blog with this title already exists');
                }

                $image = '';

                $file = request('image');

                $thumbnailPath = public_path('blogs/');

                $fileName = 'blog-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }

                if (!request()->file('writer_image')) {

                    unset($input['writer_image']);
                } else {

                    $file = request('writer_image');

                    $thumbnailPath = public_path('blogs/');

                    $fileName = 'blog-writer-' . time() . random_int(0, 10);

                    $input['writer_image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                    if ($input['writer_image'] == '') {
                        return redirect()->back()->with('error', 'invalid image provided');
                    }
                }

                DB::table('blogs')->insert($input);

                # insert tags into tags tbl that do not exists
                $tags = explode(',', $input['tags']);

                if (!empty($tags)) {
                    foreach ($tags as $tag) {
                        $is_exists = DB::table('tags')->where('text', $tag)->exists();

                        if (!$is_exists) {

                            $tag_data = array();
                            $tag_data['text'] = $tag;
                            $tag_data['value'] = $tag;

                            DB::table('tags')->insert($tag_data);
                        }
                    }
                }

                return redirect()                                
                            ->action('BlogsController@view_blog')
                            ->with('success', 'Blog Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_blog()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('BlogsController@view_blog');
            }

            $tags = DB::table('tags')->get();
            $blogs_category = DB::table('blogs_category')
                                ->where('status', 'enable')
                                ->get();

            $blog = DB::table('blogs')
                ->where('id', $input['id'])
                ->first();

            if( empty($blog) ) {
                abort(404);
            }

            if( !empty($blog->tags) ) {
                $blog->tags = json_encode(
                    DB::table('tags')
                        ->whereIn('tags.text', explode(',', $blog->tags))
                        ->get()
                );
            } 

            return view('blogs.edit_blog', compact('tags', 'blog', 'blogs_category'));
        } else {

            $is_exists = DB::table('blogs')
                ->where('id', '!=', $input['id'])
                ->where('title', $input['title'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A Blog with this title already exists');
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('blogs')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/blogs/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('blogs/');

                $fileName = 'blog-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }

                // // convert to webp
                // $image = DB::table('blogs')->where('id', $input['id'])->value('image');

                // @unlink(asset('/public/webp/' . $image));

                // $file = request('image');

                // $thumbnailPath = public_path('webp/');

                // $fileName = 'blog-' . time() . random_int(0, 10);

                // $input['image'] = Helpers::imageSingleUpload1($file, $thumbnailPath, $fileName);

                // if ($input['image'] == '') {
                //     return redirect()->back()->with('error', 'invalid image provided');
                // }
            }

            if (!request()->file('writer_image')) {

                unset($input['writer_image']);
            } else {

                $writer_image = DB::table('blogs')->where('id', $input['id'])->value('writer_image');

                @unlink(asset('/public/blogs/' . $writer_image));

                $file = request('writer_image');

                $thumbnailPath = public_path('blogs/');

                $fileName = 'blog-writer-' . time() . random_int(0, 10);

                $input['writer_image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['writer_image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            if( empty($input['tags']) ) {
                unset($input['tags']);
            }

            DB::table('blogs')->where('id', $input['id'])->update($input);

            if( !empty($input['tags']) ) {
                # insert tags into tags tbl that do not exists
                $tags = explode(',', $input['tags']);
                
                if (!empty($tags)) {
                    foreach ($tags as $tag) {
                        $is_exists = DB::table('tags')->where('text', $tag)->exists();
                        
                        if (!$is_exists) {
                            
                            $tag_data = array();
                            $tag_data['text'] = $tag;
                            $tag_data['value'] = $tag;
                            
                            DB::table('tags')->insert($tag_data);
                        }
                    }
                }
            }

            return redirect()->action('BlogsController@view_blog')->with('success', 'Blog Updated successfully');
        }
    }

    public function delete_blog()
    {

        $input = request()->except('_token');

        $old_status = DB::table('blogs')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('blogs')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'enable')
            return redirect()->back()->with('success', 'Blog ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('danger', 'Blog ' . $new_status . ' successfully');
    }

    public function view_blog()
    {

        $blogs_categories = DB::table('blogs_category')
            ->get();

        return view('blogs.view_blog', compact('blogs_categories'));
    }

    public function view_blog_dt(Request $request)
    {

        $columns = array(
            0 => 'blogs.id',
            1 => 'blogs_category.name',
            2 => 'blogs.title',
            3 => 'blogs.title',
            4 => 'blogs.views',
            5 => 'blogs.likes',
            6 => 'blogs.comments',
            7 => 'blogs.written_by',
            8 => 'students.email',
            9 => 'students.phone',
            10 => 'blogs.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('blogs')
            ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
            ->leftjoin('students', 'students.id', 'blogs.user_id');

        if (request()->has('title')) {
            $title = request('title');
            if ($title != "") {
                $query->where('blogs.title', 'LIKE', '%' . $title . '%');
            }
        }

        if (request()->has('blog_category_id')) {
            $blog_category_id = request('blog_category_id');
            if ($blog_category_id != "") {
                $query->where('blogs.blog_category_id', $blog_category_id);
            }
        }

        if (request()->has('tag')) {
            $tag = request('tag');
            if ($tag != "") {
                $query->where('blogs.tags', 'LIKE', '%' . $tag . '%');
            }
        }

        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('blogs.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('blogs.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
                        ->orderBy('blogs.id', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
                ->select('blogs.*', 'blogs_category.name as category','students.email','students.mobile')
                ->get();
        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $nestedData['is_pending_comments'] = DB::table('blogs_like_comment')
                                                    ->where('blog_id', $post->id)
                                                    ->where('is_seen', 0)
                                                    ->where('comment', '!=', '')
                                                    ->count();

                $slug = str_replace(' ', '-', $post->title);

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('BlogsController@delete_blog', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('BlogsController@delete_blog', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a></div>';

                $tags = explode(',', $post->tags);

                $tags_show = '';
                if (!empty($tags)) {
                    foreach ($tags as $tag) {
                        $tags_show .= '<span class="badge badge-pill badge-secondary mx-1">' . $tag . '</span>';
                    }
                }

                if( strlen($post->title) >= 40 ) {
                    $nestedData['title'] = '<span data-balloon-length="xlarge" aria-label="' . $post->title . '" data-balloon-pos="up">' . substr($post->title, 0, 40) . '...</span>';
                } else {
                    $nestedData['title'] = $post->title;
                }

                if( strlen($post->short_description) >= 40 ) {
                    $nestedData['short_description'] = '<span data-balloon-length="xlarge" aria-label="' . $post->short_description . '" data-balloon-pos="up">' . substr($post->short_description, 0, 40) . '...</span>';
                } else {
                    $nestedData['short_description'] = $post->short_description;
                }
        
                $nestedData['category'] = $post->category;
                $nestedData['status'] = $post->status;
                $nestedData['views'] = $post->views;
                $nestedData['likes'] = $post->likes;
                $nestedData['comments'] = $post->comments;
                $nestedData['written_by'] = $post->written_by;
                $nestedData['email'] = $post->email;
                $nestedData['phone'] = $post->mobile;
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['tags'] = $tags_show;
                $nestedData['image'] = '<img src="' . asset('public/blogs/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                $nestedData['action'] = '
                <div class="d-flex">
                <a class="btn btn-sm w-35px h-35px rounded-pill align-items-center justify-content-center p-0 mx-1 btn-orange" href="' . action('Website\BlogsController@blog', $slug) . '" target="_blank" aria-label="View Blog" data-balloon-pos="up"><i class="fad fa-eye"></i></a>
                <a class="btn btn-sm w-35px h-35px rounded-pill align-items-center justify-content-center p-0 mx-1 btn-primary" href="' . action('BlogsController@view_blog_comments', 'id=' . $post->id) . '" aria-label="View Comments" data-balloon-pos="up"><i class="fad fa-eye"></i></a>
                <a class="btn btn-sm w-35px h-35px rounded-pill align-items-center justify-content-center p-0 mx-1 btn-info" href="' . action('BlogsController@edit_blog', 'id=' . $post->id) . '" aria-label="Edit" data-balloon-pos="up"><i class="fad fa-pencil"></i></a>
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

    public function tags()
    {
        return DB::table('tags')->get();
    }

    public function view_blog_comments()
    {

        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('BlogsController@view_blog');
        }

        return view('blogs.view_blog_comments', [
            'blog_id' => $input['id']
        ]);
    }

    public function view_blog_comments_dt(Request $request)
    {

        $columns = array(
            0 => 'blogs_like_comment.id',
            1 => 'blogs_like_comment.comment',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('blogs_like_comment')
            ->join('blogs', 'blogs.id', 'blogs_like_comment.blog_id')
            ->where('blogs_like_comment.blog_id', request()->get('blog_id'))
            ->where('blogs_like_comment.comment', '!=', '');

        if (request()->has('comment')) {
            $comment = request('comment');
            if ($comment != "") {
                $query->where('blogs_like_comment.comment', 'LIKE', '%' . $comment . '%');
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
                ->select('blogs_like_comment.*', 'students.name as student_name')
                ->join('students', 'students.id', 'blogs_like_comment.user_id')
                ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $nestedData['is_pending_comments'] = $post->is_seen;

                DB::table('blogs_like_comment')
                ->where('id', $post->id)
                ->update([
                    'is_seen' => 1
                ]);

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('BlogsController@delete_blog_comments', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('BlogsController@delete_blog_comments', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['student_name'] = $post->student_name;
                
                if( strlen($post->comment) >= 40 ) {
                    $nestedData['comment'] = '<span data-balloon-length="xlarge" aria-label="' . $post->comment . '" data-balloon-pos="up">' . substr($post->comment, 0, 40) . '...</span>';
                } else {
                    $nestedData['comment'] = $post->comment;
                }
                
                $nestedData['status'] = $post->status;
                $nestedData['action'] = $new_status;

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


    public function delete_blog_comments()
    {

        $input = request()->except('_token');

        $old_status = DB::table('blogs_like_comment')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('blogs_like_comment')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'enable')
            return redirect()->back()->with('success', 'Blog comment ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('danger', 'Blog comment ' . $new_status . ' successfully');
    }

    public function ckeditor_image(Request $request) {
            
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
    
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
    
            //Upload File
            $request->file('upload')->storeAs('public', $filenametostore);
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/app/public/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }

    }
}