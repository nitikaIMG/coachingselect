@extends('website/layouts/header')

@section('facebook_share')
   <!-- facebook -->
   <meta property="og:image" content="{{ asset('public/blogs/'.$blog->image) }}" />
   <meta property="og:image:width" content="1200" />
   <meta property="og:image:height" content="630" />
   <meta property="og:title"       content="{{$blog->title}}" />

   <!-- linkedin -->
   <meta prefix="og: http://ogp.me/ns#" property="og:title" content="{{$blog->title}}" />
   <meta prefix="og: http://ogp.me/ns#" property="og:type" content="Blog Share" />
   <meta prefix="og: http://ogp.me/ns#" property="og:image" content="{{ asset('public/blogs/'.$blog->image) }}" />
   <meta prefix="og: http://ogp.me/ns#" property="og:url" content="{{ url()->current() }}" />

   <!-- twitter -->
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="{{$blog->title}}">
   <meta name="twitter:image" content="{{ asset('public/blogs/'.$blog->image) }}">
@endsection

@section('content')

<style>

img {
    max-width: 100%;
    height: auto !important;
}

.comment_image {
   width: 35px;
   height: 35px;
}

   .link-a{
      cursor: pointer;
   }

   @media only screen and (min-width: 320px) and (max-width: 767px){
      .blog_content span{
         font-size: 14px !important;
      }
      .blog_content table{
         width: 100% !important;
      }
      .blog_content table tr  span{
        font-size: 5px !important;
      }
      .blog_content ul li span {
        font-size: 14px !important;
      }   
   }

   @media only screen and (min-width: 768px) and (max-width: 1024px){
      .blog_content span{
         font-size: 16px !important;
      }
      .blog_content table{
         width: 100% !important;
      }
      .blog_content ul li span {
        font-size: 16px;
      }
      .blog_content table tr  span{
         font-size: 10px !important;
      }
   }
   
</style>

<main id="main">
   <!-- Blog Single SECTION START  -->
   <section id="blog_single" class="blog_single">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 col-12 py-lg-3 order-lg-0 order-md-1 order-1">
               <div class="row mx-n1 pb-3" data-aos="fade-right"> 
                  @if( !empty($blog->tags) )
                     
                     @php
                        $tags = explode(',', $blog->tags);
                     @endphp

                     @foreach($tags as $tag)
                        <div class="col-auto">
                           <div class="row mx-n2">
                              <div class="col-12 px-2 bg-primary rounded mb-1 fs-md-14 fs-12">{{$tag}}</div>
                           </div>
                        </div>
                     @endforeach
                  @endif
               </div>
               <div class="blog_single_details">
                  <h1 class="font-weight-bold text-dark fs-lg-34 fs-md-28 fs-19" data-aos="fade-right">
                     {{$blog->title}}
                  </h1>
                  <p class="fs-md-16 fs-13 title_dec" data-aos="fade-right"                                            >
                     {{$blog->short_description}}
                  </p>
                  <div class="border-bottom mb-0 mt-3 pb-2 mx-0 row align-items-center" data-aos="fade-right">
                     <p class="text-dark fs-md-16 fs-14 col-5 pl-0 d-flex align-items-center mb-0 justify-content-start "> <span class=""><i class="far fa-calendar-alt mr-1"></i>
                        {{date('F d, Y', strtotime($blog->created_at) )}}
                     </span></p>
                     <div class="col-7 text-right pr-0 ">
                        @php
                           $slug = str_replace(' ', '-', $blog->title);
                        @endphp

                        <div class="social_icon d-inline-flex align-items-center">
                           <a target="_blank" href="https://twitter.com/intent/tweet?url={{ action('Website\BlogsController@blog', $slug) }}&title={{$blog->title}}" class="rounded-pill text-white twitter mx-1 justify-content-center align-items-center d-inline-flex h-md-30px h-25px w-md-30px w-25px p-0"><i class="fab fa-twitter"></i></a>
                           <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ action('Website\BlogsController@blog', $slug) }}" class="rounded-pill text-white facebook mx-1 justify-content-center align-items-center d-grid h-md-30px h-25px w-md-30px w-25px p-0"><i class="fab fa-facebook"></i></a>
                           <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(action('Website\BlogsController@blog', $slug)) }}&title=Create LinkedIn Share button on Website Webpages&summary=chillyfacts.com&source=Chillyfacts" class="rounded-pill text-white linkedin mx-1 justify-content-center align-items-center d-grid h-md-30px h-25px w-md-30px w-25px p-0"><i class="fab fa-linkedin"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="row align-items-center my-3" data-aos="fade-right">
                     <div class="col">
                        <div class="d-flex align-items-center fs-14">
                           <span class="h-50px w-50px border shadow p-1 rounded-pill d-flex align-items-center justify-content-center">

                           <img class="w-100 h-100 rounded-pill" 
                           src="{{ asset('public/blogs/'.$blog->writer_image) }}"
                           onerror="this.src='<?php echo asset('public/logo.png'); ?>'" alt="">   
                           </span> 
                           <div class="ml-2 w-md-30 w-70">
                              <strong class="ellipsis-1 fs-md-16 fs-14">By {{ $blog->written_by ?? 'CoachingSelect' }}</strong>
                              <p class="fs-md-14 fs-13 mb-0 w-100 ellipsis-1">{{ $blog->about_writer ?? '' }}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-auto text-right">
                        <a 
                           href="javascript:;"
                           class="btn fs-md-12 fs-10 btn-sm btn-secondary btn-sm btn-sm rounded-pill like
                              "   
                           @if(! session()->has('student') ) 
                              data-toggle="modal" data-target="#exampleModal1"
                           @endif
                        >
                           <i class="far fa-thumbs-up"></i>
                           <span class="is_liked">

                              @if($is_liked_by_me)
                                 Liked
                              @else
                                 Like
                              @endif

                           </span>
                           <span class="like_count">{{$blog->likes}}</span>
                        </a>
                     </div>
                  </div>
                  <div class="blog_content title_dec">
                     <a class="overflow-hidden d-block hover_fade_img" href="javascript:;">
                        <img class="img-fluid mb-3 w-100" 
                        src="{{ asset('public/s_img_new.php?image='.asset('public/blogs/'.$blog->image))}}&width=820&height=460&zc=0"
                        onerror="this.src='<?php echo asset('public/blogs/'.$blog->image); ?>'"
                        data-aos="fade-right" alt=""></a>
                        @php
                           echo $blog->description;
                        @endphp
                  </div>
               </div>
               <div class="row mx-0" id="go_to_comment_box">
                  <div class="col-12" data-aos="fade-up">
                     <div class="row align-items-center">
                        <div class="col-auto pr-0 font-weight-bold fs-md-16 fs-13">Helpful?</div>
                        <div class="col-auto">
                           <a 
                              href="javascript:;" 
                              class="btn btn-sm btn-secondary btn-sm btn-sm rounded-pill like"                                 
                              @if(! session()->has('student') ) 
                                 data-toggle="modal" data-target="#exampleModal1"
                              @endif
                           ><i class="far fa-thumbs-up"></i> 
                           <span class="is_liked">
                           
                              @if($is_liked_by_me)
                                 Liked
                              @else
                                 Like
                              @endif

                           </span>
                           </a>
                        </div>
                        <div class="col-auto pr-0 font-weight-bold fs-md-16 fs-13">Comments</div>
                        <div class="col-auto">
                           <div href="javascript:;" class="font-wight-bold text-secondary fs-md-13 fs-11"><i class="far fa-comments"></i> {{$blog->comments}}</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card my-4" data-aos="fade-up">
                  <h5 class="card-header fs-md-20 fs-16">Write a Comment</h5>
                  <div class="card-body">
                     <form                    
                           action='{{ action("Website\BlogsController@comment") }}'
                           method="post">
                        @csrf
                        @if(!empty(session()->has('student')) or !empty(session()->has('enterprise')))
                                  
                       @else
                       <a data-toggle="modal" data-target="#exampleModal1" class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                       @endif
                        <input type="hidden" name="blog_id" value="{{$blog->id}}" required>
                        <div class="form-group">
                           <textarea class="form-control shadow-none" rows="3" name="comment" required></textarea>
                        </div>
                        <button 
                           @if($can_comment)
                              type="submit"
                           @endif
                           class="btn btn-sm btn-green border-0 rounded-pill comment_submit_btn "                                    
                           @if(! session()->has('student') ) 
                              data-toggle="modal" data-target="#exampleModal1"
                              type="button"
                           @endif
                        ><span>Submit</span></button>
                     </form>
                  </div>
               </div>
               <div class="row mx-0">
               
                  @if( !empty($blog_comments) )
                     @foreach($blog_comments as $comment)
                        @if( 
                           !empty($comment->user_id) and !empty( session()->get('student')->id ) 
                           and !empty($comment->comment) and
                           $comment->user_id == session()->get('student')->id
                        )
                        <div class="border border-success row mb-4 shadow p-4 rounded-5 bg-light col-12" data-aos="fade-up">
                           
                           @php
                              #if( @GetImageSize($comment->image) ) {
                                 $image = $comment->image;
                              #} else {
                              #   $image = asset('public/user.png');
                              #}
                           @endphp
                           <div class="col-auto px-0">
                              <img 
                              class="d-flex rounded-circle comment_image"
                              src="{{$image}}"
                              alt=""
                           >
                           </div>
                           
                           <div class="col fs-14">
                              <h5 class="mt-0 fs-18 text-secondary">{{$comment->name}}</h5>
                              <p class="text-justify">{{$comment->comment}}</p>
                           </div>
                           <div class="row">
                              
                              @php

                                 $my_comment = $comment->comment;

                                 $slug = str_replace(' ', '-', $blog->title);
                                 
                                 $url = action('Website\BlogsController@delete_comment', $slug);
                                 $msg = 'Are you sure?';

                                 $onclick = 'delete_sweet_alert("'.$url.'", "'.$msg.'")';
                              @endphp
                              
                              <div class="row coments_single align-items-center position-absolute top-n12px bg-white right-30px">
                                 <div class="col-auto px-0">
                                    <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="rounded border h-24px py-1 px-2 text-center fs-16 text-secondary border-success"><i class="fal fa-ellipsis-h-alt"></i></a>
                                    <div class="dropdown-menu bg-light shadow" aria-labelledby="dropdownMenuButton">
                                       <ul class="list-unstyled mb-0 pl-0">
                                          <li>
                                             <a class="px-2 fs-12 bg-success rounded-top"                                                   
                                             href="#go_to_comment_box"
                                             onclick="edit_comment('{{$comment->comment}}')"
                                             ><i class="fas fa-edit mr-2"></i>Edit</a>
                                          </li>
                                          <li>
                                             <a class="px-2 fs-12 bg-primary border-0 rounded-bottom" 
                                                   
                                             href="#go_to_comment_box"
                                             onclick='{{$onclick}}'
                                             ><i class="fas fa-trash-alt mr-2"></i>Delete</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>                        
                        @endif
                     @endforeach
                  @endif
                  
                  @if( !empty($blog_comments) )
                     @foreach($blog_comments as $comment)
                        @if( 
                           !empty($comment->comment) 
                        )
                        
                        @php   
                           if( session()->has('student') and $comment->user_id == session()->get('student')->id) {                        
                              continue;
                           }
                        @endphp

                        <div class="media mb-4 shadow p-3 rounded-5 bg-light col-12" data-aos="fade-up">
                           
                           @php
                              $image = '';
                              if( @GetImageSize($comment->image) ) {
                                 $image = $comment->image;
                              } else {
                                 $image = asset('public/user.png');
                              }
                           @endphp
                           
                           <img 
                              class="d-flex mr-3 rounded-circle comment_image"
                              src="{{$image}}"
                              alt=""
                           >
                           <div class="media-body fs-14">
                              <h5 class="mt-0 fs-18 text-secondary">{{$comment->name}}</h5>
                              {{$comment->comment}}
                           </div>
                        </div>
                        @endif
                     @endforeach
                  @endif
               </div>
            </div>
            <div class="col-lg-4 position-relative col-12 py-lg-3">
               <div class="text-right position-relative" data-aos="fade-left">
                   <a class="btn btn-sm btn-green position-absolute bottom-20px right-20px border-0 rounded-pill write_blog fs-lg-14 fs-md-12 fs-12" href="javascript:;"
          @if( session()->has('student') )
            data-toggle="modal" data-target="#staticBackdrop_blog"
          @else 
            data-toggle="modal" data-target="#exampleModal1"
          @endif
         >
         <span><i class="fas fa-edit mr-1"></i>Write A Blog</span>
         </a></div>
               <div class="bg-white my-3 row d-block position-md-sticky top-lg-90px left-0 mx-auto right-0 z-index-3 pt-3 pb-2 shadow"  data-aos="fade-left">
                  <div class="col-md-12 col-12 px-3">
                     <form action="{{ action('Website\BlogsController@blogs') }}" method="GET" class="row mx-0" id="search_blog">
                        <div class="col-md-12 col-12 px-0 dp-0">
                           <input type="text" class="form-control shadow-none" placeholder="Search Blog" value="{{$_GET['search_query'] ?? ''}}" name="search_query" required=""
                           id="search">
                        </div>
                        <div class="col-auto px-0 position-absolute right-15px top-n1px bottom-0">
                           <button type="submit" class="btn shadow-none"><i class="far fa-search"></i></button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="row bg-white shadow rounded border mx-0 my-3"  data-aos="fade-left">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">Recent Posts</h4>
                  </div>
                  <div class="col-md-12 px-0 col-12">
                     <div class="col-md-12 col-12">
                        <ul class="blog_post_list pl-4">
                           @if( !empty($recent_blogs->toArray()) ) 
                              @foreach($recent_blogs as $recent_blog)

                                 @php
                                    $slug = str_replace(' ', '-', $recent_blog->title);
                                 @endphp

                                 <li class="border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between">
                                       <a 
                                       target="_blank"
                                       class="text-secondary fs-md-15 fs-13" href="{{ action('Website\BlogsController@blog', $slug) }}">{{$recent_blog->title}}</a>
                                    </div>
                                 </li>
                              @endforeach
                           @else
                              No Recent Posts found
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row d-block right-0 z-index-2 bg-white shadow rounded border mx-0 my-3 sidebarwidget"  data-aos="fade-left">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center mb-0 fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">Follow Us</h4>
                  </div>
                  <div class="col-md-12 px-1 text-center col-xs-12">
                     <ul class="blog_social_list d-flex justify-content-center list-unstyled pl-0 my-4">
                        <li class="mx-2">
                          <a class="d-flex align-items-center justify-content-center fs-md-18 fs-14 h-md-50px h-40px w-md-50px w-40px rounded text-white" target="_blank" href="https://twitter.com/coaching_select">
                            <i class="fab fa-twitter"></i>
                          </a>
                        </li>
                        <li class="mx-2">
                          <a class="d-flex align-items-center justify-content-center fs-md-18 fs-14 h-md-50px h-40px w-md-50px w-40px rounded text-white" target="_blank" href="https://www.facebook.com/CoachingSelect-108903201456076/">
                          <i class="fab fa-facebook"></i>
                          </a>
                        </li>
                        <li class="mx-2">
                          <a class="d-flex align-items-center justify-content-center fs-md-18 fs-14 h-md-50px h-40px w-md-50px w-40px rounded text-white" target="_blank" href="https://www.instagram.com/coachingselect/">
                          <i class="fab fa-instagram"></i>
                          </a>
                        </li>
                        <li class="mx-2">
                          <a class="d-flex align-items-center justify-content-center fs-md-18 fs-14 h-md-50px h-40px w-md-50px w-40px rounded text-white" target="_blank" href="https://www.youtube.com/channel/UC-oidnNJnMpKn9LdiTplnHQ" class="social_share linkedin">
                          <i class="fab fa-youtube"></i>
                          </a>
                        </li>
                        <li class="mx-2">
                          <a class="d-flex align-items-center justify-content-center fs-md-18 fs-14 h-md-50px h-40px w-md-50px w-40px rounded text-white" target="_blank" href="https://www.linkedin.com/company/coachingselect/">
                          <i class="fab fa-linkedin"></i>
                          </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="row d-block position-sticky right-0 z-index-2 bg-white shadow rounded border mx-0 my-3 sidebarwidget"  data-aos="fade-left">
                  <div class="col-md-12 blog_category post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-between position-relative z-index-2 text-white">Topics <span class="d-lg-none d-block"><i class="fas fa-plus"></i></span></h4>
                  </div>
                  <div class="col-md-12 col-xs-12 widget widget_text blog_category_part">
                     <ul class="blog_post_list pl-4">
                        @if( !empty($categories) ) 
                           @foreach($categories as $category => $total)
                              <li class="border-bottom pb-2 mb-2">
                                 <div class="d-flex justify-content-between">
                                    <a 
                                    class="text-secondary fs-md-15 fs-13"
                                    href="{{ action('Website\BlogsController@blogs') }}?category={{urlencode($category)}}">{{$category}}</a> <span class="text-primary"> {{$total}} </span>
                                 </div>
                              </li>
                           @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </section>
   <!-- Blog Single SECTION START  -->
</main>

@if($can_like)
<script>
   $(document).on('click', '.like', function() {
      $.ajax({
         url: '{{ action("Website\BlogsController@like") }}',
         method: 'POST',
         data: {
            _token: '{{csrf_token()}}',
            blog_id: '{{$blog->id}}'
         },
         success: function(data) {
            if(data != 0) {
               $('.like_count').text(data.total_likes);
               $('.like').addClass('disabled');
               $('.is_liked').text('Liked');
            } else {
               $('.like').addClass('disabled');
            }
         }
      });
   });
</script>
@endif

<script>
   function edit_comment(comment) {
      $('.comment_submit_btn').attr('type', 'submit');
      $('.comment_submit_btn').removeAttr('disabled');
      $('.comment_submit_btn').removeClass('disabled');
      $('textarea[name="comment"]').text(comment);
   }
</script>


   <!-- jquery autocomplete -->
   <script>
      $(function() {
         var availableTutorials = [];
         
         @if( !empty($blog_search_autocomplete) )
            @php
               $i = 0;
            @endphp

            @foreach($blog_search_autocomplete as $blog)

               availableTutorials[{{$i}}] = "<?php echo $blog; ?>";

               @php
                  $i += 1;
               @endphp
            @endforeach
         @endif

         $( "#search" ).autocomplete({
            source: availableTutorials,
            select: function (e, ui) {

               setTimeout(() => {
                     
                  $('#search_blog').submit();
               }, 300);
            },
         });
      });
   </script>

   <script>
      $(document).ready(
         function () {
            
            if( window.location.toString().includes("go_to_comment_box") ) {
               edit_comment("<?php echo $my_comment ?? ''; ?>");
            }
         }
      );
   </script>
    <script>
      $('.blog_category').on('click', function() { 
         var $this = $(this);
         if ($this.parent().hasClass('show')) {
            $this.parent().removeClass('show');
            $this.next().slideUp(160);
            $this.removeClass("arrow_down"); 
         } else {
            $this.parent().parent().find('.submenu_part').removeClass('show');
            $this.parent().parent().find('.submenu_part').slideUp(160);
            $this.parent().parent().find('li a').removeClass('arrow_down');
            $this.next().toggleClass('show');
            $this.next().slideToggle(160);
            $this.toggleClass("arrow_down");
         }
      });
   </script>

@include('website/layouts/footer')

@endsection('content')