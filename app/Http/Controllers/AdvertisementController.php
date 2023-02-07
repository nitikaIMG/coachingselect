<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use File;
use Session;

use App\Helpers\Helpers;

use Illuminate\Support\Facades\Storage;
class AdvertisementController extends Controller
{
	
    public function advertisement(){
    	$data = DB::table('coaching')->get();
		return view('advertisement.add',compact('data'));
	}

	public function add_advertisement(Request $request){
		$this->validate($request,[
	    	'type' => 'required',
	    	'image' => 'required|image',
	    ]);
		$input = $request->all();
		if($request->file('image')){

			if(
				request()->get('type') == 'small'
			) {

				$file = $_FILES["image"]['tmp_name'];
				list($width, $height) = getimagesize($file);

				if($width == 350  and $height == 290) {
				} else {
					return redirect()->back()->with('error', 'Invalid image provided for small sidebar. It must be 350  * 290');
				}
			} else {
				
				$file = $_FILES["image"]['tmp_name'];
				list($width, $height) = getimagesize($file);

				if($width == 1200 and $height == 280 ) {
				} else {
					return redirect()->back()->with('error', 'Invalid image provided for full banner. It must be 1200 * 280 ');
				}
			}

			$image =  Storage::disk('public_folder')->putFile('advertisement',$input['image'], 'public');
        	$input['image'] = $image;
		}
		
		unset($input['_token']);
		DB::table('advertisement')->insert($input);
		return redirect()->action('AdvertisementController@view_advertisement')->with('success','Advertisement added successfully');
	}

	public function edit_advertisement($id)
	{
		$getid = unserialize(base64_decode($id));
		$advertisement = DB::table('advertisement')->leftjoin('coaching', 'coaching.id', '=', 'advertisement.coaching_id')->where('advertisement.id',$getid)->select('advertisement.*','coaching.name as coaching_name')->first();
		$data = DB::table('coaching')->get();
		return view('advertisement.edit',compact('advertisement','data'));
	}

	public function update_advertisement(Request $request,$id)
	{
		$id = unserialize(base64_decode($id));
		$this->validate($request,[
	       'type' => 'required',
	    ]);
		$getid = $id;
		$input = $request->all();
		if($request->file('image')){

			if(
				request()->get('type') == 'small'
			) {

				$file = $_FILES["image"]['tmp_name'];
				list($width, $height) = getimagesize($file);

				if($width == 350  and $height == 290) {
				} else {
					return redirect()->back()->with('error', 'Invalid image provided for small sidebar. It must be 350  * 290');
				}
			} else {
				
				$file = $_FILES["image"]['tmp_name'];
				list($width, $height) = getimagesize($file);

				if($width == 1200 and $height == 280 ) {
				} else {
					return redirect()->back()->with('error', 'Invalid image provided for full banner. It must be 1200 * 280 ');
				}
			}
			
            $image = $request->file('image');
            $hii =  Storage::disk('public_folder')->putFile('advertisement',$input['image'], 'public');
            $data['image']  = $hii;

			// delete old image
            $oldimage = DB::table('advertisement')->where('id',$id)->first();
            if(!empty($oldimage)){
	            $filename= $oldimage->image;
	            Storage::disk('public_folder')->delete($filename);
	    	}
    	}
		$data['type'] = $input['type'];

		$data['url'] = $input['url'];
		$data['start_date'] = $input['start_date'] ?? '';
		$data['end_date'] = $input['end_date'] ?? '';

		if(!empty($input['coaching_id'])){

			$data['coaching_id'] = $input['coaching_id'];

			DB::table('advertisement')->where('id',$getid)->update($data);
		}
		else{

			DB::table('advertisement')->where('id',$getid)->update($data);
		}
		
		
		$id = base64_encode(serialize($id));
		return redirect()->action('AdvertisementController@view_advertisement')->with('success','Advertisement update successfully');

}

	public function view_advertisement(){
		return view('advertisement.view');
	}

	public function view_advertisement_table(){
		$data = DB::table('advertisement')
				->orderBy('id','desc');
				
		if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$start_date = date('Y-m-d', strtotime(request('start_date')));
				$data = $data->whereDate('advertisement.start_date', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$data = $data->whereDate('advertisement.end_date', '<=',date('Y-m-d',strtotime($end_date)));
			}
		}
		
		$data = $data->get();

		$i=1;$JsonFinal=array();
        if(!empty($data))
        {
            foreach ($data as $fmatch)
            {
				
                $confirm = "return confirmation('Are you sure?') ";

				$link = Storage::disk('public_folder')->url($fmatch->image);

				$id=base64_encode(serialize($fmatch->id));
								
                $default_img = "this.src='" . asset("public/logo.png") . "'";

				$width = ($fmatch->type == 'small') ? ('80') : ('350');

				$img = "<img src='".$link."' width=".$width." onerror='".$default_img."'>";

				$coaching_name = DB::table('coaching')->where('id',$fmatch->coaching_id)->first();

				$edit =action('AdvertisementController@edit_advertisement',$id);
				$delete =action('AdvertisementController@delete_advertisement',$id);

				$onclick = "delete_sweet_alert('".$delete."', 'Are you sure you want to delete this data?')";

                $app = ($fmatch->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('AdvertisementController@delete_advertisement',$id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('AdvertisementController@delete_advertisement',$id) . '" onclick="' . $confirm . '">Enable</a></div>';

                if(!empty($coaching_name)){
					$data=array(
                    $i,
                    ucwords($fmatch->type),
                    

                    ucwords($coaching_name->name),

                    $img,
                    ucwords($fmatch->clicks),
                    ucwords($fmatch->start_date),
                    ucwords($fmatch->end_date),
                    '
                	<div class="d-flex align-items-center">
                	<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('AdvertisementController@edit_advertisement', $id) . '" aria-label="Edit" data-balloon-pos="up" ><i class="fad fa-pencil-alt"></i></a>
                    '.$app.'</div>',

                );	
				}
				else{

					$data=array(
                    $i,
                    ucwords($fmatch->type),

                    ucwords('Not Selected'),

                    $img,
                    ucwords($fmatch->clicks),
                    ucwords($fmatch->start_date),
                    ucwords($fmatch->end_date),
					'
                	<div class="d-flex align-items-center">
                	<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('AdvertisementController@edit_advertisement', $id) . '" aria-label="Edit" data-balloon-pos="up" ><i class="fad fa-pencil-alt"></i></a>
                    '.$app.'</div>',

                );	

				}
                
                $i++;
                $JsonFinal[]=$data;
            }
        }

        $jsonFinal1 = json_encode(array('data' => $JsonFinal));
        echo $jsonFinal1;
        die;
	}

	public function delete_advertisement($id){
		
	    $id = unserialize(base64_decode($id));

        $input = request()->except('_token');
        
        $old_status = DB::table('advertisement')->where('id', $id)->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('advertisement')->where('id', $id)->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Advertisement '.$new_status.' successfully');
        else
        return redirect()->back()->with('success', 'Advertisement '.$new_status.' successfully');
	}
}