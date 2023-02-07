<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use File;
use Session;

use App\Helpers\Helpers;

use Illuminate\Support\Facades\Storage;
class CounsellingFaqController extends Controller
{
	
    public function counselling_faq(){
		return view('counselling_faq.add');
	}

	public function add_counselling_faq(Request $request){
		
		$input = $request->all();
		
		unset($input['_token']);

		$faq = $input['faq'];

		if (!empty($faq)) {
			foreach ($faq as $specific) {

				$specific_data = array();
				$specific_data['name'] = $specific['name'];
				$specific_data['value'] = $specific['value'];
				DB::table('counselling_faq')->insert($specific_data);
			}
		}
		
		return redirect()->action('CounsellingFaqController@view_counselling_faq')->with('success','Counselling faq added successfully');
	}

	public function edit_counselling_faq($id)
	{
		$getid = unserialize(base64_decode($id));
		
		$counselling_faq = DB::table('counselling_faq')
							->where('id', $getid)
							->first();
		
		return view('counselling_faq.edit',compact('counselling_faq'));
	}

	public function update_counselling_faq(Request $request,$id)
	{
		$id = unserialize(base64_decode($id));
		
		$getid = $id;
		$input = $request->all();

		DB::table('counselling_faq')
			->where('id', $getid)
			->delete();    

		$faq = $input['faq'];

		if (!empty($faq)) {
			foreach ($faq as $specific) {

				$specific_data = array();
				$specific_data['name'] = $specific['name'];
				$specific_data['value'] = $specific['value'];
				DB::table('counselling_faq')->insert($specific_data);
			}
		}
		
		$id = base64_encode(serialize($id));
		return redirect()
				->action('CounsellingFaqController@view_counselling_faq')
				->with('success','Counselling faq update successfully');

	}

	public function view_counselling_faq(){
		return view('counselling_faq.view');
	}

	public function view_counselling_faq_table(){
		$data = DB::table('counselling_faq')->orderBy('id','desc')->get();

		$i=1;$JsonFinal=array();
        if(!empty($data))
        {
            foreach ($data as $fmatch)
            {
				
                $confirm = "return confirmation('Are you sure?') ";

				$id=base64_encode(serialize($fmatch->id));

				$edit =action('CounsellingFaqController@edit_counselling_faq',$id);
				$delete =action('CounsellingFaqController@delete_counselling_faq',$id);

				$onclick = "delete_sweet_alert('".$delete."', 'Are you sure you want to delete this data?')";

                $app = ($fmatch->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CounsellingFaqController@delete_counselling_faq',$id) . '" onclick="' . $confirm . '">Disable</a></div>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CounsellingFaqController@delete_counselling_faq',$id) . '" onclick="' . $confirm . '">Enable</a></div>';

				if( strlen($fmatch->name) >= 40 ) {
                    $nestedData['name'] = '<span data-balloon-length="xlarge" aria-label="' . $fmatch->name . '" data-balloon-pos="up">' . substr($fmatch->name, 0, 40) . '...</span>';
                } else {
                    $nestedData['name'] = $fmatch->name;
                }
				
				if( strlen($fmatch->value) >= 40 ) {
                    $nestedData['value'] = '<span data-balloon-length="xlarge" aria-label="' . $fmatch->value . '" data-balloon-pos="up">' . substr($fmatch->value, 0, 40) . '...</span>';
                } else {
                    $nestedData['value'] = $fmatch->value;
                }

                $data=array(
                    $i,
					$nestedData['name'],
					$nestedData['value'],
					'<div class="d-flex align-items-center">
                	<a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('CounsellingFaqController@edit_counselling_faq', $id) . '" aria-label="Edit" data-balloon-pos="up" ><i class="fad fa-pencil-alt"></i></a>
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

	public function delete_counselling_faq($id){
		
	    $id = unserialize(base64_decode($id));

        $input = request()->except('_token');
        
        $old_status = DB::table('counselling_faq')->where('id', $id)->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('counselling_faq')->where('id', $id)->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Counselling faq '.$new_status.' successfully');
        else
        return redirect()->back()->with('success', 'Counselling faq '.$new_status.' successfully');
	}
}