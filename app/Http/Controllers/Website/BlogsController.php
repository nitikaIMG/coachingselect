<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

class BlogsController extends Controller
{
    
    public function blogs() {
        
        $header = new HeaderController();
        $footer = new FooterController();

        $recent_blogs = $this->recent_blogs(); 

        $blogs = DB::table('blogs')
                    ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                    ->where('blogs.status', 'enable')
                    ->where('blogs_category.status', 'enable')
                    ->latest('blogs.id')
                    ->select('blogs.*', 'blogs_category.name as category');

        $blogs_with_categories = $blogs->get()->groupBy('category');

        // dd($blogs_with_categories);
        
        $categories = array();
        
        $category_limit = 15;
        
        if( !empty($blogs_with_categories) ) {
            $count = 1;
            foreach($blogs_with_categories as $category => $blogs_all) {
                
                if($count > $category_limit) {
                    break;
                }

                $categories[$category] = count($blogs_all);

                $count += 1;
            }
        }
        
        if( request()->has('category') ) {
            $category = request()->get('category');

            if( !empty($category) ) {
                $blogs = $blogs
                            ->where('blogs_category.name', $category);
                    
                $metatitle= "CoachingSelect : Latest Update for All $category, Exam, News, Syllabus, Admission Cutt off, Results";

                $metadescription = "Get Latest News Update for India, Top Engineering, Management, Medical, Fashions, Arts, Science, Commerce Institutes and Colleges news including details of application process,important date like application date,counselling date,result date,exam pattern,fees structure,brochure,sample paper.";

                $metakeywords = 'CoachingSelect, Latest exam update, new Syllabus, exam result date, admission date, top india college, best college near me, best online claasess';
            }
        } else {

            $metatitle= 'CoachingSelect.com: Know Everything about the Latest Educational information';

            $metadescription = 'Coachingselect - Read the latest information of coaching, colleges, institute, university & others across the country, view admission and exam notifications in detail.';

            $metakeywords = 'CoachingSelect, Latest exam update, new Syllabus, exam result date, admission date, top india coaching institute, best coaching institute near me, best online coaching, coaching center, coaching near me, latest exam, exam syllabus, preparation paper';
        }

        if( request()->has('search_query') ) {
            $search_query = request()->get('search_query');

            if( !empty($search_query) ) {
                $blogs = $blogs
                            ->where('blogs.title', 'LIKE', '%'.$search_query.'%');
            }
        }

        $blogs = $blogs
                    ->get()
                    ->groupBy('category');

        $blog_search_autocomplete = $this->blog_search_autocomplete();
        
        return view('website.blogs', compact('header', 'footer', 'blogs', 'recent_blogs', 'categories', 'blog_search_autocomplete'
        ,'metatitle'
        ,'metadescription'
        ,'metakeywords'
        ));
    }

    public function blog($title) {

        $header = new HeaderController();
        $footer = new FooterController();

        $title = str_replace('-', ' ', $title);
        
        $blog = DB::table('blogs')
                    ->where('title', $title)
                    ->where('blogs.status', 'enable')
                    ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                    ->where('blogs.status', 'enable')
                    ->where('blogs_category.status', 'enable')
                    ->select('blogs.*')
                    ->first();
            
        if( !empty($blog) ) {

            $blog->comments = DB::table('blogs_like_comment')
                                ->where('blog_id', $blog->id)
                                ->where('comment', '!=', '')
                                ->where('status', 'enable')
                                ->count();

            # increase a view
            $this->view($blog->id);
            
            $blog_comments = DB::table('blogs_like_comment')
                                ->join('students', 'students.id', 'blogs_like_comment.user_id')
                                ->where('blog_id', $blog->id)
                                ->where('blogs_like_comment.status', 'enable')
                                ->select('blogs_like_comment.*', 'students.name', 'students.image')
                                ->get();
             
            $is_liked_by_me = false;
            $can_like = false;
            $can_comment = false;

            if( !empty(session()->get('student')->id) ) {
                $my_like_comment = DB::table('blogs_like_comment')
                                    ->where('blog_id', $blog->id)
                                    ->where('user_id', session()->get('student')->id ?? '')
                                    ->where('blogs_like_comment.status', 'enable')
                                    ->orWhere('blogs_like_comment.status', 1)
                                    ->first();

                if( !empty($my_like_comment) ) {

                    if($my_like_comment->like == 1) {                                    
                        $is_liked_by_me = true;
                        $can_like = false;
                    } else {
                        $can_like = true;
                    }
                    
                    $can_comment = empty($my_like_comment->comment) ? true : false;
                }  else {
                    $can_like = true;
                    $can_comment = true;
                }
                                    
            }
                        
            $recent_blogs = $this->recent_blogs($blog->id, $blog->blog_category_id);

            $categories = $this->categories();
                
            $blog_search_autocomplete = $this->blog_search_autocomplete();

            $metatitle= $blog->title;

            $metatitle = '';
            $metadescription = '';
            $metakeywords = '';

            $metatitle = $blog->metatitle ?? $blog->title;
            $metadescription = $blog->metadescription ?? '';
            $metakeywords = $blog->metakeywords ?? '';
        
            return view('website.blog', compact('header', 'footer', 'blog', 'blog_comments', 'recent_blogs', 'can_like', 'can_comment', 'is_liked_by_me', 'categories', 'blog_search_autocomplete', 
            'metatitle',
            'metadescription',
            'metakeywords'
            ));
        } else {
            abort(404);
        }
    }

    public function recent_blogs($blog_id = '', $blog_category_id = '') {
        
        $blogs = DB::table('blogs')
                ->where('blogs.status', 'enable')
                ->latest('blogs.created_at');

        if( !empty($blog_id) and !empty($blog_category_id) ) {
            $blogs = $blogs
                        ->where('blogs.id', '!=', $blog_id)
                        ->where('blogs.blog_category_id', $blog_category_id);
        }

        $blogs = $blogs
                ->take(5)
                ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                ->where('blogs.status', 'enable')
                ->where('blogs_category.status', 'enable')
                ->get();
        
        return $blogs;
    }    

    public function like() {

        $blog_id = request()->get('blog_id');

        $is_exists = DB::table('blogs')
                        ->where('id', $blog_id)
                        ->exists();
            
        if($is_exists) {
            $user_id = session()->get('student')->id ?? '';

            if($user_id) {
                    
                $my_like_comment = DB::table('blogs_like_comment')
                                    ->where('blog_id', $blog_id)
                                    ->where('user_id', $user_id)
                                    ->first();

                $like = array();
                $like['blog_id'] = $blog_id;
                $like['user_id'] = $user_id;
                $like['like'] = 1;       
                
                $is_liked = false;

                if( !empty($my_like_comment) ) {

                    if($my_like_comment->like == 0) {
                        DB::table('blogs_like_comment')
                            ->where('blog_id', $blog_id)
                            ->where('user_id', $user_id)
                            ->update($like);

                        $is_liked = true;
                    }

                } else {
                    DB::table('blogs_like_comment')
                    ->insert($like);
                
                    $is_liked = true;
                }


                if($is_liked) {
                    DB::table('blogs')
                        ->where('id', $blog_id)
                        ->increment('likes', 1);
                }

                $total_likes = DB::table('blogs')
                                ->where('id', $blog_id)
                                ->value('likes');
                
                return [
                    'total_likes' => $total_likes
                ];
            }

            return 0;
        }

        return 0;
    }

    public function comment() {

        $blog_id = request()->get('blog_id');
        $comment = request()->get('comment');

        $is_exists = DB::table('blogs')
                        ->where('id', $blog_id)
                        ->exists();
            
        if($is_exists) {
            $user_id = session()->get('student')->id ?? '';

            if($user_id) {
                    
                $my_like_comment = DB::table('blogs_like_comment')
                                    ->where('blog_id', $blog_id)
                                    ->where('user_id', $user_id)
                                    ->first();

                $comment_data = array();
                $comment_data['blog_id'] = $blog_id;
                $comment_data['user_id'] = $user_id;
                $comment_data['comment'] = $comment;       
                $comment_data['is_seen'] = 0;       
                
                $is_commented = false;

                if( !empty($my_like_comment) ) {

                    DB::table('blogs_like_comment')
                        ->where('blog_id', $blog_id)
                        ->where('user_id', $user_id)
                        ->update($comment_data);

                    $is_commented = true;

                } else {
                    DB::table('blogs_like_comment')
                    ->insert($comment_data);
                
                    $is_commented = true;
                }


                if($is_commented) {
                    $total_comments = DB::table('blogs_like_comment')
                                        ->where('blog_id', $blog_id)
                                        ->where('comment', '!=', '')
                                        ->count();

                    DB::table('blogs')
                        ->where('id', $blog_id)
                        ->update([
                            'comments' => $total_comments
                        ]);
                }

                return redirect()
                        ->back()
                        ->with('success', 'Your comment posted successfully on this blog');
            }

            return back();
        }

        return back();
    }

    public function view($blog_id) {

        $is_exists = DB::table('blogs')
                        ->where('id', $blog_id)
                        ->exists();
            
        if($is_exists) {
            $user_id = session()->get('student')->id ?? 0;
   
                $my_views = DB::table('blogs_like_comment')
                                ->where('blog_id', $blog_id)
                                ->where('user_id', $user_id)
                                ->first();

                $view = array();
                $view['blog_id'] = $blog_id;
                $view['user_id'] = $user_id;
                $view['view'] = 1;       
                
                $is_viewed = false;

                if( !empty($my_views) ) {

                    DB::table('blogs_like_comment')
                        ->where('blog_id', $blog_id)
                        ->where('user_id', $user_id)
                        ->increment('view', 1);

                    $is_viewed = true;

                } else {
                    DB::table('blogs_like_comment')
                    ->insert($view);
                
                    $is_viewed = true;
                }


                if($is_viewed) {
                    DB::table('blogs')
                        ->where('id', $blog_id)
                        ->increment('views', 1);
                }

                $total_views = DB::table('blogs')
                                ->where('id', $blog_id)
                                ->value('views');
                
                return [
                    'total_views' => $total_views
                ];

            return 0;
        }

        return 0;
    }

    public function delete_comment($title) {
        
        $title = str_replace('-', ' ', $title);

        $is_exists = DB::table('blogs')
                        ->where('title', $title)
                        ->where('status', 'enable')
                        ->first();
        
        if( !empty($is_exists) ) {
            
            if( session()->has('student') ) {
                $user_id = session()->get('student')->id;

                if( !empty($user_id) ) {

                    $comment = array();
                    $comment['comment'] = '';

                    DB::table('blogs_like_comment')
                        ->where('blog_id', $is_exists->id)
                        ->where('user_id', $user_id)
                        ->update($comment);
                }
            }
        }

        return back();

    }

    public function categories() {
        $blogs = DB::table('blogs')
                    ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                    ->where('blogs.status', 'enable')
                    ->where('blogs_category.status', 'enable')
                    ->latest('blogs.created_at')
                    ->select('blogs.*', 'blogs_category.name as category');

        $blogs_with_categories = $blogs->get()->groupBy('category');

        $categories = array();
        
        $category_limit = 15;
        
        if( !empty($blogs_with_categories) ) {
            $count = 1;
            foreach($blogs_with_categories as $category => $blogs_all) {
                
                if($count > $category_limit) {
                    break;
                }

                $categories[$category] = count($blogs_all);

                $count += 1;
            }
        }

        return $categories;
    }

    public function blog_search_autocomplete() {
        
        $blogs = DB::table('blogs')
                ->where('status', 'enable')
                ->pluck('title')
                ->toArray();
        
        return $blogs;
    }

    public function add_blog() {
        $input = request()->except('_token');

        if (!empty($input) and session()->has('student')) {

            $is_exists = DB::table('blogs')
                ->where('title', $input['title'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A Blog with this title already exists');
            }

            if ( empty($input['description']) ) {
                return back()->with('error', 'Description is required');
            }

            $input['status'] = 'disable';

            $image = '';

            $file = request('image');

            $thumbnailPath = public_path('blogs/');

            $fileName = 'blog-' . time() . random_int(0, 10);

            $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

            if ($input['image'] == '') {
                return redirect()->back()->with('error', 'invalid image provided');
            }

            if (!request()->file('writer_image')) {

                unset($input['writer_image']);
            } else {

                $file = request('writer_image');

                $thumbnailPath = public_path('blogs/');

                $fileName = 'blog-writer-' . time() . random_int(0, 10);

                $input['writer_image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['writer_image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            $input['written_by'] = session()->get('student')->name;
            $input['user_id'] = session()->get('student')->id;

            DB::table('blogs')->insert($input);
            
            try {
  
                // send mail
                
                $email = session()->get('student')->email;
                
                $student_name = session()->get('student')->name;
                        
                $subject = 'Guest Blog post on CoachingSelect';
                
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.guest_blog_post', compact('student_name'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
            }

            return redirect()                                
                        ->back()
                        ->with('success', 'Blog Submitted successfully to admin for approval');
        }

        return redirect()->back();
    }

}

