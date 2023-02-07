<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class BlogsCategoryController extends Controller
{

    public function add_blog_category()
    {

        if (request()->isMethod('get')) {

            return view('blogs_category.add_blog_category');
        } else {

            $input = request()->except('_token');

            if (!empty($input)) {

                $is_exists = DB::table('blogs_category')
                    ->where('name', $input['name'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'A Blog Category with this name already exists');
                }

                DB::table('blogs_category')->insert($input);

                return redirect()
                        ->action('BlogsCategoryController@view_blog_category')
                        ->with('success', 'Blog Category Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_blog_category()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('BlogsCategoryController@view_blog_category');
            }

            $blog = DB::table('blogs_category')
                ->where('id', $input['id'])
                ->first();

            return view('blogs_category.edit_blog_category', compact('blog'));
        } else {

            $is_exists = DB::table('blogs_category')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A Blog Category with this name already exists');
            }

            DB::table('blogs_category')->where('id', $input['id'])->update($input);

            return redirect()
                        ->action('BlogsCategoryController@view_blog_category')
                        ->with('success', 'Blog Category Updated successfully');
        }
    }

    public function delete_blog_category()
    {

        $input = request()->except('_token');

        $old_status = DB::table('blogs_category')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('blogs_category')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Blog Category ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Blog Category ' . $new_status . ' successfully');
    }

    public function view_blog_category()
    {

        return view('blogs_category.view_blog_category');
    }

    public function view_blog_category_dt(Request $request)
    {

        $columns = array(
            0 => 'blogs_category.id',
            1 => 'blogs_category.name',
            2 => 'blogs_category.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('blogs_category');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('blogs_category.name', 'LIKE', '%' . $name . '%');
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

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('BlogsCategoryController@delete_blog_category', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('BlogsCategoryController@delete_blog_category', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '
                <div class="d-flex"><a class="btn btn-sm mx-1 w-35px h-35px rounded-pill d-grid align-items-center justify-content-center btn-success" href="' . action('BlogsCategoryController@edit_blog_category', 'id=' . $post->id) . '" data-balloon-pos="up" aria-label="Edit"><i class="fad fa-pencil-alt"></i></a>
                ' . $new_status . '</div>';

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