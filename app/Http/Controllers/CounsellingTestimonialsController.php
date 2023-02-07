<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class CounsellingTestimonialsController extends Controller
{

    public function add_counselling_testimonial() {

        if(request()->isMethod('get')) {

            $states = DB::table('states')
                        ->get();
            $countries = DB::table('countries')
                        ->get();

            return view('counselling_testimonials.add_counselling_testimonial', compact('countries','states'));

        } else {

            $input = request()->except('_token');
            
            $is_exists = DB::table('counselling_testimonials')
                        ->where('name', $input['name'])
                        ->exists();

            if ($is_exists) {
            }

            if( !empty($input) ) {

                $image = '';

                $file = request('image');

                $thumbnailPath = public_path('counselling_testimonials/');

                $fileName = 'testimonial-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file,$thumbnailPath,$fileName);

                if($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }

                try {
                    DB::table('counselling_testimonials')->insert($input);
                } catch(\Exception $e) {
                    return redirect()
                                ->back()
                                ->with('error', 'Please fill out all the fields');
                }

                return redirect()
                            ->action('CounsellingTestimonialsController@view_counselling_testimonial')
                            ->with('success', 'Testimonial Added successfully');
            }

            return back()->with('error', 'Please provide data');
        }
    }

    public function edit_counselling_testimonial() {
    
        $input = request()->except('_token');

        if(request()->isMethod('get')) {
            
            if( empty($input['id']) ) {
                return redirect()->action('CounsellingTestimonialsController@view_counselling_testimonial');
            }

            $testimonial = DB::table('counselling_testimonials')
                    ->where('id', $input['id'])
                    ->first();

            if( empty($testimonial) ) {
                abort(404);
            }

            
            $states = DB::table('states')
                        ->get();
            $countries = DB::table('countries')
                        ->get();
            
            return view('counselling_testimonials.edit_counselling_testimonial', compact('countries','testimonial', 'states'));
        } else {
            
            $is_exists = DB::table('counselling_testimonials')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
            }
                
            if(!request()->file('image')) {

                unset($input['image']);

            } else {

                $image = DB::table('counselling_testimonials')->where('id', $input['id'])->value('image');
                
                @unlink(asset('/public/counselling_testimonials/'.$image));

                $file = request('image');

                $thumbnailPath = public_path('counselling_testimonials/');

                $fileName = 'testimonial-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file,$thumbnailPath,$fileName);

                if($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('counselling_testimonials')->where('id', $input['id'])->update($input);

            return redirect()->action('CounsellingTestimonialsController@view_counselling_testimonial')->with('success', 'Testimonial Updated successfully');
        }
    }

    public function delete_counselling_testimonial() {

        $input = request()->except('_token');
        
        $old_status = DB::table('counselling_testimonials')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('counselling_testimonials')->where('id', $input['id'])->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Testimonial '.$new_status.' successfully');
        else
        return redirect()->back()->with('success', 'Testimonial '.$new_status.' successfully');
    }

    public function view_counselling_testimonial() {

        return view('counselling_testimonials.view_counselling_testimonial');

    }
    
    public function view_counselling_testimonial_dt(Request $request) {

		$columns = array(
			0 => 'counselling_testimonials.id',
			1 => 'counselling_testimonials.name',
			2 => 'counselling_testimonials.image',
			3 => 'counselling_testimonials.stars',
			4 => 'counselling_testimonials.state',
			5 => 'counselling_testimonials.city',
			6 => 'counselling_testimonials.status',
			7 => 'counselling_testimonials.status'
		);

		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $query = DB::table('counselling_testimonials');
        
          if(request()->has('name')){
            $name=request('name');

            if($name!=""){
              $query->where('counselling_testimonials.name', 'LIKE', '%'.$name.'%');
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
				
                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="'.action('CounsellingTestimonialsController@delete_counselling_testimonial', 'id='.$post->id).'" onclick="'.$confirm.'">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="'.action('CounsellingTestimonialsController@delete_counselling_testimonial', 'id='.$post->id).'" onclick="'.$confirm.'">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['title'] = $post->title;
                $nestedData['image'] = '<img src="'.asset('public/counselling_testimonials/'. $post->image).'" width=60 onerror="'.$default_img.'">';
                
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '
                <div class="d-flex"><a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" href="'.action('CounsellingTestimonialsController@edit_counselling_testimonial', 'id='.$post->id).'"  aria-label="Edit" data-balloon-pos="up"><i class="fad fa-pencil"></i></a>
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
        $state_id = request()->get('state_id');

        $state_id = DB::table('states')
                        ->where('name', $state_id)
                        ->value('id');

        return DB::table('cities')
            ->where('state_id', $state_id)
            ->get();
    }


    public function states() {
        $country_id = request()->get('country_id');

        $country_id = DB::table('countries')
                        ->where('name', $country_id)
                        ->value('id');
        
        return DB::table('states')
            ->where('country_id', $country_id)
            ->get();
    }

}