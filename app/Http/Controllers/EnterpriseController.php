<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class EnterpriseController extends Controller
{

    public function add_enterprise()
    {

        if (request()->isMethod('get')) {

            return view('enterprise.add_enterprise');
        } else {

            $input = request()->except('_token');

            if (!empty($input)) {

                $is_exists = DB::table('enterprise')
                    ->where('name', $input['name'])
                    ->exists();

                if ($is_exists) {
                    return back()->with('error', 'A Blog with this name already exists');
                }

                DB::table('enterprise')->insert($input);

                return redirect()
                        ->action('EnterpriseController@view_enterprise')
                        ->with('success', 'Enterprise Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_enterprise()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('EnterpriseController@view_enterprise');
            }

            $blog = DB::table('enterprise')
                ->where('id', $input['id'])
                ->first();

            return view('enterprise.edit_enterprise', compact('blog'));
        } else {

            $is_exists = DB::table('enterprise')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A Enterprise with this name already exists');
            }

            DB::table('enterprise')->where('id', $input['id'])->update($input);

            return redirect()
                        ->action('EnterpriseController@view_enterprise')
                        ->with('success', 'Enterprise Updated successfully');
        }
    }

    public function delete_enterprise()
    {

        $input = request()->except('_token');

        $old_status = DB::table('enterprise')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'approved') ? 'unapproved' : 'approved';

        DB::table('enterprise')->where('id', $input['id'])->update(['status' => $new_status]);

        $enterprise_id = $input['id'];

        if($new_status == 'unapproved') {

            # unapprove and delete from coaching tbl

            $this->unapproved($enterprise_id);
                
            return redirect()->back()->with('danger', 'Enterprise ' . $new_status . ' successfully');
        } else {

            # approve and insert into coaching tbl

            $this->approved($enterprise_id);
            
            return redirect()->back()->with('success', 'Enterprise ' . $new_status . ' successfully');
        }
    }

    public function view_enterprise()
    {

        return view('enterprise.view_enterprise');
    }

    public function view_enterprise_dt(Request $request)
    {

        $columns = array(
            0 => 'enterprise.id',
            1 => 'enterprise.name',
            2 => 'enterprise.mobile',
            3 => 'enterprise.email',
            4 => 'enterprise.city',
            5 => 'enterprise.state',
            6 => 'enterprise.country',
            7 => 'enterprise.address',
            8 => 'enterprise.url',
            9 => 'enterprise.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('enterprise');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('enterprise.name', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('enterprise.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('enterprise.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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

                $new_status = ($post->status == 'approved') ? '<a class="btn btn-sm btn-danger" href="' . action('EnterpriseController@delete_enterprise', 'id=' . $post->id) . '" onclick="' . $confirm . '">unapproved</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('EnterpriseController@delete_enterprise', 'id=' . $post->id) . '" onclick="' . $confirm . '">approved</a>';

                $nestedData['name'] = $post->name;                
                $nestedData['mobile'] = $post->mobile;   
                
                if( strlen($post->email) >= 40 ) {
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 40) . '...</span>';
                } else {
                    $nestedData['email'] = $post->email;
                }

                $nestedData['city'] = $post->city;                
                $nestedData['state'] = $post->state;                
                $nestedData['country'] = $post->country;             
                
                if( strlen($post->address) >= 40 ) {
                    $nestedData['address'] = '<span data-balloon-length="xlarge" aria-label="' . $post->address . '" data-balloon-pos="up">' . substr($post->address, 0, 40) . '...</span>';
                } else {
                    $nestedData['address'] = $post->address;
                }
                
                if( strlen($post->url) >= 40 ) {
                    $nestedData['url'] = '<span data-balloon-length="xlarge" aria-label="' . $post->url . '" data-balloon-pos="up">' . substr($post->url, 0, 40) . '...</span>';
                } else {
                    $nestedData['url'] = $post->url;
                }

                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '
                <div class="d-flex">
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

    public function approved($enterprise_id) {
        
        $enterprise = DB::table('enterprise')
                        ->where('id', $enterprise_id)
                        ->first();

        $enterprise = (array) $enterprise;
        
        unset(
            $enterprise['id'],
            $enterprise['created_at'],
            $enterprise['updated'],
            $enterprise['status']
        );
        
        $is_already_exists = DB::table('coaching')
                        ->where('name', $enterprise['name'])
                        ->update([
                            'status' => 'enable'
                        ]);
    
        return redirect()
                ->back()
                ->with('Enterprise approved successfully');
    }
    
    public function unapproved($enterprise_id) {
        
        $enterprise = DB::table('enterprise')
                        ->where('id', $enterprise_id)
                        ->first();

        $enterprise = (array) $enterprise;
                
        $is_already_exists = DB::table('coaching')
                        ->where('name', $enterprise['name'])
                        ->update([
                            'status' => 'unapproved'
                        ]);
        
        return redirect()
                ->back()
                ->with('Enterprise unapproved successfully');
                

    }
}