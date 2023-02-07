<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use File;
use Session;

use App\Helpers\Helpers;

use Illuminate\Support\Facades\Storage;
class PlanController extends Controller
{
	
    public function plan(){
		return view('plan.add');
	}

	public function add_plan(Request $request){
		
		$input = $request->all();
		
		unset($input['_token']);

		$plan = $input['plan'];

		if (!empty($plan)) {
			foreach ($plan as $plan_single) {
				
				$plan_data = array();
				$plan_data['type'] = $plan_single['type'];
				$plan_data['name'] = $plan_single['name'];
				$plan_data['fee'] = $plan_single['fee'];
				    
				$is_already_exists = DB::table('plan')
									->where('name', $plan_single['name'])
									->exists();

				if($is_already_exists) {
					return redirect()
							->back()
							->with('error', 'This plan already exists');
				}

				$plan_id = DB::table('plan')->insertGetId($plan_data);
			}
		}

		$specification = $input['specification'];

		if (!empty($specification)) {
			foreach ($specification as $specific) {

				$specific_data = array();
				$specific_data['plan_id'] = $plan_id;
				$specific_data['name'] = $specific['name'];
				DB::table('plan_specification')->insert($specific_data);
			}
		}
		
		return redirect()->action('PlanController@view_plan')->with('success','plan added successfully');
	}

	public function edit_plan($id)
	{
		$getid = unserialize(base64_decode($id));
		
		$plan = DB::table('plan')->where('id',$getid)->first();
		
		$plan_specification = DB::table('plan_specification')
											->where('plan_id', $plan->id)
											->get();
		

		return view('plan.edit',compact('plan', 'plan_specification'));
	}

	public function update_plan(Request $request,$id)
	{
		$id = unserialize(base64_decode($id));
		
		$getid = $id;
		$input = $request->all();

		$plan = $input['plan'];

		if (!empty($plan)) {
			foreach ($plan as $plan) {
				
				$plan_data = array();
				$plan_data['type'] = $plan['type'];
				$plan_data['name'] = $plan['name'];
				$plan_data['fee'] = $plan['fee'];
				  
				$is_already_exists = DB::table('plan')
                        			->where('id', '!=', $input['id'])
									->where('name', $plan['name'])
									->exists();

				if($is_already_exists) {
					return redirect()
							->back()
							->with('error', 'This plan already exists');
				}

				DB::table('plan')->where('id', $input['id'])->update($plan_data);
				
			}
		}

		DB::table('plan_specification')
			->where('plan_id', $input['id'])
			->delete();    

		$specification = $input['specification'];

		if (!empty($specification)) {
			foreach ($specification as $specific) {

				$specific_data = array();
				$specific_data['plan_id'] = $input['id'];
				$specific_data['name'] = $specific['name'];
				DB::table('plan_specification')->insert($specific_data);
			}
		}
		
		$id = base64_encode(serialize($id));
		return redirect()
				->action('PlanController@view_plan')
				->with('success','plan update successfully');

	}

	public function view_plan(){
		return view('plan.view');
	}

	public function view_plan_table(){
		$data = DB::table('plan')
				->orderBy('id','desc');
				
		if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$start_date = date('Y-m-d', strtotime('', strtotime(request('start_date'))));
				$data = $data->whereDate('plan.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$data = $data->whereDate('plan.created_at', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}

		if (request()->has('type')) {
            $type = request('type');

            if ($type != "") {
                $data = $data->where('plan.type', $type);
            }
        }
		
		$data = $data->get();

		$i=1;$JsonFinal=array();
        if(!empty($data))
        {
            foreach ($data as $fmatch)
            {
				
                $confirm = "return confirmation('Are you sure?') ";

				$id=base64_encode(serialize($fmatch->id));

				$edit =action('PlanController@edit_plan',$id);
				$delete =action('PlanController@delete_plan',$id);

				$onclick = "delete_sweet_alert('".$delete."', 'Are you sure you want to delete this data?')";

                $app = ($fmatch->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('PlanController@delete_plan',$id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('PlanController@delete_plan',$id) . '" onclick="' . $confirm . '">Enable</a></div>';
                if( strlen(ucwords($fmatch->name)) >= 40 ) {
                    $name = '<span data-balloon-length="xlarge" aria-label="' . $fmatch->name . '" data-balloon-pos="up">' . substr($fmatch->name, 0, 40) . '...</span>';
                } else {
                    $name = ucwords($fmatch->name);
                }
                $data=array(
                    $i,
                    ucwords($fmatch->type),
                    $name,
                    ucwords($fmatch->fee),
                	date('Y-m-d', strtotime($fmatch->created_at)),
					'<div class="d-flex align-items-center">
                	<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('PlanController@edit_plan', $id) . '" aria-label="Edit" data-balloon-pos="up" ><i class="fad fa-pencil-alt"></i></a>
                    '.$app.'</div>',

                );
                $i++;
                $JsonFinal[]=$data;
            }
        }

        $jsonFinal1 = json_encode(array('data' => $JsonFinal));
        echo $jsonFinal1;
        die;
	}

	public function delete_plan($id){
		
	    $id = unserialize(base64_decode($id));

        $input = request()->except('_token');
        
        $old_status = DB::table('plan')->where('id', $id)->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('plan')->where('id', $id)->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'plan '.$new_status.' successfully');
        else
        return redirect()->back()->with('success', 'plan '.$new_status.' successfully');
	}

	public function view_plan_request()
    {

        return view('plan.view_plan_request');
    }

    public function view_plan_request_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching.id',
            1 => 'coaching.name',
            2 => 'coaching.mobile',
            3 => 'coaching.email',
            4 => 'plan.name',
            5 => 'plan.type',
            6 => 'plan.fee',
            7 => 'coaching_plan_request.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('coaching')
				->join('coaching_plan_request', 'coaching.id', '=', 'coaching_plan_request.coaching_id')
				->join('plan', 'plan.id', '=', 'coaching_plan_request.plan_id')
                ->select('coaching_plan_request.created_at as date', 
				'coaching.mobile', 
				'coaching.email', 
				'coaching.name as coaching_name', 'coaching_plan_request.*', 'plan.*');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching.name', 'LIKE', '%' . $name . '%');
            }
        }

		if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('coaching_plan_request.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('coaching_plan_request.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            $posts = $posts->orderBy('coaching_plan_request.created_at', 'desc');
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

                $nestedData['coaching_name'] = $post->coaching_name;
                if( strlen(ucwords($post->name)) >= 40 ) {
                    $name = '<span data-balloon-length="xlarge" aria-label="' . $post->name . '" data-balloon-pos="up">' . substr($post->name, 0, 40) . '...</span>';
                } else {
                    $name = ucwords($post->name);
                }
                $nestedData['mobile'] = $post->mobile;   
                $nestedData['email'] = $post->email;   
                $nestedData['name'] = $name;
                $nestedData['type'] = $post->type;
                $nestedData['fee'] = $post->fee; 
				
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->date));

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