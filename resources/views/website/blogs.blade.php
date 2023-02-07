@include('website/layouts/header')

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner position-relative">
      <div class="container">
         <div class="text-left aos-init" data-aos="fade-right">
            <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">CoachingSelect Blog</h2>
            <p class="text-white fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-15 fs-14 mb-lg-3 mb-md-2 mb-2">The Extensive platform to mentor about Education updates & its information</p>
         </div>
         <nav aria-label="breadcrumb text-left" data-aos="fade-right">
            <ol class="breadcrumb text-left mb-0 justify-content-flex-start">
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14"><a class="text-white font-weight-bold" href="{{ asset('/') }}">Home</a></li>
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14 active text-white" aria-current="page">Blog</li>
            </ol>
         </nav> 
         <a class="btn btn-sm btn-green position-absolute bottom-20px right-20px border-0 rounded-pill write_blog fs-lg-14 fs-md-12 fs-12" href="javascript:;"
          @if( session()->has('student') )
            data-toggle="modal" data-target="#staticBackdrop_blog"
          @else 
            data-toggle="modal" data-target="#exampleModal1"
          @endif
         >
         <span><i class="fas fa-edit mr-1"></i>Write A Blog</span>
         </a>
      </div>
   </section>
   <!-- inner banner section  -->
   <!-- blog-section SECTION START  -->
   <div class="container-fluid">
      <div class="container px-0">
         <div class="row">
            <div class="col-lg-8 py-3 order-lg-0 order-md-1 order-1">
               <div class="row align-items-start justify-content-start pt-lg-4 mb-4">
                  
                  @if( !empty($blogs->toArray()) )

                     @foreach($blogs as $category => $blogs) 
                     
                     <div class="col-12 mt-4" data-aos="fade-right">
                        <h2 class="font-weight-bold fs-xxl-30 fs-xl-28 fs-lg-24 fs-md-22 fs-20 border-bottom pb-2 mb-0">{{$category}}</h2>
                     </div>

                     @if( !empty($blogs) )
                     
                     @php
                        $count = 1;
                        $blog_wise_category_limit = 2;
                     @endphp

                     @foreach($blogs as $blog)
                        <div class="col-lg-6 col-md-6 mt-4" data-aos="fade-up">
                           <div class="blog_box shadow pb-0 rounded">
                           
                              @php
                                 $slug = str_replace(' ', '-', $blog->title);
                              @endphp

                              <a 
                              target="_blank"
                              href="{{ action('Website\BlogsController@blog', $slug) }}">
                                 <div class="basic-effect overflow-hidden position-relative">
                                    <div class="shadow">
                                       <img 

                                       src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/blogs/'.$blog->image) }}&width=1&height=1&zc=1" 
                                       data-src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/blogs/'.$blog->image) }}&width=300&height=210&zc=1" data-srcset="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/blogs/'.$blog->image) }}&width=300&height=210&zc=1"
                                       
                                       class="lazy img-fluid rounded-top blog_image_min_height" alt="">
                                    </div>
                                    <p class="position-absolute shadow bottom-10px mb-0 fs-13 left-10px d-flex align-items-center justify-content-center pl-2 h-25px rounded bg-secondary text-white z-index-2"> Like <span class="h-25px px-2 ml-2 rounded-right d-flex align-items-center border-white bg-white">{{$blog->likes}}</span>
                                    </p>
                                    <p class="position-absolute shadow mb-0 bottom-10px fs-13 right-10px d-flex align-items-center justify-content-center pl-2 h-25px rounded bg-secondary text-white z-index-2"> Views <span class="h-25px px-2 ml-2 rounded-right d-flex align-items-center border-white bg-white">{{$blog->views}}</span>
                                    </p>
                                 </div>
                                 <div class="blog-details position-relative text-left p-3">
                                    <p class="fs-md-15 fs-14 mb-2 font-weight-bold text-secondary text-capitalize title_min_height ellipsis-2">
                                       @php echo strip_tags($blog->title);
                                       @endphp  
                                    </p>
                                    <p class="text-secondary text-left fs-13 mb-3 ellipsis-3 description_min_height">
                                       @php echo strip_tags($blog->description);
                                       @endphp
                                    </p>
                                    <h4 class="fs-md-13 fs-13 mb-0 text-dark font-weight-normal mt-0 d-flex align-items-center justify-content-between"><span class="ellipsis-1 w-40">{{ $blog->written_by ?? 'CoachingSelect' }}</span> 
                        {{date('F d, Y', strtotime($blog->created_at) )}}</h4>
                                 </div>
                              </a>

                           </div>
                        </div>
               
                     @php

                        if($count == $blog_wise_category_limit 
                           and 
                        empty($_GET['category'])
                           and
                        count($blogs) >= 3
                        ) {

                     @endphp
                           
                        <div class="col-lg-12 col-md-12 mt-4 text-right">
                           <a class="d-inline-block btn btn-sm outline-0 border-0 btn-green fs-md-14 fs-12 px-3 bg-primary text-center rounded-pill shadow font-weight-bold py-md-2 py-1" href="{{url()->current()}}?category={{urlencode($category)}}"><span>View More</span></a>
                        </div>

                     @php
                           break;
                        }

                        $count += 1;
                     @endphp
                     
                     @endforeach
                     @endif

                     @endforeach
                  @else 
                     <div class="col-12 d-flex justify-content-center">
                        <h1 class="text-danger text-center">No Results Found</h1>
                     </div>
                  @endif

               </div>
            </div>
            <div class="col-lg-4 position-relative col-12 py-3">
               <div class="bg-white my-3 row d-block position-md-sticky top-lg-90px left-0 mx-auto right-0 z-index-3 pt-3 pb-2 shadow"  data-aos="fade-left">
                  <div class="col-md-12 col-12 px-3">
                     <form action="{{ action('Website\BlogsController@blogs') }}" method="GET" class="row mx-0" id="search_blog">
                        <div class="col-md-12 col-12 px-0 dp-0">
                           <input type="text" class="form-control shadow-none" placeholder="Search Blog" value="{{$_GET['search_query'] ?? ''}}"
                           id="search"
                           name="search_query" required="">
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
                           @if( !empty($recent_blogs) ) 
                              @foreach($recent_blogs as $recent_blog)
                                 <li class="border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between">
                                       
                                       @php
                                          $slug = str_replace(' ', '-', $recent_blog->title);
                                       @endphp

                                       <a 
                                       target="_blank"
                                       class="text-secondary fs-15" href="{{ action('Website\BlogsController@blog', $slug) }}">{{$recent_blog->title}}</a>
                                    </div>
                                 </li>
                              @endforeach
                           @endif
                        </ul>
                     </div>
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
                                    <a class="text-secondary fs-15" href="{{url()->current()}}?category={{urlencode($category)}}">{{$category}}</a> <span class="text-primary"> {{$total}} </span>
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
   </div>
   <!-- blog-section SECTION START  -->
</main>

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