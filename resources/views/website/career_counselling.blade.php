@include('website/layouts/header')
@include('alert_msg')
<style>
.enroll_product_slider .owl-stage {
   display: flex;
  }
  .enroll_product_slider .owl-item {
   display: flex;
   flex: 1;
  }
  
  .enroll_product_slider .owl-item > div {
   display: flex;
   flex: 1;
  }
  
  .enroll_product_slider .owl-item > div > div {
   display: flex;
   flex: 1;
   flex-direction: column;
  }

.padd_minus .dropdown-menu{
  width: 22%  !important;
}
.color_reddd{
  border: solid 1px red   !important;
}
.background_color{
background: #CA121E;
}
.scr_des{

    overflow: auto;
    max-height: 150px;
    padding-right: 5px;

}
</style>

<!-- Modal -->
      <div class="modal fade basics_info_modal" id="payment_modal_counselling" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
               <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center border-0">
                  <h5 class="modal-title fs-16" id="staticBackdropLabel">Registration Form</h5>
                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
                     <span class="text-white" aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div 
               id="payment_modal_div_counselling"
               class="modal-body bg-secondary p-0">
                  <div class="row mx-0">
                     <div class="col-lg-6 px-0">
                        <div class="basics_modal_inner bg-white py-4 px-4 h-100 d-flex align-items-center">
                           <form 
                              id="payment_counselling_form"
                              action="{{ action('Website\CounsellingpaymentController@discount_counseling') }}" 
                              method="post" class="row" autocomplete="FALSE">
                              @csrf
                              <div class="form-group col-12">
                                 <label class="form-control-label">Student Name</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-user"></i>
                                       </span>
                                    </div>
                                    <input 
                                       required
                                       @if( session()->has('student') )
                                          value="{{ session()->get('student')->name ?? '' }}"
                                       @endif
                                       type="text" name="name" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="" placeholder="Full Name">
                                 </div>
                              </div>
                              
                              <div class="form-group col-12 custom_dropdown2">
                                 <label class="form-control-label">State Name</label>
                                 <div class="input-group ">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-user"></i>
                                       </span>
                                    </div>
                                    <select required name="parent_name" id="country_id"  class="selectpicker shadow-none h-md-50px h-40px show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="States">
                                       <option value="" disabled selected="">States </option>
                                       @if( !empty($getStates) )
                                       @foreach($getStates as $state)
                                       <option 
                                          value="{{$state->name}}"
                                       @if(!empty(session()->get('student')->state))
                                          @if(session()->get('student')->state==$state->name)
                                             selected
                                          @endif
                                       @else
                                          @if($state->name=='Rajasthan')
                                             selected
                                          @endif
                                       @endif
                                       >{{$state->name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-12">
                                 <label class="form-control-label">Email Id</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                          <i class="fas fa-envelope-open-text"></i>
                                       </span>
                                    </div>
                                    <input 
                                    required
                                       @if( session()->has('student') )
                                          value="{{ session()->get('student')->email ?? '' }}"
                                       @endif
                                    type="email" name="email" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="email" placeholder="Email Id">
                                    {{--<div 
                                    id="email_prepend"
                                    class="input-group-prepend">
                                       <button 
                                       type="button" class="search_btn border-0 btn btn-sm fs-md-14 fs-12 btn-green border-0 rounded-right"> <span class="p-2 d-flex align-items-center"
                                       onclick="send_otp_on_email1(this)">Get OTP</span></button>
                                    </div>--}}
                                 </div>
                              </div>
                              <div class="form-group col-12">
                                 <label class="form-control-label">Mobile Number</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                          <i class="fas fa-phone-volume"></i>
                                       </span>
                                    </div>

                                    <input type="hidden"
                                       name="email_or_mobile"
                                       id="email_or_mobile"                                       
                                    >
                                    
                                    <input type="hidden"
                                       name="counselling_id"
                                       id="counselling_id" 
                                       required                                      
                                    >
                                    
                                    <input type="hidden"
                                       name="is_email_verified"
                                       id="is_email_verified" 
                                       required     
                                       value="yes"                                 
                                    >
                                    
                                    <input type="hidden"
                                       name="is_mobile_verified"
                                       id="is_mobile_verified" 
                                       required                                      
                                    >

                                    <input
                                    required
                                    type="tel" name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="mobile" placeholder="Enter Mobile Number"
                                    onkeypress="return isNumberKey(event)" 
                                    pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaing 9 digit with 0-9" minlength="10" maxlength="10"
                                    
                                       @if( session()->has('student') )
                                          value="{{ session()->get('student')->mobile ?? '' }}"
                                       @endif
                                    >
                                    <div 
                                    id="mobile_prepend"
                                    class="input-group-prepend">
                                       <button 
                                       
                                       type="button" class="search_btn border-0 btn btn-sm fs-md-14 fs-12 btn-green border-0 rounded-right"> 
                                       <span 
                                       onclick="send_otp_on_mobile1(this)"
                                       class="p-2 d-flex align-items-center">Get OTP</span></button>
                                    </div>
                                 </div>
                              </div>
                              <div class="mb-3 form-group col-12 mb-0 otp_div11 d-none">
                                 <div class="d-flex align-items-center justify-contenEnter t-between">
                                    <div>
                                       <label class="form-control-label">Enter OTP</label>
                                    </div>
                                 </div>
                                 <div class="digit-group row">
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" type="text" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off">
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off">
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off">
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off">
                                    
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-contenEnter t-between">
                                    <div>
                                       <label 
                                          id="otp_sent_msg11"
                                          class="d-none my-2 text-success">Otp Sent</label>
                                    </div>
                                 </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-lg-6 bg-primary">
                        <div class="basics_modal_left py-3">
                           <div class="row align-items-center">
                              <div class="col"> 
                                 <h3 class="fs-14 mb-0" id="type_id"></h3>
                              </div>
                              <div class="col-auto d-none"> 
                                 <a href="javascript:;" data-toggle="tooltip" data-placement="top" data-original-title="Change Counselling" title="" class="text-white fs-14"><i class="far fa-sync"></i></a>
                              </div>
                           </div>
                           <div class="row bg-white rounded mx-0 mt-3 mb-2 py-3 shadow">
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fal fa-users-class"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Counselling Name :
                                    </span>
                                    <strong class="d-block fs-14" 
                                    id="counselling_name"
                                    >
                                    
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-books"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Duration :</span>
                                    <strong class="d-block fs-14"
                                    id=""
                                    >
                                    1 Session
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-money-check"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">Mode :</span>
                                    <strong class="d-block fs-14">
                                       <span
                                          id=""
                                       >
                                       Online
                                       </span>
                                    </strong>

                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-money-check"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">Fee :</span>
                                    <strong class="d-block fs-14">
                                    &#8377; 
                                       <span id="price">
                                       </span>
                                       <span id="discount_box_id">
                                       </span>
                                    </strong>
                                 </div>
                              </div>
                              
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="row align-items-center py-3 border-bottom">
                                    <div class="col-5">
                                       <span class="text-white fs-14 d-block mb-0">Amount Payable :</span>
                                    </div>
                                    <div class="col-2 text-center">
                                       <span class="text-white fs-14 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="col-5 text-right">
                                       <span class="text-white fs-14 d-block mb-0">&#8377; 
                                          <span
                                             id="subtotal_amount"
                                          >
                                          </span>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="row align-items-center py-3 border-bottom bg-white">
                                    <div class="col-5">
                                       <span class="text-primary fs-14 d-block mb-0">
                                       <!-- Total Amount : -->
                                       </span>
                                    </div>
                                    <div class="col-2 text-center">
                                       <span class="text-primary fs-14 d-block mb-0">
                                       
                                       </span>
                                    </div>
                                    <div class="col-5 text-right">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="mt-4 col-12">
                                 <button 
                                 type="submit"
                                 form="payment_counselling_form"
                                 class="btn btn-block btn-secondary h-50px align-items-center d-flex justify-content-center"><i class="fad fa-check-circle mr-1"></i>
                                    <span id="counselling_submit_btn">
                                       Proceed
                                    </span>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
             </div>
         </div>
      </div>
<main id="main">
   <section id="discount-page" class="counselling-page discount-page" style="background-image: url({{ asset('public/website') }}/assets/img/counselling.jpg);" >
      <div class="container position-relative z-index-2">
         <div class="row align-items-center">
            <div class="col-lg-7 order-lg-0 order-md-1 order-1 mt-lg-0 mt-md-4 mt-4">
               <div class="discount_heading">
                  <h1 class="fs-xl-36 fs-lg-28 fs-md-24 fs-20 font-weight-bold text-white mb-4">
                     Online Career Counselling Which helps Discover Your Perfect Career</h1>
                  <h3 class="fs-xl-20 fs-lg-18 fs-md-16 fs-15 text-white mb-lg-4 mb-md-3 mb-2"> Personalized Guidance by Experts & Support for all stakeholders in the Career roadmap</h3>
                  <h3 class="fs-xl-20 fs-lg-18 fs-md-16 fs-15 text-white mb-lg-4 mb-md-3 mb-2">Wondering how? </h3>
                  <p class="fs-md-15 fs-14 mb-0 text-white">
                  ✔ Introspection &amp; Interpersonal Counselling</p>
                   <p class="fs-md-15 fs-14 mb-0 text-white">✔ Behavioural &amp; Psychoanalytic Approach</p>
                   <p class="fs-md-15 fs-14 mb-0 text-white">✔ Right direction and correct steps towards the Road to Career Path</p>
                   <p class="fs-md-15 fs-14 mb-0 text-white">✔ Prognostications as per present Convention</p>
               </div>
            </div>
            <div class="col-lg-5">
               <div class="rounded bg-light shadow p-3">
                  <div class="py-md-4 py-3 px-md-4 px-3 rounded bg-white">
                     <h2 class="fs-md-20 fs-16 text-uppercase font-weight-bold text-primary text-center">- Request a Callback -</h2>
                     <form id="carrier_counselling" action="{{asset('/requestcallback')}}" method="post" class="needs-validation mt-4" onSubmit="return is_callback_selected()" >
                        @csrf
                        <div class="input-group-overlay form-group mb-4">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                           </div>
                           <input type="text" name="name" id="name" class="form-control bg-light" placeholder="Name" required autocomplete="off">
                        </div>
                        <div class="input-group-overlay form-group mb-4">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                           </div>
                           <input class="form-control bg-light prepended-form-control" name="email" type="email" placeholder="Email" required autocomplete="off">
                        </div>
                        <div class="input-group-overlay form-group mb-4">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                           </div>
                           <input class="form-control bg-light prepended-form-control" name="mobile"
                           autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[789][0-9]{9}" minlength="10" maxlength="10" name="mobile" type="tel" placeholder="Mobile Number" required title="Please enter a valid mobile number">
                        </div>
                        <div class="input-group-overlay form-group mb-4">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                           </div>
                           <input class="form-control bg-light prepended-form-control" name="city" type="text" placeholder="City" required autocomplete="off" >
                        </div>
                        
                          <div class="input-group-overlay form-group">
                              <div class="input-group-prepend-overlay">
                                <span class="input-group-text"><i class="fas fa-users-class"></i></span>
                             </div>
                             <select name="class" title="Class" class="form-control prepended-form-control selectpicker w-100 show-tick padd_minus" data-width="auto" data-container="body" data-live-search="true" placeholder="Class" id="class" required>
                                <option value="" disabled="">Class</option>
                                <option value="< V"> < V </option>
                                <option value="VI-VIII">VI-VIII</option>
                                <option value="IX">IX</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                                <option value="XII+">XII+</option>
                                <option value="Graduated">Graduated</option>
                             </select>
                          </div>
                         <button class="btn btn-primary btn-block mt-4" type="submit" >Submit</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="counselling_about bg-light">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6 text-left order-lg-0 order-md-1 order-1 mt-lg-0 mt-md-4 mt-4">
               <div class="text-justify">
                  <h2 class="fs-xl-30 fs-lg-26 fs-md-22 fs-18 text-secondary font-weight-bold mb-md-4 mb-3">
                     How does CoachingSelect Experts Counselling help Students?
                  </h2>
                  
                  <p class="fs-md-15 fs-14">Our process of counselling starts with the introspection of all your skills and aptitude to prognosticate accordingly which will help you in getting a blurred image of Job/business that allows
                  you to walk further towards your dream. This way you will be able to imagine the possibility of
                  reaching closer to your dreams or maybe realizing that it is not your cup of tea and opt for different
                  pathways. Future cannot be predicted or controlled but the right direction and correct steps towards
                  it ease the race for a path of life and destination become low hanging fruit comparative to those
                  who are in vague completely with shady future and ruin their education for short term
                  goals/enjoyment.</p>
                  <p class="fs-md-15 fs-14">Our way of counselling is not depending on aptitude tests which defines what to go with, instead, we do mirroring of you. For example, Children like to play more as compared to studies but why?? Have you asked this question to yourself? The reason would be the regularity in sports. There is a score
                  given by the opposing team to win the match and you need to practice hard daily to reach there, but
                  as far as studies are concerned, there are quarterly/ half-yearly/ yearly exams. Due to this pattern,
                  there is no day to day chasing which results in last moment preparations &amp; last night studies before
                  the exam. Even it is equitable as we have a nomenclature to prepare anything max 2-3 days before
                  the event.</p>
                  <p class="fs-md-15 fs-14">It is not negotiable &amp; undeniable but to agree that education is a must and enjoyed at all stages of its cycle. It needs to be prescribed how current education will help in future and why you are studying it. This way it will encourage and urge you to go in-depth instead of just aiming short term goals like scoring well in exams only.</p>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="about-img mt-5">
                  <img class="img-fluid w-100" 
                  src="{{ asset('public/website') }}/assets/img/counselling_new.jpg"
                  alt="{{ basename( asset('public/website/assets/img/counselling_new.jpg') ) }}" 
                  >
               </div>
            </div>
         </div>
      </div>
   </section>
   @if( !empty($career_counselling->toArray()) )
   <section class="enroll_product">
      <div class="container">
         <div class="group-title-index mb-md-5 mb-4">
            <h2 class="center-title">Choose your program</h2>
         </div>
         <?php $typess='Career after X';
         if(!empty($_GET['type'])){
            $typess=  $_GET['type'];
         }?>
         <nav class="mb-md-0 mb-4">
            <div class="nav mb-md-5 mb-0 nav-tabs border-0 d-inline-flex mx-auto rounded-20 shadow"  id="nav-tab" role="tablist">
               @if( !empty($career_counselling) )
                  @foreach($career_counselling as $type  => $counselling)
                     <a class="nav-link 
                        @if($typess==$type)
                           active
                        @endif
                        " 
                        data-toggle="tab"
                        title="{{$type}}"
                        id="counselling-{{ str_replace('.', '-', str_replace(' ', '-', $type) ) }}-tab" data-toggle="tab" href="#counselling-{{ str_replace('.', '-', str_replace(' ', '-', $type) ) }}" role="tab" aria-controls="counselling-{{ str_replace('.', '-', str_replace(' ', '-', $type) ) }}" 
                        @if($loop->first)
                           aria-selected="true"
                        @else
                           aria-selected="false"
                        @endif                                                   
                     >{{$type}}</a>
                  @endforeach
               @endif
            </div>
         </nav>
         <div class="tab-content" id="nav-tabContent">

            @if( !empty($career_counselling) )
               @foreach($career_counselling as $type => $counselling)
                  <div class="tab-pane fade show  
                     @if($typess==$type)
                        active
                     @endif" id="counselling-{{ str_replace('.', '-', str_replace(' ', '-', $type) ) }}" role="tabpanel" aria-labelledby="counselling-{{ str_replace('.', '-', str_replace(' ', '-', $type) ) }}-tab">
                     <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-11 col-md-11">
                           <div class="enroll_product_slider owl-carousel">
                              @if( !empty($counselling) )
                                 
                                 @php
                                    $i = 1;
                                 @endphp
                                 
                                 @foreach($counselling as $result) 
                                    
                                    <div class="enroll_product_box rounded bg-secondary shadow p-md-3 p-2 mx-md-3 mx-4">
                                       <div class="rounded bg-white text-center position-relative">
                                          <div class="enroll_heading rounded-top bg-light py-3">
                                             <h3 class="fs-xl-18 fs-lg-15 fs-md-14 fs-14 font-weight-bold mb-3">{{$result->name}}</h3>
                                                @php
                                                   $discount_price = 0;
                                                   $final_price = $result->fee;
                                                @endphp

                                                @if( !empty($result->offer_percentage) and $result->offer_percentage != 0)
                                                   @php
                                                      $discount_price = ($result->fee * $result->offer_percentage) / 100;
                                                      $final_price = ($result->fee - $discount_price);
                                                   @endphp
                                                @endif
                                             
                                             <strong class="fs-13 font-weight-bold text-white rounded d-inline-flex align-items-center justify-content-center h-25px px-2 bg-primary"> 
                                             @if( !empty($discount_price) )
                                             &#8377;<del>{{$result->fee}} </del> &nbsp;
                                             @endif
                                             &#8377;{{$final_price}}
                                             @if(!empty($result->offer_percentage))
                                             ({{ $result->offer_percentage }}% Off)
                                             @endif
                                             </strong>
                                          </div>
                                          <ul class="list-unstyled my-2 pb-5" style="">
                                             @if( !empty($result->specification) )
                                                @foreach($result->specification as $specification)
                                                   <li class="d-flex align-items-center py-2 px-3 text-justify">
                                                      <span class="d-flex align-items-center justify-content-center h-25px w-25px fs-11 text-white bg-secondary rounded-pill shadow px-2"><i class="fas fa-hand-point-right"></i></span>
                                                      <p class="fs-xl-14 fs-lg-13 fs-md-13 fs-13 mb-0 ml-2">{{$specification->name}}</p>
                                                   </li>
                                                @endforeach
                                             @endif
                                          </ul>
                                          <div class="get_discount px-3 pt-2 pb-3 position-absolute bottom-0 w-100">
                                             

                                             <?php $result_name= "$result->name"; 
                                             ?>
                                             <input type="hidden" id="counsellingname_id{{$result->id}}" value="{{ $result_name }}">
                                             
                                             <a class="btn btn-primary btn-block mt-3" href="javascript:;" 
                                             
                                             @if( session()->has('student') )
                                                onclick="payment_modal_counselling('{{$result->id}}', '', '{{$result->fee}}', '{{$final_price}}','{{ $type }}', '{{ $result->offer_percentage ?? 0 }}')"
                                             @else 
                                                data-toggle="modal" data-target="#exampleModal1"
                                             @endif   
                                             >
                                                @if($final_price == 0 or $result->fee == 0)
                                                Register Free 
                                                @else
                                                Enroll Now
                                                @endif
                                             </a>
                                          </div>
                                       </div>
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
               @endforeach
            @endif
         </div>
      </div>
   </section>
   @endif

   @if( !empty($counselling_testimonials->toArray()) )
   <section class="counselling-testimonials overflow-hidden bg-light py-5">
      <div class="container">
         <div class="group-title-index mb-md-5 mb-4">
            
            <h2 class="center-title">Testimonials</h2>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="parents_review_slider owl-carousel">

                  @if( !empty($counselling_testimonials) )
                  @foreach($counselling_testimonials as $testimonial)
                  <div class="review_box" data-aos="fade-up">
                     <div class="review_box_inner position-relative bg-light rounded shadow-sm p-4 border text-justify">
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
                        <div class="scr_des text-justify">@php echo ($testimonial->description); @endphp</div>
                     </div>
                     <div class="prents_details pl-3 d-flex align-items-center">
                        <img src="{{ asset('public/counselling_testimonials/'. $testimonial->image) }}" 
                        alt="{{ basename( asset('public/counselling_testimonials/'. $testimonial->image) ) }}"
                        onerror="this.src='<?php echo asset("public/logo.png"); ?>'"
                        >
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
         </div>
      </div>
   </section>
   @endif
   
   @if( !empty($counselling_faq->toArray()) )
   <section class="faq_section">
      <div class="container text-justify">
         <div class="group-title-index mb-md-5 mb-4">
            <h2 class="center-title">Frequently Asked Questions</h2>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="accordion-list">
                  <ul class="list-unstyled">
                     
                  @if( !empty($counselling_faq) )
                     
                     @php
                        $i = 1;
                     @endphp

                     @foreach($counselling_faq as $faq)
                        
                        <li class="shadow">
                           <a data-toggle="collapse" class="text-dark collapsed" href="#accordion-list-{{$i}}" aria-expanded="false"><span>{{$i}}</span>
                           {{$faq->name}}                           
                           <i class="far fa-plus icon-show"></i>
                           <i class="far fa-minus icon-close"></i></a>
                           <div id="accordion-list-{{$i}}" class="collapse 
                              {{--@if($loop->first)
                                 show
                              @endif--}}
                           inner_ans_text" data-parent=".accordion-list">
                              <p>
                              {!! $faq->value !!}                             
                              </p>
                           </div>
                        </li>
                        
                        @php
                           $i += 1;
                        @endphp

                     @endforeach
                  @endif
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   @endif 
   
   <div class="test-series d-none">
      <h4>Test Series</h4>
      <div class="inner_test_book shadow">
         <h2 class="fs-20 text-secondary position-relative font-weight-bold mb-5 w-100 text-center">Test Series Schedule</h2>
         <ul class="list-unstyled text-center mb-0">
            <li class="mb-3">  <a class="btn btn-primary fs-14 py-1 d-inline-block" href="javascript:;"><i class="fas fa-file-pdf mr-2"></i>Class IX Test Series</a></li>
            <li class="mb-3">  <a class="btn btn-primary fs-14 py-1 d-inline-block" href="javascript:;"><i class="fas fa-file-pdf mr-2"></i>Class X Boards Test Series</a></li>
            <li class="mb-3">  <a class="btn btn-primary fs-14 py-1 d-inline-block" href="javascript:;"><i class="fas fa-file-pdf mr-2"></i>Test Series for NTSE</a></li>
         </ul>
      </div>
   </div>
</main>

<script>

$(document).ready(
   function() {
         
   }
);
</script>


<script>
function is_callback_selected() {
        var classdata= $('#Class').val();
        if(classdata==''){
           $("button[data-id='Class']").addClass("color_reddd");
           return false;
        }else{
            $("button[data-id='Class']").removeClass("color_reddd");
           return true;
        }
        return true;
  }
</script>

<!-- payment gateway -->

<script>
   function payment_modal_counselling(counselling_id, name, price, final_price,type, discount) {
      
      name = $('#counsellingname_id'+counselling_id).val();
      
      $('#payment_modal_div_counselling #counselling_id').val(counselling_id);
      $('#payment_modal_div_counselling #counselling_name').text(name);
     
      $('#payment_modal_div_counselling #amount').text(final_price);

      $('#payment_modal_div_counselling #subtotal_amount').text(final_price);
      $('#payment_modal_div_counselling #total_amount').text(final_price);
      $('#payment_modal_div_counselling #type_id').text(type);

      // if amount is 0
      if(final_price == 0 || price == 0) {
         $('#payment_modal_div_counselling #counselling_submit_btn').text('Book');
      } else {
         $('#payment_modal_div_counselling #counselling_submit_btn').text('Proceed');
      }

      $('#payment_modal_counselling').modal('show');
      var dis= price-final_price;
      if(dis!=0){
          $('#payment_modal_div_counselling #price').html('<del class="fs-14 mr-2">'+price+'</del>');
         $('#discount_box_id').show();
         $('#discount_box_id').html('₹'+final_price);
      }else{
          $('#payment_modal_div_counselling #price').text(price);
         $('#discount_box_id').hide();
      }
   }

   function send_otp_on_email1(element) {

      if($(element).text() == 'Get OTP') {
         $(element).text('Resend OTP');
      }

      $('#payment_modal_counselling #email_or_mobile').val('email');

      var email = $('#payment_modal_counselling #email').val();

      $.ajax({
            url: '{{ action("Website\CounsellingpaymentController@otp") }}',
            data: {
               email,
            },
            success: function(data) {

               if(data == 1) {
                  $('#otp_sent_msg11').removeClass('d-none');                  
                  $('#otp_sent_msg11').text('OTP Sent');                
               }

            }
         });
   
      $('.otp_div11').removeClass('d-none');
   }

   function send_otp_on_mobile1(element) {

      if($(element).text() == 'Get OTP') {
         $(element).text('Resend OTP');
      }

      $('#payment_modal_counselling #email_or_mobile').val('mobile');

      var mobile = $('#payment_modal_counselling #mobile').val();

      $.ajax({
            url: '{{ action("Website\CounsellingpaymentController@otp") }}',
            data: {
               mobile,
            },
            success: function(data) {

               if(data == 1) {
                  $('#otp_sent_msg11').removeClass('d-none');                    
                  $('#otp_sent_msg11').text('OTP Sent');              
               }

               $('#payment_modal_counselling input[name="otp_digits[]"]').each(
                  function() {
                     $(this).val('');
                  }
               ); 

            }
         });
   
      $('.otp_div11').removeClass('d-none');
   }

   $('#payment_modal_counselling input[name="otp_digits[]"]').keyup(
      function() {

         var otp = '';
         
         $('#payment_modal_counselling input[name="otp_digits[]"]').each(
            function() {
               otp += $(this).val();
            }
         );

         if(otp.length == 4) {
            
            $.ajax({
               url: '{{ action("Website\CounsellingpaymentController@otp_verify") }}',
               data: {
                  otp
               },
               success: function(data) {

                  if(data == 1) {
                     $('#otp_sent_msg11').text('Verified');      
           
                     $('#payment_modal_counselling input[name="otp_digits[]"]').each(
                        function() {
                           $(this).val('');
                        }
                     );     
                     
                     var email_or_mobile = $('#payment_modal_counselling #email_or_mobile');

                     email_or_mobile = email_or_mobile.val();

                     $('#payment_modal_counselling #' + email_or_mobile).prop('readonly', true);
                     
                     $('#payment_modal_counselling #' + email_or_mobile + '_prepend').addClass('d-none');

                     $('#payment_modal_counselling #is_' + email_or_mobile + '_verified').val('yes');
                     $('.otp_div11').addClass('d-none');
                  } else {
                     $('#otp_sent_msg11').text('Invalid OTP');                 
                  }

               }
            });

         }
      }
   );

   $('#payment_counselling_form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
         e.preventDefault();
         return false;
      }
   });

   $('#payment_counselling_form').on('submit', function(e) {
      
      var is_mobile_verified = $('#payment_modal_counselling #is_mobile_verified').val()
      var is_email_verified = $('#payment_modal_counselling #is_email_verified').val()

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
@include('website/layouts/footer')