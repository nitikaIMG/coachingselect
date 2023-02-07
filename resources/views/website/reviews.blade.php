@include('website/layouts/header')

<style>

   .img-responsive{
      height: 100%;
   }
 .bac_color{
      background: white !important;
   }
   .btn-dds:hover{
      color:#000000  !important;
   }
   .link-a{
      cursor: pointer;
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

                  if(! @GetImageSize($image) ) {
                     $image = asset('public/logo.png');
                  }
               @endphp

               <img class="w-100 h-100 rounded-pill" src="{{ $image }}" alt="">

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
               <div class="row shadow mx-0 px-3 py-3 bg-white rounded">
                  <div class="d-flex tab_offer align-items-center col border-0 justify-content-start">
                     <a href="{{ action('Website\CoachingController@overview', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right rounded-left border-0">Overview</a>
                     <a href="{{ action('Website\CoachingController@courses', $coaching->coaching_name_slug) }}"class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Course</a>
                     <a href="{{ action('Website\CoachingController@team', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Team</a>
                     <a href="{{ action('Website\CoachingController@results', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Results</a>
                     <a href="{{ action('Website\CoachingController@gallery', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Gallery</a>
                     <a class="active-tab text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0  rounded-right">Reviews</a>
                  </div>
               </div>
               <div class="overview_section mt-md-5 mt-4">
                  
                  <div id="review_sec" class="row mx-0 mt-4">
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
                                                                           <input type="radio" required id="star5" name="faculty_stars" value="5" 
                                                                           /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio" required id="star4half" name="faculty_stars" value="4.5" 
                                                                           /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio" required id="star4" name="faculty_stars" value="4" 
                                                                           /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio" required id="star3half" name="faculty_stars" value="3.5" 
                                                                           /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio" required id="star3" name="faculty_stars" value="3" 
                                                                           /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio" required id="star2half" name="faculty_stars" value="2.5" 
                                                                           /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio" required id="star2" name="faculty_stars" value="2" 
                                                                           /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio" required id="star1half" name="faculty_stars" value="1.5"
                                                                           /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio" required id="star1" name="faculty_stars" value="1" 
                                                                           /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio" required id="starhalf" name="faculty_stars" value="0.5"
                                                                           /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fas fa-books"></i></span>
                                                                        <strong class="fs-14">Study Material</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio" required id="2star5" name="study_materials_stars" value="5"
                                                                           /><label class="full" for="2star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio" required id="2star4half" name="study_materials_stars" value="4.5"
                                                                           /><label class="half" for="2star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio" required id="2star4" name="study_materials_stars" value="4"
                                                                           /><label class="full" for="2star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio" required id="2star3half" name="study_materials_stars" value="3.5"
                                                                           /><label class="half" for="2star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio" required id="2star3" name="study_materials_stars" value="3"
                                                                           /><label class="full" for="2star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio" required id="2star2half" name="study_materials_stars" value="2.5"
                                                                           /><label class="half" for="2star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio" required id="2star2" name="study_materials_stars" value="2"
                                                                           /><label class="full" for="2star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio" required id="2star1half" name="study_materials_stars" value="1.5"
                                                                           /><label class="half" for="2star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio" required id="2star1" name="study_materials_stars" value="1"
                                                                           /><label class="full" for="2star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio" required id="2starhalf" name="study_materials_stars" value="0.5"
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
                                                                           <input type="radio" required id="3star5" name="doubt_clearing_stars" value="5" 
                                                                           /><label class="full" for="3star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio" required id="3star4half" name="doubt_clearing_stars" value="4.5" 
                                                                           /><label class="half" for="3star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio" required id="3star4" name="doubt_clearing_stars" value="4"
                                                                           /><label class="full" for="3star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio" required id="3star3half" name="doubt_clearing_stars" value="3.5"
                                                                           /><label class="half" for="3star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio" required id="3star3" name="doubt_clearing_stars" value="3" 
                                                                           /><label class="full" for="3star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio" required id="3star2half" name="doubt_clearing_stars" value="2.5"
                                                                           /><label class="half" for="3star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio" required id="3star2" name="doubt_clearing_stars" value="2"
                                                                           /><label class="full" for="3star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio" required id="3star1half" name="doubt_clearing_stars" value="1.5"
                                                                           /><label class="half" for="3star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio" required id="3star1" name="doubt_clearing_stars" value="1" 
                                                                           /><label class="full" for="3star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio" required id="3starhalf" name="doubt_clearing_stars" value="0.5"
                                                                           /><label class="half" for="3starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fas fa-users-cog"></i></span>
                                                                        <strong class="fs-14">Infrastructure</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio" required id="4star5" name="mentorship_stars" value="5" 
                                                                           /><label class="full" for="4star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio" required id="4star4half" name="mentorship_stars" value="4.5"
                                                                           /><label class="half" for="4star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio" required id="4star4" name="mentorship_stars" value="4" 
                                                                           /><label class="full" for="4star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio" required id="4star3half" name="mentorship_stars" value="3.5"
                                                                           /><label class="half" for="4star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio" required id="4star3" name="mentorship_stars" value="3" 
                                                                           /><label class="full" for="4star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio" required id="4star2half" name="mentorship_stars" value="2.5"
                                                                           /><label class="half" for="4star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio" required id="4star2" name="mentorship_stars" value="2" 
                                                                           /><label class="full" for="4star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio" required id="4star1half" name="mentorship_stars" value="1.5"
                                                                           /><label class="half" for="4star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio" required id="4star1" name="mentorship_stars" value="1" 
                                                                           /><label class="full" for="4star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio" required id="4starhalf" name="mentorship_stars" value="0.5"
                                                                           /><label class="half" for="4starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col mb-4 d-flex align-items-stretch justify-content-center px-2">
                                                                     <div class="w-100 shadow bg-white text-center border rounded py-3 px-2 rating_review">
                                                                        <span class="h-50px w-50px mb-2 rounded-pill border shadow fs-20 d-flex align-items-center justify-content-center mx-auto"><i class="fad fa-user-headset"></i></span>
                                                                        <strong class="fs-14">Tech Support</strong>
                                                                        <fieldset class="rating_">
                                                                           <input type="radio" required id="5star5" name="tech_support_stars" value="5" 
                                                                           /><label class="full" for="5star5" title="Awesome - 5 stars"></label>
                                                                           <input type="radio" required id="5star4half" name="tech_support_stars" value="4.5" 
                                                                           /><label class="half" for="5star4half" title="Pretty good - 4.5 stars"></label>
                                                                           <input type="radio" required id="5star4" name="tech_support_stars" value="4" 
                                                                           /><label class="full" for="5star4" title="Pretty good - 4 stars"></label>
                                                                           <input type="radio" required id="5star3half" name="tech_support_stars" value="3.5" 
                                                                           /><label class="half" for="5star3half" title="Meh - 3.5 stars"></label>
                                                                           <input type="radio" required id="5star3" name="tech_support_stars" value="3" 
                                                                           /><label class="full" for="5star3" title="Meh - 3 stars"></label>
                                                                           <input type="radio" required id="5star2half" name="tech_support_stars" value="2.5" 
                                                                           /><label class="half" for="5star2half" title="Kinda bad - 2.5 stars"></label>
                                                                           <input type="radio" required id="5star2" name="tech_support_stars" value="2" 
                                                                           /><label class="full" for="5star2" title="Kinda bad - 2 stars"></label>
                                                                           <input type="radio" required id="5star1half" name="tech_support_stars" value="1.5" 
                                                                           /><label class="half" for="5star1half" title="Meh - 1.5 stars"></label>
                                                                           <input type="radio" required id="5star1" name="tech_support_stars" value="1" 
                                                                           /><label class="full" for="5star1" title="Sucks big time - 1 star"></label>
                                                                           <input type="radio" required id="5starhalf" name="tech_support_stars" value="0.5" 
                                                                           /><label class="half" for="5starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                        </fieldset>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-12 px-2 d-grid">
                                                               <div class="form-group mb-4 h-100">
                                                                  <textarea class="form-control shadow-none" placeholder="Your Coaching experience could help others" rows="3" style="height: 150px;" name="description" required id="description_id"></textarea>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="row justify-content-end bg-light px-3 pt-3 pb-3 border-top rounded">
                                                            <div class="col-auto">
                                                               @if(session()->has('student'))
                                                               <button type="submit" class="btn btn-green btn-sm border-0 rounded-pill py-2 px-4"><span>Submit</span></button>
                                                               @else
                                                               <a href="javascript:;" class="btn btn-green btn-sm border-0 rounded-pill py-2 px-4" data-toggle="modal" data-target="#exampleModal1"><span>Submit</span></a>
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
                                                               <div class="row starts_box">
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
                                                               <button type="submit" class="btn btn-green border-0 rounded-pill py-2 px-4 btn-sm"><span>Submit</span></button>
                                                               @else
                                                               <a href="javascript:;" class="btn btn-green border-0 rounded-pill py-2 px-4 btn-sm" data-toggle="modal" data-target="#exampleModal1"><span>Submit</span></a>
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
                                                   <span class="d-flex align-items-center w-70px h-70px justify-content-center border rounded-pill p-0"><img class="img-fluid rounded-pill h-60px border shadow" src="{{$review->image}}" alt=""></span>
                                                </div>
                                                <div class="col">
                                                   <a class="text-primary d-block fs-18 font-weight-bold" href="javascript:;">{{$review->student_name}}</a>
                                                   <span class="fs-12 text-gray text-uppercase">{{ date('F d, Y', strtotime($review->date)) }}</span>
                                                   <span class="fs-11 bg-primary text-white px-2 py-1 rounded ml-2"><i class="fas fa-star mr-1"></i>{{$review->total_ratings}}</span>
                                                </div>
                                             </div>
                                             <p class="fs-15 mb-0 text-justify">{{$review->description}}</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                  @endforeach
                           @endif
                        @endif
                        @if( !empty($coaching->reviews) )
                           @foreach($coaching->reviews as $review)
                              @if(session()->has('student') and $review->user_id == session()->get('student')->id)
                                 @continue
                              @endif
                              <div class="row mt-5">
                                 <div class="col-12 mt-4">
                                    <div class="shadow rounded bg-secondary p-1 position-relative">
                                       <div class="px-4 pb-4 pt-5 border rounded bg-white position-relative">
                                          <div class="row coments_single align-items-center position-absolute top-n15px bg-white right-30px">
                                          </div>
                                          <div class="row align-items-center position-absolute top-n40px bg-white">
                                             <div class="col-auto pr-0">
                                                <span class="d-flex align-items-center w-70px h-70px justify-content-center border rounded-pill p-0"><img class="img-fluid rounded-pill h-60px border shadow" src="{{$review->image}}" alt=""></span>
                                             </div>
                                             <div class="col">
                                                <a class="text-primary d-block fs-18 font-weight-bold" href="javascript:;">{{$review->student_name}}</a>
                                                <span class="fs-12 text-gray text-uppercase">{{ date('F d, Y', strtotime($review->date)) }}</span>
                                                <span class="fs-11 bg-primary text-white px-2 py-1 rounded ml-2"><i class="fas fa-star mr-1"></i>{{$review->total_ratings}}</span>
                                             </div>
                                          </div>
                                          <p class="fs-15 mb-0 text-justify">{{$review->description}}</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
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
                      $('#add_to_favorite').removeClass('bac_color');
                     $('#add_to_favorite').addClass('text-white');
                     $('#add_to_favorite_icon').removeClass('text-dark');
                     $('#add_to_favorite_icon').addClass('text-white');
                     $('#add_to_fav_status').text('Add to Favourites');
                  } else {
                     $('#add_to_favorite').addClass('text-dark active');
                      $('#add_to_favorite').addClass('bac_color');
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
        // alert();
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
<?php 
if(!empty($review)){?>

<script type="text/javascript">
   $(document).ready(function () {
      $('#after_edit_btn_clicked').removeClass('d-none');
      $('#before_edit_btn_clicked').remove();
   });
</script>
<?php 
}
?>
<script>
   function edit_my_review() {
      $('#after_edit_btn_clicked').removeClass('d-none');
      $('#before_edit_btn_clicked').remove();
   }
</script>

@include('website/layouts/footer')