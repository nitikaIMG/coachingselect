@include('website/layouts/header')

<style>

   p.text-gray {
      white-space: pre-line;
   }

   #personal-1 input {
      height: 50px !important;
   }

   .display-none {
      display: none !important;
   }
   .display-none {
      display: none !important;
   }
   .link-a{
      cursor: pointer;
   }
   .avatar-wrapper:hover .profile-pic {
      opacity: 1;
   }
   .avatar-wrapper .profile-pic:after{
   display: none;
   }
   .avatar-wrapper .profile-pic {
      border-radius: 50px;
      transform: scale(0.9);
      object-fit: cover;
   }
   .avatar-wrapper:hover {
      transform: scale(1);
      cursor: pointer;
   }
   .profile_pic{
      width: 89px;
    margin-top: 29px;
    margin-left: 3px;
   }
   @media (max-width: 767px) {
      #personal-1 input {
			height: 43px !important;
      }
   }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">

<main id="main">
   <section id="exam-eligibility" class="bg-white mt-lg-3 overflow-unset">
      <div class="container position-relative z-index-1">
         <div class="row align-items-start mx-0">
            <div class="col-lg-3 position-sticky profile-menu-position">
               <ul class="nav d-lg-block d-md-flex d-flex border-0 nav-tabs shadow rounded bg-white" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  active d-flex align-items-center justify-content-between" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal Details <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fas fa-user"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="personal-1-tab" data-toggle="tab" href="#personal-1" role="tab" aria-controls="personal-1" aria-selected="false">Academic Details <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fas fa-school"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="personal-3-tab" data-toggle="tab" href="#personal-3" role="tab" aria-controls="personal-3" aria-selected="false">My Purchases <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fad fa-rupee-sign"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="personal-2-tab" data-toggle="tab" href="#personal-2" role="tab" aria-controls="personal-2" aria-selected="false">History with CoachingSelect <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fad fa-books"></i></span></a>
                  </li>
               </ul>
            </div>
            <div class="col-lg-9 mt-lg-0 mt-md-5 mt-4">
               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                     <div class="row">
                        <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white mt-md-0 mt-4">
                           <div class="row mx-0">
                              <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                 <form 
                                    action='{{ action("Website\StudentProfileController@student_profile_update") }}'
                                    class="row mx-0 bg-white shadow"
                                    method="post"
                                    enctype="multipart/form-data"
                                    id="student_profile_form"
                                    >
                                    @csrf

                                    <div class="col-12">
                                       <div class="avatar-wrapper position-relative h-md-100px h-80px w-md-100px w-80px top-md-n57px top-n45px mx-auto rounded-pill shadow border d-flex align-items-start">

                                       @if( !empty(session()->get('student')->image) )
                                         <img class="profile-pic" 
                                         src="{{ session()->get('student')->image ?? '' }}"                                       
                                         onerror="this.src='<?php echo asset('public/user.png'); ?>'"
                                          >
                                       @else 
                                          <img 
                                          class="profile-pic"
                                          src="<?php echo asset('public/user.png'); ?>"
                                          >
                                       @endif
                                       
                                         <div class="upload-button">
                                             <i class="fad fa-arrow-circle-up" aria-hidden="true"></i>
                                          
                                            <a href="javascript:;" class="py-1 font-weight-bold text-white rounded-pill w-30px h-30px border d-grid align-items-center justify-content-center bg-dark position-absolute right-0 bottom-0"><i class="fas fa-pencil-alt fs-13"></i></a>
                                         </div>
                                         <input class="file-upload d-none" type="file" accept="image/*" name="image"
                                         id="image">
                                         @if( Session::has('successProfile'))

                                         <?php $message = Session::get('successProfile')?>

                                         <div class="successfully_messages"> {{ $message }}</div>
                                         @endif
                                         @if( Session::has('errorProfile'))

                                         <?php $message1 = Session::get('errorProfile')?>

                                         <div class="successfully_messages error_messages text-danger"> {{ $message1 }}</div>
                                         @endif
                                      </div>
                                    </div>

                                    <div class="col-12 form-group text-center mt-n5">
                                       <div class="row justify-content-center">
                                          <div class="col-auto px-2 name-text d-none mt-md-0 mt-2" id="name-text">
                                             <div class="form-group mb-0">
                                                <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 pr-5 font-weight-bold"
                                                value="{{ session()->get('student')->name ?? '' }}" id="name" name="name">
                                             </div>
                                             <div class="row position-absolute top-0 right-0 bottom-0 h-100 align-items-center mr-1 ml-0">
                                                <div class="col-auto pl-2">
                                                   <a href="javascript:;" id="savename" data-save_button_id="name" data-toggle="tooltip" class="py-1 font-weight-bold text-success rounded-pill w-md-30px w-25px h-md-30px h-25px  border border-success d-grid align-items-center justify-content-center save_button" title="Save"><i class="far fa-check"></i></a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto px-2 name-box align-items-center" id="name-box">
                                             <div class="row align-items-center mb-md-3 mb-0 mt-md-0 mt-4">
                                                <div class="form-group mb-0">
                                                   <div class="fs-lg-28 fs-md-22 fs-16 font-weight-bold" data-id="name">{{ session()->get('student')->name ?? '' }}</div>
                                                </div>
                                                <div class="col-auto pl-2">
                                                   <a href="javascript:;" for="name" id="editname" data-toggle="tooltip" class="py-1 font-weight-bold text-secondary rounded-pill w-md-30px w-25px fs-md-15 fs-13 h-md-30px h-25px border d-grid align-items-center justify-content-center" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="row">
                                          <div class="col-md-5 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="otp-email" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">EMAIL :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input type="email" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 pr-80px" id="otp-email" name="email"
                                                      value="{{ session()->get('student')->email ?? '' }}"
                                                      data-old-value="{{ session()->get('student')->email ?? '' }}"
                                                      
                                                         @if(session()->get('student')->is_email_verified)
                                                            disabled
                                                         @endif
                                                      >
                                                   </div>
                                                   <div class="row position-absolute top-0 right-0 bottom-0 h-37px align-items-center mx-0">
                                                   @if(session()->get('student')->is_email_verified)
                                                      <div class="col-auto pl-0" data-toggle="tooltip" title="Verified">
                                                         <a href="javascript:;" class="py-1 font-weight-bold text-success rounded-pill w-md-30px w-25px h-md-30px h-25px  border d-grid align-items-center justify-content-center"><i class="fas fa-check"></i></a>
                                                      </div>
                                                   @else
                                                      <div class="col-auto px-2 edit_button" data-toggle="tooltip" title="Edit" data-edit-field="email">
                                                         <a href="javascript:;" class="py-1 font-weight-bold text-secondary rounded-pill w-md-30px w-25px fs-md-15 fs-13 h-md-30px h-25px border d-grid align-items-center justify-content-center"><i class="fas fa-pencil-alt"></i></a>
                                                      </div>
                                                      <div class="col-auto pl-0 verify_button" data-toggle="tooltip" title="Verify" data-verify-field="email">
                                                         <a href="javascript:;" class="py-1 font-weight-bold text-success rounded-pill w-md-30px w-25px h-md-30px h-25px  border d-grid align-items-center justify-content-center"><i class="fas fa-check"></i></a>
                                                      </div>
                                                   @endif
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="otp-mobile" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">MOBILE NUMBER  :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input type="tel" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" id="otp-mobile" name="mobile"
                                                      value="{{ session()->get('student')->mobile ?? '' }}" 
                                                      data-old-value="{{ session()->get('student')->mobile ?? '' }}"
                                                      readonly  onkeypress="return isNumberKey(event)" 
                                                      pattern="[6-9]{1}[0-9]{9}" title="" minlength="10" maxlength="10"
                                                      readonly
                                                      >
                                                   </div>
                                                   <div class="row position-absolute top-0 right-0 bottom-0 h-37px align-items-center mx-0">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="alternative_mobile" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">ALTERNATE NUMBER :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input type="tel" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 pr-5" id="alternative_mobile" name="alternative_mobile"
                                                      value="{{ session()->get('student')->alternative_mobile ?? '' }}" readonly onkeypress="return isNumberKey(event)" 
                                                      pattern="[6-9]{1}[0-9]{9}" title="MOBILE NUMBER with 7-9 and remaining 9 digit with 0-9" minlength="10" maxlength="10">
                                                   </div>
                                                   <div class="row position-absolute top-0 right-0 bottom-0 h-37px align-items-center mx-0">
                                                      <div class="col-auto px-2 edit_button mx-2" data-toggle="tooltip" title="Edit" data-edit-field="alternative_mobile">
                                                         <a href="javascript:;" class="py-1 font-weight-bold text-secondary rounded-pill w-md-30px w-25px fs-md-15 fs-13 h-md-30px h-25px border d-grid align-items-center justify-content-center"><i class="fas fa-pencil-alt"></i></a>
                                                      </div>
                                                      <div class="col-auto pl-0 d-none verify_button_alternate" data-toggle="tooltip" title="Update" data-verify-field="alternative_mobile">
                                                         <a href="javascript:;" class="py-1 font-weight-bold text-success rounded-pill w-md-30px w-25px h-md-30px h-25px  border d-grid align-items-center justify-content-center"><i class="fas fa-check"></i></a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-3">
                                                <div class="col-12"><label for="dob" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Date of Birth :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row mx-0">
                                                      <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                                         <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 rounded-0" type="text" id="dob" name="dob"
                                                         value="{{ session()->get('student')->dob ?? '' }}"/>
                                                         <span class="input-group-addon"><i class="fad fa-calendar-alt"></i></span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-3">
                                                <div class="col-12"><label for="" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Gender :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="btn-group btn-group-toggle row d-flex mx-0 flex-md-nowrap flex-wrap" data-toggle="buttons">
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto active">
                                                      <input type="radio" name="gender" id="option1" value="male" 
                                                      @if(session()->get('student')->gender == 'male') checked=""
                                                      @endif
                                                      > Male
                                                      </label>
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto">
                                                      <input type="radio" name="gender" id="option2" value="female"    
                                                      @if(session()->get('student')->gender == 'female') checked=""
                                                      @endif
                                                      > Female
                                                      </label>
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto">
                                                      <input type="radio" name="gender" id="option3" value="transgender"
                                                      @if(session()->get('student')->gender == 'transgender') 
                                                      checked=""
                                                      @endif
                                                      > Transgender
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="address-line-1" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Address line 1 :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" id="address-line-1"  name="address1"
                                                      value="{{ session()->get('student')->address1 ?? '' }}">
                                                      <span class="fs-10 font-weight-bold position-relative top-n5px text-gray">plot no., Street address</span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="address-line-1" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Address line 2 :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" id="address-line-1" name="address2"
                                                      value="{{ session()->get('student')->address2 ?? '' }}">
                                                      <span class="fs-10 font-weight-bold position-relative top-n5px text-gray">Apartment, floor, building</span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3 pr-md-1 pl-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="country" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Country :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row">
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <select name="country" id="country_id" title="country" class="selectpicker w-100 show-tick" data-width="auto" data-container="body" data-size="10" data-live-search="true" placeholder="Country">
                                                               <option value="" disabled selected="">Country </option>
                                                               @if( !empty($countries) )
                                                               @foreach($countries as $country)
                                                               <option 
                                                                  value="{{$country->name}}"

                                                                  @if($country->name == session()->get('student')->country ?? '')
                                                                     selected
                                                                  @endif   
                                                               >{{$country->name}}</option>
                                                               @endforeach
                                                               @endif
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3 pr-md-1 pl-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="state" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">State :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row">
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <select name="state" id="state_id" title="state" class="selectpicker w-100 show-tick" data-width="auto" data-container="body" data-size="10" data-live-search="true" placeholder="State">
                                                               <option value="" selected disabled>State</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3 pr-md-1 pl-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="city" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">City :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row">
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <select name="city" id="city_id" title="city" class="selectpicker w-100 show-tick" data-width="auto" data-container="body" data-size="10" data-live-search="true" placeholder="City">
                                                               <option value="" disabled selected="">City </option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3 pl-md-1 pl-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="pin-code" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Pin Code :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input type="tel" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" id="pin-code" name="pincode" value="{{ session()->get('student')->pincode ?? '' }}"  onkeypress="return isNumberKey(event)" 
                                                      pattern="[0-9]{6}" title="Enter a valid pincode" minlength="6" maxlength="6">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-7 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-3">
                                                <div class="col-12"><label for="" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Category :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="btn-group btn-group-toggle row d-flex mx-0 flex-md-nowrap flex-wrap" data-toggle="buttons">
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto active">
                                                      <input type="radio" name="category" id="option1" value="general"
                                                         @if(session()->get('student')->category == 'general') 
                                                         checked=""
                                                         @endif
                                                      > General
                                                      </label>
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto">
                                                      <input type="radio" name="category" id="option2" value="obc-ncl"
                                                         @if(session()->get('student')->category == 'obc-ncl') 
                                                         checked=""
                                                         @endif
                                                      > OBC 
                                                      </label>
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto">
                                                      <input type="radio" name="category" id="option3" value="sc"
                                                         @if(session()->get('student')->category == 'sc') 
                                                         checked=""
                                                         @endif
                                                      > SC
                                                      </label>
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-grid align-items-center h-37px mb-md-0 mb-2 w-auto">
                                                      <input type="radio" name="category" id="option4" value="st"
                                                         @if(session()->get('student')->category == 'st') 
                                                         checked=""
                                                         @endif
                                                      > ST
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-5 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12"><label for="" class="mb-0 fs-xl-14 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Person with Disability (PwD) :</label></div>
                                                <div class="col-12 px-2 disability_part">
                                                   <div class="btn-group btn-group-toggle row d-flex mx-0 flex-md-nowrap flex-wrap" data-toggle="buttons">
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-inline-flex align-items-center h-37px active">
                                                      <input type="radio" id="option1"
                                                      value="yes" name="has_disability"
                                                         @if(session()->get('student')->has_disability == 'yes') 
                                                         checked=""
                                                         @endif
                                                      > Yes
                                                      </label>
                                                      <label class="btn btn-light mx-1 rounded-0 text-capitalize font-weight-bold fs-xl-13 fs-lg-12 fs-md-12 fs-11 d-inline-flex align-items-center h-37px">
                                                      <input type="radio" id="option2"
                                                      value="no" name="has_disability"
                                                         @if(session()->get('student')->has_disability == 'no') 
                                                         checked=""
                                                         @endif
                                                      > No
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-12 border-top mt-4 px-md-3 px-2 py-3  d-flex align-items-center justify-content-between text-right">
                                       <a href="javascript:;" data-toggle="modal" data-target="#Change-password" data-backdrop="static" data-keyboard="false" data-dismiss="modal" class="btn btn-green fs-md-14 fs-12 border-0 rounded-pill"><span class="mr-2"><i class="fal fa-key"></i></span><span>Change Password</span></a>
                                       <button class="btn btn-green fs-md-14 fs-12 border-0 rounded-pill save_changes_button"><span class="mr-2"><i class="far fa-check-circle"></i></span><span>Save</span></button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="personal-1" role="tabpanel" aria-labelledby="personal-1-tab">
                     <div class="row">
                        <div class="col-12">
                           <div class="row">
                              <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white">
                                 <div class="row mx-0">
                                    <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                       <div class="row mx-0 bg-white shadow">
                                          <div class="col-12">
                                             <div class="row mx-md-0 mt-3">
                                                <div class="col fs-md-19 fs-15 font-weight-bold text-secondary">Preferences Information</div>
                                             </div>
                                             <div class="row mx-md-0 mb-md-3 mb-0 border-bottom pb-3">
                                                <div class="col-12 fs-md-14 fs-12 text-gray">We'll customize your feed to include content relevant to you</div>
                                             </div>
                                          </div>
                                          <div class="col-12 px-0 preferences">
                                          
                                             <form action='{{ action("Website\StudentProfileController@student_academic_details") }}' method="post" id="student_academic_details">
                                                @csrf
                                                <div class="row mb-4 mx-0 prefence_information">
                                                   <div class="col-sm mt-md-0 mt-3">
                                                      <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                         <div class="comman_select select_box_1">
                                                            <select name="stream_id" id="stream_id" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Choose Stream" required form="student_academic_details">
                                                               <option value="" selected="" disabled>Choose Stream </option>
                                                               @if( !empty($streams) )
                                                                  @foreach($streams as $stream)
                                                                  <option value="{{$stream->id}}"
                                                                     >{{$stream->name}}</option>
                                                                  @endforeach
                                                               @endif
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm mt-md-0 mt-3">
                                                      <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                         <div class="comman_select select_box_1">
                                                            <select name="courses[]" id="course_id" title="" class="selectpicker show-tick" multiple data-selected-text-format="count" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Choose Exam" required form="student_academic_details">
                                                               <option value="" selected="" disabled>Choose Exam </option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-auto mt-md-0 mt-3">
                                                      <button type="submit" class="search_btn border-0 btn btn-sm btn-green border-0 rounded">
                                                      <span class="d-flex align-items-center"><i class="fal fa-check-circle"></i>&nbsp; Add</span></button>
                                                   </div>
                                                </div>
                                             </form>
                                             <div class="row mx-0 preferences-information-carousel owl-carousel" id="student_academic_details_data">
                                                
                                                @if( !empty($student_academic_details) )
                                                   @foreach($student_academic_details as $student_academic_detail)
                                                      <div class="col-lg-6- col-md-6- col-12 mb-md-4 mt-2 d-flex align-items-stretch justify-content-center profile_584853">
                                                         <div class="exam_single_box shadow rounded row w-100 position-relative">
                                                            <div                 
                                                            onclick="remove_stream(this, '{{$student_academic_detail->stream_id}}')"
                                                            class="col-auto position-absolute right-5px top-5px fs-19 text-white z-indmd-ex fs-15-1 d-grid align-items-center justify-content-center px-0 border border-white w-md-30px w-24px h-md-30px h-24px rounded-pill class-cards"><i class="fas fa-times"></i></div>
                                                            <div class="exam-ico bg-primary col-lg-4 col-md-auto col-auto justify-content-center rounded-left d-grid align-items-center h-100 fs-lg-50 fs-md-40 fs-30 py-4 px-md-4 px-3">
                                                               @php echo $student_academic_detail->image; @endphp
                                                            </div>
                                                            <div class="inner-text col py-3 bg-secondary h-100 d-grid rounded-right">
                                                               <div class="font-weight-bold fs-md-18 fs-14 text-uppercase mb-md-4 mb-md-2 text-white">{{$student_academic_detail->name}}</div>
                                                               <p class="fs-md-14 fs-12 mb-0 font-weight-600">

                                                                  @php
                                                                     $courses = $student_academic_detail->courses;

                                                                     $courses = explode(',', $courses);
                                                                  @endphp

                                                                  @if( !empty($courses) )
                                                                     @foreach($courses as $course)
                                                                        <span class="text-white">{{$course}} 
                                                                           @if($loop->last)
                                                                           @else
                                                                              |
                                                                           @endif
                                                                        </span>
                                                                     @endforeach
                                                                  @endif
                                                               </p>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   @endforeach
                                                @endif
                                             </div>
                                          </div>
                                          <div class="col-12 border-top mt-4 px-4 py-3 text-right">
                                             <form action='{{ action("Website\StudentProfileController@student_academic_details_update") }}' method="post">
                                                @csrf
                                                <button class="btn btn-green fs-md-14 fs-12 border-0 rounded-pill" type="submit"><span class="mr-2"><i class="far fa-check-circle"></i></span><span>Save</span></button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-md-5 mt-4">
                              <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white">
                                 <div class="row mx-0">
                                    <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                       <form
                                       class="row mx-0 bg-white shadow"
                                       action='{{ action("Website\StudentProfileController@student_education_level_information_update") }}'
                                       method="post"
                                       id="student_education_level_information_form"
                                       >
                                       @csrf
                                          <div id="add_more_education_container" class="col-12">
                                             <div class="col-12">
                                                <div class="row mx-md-0 mt-3">
                                                   <div class="col fs-md-23 fs-14 font-weight-bold text-secondary">Academic Details</div>
                                                </div>
                                                
                                                <div class="row mx-md-0 mb-1 pb-3">
                                                   <div class="col-12 fs-md-14 fs-12 text-gray text-right">
                                                      <button 
                                                      onclick="freeze('student_education_level_information_form')"
                                                      type="button" class="btn btn-green border-0 btn-sm"><span>Edit</span></button>
                                                   </div>
                                                </div>
                                             </div>

                                             @if( !empty($student_education_level_information) )   

                                                @php
                                                   $i = 0;
                                                @endphp

                                                @foreach($student_education_level_information as $info)
                                                   <div class="pt-4 mb-3 border-top col-12 px-md-2 px-0 preferences student_education_level_information">
                                                      <div class="row">
                                                         <div class="col-12 px-md-3 px-0">
                                                            <div class="row mx-md-0">
                                                               <div class="mb-md-4 mb-3 col-md-6">
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <select required name="student_education_level_information[{{$i}}][class_level]" id="student_education_level_information[{{$i}}][class_level]" title="" data-index="{{$i}}" onchange="select_class(this)" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Choose Your Class Level">
                                                                           <option value="" selected="" disabled>Choose Your Class Level </option>
                                                                           <option value="V-XII"
                                                                              @if($info->class_level == 'V-XII')
                                                                                 selected
                                                                              @endif
                                                                           >V-XII</option>
                                                                           <option value="UG"
                                                                              @if($info->class_level == 'UG')
                                                                                 selected
                                                                              @endif
                                                                           >UG</option>
                                                                           <option value="PG"
                                                                              @if($info->class_level == 'PG')
                                                                                 selected
                                                                              @endif
                                                                           >PG</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div 
                                                                  class="mb-md-4 mb-3 col-md-6 class_box_{{$i}}"
                                                                  @if($info->class_level != 'V-XII')
                                                                     style="display: none;"
                                                                  @endif
                                                               >
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <select 
                                                                        @if($info->class_level == 'V-XII')
                                                                            
                                                                        @endif
                                                                        name="student_education_level_information[{{$i}}][class]" id="student_education_level_information[{{$i}}][class]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Your Class" 
                                                                        data-index="{{$i}}" onchange="select_stream(this)">
                                                                           <option value="" selected="" disabled>Select Your Class </option>
                                                                           <option value="V-X"
                                                                              @if($info->class == 'V-X')
                                                                                 selected
                                                                              @endif
                                                                           >V-X</option>
                                                                           <option value="XI-XII"
                                                                              @if($info->class == 'XI-XII')
                                                                                 selected
                                                                              @endif
                                                                           >XI-XII</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div 
                                                                  class="mb-md-4 mb-3 col-md-6 university_name_box_{{$i}}"
                                                                  @if($info->class_level == 'V-XII')
                                                                     style="display: none;"
                                                                  @endif   
                                                               >
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                        @if($info->class_level != 'V-XII')
                                                                            
                                                                        @endif
                                                                        value="{{$info->university_name ?? ''}}"
                                                                        name="student_education_level_information[{{$i}}][university_name]" id="student_education_level_information[{{$i}}][university_name]" placeholder="University Name">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="mb-md-4 mb-3 col-md-6">
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                        required 
                                                                        value="{{$info->school_college_name ?? ''}}"
                                                                        name="student_education_level_information[{{$i}}][school_college_name]" id="student_education_level_information[{{$i}}][school_college_name]" placeholder="School/College Name">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               
                                                               <div 
                                                                  class="mb-md-4 mb-3 col-md-6 degree_diploma_name_box_{{$i}}"
                                                                  @if($info->class_level == 'V-XII')
                                                                     style="display: none;"
                                                                  @endif
                                                               >
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                        @if($info->class_level != 'V-XII')
                                                                           required 
                                                                        @endif
                                                                        value="{{$info->degree_diploma_name ?? ''}}"
                                                                        name="student_education_level_information[{{$i}}][degree_diploma_name]" id="student_education_level_information[{{$i}}][degree_diploma_name]" placeholder="Degree/Diploma Name">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               
                                                               <div class="mb-md-4 mb-3 col-md-6 specialization_box_{{$i}}"
                                                                  @if($info->class_level == 'V-XII')
                                                                     style="display: none;"
                                                                  @endif
                                                               >
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                        @if($info->class_level != 'V-XII')
                                                                            
                                                                        @endif
                                                                        value="{{$info->specialization ?? ''}}"
                                                                        name="student_education_level_information[{{$i}}][specialization]" id="student_education_level_information[{{$i}}][specialization]" placeholder="Specialization">
                                                                     </div>
                                                                  </div>
                                                               </div>

                                                               <div class="mb-md-4 mb-3 col-md-6">
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <select name="student_education_level_information[{{$i}}][course_completion_year]" id="student_education_level_information[{{$i}}][course_completion_year]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Course Completion Year">
                                                                           <option value="" selected="" disabled>Course Completion Year</option>

                                                                           @foreach(range(date('Y'), 1970) as $year)
                                                                              <option value="{{$year}}"
                                                                                 @if($info->course_completion_year == $year)
                                                                                    selected
                                                                                 @endif
                                                                              >{{$year}}</option>
                                                                           @endforeach
                                                                           
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>

                                                               <div 
                                                                  class="mb-md-4 mb-3 col-md-6 board_box_{{$i}}"
                                                                  @if($info->class_level != 'V-XII')
                                                                     style="display: none;"
                                                                  @endif
                                                               >
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <select 
                                                                        @if($info->class_level == 'V-XII')
                                                                            
                                                                        @endif
                                                                        name="student_education_level_information[{{$i}}][board]" id="student_education_level_information[{{$i}}][board]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Courses">
                                                                           <option value=""> Select Board </option>
                                                                           <option value="CBSE"
                                                                              @if($info->board == 'CBSE')
                                                                                 selected
                                                                              @endif
                                                                           > CBSE </option>
                                                                           <option value="ICSE"
                                                                              @if($info->board == 'ICSE')
                                                                                 selected
                                                                              @endif
                                                                           > ICSE </option>
                                                                           <option value="IGCSE"
                                                                              @if($info->board == 'IGCSE')
                                                                                 selected
                                                                              @endif
                                                                           > IGCSE </option>
                                                                           <option value="State Board"
                                                                              @if($info->board == 'State Board')
                                                                                 selected
                                                                              @endif
                                                                           > State Board </option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               
                                                               <div 
                                                                  class="mb-md-4 mb-3 col-md-6 stream_box_{{$i}}"
                                                                  
                                                                  @if($info->class != 'XI-XII')
                                                                     style="display: none;"
                                                                  @endif
                                                               >
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <select                    
                                                                        @if($info->class == 'XI-XII')
                                                                           
                                                                        @endif
                                                                        name="student_education_level_information[{{$i}}][stream]" id="student_education_level_information[{{$i}}][stream]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Courses">
                                                                           <option value=""> Select Stream </option>
                                                                           <option value="Arts"
                                                                              @if($info->stream == 'Arts')
                                                                                 selected
                                                                              @endif
                                                                           >Arts</option>
                                                                           <option value="Commerce"
                                                                              @if($info->stream == 'Commerce')
                                                                                 selected
                                                                              @endif
                                                                           >Commerce</option>
                                                                           <option value="Maths"
                                                                              @if($info->stream == 'Maths')
                                                                                 selected
                                                                              @endif
                                                                           >Maths</option>
                                                                           <option value="Science"
                                                                              @if($info->stream == 'Science')
                                                                                 selected
                                                                              @endif
                                                                           >Science</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>

                                                               <div class="mb-md-4 mb-3 col-md-6">
                                                                  <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                                                                     <div class="comman_select select_box_1">
                                                                        <select name="student_education_level_information[{{$i}}][marks]" id="student_education_level_information[{{$i}}][marks]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Marks">
                                                                           <option value="" selected="" disabled>Marks </option>
                                                                           <option value="33%"
                                                                              @if($info->marks == '33%')
                                                                                 selected
                                                                              @endif
                                                                           >33%</option>
                                                                           <option value="34%"
                                                                              @if($info->marks == '34%')
                                                                                 selected
                                                                              @endif
                                                                           >34%</option>
                                                                           <option value="35%"
                                                                              @if($info->marks == '35%')
                                                                                 selected
                                                                              @endif
                                                                           >35%</option>
                                                                           <option value="36%"
                                                                              @if($info->marks == '36%')
                                                                                 selected
                                                                              @endif
                                                                           >36%</option>
                                                                           <option value="37%"
                                                                              @if($info->marks == '37%')
                                                                                 selected
                                                                              @endif
                                                                           >37%</option>
                                                                           <option value="38%"
                                                                              @if($info->marks == '38%')
                                                                                 selected
                                                                              @endif
                                                                           >38%</option>
                                                                           <option value="39%"
                                                                              @if($info->marks == '39%')
                                                                                 selected
                                                                              @endif
                                                                           >39%</option>
                                                                           <option value="40%"
                                                                              @if($info->marks == '40%')
                                                                                 selected
                                                                              @endif
                                                                           >40%</option>
                                                                           <option value="41%"
                                                                              @if($info->marks == '41%')
                                                                                 selected
                                                                              @endif
                                                                           >41%</option>
                                                                           <option value="42%"
                                                                              @if($info->marks == '42%')
                                                                                 selected
                                                                              @endif
                                                                           >42%</option>
                                                                           <option value="43%"
                                                                              @if($info->marks == '43%')
                                                                                 selected
                                                                              @endif
                                                                           >43%</option>
                                                                           <option value="44%"
                                                                              @if($info->marks == '44%')
                                                                                 selected
                                                                              @endif
                                                                           >44%</option>
                                                                           <option value="45%"
                                                                              @if($info->marks == '45%')
                                                                                 selected
                                                                              @endif
                                                                           >45%</option>
                                                                           <option value="46%"
                                                                              @if($info->marks == '46%')
                                                                                 selected
                                                                              @endif
                                                                           >46%</option>
                                                                           <option value="47%"
                                                                              @if($info->marks == '47%')
                                                                                 selected
                                                                              @endif
                                                                           >47%</option>
                                                                           <option value="48%"
                                                                              @if($info->marks == '48%')
                                                                                 selected
                                                                              @endif
                                                                           >48%</option>
                                                                           <option value="49%"
                                                                              @if($info->marks == '49%')
                                                                                 selected
                                                                              @endif
                                                                           >49%</option>
                                                                           <option value="50%"
                                                                              @if($info->marks == '50%')
                                                                                 selected
                                                                              @endif
                                                                           >50%</option>
                                                                           <option value="51%"
                                                                              @if($info->marks == '51%')
                                                                                 selected
                                                                              @endif
                                                                           >51%</option>
                                                                           <option value="52%"
                                                                              @if($info->marks == '52%')
                                                                                 selected
                                                                              @endif
                                                                           >52%</option>
                                                                           <option value="53%"
                                                                              @if($info->marks == '53%')
                                                                                 selected
                                                                              @endif
                                                                           >53%</option>
                                                                           <option value="54%"
                                                                              @if($info->marks == '54%')
                                                                                 selected
                                                                              @endif
                                                                           >54%</option>
                                                                           <option value="55%"
                                                                              @if($info->marks == '55%')
                                                                                 selected
                                                                              @endif
                                                                           >55%</option>
                                                                           <option value="56%"
                                                                              @if($info->marks == '56%')
                                                                                 selected
                                                                              @endif
                                                                           >56%</option>
                                                                           <option value="57%"
                                                                              @if($info->marks == '57%')
                                                                                 selected
                                                                              @endif
                                                                           >57%</option>
                                                                           <option value="58%"
                                                                              @if($info->marks == '58%')
                                                                                 selected
                                                                              @endif
                                                                           >58%</option>
                                                                           <option value="59%"
                                                                              @if($info->marks == '59%')
                                                                                 selected
                                                                              @endif
                                                                           >59%</option>
                                                                           <option value="60%"
                                                                              @if($info->marks == '60%')
                                                                                 selected
                                                                              @endif
                                                                           >60%</option>
                                                                           <option value="61%"
                                                                              @if($info->marks == '61%')
                                                                                 selected
                                                                              @endif
                                                                           >61%</option>
                                                                           <option value="62%"
                                                                              @if($info->marks == '62%')
                                                                                 selected
                                                                              @endif
                                                                           >62%</option>
                                                                           <option value="63%"
                                                                              @if($info->marks == '63%')
                                                                                 selected
                                                                              @endif
                                                                           >63%</option>
                                                                           <option value="64%"
                                                                              @if($info->marks == '64%')
                                                                                 selected
                                                                              @endif
                                                                           >64%</option>
                                                                           <option value="65%"
                                                                              @if($info->marks == '65%')
                                                                                 selected
                                                                              @endif
                                                                           >65%</option>
                                                                           <option value="66%"
                                                                              @if($info->marks == '66%')
                                                                                 selected
                                                                              @endif
                                                                           >66%</option>
                                                                           <option value="67%"
                                                                              @if($info->marks == '67%')
                                                                                 selected
                                                                              @endif
                                                                           >67%</option>
                                                                           <option value="68%"
                                                                              @if($info->marks == '68%')
                                                                                 selected
                                                                              @endif
                                                                           >68%</option>
                                                                           <option value="69%"
                                                                              @if($info->marks == '69%')
                                                                                 selected
                                                                              @endif
                                                                           >69%</option>
                                                                           <option value="70%"
                                                                              @if($info->marks == '70%')
                                                                                 selected
                                                                              @endif
                                                                           >70%</option>
                                                                           <option value="71%"
                                                                              @if($info->marks == '71%')
                                                                                 selected
                                                                              @endif
                                                                           >71%</option>
                                                                           <option value="72%"
                                                                              @if($info->marks == '72%')
                                                                                 selected
                                                                              @endif
                                                                           >72%</option>
                                                                           <option value="73%"
                                                                              @if($info->marks == '73%')
                                                                                 selected
                                                                              @endif
                                                                           >73%</option>
                                                                           <option value="74%"
                                                                              @if($info->marks == '74%')
                                                                                 selected
                                                                              @endif
                                                                           >74%</option>
                                                                           <option value="75%"
                                                                              @if($info->marks == '75%')
                                                                                 selected
                                                                              @endif
                                                                           >75%</option>
                                                                           <option value="76%"
                                                                              @if($info->marks == '76%')
                                                                                 selected
                                                                              @endif
                                                                           >76%</option>
                                                                           <option value="77%"
                                                                              @if($info->marks == '77%')
                                                                                 selected
                                                                              @endif
                                                                           >77%</option>
                                                                           <option value="78%"
                                                                              @if($info->marks == '78%')
                                                                                 selected
                                                                              @endif
                                                                           >78%</option>
                                                                           <option value="79%"
                                                                              @if($info->marks == '79%')
                                                                                 selected
                                                                              @endif
                                                                           >79%</option>
                                                                           <option value="80%"
                                                                              @if($info->marks == '80%')
                                                                                 selected
                                                                              @endif
                                                                           >80%</option>
                                                                           <option value="81%"
                                                                              @if($info->marks == '81%')
                                                                                 selected
                                                                              @endif
                                                                           >81%</option>
                                                                           <option value="82%"
                                                                              @if($info->marks == '82%')
                                                                                 selected
                                                                              @endif
                                                                           >82%</option>
                                                                           <option value="83%"
                                                                              @if($info->marks == '83%')
                                                                                 selected
                                                                              @endif
                                                                           >83%</option>
                                                                           <option value="84%"
                                                                              @if($info->marks == '84%')
                                                                                 selected
                                                                              @endif
                                                                           >84%</option>
                                                                           <option value="85%"
                                                                              @if($info->marks == '85%')
                                                                                 selected
                                                                              @endif
                                                                           >85%</option>
                                                                           <option value="86%"
                                                                              @if($info->marks == '86%')
                                                                                 selected
                                                                              @endif
                                                                           >86%</option>
                                                                           <option value="87%"
                                                                              @if($info->marks == '87%')
                                                                                 selected
                                                                              @endif
                                                                           >87%</option>
                                                                           <option value="88%"
                                                                              @if($info->marks == '88%')
                                                                                 selected
                                                                              @endif
                                                                           >88%</option>
                                                                           <option value="89%"
                                                                              @if($info->marks == '89%')
                                                                                 selected
                                                                              @endif
                                                                           >89%</option>
                                                                           <option value="90%"
                                                                              @if($info->marks == '90%')
                                                                                 selected
                                                                              @endif
                                                                           >90%</option>
                                                                           <option value="91%"
                                                                              @if($info->marks == '91%')
                                                                                 selected
                                                                              @endif
                                                                           >91%</option>
                                                                           <option value="92%"
                                                                              @if($info->marks == '92%')
                                                                                 selected
                                                                              @endif
                                                                           >92%</option>
                                                                           <option value="93%"
                                                                              @if($info->marks == '93%')
                                                                                 selected
                                                                              @endif
                                                                           >93%</option>
                                                                           <option value="94%"
                                                                              @if($info->marks == '94%')
                                                                                 selected
                                                                              @endif
                                                                           >94%</option>
                                                                           <option value="95%"
                                                                              @if($info->marks == '95%')
                                                                                 selected
                                                                              @endif
                                                                           >95%</option>
                                                                           <option value="96%"
                                                                              @if($info->marks == '96%')
                                                                                 selected
                                                                              @endif
                                                                           >96%</option>
                                                                           <option value="97%"
                                                                              @if($info->marks == '97%')
                                                                                 selected
                                                                              @endif
                                                                           >97%</option>
                                                                           <option value="98%"
                                                                              @if($info->marks == '98%')
                                                                                 selected
                                                                              @endif
                                                                           >98%</option>
                                                                           <option value="99%"
                                                                              @if($info->marks == '99%')
                                                                                 selected
                                                                              @endif
                                                                           >99%</option>
                                                                           <option value="100%"
                                                                              @if($info->marks == '100%')
                                                                                 selected
                                                                              @endif
                                                                           >100%</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div 
                                                            onclick="this.parentElement.parentElement.remove()"
                                                            class="align-items-center col-12 btn d-none">
                                                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                         </div>
                                                      
                                                      </div>
                                                   </div>
                                                      
                                                   @php
                                                      $i += 1;
                                                   @endphp

                                                @endforeach
                                             @endif
                                             
                                          </div>
                                       </form>
                                       <div class="row mx-0 bg-white shadow" id="add_more_education_container">
                                          <div class="col-12 d-flex align-items-center justify-content-between border-top mt-0 px-4 py-3 text-right" id="student_education_level_information_form_btns">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <a class="mx-2 text-secondary font-weight-bold fs-14" href="javascript:;" id="add_more_education_btn"><i class="far fa-plus mr-1"></i>Add More</a>
                                             </div>
                                             <button 
                                             class="btn btn-green fs-md-14 fs-12 border-0 rounded-pill"
                                             form="student_education_level_information_form"
                                             type="submit"
                                             ><span class="mr-2"><i class="far fa-check-circle"></i></span><span>Save</span></button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="personal-3" role="tabpanel" aria-labelledby="personal-3-tab">
                     <div class="row">
                        <div class="col-12">
                           <div class="row">
                              <div class="col-12 mx-lg-3 shadow px-0 rounded bg-light border">
                                 <div class="row mx-0">
                                 @if( !empty( $my_purchases->toArray() ) )
                                    @foreach($my_purchases as $coaching)
                                       <div class="p-md-3 p-2 col-md-6 d-flex align-items-scratch">
                                          <div class="my-orders row mx-0 py-3 bg-white shadow position-relative">
                                             <div class="d-flex justify-content-end position-absolute right-0 top-0">
                                             
                                                @if(
                                                   preg_match('/classroom/', $coaching->offering) 
                                                ) 
                                                <span style="margin-right: 15px !important;" class="text-uppercase mr-1 px-2 h-20px fs-12  
                                                @if(
                                                   preg_match('/classroom/', $coaching->offering) 
                                                ) 
                                                bg-secondary 
                                                @endif
                                                rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                   @if(
                                                      preg_match('/classroom/', $coaching->offering) 
                                                   ) 
                                                      Classroom
                                                   @endif 
                                                </span>
                                                @endif 
                                                
                                                @if(
                                                   preg_match('/online/', $coaching->offering) 
                                                ) 
                                                <span style="margin-right: 15px !important;" class="text-uppercase mr-1 px-2 h-20px fs-12  
                                                @if(
                                                   preg_match('/online/', $coaching->offering) 
                                                ) 
                                                bg-success
                                                @endif
                                                rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                   @if(
                                                      preg_match('/online/', $coaching->offering) 
                                                   ) 
                                                      Online
                                                   @endif 
                                                </span>
                                                @endif 

                                                @if(
                                                      preg_match('/classroom/', $coaching->offering) 
                                                ) 
                                                @elseif(
                                                   preg_match('/online/', $coaching->offering) 
                                                ) 
                                                @else
                                                <span style="margin-right: 15px !important;" class="text-uppercase mr-1 px-2 h-20px fs-12  
                                                @if(
                                                   preg_match('/classroom/', $coaching->offering) 
                                                ) 
                                                @elseif(
                                                   preg_match('/online/', $coaching->offering) 
                                                ) 
                                                @else
                                                   bg-primary
                                                @endif
                                                rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                   @if(
                                                      preg_match('/classroom/', $coaching->offering) 
                                                   ) 
                                                   @elseif(
                                                      preg_match('/online/', $coaching->offering) 
                                                   ) 
                                                   @else
                                                      Tutor
                                                   @endif 
                                                </span>                                                         
                                                @endif 
                                             </div>
                                             <div class="col-12 text-center mt-md-0 mt-3">
                                                <span class="h-80px p-1 d-flex rounded-pill align-items-center justify-content-center mx-auto w-80px border shadow bg-white position-relative"><img class="w-100 h-100 rounded-pill" 
                                                src="{{ asset('public/coaching/' . $coaching->image) }}" alt=""></span>
                                                <div class="text-center mt-3">
                                                   <h2 class="font-weight-bold text-secondary fs-20">{{$coaching->name ?? ''}}</h2>
                                                   <a href="mailto:{{$coaching->email ?? ''}}" class="fs-13 text-secondary mb-1 d-block">{{$coaching->email ?? ''}}</a>
                                                   <a href="tel:+91 02651 45115" class="fs-13 text-secondary mb-1 d-block">{{$coaching->mobile ?? ''}}</a>
                                                </div>
                                             </div>
                                             <div class="border-top col-12 mt-2">
                                                <div class="row align-items-center bg-white py-2">
                                                   <div class="col fs-13 text-gray font-weight-bold">
                                                      Course Name 
                                                   </div>
                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col fs-13 text-right text-gray font-weight-bold">
                                                      {{$coaching->course_name ?? ''}}
                                                   </div>
                                                </div>
                                                <div class="row align-items-center bg-light py-2">
                                                   <div class="col text-gray fs-13 font-weight-bold">
                                                      Course Type
                                                   </div>
                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col text-right text-gray fs-13 font-weight-bold">
                                                      {{$coaching->course_offering ?? ''}}
                                                   </div>
                                                </div>
                                                <div class="row align-items-center bg-white py-2">
                                                   <div class="col text-gray fs-13 font-weight-bold">
                                                      Course Fee
                                                   </div>
                                                                                 
                                                   @php
                                                      $discount_price = ($coaching->fee * $coaching->offer_percentage) / 100;
                                                      $final_price = ($coaching->fee - $discount_price);
                                                   @endphp

                                                   @if($coaching->gst_inclusive_exclusive == 'exclusive')
                                                      <?php $final_price= $final_price+$final_price * 18 / 100; ?>
                                                   @endif

                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col text-right text-gray fs-13 font-weight-bold">
                                                      &#8377 {{$final_price ?? 0}} <span class="d-block text-primary fs-11"><del class="mr-1">&#8377 
                                                      @if($coaching->gst_inclusive_exclusive == 'exclusive')
                                                         {{$coaching->fee + ($coaching->fee * 18 / 100)}}
                                                      @else
                                                         {{$coaching->fee ?? 0}}
                                                      @endif
                                                      </del> {{$coaching->offer_percentage ?? 0}}%OFF</span>
                                                   </div>
                                                </div>
                                                <div class="row align-items-center bg-light py-2">
                                                   <div class="col text-gray fs-13 font-weight-bold">
                                                      Additional discount
                                                   </div>
                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col text-right text-gray fs-13 font-weight-bold">
                                                      &#8377 {{$coaching->discount_total ?? 0}}
                                                   </div>
                                                </div>
                                                <div class="row align-items-center bg-light py-2">
                                                   <div class="col text-gray fs-13 font-weight-bold">
                                                      Amount Paid
                                                   </div>
                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col text-right text-gray fs-13 font-weight-bold">
                                                      &#8377 {{$coaching->total_price ?? 0}}
                                                      <span class="font-weight-normal d-block fs-10">{{ date('F d, Y h:i', strtotime($coaching->created_at)  )}}</span>
                                                   </div>
                                                </div>
                                                <div class="row align-items-center bg-white py-2">
                                                   <div class="col text-gray fs-13 font-weight-bold">
                                                      Remaining Payment
                                                   </div>
                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col text-right text-gray fs-13 font-weight-bold">
                                                      &#8377 {{$coaching->remaining_amount ?? 0 }}
                                                   </div>
                                                </div>
                                                <div class="d-none row align-items-center bg-light py-2">
                                                   <div class="col text-gray fs-13 font-weight-bold">
                                                      Past Payment
                                                      <spa class="text-secondary font-weight-bold d-block">
                                                      American Express
                                                      </span>
                                                   </div>
                                                   <div class="col-auto px-0">-</div>
                                                   <div class="col text-right text-gray fs-13 font-weight-bold">
                                                      &#8377 {{$coaching->total_price ?? 0}}
                                                      <span class="font-weight-normal d-block fs-10">17:55 07 Jan</span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-12 mt-4 text-center d-flex align-items-center justify-content-between">
                                                <a class="font-weight-bold fs-13" 
                                                href="{{ action('Website\StudentProfileController@download_invoice', $coaching->ccdi) }}"
                                                ><i class="fas fa-file-alt mr-1"></i>Download Invoice</a>
                                             </div>
                                          </div>
                                       </div>
                                    @endforeach
                                     @else
                                       <div class="col-12 d-flex justify-content-center my-4">
                                          <h3 class="text-danger text-center">No Data Found</h3>
                                       </div>
                                 @endif

                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="personal-2" role="tabpanel" aria-labelledby="personal-2-tab">
                     <div class="row profile_tabs_inner">
                        <div class="col-12 mx-lg-3 shadow py-md-4 py-2 px-md-4 px-2 rounded bg-white">
                           <nav>
                              <div class="nav nav-tabs mb-md-4 mb-0 border-0" id="nav-tab" role="tablist">
                                 <a class="nav-link active" id="nav-tab-5-tab" data-toggle="tab" href="#nav-tab-5" role="tab" aria-controls="nav-tab-5" aria-selected="false">
                                    Favourite Coaching
                                 </a>
                                 <a class="nav-link" id="nav-tab-10-tab" data-toggle="tab" href="#nav-tab-10" role="tab" aria-controls="nav-tab-10" aria-selected="false">
                                    Favourite College
                                 </a>
                                 <a class="nav-link" id="nav-tab-6-tab" data-toggle="tab" href="#nav-tab-6" role="tab" aria-controls="nav-tab-6" aria-selected="false">
                                    Request a Callback
                                 </a>
                                 <a class="nav-link" id="nav-tab-7-tab" data-toggle="tab" href="#nav-tab-7" role="tab" aria-controls="nav-tab-7" aria-selected="false">
                                    Tests & Downloads
                                 </a>
                                 <a class="nav-link" id="nav-tab-1-tab" data-toggle="tab" href="#nav-tab-1" role="tab" aria-controls="nav-tab-1" aria-selected="true">
                                    Reviews
                                 </a>
                                 <a class="nav-link" id="nav-tab-2-tab" data-toggle="tab" href="#nav-tab-2" role="tab" aria-controls="nav-tab-2" aria-selected="false">
                                    Comments 
                                 </a>
                                 <a class="nav-link mt-1" id="nav-tab-3-tab" data-toggle="tab" href="#nav-tab-3" role="tab" aria-controls="nav-tab-3" aria-selected="false">
                                    Q&A- Question
                                 </a>
                                 <a class="nav-link mt-1" id="nav-tab-15-tab" data-toggle="tab" href="#nav-tab-15" role="tab" aria-controls="nav-tab-15" aria-selected="false">
                                    Q&A- Answer
                                 </a>
                              </div>
                           </nav>
                           <div class="tab-content" id="nav-tabContent">
                              <div class="tab-pane fade" id="nav-tab-1" role="tabpanel" aria-labelledby="nav-tab-1-tab">
                                 <div class="row mb-0 mt-mb-0 mt-3">
                                    <div class="col-12">
                                       <div class="text-left mb-md-4 mb-3">
                                          <h2 class="font-weight-bold fs-md-20 fs-16 border-bottom pb-2 mb-0">Coaching Reviews </h2>
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       
                                       @if( !empty($history_with_coaching_select->reviews->toArray()) )
                                                                                       
                                          @php
                                             $index = 1;
                                          @endphp
                                          
                                          @foreach($history_with_coaching_select->reviews as $coaching)
                                             
                                             <div class="row my-2">
                                                <div class="col-12 mb-0">
                                                   <div class="row bg-light mx-0 py-2 rounded shadow border" data-toggle="collapse" href="#coaching-reviews-index-{{$index}}" aria-expanded="false" aria-controls="collapseExample">
                                                      <div class="col-12">
                                                         <div class="row align-items-center position-relative">
                                                            <div class="col-auto px-md-3 pr-1 pl-2">
                                                               <div class="shadow rounded-pill h-md-70px w-md-70px h-45px w-45px p-1 border">
                                                                           
                                                                  @php
                                                                     $image = asset('public/coaching/'. $coaching->image);

                                                                     if(! @GetImageSize($image) ) {
                                                                        $image = asset('public/logo.png');
                                                                     }
                                                                  @endphp

                                                                  <img 
                                                                     class="rounded-pill h-md-60px w-md-60px h-100 w-100" 
                                                                     src="{{ $image }}" 
                                                                     alt="">
                                                               </div>
                                                            </div>
                                                            <div class="col px-md-3 px-1">

                                                               @php
                                                                  $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->coaching_name);
                                                               @endphp

                                                               <a 
                                                                  class="text-secondary fs-lg-16 fs-md-14 fs-12 font-weight-bold" 
                                                                  href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"                                                         
                                                               >
                                                               {{$coaching->coaching_name}}
                                                               </a>
                                                            </div>
                                                            <div class="col-auto px-md-3 px-2">
                                                               <a href="javascript:;" class="btn btn-danger rounded-pill fs-md-14 h-md-auto h-24px d-flex align-items-center justify-content-center fs-10 py-md-1 px-md-2 px-1 text-right">{{$coaching->course }}</a>
                                                            </div>
                                                            <div class="col-auto px-md-3 px-2">
                                                               <a href="javascript:;" class="fs-md-30 fs-18 text-secondary d-flex"><i class="fad fa-angle-down"></i></i></a>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="collapse" id="coaching-reviews-index-{{$index}}">
                                                      <div class="col-auto d-inline-block text-capitalize fs-14 font-weight-bold text-dark px-0 position-relative z-index-1 bottom-n13px bg-white left-10px px-2 py-1">Review </div>
                                                      <div class="bg-white px-3 py-md-4 py-3 mb-3 position-relative border">
                                                         <p class="fs-md-15 fs-14 text-gray mb-0">
                                                            @php
                                                               echo $coaching->description;
                                                            @endphp
                                                         </p>
                                                         <div class="row coments_single align-items-center position-absolute top-n12px bg-white right-30px">

                                                            <div class="col-auto px-1">
                                                                @if($coaching->status=='disable')
                                                               <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="rounded border h-24px py-1 px-2 text-center fs-16 text-secondary"><i class="fal fa-ellipsis-h-alt"></i></a>
                                                               <div class="dropdown-menu bg-light shadow" aria-labelledby="dropdownMenuButton">
                                                                  <ul class="list-unstyled mb-0 pl-0">
                                                                     <li>
                                                                     <a 
                                                                        class="px-2 fs-12 bg-success rounded-top" 
                                                                        href="{{ action('Website\CoachingController@reviews', [$coaching->coaching_name_slug,'yes']) }}#review_sec"
                                                                     ><i class="fas fa-edit mr-2"></i>Edit</a></li>
                                                                     <li>

                                                                     @php
                                                                        $url = action('Website\CoachingController@delete_student_review', 'coaching_id=' . $coaching->coaching_id);
                                                                        $msg = 'Are you sure?';

                                                                        $onclick = 'delete_sweet_alert("'.$url.'", "'.$msg.'")';
                                                                     @endphp
                                                                     
                                                                     <a 
                                                                        class="px-2 fs-12 bg-primary border-0 rounded-bottom" 
                                                                        href="#"
                                                                        onclick='{{$onclick}}'
                                                                     ><i class="fas fa-trash-alt mr-2"></i>Delete</a></li>
                                                                  </ul>
                                                               </div>
                                                               @endif
                                                            </div>

                                                         </div>
                                                      </div>
                                                      <div class="row coaching_review_tab mt-4 justify-content-center">
                                                         <div class="col-md-4 pl-md-3 pl-5 mb-md-4 mb-3">
                                                            <div class="w-100 position-relative shadow bg-white text-center border row rounded align-items-center mx-0 py-4 px-4">
                                                               <span class="h-35px w-35px mb-0 top-20px rounded border shadow fs-16 position-absolute left-n17px d-flex align-items-center justify-content-center mx-auto bg-white"><i class="fas fa-brain"></i></span>
                                                               <div class="col text-left">
                                                                  <strong class="fs-lg-15 fs-md-13 fs-13 d-inline-block">Faculty</strong>
                                                               </div>
                                                               <div class="px-2 py-1 fs-md-15 fs-13 bg-primary d-inline-flex text-white rounded">
                                                                  {{$coaching->faculty_stars}}
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-4 pl-md-3 pl-5 mb-md-4 mb-3">
                                                            <div class="w-100 position-relative shadow bg-white text-center border row rounded align-items-center mx-0 py-4 px-4">
                                                               <span class="h-35px w-35px mb-0 top-20px rounded border shadow fs-16 position-absolute left-n17px d-flex align-items-center justify-content-center mx-auto bg-white"><i class="fas fa-books"></i></span>
                                                               <div class="col text-left">
                                                                  <strong class="fs-lg-15 fs-md-13 fs-13 d-inline-block">Study Materials</strong>
                                                               </div>
                                                               <div class="px-2 py-1 fs-md-15 fs-13 bg-primary d-inline-flex text-white rounded">
                                                                  {{$coaching->study_materials_stars}}
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-4 pl-md-3 pl-5 mb-md-4 mb-3">
                                                            <div class="w-100 position-relative shadow bg-white text-center border row rounded align-items-center mx-0 py-4 px-4">
                                                               <span class="h-35px w-35px mb-0 top-20px rounded border shadow fs-16 position-absolute left-n17px d-flex align-items-center justify-content-center mx-auto bg-white"><i class="fas fa-lightbulb"></i></span>
                                                               <div class="col text-left">
                                                                  <strong class="fs-lg-15 fs-md-13 fs-13 d-inline-block">Doubt clearing</strong>
                                                               </div>
                                                               <div class="px-2 py-1 fs-md-15 fs-13 bg-primary d-inline-flex text-white rounded">
                                                                  {{$coaching->doubt_clearing_stars}}
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-4 pl-md-3 pl-5 mb-md-4 mb-3">
                                                            <div class="w-100 position-relative shadow bg-white text-center border row rounded align-items-center mx-0 py-4 px-4">
                                                               <span class="h-35px w-35px mb-0 top-20px rounded border shadow fs-16 position-absolute left-n17px d-flex align-items-center justify-content-center mx-auto bg-white"><i class="fad fa-chalkboard"></i></span>
                                                               <div class="col text-left">
                                                                  <strong class="fs-lg-15 fs-md-13 fs-13 d-inline-block">Mentorship & Teaching Style</strong>
                                                               </div>
                                                               <div class="px-2 py-1 fs-md-15 fs-13 bg-primary d-inline-flex text-white rounded">
                                                                  {{$coaching->mentorship_stars}}
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-4 pl-md-3 pl-5 mb-md-4 mb-3">
                                                            <div class="w-100 position-relative shadow bg-white text-center border row rounded align-items-center mx-0 py-4 px-4">
                                                               <span class="h-35px w-35px mb-0 top-20px rounded border shadow fs-16 position-absolute left-n17px d-flex align-items-center justify-content-center mx-auto bg-white">
                                                                  <i class="fad fa-user-headset"></i>
                                                               </span>
                                                               <div class="col text-left">
                                                                  <strong class="fs-lg-15 fs-md-13 fs-13 d-inline-block">Tech Support</strong>
                                                               </div>
                                                               <div class="px-2 py-1 fs-md-15 fs-13 bg-primary d-inline-flex text-white rounded">
                                                                  {{$coaching->tech_support_stars}}
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <strong class="fs-lg-15 fs-md-14 fs-13 font-weight-bold d-block mt-lg-4 mt-md-3 mt-2 text-center"><span class="bg-white shadow rounded-pill d-inline-flex border align-items-center justify-content-center h-40px fs-16 w-40px mr-2"><i class="fas fa-praying-hands"></i></span> Thank you for reviewing CoachingSelect! We will share your feedback with our community!</strong>
                                                   </div>
                                                </div>
                                             </div>
                                                
                                             @php
                                                $index += 1;
                                             @endphp

                                          @endforeach
                                       @else
                                          <div class="col-12 d-flex justify-content-center my-4">
                                             <h3 class="text-danger text-center">No Reviews Found</h3>
                                          </div>
                                       @endif

                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="nav-tab-2" role="tabpanel" aria-labelledby="nav-tab-2-tab">
                                 <div class="row mt-md-0 mt-3">
                                    <div class="col-12">
                                       <div class="text-left mb-md-4 mb-3">
                                          <h2 class="font-weight-bold fs-md-20 fs-16 border-bottom pb-2 mb-0">Blog Comments </h2>
                                       </div>
                                    </div>
                                    <div class="col-12">

                                       @if( !empty($history_with_coaching_select->comments->toArray()) )
                                                                                       
                                          @php
                                             $index = 1;
                                          @endphp
                                          
                                          @foreach($history_with_coaching_select->comments as $blog)
                                             
                                             @php
                                                $slug = str_replace(' ', '-', $blog->blog_title);
                                             @endphp
                                             
                                             <div class="row mb-3 mx-0">
                                                <div class="w-100 media mt-3 border shadow px-md-4 px-2 pb-md-4 pb-3 pt-md-5 pt-4 rounded-5 bg-white position-relative">
                                                   <div class="row align-items-center position-absolute top-n8px mx-0 bg-white">
                                                      <div class="col px-md-3 px-1">
                                                         <a class="text-primary d-block fs-md-15 fs-13 font-weight-bold" 
                                                         href="{{ action('Website\BlogsController@blog', $slug) }}#go_to_comment_box"
                                                         ><span class="text-secondary">{{$index}}.</span> 
                                                         @php
                                                            echo substr($blog->blog_title, 0, 30);
                                                         @endphp
                                                         
                                                         @if(strlen($blog->blog_title) > 30)
                                                         ..
                                                         @endif
                                                         </a>
                                                      </div>
                                                   </div>
                                                   <img 
                                                      class="d-flex mr-md-3 mr-2 rounded-circle img-fluid h-md-50px h-40px border shadow"
                                                      src="{{ session()->get('student')->image ?? '' }}"
                                                      onerror="this.src='{{ asset("public/user.png") }}'"
                                                      alt="">
                                                   <div class="media-body fs-14">
                                                      <h5 class="mt-0 fs-md-18 fs-14 text-secondary mb-0">
                                                         {{ session()->get('student')->name ?? '' }}
                                                      </h5>
                                                      <span class="fs-md-12 fs-11 text-gray text-uppercase d-block mt-md-2 mt-1 mb-1">
                                                         {{ date('F d, Y', strtotime($blog->updated_at)  )}}
                                                      </span>
                                                      <p class="fs-md-14 fs-13"> 
                                                         {{$blog->comment}}
                                                      </p>
                                                   </div>
                                                   <div class="row coments_single align-items-center position-absolute top-n12px bg-white right-30px">
                                                      <div class="col-auto px-1">
                                                         <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="rounded border h-md-24px h-20 py-1 px-md-2 px-1 text-center fs-md-16 fs-14 text-secondary"><i class="fal fa-ellipsis-h-alt"></i></a>
                                                         <div class="dropdown-menu bg-light shadow" aria-labelledby="dropdownMenuButton">
                                                                                 
                                                            @php
                                                               $blog_slug = str_replace(' ', '-', $blog->blog_title);
                                                            @endphp

                                                            <ul class="list-unstyled mb-0 pl-0">
                                                               <li>
                                                                  <a 
                                                                     class="px-2 fs-12 bg-success rounded-top" 
                                                                     href="{{ action('Website\BlogsController@blog', $blog_slug) }}#go_to_comment_box"
                                                                  ><i class="fas fa-edit mr-2"></i>Edit</a></li>
                                                               <li>
                                                                  @php

                                                                     $url = action('Website\BlogsController@delete_comment', $slug);
                                                                     $msg = 'Are you sure?';

                                                                     $onclick = 'delete_sweet_alert("'.$url.'", "'.$msg.'")';
                                                                  @endphp
                                                                  <a 
                                                                     class="px-2 fs-12 bg-primary border-0 rounded-bottom" 
                                                                     href="#go_to_comment_box"
                                                                     onclick='{{$onclick}}'
                                                                  ><i class="fas fa-trash-alt mr-2"></i>Delete</a></li>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                         
                                          @php
                                             $index += 1;
                                          @endphp
                                          
                                          @endforeach
                                       @else
                                          <div class="col-12 d-flex justify-content-center my-4">
                                             <h3 class="text-danger text-center">No Comments Found</h3>
                                          </div>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="nav-tab-3" role="tabpanel" aria-labelledby="nav-tab-3-tab">
                                 <div class="row mx-0 mt-md-0 mt-3">
                                    <div class="row mx-0">
                                       <div class="col-12 px-0">
                                          <div class="text-left mb-md-4 mb-3">
                                             <h4 class="font-weight-bold fs-md-20 fs-16 border-bottom pb-2 mb-0 d-block">Questions asked by me: </h4>
                                          </div>
                                       </div>
                                    </div> 
                                    
                                    @if( !empty($history_with_coaching_select->student_questions->toArray()) )
                                                                                    
                                       @php
                                          $index = 1;
                                       @endphp
                                       
                                       @foreach($history_with_coaching_select->student_questions as $student_question)
                                                
                                          <div class="shadow col-12 rounded border bg-light p-md-3 p-2 mb-4">
                                             <div class="bg-white row mx-0 shadow rounded position-relative py-3 px-md-2 px-3">
                                                <div class="col-md-12 col-12 mt-md-3 mt-2 text-justify px-md-3 px-0" style="position:unset">
                                                   <div class="row mb-2">
                                                      <div class="col-12">
                                                            <p class="fs-md-14 fs-13 mb-md-3 mb-0">{{ date('F d, Y', strtotime($student_question->created_at)  )}}</p>        
                                                               @php
                                                                  $question_tags = explode(',', $student_question->tags);
                                                               @endphp

                                                               @if( !empty($question_tags) )
                                                                  @foreach($question_tags as $question_tag)
                                                                     @if( !empty($question_tag) )
                                                                        <a class="text-capitalize fs-md-13 fs-12 border border-secondary text-secondary rounded-pill px-2 mr-1" href="javascript:;">
                                                                           # {{$question_tag}}
                                                                        </a>
                                                                     @endif
                                                                  @endforeach
                                                               @endif
                                                         
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col">
                                                         <h2 class="fs-md-17 fs-14 text-graydark">
                                                            {{$student_question->name}}
                                                         </h2>
                                                      </div>
                                                   </div>
                                                               
                                                   @if( !empty($student_question->latest_answer) )
                                                      <div class="col-auto d-inline-block text-capitalize fs-md-14 fs-12 font-weight-bold text-dark px-0 position-relative z-index-1 bottom-n13px bg-white left-10px px-2 py-1">Someone's answer </div>
                                                      <div class="bg-white px-3 py-3 mb-3 position-relative border">
                                                         <p class="fs-md-15 fs-13 text-gray mb-0">
                                                            {{ $student_question->latest_answer }}
                                                         </p>
                                                      </div>
                                                   @endif

                                                   <div class="row coments_single align-items-center position-absolute top-n20px bg-white right-30px">
                                                      <div class="col-auto px-1">
                                                         <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="rounded border h-24px py-1 px-2 text-center fs-16 text-secondary"><i class="fal fa-ellipsis-h-alt"></i></a>
                                                         <div class="dropdown-menu bg-light shadow" aria-labelledby="dropdownMenuButton" style="">
                                                            <ul class="list-unstyled mb-0 pl-0">
                                                               <li>
                                                                  <a 
                                                                     class="px-2 fs-12 bg-success rounded-top"
                                                                     data-toggle="modal" data-target="#exampleModal7-update-{{$student_question->id}}"
                                                                     href="javascript:;"><i class="fas fa-edit mr-2"></i>Edit</a></li>
                                                               <li>
                                                                  <a 
                                                                     class="px-2 fs-12 bg-primary border-0 rounded-bottom"
                                                                     href="javascript:;"
                                                                     @if( session()->has('student') )
                                                                        onclick="return confirmation('delete_form{{$student_question->id}}')"
                                                                     @endif
                                                                     ><i class="fas fa-trash-alt mr-2"></i>Delete</a></li>
                                                            </ul>
                                                         </div>
                                                      </div>   

                                                      <!-- edit question   -->

                                                      <div class="modal fade ask_question_modal" id="exampleModal7-update-{{$student_question->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content shadow">
                                                               <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                                                                  <h5 class="modal-title text-left" id="exampleModalLabel">Update Your Question</h5>
                                                                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                                                                     <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                                                                  </button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <form action="{{ action('Website\StudentQuestionsAnswersController@update_question') }}" method="post">
                                                                  @csrf
                                                                     <input type="hidden" name="id" value="{{$student_question->id}}">
                                                                     <div class="form-group">
                                                                        <p class="fs-12 mb-2 text-secondary font-weight-bold"><span></span> </p>
                                                                        <textarea class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" placeholder="Type Your Answer..." rows="3" style="height: 100px;" name="name" required
                                                                        minlength="30"
                                                                        >{{$student_question->name}}</textarea>
                                                                     </div>
                                                                     <div class="row align-items-center">
                                                                        <div class="text-left mt-0 col-auto">
                                                                           <button type="submit" class="btn btn-sm px-3 btn-green border-0 rounded-pill"><span class="z-index-2">Update</span>
                                                                           </button>
                                                                        </div>
                                                                     </div>
                                                                  </form>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>

                                                      <!-- delete question -->
                                                      <form action="{{ action('Website\StudentQuestionsAnswersController@delete_question', $student_question->id) }}" method="post" id="delete_form{{$student_question->id}}">
                                                         @csrf
                                                      </form>
                                                   </div>

                                                      
                                                </div>
                                             </div>
                                          </div>

                                          @php
                                             $index += 1;
                                          @endphp
                                          
                                       @endforeach
                                    @else
                                       <div class="col-12 d-flex justify-content-center my-5">
                                          <h3 class="text-danger text-center">No Questions asked by me Found</h3>
                                       </div>
                                    @endif                                    
                                                                     
                                 </div>
                              </div>

                              <div class="tab-pane fade" id="nav-tab-15" role="tabpanel" aria-labelledby="nav-tab-15-tab">
                                 <div class="row mx-0 mt-md-0 mt-3">
                                    <div class="row mx-0">
                                       <div class="col-12 px-0">
                                          <div class="text-left mb-md-4 mb-3">
                                             <h4 class="font-weight-bold fs-md-20 fs-16 border-bottom pb-2 mb-0 d-block">Answers given by me:  </h4>
                                          </div>
                                       </div>
                                    </div>  
                                    
                                    @if( !empty($history_with_coaching_select->student_answers->toArray()) )
                                                                                    
                                       @php
                                          $index = 1;
                                       @endphp
                                       
                                       @foreach($history_with_coaching_select->student_answers as $student_answer)
                                                
                                          <div class="shadow col-12 rounded border bg-light p-md-3 p-2 mb-4">
                                             <div class="bg-white row mx-0 shadow rounded position-relative py-3 px-2">
                                                <div class="col-md-12 col-12 mt-md-3 mt-2 text-justify" style="position:unset">
                                                   <div class="row mb-2">
                                                      <div class="col-12 px-md-3 px-2">
                                                         <p class="fs-md-14 fs-13 mb-md-3 mb-0">{{ date('F d, Y', strtotime($student_answer->created_at)  )}}</p>
                                                                           
                                                               @php
                                                                  $question_tags = explode(',', $student_answer->tags);
                                                               @endphp

                                                               @if( !empty($question_tags) )
                                                                  @foreach($question_tags as $question_tag)
                                                                     @if( !empty($question_tag) )
                                                                     <a class="text-capitalize fs-md-13 fs-12 border border-secondary text-secondary rounded-pill px-2 mr-1" href="javascript:;">
                                                                        # {{$question_tag}}
                                                                     </a>
                                                                     @endif
                                                                  @endforeach
                                                               @endif
                                                         
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col">
                                                         <h2 class="fs-md-17 fs-14 text-graydark">
                                                            {{$student_answer->question}}
                                                         </h2>
                                                      </div>
                                                   </div>
                                                   <div class="col-auto d-inline-block text-capitalize fs-md-14 fs-12 font-weight-bold text-dark px-0 position-relative z-index-1 bottom-n13px bg-white left-10px px-2 py-1">My answer </div>
                                                   <div class="bg-white px-3 py-3 mb-3 position-relative border">
                                                      <p class="fs-md-15 fs-14 text-gray mb-0">
                                                         {{ $student_answer->name }}
                                                      </p>
                                                   </div>
                                                   <div class="row coments_single align-items-center position-absolute top-n20px bg-white right-30px">
                                                      <div class="col-auto px-1">
                                                         <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="rounded border h-24px py-1 px-2 text-center fs-16 text-secondary"><i class="fal fa-ellipsis-h-alt"></i></a>
                                                         <div class="dropdown-menu bg-light shadow" aria-labelledby="dropdownMenuButton" style="">
                                                            <ul class="list-unstyled mb-0 pl-0">
                                                               <li>
                                                                  <a 
                                                                     class="px-2 fs-12 bg-success rounded-top" 
                                                                     data-toggle="modal" 
                                                                     href="#"

                                                                     @if( session()->has('student') )
                                                                        data-target="#exampleModal7-update-answer-{{$student_answer->id}}"
                                                                     @else
                                                                        data-target="#exampleModal1"
                                                                     @endif
                                                                  ><i class="fas fa-edit mr-2"></i>Edit</a></li>
                                                               <li>
                                                                  <a 
                                                                     class="px-2 fs-12 bg-primary border-0 rounded-bottom" 
                                                                     href="javascript:;"
                                                                                 
                                                                     @if( session()->has('student') )
                                                                        onclick="return confirmation('delete_form{{$student_answer->id}}')"
                                                                     @endif
                                                                     
                                                                     ><i class="fas fa-trash-alt mr-2"></i>Delete</a></li>
                                                            </ul>
                                                         </div>
                                                      </div>

                                                      <!-- edit answer -->
                                                      
                                                      <div class="modal fade ask_question_modal" id="exampleModal7-update-answer-{{$student_answer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content shadow">
                                                               <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                                                                  <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Update Your Answer</h5>
                                                                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                                                                     <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                                                                  </button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <form action="{{ action('Website\StudentQuestionsAnswersController@update_answer') }}" method="post">
                                                                  @csrf
                                                                     <input type="hidden" name="id" value="{{$student_answer->id}}">
                                                                     <div class="form-group">
                                                                        <p class="fs-12 mb-2 text-secondary font-weight-bold"><span></span> </p>
                                                                        <textarea class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" placeholder="Type Your Answer..." rows="3" style="height: 100px;" name="name" required
                                                                        minlength="30"
                                                                        >{{$student_answer->name}}</textarea>
                                                                     </div>
                                                                     <div class="row align-items-center">
                                                                        <div class="text-left mt-0 col-auto">
                                                                           <button type="submit" class="btn btn-sm px-3 btn-green border-0 rounded-pill"><span class="z-index-2">Update</span>
                                                                           </button>
                                                                        </div>
                                                                     </div>
                                                                  </form>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>

                                                      <!-- delete answer -->
                                                      
                                                      <form action="{{ action('Website\StudentQuestionsAnswersController@delete_answer', $student_answer->id) }}" method="post" id="delete_form{{$student_answer->id}}">
                                                         @csrf
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          @php
                                             $index += 1;
                                          @endphp
                                          
                                       @endforeach
                                    @else
                                       <div class="col-12 d-flex justify-content-center my-5">
                                          <h3 class="text-danger text-center">No Answers given by me Found</h3>
                                       </div>
                                    @endif                                    
                                                                     
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="nav-tab-4" role="tabpanel" aria-labelledby="nav-tab-4-tab">
                                 <div class="row mx-0">
                                    <div class="col-12 px-0">
                                       <div class="text-left mb-md-4 mb-3">
                                          <h2 class="font-weight-bold fs-md-20 fs-16 border-bottom pb-2 mb-0 d-block">Blogs Submitted Report </h2>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade show active" id="nav-tab-5" role="tabpanel" aria-labelledby="nav-tab-5-tab">
                                 <div class="row coaching-viewed">
                                    <div class="col-12">
                                       <div class="text-left mb-md-4 mb-3">
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="row mx-0">
                                          
                                          @if( !empty($history_with_coaching_select->favorite_coaching->toArray()) )
                                             @foreach($history_with_coaching_select->favorite_coaching as $coaching)
                                                <div class="chip col-lg-4 col-md-4 col-12 mb-md-4 mb-3 d-flex align-items-stretch justify-content-center"
                                                >
                                                   <div class="exam_single_box shadow rounded row w-100">
                                                      <a onclick="this.parentElement.style.display='none'" class="closebtn col-auto position-absolute right-5px top-5px fs-17 text-secondary z-index-1 align-items-center justify-content-center px-0 border border-secondary w-26px h-26px rounded-pill class-cards d-flex
                                                      remove_from_favorite
                                                      "
                                                      data-coaching_id="{{$coaching->id}}"
                                                      ><i class="fas fa-times"></i></a>
                                                      <div class="d-flex flex-column exam-ico bg-white col-12 justify-content-center rounded-top align-items-center fs-50 py-4 px-3 shadow position-relative">
                                                      <div class="d-flex justify-content-space-evenly position-absolute right-0 left-0 top-0">
                                                      
                                                         @if(
                                                            preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         <span style="" class="m-0 px-2 h-20px fs-11  
                                                         @if(
                                                            preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         bg-secondary 
                                                         @endif
                                                         rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                           @if(
                                                               preg_match('/classroom/', $coaching->offering) 
                                                            ) 
                                                               Classroom
                                                            @endif 
                                                         </span>
                                                         @endif 
                                                         
                                                         @if(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         <span style="" class="m-0 px-2 h-20px fs-11  
                                                         @if(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         bg-success
                                                         @endif
                                                         rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                           @if(
                                                               preg_match('/online/', $coaching->offering) 
                                                            ) 
                                                               Online
                                                            @endif 
                                                         </span>
                                                         @endif 

                                                         @if(
                                                               preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         @elseif(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         @else
                                                         <span style="" class="m-0 px-2 h-20px fs-11  
                                                         @if(
                                                            preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         @elseif(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         @else
                                                            bg-primary
                                                         @endif
                                                         rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                           @if(
                                                               preg_match('/classroom/', $coaching->offering) 
                                                            ) 
                                                            @elseif(
                                                               preg_match('/online/', $coaching->offering) 
                                                            ) 
                                                            @else
                                                               Tutor
                                                            @endif 
                                                         </span>                                                         
                                                         @endif 
                                                      </div>
                                                         
                                                         
                                                         @php
                                                            $image = asset('public/coaching/'. $coaching->image);

                                                            if(! @GetImageSize($image) ) {
                                                               $image = asset('public/logo.png');
                                                            }
                                                         @endphp
                                                         
                                                         <img 
                                                            class="w-md-100px w-60px h-md-100px h-60px rounded-pill mt-4" 
                                                            src="{{ $image }}"
                                                            alt=""
                                                         >
                                                         <span class="fs-md-13 fs-12 font-weight-bold d-inline-flex justify-content-right text-center mt-md-4 mt-3 p-1 bg-secondary rounded px-md-3 px-2">
                                                            {{ date('F d, Y', strtotime($coaching->date)  )}}
                                                         </span>
                                                      </div>
                                                      <div class="inner-text col py-3 text-center bg-all-section rounded-bottom">
                                                            
                                                         @php
                                                            $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                                                         @endphp
                                                            
                                                         <a 
                                                         href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                                         class="font-weight-bold fs-14 text-uppercase mb-2 text-white">
                                                            {{ $coaching->name }}
                                                         </a>
                                                         <p class="font-weight-600 mb-0 fs-13">
                                                            <a class="text-white" href="javascript:;">{{$coaching->city ?? '-'}}</a>
                                                         </p>
                                                      </div>
                                                   </div>
                                                </div>
                                             @endforeach
                                          @else
                                             <div class="col-12 d-flex justify-content-center my-4">
                                                <h3 class="text-danger text-center">No Coaching Found</h3>
                                             </div>
                                          @endif

                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="nav-tab-10" role="tabpanel" aria-labelledby="nav-tab-10-tab">
                                 <div class="row college-viewed">
                                    <div class="col-12">
                                       <div class="text-left mb-md-4 mb-3">
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="row mx-0">
                                          
                                          @if( !empty($history_with_coaching_select->favorite_college->toArray()) )
                                             @foreach($history_with_coaching_select->favorite_college as $college)
                                                <div class="chip col-lg-4 col-md-4 col-12 mb-md-4 mb-3 d-flex align-items-stretch justify-content-center"
                                                >
                                                   <div class="exam_single_box shadow rounded row w-100">
                                                      <a onclick="this.parentElement.style.display='none'" class="closebtn col-auto position-absolute right-5px top-5px fs-17 text-secondary z-index-1 align-items-center justify-content-center px-0 border border-secondary w-26px h-26px rounded-pill class-cards d-flex
                                                      remove_from_favorite1
                                                      "
                                                      data-college_id="{{$college->id}}"
                                                      ><i class="fas fa-times"></i></a>
                                                      <div class="exam-ico bg-white col-12 justify-content-center rounded-top d-flex flex-column align-items-center fs-50 py-4 px-3 shadow position-relative">
                                                         
                                                         @php
                                                            $image = asset('public/college/'. $college->image);

                                                            if(! @GetImageSize($image) ) {
                                                               $image = asset('public/logo.png');
                                                            }
                                                         @endphp
                                                         
                                                         <img 
                                                            class="img-fluid mt-4 w-md-100px w-60px h-md-100px h-60px" 
                                                            src="{{ $image }}"
                                                            alt=""
                                                         >
                                                         <span class="fs-md-13 fs-12 font-weight-bold d-inline-flex justify-content-right text-center mt-md-4 mt-3 p-1 bg-secondary rounded px-md-3 px-2">
                                                            {{ date('F d, Y', strtotime($college->date)  )}}
                                                         </span>
                                                      </div>
                                                      <div class="inner-text col py-3 text-center bg-all-section rounded-bottom">
                                                            
                                                         @php
                                                            $college->college_name_slug = str_replace(' ', '-', $college->name);
                                                         @endphp
                                                            
                                                         <a 
                                                         href="{{ action('Website\CollegeController@college', [$college->college_name_slug]) }}"
                                                         class="font-weight-bold fs-14 text-uppercase mb-2 text-white">
                                                            {{ $college->name }}
                                                         </a>
                                                      </div>
                                                   </div>
                                                </div>
                                             @endforeach
                                          @else
                                             <div class="col-12 d-flex justify-content-center my-4">
                                                <h3 class="text-danger text-center">No College Found</h3>
                                             </div>
                                          @endif

                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="nav-tab-6" role="tabpanel" aria-labelledby="nav-tab-6-tab">
                                 <div class="row coaching-viewed">
                                    <div class="col-12">
                                       <div class="text-left mb-md-4 mb-3">
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="row mx-0">
                                          
                                          @if( !empty($history_with_coaching_select->request_callback->toArray()) )
                                             @foreach($history_with_coaching_select->request_callback as $coaching)
                                                <div class="chip col-lg-4 col-md-4 col-12 mb-md-4 mb-3 d-flex align-items-stretch justify-content-center"
                                                >
                                                   <div class="exam_single_box shadow rounded row w-100">
                                                      
                                                      <div class="d-flex flex-column exam-ico bg-white col-12 justify-content-center rounded-top align-items-center fs-50 py-4 px-3 shadow position-relative">
                                                      <div class="d-flex justify-content-space-evenly position-absolute right-0 left-0 top-0">
                                                      
                                                         @if(
                                                            preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         <span style="" class="m-0 px-2 h-20px fs-11  
                                                         @if(
                                                            preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         bg-secondary 
                                                         @endif
                                                         rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                           @if(
                                                               preg_match('/classroom/', $coaching->offering) 
                                                            ) 
                                                               Classroom
                                                            @endif 
                                                         </span>
                                                         @endif 
                                                         
                                                         @if(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         <span style="" class="m-0 px-2 h-20px fs-11  
                                                         @if(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         bg-success
                                                         @endif
                                                         rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                           @if(
                                                               preg_match('/online/', $coaching->offering) 
                                                            ) 
                                                               Online
                                                            @endif 
                                                         </span>
                                                         @endif 

                                                         @if(
                                                               preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         @elseif(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         @else
                                                         <span style="" class="m-0 px-2 h-20px fs-11  
                                                         @if(
                                                            preg_match('/classroom/', $coaching->offering) 
                                                         ) 
                                                         @elseif(
                                                            preg_match('/online/', $coaching->offering) 
                                                         ) 
                                                         @else
                                                            bg-primary
                                                         @endif
                                                         rounded-bottom d-inline-flex justify-content-center align-items-center mx-auto">
                                                           @if(
                                                               preg_match('/classroom/', $coaching->offering) 
                                                            ) 
                                                            @elseif(
                                                               preg_match('/online/', $coaching->offering) 
                                                            ) 
                                                            @else
                                                               Tutor
                                                            @endif 
                                                         </span>                                                         
                                                         @endif 
                                                      </div>
                                                         
                                                         @php
                                                            $image = asset('public/coaching/'. $coaching->image);

                                                            if(! @GetImageSize($image) ) {
                                                               $image = asset('public/logo.png');
                                                            }
                                                         @endphp
                                                         
                                                         <img 
                                                            class="w-md-100px w-60px h-md-100px h-60px mt-4" 
                                                            src="{{ $image }}"
                                                            alt=""
                                                         >
                                                         <span class="fs-md-13 fs-12 font-weight-bold d-inline-flex justify-content-right text-center mt-md-4 mt-3 p-1 bg-secondary rounded px-md-3 px-2">
                                                            {{ date('F d, Y', strtotime($coaching->date)  )}}
                                                         </span>
                                                      </div>
                                                      <div class="inner-text col py-3 text-center bg-all-section rounded-bottom">
                                                            
                                                         @php
                                                            $coaching->coaching_name_slug = str_replace(' ', '-', $coaching->name);
                                                         @endphp
                                                            
                                                         <a 
                                                         href="{{ action('Website\CoachingController@overview', [$coaching->coaching_name_slug]) }}"
                                                         class="font-weight-bold fs-14 text-uppercase mb-2 text-white">
                                                            {{ $coaching->name }}
                                                         </a>
                                                         
                                                         <p class="font-weight-600 mb-0 fs-13">
                                                            <a class="text-white" href="javascript:;">{{$coaching->city ?? '-'}}</a>
                                                         </p>
                                                      </div>
                                                   </div>
                                                </div>
                                             @endforeach
                                          @else
                                             <div class="col-12 d-flex justify-content-center my-4">
                                                <h3 class="text-danger text-center">No Coaching Found</h3>
                                             </div>
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="nav-tab-7" role="tabpanel" aria-labelledby="nav-tab-7-tab">
                                 <div class="row test-download">
                                    <div class="col-12">
                                       <div class="text-left mb-md-4 mb-3">
                                       </div>
                                    </div>
                                    <div class="col-12">

                                    @if( !empty($history_with_coaching_select->test_and_downloads->toArray()) )
                                       
                                       @php
                                          $index = 1;
                                       @endphp

                                       @foreach($history_with_coaching_select->test_and_downloads as $test)
                                             
                                          <div class="row">
                                             <div class="col-12 mb-4">
                                                <div class="shadow rounded border bg-all-section p-2">
                                                   <div class="row bg-white mx-0 py-md-2 py-3 rounded-top shadow" data-toggle="collapse" href="#collapseExampleexam-index-{{$index}}" aria-expanded="false" aria-controls="collapseExample">
                                                      <div class="col-12">
                                                         <div class="row align-items-center position-relative justify-content-md-start justify-content-center">
                                                            <div class="col-md-auto">
                                                               <div class="shadow rounded-pill h-md-70px w-md-70px h-45px w-45px p-1 border mx-auto">
                                                                  
                                                                  @php
                                                                     $image = asset('public/question_paper_subjects/'. $test->image);

                                                                     if(! @GetImageSize($image) ) {
                                                                        $image = asset('public/logo.png');
                                                                     }
                                                                  @endphp
                                                                  
                                                                  <img 
                                                                     class="rounded-pill h-md-60px h-100 w-md-60px w-100" 
                                                                     src="{{ $image }}"
                                                                     alt="">
                                                               </div>
                                                            </div>
                                                            <div class="col-sm text-md-start text-center">
                                                               <a class="text-secondary fs-lg-16 fs-md-14 fs-12 font-weight-bold d-block" href="javascript:;">
                                                                  {{ $test->name }}
                                                               </a>
                                                            </div>
                                                            <div class="col-sm text-md-start text-center my-md-0 my-2">
                                                               <div class="row justify-content-center">
                                                                  @php
                                                                     $slug = str_replace(' ', '-', $test->name);
                                                                  @endphp
                                                                  <a 
                                                                     href="{{ action('Website\FreePreparationToolController@test', [$test->course_id, $slug]) }}"
                                                                     class="btn btn-success border-0 fs-lg-15 fs-md-14 fs-11 rounded-pill mx-1 mt-1"><span><i class="fas fa-file-search mr-2"></i>Analyze your result</span></a>
                                                               </div>
                                                            </div>
                                                            <div class="col-sm text-md-start text-center">
                                                               <div class="row justify-content-center">
                                                                  <div class="col-auto text-center">
                                                                     <label class="text-secondary fs-md-14 fs-13 font-weight-bold d-block mb-0" for="">Date</label>
                                                                     <span class="fs-md-14 fs-13">
                                                                        {{ date('F d, Y h:i a', strtotime($test->date)  )}}
                                                                     </span>
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
                                             $index += 1;
                                          @endphp

                                       @endforeach
                                    @else
                                       <div class="col-12 d-flex justify-content-center my-4">
                                          <h3 class="text-danger text-center">No Test Found</h3>
                                       </div>
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
         </div>
      </div>
   </section>
</main>
<div class="modal comman_modal_popup fade" id="Change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content border-0">
            <div class="modal-body p-0 row mx-0 border-0 position-relative">
               <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
               <div class="card shadow-lg col-md-12 border-0 mb-0">
                  <div class="card-body py-5 px-sm-5">
                     <div>
                        <div class="mb-md-5 mb-4 text-center">
                           <h6 class="h3 mb-1 fs-md-24 fs-18">Change Password</h6>
                        </div>
                        <span class="clearfix"></span>
                        <form action="" method="post" class="row" autocomplete="FALSE" id="change_password_form">
                           @csrf
                           <div class="form-group col-12 mb-3">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div>
                                    <label class="form-control-label">Current Password</label>
                                 </div>
                              </div>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-key"></i>
                                    </span>
                                 </div>
                                 <input required type="password" name="old_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px" placeholder="Password">
                              </div>

                              <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                       1) Min. of 6 characters <br/>
                                       2) Must include letters and numbers <br/>">
                                 <span class="d-grid align-items-center justify-content-center  w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-12" style="
                                       /* right: 19px; */
                                    "></span>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group col-12 mb-3">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div>
                                    <label class="form-control-label">New Password</label>
                                 </div>
                              </div>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-key"></i>
                                    </span>
                                 </div>
                                 <input required type="password" name="new_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px"  placeholder="Password">
                              </div>

                              <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                       1) Min. of 6 characters <br/>
                                       2) Must include letters and numbers <br/>">
                                 <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-12" style="
                                       /* right: 19px; */
                                    "></span>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group col-12 mb-3">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div>
                                    <label class="form-control-label">Confirm Password</label>
                                 </div>
                              </div>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-key"></i>
                                    </span>
                                 </div>
                                 <input required type="password" name="confirm_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px"  placeholder="Password">
                              </div>

                              <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                       1) Min. of 6 characters <br/>
                                       2) Must include letters and numbers <br/>">
                                 <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-12" style="
                                       /* right: 19px; */
                                    "></span>
                                 </span>
                              </div>
                           </div>
                           <div class="mt-4 col-12">                              
                              <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return change_password()">Change Password</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   


   <div class="modal comman_modal_popup fade" id="send-email-otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content border-0">
            <div class="modal-body p-0 row mx-0 border-0 position-relative">
               <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
               <div class="card shadow-lg col-md-12 border-0 mb-0">
                  <div class="card-body py-5 px-sm-5">
                     <div>
                        <div class="mb-5 text-center">
                           <h6 class="h3 mb-1">Verify Email</h6>
                           <p class="text-muted mb-0">OTP is sent on your mail id.</p>
                           <p class="text-muted mb-0 font-weight-bold" id="email_will_show_here"></p>
                        </div>
                        <span class="clearfix"></span>
                        <form method="post" class="verify_otp_form row" autocomplete="off"
                        id="verify_form_of_student"
                        >
                           @csrf
                           <div class="form-group col-12">
                              <label class=form-control-label>OTP (one time password)</label>
                              <input type="hidden" name="field" value="email" required>
                              <div class="digit-group row">
                                 <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[1]" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" required>
                                 <input class="inputs col px-0 text-center mx-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[2]" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" required>
                                 <input class="inputs col px-0 text-center mx-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[3]" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" required>
                                 <input class="inputs col px-0 text-center mx-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[4]" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" required>
                              </div>
                              
                              <a href="javascript:;" onclick="document.getElementById('verify_form_of_student').reset();return verify_resend_otp_function();" class="small font-weight-bold">Resend OTP</a>
                           </div>
                           <div class="mt-4 col-12">
                              <button type="submit" class="btn btn-block btn-primary h-50px align-items-center d-grid verify_otp_button">Verify</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal comman_modal_popup fade" id="send-mobile-otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content border-0">
            <div class="modal-body p-0 row mx-0 border-0 position-relative">
               <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
               <div class="card shadow-lg col-md-12 border-0 mb-0">
                  <div class="card-body py-5 px-sm-5">
                     <div>
                        <div class="mb-5 text-center">
                           <h6 class="h3 mb-1">Verify MOBILE NUMBER </h6>
                           <p class="text-muted mb-0 mt-4">One time password is sent on +91-<span id="mobile_will_show_here"></span></p>
                        </div>
                        <span class="clearfix"></span>
                        <form method="post" class="verify_otp_form row mx-0" autocomplete="off"
                        >
                           @csrf
                           <div class=form-group>
                              <label class=form-control-label>OTP (one time password)</label>
                              <input type="hidden" name="field" value="mobile" required>
                              <div class="digit-group row">
                                 <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[1]" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" required>
                                 <input class="inputs col px-0 text-center mx-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[2]" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" required>
                                 <input class="inputs col px-0 text-center mx-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[3]" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" required>
                                 <input class="inputs col px-0 text-center mx-1 h-50px form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none" type="text" name="otp[4]" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" required>
                              </div>
                           </div>
                           <div class="mt-4 col-12 px-0">                              
                              <button type="submit" class="btn btn-block btn-primary h-50px align-items-center d-grid verify_otp_button">Verify</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@include('website/layouts/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
<script>
   var rangeSlider = function() {
      var slider = $('.range-slider'),
         range = $('.range-slider__range'),
         value = $('.range-slider__value');
   
      slider.each(function() {
   
         value.each(function() {
            var value = $(this).prev().attr('value');
            $(this).html(value);
         });
   
         range.on('input', function() {
            $(this).next(value).html(this.value + '%');
         });
      });
   };
   rangeSlider();
</script>
<script>
   $(document).ready(function() {
   
      var readURL = function(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();
   
            reader.onload = function(e) {
               $('.profile-pic').attr('src', e.target.result);
            }
   
            reader.readAsDataURL(input.files[0]);

            setTimeout(() => {
               $('#student_profile_form').submit();
            }, 500);
         }
      }
   
      $(".file-upload").on('change', function() {
         readURL(this);
      });
   
      $(".upload-button").on('click', function() {
         $(".file-upload").click();
      });
   });
</script>
<script>
   $('#editname').on('click', function() {
      // alert('hello');
      $("#name-box").addClass('d-none');
      $("#name-box").removeClass('d-block');
      $("#name-text").addClass('d-block');
      $("#name-text").removeClass('d-none');
      $("#name").focus();
   });
   $('#savename').on('click', function() {
      $("#name-box").removeClass('d-none');
      $("#name-box").addClass('d-block');
      $("#name-text").removeClass('d-block');
      $("#name-text").addClass('d-none');
   });
</script>
<script>
   $(function () {

      var d = new Date();
      var year = d.getFullYear() - 5;
      d.setFullYear(year);

      $("#datepicker").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: "dd-mm-yyyy",
            range: '1920:' + year + '',
            defaultDate: d
      });
   });
</script>

<!-- custom js -->
<script>
   $(document).on('click', '.save_button', function() {

      var field_name = $(this).data('save_button_id');

      var new_value = $('#' + field_name).val();

      $('[data-id="' + field_name + '"').text(new_value);

      setTimeout(() => {
         $('#student_profile_form').submit();
      }, 500);

   });
</script>

<script>

   $(document).on('click', '.edit_button', function() {
      var field = $(this).data('edit-field');

      $('input[name="' + field + '"]').prop('readonly', false);
      
      $('[data-verify-field="' + field + '"]').removeClass('d-none');
      $(this).addClass('d-none');
   });

   $(document).on('click', '.verify_button', function() {
      var field = $(this).data('verify-field');

      var value = $('#otp-' + field).val();

      $("#" + field + "_will_show_here").text(value);

      send_otp(field, value, 0);
      
   });

   function verify_resend_otp_function() {
      var field = 'email';

      var value = $('#otp-' + field).val();

      $("#" + field + "_will_show_here").text(value);

      send_otp(field, value, 1);
      
   }
   
   $(document).on('click', '.verify_button_alternate', function() {
      var field = $(this).data('verify-field');

      $('input[name="' + field + '"]').prop('readonly', true);
      
      $('[data-edit-field="' + field + '"]').removeClass('d-none');
      $(this).addClass('d-none');

      setTimeout(() => {
         $('#student_profile_form').submit();
      }, 500);

   });

   function send_otp(field, value, is_resend_btn_clicked) {

      var url = '{{ action("Website\StudentProfileController@send_otp") }}';
      
      $.ajax({
         url: url,
         type: "POST",
         dataType: "json",
         data: {
            field,
            'value': value,
            '_token': '{{ csrf_token() }}'
         },
         success: function(data) {

            if (data.success) {

               if(is_resend_btn_clicked == 1) {

                  $('.modal.show').find('form .error_message_to_show').remove();
                  $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');
                     
               }

               $('#send-' + field + '-otp').modal('show');

            } else {

               $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

               return false;
            }

            return false;
         }
      });
   }

   $(document).on('submit', '.verify_otp_form', function(e) {
      e.preventDefault();

      var url = '{{ action("Website\StudentProfileController@verify_otp") }}';
      
      var field = this.field.value;

      $.ajax({
         url: url,
         type: "POST",
         dataType: "json",
         data: $(this).serialize(),
         success: function(data) {

            if (data.success) {
               $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

               $('input[name="' + field + '"]').prop('readonly', true);
               
               $('[data-edit-field="' + field + '"]').removeClass('d-none');
               $('[data-verify-field="' + field + '"]').addClass('d-none');

               $('#send-' + field + '-otp').modal('hide');
               
               setTimeout(() => {
                  $('#student_profile_form').submit();
               }, 500);

            } else {

               $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

               return false;
            }

            return false;
         }
      });
   });

</script>

<!-- country state city -->

    <script>
         
        $(document).on('change', '#student_profile_form #country_id', function() {

            $('#student_profile_form #city_id').html('');
            $('#student_profile_form #city_id').selectpicker('refresh');
            
            states();
        });
    </script>

    <script>
        $(document).on('change', '#student_profile_form #state_id', function() {
            cities();

        });
    </script>

    <script>
      function states() {

            $.ajax({
                type: 'POST',
                url: '{{action("Website\StudentProfileController@states")}}',
                data: {
                    country_id: $('#student_profile_form #country_id').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {

                    $('#student_profile_form #state_id').html(
                        '<option value="">State</option>'
                    );

                    data.forEach(element => {
                              
                        var state_id = '{{ session()->get("student")->state ?? "" }}';

                        var is_selected = '';
                        if (state_id == element.name) {
                              is_selected = 'selected';
                        }

                        $('#student_profile_form #state_id').append(
                            '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
                        );
                    });

                    $('#student_profile_form #state_id').selectpicker('refresh');
                           
                  
                  cities();         
                    
                }
            });
        }
    </script>

    <script>
      function cities() {

            $.ajax({
                type: 'POST',
                url: '{{action("Website\StudentProfileController@cities")}}',
                data: {
                    state_id: $('#student_profile_form #state_id').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {

                  $('#student_profile_form #city_id').html(
                     '<option value="">City</option>'
                  );

                  data.forEach(element => {
                           
                     var city_id = '{{ session()->get("student")->city ?? "" }}';

                     var is_selected = '';
                     if (city_id == element.name) {
                           is_selected = 'selected';
                     }

                     $('#student_profile_form #city_id').append(
                           '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
                     );
                  });

                  $('#student_profile_form #city_id').selectpicker('refresh');
                }
            });
        }
    </script>

    <script>      
      
      $('document').ready(function(){
         states();

         setTimeout(() => {
         
         $('.selectpicker').selectpicker('refresh');
            
         }, 1000);

      });
    </script>

    <!-- change password -->
      
   <script>
      function change_password() {

         if(! $('#change_password_form').valid() ) 
            return;

         if (
            $('#change_password_form input[name="old_password"]').val() == '' ||
            $('#change_password_form input[name="new_password"]').val() == '' ||
            $('#change_password_form input[name="confirm_password"]').val() == '' 
         ) {

            $('.modal.show').find('form .error_message_to_show').remove();
            $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');
            
            return false;

         } else {

            if(! (/[A-Za-z]/i.test($('#change_password_form input[name="confirm_password"]').val()) &&
           /[0-9]/.test($('#change_password_form input[name="confirm_password"]').val()) &&
           $('#change_password_form input[name="confirm_password"]').val().length >= 6) ) {

               $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Password does not match'+'</p>');

               return false;
            }

            if(! (/[A-Za-z]/i.test($('#change_password_form input[name="new_password"]').val()) &&
           /[0-9]/.test($('#change_password_form input[name="new_password"]').val()) &&
           $('#change_password_form input[name="new_password"]').val().length >= 6) ) {

            $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid new password'+'</p>');
               return false;
            }

            var url = '{{ action("Website\StudentProfileController@change_password") }}';
            var post_data = $('#change_password_form').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  if (data.success) {

                     $('.modal').modal('hide');

                     document.getElementById("change_password_form").reset();

                  } else {

                     $('.modal.show').find('form .error_message_to_show').remove();
                     $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                     return false;
                  }

                  return false;
               }
            });

            return false;
         }
      }
   </script>

   <!-- is verified -->
   <script>
      $(document).on('click', '.save_changes_button', function(e) {

         var event = e;
      
         $('.verify_button').each( function() {

            if( ! $(this).hasClass('d-none') ) {

               var field = $(this).data('verify-field');

               if(field == 'email') {

                  var current_email_value = $('#otp-email').val();

                  if(current_email_value != '{{ session()->get("student")->email }}') {
                           
                     swal.fire({
                        title: 'Alert!', 
                        'text': 'Please verify new email first to update your profile'
                     });

                     event.preventDefault();
                     return false;

                  }

               } else {

                  var current_mobile_value = $('#otp-mobile').val();

                  if(current_mobile_value != '{{ session()->get("student")->mobile }}') {
                           
                     swal.fire({
                        title: 'Alert!', 
                        'text': 'Please verify new mobile first to update your profile'
                     });

                     event.preventDefault();
                     return false;
                     
                  }

               }

            }

         });
      });
   </script>

   <!-- academic details -->
   
   <script>
      function stream_course() {
         $.ajax({
               type: 'POST',
               url: '{{action("Website\StudentProfileController@stream_course")}}',
               data: {
                  stream_id: $('#student_academic_details #stream_id').val(),
                  _token: '{{csrf_token()}}'
               },
               success: function(data) {

                  $('#student_academic_details #course_id').html(
                    ''
                  );

                  data.forEach((element, index) => {

                     var course_id = '';

                     var is_selected = '';
                     if (course_id == element.id || index == 0) {
                           is_selected = 'selected';
                     }

                     $('#student_academic_details #course_id').append(
                        '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
                     );
                  });

                  $('#student_academic_details #course_id').selectpicker('refresh');
                  $('.selectpicker').selectpicker('refresh');
               }
         });
      }

      $(document).on('change', '#stream_id', function() {
         stream_course();
      });
   </script>

   <script>
      $(document).on('submit', '#student_academic_details', function (event) {

         event.preventDefault();

         if (
            $('#student_academic_details select[name="courses[]"]').val() == '' 
         ) {

            $('#student_academic_details').find('.error_message_to_show').remove();
            $('#student_academic_details').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');
            return false;

         } else {

            var url = '{{ action("Website\StudentProfileController@student_academic_details") }}';
            var post_data = $('#student_academic_details').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  var content = '';

                  if( data != 0 ) {
                     data.forEach( element => {

                        var courses = element.courses;
                        var courses_content = '';

                        courses = courses.split(',');

                        if( courses ) {
                           courses.forEach( (course, index) => {

                              if(index == (courses.length - 1)){
                                 courses_content += `<span class="text-white">${course} </span>`;
                              } else {
                                 courses_content += `<span class="text-white">${course} | </span>`;
                              }

                           });
                        }
                        
                        content += `<div class="col-lg-6- col-md-6- col-12 mb-md-4 mt-2 d-flex align-items-stretch justify-content-center profile_584853">
                                       <div class="exam_single_box shadow rounded row w-100 position-relative">
                                          <div 
                                          onclick="remove_stream(this, '${element.stream_id}')"
                                          class="col-auto position-absolute right-5px top-5px fs-md-19 fs-15 text-white z-index-1 d-grid align-items-center justify-content-center px-0 border border-white w-md-30px w-24px h-md-30px h-24px rounded-pill class-cards"><i class="fas fa-times"></i></div>
                                          <div class="exam-ico bg-primary col-4 justify-content-center rounded-left d-grid align-items-center h-100 fs-50 py-4 px-4">
                                             ${element.image}
                                          </div>
                                          <div class="inner-text col py-3 bg-secondary h-100 d-grid rounded-right">
                                             <div class="font-weight-bold fs-18 text-uppercase mb-4 text-white">${element.name}</div>
                                             <p class="fs-14 mb-0 font-weight-600">
                                                ${courses_content}
                                             </p>
                                          </div>
                                       </div>
                                    </div>`;

                     });

                     $('#student_academic_details_data').html(content);                     
                                    
                     $(".preferences-information-carousel").owlCarousel('destroy');

                     $(".preferences-information-carousel").owlCarousel({
                        autoplay: false,
                        autoplayHoverPause: true,
                        autoplayTimeout: 2000,
                        dots: false,
                        loop: false,
                        nav: false,
                        fade: true,
                        infinite: true,
                        autoWidth: false,
                        items: 4,
                        responsive: {
                              0: {
                                 items: 1
                              },
                              768: {
                                 items: 1
                              },
                              900: {
                                 items: 2
                              },
                              1100: {
                                 items: 2
                              }
                        }
                     });
                     
                     document.getElementById("student_academic_details").reset();
                     $('.selectpicker').selectpicker('refresh');

                  }

               }
            });

            return false;
         }
      });
   </script>

   <script>
      function remove_stream(element, stream_id) {
         var url = '{{ action("Website\StudentProfileController@stream_course_remove") }}';
         
         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
               stream_id,
               '_token': "{{ csrf_token() }}"
            },
            success: function(data) {

               if(data == 1) {
                  element.parentElement.parentElement.remove()
               }

            }
         });

      }
   </script>

   <!-- Education Level Information -->

   <script>

      $(document).on('click', '#add_more_education_btn', function(){
         
         var id = ($('.student_education_level_information').length + 1).toString();

         var Education_Level_Information_Content = `
            <div class="pt-4 mb-3 border-top col-12 preferences student_education_level_information">
               <div class="row">
                  <div class="col-12 px-md-3 px-0">
                     <div class="row mx-md-0">
                        <div class="mb-md-4 mb-3 col-md-6">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <select required name="student_education_level_information[${(id - 1)}][class_level]" id="student_education_level_information[${(id - 1)}][class_level]" title="" data-index="${(id - 1)}" onchange="select_class(this)" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Choose Your Class Level">
                                    <option value="" selected="" disabled>Choose Your Class Level </option>
                                    <option value="V-XII">V-XII</option>
                                    <option value="UG">UG</option>
                                    <option value="PG">PG </option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="mb-md-4 mb-3 col-md-6 class_box_${(id - 1)}">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <select name="student_education_level_information[${(id - 1)}][class]" id="student_education_level_information[${(id - 1)}][class]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Your Class"
                                 data-index="${(id - 1)}" onchange="select_stream(this)"
                                 >
                                    <option value="" selected="" disabled>Select Your Class </option>
                                    <option value="V-X">V-X</option>
                                    <option value="XI-XII">XI-XII</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="mb-md-4 mb-3 col-md-6 university_name_box_${(id - 1)}">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                 name="student_education_level_information[${(id - 1)}][university_name]" id="student_education_level_information[${(id - 1)}][university_name]" placeholder="University Name">
                              </div>
                           </div>
                        </div>
                        <div class="mb-md-4 mb-3 col-md-6">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                 required name="student_education_level_information[${(id - 1)}][school_college_name]" id="student_education_level_information[${(id - 1)}][school_college_name]" placeholder="School/College Name">
                              </div>
                           </div>
                        </div>
                        
                        <div class="mb-md-4 mb-3 col-md-6 degree_diploma_name_box_${(id - 1)}">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                 required name="student_education_level_information[${(id - 1)}][degree_diploma_name]" id="student_education_level_information[${(id - 1)}][degree_diploma_name]" placeholder="Degree/Diploma Name">
                              </div>
                           </div>
                        </div>
                        
                        <div class="mb-md-4 mb-3 col-md-6 specialization_box_${(id - 1)}">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                  name="student_education_level_information[${(id - 1)}][specialization]" id="student_education_level_information[${(id - 1)}][specialization]" placeholder="Specialization">
                              </div>
                           </div>
                        </div>

                        <div class="mb-md-4 mb-3 col-md-6">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <select name="student_education_level_information[${(id - 1)}][course_completion_year]" id="student_education_level_information[${(id - 1)}][course_completion_year]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Course Completion Year">
                                    <option value="" selected="" disabled>Course Completion Year</option>

                                    @foreach(range(date('Y'), 1970) as $year)
                                       <option value="{{$year}}">{{$year}}</option>
                                    @endforeach
                                    
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="mb-md-4 mb-3 col-md-6 board_box_${(id - 1)}">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <select name="student_education_level_information[${(id - 1)}][board]" id="student_education_level_information[${(id - 1)}][board]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Courses">
                                    <option value=""> Select Board </option><option value="CBSE"> CBSE </option><option value="ICSE"> ICSE </option><option value="IGCSE"> IGCSE </option><option value="State Board"> State Board </option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        
                        <div class="mb-md-4 mb-3 col-md-6 stream_box_${(id - 1)}">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <select name="student_education_level_information[${(id - 1)}][stream]" id="student_education_level_information[${(id - 1)}][stream]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Courses">
                                    <option value=""> Select Stream </option>
                                    <option value="Arts">Arts</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Maths">Maths</option>
                                    <option value="Science">Science</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="mb-md-4 mb-3 col-md-6">
                           <div class="select_collages_inner d-flex align-items-center justify-content-center rounded">
                              <div class="comman_select select_box_1">
                                 <select name="student_education_level_information[${(id - 1)}][marks]" name="student_education_level_information[${(id - 1)}][marks]" title="" class="selectpicker show-tick" data-width="full" data-container="body" data-size="10" data-live-search="true" placeholder="Select Marks">
                                    <option value="" selected="" disabled>Marks </option>
                                    <option value="33%">33%</option>
                                    <option value="34%">34%</option>
                                    <option value="35%">35%</option>
                                    <option value="36%">36%</option>
                                    <option value="37%">37%</option>
                                    <option value="38%">38%</option>
                                    <option value="39%">39%</option>
                                    <option value="40%">40%</option>
                                    <option value="41%">41%</option>
                                    <option value="42%">42%</option>
                                    <option value="43%">43%</option>
                                    <option value="44%">44%</option>
                                    <option value="45%">45%</option>
                                    <option value="46%">46%</option>
                                    <option value="47%">47%</option>
                                    <option value="48%">48%</option>
                                    <option value="49%">49%</option>
                                    <option value="50%">50%</option>
                                    <option value="51%">51%</option>
                                    <option value="52%">52%</option>
                                    <option value="53%">53%</option>
                                    <option value="54%">54%</option>
                                    <option value="55%">55%</option>
                                    <option value="56%">56%</option>
                                    <option value="57%">57%</option>
                                    <option value="58%">58%</option>
                                    <option value="59%">59%</option>
                                    <option value="60%">60%</option>
                                    <option value="61%">61%</option>
                                    <option value="62%">62%</option>
                                    <option value="63%">63%</option>
                                    <option value="64%">64%</option>
                                    <option value="65%">65%</option>
                                    <option value="66%">66%</option>
                                    <option value="67%">67%</option>
                                    <option value="68%">68%</option>
                                    <option value="69%">69%</option>
                                    <option value="70%">70%</option>
                                    <option value="71%">71%</option>
                                    <option value="72%">72%</option>
                                    <option value="73%">73%</option>
                                    <option value="74%">74%</option>
                                    <option value="75%">75%</option>
                                    <option value="76%">76%</option>
                                    <option value="77%">77%</option>
                                    <option value="78%">78%</option>
                                    <option value="79%">79%</option>
                                    <option value="80%">80%</option>
                                    <option value="81%">81%</option>
                                    <option value="82%">82%</option>
                                    <option value="83%">83%</option>
                                    <option value="84%">84%</option>
                                    <option value="85%">85%</option>
                                    <option value="86%">86%</option>
                                    <option value="87%">87%</option>
                                    <option value="88%">88%</option>
                                    <option value="89%">89%</option>
                                    <option value="90%">90%</option>
                                    <option value="91%">91%</option>
                                    <option value="92%">92%</option>
                                    <option value="93%">93%</option>
                                    <option value="94%">94%</option>
                                    <option value="95%">95%</option>
                                    <option value="96%">96%</option>
                                    <option value="97%">97%</option>
                                    <option value="98%">98%</option>
                                    <option value="99%">99%</option>
                                    <option value="100%">100%</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <!-- <div class="mb-4 col-auto">
                           <a href="javascript:;" class="search_btn border-0 btn btn-sm btn-green border-0 rounded">
                           <span class="d-flex align-items-center"><i class="fal fa-check-circle"></i>&nbsp; Submit</span></a>
                           </div> -->
                     </div>
                  </div>
                  <div 
                     onclick="this.parentElement.parentElement.remove()"
                     class="align-items-center col-12 btn d-none">
                     <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
         `;
         
         $('#add_more_education_container').append(Education_Level_Information_Content);
         
         $('.selectpicker').selectpicker('refresh');
      });

      $("#remove_education_btn").click(function() {
         if ($('.student_education_level_information').length == 1) {
               Swal.fire("No more to remove");
               return false;
         }

         $(".student_education_level_information:last").remove();
      });
   </script>

   <script>

      // class level
      function select_class(element) {
         var index = $(element).data('index');

         if($(element).val() == 'V-XII') {
            $('.class_box_' + index).show();
            
            $('.university_name_box_' + index).hide();
            $('.university_name_box_' + index + ' select').removeAttr('required');
            $('.university_name_box_' + index + ' input').removeAttr('required');
            
            $('.degree_diploma_name_box_' + index).hide();
            $('.degree_diploma_name_box_' + index + ' select').removeAttr('required');
            $('.degree_diploma_name_box_' + index + ' input').removeAttr('required');
            
            $('.specialization_box_' + index).hide();
            $('.specialization_box_' + index + ' select').removeAttr('required');
            $('.specialization_box_' + index + ' input').removeAttr('required');
            
            $('.stream_box_' + index).show();
            $('.stream_box_' + index + ' select').attr('required', 'required');
            $('.stream_box_' + index + ' input').attr('required', 'required');
            
            $('.board_box_' + index).show();
            
         } else { // PG or UG
            $('.class_box_' + index).hide();
            $('.class_box_' + index + ' select').removeAttr('required');
            $('.class_box_' + index + ' input').removeAttr('required');
            
            $('.university_name_box_' + index).show();
            
            $('.degree_diploma_name_box_' + index).show();
            $('.degree_diploma_name_box_' + index + ' select').attr('required', 'required');
            $('.degree_diploma_name_box_' + index + ' input').attr('required', 'required');
            
            $('.specialization_box_' + index).show();
            
            $('.stream_box_' + index).hide();
            $('.stream_box_' + index + ' select').removeAttr('required');
            $('.stream_box_' + index + ' input').removeAttr('required');

            $('.board_box_' + index).hide();
            $('.board_box_' + index + ' select').removeAttr('required');
            $('.board_box_' + index + ' input').removeAttr('required');
            
         }
      }
      
      function select_stream(element) {
         var index = $(element).data('index');

         if($(element).val() == 'XI-XII') {
            $('.stream_box_' + index).show();
            
         } else { // PG or UG
            $('.stream_box_' + index).hide();
            $('.stream_box_' + index + ' select').removeAttr('required');
            $('.stream_box_' + index + ' input').removeAttr('required');
            
         }
      }
   </script>

   <script>
      $(".preferences-information-carousel").owlCarousel('destroy');

      $(".preferences-information-carousel").owlCarousel({
         autoplay: false,
         autoplayHoverPause: true,
         autoplayTimeout: 2000,
         dots: false,
         loop: false,
         nav: false,
         fade: true,
         infinite: true,
         autoWidth: false,
         items: 4,
         responsive: {
               0: {
                  items: 1
               },
               768: {
                  items: 1
               },
               900: {
                  items: 2
               },
               1100: {
                  items: 2
               }
         }
      });
   </script>

   
<script>
   $(document).on('click', '.remove_from_favorite', function() {
         
         var coaching_id = $(this).data('coaching_id');

         $.ajax({
            url: '{{ asset("add_to_favorite") }}/' + coaching_id,

            success: function(data) {
               if(data == 1) {                  
                  
                  swal.fire({
                     title: 'Success',
                     'text': 'Removed from favorites'
                  });

               } 
            }
         });
      }
   );
</script>

<script>
   $(document).on('click', '.remove_from_favorite1', function() {
         
         var college_id = $(this).data('college_id');

         $.ajax({
            url: '{{ asset("/college/add_to_favorite") }}/' + college_id,

            success: function(data) {
               if(data == 1) {                  
                  
                  swal.fire({
                     title: 'Success',
                     'text': 'Removed from favorites'
                  });

               } 
            }
         });
      }
   );

   function freeze(form_id) {
      $('#student_education_level_information_form').find('input').attr('disabled', function(_, attr){ return !attr});
      $('#student_education_level_information_form').find('select').attr('disabled', function(_, attr){ return !attr});
   
      $('.selectpicker').selectpicker('refresh');      

      $('#student_education_level_information_form_btns').toggleClass('display-none');
   }

   @if( !empty( $student_education_level_information->toArray() ) ) 
      $(document).ready(
         function() {
            freeze('student_education_level_information_form');
         }
      );
   @endif
</script>

   <script>
   $('.modal').on('shown.bs.modal', function (e) {
      $('.modal-backdrop').addClass('d-none');
   });
   </script>