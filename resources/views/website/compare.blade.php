@include('website/layouts/header')
<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner">
      <div class="container position-relative z-index-2">
         <div class="text-left">
            <h1 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">
               Compare - Best Coaching Institute   
            </h1>
            <h2 class="text-white fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-15 fs-14 mb-lg-3 mb-md-2 mb-2">
               Compare Coachings based on its Courses, Facilities, Faculties, Centers, Reviews and Know More..   
            </h2>
         </div>
         <nav aria-label="breadcrumb text-left">
            <ol class="breadcrumb text-left mb-0 justify-content-start">
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14"><a class="text-white font-weight-bold " href="{{ action('Website\IndexController@index') }}">Home</a></li>
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14 active text-white" aria-current="page">Compare</li>
            </ol>
         </nav>
      </div>
   </section>
   <!-- inner banner section  -->
   <!-- collages_compare section  -->
   <section id="collages_compare" class="collages_compare">
      <div class="container">
         <div class="row">
            <div class="col-lg-2 d-flex justify-content-center mb-lg-0 mb-md-4 mb-3">
               <div class="bg-primary courses_box flex-wrap py-4 px-3 w-100 rounded shadow text-center justify-content-center d-flex align-items-center">
                  <div class="main_heading text-center">
                     <h2 class="w-100 fs-16 mb-4 position-relative">
                        <img class="img-fluid mb-3 h-50px" src="{{ asset('public/website/assets/img/compares.png') }}" alt="">
                     </h2>
                     <p class="mb-0 fs-13 text-white">
                        Compare your <br> Coaching / Tutor
                     </p>
                     <h2 class="w-100 fs-16 mt-2 position-relative">
                        <img class="img-fluid mb-3 h-80px" src="{{ asset('public/website/assets/img/site_logo.png') }}" alt="">
                     </h2>
                  </div>
               </div>
            </div>
            <div class="col-sm pr-md-3 pr-1 compare_box_witdh d-flex align-items-stretch mb-md-0 mb-3">
               <div class="w-100 single_collages_box courses_box bg-white shadow rounded p-md-4 p-3 d-flex align-items-center justify-content-center">
                  <div class="w-100 sinlge_collage_detail text-center position-relative">
                     @if( !empty($coachings[0]['name']) )
                     <button type="button" class="close position-absolute right-0px top-0px text-secondary" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="far fa-times text-secondary "></i></span>
                     </button>
                     @endif
                     <span class="d-flex align-items-center m-auto rounded-pill p-1 border justify-content-center w-md-80px w-50px h-md-80px h-50px">
                     <img 
                     class="img-fluid h-md-65px h-100 rounded-pill" 
                     @if( !empty($coachings[0]['image']) )
                     src="{{ asset('public/coaching/'. $coachings[0]['image'] ?? '') }}"
                     @else
                     src=""
                     @endif
                     alt=""
                     onerror="this.src='<?php echo asset('public/logo.png'); ?>'"
                     >
                     </span>
                     <h2 class="fs-lg-15 fs-md-14 fs-12 font-weight-bold text-secondary text-capitalize mt-md-3 mt-2 mb-md-2 mb-1">      
                        @if( !empty($coachings[0]['name']) )
                        {{ ucwords($coachings[0]['name']) ?? 'Add Coaching to Compare' }}
                        @else 
                        Add Coaching to Compare
                        @endif
                     </h2>
                     <strong class="d-none text-primary fs-14 font-weight-normal">
                     @if( !empty($coachings[0]['details']) and !empty($coachings[0]['details']->city) and !empty($coachings[0]['details']->state) )
                     <i class="fas fa-map-marked-alt mr-2"></i>{{ $coachings[0]['details']->city ?? '' }}, {{ $coachings[0]['details']->state ?? '' }}
                     @else
                     - 
                     @endif
                     </strong>
                     <div class="find_coaching mt-3 position-relative">
                        <form 
                           action="{{ action('Website\CoachingCompareController@compare') }}"
                           id="compare"   
                           >
                        <input 
                        type="text" 
                        name="coachings[]"
                        @if( !empty($coachings[0]['name']) )
                        value="{{ ucwords($coachings[0]['name']) ?? '' }}"
                        @endif
                        class="shadow coachings" placeholder="Find Coaching">
                        <input type="submit" value="">
                        <form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm pl-md-3 pl-1 compare_box_witdh d-flex align-items-stretch mb-md-0 mb-3">
               <div class="w-100 single_collages_box courses_box bg-white shadow rounded p-md-4 p-3 d-flex align-items-center justify-content-center">
                  <div class="w-100 sinlge_collage_detail text-center position-relative">
                     @if( !empty($coachings[1]['name']) )
                     <button type="button" class="close position-absolute right-0px top-0px text-secondary" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="far fa-times text-secondary "></i></span>
                     </button>
                     @endif
                     <span class="d-flex align-items-center m-auto rounded-pill p-1 border justify-content-center w-md-80px w-50px h-md-80px h-50px">
                     <img 
                     class="img-fluid h-md-65px h-100 rounded-pill" 
                     @if( !empty($coachings[1]['image']) )
                     src="{{ asset('public/coaching/'. $coachings[1]['image'] ?? '') }}"
                     @else
                     src=""
                     @endif
                     alt=""
                     onerror="this.src='<?php echo asset('public/logo.png'); ?>'"
                     >
                     </span>
                     <h2 class="fs-lg-15 fs-md-14 fs-12 font-weight-bold text-secondary text-capitalize mt-md-3 mt-2 mb-md-2 mb-1">      
                        @if( !empty($coachings[1]['name']) )
                        {{ ucwords($coachings[1]['name']) ?? 'Add Coaching to Compare' }}
                        @else 
                        Add Coaching to Compare
                        @endif
                     </h2>
                     <strong class="d-none text-primary fs-14 font-weight-normal"> 
                     @if( !empty($coachings[1]['details']) and !empty($coachings[1]['details']->city) and !empty($coachings[1]['details']->state) )
                     <i class="fas fa-map-marked-alt mr-2"></i>{{ $coachings[1]['details']->city ?? '' }}, {{ $coachings[1]['details']->state ?? '' }}
                     @else
                     - 
                     @endif
                     </strong>
                     <div class="find_coaching mt-3 position-relative">
                          
                        <input 
                        type="text" 
                        name="coachings[]"
                        form="compare"
                        @if( !empty($coachings[1]['name']) )
                        value="{{ ucwords($coachings[1]['name']) ?? '' }}"
                        @endif
                        class="shadow coachings" placeholder="Find Coaching">
                        <input type="submit" value="" 
                           form="compare">
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm d-lg-flex align-items-stretch mb-md-0 mb-3 d-none">
               <div class="w-100 single_collages_box courses_box bg-white shadow rounded p-md-4 p-3 d-flex align-items-center justify-content-center">
                  <div class="w-100 sinlge_collage_detail text-center position-relative">
                     @if( !empty($coachings[2]['name']) )
                     <button type="button" class="close position-absolute right-0px top-0px text-secondary" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="far fa-times text-secondary "></i></span>
                     </button>
                     @endif
                     <span class="d-flex align-items-center m-auto rounded-pill p-1 border justify-content-center w-md-80px w-50px h-md-80px h-50px">
                     <img 
                     class="img-fluid h-md-65px h-100 rounded-pill" 
                     @if( !empty($coachings[2]['image']) )
                     src="{{ asset('public/coaching/'. $coachings[2]['image'] ?? '') }}"
                     @else
                     src=""
                     @endif
                     alt=""
                     onerror="this.src='<?php echo asset('public/logo.png'); ?>'"
                     >
                     </span>
                     <h2 class="fs-lg-15 fs-md-14 fs-12 font-weight-bold text-secondary text-capitalize mt-md-3 mt-2 mb-md-2 mb-1">      
                        @if( !empty($coachings[2]['name']) )
                        {{ ucwords($coachings[2]['name']) ?? 'Add Coaching to Compare' }}
                        @else 
                        Add Coaching to Compare
                        @endif
                     </h2>
                     <strong class="d-none text-primary fs-14 font-weight-normal"> 
                     @if( !empty($coachings[2]['details']) and !empty($coachings[2]['details']->city) and !empty($coachings[2]['details']->state) )
                     <i class="fas fa-map-marked-alt mr-2"></i>{{ $coachings[2]['details']->city ?? '' }}, {{ $coachings[2]['details']->state ?? '' }}
                     @else
                     - 
                     @endif
                     </strong>
                     <div class="find_coaching mt-3 position-relative">
                        {{--
                        <form action="{{ action('Website\CoachingCompareController@compare') }}">
                        --}}
                        <input 
                        type="text" 
                        name="coachings[]"
                        form="compare"
                        @if( !empty($coachings[2]['name']) )
                        value="{{ ucwords($coachings[2]['name']) ?? '' }}"
                        @endif
                        class="shadow coachings" placeholder="Find Coaching">
                        <input type="submit" value="" 
                           form="compare">
                        {{--
                        <form>
                        --}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mx-0 mt-4 position-relative d-lg-block d-none">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">
                              Coaching Type 
                           </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex align-items-stretch ">
                           <div class="w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                              Offerings <i class="fs-18 fas fa-caret-right"></i>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[0]['details']) )
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$coachings[0]['details']->offering}}
                              </div>
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($coachings[1]['details']) )
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$coachings[1]['details']->offering}}
                              </div>
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[2]['details']) )
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$coachings[2]['details']->offering}}
                              </div>
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 d-none">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">Courses Offered </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex align-items-stretch ">
                           <div class="w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                              Courses <i class="fs-18 fas fa-caret-right"></i>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                             @if( !empty($coachings[0]['courses']) )
                              @foreach( $coachings[0]['courses'] as $course => $courses_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$course}}
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($coachings[1]['courses']) )
                              @foreach( $coachings[1]['courses'] as $course => $courses_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$course}}
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[2]['courses']) )
                              @foreach( $coachings[2]['courses'] as $course => $courses_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$course}}
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">Coaching Details </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex flex-wrap align-items-stretch ">
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                                 Established Year <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                                 Branches <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                                 Faculty Student Ratio <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                                 Scholarships <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-2 d-flex align-items-center justify-content-between">
                                 Super Speciality <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                                 Branch Intake <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                                 Average Fees <i class="fs-18 fas fa-caret-right"></i>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->est_yr) )
                                 {{ $coachings[0]['details']->est_yr }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->number_of_branches) )
                                 {{ $coachings[0]['details']->number_of_branches }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->faculty_student_ratio) )
                                 {{ $coachings[0]['details']->faculty_student_ratio }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->scholarship) )
                                 @if($coachings[0]['details']->scholarship_type == 'per')
                                 @else
                                 ₹
                                 @endif
                                 {{ $coachings[0]['details']->scholarship }} 
                                 @if($coachings[0]['details']->scholarship_type == 'per')
                                 %
                                 @else
                                 @endif
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->super_specialty) )
                                 {{ $coachings[0]['details']->super_specialty }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->batch_size) )
                                 {{ $coachings[0]['details']->batch_size }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[0]['details']->avg_fees) )
                                 {{ $coachings[0]['details']->avg_fees }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->est_yr) )
                                 {{ $coachings[1]['details']->est_yr }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->number_of_branches) )
                                 {{ $coachings[1]['details']->number_of_branches }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->faculty_student_ratio) )
                                 {{ $coachings[1]['details']->faculty_student_ratio }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->scholarship) )
                                 @if($coachings[1]['details']->scholarship_type == 'per')
                                 @else
                                 ₹
                                 @endif
                                 {{ $coachings[1]['details']->scholarship }} 
                                 @if($coachings[1]['details']->scholarship_type == 'per')
                                 %
                                 @else
                                 @endif
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->super_specialty) )
                                 {{ $coachings[1]['details']->super_specialty }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->batch_size) )
                                 {{ $coachings[1]['details']->batch_size }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[1]['details']->avg_fees) )
                                 {{ $coachings[1]['details']->avg_fees }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->est_yr) )
                                 {{ $coachings[2]['details']->est_yr }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->number_of_branches) )
                                 {{ $coachings[2]['details']->number_of_branches }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->faculty_student_ratio) )
                                 {{ $coachings[2]['details']->faculty_student_ratio }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->scholarship) )
                                 @if($coachings[2]['details']->scholarship_type == 'per')
                                 @else
                                 ₹
                                 @endif
                                 {{ $coachings[2]['details']->scholarship }} 
                                 @if($coachings[2]['details']->scholarship_type == 'per')
                                 %
                                 @else
                                 @endif
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->super_specialty) )
                                 {{ $coachings[2]['details']->super_specialty }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->batch_size) )
                                 {{ $coachings[2]['details']->batch_size }}
                                 @else
                                 -
                                 @endif
                              </div>
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 @if( !empty($coachings[2]['details']->avg_fees) )
                                 {{ $coachings[2]['details']->avg_fees }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">Available Courses </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex align-items-stretch ">
                           <div class="w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                              Courses <i class="fs-18 fas fa-caret-right"></i>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[0]['courses']) )
                              @foreach( $coachings[0]['courses'] as $course => $courses_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 <a href="{{ action('Website\CoachingController@courses', str_replace(' ', '-', $coachings[0]['details']->name)) }}">
                                 {{$course}}
                                 </a>
                                 - {{ count($courses_detail) }} 
                                 @if( count($courses_detail) == 1 )
                                 course
                                 @else
                                 courses
                                 @endif
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($coachings[1]['courses']) )
                              @foreach( $coachings[1]['courses'] as $course => $courses_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 <a href="{{ action('Website\CoachingController@courses', str_replace(' ', '-', $coachings[1]['details']->name)) }}">
                                 {{$course}}
                                 </a>
                                 - {{ count($courses_detail) }} 
                                 @if( count($courses_detail) == 1 )
                                 course
                                 @else
                                 courses
                                 @endif
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[2]['courses']) )
                              @foreach( $coachings[2]['courses'] as $course => $courses_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 <a href="{{ action('Website\CoachingController@courses', str_replace(' ', '-', $coachings[2]['details']->name)) }}">
                                 {{$course}}
                                 </a>
                                 - {{ count($courses_detail) }} 
                                 @if( count($courses_detail) == 1 )
                                 course
                                 @else
                                 courses
                                 @endif
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">Coaching Facilities </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex flex-wrap align-items-stretch ">
                           @if( !empty($facilitys->toArray()) )
                           @foreach( $facilitys as $facility)
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 p-0 d-flex align-items-center justify-content-between" >
                                 {{ $facility->name }} 
                                 {!! $facility->image !!}
                              </div>
                           </div>
                           @endforeach
                           @else
                           <div class="row w-100 mx-0">
                              <div class="col-12 w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 p-0 d-flex align-items-center justify-content-center" >
                                 Not Available
                              </div>
                           </div>
                           @endif
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($facilitys->toArray()) )
                              @foreach( $facilitys as $facility)
                              @if( !empty($coachings[0]['details']->id) )   
                              <!-- this facility belogs to this coaching -->
                              @if( !empty($coachings[0]['details']->id) and in_array($facility->name, $coachings[0]['facility']) )
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize text-primary"><i class="fas fa-check"></i></div>
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize"><i class="fas fa-times"></i></div>
                              @endif                                          
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">-</div>
                              @endif
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($facilitys->toArray()) )
                              @foreach( $facilitys as $facility)
                              @if( !empty($coachings[1]['details']->id) )   
                              <!-- this facility belogs to this coaching -->
                              @if( !empty($coachings[1]['details']->id) and in_array($facility->name, $coachings[1]['facility']) )
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize text-primary"><i class="fas fa-check"></i></div>
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize"><i class="fas fa-times"></i></div>
                              @endif
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">-</div>
                              @endif
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($facilitys->toArray()) )
                              @foreach( $facilitys as $facility)
                              @if( !empty($coachings[2]['details']->id) )   
                              <!-- this facility belogs to this coaching -->
                              @if( !empty($coachings[2]['details']->id) and in_array($facility->name, $coachings[2]['facility']) )
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize text-primary"><i class="fas fa-check"></i></div>
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize"><i class="fas fa-times"></i></div>
                              @endif
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">-</div>
                              @endif
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">Esteem Mentors </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex align-items-stretch ">
                           <div class="w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                              Faculties <i class="fs-18 fas fa-caret-right"></i>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[0]['faculty']) )
                              <div class="p-3 col-12 text-center fs-14">
                                 {{
                                 $coachings[0]['faculty']
                                 }}
                              </div>
                              @else
                              <div class="p-3 col-12 text-center fs-14">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($coachings[1]['faculty']) )
                              <div class="p-3 col-12 text-center fs-14">
                                 {{
                                 $coachings[1]['faculty']
                                 }}
                              </div>
                              @else
                              <div class="p-3 col-12 text-center fs-14">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[2]['faculty']) )
                              <div class="p-3 col-12 text-center fs-14">
                                 {{
                                 $coachings[2]['faculty']
                                 }}
                              </div>
                              @else
                              <div class="p-3 col-12 text-center fs-14">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">Center Locations </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex align-items-stretch ">
                           <div class="w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                              Centers <i class="fs-18 fas fa-caret-right"></i>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[0]['centers']) )
                              @foreach( $coachings[0]['centers'] as $course => $centers_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$course}} - {{ count($centers_detail) }} 
                                 @if( count($centers_detail) == 1 )
                                 center
                                 @else
                                 centers
                                 @endif
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($coachings[1]['centers']) )
                              @foreach( $coachings[1]['centers'] as $course => $centers_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$course}} - {{ count($centers_detail) }} 
                                 @if( count($centers_detail) == 1 )
                                 center
                                 @else
                                 centers
                                 @endif
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[2]['centers']) )
                              @foreach( $coachings[2]['centers'] as $course => $centers_detail)
                              <div class="p-3 col-12 text-center border-bottom fs-14 text-capitalize">
                                 {{$course}} - {{ count($centers_detail) }} 
                                 @if( count($centers_detail) == 1 )
                                 center
                                 @else
                                 centers
                                 @endif
                              </div>
                              @endforeach
                              @else
                              <div class="p-3 col-12 text-center fs-14">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row border-left border-right bg-secondary align-items-center">
                        <div class="col-md-12">
                           <div class="p-lg-3 p-md-2 p-2 text-left d-flex align-items-center justify-content-between font-weight-bold fs-lg-18 fs-md-16 fs-15">
                              Coaching Reviews 
                           </div>
                        </div>
                     </div>
                     <div class="row border-left border-right bg-light">
                        <div class="col-md-2 col-auto px-0 w-100 d-flex align-items-stretch ">
                           <div class="w-100 px-3 bg-primary font-weight-bold fs-lg-14 fs-md-12 fs-12 py-3 d-flex align-items-center justify-content-between">
                              Student Reviews <i class="fs-18 fas fa-caret-right"></i>
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[0]['total_ratings']) )                                    
                              <div class="p-3 mt-2 col-12 text-center border-bottom fs-14">
                                 <div class="mb-2 mb-2">
                                    @for($i = 1; $i <= (int) $coachings[0]['total_ratings']; $i++)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>
                                    @endfor
                                    @if($coachings[0]['total_ratings'] == 5)
                                    ;
                                    @else
                                    @php
                                    $remaining_stars = (5 - $coachings[0]['total_ratings'])
                                    @endphp
                                    <?php 
                                       $half_star = ($remaining_stars - (int) $remaining_stars);
                                       ?>
                                    @if($half_star > 0)
                                    @for($i = $half_star; $i <= $half_star; $i += $half_star)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star-half"></i>
                                    </a>
                                    @endfor
                                    @endif
                                    @for($i = 1; $i <= (int) $remaining_stars; $i++)
                                    <a class="text-white fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>                                          
                                    @endfor
                                    @endif
                                 </div>
                                 <span class="d-inline-flex rounded fs-12 justify-content-center align-items-center bg-primary py-1 px-2"> 
                                 {{ $coachings[0]['total_ratings'] }}/5
                                 </span>
                              </div>
                              @else
                              <div class="p-3 mt-2 col-12 text-center fs-14">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="col border-left border-right">
                           <div class="row">
                              @if( !empty($coachings[1]['total_ratings']) )
                              <div class="p-3 mt-2 col-12 text-center border-bottom fs-14">
                                 <div class="mb-2 mb-2">
                                    @for($i = 1; $i <= (int) $coachings[1]['total_ratings']; $i++)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>
                                    @endfor
                                    @if($coachings[1]['total_ratings'] == 5)
                                    ;
                                    @else
                                    @php
                                    $remaining_stars = (5 - $coachings[1]['total_ratings'])
                                    @endphp
                                    <?php 
                                       $half_star = ($remaining_stars - (int) $remaining_stars);
                                       ?>
                                    @if($half_star > 0)
                                    @for($i = $half_star; $i <= $half_star; $i += $half_star)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star-half"></i>
                                    </a>
                                    @endfor
                                    @endif
                                    @for($i = 1; $i <= (int) $remaining_stars; $i++)
                                    <a class="text-white fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>                                          
                                    @endfor
                                    @endif
                                 </div>
                                 <span class="d-inline-flex rounded fs-12 justify-content-center align-items-center bg-primary py-1 px-2"> 
                                 {{ $coachings[1]['total_ratings'] }}/5
                                 </span>
                              </div>
                              @else
                              <div class="p-3 mt-2 col-12 text-center fs-14">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="col-sm ">
                           <div class="row">
                              @if( !empty($coachings[2]['total_ratings']) )
                              <div class="p-3 mt-2 col-12 text-center border-bottom fs-14">
                                 <div class="mb-2 mb-2">
                                    @for($i = 1; $i <= (int) $coachings[2]['total_ratings']; $i++)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>
                                    @endfor
                                    @if($coachings[2]['total_ratings'] == 5)
                                    ;
                                    @else
                                    @php
                                    $remaining_stars = (5 - $coachings[2]['total_ratings'])
                                    @endphp
                                    <?php 
                                       $half_star = ($remaining_stars - (int) $remaining_stars);
                                       ?>
                                    @if($half_star > 0)
                                    @for($i = $half_star; $i <= $half_star; $i += $half_star)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star-half"></i>
                                    </a>
                                    @endfor
                                    @endif
                                    @for($i = 1; $i <= (int) $remaining_stars; $i++)
                                    <a class="text-white fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>                                          
                                    @endfor
                                    @endif
                                 </div>
                                 <span class="d-inline-flex rounded fs-12 justify-content-center align-items-center bg-primary py-1 px-2"> 
                                 {{ $coachings[2]['total_ratings'] }}/5
                                 </span>
                              </div>
                              @else
                              <div class="p-3 mt-2 col-12 text-center fs-14">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 download_btn_div">
                     <div class="row bg-secondary rounded-bottom py-3">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                           <p class="fs-14 mb-0">
                           </p>
                           <a
                              onclick="saveAspdf()"
                              class="btn fs-14 btn-green comparision_btn border-0 rounded-pill"><span><span class="spinner d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Download</span></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="mobile_part mt-md-4 mt-2 d-lg-none d-block">
            <div class="row rounded shadow mx-0 overflow-hidden">
               <div class="col-12">
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary rounded-top">
                              <div class=" w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                  Coaching Type 
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Offerings
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              @if( !empty($coachings[0]['details']) )
                              <div class="p-2 text-center fs-12 text-capitalize">{{$coachings[0]['details']->offering}}</div>
                              @else
                              <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>

                           <div class="col-6 border-bottom">

                             @if( !empty($coachings[1]['details']) )
                              <div class="p-2 text-center fs-12 text-capitalize">{{$coachings[1]['details']->offering}}</div>
                              @else
                              <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif

                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary">
                              <div class="w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                 Coaching Details
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Established Year  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize"> 
                                 @if( !empty($coachings[0]['details']->est_yr) )
                                 {{ $coachings[0]['details']->est_yr }}
                                 @else
                                 -
                                 @endif</div>
                           </div>

                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[1]['details']->est_yr) )
                                 {{ $coachings[1]['details']->est_yr }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>

                        </div>

                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Branches  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                  @if( !empty($coachings[0]['details']->number_of_branches) )
                                 {{ $coachings[0]['details']->number_of_branches }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                  @if( !empty($coachings[1]['details']->number_of_branches) )
                                 {{ $coachings[1]['details']->number_of_branches }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Faculty Student Ratio  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[0]['details']->faculty_student_ratio) )
                                 {{ $coachings[0]['details']->faculty_student_ratio }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                  @if( !empty($coachings[1]['details']->faculty_student_ratio) )
                                 {{ $coachings[1]['details']->faculty_student_ratio }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Scholarships  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[0]['details']->scholarship) )
                                 @if($coachings[0]['details']->scholarship_type == 'per')
                                 @else
                                 ₹
                                 @endif
                                 {{ $coachings[0]['details']->scholarship }} 
                                 @if($coachings[0]['details']->scholarship_type == 'per')
                                 %
                                 @else
                                 @endif
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[1]['details']->scholarship) )
                                 @if($coachings[1]['details']->scholarship_type == 'per')
                                 @else
                                 ₹
                                 @endif
                                 {{ $coachings[1]['details']->scholarship }} 
                                 @if($coachings[1]['details']->scholarship_type == 'per')
                                 %
                                 @else
                                 @endif
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Super Speciality  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                  @if( !empty($coachings[0]['details']->super_specialty) )
                                 {{ $coachings[0]['details']->super_specialty }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[1]['details']->super_specialty) )
                                 {{ $coachings[1]['details']->super_specialty }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Branch Intake  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                  @if( !empty($coachings[0]['details']->batch_size) )
                                 {{ $coachings[0]['details']->batch_size }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                  @if( !empty($coachings[1]['details']->batch_size) )
                                 {{ $coachings[1]['details']->batch_size }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Average Fees  
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[0]['details']->avg_fees) )
                                 {{ $coachings[0]['details']->avg_fees }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                           <div class="col-6 border-bottom">
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 @if( !empty($coachings[1]['details']->avg_fees) )
                                 {{ $coachings[1]['details']->avg_fees }}
                                 @else
                                 -
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary">
                              <div class="w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                Available Courses 
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Courses
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                               @if( !empty($coachings[0]['courses']) )
                              @foreach( $coachings[0]['courses'] as $course => $courses_detail)
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 <a href="{{ action('Website\CoachingController@courses', str_replace(' ', '-', $coachings[0]['details']->name)) }}">
                                 {{$course}}
                                 </a>
                                 - {{ count($courses_detail) }} 
                                 @if( count($courses_detail) == 1 )
                                 course
                                 @else
                                 courses
                                 @endif
                              </div>
                              @endforeach
                              @else
                               <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                             
                           </div>

                           <div class="col-6 border-bottom">
                               @if( !empty($coachings[1]['courses']) )
                              @foreach( $coachings[1]['courses'] as $course => $courses_detail)
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 <a href="{{ action('Website\CoachingController@courses', str_replace(' ', '-', $coachings[0]['details']->name)) }}">
                                 {{$course}}
                                 </a>
                                 - {{ count($courses_detail) }} 
                                 @if( count($courses_detail) == 1 )
                                 course
                                 @else
                                 courses
                                 @endif
                              </div>
                              @endforeach
                              @else
                               <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary">
                              <div class="w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                 Coaching Facilities  
                              </div>
                           </div>
                        </div>
                        <div class="row">
                            @if( !empty($facilitys->toArray()) )
                           @foreach( $facilitys as $facility)
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start mr_facility">
                                  {!! $facility->image !!}
                                 {{ $facility->name }} 
                                
                              </div>
                           </div>

                           <div class="col-6 border-bottom border-right">
                               @if( !empty($coachings[0]['details']->id) )   
                              <!-- this facility belogs to this coaching -->
                              @if( !empty($coachings[0]['details']->id) and in_array($facility->name, $coachings[0]['facility']) )
                              <div class="p-2 text-center fs-12 text-capitalize text-primary">
                                 <i class="fas fa-check"></i>
                              </div>
                               @else
                               <div class="p-2 text-center fs-12 text-capitalize text-black">
                                 <i class="fas fa-times"></i>
                              </div>
                               @endif                                          
                              @else
                                 <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>
                           <div class="col-6 border-bottom">
                               @if( !empty($coachings[1]['details']->id) )   
                              <!-- this facility belogs to this coaching -->
                              @if( !empty($coachings[1]['details']->id) and in_array($facility->name, $coachings[1]['facility']) )
                               <div class="p-2 text-center fs-12 text-capitalize text-primary">
                                 <i class="fas fa-check"></i>
                              </div>
                              @else
                               <div class="p-2 text-center fs-12 text-capitalize text-black">
                                 <i class="fas fa-times"></i>
                              </div>
                               @endif                                          
                              @else
                                 <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>
                            @endforeach
                           @else
                            <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 <i class="fas fa-book mr-2"></i> 
                                  Not Available
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary">
                              <div class="w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                 Esteem Mentors  
                              </div>
                           </div>
                        </div>
                        <div class="row">

                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Faculties
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                               @if( !empty($coachings[0]['faculty']) )
                              <div class="p-2 text-center fs-12 text-capitalize">{{
                                 $coachings[0]['faculty']
                                 }}
                              </div>
                              @else
                               <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>
                           <div class="col-6 border-bottom">
                              @if( !empty($coachings[1]['faculty']) )
                              <div class="p-2 text-center fs-12 text-capitalize">{{
                                 $coachings[1]['faculty']
                                 }}</div>
                                 @else
                              <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary">
                              <div class="w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                 Center Locations   
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Centers
                              </div>
                           </div>
                           <div class="col-6 border-bottom border-right">
                               @if( !empty($coachings[0]['centers']) )
                              @foreach( $coachings[0]['centers'] as $course => $centers_detail)
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 {{$course}} - {{ count($centers_detail) }} 
                                 @if( count($centers_detail) == 1 )
                                 center
                                 @else
                                 centers
                                 @endif
                              </div>
                               @endforeach
                              @else
                              <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>
                           <div class="col-6 border-bottom">
                              @if( !empty($coachings[1]['centers']) )
                              @foreach( $coachings[1]['centers'] as $course => $centers_detail)
                              <div class="p-2 text-center fs-12 text-capitalize">
                                 {{$course}} - {{ count($centers_detail) }} 
                                 @if( count($centers_detail) == 1 )
                                 center
                                 @else
                                 centers
                                 @endif
                              </div>
                               @endforeach
                              @else
                              <div class="p-2 text-center fs-12 text-capitalize">-</div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="row">
                           <div class="col-12 bg-secondary">
                              <div class="w-100 py-2 fs-md-14 fs-13 d-flex align-items-center justify-content-between font-weight-bold">
                                 Coaching Reviews   
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 border-bottom">
                              <div class="w-100 text-primary font-weight-bold fs-md-13 fs-12 py-2 d-flex align-items-center justify-content-start">
                                 Student Reviews
                              </div>
                           </div>
                           <div class="col-6 border-right">
                               @if( !empty($coachings[0]['total_ratings']) )
                              <div class="p-2 col-12 text-center fs-md-14 fs-12">
                                 <div class="mb-2 mb-2">
                                      @for($i = 1; $i <= (int) $coachings[0]['total_ratings']; $i++)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>
                                    @endfor
                                    @if($coachings[0]['total_ratings'] == 5)
                                    ;
                                    @else
                                    @php
                                    $remaining_stars = (5 - $coachings[0]['total_ratings'])
                                    @endphp
                                    <?php 
                                       $half_star = ($remaining_stars - (int) $remaining_stars);
                                       ?>
                                    @if($half_star > 0)
                                    @for($i = $half_star; $i <= $half_star; $i += $half_star)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star-half"></i>
                                    </a>
                                    @endfor
                                    @endif
                                    @for($i = 1; $i <= (int) $remaining_stars; $i++)
                                    <a class="text-white fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>                                          
                                    @endfor
                                    @endif                                      
                                 </div>
                                 <span class="d-inline-flex rounded fs-md-12 fs-10 justify-content-center align-items-center bg-primary py-1 px-2"> 
                                 {{ $coachings[0]['total_ratings'] }}/5
                                 </span>
                              </div>
                               @else
                              <div class="p-2 col-12 text-center fs-md-14 fs-12">
                                 -
                              </div>
                              @endif
                           </div>
                           <div class="col-6">
                               @if( !empty($coachings[1]['total_ratings']) )
                              <div class="p-2 col-12 text-center fs-md-14 fs-12">
                                 <div class="mb-2 mb-2">
                                      @for($i = 1; $i <= (int) $coachings[1]['total_ratings']; $i++)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>
                                    @endfor
                                    @if($coachings[1]['total_ratings'] == 5)
                                    ;
                                    @else
                                    @php
                                    $remaining_stars = (5 - $coachings[1]['total_ratings'])
                                    @endphp
                                    <?php 
                                       $half_star = ($remaining_stars - (int) $remaining_stars);
                                       ?>
                                    @if($half_star > 0)
                                    @for($i = $half_star; $i <= $half_star; $i += $half_star)
                                    <a class="text-secondary fs-14">
                                    <i class="fas fa-star-half"></i>
                                    </a>
                                    @endfor
                                    @endif
                                    @for($i = 1; $i <= (int) $remaining_stars; $i++)
                                    <a class="text-white fs-14">
                                    <i class="fas fa-star"></i>
                                    </a>                                          
                                    @endfor
                                    @endif                                       
                                 </div>
                                 <span class="d-inline-flex rounded fs-md-12 fs-10 justify-content-center align-items-center bg-primary py-1 px-2"> 
                                 {{ $coachings[1]['total_ratings'] }}/5
                                 </span>
                              </div>
                               @else
                              <div class="p-2 col-12 text-center fs-md-14 fs-12">
                                 -
                              </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row download_btn_div">
                     <div class="col-12"> 
                        <div class="row bg-secondary rounded-bottom py-md-3 py-3">
                           <div class="col-md-12 d-flex justify-content-center align-items-center">
                              <p class="fs-14 mb-0">
                              </p>
                              <a onclick="saveAspdf()" class="btn btn-sm fs-md-12 fs-11 btn-green comparision_btn border-0 rounded-pill"><span><span class="spinner d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Download</span></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- collages_compare section  -->
</main>
<!-- jquery autocomplete -->
<script>
   $(function() {
      var coachings = [];
      
      @if( !empty($coaching_search_autocomplete) )
         @php
            $i = 0;
         @endphp
   
         @foreach($coaching_search_autocomplete as $coaching)
   
            coachings[{{$i}}] = "<?php echo $coaching; ?>";
   
            @php
               $i += 1;
            @endphp
         @endforeach
      @endif
   
      $( ".coachings" ).autocomplete({
         source: coachings,
         select: function (e, ui) {
   
            setTimeout(() => {
                  
               $('#compare').submit();
            }, 300);
         },
      });         
   
      $('.ui-helper-hidden-accessible').remove();
      $('ul.ui-autocomplete').css(
         'z-index', '10000000000000'
      );
   });
</script>
<script>
   $(document).on('click', '.close', function() {
      
      $(this).parent().find('.coachings').val('');
      
      $('#compare').submit();
   });
</script>
<script src="{{ asset('public/website/assets/html2pdf.bundle.min.js') }}"></script>
<script type="text/javascript">
   function saveAspdf(){
       
       $('.download_btn_div').hide();

       $('.spinner').removeClass('d-none');
       
      var modalscorecardshtml= $("#collages_compare").html();
            html2pdf()
              .from(modalscorecardshtml)
              .save();
              
       $('.download_btn_div').show();
       
       $('.spinner').addClass('d-none');
    }
   
</script>
@include('website/layouts/footer')