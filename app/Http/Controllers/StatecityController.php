<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use URL;

class StatecityController extends Controller
{

    public function get_states()
    {
        if (request()->isMethod('get')) {
            $getallstates = DB::table('states');
            $country_id= 101;
            if (isset($_GET['country'])) {
                $country_id = $_GET['country'];
                if ($country_id != "") {
                    $getallstates =  $getallstates->where('country_id',$country_id);
                }
            }else{
                $getallstates =  $getallstates->where('country_id',$country_id);
            }

            $getallstates = $getallstates->get();
            $getallcountry = DB::table('countries')->get();
            return view('state_city.view_states', compact('getallstates','getallcountry','country_id'));
        }
    }

    public function edit_state(Request $request)
    {
        $input= $request->all();
        unset($input['_token']);
        $isExists= DB::table('states')->where('id','<>',$input['id'])->where('name',$input['name'])->exists();
        if($isExists==true){
            $msg = 'This state already exists';   
            return redirect()->action('StatecityController@get_states')->with('danger', $msg);
        }
        DB::table('states')->where('id',$input['id'])->update($input);
        $msg = 'State Updated successfully';   
        return redirect()->action('StatecityController@get_states')->with('success', $msg);
    }
    public function updatestatus($id, $status)
    {
        $State = DB::table('states')->where('id', $id)->first();
        if (!empty($State)) {
            $data['status'] = $status;
            DB::table('states')->where('id', $id)->update($data);
            $getcities = DB::table('cities')->where('state_id', $id)->update($data);
        }

        if($status == 1) {
            $msg = 'State enable successfully';
            return redirect()->action('StatecityController@get_states')->with('success', $msg);
        } else {
            $msg = 'State disable successfully';   
            return redirect()->action('StatecityController@get_states')->with('danger', $msg);
        }
        
    }

    public function state_search(Request $request)
    {
        $input = $request->all();
        $sts = $input['country'];
        if (!empty($sts)) {
            $getallstates = DB::table('states');

            $getallstates = $getallstates->where('country_id', $sts)->get();
            $getallcountry = DB::table('countries')->get();
            return view('state_city.view_states', compact('getallstates', 'getallcountry'));
        }

        return back();
    }

    public function get_city()
    {
        $allstates = DB::table('states')->get();
        return view('state_city.view_city', compact('allstates'));
    }

    public function get_citydatatable(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'start_date',
            3 => 'end_date',
            4 => 'status',
            5 => 'created_at',
            6 => 'updated_at',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $query = DB::table('cities');

        // search for the series name //

        if (isset($_GET['state'])) {
            $state = $_GET['state'];
            if ($state != "") {
                $query =  $query->where('cities.state_id', $state);
            }
        }
        if (isset($_GET['city'])) {
            $city = $_GET['city'];
            if ($city != "") {
                $query =  $query->where('cities.name', 'LIKE', '%' . $city . '%');
            }
        }

        $count = $query->count();
        $titles = $query->select('id', 'name', 'status', 'state_id')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalTitles = $count;
        $totalFiltered = $totalTitles;

        if ($request->input('order.0.column') == '0' && $request->input('order.0.dir') == 'desc') {
            $count = $totalTitles - $start;
        } else {
            $count = $start + 1;
        }

        if (!empty($titles)) {
            $data = array();

            // dd($titles);
            foreach ($titles as $title) {

                $confirm = "return confirmation('Are you sure ?')";
                $ena = action('StatecityController@updatecitystatus', [($title->id), '0']);
                $dis = action('StatecityController@updatecitystatus', [($title->id), '1']);
                $edit_city = action('StatecityController@edit_city', [($title->id)]);
                if ($title->status == 'closed') {
                    $statuss = '<a class="btn btn-sm btn-outline-danger" href="' . $dis . '" onclick="' . $confirm . '">Enable</a>';
                } else {
                    $statuss = '<a class="btn btn-sm btn-danger" href="' . $ena . '" onclick="' . $confirm . '">Disable</a>';
                }
                $edit_btn= '<a class="btn btn-sm w-35px h-35px d-inline-flex p-0 align-items-center justify-content-center mx-1 btn-success" href="' . $edit_city . '" aria-label="Edit" data-balloon-pos="up">
                    <i class="fad fa-pencil"></i>
                    </a>';
                $nestedData['id'] = $count;
                $nestedData['city'] = $title->name;
                $nestedData['status'] = ($title->status == '1') ? 'Enable' : 'Disable';
                $nestedData['action'] = '<div class="col-6">
                        ' . $statuss .$edit_btn.' 
                </div>';

                $data[] = $nestedData;

                if ($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count--;
                } else {
                    $count++;
                }
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalTitles),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);
    }

    public function updatecitystatus($id, $status)
    {
        $Cities = DB::table('cities')->where('id', $id)->first();
        if (!empty($Cities)) {
            $data['status'] = $status;
            $getcities = DB::table('cities')->where('id', $id)->update($data);
        }
        
        if($status == 1) {
            $msg = 'City enable successfully';
            return redirect()->action('StatecityController@get_city')->with('success', $msg);
        } else {
            $msg = 'City disable successfully';   
            return redirect()->action('StatecityController@get_city')->with('danger', $msg);
        }
    }

    public function add_city(Request $request)
    {
        $input= $request->all();
        if(!empty($input)){
            unset($input['_token']);
            unset($input['country']);
            DB::table('cities')->insert($input);
            $msg = 'City Updated successfully';   
            return redirect()->action('StatecityController@get_city')->with('success', $msg);
        }else{
            $getallcountry = DB::table('countries')->get();
            return view('state_city.add_city', compact('getallcountry'));
        }   
    }
    public function edit_city(Request $request, $id)
    {
        $input= $request->all();
        unset($input['_token']);
        unset($input['country']);
        if (request()->isMethod('post')) {
        $isExists= DB::table('cities')->where('id','<>',$id)->where('state_id',$input['state_id'])->where('name',$input['name'])->first();
            if(!empty($isExists)){
                $msg = 'This City already exists';   
                return redirect()->back()->with('danger', $msg);
            }else{
                DB::table('cities')->where('id',$id)->update($input);
                return redirect('/coaching_admin/get_city')->with('success', 'City Updated successfully');
            }
        }else{
            $getallcountry = DB::table('countries')->get();
            $data =  DB::table('cities')->where('id',$id)->first();
            $statedata = DB::table('states')->where('id',$data->state_id)->first();

            return view('state_city.edit_city',compact('data','getallcountry','statedata'));
        } 
    }
}