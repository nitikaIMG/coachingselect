<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class TestimonialsController extends Controller
{

    public function add_testimonial() {

        if(request()->isMethod('get')) {

            $states = DB::table('states')
                        ->get();
            $countries = DB::table('countries')
                        ->select('id', 'name')
                        ->get();

            return view('testimonials.add_testimonial', compact('states','countries'));

        } else {

            $input = request()->except('_token');

            
            $is_exists = DB::table('testimonials')
                        ->where('name', $input['name'])
                        ->exists();

            if ($is_exists) {
            }

            if( !empty($input) ) {

                $image = '';

                $file = request('image');

                $thumbnailPath = public_path('testimonials/');

                $fileName = 'testimonial-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file,$thumbnailPath,$fileName);

                if($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }

                try {
                    DB::table('testimonials')->insert($input);
                } catch(\Exception $e) {
                    return redirect()
                                ->back()
                                ->with('error', 'Please fill out all the fields');
                }

                return redirect()
                            ->action('TestimonialsController@view_testimonial')
                            ->with('success', 'Testimonial Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_testimonial() {
    
        $input = request()->except('_token');

        if(request()->isMethod('get')) {
            
            if( empty($input['id']) ) {
                return redirect()->action('TestimonialsController@view_testimonial');
            }

            $testimonial = DB::table('testimonials')
                    ->where('id', $input['id'])
                    ->first();

            if( empty($testimonial) ) {
                abort(404);
            }

            
            $states = DB::table('states')
                        ->get();
            $countries = DB::table('countries')
                        ->get();
            
            return view('testimonials.edit_testimonial', compact('testimonial', 'states','countries'));
        } else {
            
            $is_exists = DB::table('testimonials')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
            }
                
            if(!request()->file('image')) {

                unset($input['image']);

            } else {

                $image = DB::table('testimonials')->where('id', $input['id'])->value('image');
                
                @unlink(asset('/public/testimonials/'.$image));

                $file = request('image');

                $thumbnailPath = public_path('testimonials/');

                $fileName = 'testimonial-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file,$thumbnailPath,$fileName);

                if($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('testimonials')->where('id', $input['id'])->update($input);

            return redirect()->action('TestimonialsController@view_testimonial')->with('success', 'Testimonial Updated successfully');
        }
    }

    public function delete_testimonial() {

        $input = request()->except('_token');
        
        $old_status = DB::table('testimonials')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('testimonials')->where('id', $input['id'])->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Testimonial '.$new_status.' successfully');
        else
        return redirect()->back()->with('success', 'Testimonial '.$new_status.' successfully');
    }

    public function view_testimonial() {

        return view('testimonials.view_testimonial');

    }
    
    public function view_testimonial_dt(Request $request) {

		$columns = array(
			0 => 'testimonials.id',
			1 => 'testimonials.name',
			2 => 'testimonials.image',
			3 => 'testimonials.stars',
			4 => 'testimonials.state',
			5 => 'testimonials.city',
			6 => 'testimonials.created_at',
			7 => 'testimonials.status'
		);

		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $query = DB::table('testimonials');
        
          if(request()->has('name')){
            $name=request('name');

            if($name!=""){
              $query->where('testimonials.name', 'LIKE', '%'.$name.'%');
            }
          }

        if(request()->has('start_date')){
			$start_date = request('start_date');
			
			if($start_date!=""){
				$query = $query->whereDate('testimonials.created_at', '>=',date('Y-m-d',strtotime($start_date)));
			}
		}

		if(request()->has('end_date')){
			$end_date = request('end_date');
			if($end_date!=""){
				$query = $query->whereDate('testimonials.created_at', '<=',date('Y-m-d',strtotime($end_date)));
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

                $default_img = "this.src='".asset("public/logo.png")."'";

				$nestedData['id'] = $count;
				
                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="'.action('TestimonialsController@delete_testimonial', 'id='.$post->id).'" onclick="'.$confirm.'">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="'.action('TestimonialsController@delete_testimonial', 'id='.$post->id).'" onclick="'.$confirm.'">Enable</a>';

                if( strlen($post->name) >= 40 ) {
                    $nestedData['name'] = '<span data-balloon-length="xlarge" aria-label="' . $post->name . '" data-balloon-pos="up">' . substr($post->name, 0, 40) . '...</span>';
                } else {
                    $nestedData['name'] = $post->name;
                }
                if( strlen($post->title) >= 40 ) {
                    $nestedData['title'] = '<span data-balloon-length="xlarge" aria-label="' . $post->title . '" data-balloon-pos="up">' . substr($post->title, 0, 40) . '...</span>';
                } else {
                    $nestedData['title'] = $post->title;
                }
                $nestedData['image'] = '<img src="'.asset('public/testimonials/'. $post->image).'" width=60 onerror="'.$default_img.'">';
                $nestedData['stars'] = $post->stars;
                $nestedData['state'] = $post->state;
                $nestedData['city'] = $post->city;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                
                $nestedData['action'] = '
                <div class="d-flex"><a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="'.action('TestimonialsController@edit_testimonial', 'id='.$post->id).'"  aria-label="Edit" data-balloon-pos="up"><i class="fad fa-pencil"></i></a>
                '.$new_status.'</div>';
                
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

    public function cities() {
        $state_id1 = request()->get('state_id');

        $state_id = DB::table('states')
                        ->where('name', $state_id1)
                        ->value('id');
                        
        if( empty($state_id) ) {              
            $state_id = DB::table('states')
                            ->where('id', $state_id1)
                            ->value('id');
        }

        return DB::table('cities')
            ->where('state_id', $state_id)
            ->get();
    }


    public function states() {
        $country_id1 = request()->get('country_id');

        $country_id = DB::table('countries')
                        ->where('name', $country_id1)
                        ->value('id');

        if( empty($country_id) ) {              
            $country_id = DB::table('countries')
                            ->where('id', $country_id1)
                            ->value('id');
        }

        return DB::table('states')
            ->where('country_id', $country_id)
            ->get();
    }

}