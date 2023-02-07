<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class CollegeCategoryController extends Controller
{

    public function add_college_category()
    {

        if (request()->isMethod('get')) {

            return view('college_category.add_college_category');
        } else {

            $input = request()->except('_token');

            if (!empty($input)) {

                $is_exists = DB::table('college_category')
                    ->where('name', $input['name'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'A College with this name already exists');
                }

                DB::table('college_category')->insert($input);

                return redirect()
                        ->action('CollegeCategoryController@view_college_category')
                        ->with('success', 'College Category Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_college_category()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CollegeCategoryController@view_college_category');
            }

            $college = DB::table('college_category')
                ->where('id', $input['id'])
                ->first();

            return view('college_category.edit_college_category', compact('college'));
        } else {

            $is_exists = DB::table('college_category')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A College Category with this name already exists');
            }

            DB::table('college_category')->where('id', $input['id'])->update($input);

            return redirect()
                        ->action('CollegeCategoryController@view_college_category')
                        ->with('success', 'College Category Updated successfully');
        }
    }

    public function delete_college_category()
    {

        $input = request()->except('_token');

        $old_status = DB::table('college_category')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('college_category')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'College Category ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'College Category ' . $new_status . ' successfully');
    }

    public function view_college_category()
    {

        return view('college_category.view_college_category');
    }

    public function view_college_category_dt(Request $request)
    {

        $columns = array(
            0 => 'college_category.id',
            1 => 'college_category.name',
            2 => 'college_category.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('college_category');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('college_category.name', 'LIKE', '%' . $name . '%');
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

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CollegeCategoryController@delete_college_category', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CollegeCategoryController@delete_college_category', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '
                <div class="d-flex"><a class="btn btn-sm mx-1 w-35px h-35px rounded-pill d-grid align-items-center justify-content-center btn-success" href="' . action('CollegeCategoryController@edit_college_category', 'id=' . $post->id) . '" data-balloon-pos="up" aria-label="Edit"><i class="fad fa-pencil-alt"></i></a>
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