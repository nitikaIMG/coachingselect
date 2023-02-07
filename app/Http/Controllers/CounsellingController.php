<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use File;
use Session;

use App\Helpers\Helpers;

use Illuminate\Support\Facades\Storage;
class CounsellingController extends Controller
{
	
    public function counselling(){
		return view('counselling.add');
	}

	public function add_counselling(Request $request){
		
		$input = $request->all();
		
		unset($input['_token']);

		$counselling = $input['counselling'];

		if (!empty($counselling)) {
			foreach ($counselling as $counselling_single) {
				
				$counselling_data = array();
				$counselling_data['type'] = $counselling_single['type'];
				$counselling_data['name'] = $counselling_single['name'];
				$counselling_data['fee'] = $counselling_single['fee'];
				$counselling_data['offer_percentage'] = $counselling_single['offer_percentage'];

				$counselling_data['short_description'] = !empty($counselling_single['short_description']) ? $counselling_single['short_description'] : '';
				$counselling_data['description'] = !empty($counselling_single['description']) ? $counselling_single['description'] : '';
                    
				$is_already_exists = DB::table('counselling')
									->where('name', $counselling_single['name'])
									->exists();

				if($is_already_exists) {
					return redirect()
							->back()
							->with('error', 'This counselling already exists');
				}

				$counselling_id = DB::table('counselling')->insertGetId($counselling_data);
			}
		}

		$specification = $input['specification'];

		if (!empty($specification)) {
			foreach ($specification as $specific) {

				$specific_data = array();
				$specific_data['counselling_id'] = $counselling_id;
				$specific_data['name'] = $specific['name'];
				DB::table('counselling_specification')->insert($specific_data);
			}
		}
		
		return redirect()->action('CounsellingController@view_counselling')->with('success','Counselling added successfully');
	}

	public function edit_counselling($id)
	{
		$getid = unserialize(base64_decode($id));
		
		$counselling = DB::table('counselling')->where('id',$getid)->first();
		
		$counselling_specification = DB::table('counselling_specification')
											->where('counselling_id', $counselling->id)
											->get();
		

		return view('counselling.edit',compact('counselling', 'counselling_specification'));
	}

	public function update_counselling(Request $request,$id)
	{
		$id = unserialize(base64_decode($id));
		
		$getid = $id;
		$input = $request->all();

		$counselling = $input['counselling'];

		if (!empty($counselling)) {
			foreach ($counselling as $counselling) {
				
				$counselling_data = array();
				$counselling_data['type'] = $counselling['type'];
				$counselling_data['name'] = $counselling['name'];
				$counselling_data['fee'] = $counselling['fee'];
				$counselling_data['offer_percentage'] = $counselling['offer_percentage'];

				$counselling_data['short_description'] = !empty($counselling['short_description']) ? $counselling['short_description'] : '';
				$counselling_data['description'] = !empty($counselling['description']) ? $counselling['description'] : '';
                  
				$is_already_exists = DB::table('counselling')
                        			->where('id', '!=', $input['id'])
									->where('name', $counselling['name'])
									->exists();

				if($is_already_exists) {
					return redirect()
							->back()
							->with('error', 'This counselling already exists');
				}

				DB::table('counselling')->where('id', $input['id'])->update($counselling_data);
				
			}
		}

		DB::table('counselling_specification')
			->where('counselling_id', $input['id'])
			->delete();    

		$specification = $input['specification'];

		if (!empty($specification)) {
			foreach ($specification as $specific) {

				$specific_data = array();
				$specific_data['counselling_id'] = $input['id'];
				$specific_data['name'] = $specific['name'];
				DB::table('counselling_specification')->insert($specific_data);
			}
		}
		
		$id = base64_encode(serialize($id));
		return redirect()
				->action('CounsellingController@view_counselling')
				->with('success','Counselling update successfully');

	}

	public function view_counselling(){
		return view('counselling.view');
	}

	public function view_counselling_table(){
		
		$data = DB::table('counselling')
				->orderBy('created_at', 'desc');
				
		if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$start_date = date('Y-m-d', strtotime('', strtotime(request('start_date'))));
				$data = $data->whereDate('counselling.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$data = $data->whereDate('counselling.created_at', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}
		
		if (request()->has('type')) {
            $type = request('type');
            if ($type != "") {
                $data = $data->where('counselling.type', $type);
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

				$edit =action('CounsellingController@edit_counselling',$id);
				$delete =action('CounsellingController@delete_counselling',$id);

				$onclick = "delete_sweet_alert('".$delete."', 'Are you sure you want to delete this data?')";

                $app = ($fmatch->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CounsellingController@delete_counselling',$id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CounsellingController@delete_counselling',$id) . '" onclick="' . $confirm . '">Enable</a></div>';
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
                    ucwords($fmatch->offer_percentage),
                	date('Y-m-d', strtotime($fmatch->created_at)),
					'<div class="d-flex align-items-center">
                	<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('CounsellingController@edit_counselling', $id) . '" aria-label="Edit" data-balloon-pos="up" ><i class="fad fa-pencil-alt"></i></a>
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

	public function delete_counselling($id){
		
	    $id = unserialize(base64_decode($id));

        $input = request()->except('_token');
        
        $old_status = DB::table('counselling')->where('id', $id)->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('counselling')->where('id', $id)->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Counselling '.$new_status.' successfully');
        else
        return redirect()->back()->with('success', 'Counselling '.$new_status.' successfully');
	}
}