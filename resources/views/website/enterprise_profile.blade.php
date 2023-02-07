@include('website/layouts/header')

<style>   
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
   .error_messages{
      color: red !important;
   }
   @media (max-width: 767px) {
	   .profile_pic {
         width: 100%;
         margin-top: 0;
         margin-left: 0;
         height: 100%;
         max-width: 100%;
      }
   }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
<main id="main">
   <section id="exam-eligibility" class="bg-white mt-lg-3 overflow-unset">
      <div class="container position-relative z-index-1">
         
         <div class="row align-items-start mx-0">
            <div class="col-lg-3 position-sticky profile-menu-position">
               <div class="row align-items-start mb-3">
                  <div class="col">
                     <a 
                     href='{{ action("Website\EnterpriseController@index") }}'
                     class="btn-block btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"
                     ><span class="mr-2">
                     <i class="fas fa-th"></i>
                     </span><span>DASHBOARD</span></a>
                                             
                  </div>
               </div>
               <ul class="nav d-lg-block d-md-flex d-flex border-0 nav-tabs shadow rounded bg-white" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  active d-flex align-items-center justify-content-between" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">Basic <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fas fa-user"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="branches-tab" data-toggle="tab" href="#branches" role="tab" aria-controls="branches" aria-selected="false">Branches <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fas fa-map-pin"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="courses-new-tab" data-toggle="tab" href="#courses-new" role="tab" aria-controls="courses-new" aria-selected="false">Courses <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fad fa-books"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="result-new-tab" data-toggle="tab" href="#result-new" role="tab" aria-controls="result-new" aria-selected="false">Results <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fas fa-list-alt"></i></span></a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link border-0 rounded-0 font-weight-bold py-xl-3 py-lg-2 py-md-2 py-2 fs-xl-16 fs-lg-15 fs-md-14 fs-14  d-flex align-items-center justify-content-between" id="faculities-tab" data-toggle="tab" href="#faculities" role="tab" aria-controls="faculities" aria-selected="false">Faculties <span class="ml-lg-0 ml-md-3 ml-3 h-md-40px h-30px w-md-40px w-30px rounded-pill bg-white shadow text-secondary d-flex align-items-center justify-content-center border"><i class="fas fa-users-class"></i></span></a>
                  </li>
               </ul>
            </div>
            <div class="col-lg-9 mt-lg-0 mt-md-5 mt-4">
               
               @if(
                  session()->has('enterprise') 
                     and 
                  session()->get('enterprise')->status == 'enable'
               )
               <div class="row">
                  <div class="col-12 text-center text-danger mb-5 fs-14">Your Coaching Page is Live! For any changes Please connect to CoachingSelect team or email at support@coachingselect.com</div>
               </div>
               @endif

               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                     <div class="row">
                        <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white mt-md-0 mt-4">
                           <div class="row mx-0">
                              <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                 <form 
                                    action='{{ action("Website\EnterpriseProfileController@enterprise_profile_update") }}'
                                    class="row mx-0 bg-white shadow"
                                    method="post"
                                    enctype="multipart/form-data"
                                    id="enterprise_basic_form"
                                    >
                                    @csrf
                                    
                                    @if(
                                       session()->has('enterprise') 
                                          and 
                                       session()->get('enterprise')->status == 'enable'
                                    )
                                    <a class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                                    @endif

                                    <div class="col-12 position-relative">
                                      <div class="avatar-wrapper position-relative h-md-100px h-80px w-md-100px w-80px top-md-n57px top-n45px mx-auto rounded-pill shadow border d-flex align-items-start">

                                       @if( !empty(session()->get('enterprise')->image) )
                                         <img class="profile-pic" src="{{ asset('public/coaching/'. session()->get('enterprise')->image ?? '') }}"
                                         onerror="this.src='<?php echo asset('public/user.png'); ?>'"
                                          >
                                       @else 
                                          <img 
                                          class="profile_pic"
                                          src="{{ asset('public/website/assets/img/site_logo1.png') }}"
                                          >
                                       @endif
                                       
                                         <div class="upload-button">
                                             <i class="fad fa-arrow-circle-up" aria-hidden="true"></i>
                                          
                                            <a href="javascript:;" class="py-1 font-weight-bold text-white rounded-pill w-30px h-30px border d-grid align-items-center justify-content-center bg-dark position-absolute right-0 bottom-0"><i class="fas fa-pencil-alt fs-13"></i></a>
                                         </div>
                                         <input class="file-upload d-none" type="file" accept="image/*" name="image">
                                         @if( Session::has('successProfile'))

                                         <?php $message = Session::get('successProfile')?>

                                         <div class="successfully_messages"> {{ $message }}</div>
                                         @endif
                                         @if( Session::has('errorProfile'))

                                         <?php $message1 = Session::get('errorProfile')?>

                                         <div class="successfully_messages error_messages"> {{ $message1 }}</div>
                                         @endif

                                      </div>
                                   </div>
                                    
                                    <div class="col-12 form-group text-center mt-n5">
                                       <div class="row justify-content-center">
                                          <div class="col-auto px-2 name-text mt-md-0 mt-2 d-none" id="name-text">
                                             <div class="form-group mb-0">
                                                <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 pr-5 font-weight-bold"
                                                value="{{ session()->get('enterprise')->name ?? '' }}" id="name" name="name">
                                             </div>
                                             <div class="row position-absolute top-0 right-0 bottom-0 h-100 align-items-center mr-1 ml-0">
                                                <div class="col-auto pl-2">
                                                   <a href="javascript:;" id="savename" data-save_button_id="name" data-toggle="tooltip" class="py-1 font-weight-bold text-success rounded-pill w-md-30px w-25px h-md-30px h-25px  border border-success d-grid align-items-center justify-content-center save_button" title="Save"><i class="far fa-check"></i></a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto px-2 name-box align-items-center" id="name-box">
                                             <div class="row align-items-center mb-md-3 mb-0 mt-md-0 mt-4 mx-4 flex-nowrap">
                                                <div class="form-group mb-0">
                                                   <div class="fs-lg-28 fs-md-22 fs-16 font-weight-bold" data-id="name">{{ session()->get('enterprise')->name ?? '' }}</div>
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
                                          <div class="col-md-4 px-md-3 px-2">
                                             <div class="row mx-0 mb-0">
                                                <div class="col-12 px-2"><label for="tagline" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Tagline :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="form-group">
                                                      <input 
                                                         name="tagline"
                                                         value="{{ session()->get('enterprise')->tagline ?? '' }}"
                                                         data-old-value="{{ session()->get('enterprise')->tagline ?? '' }}"
                                                         type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="tagline">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">ESTABLISHED YEAR :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row">
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <select name="est_yr" id="est_yr" 
                                                            class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true">
                                                               <option value="" disabled selected>Select Est Year</option>
                                                               
                                                               @foreach(range(date('Y'), 1970) as $year)
                                                                  <option value="{{$year}}"
                                                                     @if( session()->get('enterprise')->est_yr == $year)
                                                                        selected
                                                                     @endif
                                                                  >{{$year}}</option>
                                                               @endforeach

                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 px-md-3 px-2">
                                             <div class="row mx-md-0 mx-2 mb-md-3 mb-0">
                                                <div class="col-12 px-0"><label for="phone-number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">About :</label></div>
                                                <div class="col-12 px-0">
                                                   <div class="form-group">
                                                     <a class="form-control shadow-none rounded-0" data-toggle="modal" data-target="#staticBackdrop" href="javascript:;"></a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Faculty student ratio :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row">
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <select name="faculty_student_ratio" id="Online" title="Online" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                               <option value="0" disabled selected="">Select ratio</option>
                                                               <option value="1:1"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:1')
                                                                     selected
                                                                  @endif
                                                               >1:1</option>
                                                               <option value="1:2"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:2')
                                                                     selected
                                                                  @endif
                                                               >1:2 </option>
                                                               <option value="1:3"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:3')
                                                                     selected
                                                                  @endif
                                                               >1:3 </option>
                                                               <option value="1:4"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:4')
                                                                     selected
                                                                  @endif
                                                               >1:4 </option>
                                                               <option value="1:5"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:5')
                                                                     selected
                                                                  @endif
                                                               >1:5 </option>
                                                               <option value="1:6"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:6')
                                                                     selected
                                                                  @endif
                                                               >1:6 </option>
                                                               <option value="1:8"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:8')
                                                                     selected
                                                                  @endif
                                                               >1:8 </option>
                                                               <option value="1:9"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:9')
                                                                     selected
                                                                  @endif
                                                               >1:9 </option>
                                                               <option value="1:10"
                                                                  @if( session()->get('enterprise')->faculty_student_ratio == '1:10')
                                                                     selected
                                                                  @endif
                                                               >1:10 </option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 px-md-3 px-2">
                                             <div class="row mx-0 mb-md-3 mb-0">
                                                <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">BRANCH INTAKE :</label></div>
                                                <div class="col-12 px-2">
                                                   <div class="row">
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <input 
                                                               name="batch_size" 
                                                               value="{{ session()->get('enterprise')->batch_size ?? '' }}"
                                                               minlength="10"
                                                               maxlength="10" 
                                                               oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                               type="tel"
                                                               class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="batch_size">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 px-md-3 px-3">
                                             <div class="row mb-md-3 ">
                                                <div class="col-12"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">BRANCHES :</label></div>
                                                <div class="col-12">
                                                   <div class="form-group">
                                                      <input type="text" 
                                                      value="{{ session()->get('enterprise')->number_of_branches ?? '' }}"
                                                      name="number_of_branches" 
                                                      minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel"
                                                      class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" id="number">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12">
                                             <div class="row">
                                                <div class="col-md-4 px-md-3 px-2">
                                                   <div class="row mx-0 mb-md-3 mb-0">
                                                      <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Entrance & Scholarship Test :</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <select name="scholarship_yes_or_no" id="Online" title="Online" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" 
                                                                  onchange="show_hide_scholarship_fields(this)"
                                                                  placeholder="Online Live">
                                                                     <option value="yes"
                                                                        @if( 
                                                                           !empty(
                                                                              session()->get('enterprise')->scholarship_yes_or_no
                                                                           )
                                                                           and
                                                                           session()->get('enterprise')->scholarship_yes_or_no == 'yes')
                                                                           selected
                                                                        @endif
                                                                     >Yes </option>
                                                                     <option value="no"
                                                                        @if( 
                                                                           !empty(
                                                                              session()->get('enterprise')->scholarship_yes_or_no
                                                                           )
                                                                           and
                                                                           session()->get('enterprise')->scholarship_yes_or_no == 'no')
                                                                           selected
                                                                        @endif
                                                                     >No </option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-4 px-md-3 px-3 scholarship_fields 
                                                @if( 
                                                !empty(
                                                   session()->get('enterprise')->scholarship_yes_or_no
                                                )
                                                and
                                                session()->get('enterprise')->scholarship_yes_or_no == 'no' )
                                                   d-none
                                                @endif
                                                ">
                                                   <div class="row mb-md-3">
                                                      <div class="col-12"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">SCHOLARSHIP TEST NAME :</label></div>
                                                      <div class="col-12">
                                                         <div class="form-group">
                                                            <input 
                                                            name="scholarship_name"
                                                            type="text"
                                                            value="{{ session()->get('enterprise')->scholarship_name ?? '' }}"
                                                            class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" id="number">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-4 px-md-3 px-3 scholarship_fields 
                                                @if( 
                                                !empty(
                                                   session()->get('enterprise')->scholarship_yes_or_no
                                                )
                                                   and
                                                   session()->get('enterprise')->scholarship_yes_or_no == 'no' )
                                                   d-none
                                                @endif
                                                ">
                                                   <div class="row px-2 mb-3">
                                                      <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">MAX SCHOLARSHIP OFFERED :</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <div class="input-group mb-3">
                                                                     <input type="text" class="form-control shadow-none rounded-0" aria-label="Enter Scholarship"
                                                                     value="{{ session()->get('enterprise')->scholarship ?? '' }}"
                                                                     name="scholarship" placeholder="Enter Scholarship" 
                                                                     onchange="return is_correct_percentage()"
                                                                     oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel">
                                                                     <span class="p-0">
                                                                        <select name="scholarship_type" id="scholarship_type"  class="form-control  show-tick p-0 h-38px border-left-0 shadow-none outline-0 rounded-0" 
                                                                        onchange="return is_correct_percentage()">
                                                                              <option value="per"
                                                                                 @if( session()->get('enterprise')->scholarship_type == 'per')
                                                                                    selected
                                                                                 @endif
                                                                              >Per</option>
                                                                              <option value="rs"
                                                                                 @if( session()->get('enterprise')->scholarship_type == 'rs')
                                                                                    selected
                                                                                 @endif
                                                                              >Rs</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="col-md-4 px-md-3 px-2">
                                                   <div class="row mx-0 mb-md-3 mb-0">
                                                      <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">AVERAGE FEES :</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="form-group">
                                                            <input type="text" name="avg_fees" 
                                                            class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                            placeholder=""
                                                            autocomplete="off" 
                                                            onkeypress="return isNumberKey(event)" 
                                                            value="{{ session()->get('enterprise')->avg_fees ?? '' }}"
                                                            >
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-4 px-md-3 px-2">
                                                   <div class="row mx-0 mb-md-3 mb-0">
                                                      <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Super Speciality :</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="form-group">
                                                            <input type="text" name="super_specialty" 
                                                            class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                            placeholder=""
                                                            autocomplete="off" 
                                                            value="{{ session()->get('enterprise')->super_specialty ?? '' }}"
                                                            >
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12">
                                             <div class="row">
                                                <div class="col-12 px-md-3 px-2">
                                                   <div class="row mb-md-4 mb-2 select_heads">
                                                      <div class="col-12 mb-md-2 mb-1">
                                                         <label for="dob" class="mb-0 fs-md-16 fs-12 font-weight-bold text-uppercase text-secondary px-2 position-relative">Offerings :</label>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-12 px-md-3 px-2">
                                                   <div class="row mx-0 mb-md-3 mb-0">
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <select 
                                                                  name="offering[]"
                                                                  id="offering"
                                                                  class="selectpicker w-100 show-tick"
                                                                  data-width="full" data-container="container" data-size="10"  data-live-search="true" multiple
                                                                  >
                                                                     <option value="online" 
                                                                        @if( preg_match('/online/', session()->get('enterprise')->offering) )
                                                                              selected
                                                                        @endif
                                                                        >Online</option>
                                                                     <option value="classroom" 
                                                                        @if( preg_match('/classroom/', session()->get('enterprise')->offering) )
                                                                              selected
                                                                        @endif
                                                                        >Classroom</option>
                                                                     <option value="tutor" 
                                                                        @if( preg_match('/tutor/', session()->get('enterprise')->offering) )
                                                                              selected
                                                                        @endif
                                                                        >Tutor</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12">
                                             <div class="row">
                                                <div class="col-12 px-md-3 px-2">
                                                   <div class="row mb-md-4 mb-2 select_heads">
                                                      <div class="col-12 mb-md-2 mb-1">
                                                         <label for="dob" class="mb-0 fs-md-16 fs-12 font-weight-bold text-uppercase text-secondary px-2 position-relative">Facilities :</label>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-12 px-md-3 px-2">
                                                   <div class="row mx-0 mb-md-3 mb-0">
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <select 
                                                                  name="facility_type"
                                                                  id="facility_type"
                                                                  class="selectpicker w-100 show-tick"
                                                                  data-width="full" data-container="container" data-size="10"  data-live-search="true"
                                                                  onchange="show_facility_box(this)"
                                                                  >
                                                                     
                                                                     <option value="Classroom (Classroom)" 
                                                                        @if( session()->get('enterprise')->facility_type == 'Classroom (Classroom)')
                                                                           selected
                                                                        @endif
                                                                     >Classroom</option>
                                                                     <option value="Classroom (Online)" 
                                                                        @if( session()->get('enterprise')->facility_type == 'Classroom (Online)')
                                                                           selected
                                                                        @endif
                                                                     > Online</option>
                                                                     <option value="Online + Classroom" 
                                                                        @if( session()->get('enterprise')->facility_type == 'Online + Classroom')
                                                                           selected
                                                                        @endif
                                                                     >Online + Classroom</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-12
                                                @if(
                                                   !
                                                   (
                                                      !empty(
                                                         session()->get('enterprise')->facility_type
                                                      )
                                                      and
                                                      session()->get('enterprise')->facility_type == 'Online + Classroom'
                                                   )
                                                )
                                                d-none
                                                @endif
                                                " id="online_classroom_facility_box">
                                                   <div class="row mx-0 ">
                                                      <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Online + Classroom</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <select name="facilities_online_classroom[]" id="facilities" title="facilities" multiple data-selected-text-format="count" data-width="full" data-container="container" data-size="10"  
                                                                  class="facilities selectpicker show-tick w-100" data-container="container" data-size="10"  data-live-search="true" placeholder="facilities">
                                                                     <option value="" disabled>Select</option>
                                                                     
                                                                     @if( !empty($online_facility) )
                                                                        @foreach($online_facility as $facility)
                                                                           <option value="{{$facility->name}}"

                                                                           @if( 
                                                                              !empty(
                                                                                 session()->get('enterprise')->facility_type
                                                                              )
                                                                              and
                                                                              session()->get('enterprise')->facility_type == 'Online + Classroom'
                                                                              and
                                                                              in_array($facility->name, session()->get('enterprise')->facility) )
                                                                              selected
                                                                           @endif
                                                                              
                                                                           >{{$facility->name}}</option>
                                                                        @endforeach
                                                                     @endif
                                                                     
                                                                     @if( !empty($classroom_facility) )
                                                                        @foreach($classroom_facility as $facility)
                                                                           <option value="{{$facility->name}}"

                                                                           @if( 
                                                                              !empty(
                                                                                 session()->get('enterprise')->facility_type
                                                                              )
                                                                              and
                                                                              session()->get('enterprise')->facility_type == 'Classroom (Online)'
                                                                              and
                                                                              in_array($facility->name, session()->get('enterprise')->facility) )
                                                                              selected
                                                                           @endif
                                                                              
                                                                           >{{$facility->name}}</option>
                                                                        @endforeach
                                                                     @endif
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-12 px-md-3 px-2 
                                                @if(
                                                   !
                                                   (
                                                      !empty(
                                                         session()->get('enterprise')->facility_type
                                                      )
                                                      and
                                                      session()->get('enterprise')->facility_type == 'Classroom (Classroom)'
                                                   )
                                                )
                                                d-none
                                                @endif
                                                " id="classroom_facility_box">
                                                   <div class="row mx-0 ">
                                                      <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">CLASSROOM</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <select name="facilities_classroom[]" id="Classroom" title="Classroom" multiple data-selected-text-format="count"  data-width="full" data-container="container" data-size="10" 
                                                                  class="facilities selectpicker show-tick w-100" data-live-search="true" placeholder="Classroom Live">
                                                                     <option value="" disabled >Select</option>
                                                                     
                                                                     @if( !empty($classroom_facility) )
                                                                        @foreach($classroom_facility as $facility)
                                                                           <option value="{{$facility->name}}"

                                                                           @if( 
                                                                              !empty(
                                                                                 session()->get('enterprise')->facility_type
                                                                              )
                                                                              and
                                                                              session()->get('enterprise')->facility_type == 'Classroom (Classroom)'
                                                                              and
                                                                              in_array($facility->name, session()->get('enterprise')->facility) )
                                                                              selected
                                                                           @endif
                                                                              
                                                                           >{{$facility->name}}</option>
                                                                        @endforeach
                                                                     @endif                                                                   
                                                                  </select>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-12 px-md-3 px-2
                                                @if(
                                                   !
                                                   (
                                                      !empty(
                                                         session()->get('enterprise')->facility_type
                                                      )
                                                      and
                                                      session()->get('enterprise')->facility_type == 'Classroom (Online)'
                                                   )
                                                )
                                                d-none
                                                @endif
                                                " id="online_facility_box">
                                                   <div class="row mx-0 ">
                                                      <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">ONLINE</label></div>
                                                      <div class="col-12 px-2">
                                                         <div class="row">
                                                            <div class="col-12">
                                                               <div class="form-group">
                                                                  <select name="facilities_online[]" id="Online" title="Online" multiple data-selected-text-format="count"  data-width="full" data-container="container" data-size="10" 
                                                                  class="facilities selectpicker show-tick w-100"   data-live-search="true" placeholder="Online Live">
                                                                     <option value="" disabled >Select</option>
                                                                     
                                                                     @if( !empty($online_facility) )
                                                                        @foreach($online_facility as $facility)
                                                                           <option value="{{$facility->name}}"

                                                                           @if( 
                                                                              !empty(
                                                                                 session()->get('enterprise')->facility_type
                                                                              )
                                                                              and
                                                                              session()->get('enterprise')->facility_type == 'Classroom (Online)'
                                                                              and
                                                                              in_array($facility->name, session()->get('enterprise')->facility) )
                                                                              selected
                                                                           @endif
                                                                              
                                                                           >{{$facility->name}}</option>
                                                                        @endforeach
                                                                     @endif
                                                                     
                                                                  </select>
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
                                    <div class="col-12 border-top mt-4 px-md-3 px-2 py-3  d-flex align-items-center justify-content-between text-right">
                                       <a href="javascript:;" data-toggle="modal" data-target="#Change-password" data-backdrop="static" data-keyboard="false" data-dismiss="modal" class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fal fa-key"></i></span><span>Change Password</span></a>
                                       <button 
                                       id="enterprise_basic_form_btns"
                                       type="submit" class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="far fa-check-circle"></i></span><span>
                                          @if( 
                                             ! empty(
                                                session()->get('enterprise')->image ?? ''
                                             )
                                          )                                            
                                             Save Changes
                                          @else
                                             Submit
                                          @endif
                                       </span></button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="branches" role="tabpanel" aria-labelledby="branches-tab">
                     <div class="row">
                        <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white mt-md-0 mt-0">
                           <div class="row mx-0">
                              <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                 <form 
                                    action='{{ action("Website\EnterpriseProfileController@enterprise_branch_update") }}'
                                    class="row mx-0"
                                    method="post"
                                    enctype="multipart/form-data"
                                    >
                                    @csrf
                                    <div class="col-12">
                                       <div class="row form-horizontal2">

                                          @if( 
                                             !empty(
                                                $coaching_branches->toArray()
                                             )
                                          )
                                                
                                             @php
                                                $i = 0;
                                                $totalcoach = count($coaching_branches);
                                             @endphp

                                             @foreach($coaching_branches as $branch)

                                                <div class="col-12 bg-white control-group2 shadow py-4 mb-4">

                                                   @if(
                                                      session()->has('enterprise') 
                                                         and 
                                                      $branch->status == 'enable'
                                                   )
                                                   @endif

                                                   <div class="form-horizontal">
                                                      <div class="control-group">
                                                         <div class="row">
                                                            
                                                         <input 
                                                            type="hidden"
                                                            name="branch[{{$i}}][coaching_centers_id]"
                                                            value="{{ $branch->coaching_centers_id ?? '' }}"
                                                         >
                                                         
                                                         <input 
                                                            type="hidden"
                                                            name="branch[{{$i}}][id]"
                                                            value="{{ $branch->id ?? '' }}"
                                                         >
                                                            
                                                            <div class="col-12 text-right">
                                                               @if(
                                                                  $totalcoach > 1
                                                                     and
                                                                  !$loop->first
                                                               )
                                                               <button 
                                                               type="button"
                                                               class="removeButton btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                                                               @endif
                                                            </div>

                                                            <div class="col-12">
                                                               <div class="row">
                                                                  <div class="col-12 px-3">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Address :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input 
                                                                                 type="text" 
                                                                                 class="address form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                                 name="branch[{{$i}}][address]" 
                                                                                 required
                                                                                 value="{{ $branch->address ?? '' }}"
                                                                                 id="address{{$i}}" data-element_id="{{$i}}"
                                                                              >
                                                               
                                                                              <input type="hidden" class="form-control" name="branch[{{$i}}][latitude]" id="latitude{{$i}}"
                                                                              value="{{ $branch->latitude ?? '' }}"
                                                                              />
                                                                              <input type="hidden" class="form-control" name="branch[{{$i}}][longitude]" id="longitude{{$i}}"
                                                                              value="{{ $branch->longitude ?? '' }}"
                                                                              />
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Country :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select name="branch[{{$i}}][country_id]" id="branch[{{$i}}][country_id]" 
                                                                                    class="selectpicker w-100 show-tick countrys" data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                    required
                                                                                    data-id="{{$i}}"
                                                                                    onchange="show_states(this)"
                                                                                    >
                                                                                       <option value="" selected disabled>Select country</option>
                                                                                       @if( !empty($countrys) )
                                                                                       @foreach($countrys as $country)
                                                                                       <option 
                                                                                          @if($branch->country == $country->name)
                                                                                             selected
                                                                                          @endif
                                                                                          value="{{$country->name}}">{{$country->name}}</option>
                                                                                       @endforeach
                                                                                       @endif
                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">State :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select name="branch[{{$i}}][state_id]" id="branch[{{$i}}][state_id]" 
                                                                                    class="selectpicker w-100 show-tick states" data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                    required
                                                                                    data-id="{{$i}}"
                                                                                    onchange="show_citys(this)"
                                                                                    data-id1="state_id_{{$i}}"
                                                                                    >
                                                                                       <option value="" selected disabled>Select state</option>
                                                                                       @if( !empty($branch->states) )
                                                                                       @foreach($branch->states as $state)
                                                                                       <option 
                                                                                          @if($branch->state == $state->name)
                                                                                             selected
                                                                                          @endif
                                                                                          value="{{$state->name}}">{{$state->name}}</option>
                                                                                       @endforeach
                                                                                       @endif
                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">City :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select 
                                                                                    name="branch[{{$i}}][city_id]" 
                                                                                    id="branch[{{$i}}][city_id]" 
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                    required                                            
                                                                                    data-id="city_id_{{$i}}"
                                                                                    >
                                                                                       <option value="" selected disabled>Select City</option>
                                                                                       @if( !empty($branch->cities) )
                                                                                       @foreach($branch->cities as $city)
                                                                                       <option 
                                                                                          @if($branch->city == $city->name)
                                                                                             selected
                                                                                          @endif
                                                                                          value="{{$city->name}}">{{$city->name}}</option>
                                                                                       @endforeach
                                                                                       @endif
                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Name of Branch :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input 
                                                                              name="branch[{{$i}}][name]"
                                                                              type="text" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              placeholder="" id="number"
                                                                              required
                                                                              value="{{ $branch->name ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Ownership :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select 
                                                                                    name="branch[{{$i}}][ownership]" 
                                                                                    id="branch[{{$i}}][ownership]" 
                                                                                    title="Ownership" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                                                       <option value="" disabled >Select anyone</option>
                                                                                       <option value="1"
                                                                                          @if($branch->ownership == '1')
                                                                                             selected
                                                                                          @endif
                                                                                       >Company Owned </option>
                                                                                       <option value="2"
                                                                                          @if($branch->ownership == '2')
                                                                                             selected
                                                                                          @endif
                                                                                       >Franchise </option>
                                                                                    </select>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">average intake :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                           
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select 
                                                                                       name="branch[{{$i}}][average_intake]"
                                                                                       id="branch[{{$i}}][average_intake]"
                                                                                       title="Average Intake" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                                                       <option
                                                                                          value="" disabled selected="">Select</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "1-10")
                                                                                             selected
                                                                                          @endif
                                                                                          value="1-10">Below 10</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "10-20")
                                                                                             selected
                                                                                          @endif
                                                                                          value="10-20">10 - 20</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "20-30")
                                                                                             selected
                                                                                          @endif
                                                                                          value="20-30">20 - 30</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "30-40")
                                                                                             selected
                                                                                          @endif
                                                                                          value="30-40">30 - 40</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "40-50")
                                                                                             selected
                                                                                          @endif
                                                                                          value="40-50">40 - 50</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "50-60")
                                                                                             selected
                                                                                          @endif
                                                                                          value="50-60">50 - 60</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "60-70")
                                                                                             selected
                                                                                          @endif
                                                                                          value="60-70">60 - 70</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "70-80")
                                                                                             selected
                                                                                          @endif
                                                                                          value="70-80">70 - 80</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "80-90")
                                                                                             selected
                                                                                          @endif
                                                                                          value="80-90">80 - 90</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "90-100")
                                                                                             selected
                                                                                          @endif
                                                                                          value="90-100">90 - 100</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "100-110")
                                                                                             selected
                                                                                          @endif
                                                                                          value="100-110">100 - 110</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "110-120")
                                                                                             selected
                                                                                          @endif
                                                                                          value="110-120">110 - 120</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "120-130")
                                                                                             selected
                                                                                          @endif
                                                                                          value="120-130">120 - 130</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "130-140")
                                                                                             selected
                                                                                          @endif
                                                                                          value="130-140">130 - 140</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "140-150")
                                                                                             selected
                                                                                          @endif
                                                                                          value="140-150">140 - 150</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "150-160")
                                                                                             selected
                                                                                          @endif
                                                                                          value="150-160">150 - 160</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "160-170")
                                                                                             selected
                                                                                          @endif
                                                                                          value="160-170">160 - 170</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "170-180")
                                                                                             selected
                                                                                          @endif
                                                                                          value="170-180">170 - 180</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "180-190")
                                                                                             selected
                                                                                          @endif
                                                                                          value="180-190">180 - 190</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "190-200")
                                                                                             selected
                                                                                          @endif
                                                                                          value="190-200">190 - 200</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "200-210")
                                                                                             selected
                                                                                          @endif
                                                                                          value="200-210">200 - 210</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "210-220")
                                                                                             selected
                                                                                          @endif
                                                                                          value="210-220">210 - 220</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "220-230")
                                                                                             selected
                                                                                          @endif
                                                                                          value="220-230">220 - 230</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "230-240")
                                                                                             selected
                                                                                          @endif
                                                                                          value="230-240">230 - 240</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "240-250")
                                                                                             selected
                                                                                          @endif
                                                                                          value="240-250">240 - 250</option>
                                                                                       <option
                                                                                          @if($branch->average_intake == "Above 250")
                                                                                             selected
                                                                                          @endif
                                                                                          value="Above 250">Above 250</option>
                                                                                    </select>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Mobile 1) :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              autocomplete="off" 
                                                                              onkeypress="return isNumberKey(event)" 
                                                                              pattern="[6789][0-9]{9}" 
                                                                              minlength="10"
                                                                              maxlength="10" name="branch[{{$i}}][mobile]" type="tel"
                                                                              value="{{ $branch->mobile ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Mobile 2) :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              autocomplete="off" 
                                                                              onkeypress="return isNumberKey(event)" 
                                                                              pattern="[6789][0-9]{9}" 
                                                                              minlength="10" 
                                                                              maxlength="10" 
                                                                              name="branch[{{$i}}][mobile2]" type="tel"
                                                                              value="{{ $branch->mobile2 ?? '' }}"
                                                                              >
                                                                        </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Landline) :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              autocomplete="off" 
                                                                              onkeypress="return isNumberKey(event)" 
                                                                              name="branch[{{$i}}][landline]" type="text"
                                                                              value="{{ $branch->landline ?? '' }}"
                                                                              >

                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Email :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="email" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                              name="branch[{{$i}}][email]" 
                                                                              
                                                                              value="{{ $branch->email ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Website :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="url" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[{{$i}}][website]" 
                                                                              
                                                                              value="{{ $branch->website ?? '' }}"
                                                                              >
                                                                           
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Facebook :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="url" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[{{$i}}][facebook]" 
                                                                              value="{{ $branch->facebook ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Twitter :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="url" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[{{$i}}][twitter]" 
                                                                              value="{{ $branch->twitter ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Instagram :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="url" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[{{$i}}][instagram]" 
                                                                              value="{{ $branch->instagram ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">YouTube :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="url" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[{{$i}}][youtube]" 
                                                                              value="{{ $branch->youtube ?? '' }}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Linkedin :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="url" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[{{$i}}][linkedin]" 
                                                                              value="{{ $branch->linkedin ?? '' }}"
                                                                              >
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

                                                @php
                                                   $i += 1;
                                                @endphp
                                                
                                             @endforeach

                                          @else                                          

                                             <div class="col-12 bg-white control-group2 shadow py-4 mb-4">
                                                <div class="form-horizontal">
                                                   <div class="control-group">
                                                      <div class="row">
                                                         <div class="col-12">
                                                            <div class="row">
                                                            
                                                               <div class="col-12 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Address :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input 
                                                                              type="text" 
                                                                              class="address form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                              name="branch[0][address]" 
                                                                              required
                                                                              id="address0" data-element_id="0"
                                                                           >
                                                                                                               
                                                                           <input type="hidden" class="form-control" name="branch[0][latitude]" id="latitude0">
                                                                           <input type="hidden" class="form-control" name="branch[0][longitude]" id="longitude0">
                                                            
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>

                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Country :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 
                                                                                 <select name="branch[0][country_id]" id="branch[0][country_id]" 
                                                                                 class="selectpicker w-100 show-tick countrys" data-width="full" data-container="container" data-size="10" 
                                                                                 data-live-search="true"
                                                                                 required
                                                                                 data-id="0"
                                                                                 onchange="show_states(this)"
                                                                                 >
                                                                                    <option value="" selected disabled>Select country</option>
                                                                                    @if( !empty($countrys) )
                                                                                    @foreach($countrys as $country)
                                                                                    <option 
                                                                                       value="{{$country->name}}">{{$country->name}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                 </select>

                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">State :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 
                                                                                 <select name="branch[0][state_id]" id="branch[0][state_id]" 
                                                                                 class="selectpicker w-100 show-tick states" data-width="full" data-container="container" data-size="10" 
                                                                                 data-live-search="true"
                                                                                 required
                                                                                 data-id="0"
                                                                                 onchange="show_citys(this)"
                                                                                 data-id1="state_id_0"
                                                                                 >
                                                                                    <option value="" selected disabled>Select state</option>
                                                                                    @if( !empty($states) )
                                                                                    @foreach($states as $state)
                                                                                    <option value="{{$state->name}}">{{$state->name}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                 </select>

                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">City :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 
                                                                                 <select 
                                                                                 name="branch[0][city_id]" 
                                                                                 id="branch[0][city_id]" 
                                                                                 class="selectpicker w-100 show-tick"
                                                                                 data-width="full" data-container="container" data-size="10" 
                                                                                 data-live-search="true"
                                                                                 required                                            
                                                                                 data-id="city_id_0"
                                                                                 >
                                                                                    <option value="" selected disabled>Select City</option>
                                                                                 </select>

                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Name of Branch :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input 
                                                                           name="branch[0][name]"
                                                                           type="text" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           placeholder="" id="number"
                                                                           required
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Ownership :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 <select 
                                                                                 name="branch[0][ownership]" 
                                                                                 id="branch[0][ownership]" 
                                                                                 title="Ownership" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                                                    <option value="" disabled >Select anyone</option>
                                                                                    <option value="1">Company Owned </option>
                                                                                    <option value="2">Franchise </option>
                                                                                 </select>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">average intake :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 <select 
                                                                                    name="branch[0][average_intake]"
                                                                                    id="branch[0][average_intake]"
                                                                                    title="Average Intake" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                                                    <option value="" disabled selected="">Select</option>
                                                                                    <option value="1-10">Below 10</option>
                                                                                    <option value="10-20">10 - 20</option>
                                                                                    <option value="20-30">20 - 30</option>
                                                                                    <option value="30-40">30 - 40</option>
                                                                                    <option value="40-50">40 - 50</option>
                                                                                    <option value="50-60">50 - 60</option>
                                                                                    <option value="60-70">60 - 70</option>
                                                                                    <option value="70-80">70 - 80</option>
                                                                                    <option value="80-90">80 - 90</option>
                                                                                    <option value="90-100">90 - 100</option>
                                                                                    <option value="100-110">100 - 110</option>
                                                                                    <option value="110-120">110 - 120</option>
                                                                                    <option value="120-130">120 - 130</option>
                                                                                    <option value="130-140">130 - 140</option>
                                                                                    <option value="140-150">140 - 150</option>
                                                                                    <option value="150-160">150 - 160</option>
                                                                                    <option value="160-170">160 - 170</option>
                                                                                    <option value="170-180">170 - 180</option>
                                                                                    <option value="180-190">180 - 190</option>
                                                                                    <option value="190-200">190 - 200</option>
                                                                                    <option value="200-210">200 - 210</option>
                                                                                    <option value="210-220">210 - 220</option>
                                                                                    <option value="220-230">220 - 230</option>
                                                                                    <option value="230-240">230 - 240</option>
                                                                                    <option value="240-250">240 - 250</option>
                                                                                    <option value="Above 250">Above 250</option>
                                                                                 </select>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Mobile 1) :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           autocomplete="off" 
                                                                           onkeypress="return isNumberKey(event)" 
                                                                           pattern="[6789][0-9]{9}" 
                                                                           minlength="10"
                                                                           maxlength="10" name="branch[0][mobile]" type="tel">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Mobile 2) :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           autocomplete="off" 
                                                                           onkeypress="return isNumberKey(event)" 
                                                                           pattern="[6789][0-9]{9}" 
                                                                           minlength="10" 
                                                                           maxlength="10" 
                                                                           name="branch[0][mobile2]" type="tel">
                                                                     </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Landline) :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           autocomplete="off" 
                                                                           onkeypress="return isNumberKey(event)" 
                                                                           name="branch[0][landline]" type="text">

                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Email :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="email" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                           name="branch[0][email]" 
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Website :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="url" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           name="branch[0][website]" 
                                                                           >
                                                                        
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Facebook :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="url" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           name="branch[0][facebook]" 
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Twitter :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="url" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           name="branch[0][twitter]" 
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Instagram :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="url" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           name="branch[0][instagram]" 
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">YouTube :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="url" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           name="branch[0][youtube]" 
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Linkedin :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input type="url" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                                           name="branch[0][linkedin]" >
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

                                          @endif
                                    
                                       </div>
                                    </div>
                                    <div class="col-12 bg-white shadow px-4 py-3  d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between text-right">
                                       
                                       <a 
                                       href="#"
                                       id='addButton' class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="far fa-plus-circle"></i></span><span>Add Branch</span>
                                       </a>
                                       <button 
                                       type="submit"
                                       class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-check-circle"></i></span>
                                          <span>
                                             @if( 
                                                !empty(
                                                   $coaching_branches->toArray()
                                                )
                                             )
                                                Save Changes
                                             @else
                                                Submit
                                             @endif
                                          </span>
                                       </button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="courses-new" role="tabpanel" aria-labelledby="courses-new-tab">
                     <div class="row">
                        <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white mt-md-0 mt-0">
                           <div class="row mx-0">
                              <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                 <form 
                                    action='{{ action("Website\EnterpriseProfileController@enterprise_courses_update") }}'
                                    class="row mx-0"
                                    method="post"
                                    enctype="multipart/form-data"
                                 >
                                 <div class="col-12">
                                    <div class="row form-horizontal3">
                                          @csrf

                                          @php
                                             $i = 0;
                                             $totalcourse = count($coaching_courses_detail);
                                          @endphp
                                          
                                          @if( 
                                             !empty(
                                                $coaching_courses_detail->toArray()
                                             )
                                          )
                                                
                                             @foreach($coaching_courses_detail as $courses_detail)
                                                                                          
                                                <div class="col-12 bg-white control-group3 shadow py-4 mb-4">

                                                   @if(
                                                      session()->has('enterprise') 
                                                         and 
                                                      $courses_detail->status == 'enable'
                                                   )
                                                   <a class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                                                   @endif

                                                   <div class="form-horizontal">
                                                      <div class="control-group">
                                                         <div class="row">

                                                            <input 
                                                               type="hidden"
                                                               name="courses_detail[{{$i}}][id]"
                                                               value="{{ $courses_detail->id ?? '' }}"
                                                            >

                                                            <input 
                                                               type="hidden"
                                                               name="courses_detail[{{$i}}][coaching_courses_id]"
                                                               value="{{ $courses_detail->coaching_courses_id ?? '' }}"
                                                            >

                                                            
                                                            <div class="col-12 text-right">
                                                               @if(
                                                                  $totalcourse >1
                                                                     and
                                                                  !$loop->first
                                                               )
                                                               <button 
                                                               type="button"
                                                               class="removeButtonCourse btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                                                               @endif
                                                            </div>
                                                            
                                                            <div class="col-12">
                                                               <div class="row">
                                                               
                                                                  <div class="col-md-6 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Stream :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][stream_id]" id="courses_detail[{{$i}}][stream_id]" 
                                                                                    class="selectpicker w-100 show-tick streams" 
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                    required
                                                                                    data-id="{{$i}}"
                                                                                    onchange="show_courses(this)"
                                                                                    >
                                                                                       <option value="">Select Stream</option>
                                                                                       @if( !empty($streams) )
                                                                                       @foreach($streams as $stream)
                                                                                       <option                         
                                                                                          @if($courses_detail->stream == $stream->id)
                                                                                             selected
                                                                                          @endif
                                                                                          value="{{$stream->id}}">{{$stream->name}}</option>
                                                                                       @endforeach
                                                                                       @endif
                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  
                                                                  <div class="col-md-6 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select name="courses_detail[{{$i}}][course_id]" id="courses_detail[{{$i}}][course_id]" 
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                    required                                            
                                                                                    data-id="course_id_{{$i}}"
                                                                                    >
                                                                                       <option value="" selected disabled>Select Course</option>
                                                                                       @if( !empty($courses_detail->courses) )
                                                                                          @foreach($courses_detail->courses as $course)
                                                                                          <option 
                                                                                             @if($courses_detail->course == $course->name)
                                                                                                selected
                                                                                             @endif
                                                                                             value="{{$course->id}}">{{$course->name}}</option>
                                                                                          @endforeach
                                                                                       @endif
                                                                                    </select>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>

                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Mode :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][offering][]" id="courses_detail[{{$i}}][offering][]"
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                                  
                                                                                    >
                                                                                       <option 
                                                                                       value="">Select Mode</option>
                                                                                       <option 
                                                                                          @if($courses_detail->offering == 'classroom')
                                                                                             selected
                                                                                          @endif
                                                                                       value="classroom">Classroom</option> 
                                                                                       <option 
                                                                                          @if($courses_detail->offering == 'online')
                                                                                             selected
                                                                                          @endif
                                                                                       value="online">Online</option> 
                                                                                    </select>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course Name :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" name="courses_detail[{{$i}}][name]" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" 
                                                                              value="{{ $courses_detail->name ?? '' }}">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Target (Whom Course for) :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" name="courses_detail[{{$i}}][targeting]" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder=""
                                                                              value="{{ $courses_detail->targeting ?? '' }}">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">About the Course :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" name="courses_detail[{{$i}}][description]" 
                                                                              oninput="return word_limit(this)"
                                                                              class="about_the_course form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder=""
                                                                              value="{{ $courses_detail->description ?? '' }}">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Duration (6 month/1 Year etc) :</label></div>
                                                                        <div class="col-12 px-0">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][duration]" id="courses_detail[{{$i}}][duration]"
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                                  
                                                                                    >
                                                                                       <option value="" >Select</option>
                                                                                       
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "3 Months")
                                                                                             selected
                                                                                          @endif
                                                                                       value="3 Months">3 Months</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "6 Months")
                                                                                             selected
                                                                                          @endif
                                                                                       value="6 Months">6 Months</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "1 year")
                                                                                             selected
                                                                                          @endif
                                                                                       value="1 year">1 year</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "2 year")
                                                                                             selected
                                                                                          @endif
                                                                                       value="2 year">2 year</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "3 year")
                                                                                             selected
                                                                                          @endif
                                                                                       value="3 year">3 year</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "4 year")
                                                                                             selected
                                                                                          @endif
                                                                                       value="4 year">4 year</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "5 year")
                                                                                             selected
                                                                                          @endif
                                                                                       value="5 year">5 year</option>
                                                                                       <option 
                                                                                          @if($courses_detail->duration == "Above 5 Years")
                                                                                             selected
                                                                                          @endif
                                                                                       value="Above 5 Years">Above 5 Years</option>
                                                                                    </select>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Schedule days /Batch Details</label></div>
                                                                        <div class="col-12 px-0">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">

                                                                                    @php
                                                                                       $courses_detail->batch_details = explode(',', $courses_detail->batch_details);
                                                                                    @endphp                                                
                                                                                    
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][batch_details][]" id="courses_detail[{{$i}}][batch_details][]"
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                            
                                                                                    multiple      
                                                                                    >
                                                                                       <option value="" >Select</option>
                                                                                       
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Monday" , $courses_detail->batch_details )
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Monday">Monday</option>
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Tuesday" , $courses_detail->batch_details )
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Tuesday">Tuesday</option>
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Wednesday" , $courses_detail->batch_details)
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Wednesday">Wednesday</option>
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Thursday" , $courses_detail->batch_details)
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Thursday">Thursday</option>
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Friday" , $courses_detail->batch_details) 
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Friday">Friday</option>
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Saturday" , $courses_detail->batch_details)
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Saturday">Saturday</option>
                                                                                       <option 
                                                                                          @if(
                                                                                             in_array("Sunday" , $courses_detail->batch_details )
                                                                                          )
                                                                                             selected
                                                                                          @endif
                                                                                       value="Sunday">Sunday</option>
                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2" data-balloon-length="medium"  data-balloon-pos="up" aria-label="MRP FEE (With/Without GST)"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray ellipsis-1">MRP FEE (With/Without GST) :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input type="tel" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 fee" name="courses_detail[{{$i}}][fee]"   data-fee="{{$i}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                                              
                                                                              value="{{ $courses_detail->fee ?? '' }}">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Discount % :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                                 
                                                                              <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 percentage" name="courses_detail[{{$i}}][offer_percentage]" 
                                                                               minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel"
                                                                              data-percentage="{{$i}}"
                                                                              value="{{ $courses_detail->offer_percentage ?? '' }}"
                                                                              >
                                                                              
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>

                                                                  @php
                  
                                                                     $discount_price = ($courses_detail->fee * $courses_detail->offer_percentage) / 100;
                                                                     $final_price = ($courses_detail->fee - $discount_price);
                                                                  @endphp 

                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Discount Price :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">

                                                                              <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price"
                                                                               minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="{{$i}}"
                                                                              value="{{$discount_price}}"
                                                                              
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2" data-balloon-length="medium"  data-balloon-pos="up" aria-label="Offered Price (With/Without GST) or Final Price"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray ellipsis-1">Offered Price (With/Without GST) or Final Price :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                           
                                                                              <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price" 
                                                                               minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly 
                                                                              data-price="{{$i}}"
                                                                              value="{{$final_price}}"
                                                                              
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>

                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Registration Fees :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">

                                                                           <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price"
                                                                            name="courses_detail[{{$i}}][registration_fee]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" data-registration_fee="0" value="{{ $courses_detail->registration_fee }}" >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">GST INCLUSIVE / EXCLUSIVE</label></div>
                                                                        <div class="col-12 px-0">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][gst_inclusive_exclusive]" id="courses_detail[{{$i}}][gst_inclusive_exclusive]"
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                          
                                                                                    >
                                                                                       <option value="" >Select</option>
                                                                                       
                                                                                       <option 
                                                                                          @if($courses_detail->gst_inclusive_exclusive == "inclusive")
                                                                                             selected
                                                                                          @endif
                                                                                          value="inclusive">Gst Inclusive</option>
                                                                                       <option 
                                                                                          @if($courses_detail->gst_inclusive_exclusive == "exclusive")
                                                                                             selected
                                                                                          @endif
                                                                                          value="exclusive">Gst Exclusive</option>
                                                                                    </select>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Installment Plan</label></div>
                                                                        <div class="col-12 px-0">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][fee_type]" id="courses_detail[{{$i}}][fee_type]"
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                          
                                                                                    >
                                                                                       <option value="" >Select</option>
                                                                                       
                                                                                       <option 
                                                                                          @if($courses_detail->fee_type == "installment")
                                                                                             selected
                                                                                          @endif
                                                                                          value="installment">Yes</option>
                                                                                       <option 
                                                                                          @if($courses_detail->fee_type == "lumpsum")
                                                                                             selected
                                                                                          @endif
                                                                                          value="lumpsum">No</option>
                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4 px-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Lumpsum</label></div>
                                                                        <div class="col-12 px-0">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    <select 
                                                                                    name="courses_detail[{{$i}}][fee_type]" id="courses_detail[{{$i}}][fee_type]"
                                                                                    class="selectpicker w-100 show-tick"
                                                                                    data-width="full" data-container="container" data-size="10" 
                                                                                    data-live-search="true"
                                                                                          
                                                                                    >
                                                                                       <option value="" >Select</option>
                                                                                       
                                                                                       <option 
                                                                                          @if($courses_detail->fee_type == "lumpsum")
                                                                                             selected
                                                                                          @endif
                                                                                          value="lumpsum">Yes</option>
                                                                                       <option 
                                                                                          @if($courses_detail->fee_type == "installment")
                                                                                             selected
                                                                                          @endif
                                                                                          value="installment">No</option>
                                                                                    </select>
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
                                                </div>

                                                @php
                                                   $i += 1;
                                                @endphp
                                                
                                             @endforeach

                                          @else

                                                   <div class="col-12 bg-white control-group3 shadow py-4 mb-4">
                                                      <div class="form-horizontal">
                                                         <div class="control-group">
                                                            <div class="row">

                                                               <div class="col-12">
                                                                  <div class="row">
                                                                  
                                                                     <div class="col-md-6 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Stream :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       
                                                                                       <select name="courses_detail[{{$i}}][stream_id]" id="courses_detail[{{$i}}][stream_id]" 
                                                                                       class="selectpicker w-100 show-tick streams" 
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                       required
                                                                                       data-id="0"
                                                                                       onchange="show_courses(this)"
                                                                                       >
                                                                                          <option value="">Select Stream</option>
                                                                                          @if( !empty($streams) )
                                                                                          @foreach($streams as $stream)
                                                                                          <option value="{{$stream->id}}">{{$stream->name}}</option>
                                                                                          @endforeach
                                                                                          @endif
                                                                                       </select>

                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     
                                                                     <div class="col-md-6 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       <select name="courses_detail[{{$i}}][course_id]" id="courses_detail[{{$i}}][course_id]" 
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                       required                                            
                                                                                       data-id="course_id_0"
                                                                                       >
                                                                                          <option value="" selected disabled>Select Course</option>
                                                                                       </select>
                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>

                                                                     <div class="col-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Mode :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       <select 
                                                                                       name="courses_detail[{{$i}}][offering][]" id="courses_detail[{{$i}}][offering][]"
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                                     
                                                                                       >
                                                                                          <option value="" >Select Mode</option>
                                                                                                                                                                            <option value="classroom">Classroom</option> 
                                                                                          <option value="online">Online</option> 
                                                                                       </select>
                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4 px-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course Name :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">
                                                                                 <input type="text" name="courses_detail[{{$i}}][name]" 
                                                                                 class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" >
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4 px-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Target (Whom Course for) :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">
                                                                                 <input type="text" name="courses_detail[{{$i}}][targeting]" 
                                                                                 class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" >
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">About the Course :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">
                                                                                 <input type="text" name="courses_detail[{{$i}}][description]" 
                                                                                 oninput="return word_limit(this)"
                                                                                 class="about_the_course form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" >
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Duration (6 month/1 Year etc) :</label></div>
                                                                           <div class="col-12 px-0">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       <select 
                                                                                       name="courses_detail[{{$i}}][duration]" id="courses_detail[{{$i}}][duration]"
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                                     
                                                                                       >
                                                                                          <option value="" >Select</option>
                                                                                          
                                                                                          <option value="3 Months">3 Months</option>
                                                                                          <option value="6 Months">6 Months</option>
                                                                                          <option value="1 year">1 year</option>
                                                                                          <option value="2 year">2 year</option>
                                                                                          <option value="3 year">3 year</option>
                                                                                          <option value="4 year">4 year</option>
                                                                                          <option value="5 year">5 year</option>
                                                                                          <option value="Above 5 Years">Above 5 Years</option>
                                                                                       </select>
                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Schedule days /Batch Details</label></div>
                                                                           <div class="col-12 px-0">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       
                                                                                       <select 
                                                                                       name="courses_detail[{{$i}}][batch_details][]" id="courses_detail[{{$i}}][batch_details][]"
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                       multiple      
                                                                                       >
                                                                                          <option value="" >Select</option>
                                                                                          
                                                                                          <option value="Monday">Monday</option>
                                                                                          <option value="Tuesday">Tuesday</option>
                                                                                          <option value="Wednesday">Wednesday</option>
                                                                                          <option value="Thursday">Thursday</option>
                                                                                          <option value="Friday">Friday</option>
                                                                                          <option value="Saturday">Saturday</option>
                                                                                          <option value="Sunday">Sunday</option>
                                                                                       </select>

                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2" data-balloon-length="medium"  data-balloon-pos="up" aria-label="MRP FEE (With/Without GST)"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray ellipsis-1">MRP FEE (With/Without GST) :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">
                                                                                 
                                                                                 <input type="tel" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 fee"
                                                                                  name="courses_detail[{{$i}}][fee]"   data-fee="0" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Discount % :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">
                                                                                    
                                                                                 <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 percentage" name="courses_detail[{{$i}}][offer_percentage]" 
                                                                                 
                                                                                  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel"
                                                                                 data-percentage="0"
                                                                                 >
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Discount Price :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">

                                                                                 <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price"
                                                                                 
                                                                                  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="0">
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2" data-balloon-length="medium"  data-balloon-pos="up" aria-label="Offered Price (With/Without GST) or Final Price"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray ellipsis-1">Offered Price (With/Without GST) or Final Price :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">
                                                                              
                                                                                 <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price" 
                                                                                 
                                                                                  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-price="0">
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>

                                                                     <div class="col-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Registration Fees :</label></div>
                                                                           <div class="col-12 px-2">
                                                                              <div class="form-group">

                                                                                 <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price"
                                                                                 
                                                                                  name="courses_detail[{{$i}}][registration_fee]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" data-registration_fee="0">
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>

                                                                     <div class="col-md-4 px-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">GST INCLUSIVE / EXCLUSIVE</label></div>
                                                                           <div class="col-12 px-0">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       <select 
                                                                                       name="courses_detail[{{$i}}][gst_inclusive_exclusive]" id="courses_detail[{{$i}}][gst_inclusive_exclusive]"
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                             
                                                                                       >
                                                                                          <option value="" >Select</option>
                                                                                          
                                                                                          <option value="inclusive">Gst Inclusive</option>
                                                                                          <option value="exclusive">Gst Exclusive</option>
                                                                                       </select>
                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4 px-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Installment Plan</label></div>
                                                                           <div class="col-12 px-0">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       
                                                                                       <select 
                                                                                       name="courses_detail[{{$i}}][fee_type]" id="courses_detail[{{$i}}][fee_type]"
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                             
                                                                                       >
                                                                                          <option value="" >Select</option>
                                                                                          
                                                                                          <option value="installment">Yes</option>
                                                                                          <option value="lumpsum">No</option>
                                                                                       </select>

                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4 px-md-3 px-2">
                                                                        <div class="row mx-0 mb-md-3 mb-0">
                                                                           <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Lumpsum</label></div>
                                                                           <div class="col-12 px-0">
                                                                              <div class="row">
                                                                                 <div class="col-12">
                                                                                    <div class="form-group">
                                                                                       <select 
                                                                                       name="courses_detail[{{$i}}][fee_type]" id="courses_detail[{{$i}}][fee_type]"
                                                                                       class="selectpicker w-100 show-tick"
                                                                                       data-width="full" data-container="container" data-size="10" 
                                                                                       data-live-search="true"
                                                                                             
                                                                                       >
                                                                                          <option value="" >Select</option>
                                                                                          
                                                                                          <option value="lumpsum">Yes</option>
                                                                                          <option value="installment">No</option>
                                                                                       </select>
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
                                                   </div>
                                                <!-- </div>
                                             </div> -->
                                       
                                          @endif

                                       </div>
                                    </div>
                                    <div class="col-12 bg-white shadow px-4 py-3  d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between text-right">
                                       
                                       <a 
                                       href="#"
                                       id='addButtonCourse' class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="far fa-plus-circle"></i></span><span>Add Course</span>
                                       </a>
                                       <button 
                                       type="submit"
                                       class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-check-circle"></i></span><span>@if( 
                                             !empty(
                                                   $coaching_courses_detail->toArray()
                                                )
                                             )
                                                Save Changes
                                             @else
                                                Submit
                                             @endif</span></button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="result-new" role="tabpanel" aria-labelledby="result-new-tab">
                     <div class="row">
                        <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white mt-md-0 mt-0">
                           <div class="row mx-0">
                              <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                 <form 
                                    action='{{ action("Website\EnterpriseProfileController@enterprise_results_update") }}'
                                    class="row mx-0"
                                    method="post"
                                    enctype="multipart/form-data"
                                 >
                                 <div class="col-12">
                                    <div class="row form-horizontal4">
                                    @csrf
                                       
                                    @php
                                       $i = 0;
                                       $totalresult = count($coaching_results);
                                    @endphp

                                    @if( 
                                       !empty(
                                          $coaching_results->toArray()
                                       )
                                    )

                                       @foreach($coaching_results as $results)
                                          
                                          
                                                <div class="col-12 bg-white control-group4 shadow py-4 mb-4">
                                                
                                                   @if(
                                                      session()->has('enterprise') 
                                                         and 
                                                      $results->status == 'enable'
                                                   )
                                                   <a class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                                                   @endif

                                                   <div class="form-horizontal">
                                                      <div class="control-group">
                                                         <div class="row">
                                                                     
                                                            <input 
                                                               type="hidden"
                                                               name="results[{{$i}}][id]"
                                                               value="{{ $results->id ?? '' }}"
                                                            >

                                                            
                                                            <div class="col-12 text-right">
                                                               @if(
                                                                  $totalresult>1
                                                                     and
                                                                  !$loop->first
                                                               )
                                                               <button 
                                                               type="button"
                                                               class="removeButtonResult btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                                                               @endif
                                                            </div>

                                                            <div class="col-12">
                                                               <div class="row">
                                                                  
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">

                                                                                    <select 
                                                                                    class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  
                                                                                    data-live-search="true" 
                                                                                    required 
                                                                                    name="results[{{$i}}][coaching_courses_id]">
                                                                                       <option value="">Select Course</option>
                                                                                       @if( !empty($ttlcourses) )
                                                                                       @foreach($ttlcourses as $coaching_course)
                                                                                       <option 
                                                                                          @if($results->coaching_courses_id == $coaching_course->id)
                                                                                             selected
                                                                                          @endif
                                                                                          value="{{$coaching_course->id}}">{{$coaching_course->name}}</option>
                                                                                       @endforeach
                                                                                       @endif
                                                                                    </select>
                                                                                 
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Student Name :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                              name="results[{{$i}}][name]"
                                                                              placeholder="" id="number"
                                                                              value="{{$results->name ?? ''}}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Category :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select 
                                                                                    class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  
                                                                                    data-live-search="true" 
                                                                                     
                                                                                    name="results[{{$i}}][category]">
                                                                                       <option value="" disabled >Select</option>
                                                                                       <option 
                                                                                          @if($results->category == "Gen")
                                                                                             selected
                                                                                          @endif
                                                                                       value="Gen">Gen </option>
                                                                                       <option 
                                                                                          @if($results->category == "OBC")
                                                                                             selected
                                                                                          @endif
                                                                                       value="OBC">OBC </option>
                                                                                       <option 
                                                                                          @if($results->category == "SC")
                                                                                             selected
                                                                                          @endif
                                                                                       value="SC">SC </option>
                                                                                       <option 
                                                                                          @if($results->category == "ST")
                                                                                             selected
                                                                                          @endif
                                                                                       value="ST">ST </option>
                                                                                       <option 
                                                                                          @if($results->category == "PWD")
                                                                                             selected
                                                                                          @endif
                                                                                       value="PWD">PWD </option>
                                                                                    </select>
                                                                                    
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Exam :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                              name="results[{{$i}}][exam_name]"
                                                                              placeholder="" id="number"
                                                                              value="{{$results->exam_name ?? ''}}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Rank :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              
                                                                              <input 
                                                                              type="text" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" name="results[{{$i}}][rank]"  value="{{$results->rank ?? ''}}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Score :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input 
                                                                              type="tel" 
                                                                              class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" name="results[{{$i}}][score]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                                              value="{{$results->score ?? ''}}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Year of Qualifying :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="row">
                                                                              <div class="col-12">
                                                                                 <div class="form-group">
                                                                                    
                                                                                    <select name="results[{{$i}}][year]" id="results[{{$i}}][year]" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true">
                                                                                       <option value="" disabled>Select Year</option>
                                                                                       
                                                                                       @foreach(range(date('Y'), 1970) as $year)
                                                                                          <option 
                                                                                             @if($results->year == $year)
                                                                                                selected
                                                                                             @endif
                                                                                             value="{{$year}}">{{$year}}</option>
                                                                                       @endforeach

                                                                                    </select>

                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-md-3 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Branch :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                              name="results[{{$i}}][branch_name]"
                                                                              placeholder="" id="number"
                                                                              value="{{$results->branch_name ?? ''}}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Testimonial :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="form-group">
                                                                              <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                              name="results[{{$i}}][testimonial]"
                                                                              placeholder="" id="number"
                                                                              value="{{$results->testimonial ?? ''}}"
                                                                              >
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-3 px-2">
                                                                     <div class="row mx-0 mb-0">
                                                                        <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Upload Photo :</label></div>
                                                                        <div class="col-12 px-2">
                                                                           <div class="d-flex form-group position-relative">
                                                                              <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Photo</label>
                                                                              <input type="file" class="position-absolute top-3px w-100 h-38px" style="opacity: 0;" id="customFile" 
                                                                              name="results[{{$i}}][image]"
                                                                              />
                                                                              @if( !empty($results->image) )
                                                                              <img 
                                                                                 class="ml-2 mt-1 w-30px h-30px"
                                                                                 src="{{ asset('public/coaching_results/' . $results->image) }}"
                                                                              />
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
                                          
                                          @php
                                             $i += 1;
                                          @endphp
                                          
                                       @endforeach

                                    @else                                   
                                       
                                             <div class="col-12 bg-white control-group4 shadow py-4 mb-4">
                                                <div class="form-horizontal">
                                                   <div class="control-group">
                                                      <div class="row">
                                                         

                                                         <div class="col-12">
                                                            <div class="row">
                                                               
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">

                                                                                 <select 
                                                                                 class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  
                                                                                 data-live-search="true" 
                                                                                 required 
                                                                                 name="results[{{$i}}][coaching_courses_id]">
                                                                                    <option value="">Select Course</option>
                                                                                    @if( !empty($ttlcourses) )
                                                                                    @foreach($ttlcourses as $coaching_course)
                                                                                    <option value="{{$coaching_course->id}}">{{$coaching_course->name}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                 </select>
                                                                              
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Student Name :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                           name="results[{{$i}}][name]"
                                                                           placeholder="" id="number"
                                                                           required
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Category :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 
                                                                                 <select 
                                                                                 class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  
                                                                                 data-live-search="true" 
                                                                                  
                                                                                 name="results[{{$i}}][category]">
                                                                                    <option value="" disabled >Select</option>
                                                                                    <option value="Gen">Gen </option>
                                                                                    <option value="OBC">OBC </option>
                                                                                    <option value="SC">SC </option>
                                                                                    <option value="ST">ST </option>
                                                                                    <option value="PWD">PWD </option>
                                                                                 </select>
                                                                                 
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Exam :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                           name="results[{{$i}}][exam_name]"
                                                                           placeholder="" id="number">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Rank :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           
                                                                           <input 
                                                                           type="text" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" name="results[{{$i}}][rank]" >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Score :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input 
                                                                           type="tel" 
                                                                           class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" name="results[{{$i}}][score]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Year of Qualifying :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 
                                                                                 <select name="results[{{$i}}][year]" id="results[{{$i}}][year]" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true">
                                                                                    <option value="" disabled>Select Year</option>
                                                                                    
                                                                                    @foreach(range(date('Y'), 1970) as $year)
                                                                                       <option value="{{$year}}">{{$year}}</option>
                                                                                    @endforeach

                                                                                 </select>

                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Branch :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                           name="results[{{$i}}][branch_name]"
                                                                           placeholder="" id="number">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Testimonial :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                           name="results[{{$i}}][testimonial]"
                                                                           placeholder="" id="number">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Upload Photo :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group position-relative">
                                                                           <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Photo</label>
                                                                           <input type="file" class="position-absolute top-3px w-100 h-38px" style="opacity: 0;" id="customFile" 
                                                                           name="results[{{$i}}][image]"
                                                                           
                                                                           />
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
                                    
                                    @endif
                                          

                                          </div>
                                       </div>
                                    <div class="col-12 bg-white shadow px-4 py-3  d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between text-right">
                                       
                                       <a 
                                       href="#"
                                       id='addButtonResult' class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="far fa-plus-circle"></i></span><span>Add Result</span>
                                       </a>
                                       <button 
                                       type="submit"
                                       class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-check-circle"></i></span><span>@if( 
                                             !empty(
                                                   $coaching_results->toArray()
                                                )
                                             )
                                                Save Changes
                                             @else
                                                Submit
                                             @endif</span></button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="faculities" role="tabpanel" aria-labelledby="faculities-tab">
                     <div class="row">
                        <div class="col-12 mx-lg-3 shadow px-0 rounded bg-white mt-md-0 mt-0">
                           <div class="row mx-0">
                              <div class="persnol-details bg-light p-md-3 p-2 col-12 border">
                                 <form 
                                    action='{{ action("Website\EnterpriseProfileController@enterprise_faculty_update") }}'
                                    class="row mx-0"
                                    method="post"
                                    enctype="multipart/form-data"
                                 >

                                 <div class="col-12">
                                    <div class="row form-horizontal5">
                                    @csrf

                                       
                                    @php
                                       $i = 0;
                                       $totalfaculity = count($coaching_faculty);
                                    @endphp

                                    @if( 
                                       !empty(
                                          $coaching_faculty->toArray()
                                       )
                                    )
                                       @foreach($coaching_faculty as $faculty)
                                           
                                          <div class="col-12 bg-white control-group5 shadow py-4 mb-4">
                                          
                                             @if(
                                                session()->has('enterprise') 
                                                   and 
                                                $faculty->status == 'enable'
                                             )
                                             <a class="position-absolute z-index-1 top-0 right-0 bottom-0 left-0 link-a"></a>
                                             @endif

                                             <div class="form-horizontal">
                                                <div class="control-group">
                                                   <div class="row">
                                                         <input type="hidden" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                        required name="faculty[{{$i}}][id]"
                                                                        value="{{$faculty->id ?? ''}}"
                                                                        >
                                                      
                                                      <div class="col-12 text-right">
                                                         @if(
                                                            $totalfaculity>1
                                                               and
                                                            !$loop->first
                                                         )
                                                         <button 
                                                         type="button"
                                                         class="removeButtonFaculty btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                                                         @endif
                                                      </div>

                                                      <div class="col-12">
                                                         <div class="row">
                                                            <div class="col-md-4 px-md-3 px-2">
                                                               <div class="row mx-0 mb-md-3 mb-0">
                                                                  <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Name :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="form-group">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                        required name="faculty[{{$i}}][name]"
                                                                        value="{{$faculty->name ?? ''}}"
                                                                        >
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-4 px-md-3 px-2">
                                                               <div class="row mx-0 mb-md-3 mb-0">
                                                                  <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Subject :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="form-group">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                        name="faculty[{{$i}}][subject]"
                                                                        value="{{$faculty->subject ?? ''}}"
                                                                        >
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-4 px-md-3 px-2">
                                                               <div class="row mx-0 mb-md-3 mb-0">
                                                                  <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Qualification :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="form-group">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                        name="faculty[{{$i}}][education]"
                                                                        value="{{$faculty->education ?? ''}}"
                                                                        >
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-3 px-2">
                                                               <div class="row mx-0 mb-0">
                                                                  <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">DESIGNATION  :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="form-group">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                        name="faculty[{{$i}}][designation]"
                                                                        value="{{$faculty->designation ?? ''}}"
                                                                        >
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-3 px-2">
                                                               <div class="row mx-0 mb-0">
                                                                  <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">EXPERIENCE (YRS) :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="row">
                                                                        <div class="col-12">
                                                                           <div class="form-group">
                                                                              <select 
                                                                              name="faculty[{{$i}}][experience]" id="experience" title="Experience" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                                                 <option value="" disabled>Select</option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '1')
                                                                                       selected
                                                                                    @endif
                                                                                    value="1">1 Year </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '2')
                                                                                       selected
                                                                                    @endif
                                                                                    value="2">2 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '3')
                                                                                       selected
                                                                                    @endif
                                                                                    value="3">3 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '4')
                                                                                       selected
                                                                                    @endif
                                                                                    value="4">4 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '5')
                                                                                       selected
                                                                                    @endif
                                                                                    value="5">5 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '6')
                                                                                       selected
                                                                                    @endif
                                                                                    value="6">6 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '7')
                                                                                       selected
                                                                                    @endif
                                                                                    value="7">7 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '8')
                                                                                       selected
                                                                                    @endif
                                                                                    value="8">8 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '9')
                                                                                       selected
                                                                                    @endif
                                                                                    value="9">9 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '10')
                                                                                       selected
                                                                                    @endif
                                                                                    value="10">10 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '11')
                                                                                       selected
                                                                                    @endif
                                                                                    value="11">11 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '12')
                                                                                       selected
                                                                                    @endif
                                                                                    value="12">12 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '13')
                                                                                       selected
                                                                                    @endif
                                                                                    value="13">13 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '14')
                                                                                       selected
                                                                                    @endif
                                                                                    value="14">14 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '15')
                                                                                       selected
                                                                                    @endif
                                                                                    value="15">15 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '16')
                                                                                       selected
                                                                                    @endif
                                                                                    value="16">16 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '17')
                                                                                       selected
                                                                                    @endif
                                                                                    value="17">17 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '18')
                                                                                       selected
                                                                                    @endif
                                                                                    value="18">18 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '19')
                                                                                       selected
                                                                                    @endif
                                                                                    value="19">19 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '20')
                                                                                       selected
                                                                                    @endif
                                                                                    value="20">20 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '21')
                                                                                       selected
                                                                                    @endif
                                                                                    value="21">21 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '22')
                                                                                       selected
                                                                                    @endif
                                                                                    value="22">22 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '23')
                                                                                       selected
                                                                                    @endif
                                                                                    value="23">23 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '24')
                                                                                       selected
                                                                                    @endif
                                                                                    value="24">24 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '25')
                                                                                       selected
                                                                                    @endif
                                                                                    value="25">25 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '26')
                                                                                       selected
                                                                                    @endif
                                                                                    value="26">26 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '27')
                                                                                       selected
                                                                                    @endif
                                                                                    value="27">27 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '28')
                                                                                       selected
                                                                                    @endif
                                                                                    value="28">28 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '29')
                                                                                       selected
                                                                                    @endif
                                                                                    value="29">29 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '30')
                                                                                       selected
                                                                                    @endif
                                                                                    value="30">30 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '31')
                                                                                       selected
                                                                                    @endif
                                                                                    value="31">31 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '32')
                                                                                       selected
                                                                                    @endif
                                                                                    value="32">32 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '33')
                                                                                       selected
                                                                                    @endif
                                                                                    value="33">33 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '34')
                                                                                       selected
                                                                                    @endif
                                                                                    value="34">34 Years </option>
                                                                                 <option 
                                                                                    @if($faculty->experience == '35')
                                                                                       selected
                                                                                    @endif
                                                                                    value="35">35 Years </option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-3 px-2">
                                                               <div class="row mx-0 mb-0">
                                                                  <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Upload Photo :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="d-flex form-group position-relative">
                                                                        <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Photo</label>
                                                                        <input type="file" class="position-absolute top-3px w-100 h-38px" 
                                                                        name="faculty[{{$i}}][image]"
                                                                        style="opacity: 0;" id="customFile">
                                                                        
                                                                        @if( !empty($faculty->image) )
                                                                        <img 
                                                                           class="ml-2 mt-1 w-30px h-30px"
                                                                           src="{{ asset('public/coaching_faculty/' . $faculty->image) }}"
                                                                        />
                                                                        @endif
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-3 px-2">
                                                               <div class="row mx-0 mb-0">
                                                                  <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">LinkedIn Profile :</label></div>
                                                                  <div class="col-12 px-2">
                                                                     <div class="form-group">
                                                                        <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                        onchange="return is_linkedin_url(this)"
                                                                        name="faculty[{{$i}}][link]"
                                                                        placeholder="" id="number"
                                                                        value="{{$faculty->link ?? ''}}"
                                                                        >
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
                                          @php
                                             $i += 1;
                                          @endphp
                                          
                                       @endforeach

                                    @else

                                             <div class="col-12 bg-white control-group5 shadow py-4 mb-4">
                                                <div class="form-horizontal">
                                                   <div class="control-group">
                                                      <div class="row">
                                                         

                                                         <div class="col-12">
                                                            <div class="row">
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Name :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                           required name="faculty[{{$i}}][name]"
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Subject :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                            name="faculty[{{$i}}][subject]"
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4 px-md-3 px-2">
                                                                  <div class="row mx-0 mb-md-3 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Qualification :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                           name="faculty[{{$i}}][education]"
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">DESIGNATION  :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                                                           name="faculty[{{$i}}][designation]"
                                                                           >
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-0">
                                                                     <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">EXPERIENCE (YRS) :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="row">
                                                                           <div class="col-12">
                                                                              <div class="form-group">
                                                                                 <select 
                                                                                 name="faculty[{{$i}}][experience]" id="experience" title="Experience" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                                                    <option value="" disabled>Select</option>
                                                                                    <option value="1">1 Year </option>
                                                                                    <option value="2">2 Years </option>
                                                                                    <option value="3">3 Years </option>
                                                                                    <option value="4">4 Years </option>
                                                                                    <option value="5">5 Years </option>
                                                                                    <option value="6">6 Years </option>
                                                                                    <option value="7">7 Years </option>
                                                                                    <option value="8">8 Years </option>
                                                                                    <option value="9">9 Years </option>
                                                                                    <option value="10">10 Years </option>
                                                                                    <option value="11">11 Years </option>
                                                                                    <option value="12">12 Years </option>
                                                                                    <option value="13">13 Years </option>
                                                                                    <option value="14">14 Years </option>
                                                                                    <option value="15">15 Years </option>
                                                                                    <option value="16">16 Years </option>
                                                                                    <option value="17">17 Years </option>
                                                                                    <option value="18">18 Years </option>
                                                                                    <option value="19">19 Years </option>
                                                                                    <option value="20">20 Years </option>
                                                                                    <option value="21">21 Years </option>
                                                                                    <option value="22">22 Years </option>
                                                                                    <option value="23">23 Years </option>
                                                                                    <option value="24">24 Years </option>
                                                                                    <option value="25">25 Years </option>
                                                                                    <option value="26">26 Years </option>
                                                                                    <option value="27">27 Years </option>
                                                                                    <option value="28">28 Years </option>
                                                                                    <option value="29">29 Years </option>
                                                                                    <option value="30">30 Years </option>
                                                                                    <option value="31">31 Years </option>
                                                                                    <option value="32">32 Years </option>
                                                                                    <option value="33">33 Years </option>
                                                                                    <option value="34">34 Years </option>
                                                                                    <option value="35">35 Years </option>
                                                                                 </select>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Upload Photo :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group position-relative">
                                                                           <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Photo</label>
                                                                           <input type="file" class="position-absolute top-3px w-100 h-38px" 
                                                                           name="faculty[{{$i}}][image]"
                                                                           style="opacity: 0;" id="customFile">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-3 px-2">
                                                                  <div class="row mx-0 mb-0">
                                                                     <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">LinkedIn Profile :</label></div>
                                                                     <div class="col-12 px-2">
                                                                        <div class="form-group">
                                                                           <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                                                           onchange="return is_linkedin_url(this)"
                                                                           name="faculty[{{$i}}][link]"
                                                                           placeholder="" id="number">
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
                                         

                                    @endif
                                     </div>
                                 </div>
                                    <div class="col-12 bg-white shadow px-4 py-3  d-flex flex-md-nowrap flex-wrap align-items-center justify-content-between text-right">
                                       
                                       <a 
                                       href="#"
                                       id='addButtonFaculty' class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="far fa-plus-circle"></i></span><span>Add Faculty</span>
                                       </a>
                                       <button 
                                       type="submit"
                                       class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-check-circle"></i></span><span>@if( 
                                             !empty(
                                                   $coaching_faculty->toArray()
                                                )
                                             )
                                                Save Changes
                                             @else
                                                Submit
                                             @endif</span></button>
                                    </div>
                                 </form>
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
                              <input required type="password" name="old_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px" id="" placeholder="Password">
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
                              <input required type="password" name="new_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px" id="" placeholder="Password">
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
                                 <label class="form-control-label">Confirm Password</label>
                              </div>
                           </div>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                    <i class="fas fa-key"></i>
                                 </span>
                              </div>
                              <input required type="password" name="confirm_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px" id="" placeholder="Password">
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
                        <div class="mt-md-4 mt-2 col-12">                              
                           <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-50px align-items-center d-grid" onclick="return change_password()">Change Password</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade text_editor_modall" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center">
         <h5 class="modal-title fs-16" id="staticBackdropLabel">About </h5>
         <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">×</span>
         </button>
      </div>
      <div class="modal-body text_editor_main">
         <div class="container-fluid">
            <div class="row">
               <div class="container">
           
                <div class="row">
                   <form 
                    action='{{ action("Website\EnterpriseProfileController@enterprise_profile_update") }}'
                    class="row mx-0 bg-white shadow"
                    method="post"
                    enctype="multipart/form-data"
                    >
                    @csrf
                        <div class="col-lg-12 nopadding">
                                <textarea
                                name="description"
                                form="enterprise_basic_form"
                                id="editor"
                                >@if (
                                   ! empty(
                                      session()->get('enterprise')->description
                                   )
                                ){{ session()->get('enterprise')->description }}@endif
                                </textarea> 
                                
                                <div class="btn_editor mt-3 text-right">
                                   <button 
                                   type="submit"
                                   form="enterprise_basic_form"
                                   class="btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="far fa-check-circle"></i></span><span>Save</span></button>
                                </div>
                             </div>
                             
                    </form>
                  </div>
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
               $('#enterprise_basic_form').submit();
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
     $("#datepicker").datepicker({ 
           autoclose: true, 
           todayHighlight: true
     }).datepicker('update', new Date());
   });
</script>


<!-- custom js -->
<script>
   $(document).on('click', '.save_button', function() {

      var field_name = $(this).data('save_button_id');

      var new_value = $('#' + field_name).val();

      $('[data-id="' + field_name + '"').text(new_value);

      setTimeout(() => {
         $('#enterprise_basic_form').submit();
      }, 500);
   });
</script>

    <!-- change password -->
      
   <script>
      function change_password() {

         if(! $('#change_password_form').valid()) {
            return;
         }

         if (
            $('#change_password_form input[name="old_password"]').val() == '' ||
            $('#change_password_form input[name="new_password"]').val() == '' ||
            $('#change_password_form input[name="confirm_password"]').val() == '' 
         ) {

            $('#change_password_form').find('.error_message_to_show').remove();
            $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

            return false;

         } else {

            if(! (/[A-Za-z]/i.test($('#change_password_form input[name="confirm_password"]').val()) &&
           /[0-9]/.test($('#change_password_form input[name="confirm_password"]').val()) &&
           $('#change_password_form input[name="confirm_password"]').val().length >= 6) ) {

               $('#change_password_form').find('.error_message_to_show').remove();
               $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Password does not match'+'</p>');

               return false;
            }

            if(! (/[A-Za-z]/i.test($('#change_password_form input[name="new_password"]').val()) &&
           /[0-9]/.test($('#change_password_form input[name="new_password"]').val()) &&
           $('#change_password_form input[name="new_password"]').val().length >= 6) ) {

               $('#change_password_form').find('.error_message_to_show').remove();
               $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid new password'+'</p>');
               return false;
            }

            var url = '{{ action("Website\EnterpriseProfileController@change_password") }}';
            var post_data = $('#change_password_form').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  if (data.success) {

                     $('#change_password_form').find('.error_message_to_show').remove();
                     $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>'); 
                     
                     $('.modal').modal('hide');

                     document.getElementById("change_password_form").reset();

                  } else {

                     $('#change_password_form').find('.error_message_to_show').remove();
                     $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');
                     
                     return false;
                  }

                  return false;
               }
            });

            return false;
         }
      }
   </script>

   <script>
      function show_hide_scholarship_fields(element) {
         if(element.value == 'yes') {
            $('.scholarship_fields').removeClass('d-none');
         } else {
            $('.scholarship_fields').addClass('d-none');
         }
      } 
   </script>

   
    <script>
        function is_correct_percentage() {
            var scholarship = $('input[name="scholarship"]').val();
            var scholarship_type = $('select[name="scholarship_type"]').val();

            if(scholarship_type == 'per') {

                if( !(scholarship >= 1 && scholarship <= 100) ) {
                    swal.fire('Invalid scholarship percentage');

                    $('input[name="scholarship"]').val('');

                    return false;
                }

            }
        }
    </script>

    <!-- show facility boxes -->
    <script>
      $('#online_classroom_facility_box').addClass('d-none'); 
      $('#classroom_facility_box').removeClass('d-none');
      function show_facility_box(element) {
         if(element.value == 'Online + Classroom') {
            show_online_classroom_facility_box();
         }
         else if(element.value == 'Classroom (Online)') {
            show_online_facility_box();
         }
         else if(element.value == 'Classroom (Classroom)') {
            show_classroom_facility_box();
         }
      }
      
      function show_online_facility_box() {
         $('#online_facility_box').removeClass('d-none');
         
         $('#classroom_facility_box').addClass('d-none'); 
         $('#online_classroom_facility_box').addClass('d-none');   
      }
      function show_classroom_facility_box() {
         $('#classroom_facility_box').removeClass('d-none');      
         
         $('#online_facility_box').addClass('d-none'); 
         $('#online_classroom_facility_box').addClass('d-none');     
      }
      function show_online_classroom_facility_box() {
         $('#online_classroom_facility_box').removeClass('d-none');     
                  
         $('#classroom_facility_box').addClass('d-none'); 
         $('#online_facility_box').addClass('d-none');  
      }
    </script>

    <!-- states -->
      
   <script>
      function show_states(element) {
         var id = element.dataset.id;

         $.ajax({
               type: 'POST',
               url: '{{ action("TestimonialsController@states") }}',
               data: {
                  country_id: element.value,
                  _token: '{{csrf_token()}}'
               },
               success: function(data) {

                  console.log($('[data-id1="state_id_' + id + '"]'));

                  $('[data-id1="state_id_' + id + '"]').html(
                     '<option value="">Select state</option>'
                  );

                  data.forEach(state => {
                                          
                     $('[data-id1="state_id_' + id + '"]').append(
                           '<option value="' + state.name + '">' + state.name + '</option>'
                     );
                  });

                  $('[data-id1="state_id_' + id + '"]').selectpicker('refresh');
               }
         });
      }
   </script>
      
   <script>
      function show_citys(element) {
         var id = element.dataset.id;
         
         $.ajax({
               type: 'POST',
               url: '{{ action("Website\EnterpriseProfileController@cities") }}',
               data: {
                  state_id: element.value,
                  _token: '{{csrf_token()}}'
               },
               success: function(data) {


                  $('[data-id="city_id_' + id + '"]').html(
                     '<option value="">Select city</option>'
                  );

                  data.forEach(city => {
                                          
                     $('[data-id="city_id_' + id + '"]').append(
                           '<option value="' + city.name + '">' + city.name + '</option>'
                     );
                  });

                  $('[data-id="city_id_' + id + '"]').selectpicker('refresh');
               }
         });
      }
   </script>

      
   <!-- add remove branch -->

   <script>
      $(document).ready(function() {

         $("#addButton").click(function() {

               var id = ($('.form-horizontal2 .control-group2').length + 1).toString();
               $('.form-horizontal2').append(
               `
               <div class="col-12 bg-white control-group2 shadow py-4 mb-4">
                  <div class="form-horizontal">
                     <div class="control-group">
                        <div class="row">
                        
                           <div class="col-12 text-right">
                              <button 
                              type="button"
                              class="removeButton btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                           </div>

                           <div class="col-12">
                              <div class="row">
                                 
                                 <div class="col-12 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Address :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input 
                                                type="text" 
                                                class="address form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                                name="branch[${(id - 1)}][address]" 
                                                required
                                                id="address${(id - 1)}" data-element_id="${(id - 1)}"
                                             >
                                             
                                            <input type="hidden" class="form-control" name="branch[0][latitude]" id="latitude${(id - 1)}">
                                            <input type="hidden" class="form-control" name="branch[${(id - 1)}][longitude]" id="longitude${(id - 1)}">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Country :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select name="branch[${(id - 1)}][country_id]" id="branch[${(id - 1)}][country_id]" 
                                                   class="selectpicker w-100 show-tick countrys" data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                   required
                                                   data-id="${(id - 1)}"
                                                   onchange="show_states(this)"
                                                   >
                                                      <option value="" selected disabled>Select country</option>
                                                      @if( !empty($countrys) )
                                                      @foreach($countrys as $country)
                                                      <option 
                                                         value="{{$country->name}}">{{$country->name}}</option>
                                                      @endforeach
                                                      @endif
                                                   </select>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">State :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select name="branch[${(id - 1)}][state_id]" id="branch[${(id - 1)}][state_id]" 
                                                   class="selectpicker w-100 show-tick states" data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                   required
                                                   data-id="${(id - 1)}"
                                                   onchange="show_citys(this)"
                                                   data-id1="state_id_${(id - 1)}"
                                                   >
                                                      <option value="" selected disabled>Select state</option>
                                                      @if( !empty($states) )
                                                      @foreach($states as $state)
                                                      <option value="{{$state->name}}">{{$state->name}}</option>
                                                      @endforeach
                                                      @endif
                                                   </select>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">City :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select 
                                                   name="branch[${(id - 1)}][city_id]" 
                                                   id="branch[${(id - 1)}][city_id]" 
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                   required                                            
                                                   data-id="city_id_${(id - 1)}"
                                                   >
                                                      <option value="" selected disabled>Select City</option>
                                                   </select>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Name of Branch :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input 
                                             name="branch[${(id - 1)}][name]"
                                             type="text" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             placeholder="" id="number"
                                             required
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Ownership :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                   name="branch[${(id - 1)}][ownership]" 
                                                   id="branch[${(id - 1)}][ownership]" 
                                                   title="Ownership" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                      <option value="" disabled >Select anyone</option>
                                                      <option value="1">Company Owned </option>
                                                      <option value="2">Franchise </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">average intake :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                      name="branch[${(id - 1)}][average_intake]"
                                                      id="branch[${(id - 1)}][average_intake]"
                                                      title="Average Intake" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                      <option value="" disabled selected="">Select</option>
                                                      <option value="1-10">Below 10</option>
                                                      <option value="10-20">10 - 20</option>
                                                      <option value="20-30">20 - 30</option>
                                                      <option value="30-40">30 - 40</option>
                                                      <option value="40-50">40 - 50</option>
                                                      <option value="50-60">50 - 60</option>
                                                      <option value="60-70">60 - 70</option>
                                                      <option value="70-80">70 - 80</option>
                                                      <option value="80-90">80 - 90</option>
                                                      <option value="90-100">90 - 100</option>
                                                      <option value="100-110">100 - 110</option>
                                                      <option value="110-120">110 - 120</option>
                                                      <option value="120-130">120 - 130</option>
                                                      <option value="130-140">130 - 140</option>
                                                      <option value="140-150">140 - 150</option>
                                                      <option value="150-160">150 - 160</option>
                                                      <option value="160-170">160 - 170</option>
                                                      <option value="170-180">170 - 180</option>
                                                      <option value="180-190">180 - 190</option>
                                                      <option value="190-200">190 - 200</option>
                                                      <option value="200-210">200 - 210</option>
                                                      <option value="210-220">210 - 220</option>
                                                      <option value="220-230">220 - 230</option>
                                                      <option value="230-240">230 - 240</option>
                                                      <option value="240-250">240 - 250</option>
                                                      <option value="Above 250">Above 250</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Mobile 1) :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input  
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             autocomplete="off" 
                                             onkeypress="return isNumberKey(event)" 
                                             pattern="[6789][0-9]{9}" 
                                             minlength="10"
                                             maxlength="10" name="branch[${(id - 1)}][mobile]" type="tel">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Mobile 2) :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             autocomplete="off" 
                                             onkeypress="return isNumberKey(event)" 
                                             pattern="[6789][0-9]{9}" 
                                             minlength="10" 
                                             maxlength="10" 
                                             name="branch[${(id - 1)}][mobile2]" type="tel">
                                       </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Contact (Landline) :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             autocomplete="off" 
                                             onkeypress="return isNumberKey(event)" 
                                             name="branch[${(id - 1)}][landline]" type="text">

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Email :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="email" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                             name="branch[${(id - 1)}][email]" 
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Website :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="url" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             name="branch[${(id - 1)}][website]" 
                                             >
                                          
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Facebook :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="url" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             name="branch[${(id - 1)}][facebook]" 
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Twitter :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="url" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             name="branch[${(id - 1)}][twitter]" 
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Instagram :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="url" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             name="branch[${(id - 1)}][instagram]" 
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">YouTube :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="url" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             name="branch[${(id - 1)}][youtube]" 
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Linkedin :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="url" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0"
                                             name="branch[${(id - 1)}][linkedin]" >
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
               `
               );

               $('.selectpicker').selectpicker('refresh');

               var address = document.getElementById('address' + (id - 1));

               addListener(address);
         });

         $(document).on('click', ".removeButton", function() {
               if ($('.form-horizontal2 .control-group2').length == 1) {
                  Swal.fire("No more to remove");
                  return false;
               }

               $(this).parents('.control-group2').remove();
            });
      });
   </script>

         
   <!-- add remove course -->

   <script>
      $(document).ready(function() {

         $("#addButtonCourse").click(function() {

               var id = ($('.form-horizontal3 .control-group3').length + 1).toString();
               $('.form-horizontal3').append(
               `
               <div class="col-12 bg-white control-group3 shadow py-4 mb-4">
                  <div class="form-horizontal">
                     <div class="control-group">
                        <div class="row">
                           
                           <div class="col-12 text-right">
                              <button 
                              type="button"
                              class="removeButtonCourse btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                           </div>
                           
                           <div class="col-12">
                              <div class="row">
                                                         
                                 <div class="col-md-6 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Stream :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select name="courses_detail[${(id - 1)}][stream_id]" id="courses_detail[${(id - 1)}][stream_id]" 
                                                   class="selectpicker w-100 show-tick streams" 
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                   required
                                                   data-id="${(id - 1)}"
                                                   onchange="show_courses(this)"
                                                   >
                                                      <option value="">Select Stream</option>
                                                      @if( !empty($streams) )
                                                      @foreach($streams as $stream)
                                                      <option value="{{$stream->id}}">{{$stream->name}}</option>
                                                      @endforeach
                                                      @endif
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 
                                 <div class="col-md-6 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select name="courses_detail[${(id - 1)}][course_id]" id="courses_detail[${(id - 1)}][course_id]" 
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                   required                                            
                                                   data-id="course_id_${(id - 1)}"
                                                   >
                                                      <option value="" selected disabled>Select Course</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Mode :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                   name="courses_detail[${(id - 1)}][offering][]" id="courses_detail[${(id - 1)}][offering][]"
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                                 
                                                   >
                                                      <option value="">Select Mode</option>
                                                      
                                                      <option value="classroom">Classroom</option> 
                                                      <option value="online">Online</option> 
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!--<div class="col-5 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Exam (IIT,NEET,CAT etc)/Certificate Name :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" name="courses_detail[${(id - 1)}][exam_name]" 
                                             class="form-control shadow-none rounded-0" placeholder="" >
                                          </div>
                                       </div>
                                    </div>
                                 </div>-->
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course Name :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" name="courses_detail[${(id - 1)}][name]" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Target (Whom Course for) :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" name="courses_detail[${(id - 1)}][targeting]" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-12 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">About the Course :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" name="courses_detail[${(id - 1)}][description]" 
                                             class="about_the_course form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Duration (6 month/1 Year etc) :</label></div>
                                       <div class="col-12 px-0">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                   name="courses_detail[${(id - 1)}][duration]" id="courses_detail[${(id - 1)}][duration]"
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                                 
                                                   >
                                                      <option value="" >Select</option>
                                                      
                                                      <option value="3 Months">3 Months</option>
                                                      <option value="6 Months">6 Months</option>
                                                      <option value="1 year">1 year</option>
                                                      <option value="2 year">2 year</option>
                                                      <option value="3 year">3 year</option>
                                                      <option value="4 year">4 year</option>
                                                      <option value="5 year">5 year</option>
                                                      <option value="Above 5 Years">Above 5 Years</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Schedule days /Batch Details</label></div>
                                       <div class="col-12 px-0">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select 
                                                   name="courses_detail[${(id - 1)}][batch_details][]" id="courses_detail[${(id - 1)}][batch_details][]"
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                           
                                                   multiple      
                                                   >
                                                      <option value="" >Select</option>
                                                      
                                                      <option value="Monday">Monday</option>
                                                      <option value="Tuesday">Tuesday</option>
                                                      <option value="Wednesday">Wednesday</option>
                                                      <option value="Thursday">Thursday</option>
                                                      <option value="Friday">Friday</option>
                                                      <option value="Saturday">Saturday</option>
                                                      <option value="Sunday">Sunday</option>
                                                   </select>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2" data-balloon-length="medium"  data-balloon-pos="up" aria-label="MRP FEE (With/Without GST)">
                                       <label for="number" 
                                       class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray ellipsis-1" >MRP FEE (With/Without GST) :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input type="tel" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 fee" name="courses_detail[${(id - 1)}][fee]"   data-fee="${(id - 1)}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Discount % :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                                   
                                             <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 percentage" name="courses_detail[${(id - 1)}][offer_percentage]" 
                                             minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel"
                                             data-percentage="${(id - 1)}"
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Discount Price :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">

                                             <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price"
                                             minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="${(id - 1)}">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2" data-balloon-length="medium"  data-balloon-pos="up" aria-label="Offered Price (With/Without GST) or Final Price">
                                       <label for="number" 
                                       class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray ellipsis-1">Offered Price (With/Without GST) or Final Price :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                          
                                             <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price" 
                                             required minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-price="${(id - 1)}">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Registration Fees :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">

                                             <input class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0 price"
                                              name="courses_detail[${(id - 1)}][registration_fee]" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" data-registration_fee="${(id - 1)}">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">GST INCLUSIVE / EXCLUSIVE</label></div>
                                       <div class="col-12 px-0">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                   name="courses_detail[${(id - 1)}][gst_inclusive_exclusive]" id="courses_detail[${(id - 1)}][gst_inclusive_exclusive]"
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                         
                                                   >
                                                      <option value="" >Select</option>
                                                      
                                                      <option value="inclusive">Gst Inclusive</option>
                                                      <option value="exclusive">Gst Exclusive</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Installment Plan</label></div>
                                       <div class="col-12 px-0">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select 
                                                   name="courses_detail[${(id - 1)}][fee_type]" id="courses_detail[${(id - 1)}][fee_type]"
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                         
                                                   >
                                                      <option value="" >Select</option>
                                                      
                                                      <option value="installment">Yes</option>
                                                      <option value="lumpsum">No</option>
                                                   </select>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-0"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Lumpsum</label></div>
                                       <div class="col-12 px-0">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                   name="courses_detail[${(id - 1)}][fee_type]" id="courses_detail[${(id - 1)}][fee_type]"
                                                   class="selectpicker w-100 show-tick"
                                                   data-width="full" data-container="container" data-size="10" 
                                                   data-live-search="true"
                                                         
                                                   >
                                                      <option value="" >Select</option>
                                                      
                                                      <option value="lumpsum">Yes</option>
                                                      <option value="installment">No</option>
                                                   </select>
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
               </div>
               `
               );

               $('.selectpicker').selectpicker('refresh');
         });

         $(document).on('click', ".removeButtonCourse", function() {

               if ($('.form-horizontal3 .control-group3').length == 1) {
                  Swal.fire("No more to remove");
                  return false;
               }

               $(this).parents('.control-group3').remove();

         });
      });
   </script>
   
   <script>
      function show_courses(element) {
         var id = element.dataset.id;

         $.ajax({
               type: 'POST',
               url: '{{action("Website\EnterpriseProfileController@stream_course")}}',
               data: {
                  stream_id: element.value,
                  _token: '{{csrf_token()}}',
                  type: 'coaching'
               },
               success: function(data) {


                  $('[data-id="course_id_' + id + '"]').html(
                     '<option value="">Select Course</option>'
                  );

                  data.forEach(course => {
                                          
                     $('[data-id="course_id_' + id + '"]').append(
                           '<option value="' + course.id + '">' + course.name + '</option>'
                     );
                  });

                  $('[data-id="course_id_' + id + '"]').selectpicker('refresh');
               }
         });
      }
   </script>

      
   <script>

    $(document).on('input', '.fee', function() {

        var data_id = $(this).data('fee');
    
        var fee = $('[data-fee=' + data_id + ']');
        var percentage = $('[data-percentage=' + data_id + ']');
        var discount = $('[data-discount=' + data_id + ']');
        var price = $('[data-price=' + data_id + ']');

        final_price(fee, percentage, discount, price);
    });

    $(document).on('input', '.percentage', function() {

        var data_id = $(this).data('percentage');
    
        var fee = $('[data-fee=' + data_id + ']');
        var percentage = $('[data-percentage=' + data_id + ']');
        var discount = $('[data-discount=' + data_id + ']');
        var price = $('[data-price=' + data_id + ']');

        final_price(fee, percentage, discount, price);
    });

    function final_price(fee, percentage, discount, price) {
        
        if(fee.val() == '') {

            fee.val('');
            percentage.val('');
            discount.val('');
            price.val('');
            return false;
        }

        if(percentage.val() == '' && fee.val() != '') {
            price.val(fee.val());

            return;
        }

        var discount_price = (fee.val() * percentage.val()) / 100;
        var final_price = (fee.val() - discount_price);
        
        discount.val(discount_price);
        price.val(final_price);
    }

   </script>

    <!-- word limit -->
   <script>
      function word_limit(element) {
         var words = element.value.split(' ');
    
         if(words.length > 50) {
            swal.fire('Limit exceed');

            element.value = element.value;
         }
      }
   </script>

     
   <!-- add remove result -->

   <script>
      $(document).ready(function() {

         $("#addButtonResult").click(function() {

               var id = ($('.form-horizontal4 .control-group4').length + 1).toString();
               $('.form-horizontal4').append(
               `
               <div class="col-12 bg-white control-group4 shadow py-4 mb-4">
                  <div class="form-horizontal">
                     <div class="control-group">
                        <div class="row">
                        
                           <div class="col-12 text-right">
                              <button 
                              type="button"
                              class="removeButtonResult btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                           </div>

                           <div class="col-12">
                              <div class="row">
                                 
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Course :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">

                                                   <select 
                                                   class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  
                                                   data-live-search="true" 
                                                   required 
                                                   name="results[${(id - 1)}][coaching_courses_id]">
                                                      <option value="">Select Course</option>
                                                      @if( !empty($ttlcourses) )
                                                      @foreach($ttlcourses as $coaching_course)
                                                      <option value="{{$coaching_course->id}}">{{$coaching_course->name}}</option>
                                                      @endforeach
                                                      @endif
                                                   </select>
                                                
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Student Name :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                             name="results[${(id - 1)}][name]"
                                             placeholder="" id="number"
                                             required
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Category :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select 
                                                   class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  
                                                   data-live-search="true" 
                                                    
                                                   name="results[${(id - 1)}][category]">
                                                      <option value="" disabled >Select</option>
                                                      <option value="Gen">Gen </option>
                                                      <option value="OBC">OBC </option>
                                                      <option value="SC">SC </option>
                                                      <option value="ST">ST </option>
                                                      <option value="PWD">PWD </option>
                                                   </select>
                                                   
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Exam :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                             name="results[${(id - 1)}][exam_name]"
                                             placeholder="" id="number">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Rank :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             
                                             <input 
                                             type="text" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" name="results[${(id - 1)}][rank]">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Score :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input 
                                             type="tel" 
                                             class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" name="results[${(id - 1)}][score]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Year of Qualifying :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   
                                                   <select name="results[${(id - 1)}][year]" id="results[${(id - 1)}][year]" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true">
                                                      <option value="" disabled>Select Year</option>
                                                      
                                                      @foreach(range(date('Y'), 1970) as $year)
                                                         <option value="{{$year}}">{{$year}}</option>
                                                      @endforeach

                                                   </select>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Branch :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                             name="results[${(id - 1)}][branch_name]"
                                             placeholder="" id="number">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Testimonial :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                             name="results[${(id - 1)}][testimonial]"
                                             placeholder="" id="number">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Upload Photo :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group position-relative">
                                             <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Photo</label>
                                             <input type="file" class="position-absolute top-3px w-100 h-38px" style="opacity: 0;" id="customFile" 
                                             name="results[${(id - 1)}][image]"
                                             
                                             />
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
               `
               );

               $('.selectpicker').selectpicker('refresh');
         });

         $(document).on('click', ".removeButtonResult", function() {

               if ($('.form-horizontal4 .control-group4').length == 1) {
                  Swal.fire("No more to remove");
                  return false;
               }

               $(this).parents('.control-group4').remove();

         });
      });
   </script>

      
   <script>
      function is_linkedin_url(element) {
         
         if( ! element.value.includes('linkedin.com') ) {
               swal.fire({
                  title: 'Alert',
                  text: 'Please enter a valid linkedin link'
               });

               element.value = '';
         }
      }
   </script>

   <!-- add remove faculty -->

   <script>
      $(document).ready(function() {

         $("#addButtonFaculty").click(function() {

               var id = ($('.form-horizontal5 .control-group5').length + 1).toString();
               $('.form-horizontal5').append(
               `
               <div class="col-12 bg-white control-group5 shadow py-4 mb-4">
                  <div class="form-horizontal">
                     <div class="control-group">
                        <div class="row">
                        
                           <div class="col-12 text-right">
                              <button 
                              type="button"
                              class="removeButtonFaculty btn btn-green fs-md-14 fs-11 border-0 rounded-pill my-1"><span class="mr-2"><i class="fas fa-trash-alt"></i></span><span>Remove</span></button>
                           </div>

                           <div class="col-12">
                              <div class="row">
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Name :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                             required name="faculty[${(id - 1)}][name]"
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Subject :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                             name="faculty[${(id - 1)}][subject]"
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-4 px-md-3 px-2">
                                    <div class="row mx-0 mb-md-3 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Qualification :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                             name="faculty[${(id - 1)}][education]"
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">DESIGNATION  :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" placeholder="" id="number"
                                             name="faculty[${(id - 1)}][designation]"
                                             >
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-0">
                                       <div class="col-12 px-2"><label for="dob" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">EXPERIENCE (YRS) :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="form-group">
                                                   <select 
                                                   name="faculty[${(id - 1)}][experience]" id="experience" title="Experience" class="selectpicker w-100 show-tick" data-width="full" data-container="container" data-size="10"  data-live-search="true" placeholder="Online Live">
                                                      <option value="" disabled>Select</option>
                                                      <option value="1">1 Year </option>
                                                      <option value="2">2 Years </option>
                                                      <option value="3">3 Years </option>
                                                      <option value="4">4 Years </option>
                                                      <option value="5">5 Years </option>
                                                      <option value="6">6 Years </option>
                                                      <option value="7">7 Years </option>
                                                      <option value="8">8 Years </option>
                                                      <option value="9">9 Years </option>
                                                      <option value="10">10 Years </option>
                                                      <option value="11">11 Years </option>
                                                      <option value="12">12 Years </option>
                                                      <option value="13">13 Years </option>
                                                      <option value="14">14 Years </option>
                                                      <option value="15">15 Years </option>
                                                      <option value="16">16 Years </option>
                                                      <option value="17">17 Years </option>
                                                      <option value="18">18 Years </option>
                                                      <option value="19">19 Years </option>
                                                      <option value="20">20 Years </option>
                                                      <option value="21">21 Years </option>
                                                      <option value="22">22 Years </option>
                                                      <option value="23">23 Years </option>
                                                      <option value="24">24 Years </option>
                                                      <option value="25">25 Years </option>
                                                      <option value="26">26 Years </option>
                                                      <option value="27">27 Years </option>
                                                      <option value="28">28 Years </option>
                                                      <option value="29">29 Years </option>
                                                      <option value="30">30 Years </option>
                                                      <option value="31">31 Years </option>
                                                      <option value="32">32 Years </option>
                                                      <option value="33">33 Years </option>
                                                      <option value="34">34 Years </option>
                                                      <option value="35">35 Years </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">Upload Photo :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group position-relative">
                                             <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Photo</label>
                                             <input type="file" class="position-absolute top-3px w-100 h-38px" 
                                             name="faculty[${(id - 1)}][image]"
                                             style="opacity: 0;" id="customFile">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 px-2">
                                    <div class="row mx-0 mb-0">
                                       <div class="col-12 px-2"><label for="number" class="mb-0 fs-xl-12 fs-lg-11 fs-md-12 fs-12 font-weight-bold text-uppercase text-gray">LinkedIn Profile :</label></div>
                                       <div class="col-12 px-2">
                                          <div class="form-group">
                                             <input type="text" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none rounded-0" 
                                             onchange="return is_linkedin_url(this)"
                                             name="faculty[${(id - 1)}][link]"
                                             placeholder="" id="number">
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
               `
               );

               $('.selectpicker').selectpicker('refresh');
         });

         $(document).on('click', ".removeButtonFaculty", function() {

               if ($('.form-horizontal5 .control-group5').length == 1) {
                  Swal.fire("No more to remove");
                  return false;
               }

               $(this).parents('.control-group5').remove();

         });
      });
   </script>

   <!-- word limit -->
   <script>
      $(document).
      on(
         'keypress',
         '.about_the_course',
         function(e){
    
            var words = $(this).val().split(' ');
      
            if(words.length > 50) {
               swal.fire('Limit exceed');

               e.preventDefault();
            }
         }
      );
   </script>
   
   <!-- word limit -->
   <script>
      $(document).
      on(
         'input',
         '.about_the_course',
         function(e){
    
            var words = $(this).val().split(' ');
      
            if(words.length > 50) {
               swal.fire('Limit exceed');

               e.preventDefault();
            }
         }
      );
   </script>

   <script>
      ClassicEditor
         .create( document.querySelector( '#editor' ), {
         } )
         .then( editor => {
            window.editor = editor;
         } )
         .catch( err => {
            console.error( err.stack );
         } );
   </script>

    <script>
      $('#enterprise_basic_form').submit(
         function () {
            var modals = [];

            if(window.editor.getData() != '') {

                if(
                    $.trim(window.editor.getData()).length < 250
                ) {
                    
                    if(
                        $.trim(window.editor.getData()).length < 250
                    ) {
                        modals.push({
                            title: 'Alert',
                            text: 'Description should be minimum of 250 characters'
                        });
                    }

                    swal.queue(modals);
                    return false;
                }

                return true;
            }

         }
      );
    </script>
    
    <script>
      $('#enterprise_basic_form1').submit(
         function () {
            var modals = [];

            if(
               $.trim(window.editor.getData()).length < 250
            ) {
               
               if(
                  $.trim(window.editor.getData()).length < 250
               ) {
                  modals.push({
                        title: 'Alert',
                        text: 'Description should be minimum of 250 characters'
                  });
               }

               swal.queue(modals);
               return false;
            }
            return true;

         }
      );
    </script>

    <script>
        $(document).ready(
            function() {
                $('#offering').selectpicker({
                    maxOptions:2
                });
            }
        );
    </script>

    <script>
      $(document).on('change', 'input[type="file"]', function() {
         if(
            $(this).parent().find('label').text() == 'Upload Photo'
            ||
            $(this).parent().find('label').text() == 'Uploaded'
         ) {
            $(this).parent().find('label').text('Uploaded');
         }
      });
    </script>
    
<!-- google location -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ config('app.GOOGLE_MAPS_API_KEY') }}"></script>
    
<script>
    var input = document.getElementsByClassName('address');

    for (var x = 0; x < input.length; x++) {
        addListener(input[x]);
    }

    function addListener(el) {
        var id = el.dataset.element_id;

        var autocomplete = new google.maps.places.Autocomplete(el);

        google.maps.event.addListener(autocomplete, 'place_changed', function ()    {
        // Do whatever you want in here e.g.
        // var place = autocomplete.getPlace();
        });

        var places = new google.maps.places.Autocomplete(el);
        google.maps.event.addListener(places, 'place_changed', function (event) {
            // Get place info
            var place = places.getPlace();

            // Do whatever with the value!
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            geocodeLatLng(latitude,longitude, id);

            $('#latitude' + id).val(latitude);
            $('#longitude' + id).val(longitude);
        });

        var input = el;
        google.maps.event.addDomListener(input, 'keydown', function(event) { 
            if (event.keyCode === 13) { 
                event.preventDefault(); 
            }
        }); 
    }
</script>

<script>
    var city;
    var state;
    var country;

    function geocodeLatLng(lat, lng, id) {

        var geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(lat, lng);
        
        geocoder.geocode({
            'latLng': latlng
        }, function(results, status) {
            if (status === 'OK') {
                if (results[1]) {
                    console.log(results);
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                            switch (results[0].address_components[i].types[b]) {
                                case 'locality':
                                    city = results[0].address_components[i].long_name;
                                    break;
                                case 'administrative_area_level_1':
                                    state = results[0].address_components[i].long_name;
                                    break;
                                case 'country':
                                    country = results[0].address_components[i].long_name;
                                    break;
                            }
                        }
                    }
                    console.log('City = ' + city + ', ' + 'State = ' +  state + ', ' + 'Country = ' +  country);

                    // return {city, state, country};

                    // set country
                    $("select[id='branch["+id+"][country_id]'] option").filter(function() {
                        return this.text == country; 
                    }).prop('selected', true);
                    
                    $("select[id='branch["+id+"][country_id]']").selectpicker('refresh');

                    console.log(
                        $("select[id='branch["+id+"][country_id]']")
                    );

                    $.ajax({
                        'type': 'POST',
                        'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                        'data': {
                            _token: "{{csrf_token()}}",
                            x: $("select[id='branch["+id+"][country_id]'] option:selected").val()
                        },
                        'success': function(data) {
                            $("select[id='branch["+id+"][state_id]']").html(data);
                            $("select[id='branch["+id+"][state_id]']").selectpicker('refresh');

                            // set state
                            $("select[id='branch["+id+"][state_id]'] option").filter(function() {
                                return this.text == state; 
                            }).prop('selected', true);
                            
                            $("select[id='branch["+id+"][state_id]']").selectpicker('refresh');

                            $.ajax({
                                'type': 'POST',
                                'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                                'data': {
                                    _token: "{{csrf_token()}}",
                                    x: $("select[id='branch["+id+"][state_id]'] option:selected").val()
                                },
                                'success': function(data) {
                                    $("select[id='branch["+id+"][city_id]']").html(data);
                                    $("select[id='branch["+id+"][city_id]']").selectpicker('refresh');
                                            
                                    // set city
                                    $("select[id='branch["+id+"][city_id]'] option").filter(function() {
                                        return this.text == city; 
                                    }).prop('selected', true);
                                    
                                    $("select[id='branch["+id+"][city_id]']").selectpicker('refresh');

                                },
                            });

                        },
                    });
                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }
</script>

<script>
   $('.successfully_messages').delay(2000).fadeOut(1000);
   $('.error_messages').delay(2000).fadeOut(1000);
</script>