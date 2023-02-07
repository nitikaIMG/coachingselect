@include('website/layouts/header')

<style type="text/css">
   :root{
      --home-banner-before: url(<?php echo asset('/public/s_img_new.php')?>?image=<?php echo asset('public/website/assets/img/young-smiling-student-woman-white-background.png') ?>&width=557&height=1360&zc=3)
   }
   .min_height {
      min-height: 89px;
   } 
   .scr_des { 
      overflow: auto;
      max-height: 150px;
      padding-right: 5px;
   }

   .home_banner {
      min-height: 520px;
      padding: 46px 0 30px;
   }
   .desktop-text{
      text-align:left !important;
   }

   @media only screen and (min-width:320px) and (max-width:767px){
   .desktop-text{
         text-align:center !important;
      }
   }
    @media only screen and (min-width:768px) and (max-width:1024px){
    .desktop-text .fs-14 {
      font-size: 11px !important;
      }
      .home_banner {
         min-height: 413px;
         padding: 46px 0 30px;
      }
   }

</style>
<main id="main">
   <!-- Home Banner Section Start  -->
   <section id="home_banner" class="home_banner position-relative"> 
      <div class="container text-md-left text-center">
         <div class="banner_texts">
            <h5 class="text-primary fs-xll-20 fs-xl-20 fs-lg-18 fs-md-16 fs-12 mb-mb-3 mb-2" >You only have to know one thing</h5>
            <h1 class="text-dark fs-xll-40 fs-xl-40 fs-lg-32 fs-md-26 fs-21 font-weight-bold mb-md-3 mb-2" >
               Compare & Select the best Coaching for you
            </h1>
            <p class="text-dark fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-15 fs-12 mb-md-3 mb-2" >For free. For everyone</p>
         </div>
         <div class="banner_tabs position-relative rounded ml-0" >
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-11 active" id="classroom-tab" data-toggle="tab" href="#classroom" role="tab" aria-controls="classroom" aria-selected="true">Classroom</a>
               </li>
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-11" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">Online</a>
               </li>
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-11" id="tutor-tab" data-toggle="tab" href="#tutor" role="tab" aria-controls="tutor" aria-selected="false">Tutor</a>
               </li>
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-11" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="classroom" role="tabpanel" aria-labelledby="classroom-tab">
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                  <input type="hidden" name='tab' value='classroom'>

                  <div class="select_collages_inner d-flex align-items-center justify-content-center pt-lg-4 pt-md-3 pt-3 rounded">
                     <div class="comman_select select_box_1">
                        <select 
                        required name="exam" id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>Exam </option>

                           @if( !empty($searching['classroom']) )
                           @foreach($searching['classroom'] as $course)
                           <option value="{{$course->name}}">{{$course->name}}</option>
                           @endforeach
                           @endif

                        </select>
                     </div>
                 
                     <div class="comman_select select_box_2">
                        <select 
                        required name="city" id="city" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>City </option>

                           @if( !empty($searching['classroom']->toArray()) and !empty($cities_group_by_state) )
                           @foreach($cities_group_by_state as $state => $cities)
                           <optgroup label="{{$state}}">

                              @if( !empty($cities) )
                              @foreach($cities as $city)
                              <option value="{{$city->name}}">{{$city->name}}</option>
                              @endforeach
                              @endif

                           </optgroup>
                           @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="search_btn_outer">
                        <button type="submit" class="search_btn border-0 btn btn-sm btn-green border-0 rounded">
                           <span class="d-flex align-items-center justify-content-center"><i class="fal fa-search mr-2"></i> Search</span></button>
                     </div>
                  </div>
                  </form>
               </div>
               <div class="tab-pane fade" id="online" role="tabpanel" aria-labelledby="online-tab">
               
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                  <input type="hidden" name='tab' value='online'>

                  <div class="select_collages_inner d-flex align-items-center justify-content-center pt-lg-4 pt-md-3 pt-3 rounded">
                     <div class="comman_select select_box_1">
                        <select 
                        required name="exam" id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>Exam </option>

                           @if( !empty($searching['online']) )
                           @foreach($searching['online'] as $course)
                           <option value="{{$course->name}}">{{$course->name}}</option>
                           @endforeach
                           @endif

                        </select>
                     </div>
                     <div class="comman_select select_box_2">
                        <label class="bg-white text-primary m-0 d-flex align-items-center justify-content-start fs-lg-16 fs-md-13 fs-13 px-lg-4 px-md-3 px-3 h-lg-50px h-md-40px h-40px rounded">Online</label>
                     </div>
                     <div class="search_btn_outer">
                        <button type="submit" class="search_btn border-0 btn btn-sm btn-green border-0 rounded">
                           <span class="d-flex align-items-center justify-content-center"><i class="fal fa-search mr-2"></i> Search</span></button>
                     </div>
                  </div>
                  </form>
               </div>
               <div class="tab-pane fade" id="tutor" role="tabpanel" aria-labelledby="tutor-tab">
               
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                  <input type="hidden" name='tab' value='tutor'>
                  <div class="select_collages_inner d-flex align-items-center justify-content-center pt-lg-4 pt-md-3 pt-3 rounded">
                     <div class="comman_select select_box_1">
                        <select 
                        required name="exam" id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>Exam </option>

                           @if( !empty($searching['tutor']) )
                           @foreach($searching['tutor'] as $course)
                           <option value="{{$course->name}}">{{$course->name}}</option>
                           @endforeach
                           @endif

                        </select>
                     </div>
                     <div class="comman_select select_box_2">
                        <select 
                        required name="city" id="city" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>City </option>

                           @if( !empty($searching['tutor']->toArray()) and !empty($cities_group_by_state) )
                           @foreach($cities_group_by_state as $state => $cities)
                           <optgroup label="{{$state}}">

                              @if( !empty($cities) )
                              @foreach($cities as $city)
                              <option value="{{$city->name}}">{{$city->name}}</option>
                              @endforeach
                              @endif

                           </optgroup>
                           @endforeach
                           @endif

                        </select>
                     </div>
                     <div class="search_btn_outer">
                        <button type="submit" class="search_btn border-0 btn btn-sm btn-green border-0 rounded">
                           <span class="d-flex align-items-center justify-content-center"><i class="fal fa-search mr-2"></i> Search</span>
                        </button>
                     </div>
                  </div>
                  </form>
               </div>
               <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
               
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                  <input type="hidden" name='tab' value='all'>

                  <div class="select_collages_inner d-flex align-items-center justify-content-center pt-lg-4 pt-md-3 pt-3 rounded">
                     <div class="comman_select select_box_1">
                        <select 
                        required name="exam" id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>Exam </option>

                           @if( !empty($searching['all']) )
                           @foreach($searching['all'] as $course)
                           <option value="{{$course->name}}">{{$course->name}}</option>
                           @endforeach
                           @endif

                        </select>
                     </div>
                     <div class="comman_select select_box_2">
                        <select 
                        required name="city" id="city" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="">
                           <option value="" selected disabled>City </option>

                           @if( !empty($searching['all']->toArray()) and !empty($cities_group_by_state) )
                           @foreach($cities_group_by_state as $state => $cities)
                           <optgroup label="{{$state}}">

                              @if( !empty($cities) )
                              @foreach($cities as $city)
                              <option value="{{$city->name}}">{{$city->name}}</option>
                              @endforeach
                              @endif

                           </optgroup>
                           @endforeach
                           @endif

                        </select>
                     </div>
                     <div class="search_btn_outer">
                        <button type="submit" class="search_btn border-0 btn btn-sm btn-green border-0 rounded">
                           <span class="d-flex align-items-center justify-content-center"><i class="fal fa-search mr-2"></i> Search</span></button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="tranding_today bg-all-section position-relative p-md-3 pt-1 pb-2 mt-lg-5 mt-md-4 mt-4 text-left">
            <h2 class="font-weight-bold shadow bg-primary top-lg-10px top-md-7px top-5px left-n10px mb-0 text-center fs-lg-16 fs-md-14 fs-12 px-3 py-md-2 py-1 d-md-inline-flex align-items-center justify-content-start z-index-2 text-white mb-md-0 mb-2">Trending Today<i class="ml-1 fas fa-hand-point-right d-md-inline-block d-none"></i> <i class="d-md-none d-inline-block ml-1 fas fa-hand-point-down"></i></h2> 
            <div class="tranding_slider owl-carousel">
               @if( !empty($trending_today->toArray()) )
               @foreach($trending_today as $trending_today_single)
               <div>
                  <a class="text-white" 

                  @php
                     $trending_today_single_slug = str_replace(' ', '-', $trending_today_single->title);
                  @endphp
                  
                  @if($trending_today_single->type == 'url')
                     href="{{$trending_today_single->url}}"
                  @else 
                     href="{{ action('Website\TrendingTodayController@news', $trending_today_single_slug) }}"
                  @endif

                  target="_blank"
                  >
                     <strong class="ellipsis-1 px-md-0 px-2 pb-md-0 pb-1 text-md-left text-center">
                        {{$trending_today_single->title}}
                     </strong>
                  </a>
               </div>
               @endforeach
               @else
                  Not available
               @endif
            </div>

         </div>

         <div class="row">
            <div class="col-xxl-2 col-6 col-xl-2 col-lg-2 col-md-2 text-center mb-3 desktop-text">
               <a href="{{ asset('news-and-articles') }}" class="text-dark pt-3 text-underline font-weight-bold fs-14 position-relative z-index-0 d-inline-block border-bottom border-dark" target="_blank">All Articles ></a>

            </div>
             <div class="col-xxl-2 col-6 col-xl-2 col-lg-2 col-md-2 text-center mb-3 desktop-text">
               <a href="{{ action('Website\ExamsController@exams') }}" class="text-dark pt-3 text-underline font-weight-bold fs-14 
                position-relative z-index-0 d-inline-block border-bottom border-dark" 
               target="_blank">
                  Exam Info >
               </a>

            </div>
            
             <div class="col-xxl-2 col-6 col-xl-2 col-lg-2 col-md-2 text-center mb-3 desktop-text">
               <a href="{{ action('Website\WebinarController@all_webinar') }}" class="text-dark pt-3 text-underline font-weight-bold fs-14 
                position-relative z-index-0 d-inline-block border-bottom border-dark" 
               target="_blank">
                  Free Webinars >
               </a>
               
            </div>
            
             <div class="col-xxl-2 col-6 col-xl-2 col-lg-2 col-md-2 text-center mb-3 desktop-text">
               <a href="{{ action('Website\FreePreparationToolController@question_papers_stream_wise') }}" class="text-dark pt-3 text-underline font-weight-bold fs-14 
                position-relative z-index-0 d-inline-block border-bottom border-dark" 
               target="_blank">
                  Study Material >
               </a>

            </div>
         </div>
         

         
         

      </div>

   </section>
   <!-- Home Banner Section End  -->
   <!-- top_featured_collages section start  -->
   <section id="top_featured_collages" class="top_featured_collages bg-all-section">
      <div class="container">
         <div class="group-title-index">
            <h4 class="top-title text-white text-transform-none">
               Choose from among the best Institutions in the Country   
            </h4>
            <h2 class="center-title text-white text-transform-none">Top Featured Colleges In India</h2>
         </div>
         <div class="row">
            @if( !empty($colleges->toArray()) )
            
            @php
               $i = 0;

               $fade = [
                  'fade-right',
                  'fade-down',
                  'fade-left',
                  'fade-right',
                  'fade-up',
                  'fade-left',
               ];
            @endphp
            
            @foreach($colleges as $college)
            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 text-center mb-4 d-flex align-items-stretch" 
            >

               <div class="top_featured px-md-2 w-100 h-100">
                  <div class="top_featured_inner row mx-0">
                     <div class="col-6 d-flex align-items-stretch px-0 position-relative">
                        @php
                        
                        /*
                        $image = !empty($college->images) ?
                        explode('{$}', $college->images)[0] :
                        '';

                        if( empty($image) ) {
                           $image = ( ( !empty( explode('{$}', $college->images)[0] ) ) ?
                                    ( explode('{$}', $college->images)[0] ) :
                                    ( !empty( explode('{$}', $college->images)[1] ) ) ) ?
                                    (explode('{$}', $college->images)[1]) : ('');
                        }
                        
                        if( !empty($image) ) {
                        $image = 'public/college_image/'.$image;

                        #if( @GetImageSize( asset($image) ) ) {

                        #} else {
                        #$image = 'public/logo.png';
                        #}

                        } else {
                        $image = 'public/logo.png';
                        }
                        */

                        if( !empty($college->background_image) ) {
                        $image = 'public/college/'.$college->background_image;

                        #if( @GetImageSize( asset($image) ) ) {

                        #} else {
                        #$image = 'public/logo.png';
                        #}

                        } else {
                           $image = 'public/logo.png';
                        }
                        @endphp
                        <div class="top_featured_bg position-relative rounded-left">
                        <img class="lazy w-100 h-100" src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset($image) }}&width=1&height=1&zc=1" data-src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset($image) }}&width=167&height=241&zc=1" data-srcset="https://www.coachingselect.com/public/s_img_new.php?image={{ asset($image) }}&width=167&height=241&zc=1" />
                           <div class="fs-11 text-white bg-all-section py-1 px-2 m-1 rounded d-inline-flex align-items-center position-absolute  left-0 top-0px">
                              <a href="javascript:;"><i class="far fa-heart fs-12"></i></a>
                              <p class="mb-0 text-white ml-2 text-left"><span class="d-block fs-10">RATING</span>
                                 @if(!empty($college->reviews_ratings))
                                 <strong>{{ $college->reviews_ratings }}</strong> / 5
                                 @else
                                 N/A
                                 @endif
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-6 d-flex align-items-stretch bg-white rounded-right pt-3 px-0 text-right flex-wrap">
                        <div class="featured_collages_inner text-left px-2 pb-md-2 mb-2">
                           @php
                              $college->college_name_slug = str_replace(' ', '-', $college->college_name)
                           @endphp
                           <a 
                              href="{{ action('Website\CollegeController@college', $college->college_name_slug) }}"
                           >
                              
                              @php                                 
                                 if( !empty($college->image) ) {
                                    $image = 'public/college/'.$college->image;

                                    #@if( @GetImageSize( asset($image) ) ) {

                                    #} else {
                                    #$image = 'public/logo.png';
                                    #}

                                 } else {
                                    $image = 'public/logo.png';
                                 }

                                 if( !empty($college->image) ) {
                                    $image = 'public/college/'.$college->image;

                                 #if( @GetImageSize( asset($image) ) ) {

                                 #} else {
                                 #   $image = 'public/logo.png';
                                 #}

                                 } else {
                                    $image = 'public/logo.png';
                                 }

                                 $image = asset($image);
                                 
                              @endphp

                                 <img data-src="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=45&height=45&zc=1" data-srcset="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=45&height=45&zc=1" src="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=1&height=1&zc=1" class="img-fluid h-45px w-45px border rounded p-1 lazy" alt="{{ $image }}">


                              <h2 class="fs-lg-15 fs-md-14 fs-13 font-weight-bold text-dark mt-2 mb-0 ellipsis-2">
                                 {{$college->college_name}}
                              </h2>
                           </a>
                           <span class="text-dark fs-12 d-block">
                              {{$college->city}}, {{$college->state}}
                           </span>
                        </div>
                        <div class="featured_collages_inner bg-primary rounded-right text-left py-2 px-2 pb-2 w-100 mt-md-2">

                        @php
                           $getcourse = json_decode($college->courses_details, true);
                           $getcoursefee = json_decode($college->course_fee, true);
                        @endphp

                           @if( 
                              !empty(
                                 $college->course_name
                              ) 
                           )
                              <a class="row justify-content-between align-items-center" href="javascript:;">
                                 <div class="col fs-12 text-white">
                                    {{$college->course_name}}
                                 </div>
                              </a>
                           @endif

                           @if( 
                              !empty(
                              $getcoursefee
                              [$college->course_stream_id]
                              [$college->landing_page_highlight_course]
                              ) 
                           )
                           <span class="fs-11 text-white"><strong class="text-all-section fs-13">
                           ₹{{$getcoursefee
                              [$college->course_stream_id]
                              [$college->landing_page_highlight_course]}}</strong> TOTAL FEES</span>
                           @endif

                           <a class="d-block text-white text-underline fs-12" 
                              href="{{ action('Website\CollegeController@college', $college->college_name_slug) }}"
                           >
                              VIEW ALL COURSES & FEES
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            @php
               $i += 1;
            @endphp

            @endforeach
            @else
               <div class="col-12 d-flex justify-content-center">
                  <h4 class="text-white text-center">No Colleges Found</h4>
               </div>
            @endif
         </div>
      </div>
   </section>
   
   <!-- top_featured_collages end  -->
   <!-- coaching course section start  -->
   <section id="coaching-course" class="coaching-course bg-light">
      <div class="container">
         <div class="group-title-index">
            <h4 class="h5">Get amazing discounts on Top Coaching centers all over India</h4>
            <h2 class="center-title text-capitalize">Buy Coaching Courses</h2>
         </div>
         <div class="row">
            @php
               $is_found_any_course = false;
            @endphp
            
            @php
               $i = 0;

               $fade = [
                  'fade-right',
                  'fade-down',
                  'fade-left',
                  'fade-right',
                  'fade-up',
                  'fade-left',
               ];
            @endphp

            @if( !empty($online_coachings->toArray()) )
               @foreach($online_coachings as $coaching)
               
                  @php
                     $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                  @endphp
                        
                  @if( !empty($coaching->course) )

                  @php
                     $is_found_any_course = true;
                  @endphp

                  <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 text-center mb-4" >
                     <div class="courses_box shadow rounded bg-white px-0 h-100 align-items-stretch d-flex w-100">
                        <div class="row w-100 mx-0">
                           <div class="col-6 px-0 position-relative" >
                              <div class="text-center h-100 w-100 d-flex justify-content-center align-items-center">
                                 <div class="w-100 px-lg-2 px-3">
                                 <a href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                 >
                                    @php
                                       $image = asset('public/coaching/'. $coaching->image);

                                       #if(! @GetImageSize($image) ) {
                                       #   $image = asset('public/logo.png');
                                       #}
                                    @endphp
                                    
                                    <img class="img-fluid w-70px lazy" data-src="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=70&height=70&zc=1" data-srcset="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=70&height=70&zc=1" 
                                    src="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=1&height=1&zc=1" alt="{{ $image }}">
                                    <h2 class="text-primary fs-lg-14 fs-md-13 fs-14 font-weight-bold text-uppercase mt-3">{{$coaching->name}}</h2>
                                    <span class="text-dark px-1 fs-lg-15 fs-md-14 fs-14">
                                       @if($coaching->offering!='tutor')
                                       {{ join(' & ', array_map('ucwords', explode( ',', $coaching->offering) ) ) }} Coaching
                                       @else
                                       {{ ucwords($coaching->offering)}}
                                       @endif
                                    </span>
                                 </a>
                                 </div>
                              </div>
                              <div class="off_box fs-11 text-white position-absolute left-6px top-0px">
                                 @if($coaching->ratings!=0)
                                  {{$coaching->ratings ?? ''}} <i class="ml-1 fs-10 fas fa-star"></i>
                                  @else
                                  N/A
                                  @endif
                              </div>
                           </div>
                           @if( !empty($coaching->course) )
                           <div class="col-6 bg-all-section rounded-right p-3 text-right h-100">
                              <div class="hover_div my-0 text-center w-80 ml-auto font-weight-bold fs-13 text-white rounded">
                                 @if($coaching->course->offer_percentage!=0)
                                 {{ round($coaching->course->offer_percentage) }}% Discount
                                 @else
                                 No Offer
                                 @endif
                              </div>
                              <div class="d-flex justify-content-between align-items-center w-100 pt-3 min_height">
                                 <span class="text-left fs-12 mr-2 text-white"> {{$coaching->course->name ?? ''}}</span>
                                 <span class="text-right text-white fs-md-13 fs-12">
                                    @php
                                       $discount_price = ($coaching->course->fee * $coaching->course->offer_percentage) / 100;
                                       $final_price = ($coaching->course->fee - $discount_price);
                                    @endphp

                                    @if(
                                       ($coaching->is_paid_member == 'yes')
                                    )

                                       ₹{{$final_price}} <br/>
                                       <del>₹{{$coaching->course->fee ?? ''}}</del>

                                    @elseif(
                                       ! ($coaching->is_paid_member == 'yes')
                                       and
                                       session()->has('student')
                                    )

                                       ₹{{$final_price}} <br/>
                                       <del>₹{{$coaching->course->fee ?? ''}}</del>
                                    @endif
                                    
                                 </span>
                              </div>
                              <div class="d-flex justify-content-between align-items-center w-100 py-2">
                                 <span class="text-white fs-13">
                                    <a 
                                       href="{{ action('Website\CoachingController@courses', [$coaching->coaching_name_slug]) }}"
                                       class="col px-0 fs-14 text-white">
                                       @if(($coaching->total_courses - 1) >= 1)
                                          +{{$coaching->total_courses - 1}} More Courses
                                       @else
                                          View all courses
                                       @endif
                                    </a>
                                 </span>
                              </div>
                              <div class="text-right w-100">
                                 <a @if(empty(session()->has('student') ))
                                    data-toggle="modal" data-target="#exampleModal1"

                                    onclick='set_callback("{{ action('Website\CoachingController@courses', [$coaching->coaching_name_slug]) }}")'                                   
                                  @elseif($coaching->course->is_paid == 'yes')
                                    href="{{ action('Website\CoachingController@courses', [$coaching->coaching_name_slug]) }}"
                                 @else
                                    href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                  @endif
                                 class="btn btn-sm btn-green border-0 rounded "><span>
                                 @if($coaching->course->is_paid == 'yes')
                                    Enroll Now
                                 @else 
                                    Know More
                                 @endif
                                 </span></a>
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>                       

                  @php
                     $i += 1;
                  @endphp

                  @endif
               @endforeach
            @endif

            @if(! $is_found_any_course) 
               <div class="col-12 d-flex justify-content-center">
                  <h4 class="text-danger text-center">No Courses Found</h4>
               </div>
            @endif
         </div>
      </div>
   </section>
    
   <!-- coaching course section end  -->
   <!-- about section start  -->
   <section id="about_coaching_select" class="about_coaching_select bg-all-section">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6 order-lg-0 order-md-1 order-1 mt-lg-0 mt-md-4 mt-4">
               <div class="about_details">
                  <h2 class="font-weight-bold text-secondary mb-3">About CoachingSelect</h2>
                  <p class="fs-14 text-secondary text-justify">CoachingSelect has been founded by alumni of IIT-IIMs  with a vision to make an agile platform where each student will get the best education for their career endeavour while educator provides supreme options for them to achieve success in their life.</p>
                  <p class="fs-14 text-secondary text-justify">Over years of extensive market research and several man-hours involved, we bring an innovative online help <u>portal to select the most excellent coaching for exam preparation</u> and an extensive <u>search engine</u> for the students, parents, and education industry players who are seeking information on the coaching sector in India. It is a one-stop site to guide about everything students need to prepare & cater for any examination to supplement success. </p>
                  <p class="fs-14 text-secondary text-justify">You can now browse and get information from a wide pool of:</p>
                  <ul class="d-flex align-items-center flex-wrap mb-0 text-secondary">
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Coachings</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Tutors and Personal Tuitions</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Institutes & Colleges</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Universities</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Executive Education</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Competitive Examinations (NEET, JEE, etc.)</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Government Examinations (IBPS, CLAT, etc.)</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Exams for Abroad Education (IELTS, GMAT, etc.)</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Expert Counselling (Careers after Class X/XII & Graduation etc.)</p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Question & Answer (Coaching, Tuition, etc.) </p>
                     </li>
                     <li class="w-md-50 w-100 pr-md-4">
                        <p class="fs-13 mb-1">Question Bank (JEE, CAT, etc.) </p>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="about_img hover_fade_img">
                  <img class="img-fluid lazy" src="<?php echo asset('/public/s_img_new.php')?>?image=<?php echo asset('public/website/assets/img/about_img.jpg') ?>&width=1&height=1&zc=1" data-src="<?php echo asset('/public/s_img_new.php')?>?image=<?php echo asset('public/website/assets/img/about_img.jpg') ?>&width=540&height=480&zc=1" data-srcset="<?php echo asset('/public/s_img_new.php')?>?image=<?php echo asset('public/website/assets/img/about_img.jpg') ?>&width=540&height=480&zc=1" alt="about_img.jpg">
               </div>
            </div>
         </div>
      </div>
   </section>
  
   <!-- about section end  -->
   <!-- blog news section start -->
   <section id="blog-section" class="blog-section overflow-hidden">
      <div class="container">
         <div class="group-title-index">
            <h4 class="top-title text-transform-none">Stay up-to-date through knowledgeable articles with CoachingSelect</h4>
            <h2 class="center-title text-capitalize">Blog & News Post</h2>
         </div>
         <div class="row align-items-start justify-content-start">

            @if( !empty($blogs) )

            @php
            $i = 1;
            @endphp

            @foreach($blogs as $blog)

            @php
            $fade_class = '';

            if($i == 1) {
            $fade_class = "fade-right";
            } else if($i == 2) {
            $fade_class = "fade-up";
            } else {
            $fade_class = "fade-left";
            }
            @endphp

            <div class="col-lg-4 col-md-6 mb-lg-0 mb-4 d-flex align-items-stretch">
               <div class="blog_box shadow pb-0 rounded w-100">
                  @php
                  $slug = str_replace(' ', '-', $blog->title);
                  @endphp

                  <a 
                     target="_blank"
                     href="{{ action('Website\BlogsController@blog', $slug) }}">
                     <div class="basic-effect overflow-hidden position-relative">
                        <div class="shadow">
                           <img src="<?php echo asset('/public/s_img_new.php')?>?image={{ asset('public/blogs/'.$blog->image) }}&width=1&height=1&zc=1" data-src="<?php echo asset('/public/s_img_new.php')?>?image={{ asset('public/blogs/'.$blog->image) }}&width=350&height=210&zc=1" data-srcset="<?php echo asset('/public/s_img_new.php')?>?image={{ asset('public/blogs/'.$blog->image) }}&width=350&height=210&zc=1" class="img-fluid rounded-top blog_image_min_height lazy" alt="{{ $blog->image }}">
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
                           {{date('F d, Y', strtotime($blog->created_at) )}}
                        </h4>
                     </div>
                  </a>
               </div>
            </div>

            @php
            $i += 1;
            @endphp

            @endforeach
            @endif

         </div>
      </div>
   </section>
   <!-- blog news section end -->
   <!-- choose your future section start  -->
   <section id="choose-future" class="choose-future bg-light">
      <div class="container">
         <div class="group-title-index">
            <h4 class="top-title text-secondary text-transform-none">Your Career begins here..</h4>
            <h2 class="center-title text-secondary text-transform-none">Choose your Future</h2>
         </div>
         <nav>
            <div class="nav nav-tabs shadow" id="nav-tab" role="tablist">
               <a class="nav-link text-uppercase active" id="nav-coachings-tab" data-toggle="tab" href="#nav-coachings" role="tab" aria-controls="nav-coachings" aria-selected="true">coachings</a>
               <a class="nav-link text-uppercase" id="nav-colleges-tab" data-toggle="tab" href="#nav-colleges" role="tab" aria-controls="nav-colleges" aria-selected="false">colleges</a>
               <a class="nav-link text-uppercase" id="nav-exams-tab" data-toggle="tab" href="#nav-exams" role="tab" aria-controls="nav-exams" aria-selected="false">Exam</a>
            </div>
         </nav>
         <div class="tab-content mt-lg-5 mt-md-4 mt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-coachings" role="tabpanel" aria-labelledby="nav-coachings-tab">
               <div class="row choose_future_outter justify-content-start">

                  @if( !empty($stream_wise_coachings) )
                  @foreach($stream_wise_coachings as $stream)
                  <div class="col text-center rounded p-3 d-inline-block mb-md-3 mb-2">
                     <a class="future_icon_box d-block h-100 w-100 text-center" 
                     href="{{ action('Website\CoachingSearchController@coaching_search') }}?course={{$stream->name}}&tab=all"
                        
                     >
                        <span class="fs-lg-40 fs-md-32 fs-26 text-secondary">
                           <?php echo $stream->image; ?>
                        </span>
                        <h4 class="text-secondary fs-md-16 fs-14 mb-md-2 mb-1">{{$stream->name}}</h4>
                        <p class="text-secondary fs-lg-14 fs-md-13 fs-13 mb-0">{{$stream->total_coachings}} coachings</p>
                     </a>
                  </div>
                  @endforeach
                  @endif

               </div>
            </div>
            <div class="tab-pane fade" id="nav-colleges" role="tabpanel" aria-labelledby="nav-colleges-tab">
               <div class="row choose_future_outter justify-content-start">

                  @if( !empty($stream_wise_colleges) )
                  @foreach($stream_wise_colleges as $stream)
                     @if( !empty($stream['image']) )
                        <div class="col text-center rounded p-3 d-inline-block mb-3">
                           <a class="future_icon_box d-block h-100 w-100 text-center" 
                           href="{{ action('Website\CollegeController@colleges') }}?filters[streams][]={{$stream['name']}}"
                                 
                           >
                              <span class="fs-lg-40 fs-md-32 fs-26 text-secondary">
                                 <?php echo $stream['image']; ?>
                              </span>
                              <h4 class="text-secondary fs-md-16 fs-14 mb-md-2 mb-1">{{$stream['name']}}</h4>
                              <p class="text-secondary fs-14 mb-0">{{$stream['count']}} colleges</p>
                           </a>
                        </div>
                     @endif
                  @endforeach
                  @endif

               </div>
            </div>
            <div class="tab-pane fade" id="nav-exams" role="tabpanel" aria-labelledby="nav-exams-tab">
               <div class="row choose_future_outter justify-content-start">

                  @if( !empty($stream_wise_exams) )
                  @foreach($stream_wise_exams as $stream)
                  <div class="col text-center rounded p-3 d-inline-block mb-3">
                     <a class="future_icon_box d-block h-100 w-100 text-center" 
                        href="{{ action('Website\ExamsController@stream_wise_exams', $stream->name) }}"                                 
                     >
                        <span class="fs-lg-40 fs-md-32 fs-26 text-secondary">
                           <?php echo $stream->image; ?>
                        </span>
                        <h4 class="text-secondary fs-md-16 fs-14 mb-md-2 mb-1">{{$stream->name}}</h4>
                        <p class="text-secondary fs-14 mb-0">{{$stream->total_exams}} exams</p>
                     </a>
                  </div>
                  @endforeach
                  @endif

               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- choose your future section end  -->
   <section id="courses_btn" class="courses_btn">
      <div class="container">
         <div class="row justify-content-center">

            @if( !empty($exams_data) )
            @foreach($exams_data as $exams)

            <a class="btn text-uppercase btn-sm btn-outline-primary rounded-pill btn-sm btn-sm  mx-md-2 mx-1 mb-lg-4 mb-md-3 mb-2" href="{{ action('Website\ExamsController@exam', str_replace(' ', '-', $exams->title)) }}">
               {{$exams->title}}
            </a>
            @endforeach
            @endif

         </div>
      </div>
   </section>
   <!-- facts about us section start -->
   <section id="progress-bars" class="section progress-bars">
      <div class="container">
         <div class="progress-bars-content">
            <div class="progress-bar-wrapper">
               <h2 class="title-2">Some Important facts about us</h2>
               <div class="row">
                  <div class="col-md-3 col-6">
                     <div class="progress-bar-number">
                        <div data-from="0" data-toggle="counter-up" data-to="45" data-speed="1000" class="num">{{$total['coaching']}}</div>
                        <p class="name-inner">coachings</p>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="progress-bar-number">
                        <div data-from="0" data-toggle="counter-up" data-to="56" data-speed="1000" class="num">{{$total['college']}}</div>
                        <p class="name-inner">colleges</p>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="progress-bar-number">
                        <div data-from="0" data-toggle="counter-up" data-to="165" data-speed="1000" class="num">{{$total['q_and_a'] ?? 0 }}</div>
                        <p class="name-inner">Q&A</p>
                     </div>
                  </div>
                  <div class="col-md-3 col-6">
                     <div class="progress-bar-number">
                        <div data-from="0" data-toggle="counter-up" data-to="15" data-speed="1000" class="num">{{$total['exams']}}</div>
                        <p class="name-inner">exams</p>
                     </div>
                  </div>
                  <div class="col-12">
                     <a href="#main" class="btn btn-sm btn-green border-0 rounded-pill ml-4 scrollTo"><span>Start Learning Now!</span></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- facts about us section end -->
   <!-- student parents review  -->
   <section id="parents_review" class="parents_review">
      <div class="container">
         <div class="group-title-index">
            <!-- <h4 class="top-title">CoachingSelect</h4> -->
            <h2 class="center-title text-transform-none">Student / Parents Reviews</h2>
         </div>
         <div class="parents_review_slider owl-carousel">

            @if( !empty($testimonials) )
            @foreach($testimonials as $testimonial)
            <div class="text-justify review_box">
               <div class="review_box_inner position-relative bg-light rounded shadow-sm p-4 border">
                  <div class="d-flex align-items-center mb-3"><em class="bg-all-section font-style-normal fs-lg-13 fs-md-11 fs-10 d-flex align-items-center justify-content-center h-lg-30px h-md-25px w-lg-30px w-md-25px h-20px w-20px rounded">{{$testimonial->stars}}</em>
                     <span class="pl-1 d-inline-block">
                        <!-- stars -->
                        @for($i = 1; $i <= (int) $testimonial->stars; $i++)
                           <i class="fas fa-star mx-1"></i>
                        @endfor

                        @if($testimonial->stars == 5)
                        @else
                        @php
                        $remaining_stars = (5 - $testimonial->stars)
                        @endphp
                        <?php
                        $half_star = ($remaining_stars - (int) $remaining_stars);
                        ?>
                        @if($half_star > 0)
                           @for($i = $half_star; $i <= $half_star; $i +=$half_star) 
                              <i class="fas fa-star-half mx-1"></i>
                           @endfor
                        @endif

                        @endif
                     </span>
                  </div>
                  <div class="scr_des text-justify" >@php echo $testimonial->description; @endphp</div>
               </div>
               <div class="prents_details pl-3 d-flex align-items-center">
                  <img  class="lazy" 
                  src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/testimonials/'. $testimonial->image) }}&width=1&height=1&zc=1" data-src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/testimonials/'. $testimonial->image) }}&width=80&height=80&zc=1" data-srcset="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/testimonials/'. $testimonial->image) }}&width=80&height=80&zc=1"
                  alt="{{ $testimonial->image }}">
                  <div class="pl-3">
                     <strong class="ellipsis-1 fs-lg-18 fs-15 fs-14">{{$testimonial->name}}</strong>
                     <span class="fs-lg-15 fs-md-14 fs-13">{{$testimonial->city}} , {{$testimonial->state}}</span>
                  </div>
               </div>
            </div>
            @endforeach
            @endif

         </div>
      </div>
   </section>
   <!-- student parents review  -->
   <!-- AD  -->
   <section id="parents_review" class="parents_review add_box">
      <div class="container">
         <div class="row align-items-center">
            <div class="AD_slider col align-items-center owl-carousel">

               @if( !empty($coaching_logo_link) )
               @php
                  $iii = 0;
                  $limit = 9;
               @endphp

               @foreach($coaching_logo_link as $logo_link)
               @php
                  $coaching_name_slug = str_replace(' ', '-', $logo_link->name);
               @endphp
               
               @if($iii > $limit)
                  @continue
               @endif
               <div class="col-12">
                  <a href="{{ action('Website\CoachingController@overview', [$coaching_name_slug]) }}">
                  <img 
                  src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/coaching/' . $logo_link->image) }}&width=1&height=1&zc=1" data-src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/coaching/' . $logo_link->image) }}&width=50&height=50&zc=1" data-srcset="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/coaching/' . $logo_link->image) }}&width=50&height=50&zc=1" class="lazy" alt="{{ $logo_link->image }}">
                  </a>
               </div>
               @php
                  $iii += 1;
               @endphp
               @endforeach
               @endif

            </div>
             @if(count($coaching_logo_link)>10)
            @endif
         </div>
      </div>
   </section>
   <!-- AD  -->
</main>

<script>
   function set_callback(url) {
      $('#login')
         .find('input[name="callback"]')
         .val(url);
   }
</script>

@include('website/layouts/footer')