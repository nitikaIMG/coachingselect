@include('website/layouts/header')

<style>

   .img-responsive{
      height: 100%;
   }
   .fixed_container {
      max-height: 200px;
      overflow: hidden;
   }

   .choose_future_outter .cities_box:hover {
      background-color: #222f3f !important;
   }
   .min_hieght_dec{
      min-height: 191px !important;
   }
   .ads_hieght{
      height: 135px;
   }
   .min_height_fa{
      min-height: 70px !important;
   }
   .mar_top_pro{
      margin-top: 10px;
   }
   .text_justity{
      text-align: justify !important;
   }

   .bac_color{
      background: white !important;
   }
   .btn-dds:hover{
      color:#000000  !important;
   }
   .about_sect{
      max-height: 180px;
      overflow: auto;
   }
   .link-a{
      cursor: pointer;
   }
   @media (max-width: 1023px) {
      .custom_dropdown2 .bootstrap-select {
         width: 100% !important;
      }
   }
   @media (max-width: 767px) {
      .min_hieght_dec {
         min-height: auto !important;
      }
      .future_icon_box span {
          width: 100%;
      }
   }

   p {
      white-space: pre-line !important;
   }
</style>

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner offer_single_banner">
      <div class="container position-relative z-index-2">
         <div class="row align-items-start">
            <div class="col-lg-auto text-center mb-md-0 mb-3">
               <span 
                  class="h-md-100px h-75px p-1 d-flex rounded-pill align-items-center justify-content-center border shadow bg-white position-relative w-md-100px w-75px mx-auto"> 
               @php
                  $image = asset('public/coaching/'. $coaching->image);

                  #if(! @GetImageSize($image) ) {
                  #   $image = asset('public/logo.png');
                  #}
               @endphp

               <img class="w-100 h-100 rounded-pill" 
               src="{{ $image }}" alt="{{ $coaching->image }}">

               @if($coaching->is_verified == 'yes')
                  <a class="d-flex bg-success position-absolute align-items-center top-n2px right-0 justify-content-center fs-md-14 fs-12 text-white rounded-pill w-md-30px w-24px h-md-30px h-24px shadow" href="javascripts:;"><i class="fas fa-shield-check"></i>
                  </a>
               @endif
               </span>
            </div>
            <div class="text-left col">
               <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">{{ $coaching->name ?? '' }}</h2>
               <p class="fs-md-16 fs-14 text-white mb-md-2 mb-1">
               
               @switch($coaching->offering) 
                  @case('online')
                     Online Coaching
                     @break

                  @case('classroom')
                     Classroom Coaching
                     @break

                  @case('tutor')
                     Tutor
                     @break
                  
                  @default
                     {{ ucwords( str_replace(',', ' & ', $coaching->offering) ) }} Coaching
                  @break                      
                       
               @endswitch

               </p>
               <p class="fs-md-16 fs-14 text-white mb-md-2 mb-1">{{$coaching->tagline ?? ''}}</p>
               <div class="row mt-3 mb-md-0 mb-3 justify-content-md-start justify-content-center">
                  <div class="col-auto px-lg-3 px-md-2 px-2 pr-md-0 mb-md-0 mb-2">
                     @if( session()->has('student'))
                        @if(empty($coaching->is_this_my_favorite))

                        <form action='{{ action("Website\CoachingController@add_to_favorite", $coaching->id) }}' method="post" id="add_to_favorite{{$coaching->id}}">
                           @csrf
                       
                        <button type ="submit" class="favroute_btn btn btn-sm border-0 rounded-pill text-white
                           " id="add_to_favorite{{$coaching->id}}"><i class="fas fa-heart mr-2  text-white" id="add_to_favorite_icon"></i>
                           <span id="add_to_fav_status">
                              @if($coaching->is_this_my_favorite)
                                 Add to Favourites
                              @else 
                                 Add to Favourites

                              @endif 
                           </span>                       
                        </button>
                         </form>
                        @else
                        <a href="javascript:;" class="favroute_btn btn btn-sm border-0 rounded-pill text-dark active bac_color"><i class="fas fa-heart mr-2 text-dark bac_color" id="add_to_favorite_icon"></i>
                           <span id="add_to_fav_status">
                              Add to Favourites
                           </span>                       
                        </a>
                        @endif
                     @else
                     <a href="javascript:;" class="favroute_btn btn btn-sm border-0 rounded-pill text-white" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-heart mr-2 text-white" id="add_to_favorite_icon"></i>Add to Favourites</a>
                     @endif
                  </div>
                  <div class="col-auto px-lg-3 px-md-2 px-2">
                     <form 
                        action="{{ action('Website\CoachingCompareController@compare') }}"
                        id="compare"   
                     >
                        <input 
                           type="hidden" 
                           name="coachings[]"
                           value="{{$coaching->name ?? ''}}"
                           
                           class="shadow coachings" placeholder="Find Coaching">
                         <a 
                        onclick="this.parentElement.submit()"
                        href="javascript:;" class="compare_btn btn btn-sm btn-green border-0 rounded btn-dds"><span><i class="fas fa-balance-scale-right mr-2"></i>Add to Compare </span></a>
                     </form>
                           
                  </div>
               </div>
            </div>
            <div class="col text-right my-md-0 my-4">
               <div class="row align-items-stretch">
                  <div class="col-12"> 
                     <form action='{{ action("Website\CoachingController@request_callback", $coaching->id) }}' method="post" id="request_callback{{$coaching->id}}">
                        @csrf
                       @if( session()->has('student'))
                     <button 
                        type="submit" 
                        @if( session()->has('student') and !$coaching->has_requested_for_callback)
                          
                        @elseif(! session()->has('student') )
                           data-toggle="modal" data-target="#exampleModal1"
                        @endif
                        class="btn btn-sm btn-outline-white text-white
                           
                        @if($coaching->has_requested_for_callback)
                           active text-dark
                        @endif                                          

                        "
                        >
                        <i 
                           class="fas 
                              @if($coaching->has_requested_for_callback)
                                 text-dark
                              @else 
                                 text-white
                              @endif  
                           fa-phone-volume text-primary mr-2"></i>
                        @if($coaching->has_requested_for_callback)
                           Requested Call back
                        @else 
                           Request a Call back
                        @endif 
                     </button>
                     @else
                     <a  data-toggle="modal" data-target="#exampleModal1" class="btn btn-sm btn-outline-white text-white" ><i 
                           class="fas  text-white
                           fa-phone-volume text-primary mr-2"></i>Request a Call back</a>
                     @endif
                      </form>
                  </div>
                  <div class="col-12 d-flex align-items-center justify-content-md-end justify-content-center my-lg-4 my-md-2 my-2">
                     <div class="set-size">
                        <div class="pie-wrapper progress-45 style-2">
                           <span class="label d-flex align-items-center flex-wrap justifi-content-center">
                              @if($coaching->ratings!=0)
                              {{ $coaching->ratings ?? ''}} <strong class="d-block w-100"><i class="ml-1 fs-10 fas fa-star"></i></strong></span>
                              @else
                              <p class="mar_top_pro">N/A</p>
                              @endif
                              <strong class="d-block w-100 ml-1"></strong></span>
                           <div class="pie">
                              <div class="left-side half-circle"></div>
                              <div class="right-side half-circle"></div>
                           </div>
                           <div class="shadow"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <a href="#review_sec" class="btn scroll-to btn-sm btn-outline-secondary btn-secondary text-white"><i class="fas fa-pencil-alt mr-2"></i>Leave A Review </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- inner banner section  -->
   <!-- get offer section  -->
   <section id="get_offer" class="get_offer overflow-hidden">
      <div class="container">
         <div class="row">
            <div class="col-md-12 mx-0">
               <div class="row shadow mx-0 px-lg-3 px-mx-2 px-2 py-lg-3 py-mx-2 py-2 bg-white rounded">
                  <div class="d-flex tab_offer align-items-center col border-0 justify-content-start">
                     <a class="active-tab text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right rounded-left border-0">Overview</a>
                     <a href="{{ action('Website\CoachingController@courses', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Courses</a>
                     <a href="{{ action('Website\CoachingController@team', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Team</a>
                     <a href="{{ action('Website\CoachingController@results', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Results</a>
                     <a href="{{ action('Website\CoachingController@gallery', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Gallery</a>
                     <a href="{{ action('Website\CoachingController@reviews', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0  rounded-right">Reviews</a>
                  </div>
               </div>
               <div class="overview_section mt-lg-5 mt-md-4 mt-2"> 
                  @if(!empty($centers->toArray()) and $centers->count() >= 2)
                  <div class="row mx-0 align-items-start">
                     <div class="col-12">
                        <div class="col-md-12 px-0 mt-3">
                           <div class="text-left mb-4">
                           </div>
                        </div>
                        <div class="col-md-12 px-0 mt-3">
                           <div class="row choose_future_outter justify-content-center">

                              @if(!empty($centers) )
                                 @foreach($centers as $center)
                                 
                                    @if( 
                                       !empty($coaching->branch) 
                                       and 
                                       $coaching->branch->coaching_centers_id == $center->id
                                    )
                                    @else
                                       <div class="col-auto text-center rounded d-inline-block mb-md-3 mb-2 px-md-3 px-1 aos-init aos-animate rounded">
                                          <a class="cities_box shadow d-block h-100 p-md-3 py-2 px-3 w-100 text-center d-flex justify-content-center align-items-center rounded-pill bg-primary" href="{{action('Website\CoachingController@overview', [$coaching->coaching_name_slug, str_replace('.', '-', str_replace(' ', '-', $center->name) ) ])}}">
                                             <h4 class="text-white fs-md-14 fs-13 m-0 text-uppercase">{{ $center->name }}</h4>
                                          </a>
                                       </div>
                                    @endif
                                 @endforeach
                              @else
                                 Not Available
                              @endif

                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  <div class="row align-items-start mt-md-4 mt-2">

                     <div class="col-lg-8">
                        
                        @if(!empty($coaching->description))
                        <div class="text-left mb-4">
                        </div>
                         <h2 class="font-weight-bold text-primary fs-lg-28 fs-md-22 fs-18">About {{ $coaching->name ?? '' }}</h2>
                         
                           <div class="col-12 mt-lg-4 mt-md-3 mt-2  px-0">
                              
                              <div 
                                 class="p_text fs-lg-15 fs-md-14 fs-13 fixed_container text-justify about_sect pr-md-3">
                                 <p 
                                 class="fs-14 text-gray mb-3 text-justify">
                                    @php
                                       
                                       echo ($coaching->description ?? '')
                                    @endphp
                                 </p>
                              </div>
                              
                           </div>
                        @endif
                        <div class="row mt-3">
                           <div class="col-md-12">
                              <div class="row mt-4">

                                 @php
                                    $total_box = 0;
                                 @endphp
                              
                                 @if( !empty($coaching->est_yr) )
                                 
                                 @php
                                    $total_box += 1;
                                 @endphp

                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-calculator"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Established Year:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold">{{ substr($coaching->est_yr,0,4) ?? '' }}</span>
                                    </div>
                                 </div>
                                 @endif
                                 
                                 @if( !empty($coaching->number_of_branches) )
                                 
                                 @php
                                    $total_box += 1;
                                 @endphp

                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-building"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Branches:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold">{{ substr($coaching->number_of_branches,0,5) ?? 0 }}</span>
                                    </div>
                                 </div>
                                 @endif
                                 
                                 @if( !empty($coaching->faculty_student_ratio) )
                                 
                                 @php
                                    $total_box += 1;
                                 @endphp

                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-user-friends"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Faculty Student Ratio:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold">{{ $coaching->faculty_student_ratio ?? '' }}</span>
                                    </div>
                                 </div>
                                 @endif
                                 
                                 @if( !empty($coaching->scholarship) )
                                 
                                 @php
                                    $total_box += 1;
                                 @endphp

                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-graduation-cap"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Scholarships:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold ml-3">
                                       {{ 
                                          ( ($coaching->scholarship_type == 'rs') ? ('Upto ₹') : ('') ).
                                             $coaching->scholarship . ' ' .
                                          ( ($coaching->scholarship_type == 'per') ? ( '%' ) : '')
                                       }}
                                       </span>
                                    </div>
                                 </div>
                                 @endif
                                 
                                 @if( !empty($coaching->super_specialty) )
                                 
                                 @php
                                    $total_box += 1;
                                 @endphp

                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-user-friends"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Super Speciality:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold ml-3">{{ substr($coaching->super_specialty,0,25) ?? '' }}</span>
                                    </div>
                                 </div>
                                 @endif
                                 
                                 @if( !empty($coaching->batch_size) )
                                 
                                 @php
                                    $total_box += 1;
                                 @endphp

                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-users-class"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Batch Size:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold">{{ substr($coaching->batch_size,0,5) ?? 0 }}</span>
                                    </div>
                                 </div>
                                 @endif
                                 
                                 @if( !empty($coaching->avg_fees) and $total_box < 6)
                                 <div class="d-flex align-items-stretch col-md-4 mb-4 ps-md-0 pl-5">
                                    <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box w-100">
                                       <div class="position-absolute rounded-10 bg-secondary left-md-n30px left-n20px top-22px h-lg-60px h-md-55px h-50px fs-lg-28 fs-md-24 fs-20 text-white w-lg-55px w-md-50px w-40px d-flex align-items-center justify-content-center"><i class="fas fa-tachometer-alt-average"></i></div>
                                       <div class="fs-lg-13 fs-md-12 fs-12 text-gray font-weight-bold px-4 mb-2">
                                          Average Fees:
                                       </div>
                                       <span class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold">{{ substr($coaching->avg_fees,0,6) ?? 0 }}</span>
                                    </div>
                                 </div>
                                 @endif

                              </div>
                           </div>
                        </div>
                     </div> 
                     @if( !empty($coaching->branch) )
                        <div class="col-lg-4 position-md-sticky top-lg-100px">
                           <div class="row bg-white shadow rounded border mx-0 mt-4 mb-3">
                              <div class="col-md-12 post_heading px-0 col-12">
                                 @if( session()->has('student') or session()->has('enterprise'))
                                 <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">Contact Information</h4>
                                 @else
                                 <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">Login to get Contact Information</h4>
                                 @endif
                              </div>
                              <div class="col-md-12 px-0 col-12">
                                 <div class="row justify-content-center"> 
                                    @if( !empty($coaching->branch->address) )
                                    <div class="col-11 my-md-2 my-2 d-flex align-items-stretch justify-content-center">
                                       <div class="exam_single_box shadow rounded row w-100">
                                          <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                             <i class="far fa-map-marked"></i>
                                          </div>
                                          <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right text-justify">
                                             @if(session()->has('student'))
                                             <a class="fs-md-13 fs-12 text-white" target="_blank" href="http://maps.google.co.in/maps?q={{ $coaching->branch->address ?? '' }}">
                                                {{ $coaching->branch->address ?? '' }}
                                             </a>
                                             @else
                                             <a class="fs-md-13 fs-12 text-white" href="#">
                                                {{ substr($coaching->branch->address ?? '', 0, 5) }}XXX
                                             </a>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                          
                                    @if( !empty($coaching->branch->address) )
                                       <div class="col-11 my-md-2 my-2 d-flex align-items-stretch justify-content-center">
                                          <div class="exam_single_box shadow rounded row w-100">
                                             <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                                <i class="far fa-map-pin"></i>
                                             </div>
                                             <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                                <a class="fs-13 text-white" href="javascript:;" id="km_will_show_here"
                                                onclick="showlocation()"
                                                >Allow Location</a>
                                             </div>
                                          </div>
                                       </div>
                                    @endif
                                    
                                    @if( !empty($coaching->branch->website) )
                                       <div class="col-11 my-md-2 my-2 d-flex align-items-stretch justify-content-center">
                                          <div class="exam_single_box shadow rounded row w-100">
                                             <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                             <i class="fas fa-tv"></i>
                                          </div>
                                          <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                             @if(session()->has('student'))
                                             <a class="fs-13 text-white white-space-nowrap overflow-hidden" target="_blank" href="{{ $coaching->branch->website ?? '' }}">
                                                {{ substr($coaching->branch->website ?? '', 0, 32) }}
                                             </a>
                                             @else
                                             <a class="fs-13 text-white" href="#">
                                                {{ substr($coaching->branch->website ?? '', 0, 5) }}XXX
                                             </a>
                                             @endif
                                             
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                    
                                    @if( !empty($coaching->branch->mobile) )
                                    <div class="col-11 my-md-2 my-2 d-flex align-items-stretch justify-content-center">
                                       <div class="exam_single_box shadow rounded row w-100">
                                          <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                             <i class="fas fa-mobile-alt"></i>
                                          </div>
                                          <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                             @if(session()->has('student'))
                                             <a class="fs-13 text-white d-inline-block" target="_blank" href="tel:{{ $coaching->branch->mobile ?? '' }}"> 
                                             {{ $coaching->branch->mobile ?? '' }}
                                             </a>
                                             @else 
                                             <a class="fs-13 text-white d-inline-block" href="#"> 
                                             {{ substr($coaching->branch->mobile ?? '', 0, 5) }}XXX
                                             </a>
                                             @endif
                                             
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                    
                                    @if( !empty($coaching->branch->email) )
                                    <div class="col-11 my-md-2 my-2 d-flex align-items-stretch justify-content-center">
                                       <div class="exam_single_box shadow rounded row w-100">
                                          <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                             <i class="fas fa-envelope-open"></i>
                                          </div>
                                          <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                             @if(session()->has('student'))
                                             <a class="fs-13 text-white d-inline-block ellipsis-2" target="_blank" href="mailto:{{ $coaching->branch->email ?? '' }}"> 
                                                {{ $coaching->branch->email ?? '' }}
                                             </a>
                                             @else
                                             <a class="fs-13 text-white d-inline-block ellipsis-2" href="#"> 
                                                {{ substr($coaching->branch->email ?? '', 0, 5) }}XXX
                                             </a>
                                             @endif
                                             
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                    
                                    <div class="col-11">
                                       <ul class="blog_social_list d-flex justify-content-center list-unstyled pl-0 mt-3">
                                          @if( !empty($coaching->branch->twitter) )
                                          <li class="mx-2">
                                             <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $coaching->branch->twitter ?? '' }}">
                                                <i class="fab fa-twitter"></i>
                                             </a>
                                          </li>
                                          @endif
                                          @if( !empty($coaching->branch->facebook) )
                                          <li class="mx-2">
                                             <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $coaching->branch->facebook ?? '' }}">
                                                <i class="fab fa-facebook"></i>
                                             </a>
                                          </li>
                                          @endif
                                          @if( !empty($coaching->branch->instagram) )
                                          <li class="mx-2">
                                             <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $coaching->branch->instagram ?? '' }}">
                                                <i class="fab fa-instagram"></i>
                                             </a>
                                          </li>
                                          @endif
                                          @if( !empty($coaching->branch->youtube) )
                                          <li class="mx-2">
                                             <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $coaching->branch->youtube ?? '' }}">
                                                <i class="fab fa-youtube"></i>
                                             </a>
                                          </li>
                                          @endif
                                          @if( !empty($coaching->branch->linkedin) )
                                          <li class="mx-2">
                                             <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $coaching->branch->linkedin ?? '' }}">
                                                <i class="fab fa-linkedin"></i>
                                             </a>
                                          </li>
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endif

                  </div>
                   @if( !empty($coaching->courses->toArray()) )
                  <div class="row mt-lg-5 mt-md-4 mt-4">
                     <div class="col-12">
                        <div class="text-left mb-4">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">Courses </h2>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="fees_and_courses_tabs mx-0 row align-items-flex-start">
                           <ul class="nav nav-tabs border-0 pb-md-0 pb-4" id="myTab" role="tablist"> 
                              @if( !empty($coaching->courses) )
                                 @foreach($coaching->courses as $course => $courses_detail)
                                    <li class="nav-item" role="presentation">
                                       <a class="nav-link 
                                       @if($loop->first)
                                          active
                                       @endif
                                       " id="courses-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab" data-toggle="tab" href="#courses-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" role="tab" aria-controls="courses-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" 
                                       @if($loop->first)
                                          aria-selected="true"
                                       @else
                                          aria-selected="false"
                                       @endif                                                   
                                       >{{$course}}</a>
                                    </li>
                                 @endforeach
                              @endif
                              
                           </ul>
                           <div class="tab-content" id="myTabContent">
                              
                              @if( !empty($coaching->courses) )
                                 @foreach($coaching->courses as $course => $results)
                                    <div class="tab-pane fade show  
                                       @if($loop->first)
                                          active
                                       @endif" id="courses-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" role="tabpanel" aria-labelledby="courses-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab">
                                       <div class="row">
                                          @if( !empty($results) )
                                             
                                             @php
                                                $removeBtn=0;
                                                $i = 1;
                                                $limit = 3;
                                             @endphp
                                             @foreach($results as $result) 
                                             @if($result->offering !="")
                                             @php
                                                $removeBtn=1;
                                             @endphp
                                                
                                                @if($i > $limit)
                                                   @continue
                                                @endif

                                                <div class="col-xl-4 col-lg-6 col-md-6 col-12 d-flex align-items-stretch mb-lg-0 mb-md-4 mb-4">
                                                   <div class="row bg-light border p-md-3 p-2 rounded-20 mx-0">
                                                      <div class="col-12 p-0 bg-white border border-success rounded-15">
                                                         <div class="row mx-0">
                                                            <div class="col-12">
                                                               <div class="row">
                                                                  <div class="col"><span class="px-2 py-1 fs-lg-14 fs-md-12 fs-12 position-relative top-n2px 
                                                                     @if( preg_match('/online/', $result->offering) )
                                                                        bg-success
                                                                     @else
                                                                        bg-secondary
                                                                     @endif
                                                                  rounded-bottom text-uppercase">{{ ucwords($result->offering) }}</span></div>
                                                                  <div class="col-auto pr-2"><span class="px-2 py-0 border border-secondary rounded-pill fs-md-13 fs-11 font-weight-bold shadow">{{$course}}</span></div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                               <div class="row">
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 border-bottom py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0 d-none">
                                                                           Course Name-
                                                                        </div>
                                                                        <div class="col-12 fs-lg-18 fs-md-16 fs-15 text-primary font-weight-bold px-0 mt-2">
                                                                           {{$result->name}}
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 border-bottom py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0  text-justify">
                                                                           Targeting-
                                                                        </div>
                                                                        <div class="col-12 fs-lg-14 fs-md-12 fs-12 text-dark font-weight-bold px-0">
                                                                           {{ substr($result->targeting,0,100)}}
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 border-bottom py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0">
                                                                           Description-
                                                                        </div>
                                                                        <div class="p_text text-justify">
                                                                           <p class="fs-lg-15 fs-md-13 fs-13 text-gray mb-0 ellipsis-2">
                                                                              @php
                                                                                 echo substr($result->description, 0)
                                                                              @endphp
                                                                           </p>
                                                                           <p class="text fs-14 text-gray mb-2 d-none" id="read_more-{{$result->id}}">
                                                                              @php
                                                                                 echo substr($result->description, 50)
                                                                              @endphp
                                                                           </p>

                                                                           @if( strlen($result->description) > 80 )
                                                                              <div class="col text-right">
                                                                                 <a id="{{$result->id}}" href="javascript:;" 
                                                                                 class="position-relative right-0 h6 rounded-0 fs-12 py-1 px-2 text-right toggle1
                                                                                 bottom-0px
                                                                                 ">Read More</a>
                                                                              </div>
                                                                           @endif
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 border-bottom py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0">
                                                                           Course Duration-
                                                                        </div>
                                                                        <div class="col-12 fs-lg-14 fs-md-12 fs-12 text-dark font-weight-bold px-0">
                                                                           {{$result->duration}}
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 border-bottom py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0  text-justify">
                                                                           Batch Details-
                                                                        </div>
                                                                        <div class="col-12 fs-lg-14 fs-md-12 fs-12 text-dark font-weight-bold px-0">
                                                                           {{ substr($result->batch_details,0,100)}}
                                                                        </div>
                                                                     </div>
                                                                  </div>

                                                                  @if( session()->has('student') or session()->has('enterprise'))
                                                                  <div class="col-12">
                                                                     @if(!empty($result->fee))
                                                                     <div class="row mx-0 py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0">
                                                                           Fee-
                                                                        </div>
                                                                        <div class="col-12 fs-lg-14 fs-md-12 fs-12 text-dark font-weight-bold px-0">
                                                                           <div class="row d-flex align-items-center">
                                                                              <div class="col-7">
                                                                                 @if($result->gst_inclusive_exclusive == 'exclusive')
                                                                                    ₹{{$result->fee + ($result->fee * 18 / 100)}}
                                                                                    <span class="d-block fs-11 text-primary">(₹{{$result->fee}} + 18% GST)</span>
                                                                                    
                                                                                 @else
                                                                                    ₹{{$result->fee}} Inc. GST
                                                                                 @endif
                                                                              </div>
                                              
                                                                            @if( !empty($result->fee_type) )        
                                                                            <div class="col">
                                                                                 In {{$result->fee_type}}
                                                                              </div>
                                                                            @endif
                                                                           </div>
                                                                           
                                                                        </div>
                                                                     </div>
                                                                     @endif
                                                                  </div>
                                                                  @if($result->offer_percentage!=0)
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 py-2 align-items-center justify-content-center mt-2 border-dashed-2px-success">
                                                                        <div class="col-auto fs-lg-14 fs-md-12 fs-12 text-uppercase font-weight-bold px-0 mr-3 offer-animation">
                                                                           Offer-
                                                                        </div>
                                                                        <div class="col-auto fs-lg-14 fs-md-12 fs-12 text-success font-weight-bold px-0">

                                                                          <?php $fees= $result->fee;
                                                                           if($result->gst_inclusive_exclusive == 'exclusive'){
                                                                              $fees= $result->fee + ($result->fee * 18 / 100);
                                                                           }
                                                                              $discount_price = ($fees * $result->offer_percentage) / 100;

                                                                              $price = ($fees - $discount_price);

                                                                              $final_price= $price;
                                                                           ?>

                                                                           {{$result->offer_percentage}}% save ₹{{$discount_price}}
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  @else
                                                                  <?php if($result->gst_inclusive_exclusive == 'exclusive'){
                                                                        $final_price= $result->fee + ($result->fee * 18 / 100);
                                                                     }else{
                                                                         $final_price= $result->fee;
                                                                     }
                                                                 ?>
                                                                  @endif
                                                                  @else
                                                                  @if($result->is_paid == 'yes')
                                                                     <div class="col-12">
                                                                        @if(!empty($result->fee))
                                                                        <div class="row mx-0 py-2">
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0">
                                                                           Fee-
                                                                        </div>
                                                                        <div class="col-12 fs-lg-14 fs-md-12 fs-12 text-dark font-weight-bold px-0">
                                                                           <div class="row d-flex align-items-center">
                                                                              <div class="col-7">
                                                                                 @if($result->gst_inclusive_exclusive == 'exclusive')
                                                                                    ₹{{$result->fee + ($result->fee * 18 / 100)}}
                                                                                   <span class="d-block fs-11 text-primary">(₹{{$result->fee}} + 18% GST)</span>
                                                                                 @else
                                                                                    ₹{{$result->fee}} Inc. GST
                                                                                 @endif
                                                                              </div>
                                                                              <div class="col">
                                                                                 In {{$result->fee_type}}
                                                                              </div>
                                                                           </div>
                                                                           
                                                                        </div>
                                                                     </div>
                                                                     @endif
                                                                  </div>
                                                                  @if($result->offer_percentage!=0)
                                                                  <div class="col-12">
                                                                     <div class="row mx-0 py-2 align-items-center justify-content-center mt-2 border-dashed-2px-success">
                                                                        <div class="col-auto fs-14 text-uppercase font-weight-bold px-0 mr-3 offer-animation">
                                                                           Offer-
                                                                        </div>
                                                                        <div class="col-auto fs-14 text-success font-weight-bold px-0">

                                                                          <?php $fees= $result->fee;
                                                                           if($result->gst_inclusive_exclusive == 'exclusive'){
                                                                              $fees= $result->fee + ($result->fee * 18 / 100);
                                                                           }
                                                                              $discount_price = ($fees * $result->offer_percentage) / 100;

                                                                              $price = ($fees - $discount_price);

                                                                              $final_price= $price;
                                                                           ?>

                                                                           {{$result->offer_percentage}}% save ₹{{$discount_price}}
                                                                        </div>
                                                                     </div>
                                                                  </div>

                                                                  @endif
                                                                  @endif
                                                                  @endif
                                                                   <div class="col-12">
                                                                     <div class="row mx-0 py-2 align-items-center">
                                                                        <div class="col">
                                                                           @if(!empty($result->fee))
                                                                           <div class="row">
                                                                              <div class="col-12 fs-12 font-weight-bold text-gray px-0 text-nowrap">
                                                                                 OFFERED FEE-
                                                                              </div>

                                                                              <div class="col-12 fs-lg-25 fs-md-20 fs-17 text-dark font-weight-bold px-0">
                                                                                 @if( session()->has('student') or session()->has('enterprise'))

                                                                                 ₹{{ round($final_price)}}
                                                                                 @else
                                                                                 @if($result->is_paid == 'yes')
                                                                                 @if($result->offer_percentage!=0)
                                                                                 <?php $fees= $result->fee;
                                                                                    if($result->gst_inclusive_exclusive == 'exclusive'){
                                                                                       $fees= $result->fee + ($result->fee * 18 / 100);
                                                                                    }
                                                                                       $discount_price = ($fees * $result->offer_percentage) / 100;

                                                                                       $price = ($fees - $discount_price);

                                                                                       $final_price= $price;
                                                                                    ?>
                                                                                    @else
                                                                                       <?php if($result->gst_inclusive_exclusive == 'exclusive'){
                                                                                             $final_price= $result->fee + ($result->fee * 18 / 100);
                                                                                          }else{
                                                                                              $final_price= $result->fee;
                                                                                          }
                                                                                      ?>
                                                                                       @endif
                                                                                 ₹{{ round($final_price)}}
                                                                                 @endif
                                                                                 @endif
                                                                              </div>
                                                                                 <span class="d-block fs-11 text-primary">(Inc. Reg Fee)</span>
                                                                           </div>
                                                                           @endif
                                                                        </div>
                                                                          @if( session()->has('student') or session()->has('enterprise'))
                                                                            @if($result->registration_fee!=0)
                                                                           <div class="col-6 align-self-start">
                                                                                 <div class="row">
                                                                                
                                                                                    <div class="col-12 fs-lg-12 fs-md-11 fs-11 font-weight-bold text-gray text-uppercase px-0 text-right">
                                                                                       Registration Fee-
                                                                                    </div>
                                                                                    <div class="col-12 fs-lg-25 fs-md-20 fs-15 text-dark font-weight-bold px-0 text-right">
                                                                                       ₹{{ $result->registration_fee }}
                                                                                    </div>
                                                                                    <?php $registration_fee= $result->registration_fee; ?>
                                                                                 </div>
                                                                           </div>
                                                                             @endif
                                                                             
                                                                           @else
                                                                           @if($result->is_paid == 'yes')
                                                                            @if($result->registration_fee!=0)
                                                                             <div class="col-6 align-self-start">
                                                                                 <div class="row">
                                                                                    <div class="col-12 fs-lg-12 fs-md-11 fs-11 font-weight-bold text-gray text-uppercase px-0 text-right">
                                                                                       Registration Fee-
                                                                                    </div>
                                                                                    <div class="col-12 fs-lg-25 fs-md-20 fs-15 text-dark font-weight-bold px-0 text-right">
                                                                                       ₹{{ $result->registration_fee }}
                                                                                    </div>
                                                                                    <?php $registration_fee= $result->registration_fee; ?>
                                                                                  </div>
                                                                              </div>
                                                                             @endif
                                                                             @endif
                                                                          

                                                                        @endif
                                                                         <div class="  @if($result->registration_fee!=0) col-12 text-center px-0 ml-  @else col-auto text-right px-0 ml-auto @endif">
                                                                            
                                                                           <?php $coachingname= "$coaching->name"; 
                                                                           ?>
                                                                           <input type="hidden" id="coachingname_id{{$result->id}}" value="{{ $coachingname }}">
                                                                            <a 
                                                                              @if($result->is_paid == 'yes')

                                                                                 @if( session()->has('student') )
                                                                                    onclick="
                                                                                    @if($result->registration_fee==0)
                                                                                       payment_modal('{{$result->id}}', '{{$result->name}}', '{{$result->targeting}}', '{{$result->duration}}', '{{$final_price}}')
                                                                                    @else
                                                                                       payment_modal1('{{$result->id}}', '{{$result->name}}', '{{$result->targeting}}', '{{$result->duration}}'
                                                                                       ,'{{$final_price}}','{{$registration_fee}}')
                                                                                       @endif"
                                                                                 @else
                                                                                    data-toggle="modal" data-target="#exampleModal1"
                                                                                 @endif
                                                                              @else 
                                                                                 @if( session()->has('student') )
                                                                                    data-toggle="modal" data-target="#know_more_modal_id"
                                                                                  @else
                                                                                    data-toggle="modal" data-target="#exampleModal1"
                                                                                 @endif
                                                                              @endif
                                                                           href="javascript:;" class="btn rounded-0 btn-outline-primary btn-primary text-white py-1 px-3 btn-sm">
                                                                           @if($result->is_paid == 'yes')
                                                                              
                                                                              @if($result->offer_percentage)
                                                                                 Buy Now
                                                                              @else 
                                                                                 Enroll Now
                                                                              @endif
                                                                              
                                                                           @else 
                                                                              @if( session()->has('student') or session()->has('enterprise'))
                                                                                Know More
                                                                              @else 
                                                                                 See fees
                                                                              @endif
                                                                           @endif
                                                                           </a>


                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  

                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>                                                

                                                @php
                                                   $i += 1;
                                                @endphp
@endif
                                             @endforeach

                                          @endif
                                          @if($removeBtn==1)
                                          <div class="seemore col-12 text-center mt-md-4 mt-3 pt-md-3">
                                             <a href="{{ action('Website\CoachingController@courses', $coaching->coaching_name_slug) }}" class="btn fs-13 px-2 py-1 rounded-pill btn-sm btn-outline-primary btn-primary text-white">See More</a>
                                          </div>
                                          @endif
                                       </div>
                                      
                                    </div>
                                 @endforeach
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                   @if( !empty($coaching->facility->toArray()) )
                     <div class="row mt-4">
                        <div class="col-md-12">
                           <div class="row mx-0">
                              <div class="col-auto px-0 fs-lg-20 fs-md-18 fs-16 mb-0 text-secondary font-weight-bold">

                                 Facilities
                              </div>
                             <div class="col-12">
                                 <div class="row mt-4">
                                    @foreach($coaching->facility as $facility)
                                       <div class="col-md-3 col-6 d-flex align-items-stretch text-center rounded mb-3 aos-init aos-animate rounded">
                                          <a class="future_icon_box shadow p-md-3 p-2 w-100 text-center d-flex align-items-center flex-lg-nowrap flex-md-wrap flex-wrap justify-content-center min_hieght_facility"  href="javascript:;">
                                             <span class="fs-xl-24 fs-lg-20 fs-md-18 fs-16 text-secondary">
                                                @php echo $facility->image; @endphp
                                             </span>
                                             <h4 class="text-secondary fs-xl-16 fs-lg-15 fs-md-13 fs-12 mt-2 ml-lg-3">{{ substr($facility->name,0,16) }}</h4>
                                          </a>
                                       </div>
                                    @endforeach
                        
                                 </div>
                             </div>
                           </div>
                        </div>
                     </div>
                     @endif
                  <div class="row mx-0">
                     <div class="col-12 mb-4 mt-md-5 mt-4">
                        @if( !empty( $header->advertisement('full') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('full')->url
                           }}" onclick="clickCounter('<?php echo $header->advertisement('full')->id?>')"
                           target="_blank"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                           alt="{{ basename( asset('public/' . $header->advertisement('full')->image) ) }}"
                        >
                        </a>
                     @endif
                     </div>
                  </div>
                   @if( !empty($coaching->faculty->toArray()) )
                  <div class="row mt-lg-5 mt-md-4 mt-0 mx-lg-0 mx-md-4 overflow-hidden">
                     <div class="col-md-12 mt-3 faculty_courses">
                        <div class="text-left border-bottom">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 mb-2">Our Esteemed Mentors of {{ $coaching->name ?? '' }} </h2>
                        </div>
                        <div class="our_team_slider mt-4 owl-carousel">
                           <?php 
                           $i=0;?>
                          
                              @foreach($coaching->faculty as $faculty)
                                 <div class="team_box bg-white overflow-hidden position-relative p-3 shadow rounded text-center mx-md-3 mx-2">
                                    <div class="mt-2 mb-3">
                                       <span class="h-80px w-80px mx-auto d-flex align-items-center justify-content-center shadow rounded-pill p-1 border position-relative">
                                       
                                       @php
                                          $image = asset('public/coaching_faculty/'. $faculty->image);

                                          #if(! @GetImageSize($image) ) {
                                          #   $image = asset('public/user.png');
                                          #}
                                       @endphp
                                       
                                       <img class="img-fluid rounded-pill h-60px" src="{{ $image }}" alt="{{ $faculty->image }}">
                                          <a class="d-flex bg-primary position-absolute align-items-center top-0 right-0 justify-content-center fs-10 text-white rounded-pill w-20px h-20px shadow" href="{{ $faculty->link }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                       </span>
                                    </div>
                                    <h2 class="bg-primary d-block fs-md-16 fs-14 text-white py-2 my-2">
                                          {{ substr($faculty->name,0,26) ?? '' }}
                                    </h2>
                                    <div class="min_height_fa">
                                    <span class="d-block fs-md-14 fs-12 mt-3 mb-1 text-nowrap overflow-hidden">
                                       {{ substr($faculty->designation,0,30) ?? '' }}
                                    </span>
                                    <label class="d-block fs-md-14 fs-12 text-nowrap overflow-hidden">
                                       @if( !empty($faculty->education) )
                                          {{ substr($faculty->education,0,30) ?? '' }}
                                          <br>
                                       @endif
                                    @if(!empty($faculty->experience)) 
                                    {{ $faculty->experience ?? '' }}+ Years Exp
                                    @else
                                    <br>
                                    @endif
                                 </label>
                              </div>
                                    <div class="hover_linkden rounded">
                                       <a class="d-flex align-items-center justify-content-center text-white rounded-pill w-50px h-50px shadow" href="{{ ($faculty->link)?$faculty->link:'javascript:;' }}" @if($faculty->link) target="_blank" @endif> <i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                 </div>
                                 <?php $i++; ?>
                              @endforeach
                          
                        </div>
                     </div>
                  </div>
                   @endif
                   @if( !empty($coaching->results->toarray()) || !empty($coaching->testimonials->toarray()))
                  <div class="row mt-lg-5 mt-md-4 mt-4">
                     <div class="fees_and_courses_tabs w-100">
                        <ul class="nav mx-3 mt-0 nav-tabs border-0 pb-0" id="myTab" role="tablist">
                           @if( !empty($coaching->results->toarray()) )
                           <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="result_inner1-tab" data-toggle="tab" href="#result_inner1" role="tab" aria-controls="result_inner1" aria-selected="true">Result</a>
                           </li>
                            @endif
                           @if( !empty($coaching->testimonials->toarray()) )
                           <li class="nav-item" role="presentation">
                              <a class="nav-link" id="testimonials_inner1-tab" data-toggle="tab" href="#testimonials_inner1" role="tab" aria-controls="testimonials_inner1" aria-selected="false">Testimonials</a>
                           </li>
                           @endif
                        </ul>
                        <div class="tab-content pt-0" id="myTabContent">
                           <div class="tab-pane fade show active" id="result_inner1" role="tabpanel" aria-labelledby="result_inner1-tab">
                              @if( !empty($coaching->results->toArray()) )
                              <div class="row mt-0">
                                  
                                 <div class="col-12">
                                    <div class="text-left mb-4">
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="fees_and_courses_tabs mobile_scrool_tabs row mx-0 align-items-flex-start">
                                       <ul class="nav d-block nav-tabs border-0 pb-0 px-3 col-md-auto px-3" id="myTab" role="tablist">
                                          
                                          @if( !empty($coaching->results) )
                                             @foreach($coaching->results as $course => $results)
                                                <li class="nav-item" role="presentation">
                                                   <a class="nav-link 
                                                   @if($loop->first)
                                                      active
                                                   @endif
                                                   " id="results-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab" data-toggle="tab" href="#results-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" role="tab" aria-controls="results-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" 
                                                   @if($loop->first)
                                                      aria-selected="true"
                                                   @else
                                                      aria-selected="false"
                                                   @endif                                                   
                                                   >{{$course}}</a>
                                                </li>
                                             @endforeach
                                          @endif
                                          
                                       </ul>
                                       <div class="tab-content pt-md-0 pt-3 col" id="myTabContent">
                                          @if( !empty($coaching->results) )
                                             @foreach($coaching->results as $course => $results)
                                                <div class="tab-pane fade show 
                                                @if($loop->first)
                                                   active
                                                @endif
                                                " id="results-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" role="tabpanel" aria-labelledby="results-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab">
                                                   <div class="col-md-12">
                                                      <div class="row">
                                                         @if( !empty($results) )
                                                          @php
                                                            $ii = 0;
                                                            $limit = 11;
                                                         @endphp
                                                            @foreach($results as $result)
                                                             @if($ii > $limit)
                                                               @continue
                                                            @endif
                                                            <div class="col-lg-3 col-md-6 result_box col-12 mb-md-4 mb-4 d-flex align-items-center justify-content-center">
                                                               <a href="javascript:;" class="courses_box shadow w-100 p-1 d-block rounded">
                                                                  <div class="exam-ico position-relative col-12 justify-content-center rounded-top text-center pt-2 pb-0 px-2 bg-light rounded-top">
                                                                     <span class="h-80px mx-auto w-80px bg-white rounded-pill d-flex align-items-center justify-content-center p-1 border shadow">

                                                                        @php
                                                                           $image = asset('public/coaching_results/'. $result->image);

                                                                           #if(! @GetImageSize($image) ) {
                                                                           #   $image = asset('public/user.png');
                                                                           #}
                                                                        @endphp

                                                                        <img class="img-fluid rounded-pill h-100 w-100" src="{{ $image }}" alt="{{ $result->image }}">
                                                                     </span>
                                                                  </div>
                                                                  <div class="inner-text col-12 pt-1 pb-3 px-1 d-flex align-items-center justify-content-center rounded-bottom bg-light rounded-bottom">
                                                                     <div class="text-center my-1 px-0">
                                                                        <h2 class="fs-14 font-weight-bold text-secondary mb-3 pb-2 position-relative">{{ substr($result->name,0,22) }}</h2>
                                                                        <div class="row justify-content-center align-items-center">
                                                                           <div class="col-auto px-0 text-left font-weight-bold">
                                                                              <span class="fs-13 text-secondary">
                                                                                
                                                                                 {{ substr($result->rank,0,12) }} 
                                                                              </span>
                                                                           </div>
                                                                            <div class="col-auto d-flex align-items-center border px-0 mx-1 h-20px">
                                                                           </div>

                                                                          
                                                                           <div class="col-auto px-0 text-left font-weight-bold">
                                                                              <span class="text-secondary fs-14">{{ substr($result->category,0,12) }} </span>
                                                                           </div>
                                                                           @if($result->category)
                                                                           <div class="col-auto d-flex align-items-center border px-0 mx-1 h-20px">
                                                                           </div>
                                                                           @endif
                                                                           <div class="col-auto px-0 text-left font-weight-bold">
                                                                              <span class="fs-13 text-secondary">{{$result->year}} </span>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </a>
                                                            </div>
                                                                @php
                                                                  $ii += 1;
                                                               @endphp

                                                            @endforeach

                                                         @endif
                                                      </div>
                                                   </div>
                                                   @if(count($results)>12)
                                                   <div class="seemore col-12 text-center mt-2 pt-3">
                                                      <a href="{{ action('Website\CoachingController@results', $coaching->coaching_name_slug) }}" class="btn fs-13 px-2 py-1 rounded-pill btn-sm btn-outline-primary btn-primary text-white">See More</a>
                                                   </div>
                                                   @endif
                                                </div>
                                             @endforeach
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                               @endif
                           </div>
                           <div class="tab-pane fade" id="testimonials_inner1" role="tabpanel" aria-labelledby="testimonials_inner1-tab">
                               @if( !empty($coaching->testimonials) )
                              <div class="row mt-0">
                                 <div class="col-12">
                                    <div class="text-left mb-4">
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="fees_and_courses_tabs mobile_scrool_tabs mx-0 row align-items-flex-start">
                                       <ul class="nav d-block nav-tabs border-0 pb-0 col-md-auto px-3" id="myTab" role="tablist">
                                          
                                          @if( !empty($coaching->testimonials) )
                                             @foreach($coaching->testimonials as $course => $testimonials)
                                                <li class="nav-item" role="presentation">
                                                   <a class="nav-link m-md-0
                                                   @if($loop->first)
                                                      active
                                                   @endif
                                                   " id="testimonials-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab" data-toggle="tab" href="#testimonials-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" role="tab" aria-controls="testimonials-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" 
                                                   @if($loop->first)
                                                      aria-selected="true"
                                                   @else
                                                      aria-selected="false"
                                                   @endif                                                   
                                                   >{{$course}}</a>
                                                </li>
                                             @endforeach
                                          @endif
                                         
                                       </ul>
                                       <div class="tab-content pt-md-0 pt-3 col" id="myTabContent">
                                          @if( !empty($coaching->testimonials) )
                                             @foreach($coaching->testimonials as $course => $testimonials)
                                                <div class="tab-pane fade show 
                                                @if($loop->first)
                                                   active
                                                @endif
                                                " id="testimonials-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}" role="tabpanel" aria-labelledby="testimonials-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab">
                                                   <div class="col-md-12 px-0">
                                                      <div class="row">

                                                         @if( !empty($testimonials) )
                                                          @php
                                                            $iii = 0;
                                                            $limit = 11;
                                                         @endphp
                                                            @foreach($testimonials as $testimonial)
                                                             @if($iii > $limit)
                                                               @continue
                                                            @endif
                                                            <div class="col-lg-4 col-md-6 result_box col-12 mb-md-4 d-flex align-items-center justify-content-center mb-md-0 mb-4">
                                                               <a href="javascript:;" class="courses_box shadow w-100 p-1 d-block rounded">
                                                                  <div class="exam-ico position-relative col-12 justify-content-center rounded-top text-center pt-2 pb-0 px-2 bg-light rounded-top">
                                                                     <span class="h-80px mx-auto w-80px bg-white rounded-pill d-flex align-items-center justify-content-center p-1 border shadow">

                                                                        @php
                                                                           $image = asset('public/coaching_testimonials/'. $testimonial->image);

                                                                           #if(! @GetImageSize($image) ) {
                                                                           #   $image = asset('public/logo.png');
                                                                           #}
                                                                        @endphp

                                                                        <img class="img-fluid rounded-pill h-100" src="{{ $image }}" alt="{{ $testimonial->image }}">
                                                                     </span>
                                                                  </div>
                                                                  <div class="inner-text col-12 pt-1 pb-3 px-1 d-flex align-items-center justify-content-center rounded-bottom bg-light rounded-bottom">
                                                                     <div class="text-center my-1 px-0">
                                                                        <h2 class="fs-14 font-weight-bold text-secondary mb-3 pb-2 position-relative">{{ substr($testimonial->name,0,30) }}</h2>
                                                                        <div class="row justify-content-center align-items-center">
                                                                           
                                                                           @if( !empty($testimonial->rank) )
                                                                           <div class="col-auto px-0 text-left font-weight-bold">
                                                                              <span class="fs-13 text-secondary">
                                                                                  {{ substr($testimonial->rank,0,12)}} 
                                                                              </span>
                                                                           </div>
                                                                           <div class="col-auto d-flex align-items-center border px-0 mx-1 h-20px">
                                                                           </div>
                                                                           @endif

                                                                           @if( !empty($testimonial->category) )
                                                                           <div class="col-auto px-0 text-left font-weight-bold">
                                                                              <span class="text-secondary fs-14">{{ substr($testimonial->category,0,12) }} </span>
                                                                           </div>
                                                                           <div class="col-auto d-flex align-items-center border px-0 mx-1 h-20px">
                                                                           </div>
                                                                           @endif
                                                                           
                                                                           @if( !empty($testimonial->year) )
                                                                           <div class="col-auto px-0 text-left font-weight-bold">
                                                                              <span class="fs-13 text-secondary">{{$testimonial->year}} </span>
                                                                           </div>
                                                                           @endif
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="bg-primary p-3 rounded-bottom min_hieght_dec" >
                                                                     <p class="fs-lg-14 fs-md-13 fs-12 text-center mb-0 text_justity">{{ substr($testimonial->description,0,250) }}</p>
                                                                  </div>
                                                               </a>
                                                            </div>
                                                             @php
                                                               $iii += 1;
                                                            @endphp
                                                            @endforeach
                                                         @endif
                                                      </div>
                                                   </div>
                                                   @if(count($testimonials)>12)
                                                   <div class="seemore col-12 text-center mt-2 pt-3">
                                                      <a href="{{ action('Website\CoachingController@results', $coaching->coaching_name_slug) }}" class="btn fs-13 px-2 py-1 rounded-pill btn-sm btn-outline-primary btn-primary text-white">See More</a>
                                                   </div>
                                                   @endif
                                                </div>
                                             @endforeach
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                   @endif
                  @if( !empty($coaching->photos->toArray()) || !empty($coaching->videos->toArray()))
                  <div class="row mt-lg-5 mt-md-4 mt-5 mx-lg-0 mx-md-4 overflow-hidden">
                     <div class="col-md-12">
                        <div class="fees_and_courses_tabs">
                           <ul class="nav nav-tabs border-0 pb-0" id="myTab" role="tablist">
                               @if( !empty($coaching->photos->toArray()) )
                              <li class="nav-item" role="presentation">
                                 <a class="nav-link active" id="gallery_inner1-tab" data-toggle="tab" href="#gallery_inner1" role="tab" aria-controls="course" aria-selected="true">Photos</a>
                              </li>
                              @endif
                              @if( !empty($coaching->videos->toArray()) )
                              <li class="nav-item" role="presentation">
                                 <a class="nav-link" id="gallery_inner2-tab" data-toggle="tab" href="#gallery_inner2" role="tab" aria-controls="gallery_inner2" aria-selected="false">Videos</a>
                              </li>
                              @endif
                           </ul>
                           <div class="tab-content pt-0" id="myTabContent">

                              <div class="tab-pane fade show active" id="gallery_inner1" role="tabpanel" aria-labelledby="gallery_inner1-tab">
                                   @if( !empty($coaching->photos->toArray()) )
                                 <div class="row">
                                    <div class="col-md-12 mt-0">
                                       <div class="text-left">
                                       </div>
                                       <div class="gallery_photos owl-carousel mt-4">
                                       
                                          @foreach($coaching->photos as $photos)
                                             @php
                                                $image = asset('public/coaching_photos/'. $photos->image);

                                                #if(! @GetImageSize($image) ) {
                                                #   continue;
                                                #}
                                             @endphp
                                             <div class="slide_photos mb-4 mx-md-3 mx-2">
                                                <img class="img-fluid border rounded shadow mx-2 mb-2" src="{{ asset('/public/s_img_new.php') }}?image={{ $image }}&width=441&height=323&zc=0" alt="{{ $photos->image }}">
                                             </div>
                                          @endforeach
                                      
                                       </div>
                                    </div>
                                 </div>
                                  @endif
                              </div>
                              <div class="tab-pane fade" id="gallery_inner2" role="tabpanel" aria-labelledby="gallery_inner2-tab">
                                 @if( !empty($coaching->videos->toArray()) )
                                 <div class="row">
                                    <div class="col-md-12 mt-0">
                                       <div class="text-left ">
                                       </div>
                                       <div class="row mt-4">
                                       
                                          <input type="hidden" name="total_videos" id="total_videos" value="{{ count($coaching->videos) }}">
                                             @foreach($coaching->videos as $videos)

                                                @php
                                                   $video_part = str_replace('embed/', '', strstr($videos->video, 'embed/') );
                                                   
                                                @endphp

                                                <div class="load_more_outer col-md-4 mb-md-4 mb-2">
                                                   <div class="video-box position-relative text-center">
                                                      <img class="img-fluid" src="https://img.youtube.com/vi/{{$video_part}}/hqdefault.jpg" alt="hqdefault.jpg">
                                                      <div class="video-btn">
                                                         <a href="{{ $videos->video }}" class="venobox play-btn vbox-item" data-vbtype="video" data-autoplay="true"></a>
                                                      </div>
                                                      <div class="thimbnail_text text-left pt-2 pb-2 px-2 rounded-bottom w-100">
                                                   <h3 class="fs-14 text-primary mb-0">{{ substr($videos->title,0,100) }}</h3>
                                                </div>
                                                   </div>
                                                </div>
                                             @endforeach
                                         
                                          @if( !empty($coaching->videos) and count($coaching->videos) >= 4)
                                          <div class="seemore col-md-12 text-center seevideoss">
                                             <a href="javascript:void(0)" class="load-more11 rounded-pill m-auto d-flex align-items-center justify-content-center h-50px fs-20 w-50px bg-secondary"><i class="fas fa-arrow-down"></i></a>
                                          </div>
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                                  @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  <div id="review_sec" class="row mt-4">
                     <div class="col-md-12 leave_review">
                         <?php $showedit= false;
                        if( !empty($coaching->my_review) ){
                           if($coaching->my_review->status=='enable'){
                              $showedit=true;
                           }
                        }?>
                        <div class="text-left border-bottom">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 mb-2">Leave a Review for {{$coaching->name ?? ''}} </h2>
                           @if($showedit==false)
                           <p class="fs-lg-16 fs-md-14 fs-13">Have you studied at {{$coaching->name ?? ''}}</p>
                           @endif
                        </div>
                       
                        @if($showedit==false)
                        <div class="row mt-4" id="before_edit_btn_clicked">
                           <div class="col-md-12">
                              <div class="row">
                                 <form action="{{ action('Website\CoachingController@student_review') }}" method="post" onSubmit="return is_stars_selected()">
                                 @csrf


                                 @if(!empty(session()->has('student')))
                                  
                                   @else
                                   <a data-toggle="modal" data-target="#exampleModal1" class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                                   @endif
                                    <input type="hidden" name="coaching_id" value="{{$coaching->id}}">
                                       
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-12">
                                             <div class="card shadow reviewsses">
                                                <div class="col-12 card-header fs-16 text-left bg-secondary text-white">
                                                   <div class="row align-items-center justify-content-between">
                                                      <div class="col-lg-auto fs-lg-17 fs-md-16 fs-15 text-uppercase">Leave a Review</div>
                                                      <div class="col-lg-8 mt-lg-0 mt-md-2 mt-3">
                                                         <div class="row select_mobile_part">
                                                            <div class="col">
                                                               <div class="review_select_box w-100">
                                                                  <select name="course" id="exam" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" placeholder="" required>
                                                                     <option value="" selected="">Courses </option>
                                                                     
                                                                     @if( !empty($coaching->courses_for_reviews) )
                                                                        @foreach($coaching->courses_for_reviews as $course )
                                                                           <option value="{{$course->name}}"
                                                                              
                                                                           >{{$course->name}}</option>
                                                                        @endforeach
                                                                     @endif

                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <div class="col">
                                                               <div class="review_select_box w-100">
                                                                  <select name="duration" id="city" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" placeholder="" required>
                                                                     <option value="" selected="">Duration of the Course</option>
                                                                     <option value="> 3 Months"
                                                                     > > 3 Months</option>
                                                                     <option value="3-6 Months"
                                                                     > 3-6 Months</option>
                                                                     <option value="6-12 Months"
                                                                     > 6-12 Months</option>
                                                                     <option value="> 12 Months"
                                                                     > > 12 Months</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <div class="col">
                                                               <div class="review_select_box w-100">
                                                                  <select name="year" id="city" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" placeholder="" required>
                                                                     <option value="" selected="">Year of Study </option>
                                                                     @foreach(range(date('Y'), 2021) as $year)
                                                                        <option value="{{$year}}"
                                                                        >{{$year}}</option>
                                                                     @endforeach
                                                                     <option value="2020"
                                                                     >2020</option>
                                                                     <option value="2019"
                                                                     >2019</option>
                                                                     <option value="2018"
                                                                     >2018</option>
                                                                     <option value="2017"
                                                                     >2017</option>
                                                                     <option value="2016"
                                                                     >2016</option>
                                                                     <option value="2015"
                                                                     >2015</option>
                                                                     <option value="2014"
                                                                     >2014</option>
                                                                     <option value="2013"
                                                                     >2013</option>
                                                                     <option value="2012"
                                                                     >2012</option>
                                                                     <option value="2011"
                                                                     >2011</option>
                                                                     <option value="2010"
                                                                     >2010</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="card-body p-0">
                                                   <div class="row mx-0">
                                                      <div class="col-12">
                                                         <div class="row pt-4 mx-0">
                                                            <div class="col-12">
                                                               <div class="row starts_box">
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto">
                                                                       <i class="fas fa-graduation-cap"></i></span>
                                                                        <strong class="fs-14">Faculty</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio" id="star5" name="faculty_stars" value="5" 
                                                                           /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio" id="star4half" name="faculty_stars" value="4.5" 
                                                                           /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio" id="star4" name="faculty_stars" value="4" 
                                                                           /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio" id="star3half" name="faculty_stars" value="3.5" 
                                                                           /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio" id="star3" name="faculty_stars" value="3" 
                                                                           /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio" id="star2half" name="faculty_stars" value="2.5" 
                                                                           /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio" id="star2" name="faculty_stars" value="2" 
                                                                           /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio" id="star1half" name="faculty_stars" value="1.5"
                                                                           /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio" id="star1" name="faculty_stars" value="1" 
                                                                           /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio" id="starhalf" name="faculty_stars" value="0.5"
                                                                           /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fas fa-books"></i></span>
                                                                        <strong class="fs-14">Study Material</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="2star5" name="study_materials_stars" value="5"
                                                                           /><label class="full" for="2star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="2star4half" name="study_materials_stars" value="4.5"
                                                                           /><label class="half" for="2star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="2star4" name="study_materials_stars" value="4"
                                                                           /><label class="full" for="2star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="2star3half" name="study_materials_stars" value="3.5"
                                                                           /><label class="half" for="2star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="2star3" name="study_materials_stars" value="3"
                                                                           /><label class="full" for="2star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="2star2half" name="study_materials_stars" value="2.5"
                                                                           /><label class="half" for="2star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="2star2" name="study_materials_stars" value="2"
                                                                           /><label class="full" for="2star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="2star1half" name="study_materials_stars" value="1.5"
                                                                           /><label class="half" for="2star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="2star1" name="study_materials_stars" value="1"
                                                                           /><label class="full" for="2star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="2starhalf" name="study_materials_stars" value="0.5"
                                                                           /><label class="half" for="2starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto">
                                                                        <i class="fas fa-lightbulb"></i></span>
                                                                        <strong class="fs-14">Doubt Clearing</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="3star5" name="doubt_clearing_stars" value="5" 
                                                                           /><label class="full" for="3star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="3star4half" name="doubt_clearing_stars" value="4.5" 
                                                                           /><label class="half" for="3star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="3star4" name="doubt_clearing_stars" value="4"
                                                                           /><label class="full" for="3star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="3star3half" name="doubt_clearing_stars" value="3.5"
                                                                           /><label class="half" for="3star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="3star3" name="doubt_clearing_stars" value="3" 
                                                                           /><label class="full" for="3star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="3star2half" name="doubt_clearing_stars" value="2.5"
                                                                           /><label class="half" for="3star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="3star2" name="doubt_clearing_stars" value="2"
                                                                           /><label class="full" for="3star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="3star1half" name="doubt_clearing_stars" value="1.5"
                                                                           /><label class="half" for="3star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="3star1" name="doubt_clearing_stars" value="1" 
                                                                           /><label class="full" for="3star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="3starhalf" name="doubt_clearing_stars" value="0.5"
                                                                           /><label class="half" for="3starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fas fa-users-cog"></i></span>
                                                                        <strong class="fs-14">Infrastructure</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="4star5" name="mentorship_stars" value="5" 
                                                                           /><label class="full" for="4star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="4star4half" name="mentorship_stars" value="4.5"
                                                                           /><label class="half" for="4star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="4star4" name="mentorship_stars" value="4" 
                                                                           /><label class="full" for="4star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="4star3half" name="mentorship_stars" value="3.5"
                                                                           /><label class="half" for="4star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="4star3" name="mentorship_stars" value="3" 
                                                                           /><label class="full" for="4star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="4star2half" name="mentorship_stars" value="2.5"
                                                                           /><label class="half" for="4star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="4star2" name="mentorship_stars" value="2" 
                                                                           /><label class="full" for="4star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="4star1half" name="mentorship_stars" value="1.5"
                                                                           /><label class="half" for="4star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="4star1" name="mentorship_stars" value="1" 
                                                                           /><label class="full" for="4star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="4starhalf" name="mentorship_stars" value="0.5"
                                                                           /><label class="half" for="4starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fad fa-user-headset"></i></span>
                                                                        <strong class="fs-14">Tech Support</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="5star5" name="tech_support_stars" value="5" 
                                                                           /><label class="full" for="5star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="5star4half" name="tech_support_stars" value="4.5" 
                                                                           /><label class="half" for="5star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="5star4" name="tech_support_stars" value="4" 
                                                                           /><label class="full" for="5star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="5star3half" name="tech_support_stars" value="3.5" 
                                                                           /><label class="half" for="5star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="5star3" name="tech_support_stars" value="3" 
                                                                           /><label class="full" for="5star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="5star2half" name="tech_support_stars" value="2.5" 
                                                                           /><label class="half" for="5star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="5star2" name="tech_support_stars" value="2" 
                                                                           /><label class="full" for="5star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="5star1half" name="tech_support_stars" value="1.5" 
                                                                           /><label class="half" for="5star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="5star1" name="tech_support_stars" value="1" 
                                                                           /><label class="full" for="5star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="5starhalf" name="tech_support_stars" value="0.5" 
                                                                           /><label class="half" for="5starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-12 px-2 d-grid">
                                                               <div class="form-group mb-4 h-100">
                                                                  <textarea class="form-control shadow-none" placeholder="Your Coaching experience could help others.." rows="3" style="height: 150px;" name="description" required id="description_id"></textarea>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="row justify-content-end bg-light px-3 pt-3 pb-3 border-top rounded">
                                                            <div class="col-auto">
                                                               @if(session()->has('student'))
                                                               <button type="submit" class="btn btn-sm btn-green border-0  rounded-pill py-2 px-md-4 px-3"><span>Submit</span></button>
                                                               @else
                                                               <a href="javascript:;" class="btn btn-green border-0 rounded-pill py-2 px-4" data-toggle="modal" data-target="#exampleModal1"><span>Submit</span></a>
                                                               @endif
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        
                        <div class="row mt-4 d-none" id="after_edit_btn_clicked">
                           <div class="col-md-12">
                              <div class="row">
                                 <form action="{{ action('Website\CoachingController@student_review') }}" method="post" onSubmit="return is_stars_selected1()">
                                 @csrf
                                  @if(!empty(session()->has('student')))
                                  
                                   @else
                                   <a data-toggle="modal" data-target="#exampleModal1" class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                                   @endif
                                    <input type="hidden" name="coaching_id" value="{{$coaching->id}}">
                                       
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-12">
                                             <div class="card shadow reviewsses">
                                                <div class="col-12 card-header fs-16 text-left bg-secondary text-white">
                                                   <div class="row align-items-center justify-content-between">
                                                      <div class="col-auto fs-17 text-uppercase">Leave a Review</div>
                                                      <div class="col-8">
                                                         <div class="row">
                                                            <div class="col">
                                                               <div class="review_select_box w-100">
                                                                  <select name="course" id="exam" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" placeholder="" required>
                                                                     <option value="" selected="">Courses </option>
                                                                     
                                                                     @if( !empty($coaching->courses_for_reviews) )
                                                                        @foreach($coaching->courses_for_reviews as $course )
                                                                           <option value="{{$course->name}}"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->course == $course->name)
                                                                                    selected
                                                                                 @endif
                                                                              @endif

                                                                           >{{$course->name}}</option>
                                                                        @endforeach
                                                                     @endif

                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <div class="col">
                                                               <div class="review_select_box w-100">
                                                                  <select name="duration" id="city" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" placeholder="" required>
                                                                     <option value="" selected="">Duration of the Course</option>
                                                                    <option value="< 3 Months"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->duration == '< 3 Months')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >< 3 Months</option>
                                                                     <option value="3-6 Months"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->duration == '3-6 Months')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >3-6 Months</option>
                                                                     <option value="6-12 Months"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->duration == '6-12 Months')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >6-12 Months</option>
                                                                     <option value="> 12 Months"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->duration == '> 12 Months')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >> 12 Months</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <div class="col">
                                                               <div class="review_select_box w-100">
                                                                  <select name="year" id="city" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" placeholder="" required>
                                                                     <option value="" selected="">Year of Study </option>
                                                                     @foreach(range(date('Y'), 2021) as $year)
                                                                        <option value="{{$year}}" 
                                                                           @if( !empty($coaching->my_review) )
                                                                              @if($coaching->my_review->year == $year)
                                                                                 selected
                                                                              @endif
                                                                           @endif
                                                                        >{{$year}}</option>
                                                                     @endforeach
                                                                     <option value="2020"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2020')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2020</option>
                                                                     <option value="2019"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2019')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2019</option>
                                                                     <option value="2018"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2018')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2018</option>
                                                                     <option value="2017"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2017')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2017</option>
                                                                     <option value="2016"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2016')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2016</option>
                                                                     <option value="2015"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2015')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2015</option>
                                                                     <option value="2014"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2014')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2014</option>
                                                                     <option value="2013"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2013')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2013</option>
                                                                     <option value="2012"
                                                                        @if( !empty($coaching->my_review) )
                                                                           @if($coaching->my_review->year == '2012')
                                                                              selected
                                                                           @endif
                                                                        @endif
                                                                     >2012</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="card-body p-0">
                                                   <div class="row mx-0">
                                                      <div class="col-12">
                                                         <div class="row pt-4 mx-0">
                                                            <div class="col-12">
                                                               <div class="row">
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto">
                                                                        <i class="fas fa-graduation-cap"></i></span>
                                                                        <strong class="fs-14">Faculty</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="star5" name="faculty_stars" value="5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="star4half" name="faculty_stars" value="4.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '4.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="star4" name="faculty_stars" value="4" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '4')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="star3half" name="faculty_stars" value="3.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '3.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="star3" name="faculty_stars" value="3" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '3')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="star2half" name="faculty_stars" value="2.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '2.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="star2" name="faculty_stars" value="2" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '2')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="star1half" name="faculty_stars" value="1.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '1.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="star1" name="faculty_stars" value="1" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '1')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="starhalf" name="faculty_stars" value="0.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->faculty_stars == '0.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fas fa-books"></i></span>
                                                                        <strong class="fs-14">Study Material</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="2star5" name="study_materials_stars" value="5"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="2star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="2star4half" name="study_materials_stars" value="4.5"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '4.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="2star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="2star4" name="study_materials_stars" value="4"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '4')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="2star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="2star3half" name="study_materials_stars" value="3.5"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '3.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="2star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="2star3" name="study_materials_stars" value="3"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '3')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="2star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="2star2half" name="study_materials_stars" value="2.5"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '2.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="2star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="2star2" name="study_materials_stars" value="2"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '2')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="2star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="2star1half" name="study_materials_stars" value="1.5"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '1.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="2star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="2star1" name="study_materials_stars" value="1"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '1')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="2star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="2starhalf" name="study_materials_stars" value="0.5"
                                                                              
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->study_materials_stars == '0.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="2starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto">
                                                                        <i class="fas fa-lightbulb"></i></span>
                                                                        <strong class="fs-14">Doubt Clearing</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="3star5" name="doubt_clearing_stars" value="5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="3star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="3star4half" name="doubt_clearing_stars" value="4.5"
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '4.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif
 
                                                                           /><label class="half" for="3star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="3star4" name="doubt_clearing_stars" value="4"
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '4')
                                                                                    checked
                                                                                 @endif
                                                                              @endif
 
                                                                           /><label class="full" for="3star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="3star3half" name="doubt_clearing_stars" value="3.5"
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '3.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif
 
                                                                           /><label class="half" for="3star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="3star3" name="doubt_clearing_stars" value="3" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '3')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="3star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="3star2half" name="doubt_clearing_stars" value="2.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '2.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="3star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="3star2" name="doubt_clearing_stars" value="2"
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '2')
                                                                                    checked
                                                                                 @endif
                                                                              @endif
 
                                                                           /><label class="full" for="3star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="3star1half" name="doubt_clearing_stars" value="1.5"
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '1.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif
 
                                                                           /><label class="half" for="3star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="3star1" name="doubt_clearing_stars" value="1" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '1')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="3star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="3starhalf" name="doubt_clearing_stars" value="0.5" 
                                                                                    
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->doubt_clearing_stars == '0.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="3starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fad fa-chalkboard"></i></span>
                                                                        <strong class="fs-14">Mentorship & Teaching Style</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="4star5" name="mentorship_stars" value="5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="4star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="4star4half" name="mentorship_stars" value="4.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '4.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="4star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="4star4" name="mentorship_stars" value="4" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '4')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="4star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="4star3half" name="mentorship_stars" value="3.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '3.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="4star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="4star3" name="mentorship_stars" value="3" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '3')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="4star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="4star2half" name="mentorship_stars" value="2.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '2.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="4star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="4star2" name="mentorship_stars" value="2" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '2')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="4star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="4star1half" name="mentorship_stars" value="1.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '1.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="4star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="4star1" name="mentorship_stars" value="1" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '1')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="4star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="4starhalf" name="mentorship_stars" value="0.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->mentorship_stars == '0.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="4starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fad fa-user-headset"></i></span>
                                                                        <strong class="fs-14">Tech Support</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio"  id="5star5" name="tech_support_stars" value="5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="5star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio"  id="5star4half" name="tech_support_stars" value="4.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '4.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="5star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio"  id="5star4" name="tech_support_stars" value="4" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '4')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="5star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio"  id="5star3half" name="tech_support_stars" value="3.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '3.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="5star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio"  id="5star3" name="tech_support_stars" value="3" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '3')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="5star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio"  id="5star2half" name="tech_support_stars" value="2.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '2.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="5star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio"  id="5star2" name="tech_support_stars" value="2" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '2')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="5star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio"  id="5star1half" name="tech_support_stars" value="1.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '1.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="5star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio"  id="5star1" name="tech_support_stars" value="1" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '1')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="full" for="5star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio"  id="5starhalf" name="tech_support_stars" value="0.5" 
                                                                           
                                                                              @if( !empty($coaching->my_review) )
                                                                                 @if($coaching->my_review->tech_support_stars == '0.5')
                                                                                    checked
                                                                                 @endif
                                                                              @endif

                                                                           /><label class="half" for="5starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-12 px-2 d-grid">
                                                               <div class="form-group mb-4 h-100">
                                                                  <textarea class="form-control shadow-none" placeholder="Your Coaching experience could help others.." rows="3" style="height: 150px;" name="description" required id="description_id1">@if( !empty($coaching->my_review) ){{ $coaching->my_review->description }}@endif</textarea>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="row justify-content-end bg-light px-3 pt-3 pb-3 border-top rounded">
                                                            <div class="col-auto">
                                                               @if(session()->has('student'))
                                                               <button type="submit" class="btn btn-green border-0 rounded-pill py-2 px-4"><span>Submit</span></button>
                                                               @else
                                                               <a href="javascript:;" class="btn btn-green border-0 rounded-pill py-2 px-4" data-toggle="modal" data-target="#exampleModal1"><span>Submit</span></a>
                                                               @endif
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        @else
                        <p ><strong>You have already given a Review</strong></p>
                        @endif
                         @if(session()->has('student'))

                           @if( !empty($coaching->all_my_reviews) )
                           @foreach($coaching->all_my_reviews as $review)
                                 <div class="row mt-5">
                                    <div class="col-12 mt-4">
                                       <div class="shadow rounded bg-secondary p-1 position-relative">
                                          <div class="px-4 pb-4 pt-5 border rounded bg-white position-relative">
                                             <div class="row coments_single align-items-center position-absolute top-n15px bg-white right-30px">
                                                <div class="col-auto px-1">
                                                   @if($review->status=='disable')
                                                   <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="rounded border h-24px py-1 px-2 text-center fs-16 text-secondary"><i class="fal fa-ellipsis-h-alt"></i></a>
                                                   <div class="dropdown-menu bg-light shadow" aria-labelledby="dropdownMenuButton" style="">
                                                     
                                                      <ul class="list-unstyled mb-0 pl-0">
                                                         <li><a class="px-2 fs-12 bg-success rounded-top" href="#after_edit_btn_clicked" onclick="edit_my_review()"><i class="fas fa-edit mr-2"></i>Edit</a></li>
                                                         <li>
                                                                                 
                                                         @php
                                                            $url = action('Website\CoachingController@delete_student_review', 'coaching_id=' . $coaching->id);
                                                            $msg = 'Are you sure?';

                                                            $onclick = 'delete_sweet_alert("'.$url.'", "'.$msg.'")';
                                                         @endphp

                                                         <a class="px-2 fs-12 bg-primary border-0 rounded-bottom" 
                                                         onclick='{{$onclick}}' href="#"><i class="fas fa-trash-alt mr-2"></i>Delete</a></li>
                                                      </ul>
                                                      
                                                   </div>
                                                   @endif
                                                </div>
                                             </div>
                                             <div class="row align-items-center position-absolute top-n40px bg-white">
                                                <div class="col-auto pr-0">
                                                   <span class="d-flex align-items-center w-70px h-70px justify-content-center border rounded-pill p-0"><img class="img-fluid rounded-pill h-60px border shadow" src="{{$review->image}}" alt="{{ basename($review->image) }}"></span>
                                                </div>
                                                <div class="col">
                                                   <a class="text-primary d-block fs-18 font-weight-bold" href="javascript:;">{{$review->student_name}}</a>
                                                   <span class="fs-12 text-gray text-uppercase">{{ date('F d, Y', strtotime($review->date)) }}</span>
                                                   <span class="fs-11 bg-primary text-white px-2 py-1 rounded ml-2"><i class="fas fa-star mr-1"></i>{{$review->total_ratings}}</span>
                                                </div>
                                             </div>
                                             <p class="fs-md-15 fs-14 mb-0 text-justify">{{$review->description}}</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                  @endforeach
                           @endif
                        @endif


                        @if( !empty($coaching->reviews->take(3)) )
                           @foreach($coaching->reviews->take(3) as $review)
                              @if(session()->has('student') and $review->user_id == session()->get('student')->id)
                                 @continue
                              @endif
                              <div class="row mt-5">
                                 <div class="col-12 mt-4">
                                    <div class="shadow rounded bg-secondary p-1 position-relative">
                                       <div class="px-md-4 px-3 pb-md-4 pb-3 pt-md-5 pt-4 border rounded bg-white position-relative">
                                          <div class="row coments_single align-items-center position-absolute top-n15px bg-white right-30px">
                                          </div>
                                          <div class="row align-items-center position-absolute top-n40px bg-white">
                                             <div class="col-auto pr-0">
                                                <span class="d-flex align-items-center w-md-70px w-55px h-md-70px h-55px justify-content-center border rounded-pill p-0"><img class="img-fluid rounded-pill h-md-60px h-45px border shadow" src="{{$review->image}}" alt="{{ basename($review->image) }}"></span>
                                             </div>
                                             <div class="col">
                                                <a class="text-primary d-block fs-md-18 fs-15 font-weight-bold" href="javascript:;">{{$review->student_name}}</a>
                                                <span class="fs-12 text-gray text-uppercase"> {{ date('F d, Y', strtotime($review->date)) }}</span>
                                                <span class="fs-11 bg-primary text-white px-2 py-1 rounded ml-2"><i class="fas fa-star mr-1"></i>{{$review->total_ratings}}</span>
                                             </div>
                                          </div>
                                          <p class="fs-md-15 fs-13 mb-0 text-justify">{{$review->description}}</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
                        @endif
                        
                        @if($coaching->reviews->count() >= 4)
                        <div class="seemore col-12 text-center mt-md-4 mt-3 pt-md-3">
                           <a href="{{ action('Website\CoachingController@reviews', $coaching->coaching_name_slug) }}" class="btn fs-13 px-2 py-1 rounded-pill btn-sm btn-outline-primary btn-primary text-white">See More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  
                  @if( !empty($coaching->branch) and !empty($coaching->branches_in_same_center) and !empty($coaching->branches_in_same_center->toArray()) )
                  <div class="row align-items-center mt-3 mx-0 pt-2 shadow border py-md-4 py-3 px-mx-3 px-2">
                     <div class="col-md-auto text-gray fs-md-18 fs-14 mb-md-0 mb-2">
                        <i class="fad fa-school"></i>
                        <span class="font-weight-bold">Centers in {{$coaching->branch->center_name}}</span>
                     </div>
                     <div class="col-sm"> 
                        @foreach($coaching->branches_in_same_center as $branch)
                           <a href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug, str_replace('.', '-', str_replace(' ', '-', $branch->name) ) ]) }}" class="fs-md-18 fs-13 font-weight-bold">{{$branch->name}}</a> 
                           @if( $loop->last )
                           @else
                            |
                           @endif
                        @endforeach

                     </div>
                  </div>
                  @endif

                  <!-- AD  -->
                  <section id="parents_review" class="parents_review add_box">
                     <div class="container-fluid">
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
                                       src="{{ asset('public/coaching/' . $logo_link->image) }}" 
                                       alt="{{ basename( asset('public/coaching/' . $logo_link->image) ) }}"
                                       onerror="this.src='<?php echo asset('public/logo.png'); ?>'"
                                       >
                                       </a>
                                 </div>
                                  @php
                                    $iii += 1;
                                 @endphp
                                 @endforeach
                              @endif
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- AD  -->
                  <div class="row mx-0">
                     <div class="col-12 mb-0 mt-md-5 mt-0">
                        @if( !empty( $header->advertisement('full') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('full')->url
                           }}" onclick="clickCounter('<?php echo $header->advertisement('full')->id?>')"
                           target="_blank"
                        >
                        <img 
                           class="img-fluid shadow rounded border"
                           src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                           alt="{{ basename( asset('public/' . $header->advertisement('full')->image) ) }}"
                        >
                        </a>
                     @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- get offer section  -->
</main>
 <div class="modal fade know_more_modal" id="know_more_modal_id" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
               <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                  <h5 class="modal-title text-left" id="exampleModalLabel">Get Free Counselling</h5>
                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                  <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                  </button>
               </div>
               <div class="modal-body persnol-details counselling-page">
                 <div class="rounded bg-light shadow p-3">
                     <div class="py-4 px-4 rounded bg-white">
                        <h2 class="fs-20 text-uppercase font-weight-bold text-primary text-center">- Request a Callback -</h2>
                        <form class=" mt-4" method="post" action="{{ action('Website\IndexController@requestcallback') }}">
                           @csrf
                           <div class="input-group-overlay form-group mb-4">
                              <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                              </div>
                              <input type="text" name="name" id="fullname" class="form-control bg-light" placeholder="Name" required="">
                              <input type="hidden" name="coaching_id" class="form-control bg-light" value="{{ $coaching->id }}" >
                              <input type="hidden" name="coaching_name" class="form-control bg-light" value="{{ $coaching->name }}" >
                           </div>
                           <div class="input-group-overlay form-group mb-4">
                              <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                              </div>
                              <input class="form-control bg-light prepended-form-control" type="email" name="email" placeholder="Email" required="required">
                           </div>
                           <div class="input-group-overlay form-group mb-4">
                              <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                              </div>
                              <input class="form-control bg-light prepended-form-control" placeholder="Mobile Number" required="required" type="tel" name="mobile"  onkeypress="return isNumberKey(event)" 
                                    pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid mobile number" minlength="10" maxlength="10">
                           </div>
                           <div class="input-group-overlay form-group mb-4">
                              <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                              </div>
                              <input class="form-control bg-light prepended-form-control" type="text" placeholder="City" required="required" name="city">
                           </div>
                           <div class="input-group-overlay form-group">
                               <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-users-class"></i></span>
                              </div>
                              <select name="class" id="Class" title="Class" class="form-control prepended-form-control selectpicker w-100 show-tick padd_minus" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="Class">
                                 <option value="" >Class</option>
                                 <option value="< V"> < V </option>
                                 <option value="VI-VIII">VI-VIII</option>
                                 <option value="IX">IX</option>
                                 <option value="X">X</option>
                                 <option value="XI">XI</option>
                                 <option value="XII">XII</option>
                                 <option value=">XII">>XII</option>
                              </select>
                           </div>
                           <button class="btn btn-primary btn-block mt-4" type="submit" >Submit</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<script type="text/javascript">
   $(document).ready(function () {
    $(".load_more_outer").slice(0, 3).show();
    var i=1;
    $(".load-more11").on("click", function (e) {
      var ttlvideos= $('#total_videos').val();
      var ttlcount= Math.floor(ttlvideos/3);
      e.preventDefault();
      $(".load_more_outer:hidden").slice(0, 3).slideDown();
      if ($(".load_more_outer:hidden").length == 0) {
      }
      if(ttlcount==i){
         $('.seevideoss').hide();
      }
      i++;
    });
  });
</script>
<script>
   $('#add_to_favorite').click(
      function() {
         var is_favorite = $('#add_to_favorite').hasClass('active');

         $.ajax({
            url: '{{ action("Website\CoachingController@add_to_favorite", $coaching->id) }}',

            success: function(data) {
               if(data == 1) {
                  
                  if(is_favorite) {
                     $('#add_to_favorite').removeClass('text-dark active');
                     $('#add_to_favorite').addClass('text-white');
                     $('#add_to_favorite_icon').removeClass('text-dark');
                     $('#add_to_favorite_icon').addClass('text-white');
                     $('#add_to_fav_status').text('Add to Favourites');
                  } else {
                     $('#add_to_favorite').addClass('text-dark active');
                     $('#add_to_favorite').removeClass('text-white');
                     $('#add_to_favorite_icon').addClass('text-dark');
                     $('#add_to_favorite_icon').removeClass('text-white');
                     $('#add_to_fav_status').text('Remove from Favourites');
                  }

               } else {
                  swal.fire({
                     title: 'Alert',
                     'text': 'Unable to add favorite. Please login to proceed.'
                  });
               }
            }
         });
      }
   );
</script>

<!-- reviews -->

<script>
   $(document).on('click', '.stars', function() {
      
      $('.stars').removeClass('text-warning');

      for(var i = 1; i <= $(this).data('id'); i++) {
         $('[data-id='+ i +']').addClass('text-warning');
      }

      $('input[name="stars"]').attr('value', $(this).data('id'));
      $('input[name="stars"]').val($(this).data('id'));

   });
</script>

<script>
   function is_stars_selected() {
      var faculty_stars = $("input[type=radio][name=faculty_stars]:checked").val();
      var study_materials_stars = $("input[type=radio][name=study_materials_stars]:checked").val();
      var doubt_clearing_stars = $("input[type=radio][name=doubt_clearing_stars]:checked").val();
      var mentorship_stars = $("input[type=radio][name=mentorship_stars]:checked").val();
      var tech_support_stars = $("input[type=radio][name=tech_support_stars]:checked").val();
      if(faculty_stars==undefined || faculty_stars==''){
             swal.fire({
            'title': 'Alert!',
            'text': 'Please choose faculty'
         });
         return false;
      }
      if(study_materials_stars==undefined || study_materials_stars==''){
             swal.fire({
            'title': 'Alert!',
            'text': 'Please choose Study Material'
         });
         return false;
      }
      if(doubt_clearing_stars==undefined || doubt_clearing_stars==''){
             swal.fire({
            'title': 'Alert!',
            'text': 'Please choose Doubt Clearing'
         });
         return false;
      }

      if(mentorship_stars==undefined || mentorship_stars==''){
             swal.fire({
            'title': 'Alert!',
            'text': 'Please choose Infrastructure'
         });
         return false;
      }
      if(tech_support_stars==undefined || tech_support_stars==''){
             swal.fire({
            'title': 'Alert!',
            'text': 'Please choose tech support'
         });
         return false;
      }

      var txt = $('textarea#description_id').val();
       count = txt == '' ? 0 : txt.split(' ');
       if(count.length>0){
         for (var i = 0; i < count.length; i++) {
            if(count[i].length>=30){
               swal.fire({
               title: 'Alert',
               'text': 'Description less than 30 character in per word'
               });
               return false;
            }
         }
      }
      if(txt.length < 160) {
         swal.fire({
         title: 'Alert',
         'text': 'Description greater than 160 character'
         });
         return false;
      }
      return true;
   }
</script>


<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle", function() {
         
         var elem = $(this).text();
         var id = $(this).attr('id');
         if (elem == "Read More") {
            $(this).text("Read Less");
            $("#read_more-"+id).slideDown();
         } else {
            $(this).text("Read More");
            $("#read_more-"+id).slideUp();
         }
         $(this).parent().parent().children('.p_text').toggleClass('fixed_container');
      });
   });
</script>

<!-- payment gateway -->
<script>
   function payment_modal(coaching_courses_detail_id, name, targeting, duration, fee) {
       var coaching_name= $('#coachingname_id'+coaching_courses_detail_id).val();
      $('#payment_modal_div #coaching_courses_detail_id').val(coaching_courses_detail_id);
      $('#payment_modal_div #coaching_name_id2').text(coaching_name);
      $('#payment_modal_div #course_name').text(name);
      $('#payment_modal_div #targeting').text(targeting);
      $('#payment_modal_div #duration').text(duration);
      $('#payment_modal_div #amount').text(fee);

      $('#payment_modal_div #subtotal_amount').text(fee);
      $('#payment_modal_div #total_amount').text(fee);

      $('#payment_modal').modal('show');
   }

   function send_otp_on_email(element) {

      if($(element).text() == 'Get OTP') {
         $(element).text('Resend OTP');
      }

      $('#payment_modal #email_or_mobile').val('email');

      var email = $('#payment_modal #email').val();

      $.ajax({
            url: '{{ action("Website\OrderController@otp") }}',
            data: {
               email,
            },
            success: function(data) {

               if(data == 1) {
                  $('#otp_sent_msg').removeClass('d-none');                  
                  $('#otp_sent_msg').text('OTP Sent');                
               }

            }
         });
   
      $('.otp_div').removeClass('d-none');
   }

   function send_otp_on_mobile(element) {

      if($(element).text() == 'Get OTP') {
         $(element).text('Resend OTP');
      }

      $('#payment_modal #email_or_mobile').val('mobile');

      var mobile = $('#payment_modal #mobile').val();

      $.ajax({
            url: '{{ action("Website\OrderController@otp") }}',
            data: {
               mobile,
            },
            success: function(data) {

               if(data == 1) {
                  $('#otp_sent_msg').removeClass('d-none');                    
                  $('#otp_sent_msg').text('OTP Sent');              
               }

               $('#payment_modal input[name="otp_digits[]"]').each(
                  function() {
                     $(this).val('');
                  }
               ); 

            }
         });
   
      $('.otp_div').removeClass('d-none');
   }

   $('#payment_modal input[name="otp_digits[]"]').keyup(
      function() {

         var otp = '';
         
         $('#payment_modal input[name="otp_digits[]"]').each(
            function() {
               otp += $(this).val();
            }
         );

         if(otp.length == 4) {
            
            $.ajax({
               url: '{{ action("Website\OrderController@otp_verify") }}',
               data: {
                  otp
               },
               success: function(data) {

                  if(data == 1) {
                     $('#otp_sent_msg').text('Verified');      
           
                     $('#payment_modal input[name="otp_digits[]"]').each(
                        function() {
                           $(this).val('');
                        }
                     );     
                     
                     var email_or_mobile = $('#payment_modal #email_or_mobile');

                     email_or_mobile = email_or_mobile.val();

                     $('#payment_modal #' + email_or_mobile).prop('readonly', true);
                     
                     $('#payment_modal #' + email_or_mobile + '_prepend').addClass('d-none');

                     $('#payment_modal #is_' + email_or_mobile + '_verified').val('yes');
                     $('.otp_div').addClass('d-none');
                  } else {
                     $('#otp_sent_msg').text('Invalid OTP');                 
                  }

               }
            });

         }
      }
   );

   $('#payment_form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
         e.preventDefault();
         return false;
      }
   });

   $('#payment_form').on('submit', function(e) {
      
      var is_mobile_verified = $('#payment_modal #is_mobile_verified').val()
      var is_email_verified = $('#payment_modal #is_email_verified').val()

      if(
         is_mobile_verified == 'yes' 
      ) {
         return true;
      } else {

         Swal.fire('Please verify mobile first');

         return false;
      }

      if(
         is_email_verified == 'yes' 
      ) {
         return true;
      } else {
         
         Swal.fire('Please verify email first');

         return false;
      }

   });

</script>
<!-- payment gateway -->

<script>
   function payment_modal1(coaching_courses_detail_id, name, targeting, duration, fee,registration_fee) {
       var coaching_name= $('#coachingname_id'+coaching_courses_detail_id).val();
      $('#payment_modal_div1 #coaching_courses_detail_id1').val(coaching_courses_detail_id);
     
      $('#payment_modal_div1 #course_name1').text(name);
      $('#payment_modal_div1 #coaching_name_id1').text(coaching_name);
      $('#payment_modal_div1 #targeting1').text(targeting);
      $('#payment_modal_div1 #duration1').text(duration);
      $('#payment_modal_div1 #amount1').text(fee);
      var remaining_fees= fee-registration_fee;
      $('#payment_modal_div1 #subtotal_amount1').text(registration_fee);
      $('#payment_modal_div1 #registration_fee_id').val(registration_fee);
      $('#payment_modal_div1 #total_amount1').text(remaining_fees);
      $('#payment_modal_div1 #remaining_fee_id').val(remaining_fees);

      $('#payment_modal1').modal('show');
   }

   function send_otp_on_email1(element) {

      if($(element).text() == 'Get OTP') {
         $(element).text('Resend OTP');
      }
      //  else {         
      //    $(element).text('Get OTP');
      // }

      $('#payment_modal1 #email_or_mobile1').val('email');

      var email = $('#payment_modal1 #email1').val();

      $.ajax({
            url: '{{ action("Website\OrderController@otp") }}',
            data: {
               email,
            },
            success: function(data) {

               if(data == 1) {
                  $('#otp_sent_msg1').removeClass('d-none');                  
                  $('#otp_sent_msg1').text('OTP Sent');                
               }

            }
         });
   
      $('.otp_div1').removeClass('d-none');
   }

   function send_otp_on_mobile1(element) {

      if($(element).text() == 'Get OTP') {
         $(element).text('Resend OTP');
      }

      $('#payment_modal1 #email_or_mobile1').val('mobile');

      var mobile = $('#payment_modal1 #mobile1').val();

      $.ajax({
            url: '{{ action("Website\OrderController@otp") }}',
            data: {
               mobile,
            },
            success: function(data) {

               if(data == 1) {
                  $('#otp_sent_msg1').removeClass('d-none');                    
                  $('#otp_sent_msg1').text('OTP Sent');              
               }

               $('#payment_modal1 input[name="otp_digits[]"]').each(
                  function() {
                     $(this).val('');
                  }
               ); 

            }
         });
   
      $('.otp_div1').removeClass('d-none');
   }

   $('#payment_modal1 input[name="otp_digits[]"]').keyup(
      function() {

         var otp = '';
         
         $('#payment_modal1 input[name="otp_digits[]"]').each(
            function() {
               otp += $(this).val();
            }
         );

         if(otp.length == 4) {
            
            $.ajax({
               url: '{{ action("Website\OrderController@otp_verify") }}',
               data: {
                  otp
               },
               success: function(data) {

                  if(data == 1) {
                     $('#otp_sent_msg1').text('Verified');      
           
                     $('#payment_modal1 input[name="otp_digits[]"]').each(
                        function() {
                           $(this).val('');
                        }
                     );     
                     
                     var email_or_mobile = $('#payment_modal1 #email_or_mobile1');

                     email_or_mobile = email_or_mobile.val();

                     $('#payment_modal1 #' + email_or_mobile).prop('readonly', true);
                     
                     $('#payment_modal1 #' + email_or_mobile + '_prepend1').addClass('d-none');

                     $('#payment_modal1 #is_' + email_or_mobile + '_verified1').val('yes');

                     $('.otp_div1').addClass('d-none');
                  } else {
                     $('#otp_sent_msg1').text('Invalid OTP');                 
                  }

               }
            });

         }
      }
   );

   $('#payment_form1').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
         e.preventDefault();
         return false;
      }
   });

   $('#payment_form1').on('submit', function(e) {
      
      var is_mobile_verified = $('#payment_modal1 #is_mobile_verified1').val()
      var is_email_verified = $('#payment_modal1 #is_email_verified1').val()

      if(
         is_mobile_verified == 'yes' 
      ) {
         return true;
      } else {

         Swal.fire('Please verify mobile first');

         return false;
      }

      if(
         is_email_verified == 'yes' 
      ) {
         return true;
      } else {
         
         Swal.fire('Please verify email first');

         return false;
      }

   });

</script>

<!-- google location -->

<?php
/*
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=geometry&key={{ config('app.GOOGLE_MAPS_API_KEY') }}"></script>
*/
?>

<script type="text/javascript">

    $(document).ready(
        function() {
            showlocation();
        }
    );

   function showlocation() {
      if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(getLocation, getError);
      }
      else{
            result.innerHTML = "Not Support"
      }
   }

   function getLocation(location){

            console.log(location)
            
            $latitude = location.coords.latitude;
            $longitude = location.coords.longitude;
            
            distance($latitude, $longitude);
            
   }
   
    function getError(error){
        alert(error.message);
        console.log(error.message)
    }

   function distance($latitude, $longitude) {

      // user
      var latitude1 = $latitude;
      var longitude1 = $longitude;

      // coaching
      @if( !empty($coaching->branch) )
         var latitude2 = {{$coaching->branch->latitude ?? 0}};
         var longitude2 = {{$coaching->branch->longitude ?? 0}};
      @else
         var latitude2 = {{$coaching->latitude ?? 0}};
         var longitude2 = {{$coaching->longitude ?? 0}};
      @endif
      
      // latitude1 = 26.8437601;
      // longitude1 = 75.8175392;
      
      // latitude2 = 28.5935649;
      // longitude2 = 77.3188016;

      // console.log(Number(latitude1), Number(longitude1), Number(latitude2), Number(longitude2));
      
      var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(Number(parseFloat(latitude1)), Number(parseFloat(longitude1))), new google.maps.LatLng(Number(parseFloat(latitude2)), Number(parseFloat(longitude2)))); 
 
      distance = (distance / 1000).toFixed(2);
 
      if(latitude2 == 0 && longitude2 == 0) {
         $('#km_will_show_here').text('Something Went Wrong');
      } else {
         $('#km_will_show_here').text(distance + ' km');
      }

   }
</script>


<script>
   function edit_my_review() {
      $('#after_edit_btn_clicked').removeClass('d-none');
      $('#before_edit_btn_clicked').remove();
   }
</script>

<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle1", function() {
         var elem = $(this).text();
         if (elem == "Read More") {
            $(this).text("Read Less");
         } else {
            $(this).text("Read More");
         }

         $(this).parent().parent().children(':first-child').toggleClass('ellipsis-2', 500);
      });

   });
</script>

<script>
   $(document).on('submit', 'form', function() {
      if(! $(this).valid() )
         return false;
   });
</script>
@include('website/layouts/footer')