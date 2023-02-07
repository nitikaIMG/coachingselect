<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class OrderController extends Controller
{

    
    public function view_orders()
    {

        return view('orders.view_orders');
    }

    public function view_orders_dt(Request $request)
    {

        $columns = array(
            0 => 'orders.id',
            1 => 'orders.student_name',
            2 => 'orders.parent_name',
            3 => 'coaching.name',
            4 => 'coaching_courses_detail.name',
            5 => 'orders.student_name',
            6 => 'orders.id',
            7 => 'orders.total_price',
            8 => 'orders.total_price',
            9 => 'orders.total_price',
            10 => 'orders.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('orders')
                ->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'orders.coaching_courses_detail_id')
                ->join('coaching', 'coaching.id', '=', 'coaching_courses_detail.coaching_id')
                ->select('coaching.name as cname', 'orders.created_at as date', 'orders.*', 'coaching_courses_detail.*')
                ->where('orders.status', 'TXN_SUCCESS');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_courses_detail.name', 'LIKE', '%' . $name . '%');
            }
        }

        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('orders.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('orders.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            $posts = $posts->orderBy('orders.created_at', 'desc');
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

                $nestedData['student_name'] = $post->student_name;

                $nestedData['cname'] = $post->cname;
                $nestedData['name'] = $post->name;
                $nestedData['parent_name'] = $post->parent_name;
                $nestedData['total_price'] = $post->total_price;

                $discount_price = ($post->fee * $post->offer_percentage) / 100;
                $final_price = ($post->fee - $discount_price);
            
                if($post->gst_inclusive_exclusive == 'exclusive')
                    $final_price = $final_price+$final_price * 18 / 100;
                
                $nestedData['final_price'] = $final_price;
                $nestedData['registration_fee'] = $post->registration_fee;
                $nestedData['remaining_fee'] = $post->remaining_amount;
                
                if($nestedData['total_price'] != 0) {
                    $nestedData['total_price'] = '₹'.$nestedData['total_price'];
                }
                
                if($nestedData['final_price'] != 0) {
                    $nestedData['final_price'] = '₹'.$nestedData['final_price'];
                } 
                
                if($nestedData['registration_fee'] != 0) {
                    $nestedData['registration_fee'] = '₹'.$nestedData['registration_fee'];
                }  
                
                if($nestedData['remaining_fee'] != 0) {
                    $nestedData['remaining_fee'] = '₹'.$nestedData['remaining_fee'];
                } 

                $nestedData['email'] = $post->email;

                $nestedData['mobile'] = $post->mobile;

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
    
    
    public function view_orders_counselling()
    {

        return view('orders.view_orders_counselling');
    }

    public function view_orders_counselling_dt(Request $request)
    {

        $columns = array(
            0 => 'counselling_order.id',
            1 => 'counselling_order.student_name',
            2 => 'counselling_order.parent_name',
            3 => 'counselling.name',
            4 => 'counselling.type',
            5 => 'counselling_order.student_name',
            6 => 'counselling_order.id',
            7 => 'counselling_order.total_price',
            8 => 'counselling_order.total_price',
            9 => 'counselling_order.total_price',
            10 => 'counselling_order.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('counselling_order')
                ->join('counselling', 'counselling.id', '=', 'counselling_order.counselling_id')
                ->select('counselling.type as cname', 'counselling_order.created_at as date', 'counselling_order.*', 'counselling.*')
                ->where('counselling_order.status', 'TXN_SUCCESS');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('counselling.name', 'LIKE', '%' . $name . '%');
            }
        }

        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('counselling_order.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('counselling_order.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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
            $posts = $posts->orderBy('counselling_order.created_at', 'desc');
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

                $nestedData['student_name'] = $post->student_name;

                $nestedData['cname'] = $post->cname;

                if( strlen(ucwords($post->name)) >= 40 ) {
                    $name = '<span data-balloon-length="xlarge" aria-label="' . $post->name . '" data-balloon-pos="up">' . substr($post->name, 0, 40) . '...</span>';
                } else {
                    $name = ucwords($post->name);
                }

                $nestedData['name'] = $name;
                
                $nestedData['parent_name'] = $post->parent_name;
                $nestedData['total_price'] = $post->total_price;

                $discount_price = ($post->fee * $post->offer_percentage) / 100;
                $final_price = ($post->fee - $discount_price);
            
                $nestedData['final_price'] = $final_price;
                
                if($nestedData['total_price'] != 0) {
                    $nestedData['total_price'] = '₹'.$nestedData['total_price'];
                }
                
                if($nestedData['final_price'] != 0) {
                    $nestedData['final_price'] = '₹'.$nestedData['final_price'];
                } 

                $nestedData['email'] = $post->email;

                $nestedData['mobile'] = $post->mobile;

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