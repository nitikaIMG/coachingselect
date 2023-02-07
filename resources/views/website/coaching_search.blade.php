@include('website/layouts/header')

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner_2 pt-5 pb-3">
      <div class="container position-relative z-index-2">
         <div class="row text-center aos-init">
            <h1 class="col-12 font-weight-bold text-white fs-xxl-32 fs-xl-28 fs-lg-24 fs-md-22 fs-18">
               <!-- Best Exam Coaching Institutes in City -->

               <?php  $city= '';$exam=''; $in=''; $text='';
               if( !empty($_GET['tab']) ) {

                  if( !empty($_GET['exam']) and !empty($_GET['city']) ){
                     $in= 'in';
                  }

                  if( !empty($_GET['city']) ){
                     $city = $_GET['city'];
                  }
                  if( !empty($_GET['exam']) ){
                     $exam = $_GET['exam'];
                  }

                  if($_GET['tab']=='classroom'){
                     $text= "Best $exam Coaching Institutes $in $city";
                  }elseif($_GET['tab']=='all'){
                     $text= "$exam Coaching Institutes $in $city";
                  }elseif($_GET['tab']=='online'){
                     $text= "Best $exam Online Coaching Institutes";
                  }elseif($_GET['tab']=='tutor'){
                     $text= "Best $exam Tutors $in $city";
                  }
               }

               ?>
               {{ $text }}
               </h1>
            <h2 class="col-12 text-white fs-15 mb-0">
               
               @if( empty( $_GET['exam'] ) )
                  Boost your preparation with Top Coachings
               @else
                  Boost your preparation with Top {{$_GET['exam'] ?? ''}} Coachings Institute
               @endif

               @php /* {{$_GET['exam'] ?? ''}} */ @endphp
               
               @if( !empty($_GET['city']) )
                  in {{ $_GET['city'] }}
               @endif
            </h2>
         </div>

         @php

            $tab = '';

            if( !empty($_GET['tab']) ) {
               $tab = $_GET['tab'];
            }
            
            $exam = '';

            if( !empty($_GET['exam']) ) {
               $exam = $_GET['exam'];
            }
            
            $city_name = '';

            if( !empty($_GET['city']) ) {
               $city_name = $_GET['city'];
            }
         @endphp

         <div class="banner_tabs position-relative rounded p-2">
            <ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist">
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-12
                     @if($tab == 'classroom')
                        active
                     @endif
                     @if( empty($_GET['tab']) )
                        active
                     @endif
                  " id="classroom-tab" data-toggle="tab" href="#classroom" role="tab" aria-controls="classroom" aria-selected="true">Classroom</a>
               </li>
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-12
                     @if($tab == 'online')
                        active
                     @endif
                  " id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">online</a>
               </li>
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-12
                     @if($tab == 'tutor')
                        active
                     @endif
                  " id="tutor-tab" data-toggle="tab" href="#tutor" role="tab" aria-controls="tutor" aria-selected="false">Tutor</a>
               </li>
               <li class="nav-item" role="presentation">
                  <a class="nav-link text-uppercase fs-lg-13 fs-md-11 fs-12
                     @if($tab == 'all')
                        active
                     @endif
                  " id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade 
                     @if($tab == 'classroom')
                        show active
                     @endif
                     
                     @if( empty($_GET['tab']) )
                        show active
                     @endif
                  " id="classroom" role="tabpanel" aria-labelledby="classroom-tab">
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                     <input type="hidden" name='tab' value='classroom'>
                     <div class="select_collages_inner d-flex align-items-center justify-content-center pt-2 rounded">
                        <div class="comman_select select_box_1">
                           <select name="exam"
                           onchange="this.form.submit()"
                           id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="" selected disabled>Exam </option>
                              
                              @if( !empty($searching['classroom']) )
                              @foreach($searching['classroom'] as $course)
                              <option value="{{$course->name}}"
                                 @if($exam == $course->name and ($tab == 'classroom' or empty($tab) ) )
                                    selected
                                 @endif
                              >{{$course->name}}</option>
                              @endforeach
                              @endif

                           </select>
                        </div>
                        <div class="comman_select select_box_2 mr-0">
                           <select name="city"
                           onchange="this.form.submit()"
                           id="city" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="" selected disabled>City </option>
                              
                              @if( !empty($searching['classroom']->toArray()) and !empty($cities_group_by_state) )
                              @foreach($cities_group_by_state as $state => $cities)
                              <optgroup label="{{$state}}">

                                 @if( !empty($cities) )
                                 @foreach($cities as $city)
                                 <option value="{{$city->name}}"
                                    @if($city_name == $city->name and ($tab == 'classroom' or empty($tab) ) )
                                       selected
                                    @endif
                                 >{{$city->name}}</option>
                                 @endforeach
                                 @endif

                              </optgroup>
                              @endforeach
                              @endif
                              
                           </select>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="tab-pane fade 
                     @if($tab == 'online')
                        show active
                     @endif" id="online" role="tabpanel" aria-labelledby="online-tab">
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                     <input type="hidden" name='tab' value='online'>
                     <div class="select_collages_inner d-flex align-items-center justify-content-center pt-2 rounded">
                        <div class="comman_select select_box_1">
                           <select name="exam"
                           onchange="this.form.submit()"
                           id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="1" selected disabled>Exam </option>
                              
                              @if( !empty($searching['online']) )
                              @foreach($searching['online'] as $course)
                              <option value="{{$course->name}}"
                                 @if($exam == $course->name and $tab == 'online')
                                    selected
                                 @endif
                              >{{$course->name}}</option>
                              @endforeach
                              @endif

                           </select>
                        </div>
                        <div class="comman_select select_box_2 mr-0">
                           <label class="bg-white text-primary m-0 d-flex align-items-center justify-content-start fs-lg-16 fs-md-13 fs-13 px-lg-4 px-md-3 px-3 h-lg-50px h-md-40px h-40px rounded">Online</label>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="tab-pane fade 
                     @if($tab == 'tutor')
                        show active
                     @endif" id="tutor" role="tabpanel" aria-labelledby="tutor-tab">
                     
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                     <input type="hidden" name='tab' value='tutor'>
                     <div class="select_collages_inner d-flex align-items-center justify-content-center pt-2 rounded">
                        <div class="comman_select select_box_1">
                           <select name="exam"
                           onchange="this.form.submit()"
                           id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="1" selected disabled>Exam </option>
                              
                              @if( !empty($searching['tutor']) )
                              @foreach($searching['tutor'] as $course)
                              <option value="{{$course->name}}"
                                 @if($exam == $course->name and $tab == 'tutor')
                                    selected
                                 @endif
                              >{{$course->name}}</option>
                              @endforeach
                              @endif

                           </select>
                        </div>
                        <div class="comman_select select_box_2 mr-0">
                           <select name="city"
                           onchange="this.form.submit()"
                           id="city" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="" selected disabled>City </option>
                              
                              @if( !empty($searching['tutor']->toArray()) and !empty($cities_group_by_state) )
                              @foreach($cities_group_by_state as $state => $cities)
                              <optgroup label="{{$state}}">

                                 @if( !empty($cities) )
                                 @foreach($cities as $city)
                                 <option value="{{$city->name}}"
                                    @if($city_name == $city->name and $tab == 'tutor')
                                       selected
                                    @endif
                                 >{{$city->name}}</option>
                                 @endforeach
                                 @endif

                              </optgroup>
                              @endforeach
                              @endif
                              
                           </select>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="tab-pane fade 
                     @if($tab == 'all')
                        show active
                     @endif" id="all" role="tabpanel" aria-labelledby="all-tab">
                     
                  <form action="{{ action('Website\CoachingSearchController@coaching_search') }}">

                     <input type="hidden" name='tab' value='all'>
                     <div class="select_collages_inner d-flex align-items-start justify-content-center pt-2 rounded">
                        <div class="comman_select select_box_1">
                           <select name="exam"
                           onchange="this.form.submit()"
                           id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="" selected disabled>Exam</option>
                              
                              @if( !empty($searching['all']) )
                              @foreach($searching['all'] as $course)
                              <option value="{{$course->name}}"
                                 @if($exam == $course->name and $tab == 'all')
                                    selected
                                 @endif
                              >{{$course->name}}</option>
                              @endforeach
                              @endif

                           </select>
                        </div>
                        <div class="comman_select select_box_2 mr-0">
                           <select name="city"
                           onchange="this.form.submit()"
                           id="city" title="" class="selectpicker show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="">
                              <option value="1" selected disabled>City </option>
                              
                              @if( !empty($searching['all']->toArray()) and !empty($cities_group_by_state) )
                              @foreach($cities_group_by_state as $state => $cities)
                              <optgroup label="{{$state}}">

                                 @if( !empty($cities) )
                                 @foreach($cities as $city)
                                 <option value="{{$city->name}}"
                                    @if($city_name == $city->name and $tab == 'all')
                                       selected
                                    @endif
                                 >{{$city->name}}</option>
                                 @endforeach
                                 @endif

                              </optgroup>
                              @endforeach
                              @endif

                           </select>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <p class="col-12 text-white fs-md-15 fs-14 text-center mt-md-3 mt-2">
            FOUND 
               <span class="font-weight-bold">
               @if( !empty($coachings->toArray()) )
                  {{ count($coachings) }}
               @else 
                  0
               @endif                              
               </span> 
               @if(count($coachings) <= 1)
               COACHING
               @else
               COACHINGS
               @endif
         </p>
      </div>
   </section>
   <!-- inner banner section  -->
   <section class="overflow-hidden py-0">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-11 col-lg-11 col-md-10 px-0">
               <div class="row align-items-stretch mx-lg-2 mx-md-auto mx-auto my-lg-5 my-md-4 my-4 coaching-slider owl-carousel">
                  
                  @if( !empty($online_coachings->toArray()) )
                     @foreach($online_coachings as $coaching)

                        @php
                           $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                        @endphp
                        

                        @if( !empty($coaching->course) )
                           <div class="col-lg-12 col-sm-12 px-md-2 px-3">
                              <div class="row align-items-stretch rounded mx-0 my-3">
                                 <a href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}" class="col-12 bg-secondary border border-dark rounded-top text-center py-3 px-3">
                                    <div class="row">
                                       @php
                                          $image = asset('public/coaching/'. $coaching->image);

                                          #if(! @GetImageSize($image) ) {
                                          #   $image = asset('public/logo.png');
                                          #}
                                       @endphp
                                       <div class="col">
                                          <img src="{{ $image }}" class="h-md-25px h-50px search-coaching-card-img" alt="">
                                       </div>
                                    </div>
                                    <div class="row mt-3">
                                       <div class="col font-weight-bold fs-lg-18 fs-md-16 fs-14">{{ substr($coaching->name,0,20)}}</div>
                                    </div>
                                    <div class="row mt-1">
                                       <div class="col fs-lg-17 fs-md-15 fs-15">Online Coaching</div>
                                    </div>
                                 </a>
                                 
                                 @if( !empty($coaching->course) )
                                    <div class="col-12 bg-white shadow rounded-bottom py-2">
                                       <div class="row mx-0 border-bottom py-1">
                                          <div class="col px-0 fs-14">
                                             {{$coaching->course->name ?? ''}}
                                          </div>
                                          <div class="col-auto px-0 text-gray font-weight-bold px-2">
                                             
                                             @php
                                                $discount_price = ($coaching->course->fee * $coaching->course->offer_percentage) / 100;
                                                $final_price = ($coaching->course->fee - $discount_price);
                                             @endphp
                                             ₹{{$final_price}}
                                             <br>
                                             <del>₹{{$coaching->course->fee ?? ''}}</del>                                       
                                          </div>
                                       </div>
                                       <div class="row mx-0 py-1">
                                          <a 
                                          href="{{ action('Website\CoachingController@courses', [$coaching->coaching_name_slug]) }}"
                                          class="col px-0 fs-14 text-primary">
                                          @if(($coaching->total_courses - 1) >= 1)
                                             +{{$coaching->total_courses - 1}} More Courses
                                          @else
                                             View all Courses
                                          @endif
                                          </a>
                                          <!-- <div class="col-auto px-0 text-gray font-weight-bold"><del>₹80,000</del></div> -->
                                       </div>
                                       <div class="row mx-0 py-2 justify-content-between align-items-center">
                                          <div class="col-md-5 col-4 mr-4 text-uppercase fs-14">
                                             <div class="row d-grid bg-success rounded-0 text-center">
                                                <div class="text-capitalize col-auto fs-md-12 fs-11 px-0">Discount</div>
                                                <div class="col-auto fs-md-12 fs-11 font-weight-bold text-success bg-white border border-success">{{$coaching->course->offer_percentage}}% off</div>
                                             </div>
                                          </div>
                                          <div class="col-auto px-0 text-gray font-weight-bold">
                                             <a 
                                             @if($coaching->course->is_paid == 'yes')
                                                href="{{ action('Website\CoachingController@courses', [$coaching->coaching_name_slug]) }}"
                                             @else 
                                                href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                             @endif
                                             class="text-capitalize btn btn-sm btn-primary font-weight-bold fs-lg-15 fs-md-13 fs-12">
                                             @if($coaching->course->is_paid == 'yes')
                                                Enroll Now
                                             @else 
                                                Know More
                                             @endif
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 @endif
                              </div>
                           </div>
                        @endif
                     @endforeach
                  @endif
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- blog-section SECTION START  -->
   <div class="container-fluid">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 position-relative col-12 py-md-3 px-md-3 p-0">
               <div class="bg-white my-3 row position-sticky top-90px right-0 z-index-3 pt-3 pb-2 shadow d-none">
                  <div class="col-md-12 col-12 px-3">
                     <form action="" method="GET" class="row mx-0">
                        <div class="col-md-12 col-12 px-0 dp-0">
                           <input type="text" class="form-control shadow-none" placeholder="Search Blog" value="" name="value" required="">
                        </div>
                        <div class="col-auto px-0 position-absolute right-15px top-n1px bottom-0">
                           <a href="javascipt:;" class="btn shadow-none"><i class="far fa-search"></i></a>
                        </div>
                     </form>
                  </div>
               </div>
                  <form id="filter_form" class="filter_form">
                  
                     <input type="hidden" name="tab" value="{{$tab}}">
                     <input type="hidden" name="exam" value="{{$exam}}">
                     <input type="hidden" name="city" value="{{$city_name}}">
                  <div class="row bg-white shadow right-0 rounded border mx-0 mb-3"> 
                     <div class="col-md-12 post_heading px-0 col-12">
                        <h4 class="font-weight-bold shadow bg-primary text-center fs-md-16 fs-14 px-md-3 px-2 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">
                        <div class="col text-left">FILTERS</div>
                              
                        <div class="col-auto fs-10 font-weight-light">FOUND 
                           <span class="font-weight-bold">
                           @if( !empty($coachings->toArray()) )
                              {{ count($coachings) }}
                           @else 
                              0
                           @endif                              
                           </span> 
                           @if(count($coachings) <= 1)
                           COACHING
                           @else
                           COACHINGS
                           @endif
                           </div>
                        </h4>
                     </div>
                        <div class="col-md-12 pt-3">
                           <div class="row mx-0">

                              @php                           
                                 $filters_sidebar = '';

                                 if( !empty($_GET['filters']) ) {
                                    $filters_sidebar = $_GET['filters'];
                                 }
                              @endphp
                              
                              @if( !empty($filters_sidebar['fees']) )
                                 @foreach($filters_sidebar['fees'] as $filter)
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$filter}}
                                    <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                                 @endforeach
                              @endif
                              
                              @if( !empty($filters_sidebar['distance']) )
                                 @foreach($filters_sidebar['distance'] as $filter)
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$filter}}
                                    <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                                 @endforeach
                              @endif

                              @if( !empty($filters_sidebar['offering']) )
                                 @foreach($filters_sidebar['offering'] as $filter)
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$filter}}
                                    <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                                 @endforeach
                              @endif

                              
                              @if( !empty($filters_sidebar['specialization']) )
                                 @foreach($filters_sidebar['specialization'] as $filter)
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$filter}}
                                    <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                                 @endforeach
                              @endif
                                                            
                              @if( !empty($exam) )
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$exam}}
                                    <span class="closebtn" data-selected-filter="{{$exam}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                              @endif
                              
                              @if( !empty($filters_sidebar['city']) )
                                 @foreach($filters_sidebar['city'] as $filter)
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$filter}}
                                    <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                                 @endforeach
                              @endif
                                                            
                              @if( !empty($city_name) )
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$city_name}}
                                    <span class="closebtn" data-selected-filter="{{$city_name}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                              @endif
                              
                              @if( !empty($filters_sidebar['ratings']) )
                                 @foreach($filters_sidebar['ratings'] as $filter)
                                 <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                                    {{$filter}}
                                    <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                                 </div>
                                 @endforeach
                              @endif
                              
                              @if( !empty($filters_sidebar) or !empty($exam) or !empty($city_name) )
                                 <a 
                                    href="{{ action('Website\CoachingSearchController@coaching_search') }}"
                                    class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center"
                                 >
                                    Clear All
                                 </a>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-12 px-0 col-12">

                           <!-- fees -->
                           <div class="row mx-0 pb-0 border-bottom">
                              <div class="col-12">
                                 <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="true" aria-controls="collapseExample3">
                                    Fees
                                 </a>
                              </div>
                              <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                                 <div class="collapse show" id="collapseExample3">
                                    <div class="card card-body border-0 p-0">
                                       @if( !empty($filters['fees']) )

                                          @php
                                             $i = 0;
                                          @endphp

                                          @foreach($filters['fees'] as $filter => $count)
                                          
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-fees{{$i}}" name="filters[fees][]" value="{{ $filter }}"
                                                   
                                                   @if( !empty($filters_sidebar['fees']) )
                                                      @if(in_array($filter, $filters_sidebar['fees']))
                                                         checked
                                                      @endif
                                                   @endif

                                                >
                                                <label class="custom-control-label d-flex justify-content-between" for="customCheck-filter-fees{{$i}}"><span class="fs-md-15 fs-13">
                                                {{ $filter }}
                                                </span> <span class="text-primary fs-md-15 fs-13">
                                                ({{ $count }})
                                                </span></label>
                                             </div>
                                             
                                             @php
                                                $i += 1;
                                             @endphp
                                             
                                          @endforeach
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- distance -->                        
                           @if( !empty($_GET['tab']) and $_GET['tab'] == 'online')
                           @else
                           <div class="row mx-0 pb-0 border-bottom">
                              <div class="col-12">
                                 <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample3dfhdhf" role="button" aria-expanded="true" aria-controls="collapseExample3dfhdhf">
                                    Distance
                                 </a>
                              </div>
                              <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                                 <div class="collapse show" id="collapseExample3dfhdhf">
                                    <div class="card card-body border-0 p-0">
                                       @if( !empty($filters['distance']) )

                                          @php
                                             $i = 0;
                                          @endphp

                                          @foreach($filters['distance'] as $filter => $count)
                                          
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-distance{{$i}}" name="filters[distance][]" value="{{ $filter }}"
                                                   
                                                   @if( !empty($filters_sidebar['distance']) )
                                                      @if(in_array($filter, $filters_sidebar['distance']))
                                                         checked
                                                      @endif
                                                   @endif

                                                >
                                                <label class="custom-control-label d-flex justify-content-between" for="customCheck-filter-distance{{$i}}"><span class="fs-md-15 fs-13">
                                                {{ $filter }}
                                                </span> <span class="text-primary fs-md-15 fs-13">
                                                ({{ $count }})
                                                </span></label>
                                             </div>
                                             
                                             @php
                                                $i += 1;
                                             @endphp
                                             
                                          @endforeach
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endif

                           <!-- coaching type -->
                           <div class="row mx-0 pb-0 border-bottom">
                              <div class="col-12">
                                 <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample1111" role="button" aria-expanded="true" aria-controls="collapseExample3">
                                    Coaching Type
                                 </a>
                              </div>
                              <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                                 <div class="collapse show" id="collapseExample1111">
                                    <div class="card card-body border-0 p-0">
                                       @if( !empty($filters['offering']) )
                                          @foreach($filters['offering'] as $index => $filter)
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-offering{{$index}}" name="filters[offering][]" value="{{ $index }}" 
                                                   
                                                   @if( !empty($filters_sidebar['offering']) )
                                                      @if(in_array($index, $filters_sidebar['offering']))
                                                         checked
                                                      @endif
                                                   @endif

                                                >
                                             <label class="custom-control-label d-flex justify-content-between" for="customCheck-filter-offering{{$index}}"><span class="fs-md-15 fs-13">
                                             {{ $index }}
                                             </span> <span class="text-primary fs-md-15 fs-13">
                                             ({{ $filter }})
                                             </span></label>
                                          </div>
                                          @endforeach
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- course speciality -->                           
                           <div class="row mx-0 pb-0 border-bottom">
                              <div class="col-12">
                                 <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="true" aria-controls="collapseExample3">
                                    Course Speciality
                                 </a>
                              </div>
                              <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                                 <div class="collapse show" id="collapseExample6">
                                    <div class="card card-body border-0 p-0">
                                       @if( !empty($filters['specialization']->toArray()) )
                                          @foreach($filters['specialization'] as $index => $filter)
                                          <div class="custom-control custom-radio">
                                             <input type="radio" class="custom-control-input" id="customCheck-filter-specialization{{$index}}" name="exam" value="{{ $filter->name }}" 
                                                   
                                                @if($exam == $filter->name)
                                                   checked
                                                @endif

                                                >
                                             <label class="custom-control-label d-flex justify-content-between" for="customCheck-filter-specialization{{$index}}"><span class="fs-md-15 fs-13">
                                             {{ $filter->name }}
                                             </span> <span class="text-primary fs-md-15 fs-13">
                                             ({{ $filter->total_coachings }})
                                             </span></label>
                                          </div>
                                          @endforeach
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           <!-- city -->
                           @if( !empty($_GET['tab']) and $_GET['tab'] == 'online')
                           @else
                           <div class="row mx-0 pb-0 border-bottom">
                              <div class="col-12">
                                 <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2">
                                    City
                                 </a>
                              </div>
                              <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                                 <div class="collapse show" id="collapseExample2">
                                    <div class="card card-body border-0 p-0">
                                       @if( !empty($filters['city']->toArray()) )
                                          @foreach($filters['city'] as $index => $filter)
                                          <div class="custom-control custom-radio">
                                             <input type="radio" class="custom-control-input" id="customCheck-filter{{$index}}" name="city" value="{{ $filter->name }}"
                                                @if($city_name == $filter->name)
                                                   checked
                                                @endif
                                             >
                                             <label class="custom-control-label d-flex justify-content-between" for="customCheck-filter{{$index}}"><span class="fs-md-15 fs-13">
                                             {{ $filter->name }}
                                             </span> <span class="text-primary fs-md-15 fs-13">
                                             ({{ $filter->total_coachings }})
                                             </span></label>
                                          </div>
                                          @endforeach
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endif
                           
                           <div class="row mx-0 pb-0 border-bottom d-none">
                              <div class="col-12">
                                 <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample3">
                                    Rating
                                 </a>
                              </div>
                              <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                                 <div class="collapse show" id="collapseExample4">
                                    <div class="card card-body border-0 p-0">
                                       @if( !empty($filters['ratings']) )

                                          @php
                                             $i = 0;
                                          @endphp

                                          @foreach($filters['ratings'] as $filter => $count)
                                          
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-ratings{{$i}}" name="filters[ratings][]" value="{{ $filter }}" 
                                                   
                                                   @if( !empty($filters_sidebar['ratings']) )
                                                      @if(in_array($filter, $filters_sidebar['ratings']))
                                                         checked
                                                      @endif
                                                   @endif

                                                >
                                                <label class="custom-control-label d-flex justify-content-between" for="customCheck-filter-ratings{{$i}}"><span class="fs-md-15 fs-13">
                                                {{ $filter }}
                                                </span> <span class="text-primary fs-md-15 fs-13">
                                                ({{ $count }})
                                                </span></label>
                                             </div>
                                             
                                             @php
                                                $i += 1;
                                             @endphp
                                             
                                          @endforeach
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                     
                  </div>
               </form>
            </div>
            <div class="col-lg-8 col-12 py-3">
               <div class="row mx-md-0" id="box_to_load">

                     <div class="col-12 px-0 mb-4">
                        @if( !empty( $header->advertisement('full') ) )
                           <a 
                              class="overflow-hidden d-block position-relative" 
                              href="{{
                                 $header->advertisement('full')->url
                              }}"
                              target="_blank"
                              onclick="clickCounter('<?php echo $header->advertisement('full')->id?>')"
                           >
                           <img 
                              class="img-fluid shadow rounded border" 
                              src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                              alt=""
                           >
                           </a>
                        @endif
                     </div>

                  @if( !empty($coachings->toArray()) )
                     
                     @php
                        $counter = 0;
                        $limit = 10;
                     @endphp

                     @foreach($coachings as $coaching)

                        @php
                           $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                        @endphp
                        <div class="
                           box_to_be_loaded
                           @if($counter >= $limit)
                              d-none
                           @endif
                        col-12 shadow bg-primary mb-4 pt-2">
                           <div class="row py-4 px-2 bg-white">
                              <div class="col-12">
                                 <div class="row align-items-center justify-content-md-start justify-content-center mx-0">
                                    <div class="col">
                                       <div class="row align-items-center">
                                           @php
                                                $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                                             @endphp
                                          <div class="col-md-auto text-md-center text-center">
                                             
                                             @php
                                                $image = asset('public/coaching/'. $coaching->image);

                                                #if(! @GetImageSize($image) ) {
                                                #   $image = asset('public/logo.png');
                                                #}
                                             @endphp
                                             <a 
                                             
                                                @if( 
                                                   !empty($_GET['city']) 
                                                   and 
                                                   !empty($coaching->branches_in_same_center)
                                                   and 
                                                   !empty($coaching->branches_in_same_center->toArray())
                                                )
                                                   href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug, $_GET['city'] ?? '']) }}"
                                                @else 
                                                   href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                                @endif
                                             >
                                             <img src="{{ $image }}" class="w-md-60px w-60" alt="">
                                              </a>
                                          </div>
                                          <div class="col-md-auto font-weight-bold fs-md-19 fs-16 my-md-0 my-2 px-0 text-md-center text-center">
                                          <a 

                                             @if( 
                                                !empty($_GET['city']) 
                                                and 
                                                !empty($coaching->branches_in_same_center)
                                                and 
                                                !empty($coaching->branches_in_same_center->toArray())
                                             )
                                                href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug, $_GET['city'] ?? '']) }}"
                                             @else 
                                                href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                             @endif
                                             
                                          >{{ $coaching->name ?? '' }}</a></div>

                                       </div>
                                    </div>
                                    
                                    <div class="col-md-auto">
                                    <div class="row justify-content-md-start justify-content-center my-md-0 my-3">
                                    @if(
                                       preg_match('/classroom/', $coaching->offering) 
                                    ) 
                                    <div class="col-auto px-md-0 px-2">
                                       <div class="row mx-0">
                                          <div class="col-12 
                                          @if(
                                             preg_match('/classroom/', $coaching->offering) 
                                          ) 
                                          bg-secondary 
                                          @endif
                                          px-2 py-0 rounded-pill fs-md-12 fs-11 text-center">
                                             @if(
                                                preg_match('/classroom/', $coaching->offering) 
                                             ) 
                                                Classroom
                                             @endif
                                          </div>
                                       </div>
                                    </div> 
                                    @endif

                                    @if(
                                       preg_match('/online/', $coaching->offering) 
                                    ) 
                                    <div class="col-auto px-md-2 px-2">
                                       <div class="row mx-0">
                                             <div class="col-12 
                                          @if(
                                             preg_match('/online/', $coaching->offering) 
                                          ) 
                                          bg-success
                                          @endif
                                          px-2 py-0 rounded-pill fs-md-12 fs-11 text-center">
                                             @if(
                                                preg_match('/online/', $coaching->offering) 
                                             ) 
                                                Online
                                             @endif
                                          </div>
                                       </div>
                                    </div> 
                                    @endif

                                    @if(
                                       preg_match('/tutor/', $coaching->offering) 
                                    )
                                    <div class="col-auto px-2 pr-0">
                                       <div class="row mx-0">
                                             <div class="col-12 
                                          @if(
                                             preg_match('/tutor/', $coaching->offering) 
                                          ) 
                                          bg-warning
                                          @endif
                                          px-2 py-0 rounded-pill fs-md-12 fs-11 text-center">
                                             @if(
                                                preg_match('/tutor/', $coaching->offering) 
                                             ) 
                                                Tutor
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                    @endif

                                    </div>
                                    </div>
                                 </div>
                                 <div class="row mx-0 mt-2">
                                    <div class="col-12 px-0 fs-md-14 fs-13 border-top pt-md-2 pt-3 text-justify text-md-left text-center">
                                       @php
                                          echo substr($coaching->description, 0, 250);
                                       @endphp
                                       @if(strlen($coaching->description) > 250)
                                       ...
                                       @endif
                                       <a 
                                          @if( 
                                             !empty($_GET['city']) 
                                             and 
                                             !empty($coaching->branches_in_same_center)
                                             and 
                                             !empty($coaching->branches_in_same_center->toArray())
                                          )
                                             href="{{ action('Website\CoachingController@reviews', [$coaching->coaching_name_slug, $_GET['city'] ?? '']) }}#review_sec"
                                          @else 
                                             href="{{ action('Website\CoachingController@reviews', [$coaching->coaching_name_slug]) }}#review_sec"
                                          @endif
                                       >Write a Review @<?php echo $coaching->name; ?></a></div>
                                 </div>
                                 <div class="row justify-content-md-start justify-content-center mx-0 my-2">
                                          
                                    @if( !empty($coaching->courses) )
                                       @foreach($coaching->courses as $course => $courses_detail)
                                       <div href="javascript:;" class="col-auto border fs-md-13 fs-11 font-weight-bold px-2 mr-1 border-secondary rounded">
                                          {{$course}}
                                       </div>
                                       @endforeach
                                    @endif

                                 </div>

                                 @if( 
                                    !empty($_GET['city']) 
                                    and 
                                    !empty($coaching->branches_in_same_center)
                                    and 
                                    !empty($coaching->branches_in_same_center->toArray())
                                 )

                                 @php
                                    $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                                 @endphp

                                 <div class="row align-items-center justify-content-md-start justify-content-center border-top mt-3 mx-0 pt-2">
                                    <div class="col-md-auto text-gray mb-md-0 mb-2">
                                       <i class="fad fa-school"></i>
                                       <span class="font-weight-bold">
                                          Centers in {{$_GET['city'] ?? ''}}
                                       </span>
                                    </div>
                                    <div class="col">
                                       @foreach($coaching->branches_in_same_center as $branch)
                                          <a 
                                          href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug, str_replace(' ', '-', $branch->name)]) }}"
                                          class="fs-13">{{$branch->name}}</a>  
                                          @if( $loop->last )
                                          @else
                                           |
                                          @endif
                                       @endforeach
                                    </div>
                                 </div>
                                 @endif

                                 @if( !empty($coaching->facility->toArray()) )
                                 <div class="row align-items-center justify-content-md-start justify-content-center border-top mt-3 mx-0 pt-md-2 pb-md-0 py-3">
                                    <div class="col-md-auto text-gray mb-md-0 mb-2 text-md-left text-center">
                                       <i class="fad fa-user-cog"></i>
                                       <span class="font-weight-bold">Facilities</span>
                                    </div>
                                    <div class="col text-md-left text-center">
                                       @foreach($coaching->facility as $facility)
                                          <a href="javascript:;" data-toggle="tooltip" title="{{ $facility->name }}" class="fs-16">
                                             @php echo $facility->image; @endphp
                                          </a> 
                                          @if( $loop->last )
                                          @else
                                           |
                                          @endif
                                       @endforeach
                                    </div>
                                 </div>
                                 @endif

                                 <div class="row mt-md-3 mx-0 pt-3 border-top">
                                    @if( !empty($coaching->offer_percentage) )
                                    <div class="col-md-auto text-md-left text-center mb-mb-0 mb-3">
                                       <div class="row d-md-grid d-inline-flex bg-success rounded-0 text-center">
                                          <div class="text-capitalize col-auto fs-12">Discount</div>
                                          <div class="col-auto fs-12 font-weight-bold text-success bg-white border border-success">{{$coaching->offer_percentage}}% off</div>
                                       </div>
                                    </div>
                                    @endif
                                    <div class="col">
                                       <div class="row justify-content-md-end justify-content-center">
                                          <div class="col-auto px-md-3 px-2">
                                             <a href="javascript:;" class="btn btn-sm btn-secondary d-none">Compare</a>
                                             <form 
                                                action="{{ action('Website\CoachingCompareController@compare') }}"
                                                id="compare"   
                                             >
                                                <input 
                                                   type="hidden" 
                                                   name="coachings[]"
                                                   value="{{$coaching->name ?? ''}}"
                                                   
                                                   class="shadow coachings" placeholder="Find Coaching">
                                                <!-- <input type="submit"> -->
                                                <a 
                                                onclick="this.parentElement.submit()"
                                                href="javascript:;" class="text-capitalize btn btn-sm btn-secondary"><i class="fas fa-balance-scale-right mr-2 d-none"></i>Compare </a>
                                             </form>
                                          </div>
                                          <div class="col-auto px-md-3 px-2">
                                             @php
                                                $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                                             @endphp
                                             <a 
                                                @if( 
                                                   !empty($_GET['city']) 
                                                   and 
                                                   !empty($coaching->branches_in_same_center)
                                                   and 
                                                   !empty($coaching->branches_in_same_center->toArray())
                                                )
                                                   href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug, $_GET['city'] ?? '']) }}"
                                                @else 
                                                   href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                                @endif
                                                class="text-capitalize btn btn-sm btn-outline-primary">Know More</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        @php
                           $counter += 1;
                        @endphp
                     @endforeach
                  @else                  
                     <div class="col-12 d-flex justify-content-center my-3">
                        <h3 class="text-danger text-center">No Results Found</h3>
                     </div>
                  @endif

                  @if( 
                     !empty($coachings->toArray())
                     and
                     count($coachings) >= 11
                  )
                     <div id="load_more_loader" class="col-12 text-center py-2">
                        <img src="{{ asset('public/website') }}/assets/img/loader.gif" class="w-100px" alt="">
                     </div>
                  @endif

                  <div class="col-12 px-0 mb-4">
                     @if( !empty( $header->advertisement('full') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('full')->url
                           }}"
                           target="_blank"
                           onclick="clickCounter('<?php echo $header->advertisement('full')->id?>')"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                           alt=""
                        >
                          
                        </a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- blog-section SECTION START  -->
</main>

<script>
   $(document).on(
      'click',
      '.checkboxes, input[type="radio"]',
      function() {
         $('#filter_form').submit();
      }
   );
</script>

<script>
   $(document).on(
      'click',
      '.closebtn',
      function() {

         var selected_filter = $(this).data('selected-filter');

         $('input[value="' + selected_filter + '"]').prop('checked', false);
         $('input[value="' + selected_filter + '"]').val('');
         $('select[value="' + selected_filter + '"]').prop('selected', false);
         $('select[value="' + selected_filter + '"]').val('');

         $('#filter_form').submit();
      }
   );
</script>

<script>
   $(window).scroll(function(){

      if($(window).scrollTop() + $(window).height() 
      > $("#box_to_load").height()-50)
      {

         if( 
            $("#box_to_load")
            .find('.box_to_be_loaded.d-none')
            .slice(0,10)
            .length == 0
         ) {
            $('#load_more_loader').remove();
         } else {

            $("#box_to_load")
               .find('.box_to_be_loaded.d-none')
               .slice(0,10)
               .removeClass('d-none', 800);
         }
      }
   });
</script>
@include('website/layouts/footer')