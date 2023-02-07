@include('website/layouts/header')

<style>

   .img-responsive{
      height: 100%;
   }
   
.padd_minus{
   padding-left: 45px  !important;
}
.color_reddd{
   border: solid 1px red   !important;
}
.padd_minus .dropdown-menu{
   width: 22%  !important;
}

.bac_color{
   background: white !important;
}
.btn-dds:hover{
   color:#000000  !important;
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
                     <a class="active-tab text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Course</a>
                     <a href="{{ action('Website\CoachingController@team', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Team</a>
                     <a href="{{ action('Website\CoachingController@results', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Results</a>
                     <a href="{{ action('Website\CoachingController@gallery', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Gallery</a>
                     <a href="{{ action('Website\CoachingController@reviews', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0  rounded-right">Reviews</a>
                  </div>
               </div>
               <div class="overview_section mt-md-5 mt-4">
                   @if( !empty($coaching->courses->toArray()) )
                  <div class="row mt-5">
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
                                       " id="{{ str_replace(' ', '-', $course) }}-tab" data-toggle="tab" href="#{{ str_replace(' ', '-', $course) }}" role="tab" aria-controls="{{ str_replace(' ', '-', $course) }}" 
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
                                       @endif" id="{{ str_replace(' ', '-', $course) }}" role="tabpanel" aria-labelledby="courses-{{ str_replace('.', '-', str_replace(' ', '-', $course) ) }}-tab">
                                       <div class="row">
                                          @if( !empty($results) )
                                             
                                             @foreach($results as $result) 
                                             @if($result->offering !="")
                                               
                                               
                                                <div class="col-xl-4 col-lg-6 col-md-6 col-12 d-flex align-items-stretch">
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
                                                                        <div class="col-12 fs-12 font-weight-bold text-gray text-uppercase px-0 text-justify">
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
                                                                                
                                                                                    <div class="col-12 fs-11 font-weight-bold text-gray text-uppercase px-0 text-right">
                                                                                       Registration Fee-
                                                                                    </div>
                                                                                    <div class="col-12 fs-lg-25 fs-md-20 fs-17 text-dark font-weight-bold px-0 text-right">
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
                                                                                    <div class="col-12 fs-11 font-weight-bold text-gray text-uppercase px-0 text-right">
                                                                                       Registration Fee-
                                                                                    </div>
                                                                                    <div class="col-12 fs-lg-25 fs-md-20 fs-17 text-dark font-weight-bold px-0 text-right">
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
@endif
                                             @endforeach

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
                        <form class="needs-validation mt-4" method="post" action="{{ action('Website\IndexController@requestcallback') }}" onSubmit="return is_callback_selected()">
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
                              <input class="form-control bg-light prepended-form-control" type="email" name="email" placeholder="Email" required="">
                           </div>
                           <div class="input-group-overlay form-group mb-4">
                              <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                              </div>
                              <input class="form-control bg-light prepended-form-control" placeholder="Mobile Number" required type="tel" name="mobile"  onkeypress="return isNumberKey(event)" 
                                    pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid mobile number" minlength="10" maxlength="10">
                           </div>
                           <div class="input-group-overlay form-group mb-4">
                              <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                              </div>
                              <input class="form-control bg-light prepended-form-control" type="text" placeholder="City" required="" name="city">
                           </div>
                           <div class="input-group-overlay form-group">
                               <div class="input-group-prepend-overlay">
                                 <span class="input-group-text"><i class="fas fa-users-class"></i></span>
                              </div>
                              <select name="class" id="Class" title="Class" class="form-control prepended-form-control selectpicker w-100 show-tick padd_minus" data-width="auto" data-container="body" data-live-search="true" placeholder="Class">
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
      if(
         $('input[name="stars"]').attr('value')
      ) {
         return true;
      } else {

         swal.fire({
            'title': 'Alert!',
            'text': 'Please choose stars'
         });

         return false;
      }
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
      });
   });
</script>

<!-- payment gateway -->

<script>
   function payment_modal(coaching_courses_detail_id, name, targeting, duration, fee) {
      // console.log(coaching_name);
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