@include('website/layouts/header')

<style>
   .ellipsis-7 {
      display: -webkit-box;
      -webkit-line-clamp: 7;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
   }

   div {
      overflow-wrap: anywhere;
   }

   .fixed_container {
      max-height: 210px;
      overflow: scroll;
   }
   
   .sticky_cl{
      position: sticky;
      top: 153px;
   }

   .fixed_container {
      max-height: 200px;
      overflow: scroll;
   }

   .display-none {
      display: none !important;
   }
</style>

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner exam_single_banner">
      <div class="container position-relative z-index-2">
         <div class="row align-items-start">
            <div class="col-lg-auto text-center mb-lg-0 mb-md-3 mb-3" data-aos="fade-right">
               <img class="bg-white h-lg-90px h-md-70px h-55px w-lg-90px w-md-70px w-55px rounded-pill mb-lg-2" src="{{ asset('public/exams/' . $exam->image) }}" 
               onerror="this.src='<?php echo asset('public/logo.png'); ?>'"
               alt="{{ basename( asset('public/exams/' . $exam->image) ) }}">
               <div class="exam_single_banner_btn"> 
                  @if( !empty($exam->url) )
                  <a href="{{$exam->url ?? ''}}" class="text-primary d-lg-block d-md-inline-block d-inline-block exam_single_box bg-white px-2 py-1 mt-3 rounded fs-lg-14 fs-md-12 fs-12 shadow mb-0" target="_blank">
                     <strong class=""><i class="fas fa-external-link-alt mr-2"></i>Website</strong>
                  </a>
                  @endif

                  @if( !empty($exam->brochure_or_pdf) )
                  <a class="text-primary d-lg-block d-md-inline-block d-inline-block exam_single_box bg-white px-2 py-1 mt-3 rounded fs-lg-14 fs-md-12 fs-12 shadow mb-0" target="_blank" href="{{ asset('public/exams/' . $exam->brochure_or_pdf) }}">
                     <strong class="ml-auto">Download Brochure</strong>
                  </a>
                  @endif
               </div>
            </div>
            <div class="text-lg-left text-md-center text-center col" data-aos="fade-left">
               <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-36 fs-md-28 fs-20 ellipsis-1">{{ $exam->title }}</h2>
               <p class="fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-14 text-lg-justify text-md-justify text-justify fs-13 mb-lg-3 mb-md-2 mb-2 text-white mb-0 mt-lg-3 ellipsis-7 text-justify">
               {{$exam->short_description}}
               </p>
            </div>
         </div>
      </div>
   </section>
   <!-- inner banner section  -->


   @if( 
         ( !empty($exam->registration_begins) 
         or !empty($exam->registration_end) 
         or !empty($exam->admit_card_release) 
         or !empty($exam->exam_date) 
         or !empty($exam->results_date) 
         
         or !empty($exam->url) 
         or !empty($exam->mode_of_exam) 
         or !empty($exam->exam_fee) 
         or !empty($exam->reservation_available) 
         or !empty($exam->exam_frequency) 
         or !empty($exam->exam_duration) 
         or !empty($exam->conducted_by) 
         or !empty($exam->programs) 
         or !empty($exam->exam_language) 
         
         or !empty($exam->min_age) 
         or !empty($exam->max_age) 
         or !empty($exam->no_of_attempts) 
         or !empty($exam->last_qualifying_exam_subjects) 
         or !empty($exam->qualifying_exam_and_marks_required) 
         
         or !empty($exam->exam_type) 
         or !empty($exam->stages) 
         or !empty($exam->negative_marking) 
         or !empty($exam->no_of_questions) 
         or !empty($exam->maximum_marks) 
         or !empty($exam->cutoff) 
      )
      or
      ( !empty($exam->url) 
      or !empty($exam->mode_of_exam) 
      or !empty($exam->exam_fee) 
      or !empty($exam->reservation_available) 
      or !empty($exam->exam_frequency) 
      or !empty($exam->exam_duration) 
      or !empty($exam->conducted_by) 
      or !empty($exam->programs) 
      or !empty($exam->exam_language) 
      )
      or
      ( !empty($exam->min_age) 
      or !empty($exam->max_age) 
      or !empty($exam->no_of_attempts) 
      or !empty($exam->last_qualifying_exam_subjects) 
      or !empty($exam->qualifying_exam_and_marks_required) 
      )
      or
      ( !empty($exam->exam_type) 
      or !empty($exam->stages) 
      or !empty($exam->negative_marking) 
      or !empty($exam->no_of_questions) 
      or !empty($exam->maximum_marks) 
      or !empty($exam->cutoff) 
      )
      or
      ( !empty($exam->syllabus) )
      or
      ( !empty($exam->reservation_criteria) )
      or
      ( !empty($exam->miscellaneous_information) )
      or
      ( !empty($exam->mocks) )
      or
      ( !empty($exam->faq) )
   )
   <div class="container-fluid mt-n4 position-relative top-xxl-n14px top-xl-n14px top-lg-n0px">
      <div class="row">
         <div class="col-md-12 mx-0">
            <div class="row shadow mx-0 px-xxl-3 px-xl-3 px-lg-2 px-md-3 px-3 py-xxl-3 py-xl-3 py-lg-2 py-md-2 py-2 bg-white rounded">
               <div class="d-flex tab_offer align-items-center col px-xxl-3 px-xl-3 px-lg-1 px-md-1 px-1 border-0 justify-content-start">
                  
                  @if( !empty($exam->registration_begins) 
                     or !empty($exam->registration_end) 
                     or !empty($exam->admit_card_release) 
                     or !empty($exam->exam_date) 
                     or !empty($exam->results_date) 
                     
                     or !empty($exam->url) 
                     or !empty($exam->mode_of_exam) 
                     or !empty($exam->exam_fee) 
                     or !empty($exam->reservation_available) 
                     or !empty($exam->exam_frequency) 
                     or !empty($exam->exam_duration) 
                     or !empty($exam->conducted_by) 
                     or !empty($exam->programs) 
                     or !empty($exam->exam_language) 
                     
                     or !empty($exam->min_age) 
                     or !empty($exam->max_age) 
                     or !empty($exam->no_of_attempts) 
                     or !empty($exam->last_qualifying_exam_subjects) 
                     or !empty($exam->qualifying_exam_and_marks_required) 
                     
                     or !empty($exam->exam_type) 
                     or !empty($exam->stages) 
                     or !empty($exam->negative_marking) 
                     or !empty($exam->no_of_questions) 
                     or !empty($exam->maximum_marks) 
                     or !empty($exam->cutoff) 
                  )
                  <a href="#important-dates" class="active-tab text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right rounded-left border-0">Important Dates</a>
                  @endif
                  
                  @if( !empty($exam->url) 
                     or !empty($exam->mode_of_exam) 
                     or !empty($exam->exam_fee) 
                     or !empty($exam->reservation_available) 
                     or !empty($exam->exam_frequency) 
                     or !empty($exam->exam_duration) 
                     or !empty($exam->conducted_by) 
                     or !empty($exam->programs) 
                     or !empty($exam->exam_language) 
                     )
                  <a href="#exam-details" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Exam Details</a>
                  @endif
                  
                  @if( !empty($exam->min_age) 
                     or !empty($exam->max_age) 
                     or !empty($exam->no_of_attempts) 
                     or !empty($exam->last_qualifying_exam_subjects) 
                     or !empty($exam->qualifying_exam_and_marks_required) 
                     )
                  <a href="#Eligibility" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Eligibility</a>
                  @endif

                  @if( !empty($exam->exam_type) 
                     or !empty($exam->stages) 
                     or !empty($exam->negative_marking) 
                     or !empty($exam->no_of_questions) 
                     or !empty($exam->maximum_marks) 
                     or !empty($exam->cutoff) 
                     )
                  <a href="#marking-scheme-pattern-and" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Marks & Cutoff</a>
                  @endif
                  
                  @if( !empty($exam->syllabus) )
                  <a href="#syllabuss" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Syllabus</a>
                  @endif

                  @if( !empty($exam->reservation_criteria) )
                  <a href="#reservation-criteria" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Reservation</a>
                  @endif
                  
                  @if( !empty($exam->miscellaneous_information) )
                  <a href="#exam-centers-information" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Exam Center</a>
                  @endif
                  
                  @if( !empty($exam->mocks) )
                  <a href="#mocks" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0">Mocks</a>
                  @endif
                  
                  @if( !empty($exam->faq) )
                  <a href="#faq" class="text-uppercase bg-secondary text-white fs-xxl-13 fs-xl-13 fs-lg-11 fs-md-12 fs-11 py-lg-2 py-md-2 py-2 w-lg-100 px-lg-0 px-md-3 px-4 text-nowrap text-center border-right border-0 rounded-right">FAQ</a>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
   @endif


   <!-- Entrance exam section  -->
   <section id="exam_registration" class="exam_registration overflow-unset">
      <div class="container">
         <div class="row align-items-start   ">
            <div class="col-lg-8 col-12">
               <div class="exam_registration_part row mb-md-5 mb-4">
                  <div class="col-12 mb-4">
                     @if( !empty( $header->advertisement('full') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('full')->url
                           }}"
                          onclick="clickCounter('<?php echo $header->advertisement('full')->id?>')" target="_blank"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                           alt="{{ basename( asset('public/' . $header->advertisement('full')->image) ) }}"
                           
                        >
                        </a>
                     @endif
                  </div>
                  @if( !empty($exam->registration_begins) 
                     or !empty($exam->registration_end) 
                     or !empty($exam->admit_card_release) 
                     or !empty($exam->exam_date) 
                     or !empty($exam->results_date) 
                     
                     or !empty($exam->url) 
                     or !empty($exam->mode_of_exam) 
                     or !empty($exam->exam_fee) 
                     or !empty($exam->reservation_available) 
                     or !empty($exam->exam_frequency) 
                     or !empty($exam->exam_duration) 
                     or !empty($exam->conducted_by) 
                     or !empty($exam->programs) 
                     or !empty($exam->exam_language) 
                     
                     or !empty($exam->min_age) 
                     or !empty($exam->max_age) 
                     or !empty($exam->no_of_attempts) 
                     or !empty($exam->last_qualifying_exam_subjects) 
                     or !empty($exam->qualifying_exam_and_marks_required) 
                     
                     or !empty($exam->exam_type) 
                     or !empty($exam->stages) 
                     or !empty($exam->negative_marking) 
                     or !empty($exam->no_of_questions) 
                     or !empty($exam->maximum_marks) 
                     or !empty($exam->cutoff) 
                  )
                  @endif

                  @if( !empty($exam->registration_begins) 
                     or !empty($exam->registration_end) 
                     or !empty($exam->admit_card_release) 
                     or !empty($exam->exam_date) 
                     or !empty($exam->results_date) 
                     
                     or !empty($exam->url) 
                     or !empty($exam->mode_of_exam) 
                     or !empty($exam->exam_fee) 
                     or !empty($exam->reservation_available) 
                     or !empty($exam->exam_frequency) 
                     or !empty($exam->exam_duration) 
                     or !empty($exam->conducted_by) 
                     or !empty($exam->programs) 
                     or !empty($exam->exam_language) 
                     
                     or !empty($exam->min_age) 
                     or !empty($exam->max_age) 
                     or !empty($exam->no_of_attempts) 
                     or !empty($exam->last_qualifying_exam_subjects) 
                     or !empty($exam->qualifying_exam_and_marks_required) 
                     
                     or !empty($exam->exam_type) 
                     or !empty($exam->stages) 
                     or !empty($exam->negative_marking) 
                     or !empty($exam->no_of_questions) 
                     or !empty($exam->maximum_marks) 
                     or !empty($exam->cutoff) 
                  )
                  <div class="col-12">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="important-dates"></div>
                        
                     @if( !empty($exam->registration_begins) 
                     or !empty($exam->registration_end) 
                     or !empty($exam->admit_card_release) 
                     or !empty($exam->exam_date) 
                     or !empty($exam->results_date) 
                     )
                     <div class="row mx-0 mt-md-4 mt-2">
                        <div class="col-md-12">
                           <div class="row rounded-top py-3" data-aos="fade-up">
                              <div class="col-12 font-weight-bold pl-0 fs-md-18 fs-15">
                                 Important Dates
                              </div>
                           </div>
                           <div class="row">

                              @php
                                 $c = 1;
                              @endphp
                        
                              @if( !empty($exam->registration_begins) )
                              <div class="col-md-4 mb-4" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box border-left border-secondary">
                                    <div class="position-absolute rounded-10 bg-secondary left-n18px top-13px h-md-50px h-40px fs-md-40 fs-28 text-secondary w-md-40px w-35px d-flex align-items-center justify-content-center font-weight-bold impo-dates-no">{{$c}}</div>
                                    <div class="fs-13 text-gray font-weight-bold mb-2">
                                       Registration Begins :
                                    </div>
                                    <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold px-3">
                                    {{ $exam->registration_begins ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              
                              @php
                                 $c += 1;
                              @endphp

                              @endif
                              @if( !empty($exam->registration_end) )
                              <div class="col-md-4 mb-4" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box border-left border-secondary">
                                    <div class="position-absolute rounded-10 bg-secondary left-n18px top-13px h-md-50px h-40px fs-md-40 fs-28 text-secondary w-md-40px w-35px d-flex align-items-center justify-content-center font-weight-bold impo-dates-no">{{$c}}</div>
                                    <div class="fs-13 text-gray font-weight-bold mb-2">
                                       Last Date for Application :
                                    </div>
                                    <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold px-3">
                                    {{ $exam->registration_end ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              
                              @php
                                 $c += 1;
                              @endphp

                              @endif
                              @if( !empty($exam->admit_card_release) )
                              <div class="col-md-4 mb-4" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box border-left border-secondary">
                                    <div class="position-absolute rounded-10 bg-secondary left-n18px top-13px h-md-50px h-40px fs-md-40 fs-28 text-secondary w-md-40px w-35px d-flex align-items-center justify-content-center font-weight-bold impo-dates-no">{{$c}}</div>
                                    <div class="fs-13 text-gray font-weight-bold mb-2">
                                       Admit Card Release :
                                    </div>
                                    <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold px-3">
                                    {{ $exam->admit_card_release ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              
                              @php
                                 $c += 1;
                              @endphp

                              @endif
                              @if( !empty($exam->exam_date) )
                              <div class="col-md-4 mb-4" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box border-left border-secondary">
                                    <div class="position-absolute rounded-10 bg-secondary left-n18px top-13px h-md-50px h-40px fs-md-40 fs-28 text-secondary w-md-40px w-35px d-flex align-items-center justify-content-center font-weight-bold impo-dates-no">{{$c}}</div>
                                    <div class="fs-13 text-gray font-weight-bold mb-2">
                                       Exam Date :
                                    </div>
                                    <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold px-3">
                                    {{ $exam->exam_date ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              
                              @php
                                 $c += 1;
                              @endphp
                              @endif
                              @if( !empty($exam->results_date) )
                              <div class="col-md-4 mb-4" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white py-4 px-3 position-relative courses_box border-left border-secondary">
                                    <div class="position-absolute rounded-10 bg-secondary left-n18px top-13px h-md-50px h-40px fs-md-40 fs-28 text-secondary w-md-40px w-35px d-flex align-items-center justify-content-center font-weight-bold impo-dates-no">{{$c}}</div>
                                    <div class="fs-13 text-gray font-weight-bold mb-2">
                                       Result :
                                    </div>
                                    <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold px-3">
                                    {{ $exam->results_date ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              
                              @php
                                 $c += 1;
                              @endphp
                              @endif
                           </div>
                        </div>
                     </div>
                     @endif
                     
                     @if( !empty($exam->url) 
                     or !empty($exam->mode_of_exam) 
                     or !empty($exam->exam_fee) 
                     or !empty($exam->reservation_available) 
                     or !empty($exam->exam_frequency) 
                     or !empty($exam->exam_duration) 
                     or !empty($exam->conducted_by) 
                     or !empty($exam->programs) 
                     or !empty($exam->exam_language) 
                     )
                     <div class="row mx-0 mt-md-4 mt-2">
                        <div class="col-md-12" data-aos="fade-up">
                           <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="exam-details"></div>
                           <div class="row rounded-top py-3">
                              <div class="col-12 font-weight-bold pl-0 fs-md-18 fs-15">
                                 Exam Details
                              </div>
                           </div>
                           <div class="row shadow rounded-20 py-3" data-aos="fade-up">
                              <div class="col-md-12">
                                 <div class="row align-items-center">
                                       
                                    @if( !empty($exam->url) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Website :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{$exam->url}}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->mode_of_exam) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Mode :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{$exam->mode_of_exam}}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->exam_fee) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Exam Fee :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{$exam->exam_fee}}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->reservation_available) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Reservation :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{ $exam->reservation_available ?? '' }}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->exam_frequency) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Exam Frequency :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{ $exam->exam_frequency ?? '' }}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->exam_duration) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row align-items-center">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Duration :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{ $exam->exam_duration ?? '' }}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->conducted_by) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row align-items-center">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Conducted By :
                                          </div>
                                          <div class="col fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold">
                                             {{ $exam->conducted_by ?? '' }}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->programs) )
                                    <div class="col-12 py-2 px-4 exam_border border-bottom">
                                       <div class="row align-items-center">
                                          <div class="col fs-13 text-gray font-weight-bold">
                                             Programmes :
                                          </div>
                                          <div class="col text-wrap fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold ">
                                             {{ $exam->programs ?? '' }}
                                          </div>
                                       </div>
                                    </div>
                                    @endif   
                                    @if( !empty($exam->exam_language) )
                                    <div class="col-12 py-2 px-4">
                                       <div class="row align-items-center exam_border border-0">
                                          <div class="col fs-13 text-gray font-weight-bold text-nowrap">
                                             Languages :
                                          </div>
                                          <div class="col text-wrap fs-lg-16 fs-md-14 fs-13 text-secondary font-weight-bold ">
                                             {{ str_replace(',', ', ', $exam->exam_language ?? '') }}
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
                     
                     @if( !empty($exam->min_age) 
                     or !empty($exam->max_age) 
                     or !empty($exam->no_of_attempts) 
                     or !empty($exam->last_qualifying_exam_subjects) 
                     or !empty($exam->qualifying_exam_and_marks_required) 
                     )
                     <div class="row mt-md-5 mt-4">
                        <div class="col-md-12">
                           <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="Eligibility"></div>
                           <div class="row mx-0 rounded-top py-3">
                              <div class="col-12 font-weight-bold pl-0 fs-md-18 fs-15" data-aos="fade-up">
                                 Eligibility
                              </div>
                           </div>
                           <div class="row justify-content-center">
                        
                              @if( !empty($exam->min_age) )
                              <div class="col-md-6 my-md-2 d-flex mb-md-0 mb-3 align-items-stretch justify-content-center" data-aos="fade-up">
                                 <div class="courses_box shadow rounded p-1 bg-white row w-100">
                                    <div class="exam-ico border-right bg-secondary col-2 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-whitecondary">
                                       <i class="fas fa-child"></i>
                                    </div>
                                    <div class="inner-text col py-2 bg-light h-100 d-grid rounded-right">
                                       <strong class="fs-13 mb-2 text-gray font-weight-bold">Min Age :</strong>
                                       <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold  text-justify">{{ $exam->min_age ?? '' }}</span>
                                    </div>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->max_age) )
                              <div class="col-md-6 my-md-2 d-flex mb-md-0 mb-3 align-items-stretch justify-content-center" data-aos="fade-up">
                                 <div class="courses_box shadow rounded p-1 bg-white row w-100">
                                    <div class="exam-ico border-right bg-secondary col-2 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4 text-white">
                                       <i class="fas fa-walking"></i>
                                    </div>
                                    <div class="inner-text col py-2 bg-light h-100 d-grid rounded-right">
                                       <strong class="fs-13 mb-2 text-gray font-weight-bold">Max Age :</strong>
                                       <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold  text-justify">{{ $exam->max_age ?? '' }}</span>
                                    </div>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->no_of_attempts) )
                              <div class="col-md-6 my-md-2 d-flex mb-md-0 mb-3 align-items-stretch justify-content-center" data-aos="fade-up">
                                 <div class="courses_box shadow rounded p-1 bg-white row w-100">
                                    <div class="exam-ico border-right bg-secondary col-2 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4 text-white">
                                       <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="inner-text col py-2 bg-light h-100 d-grid rounded-right">
                                       <strong class="fs-13 mb-2 text-gray font-weight-bold">Number of Attempts :</strong>
                                       <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold  text-justify">{{ $exam->no_of_attempts ?? '' }}</span>
                                    </div>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->last_qualifying_exam_subjects) )
                              <div class="col-md-6 my-md-2 d-flex mb-md-0 mb-3 align-items-stretch justify-content-center" data-aos="fade-up">
                                 <div class="courses_box shadow rounded p-1 bg-white row w-100">
                                    <div class="exam-ico border-right bg-secondary col-2 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4 text-white">
                                       <i class="fas fa-book"></i>
                                    </div>
                                    <div class="inner-text col py-2 bg-light h-100 d-grid rounded-right">
                                       <strong class="fs-13 mb-2 text-gray font-weight-bold">Qualification Criteria :</strong>
                                       <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold text-justify">
                                       {{ $exam->last_qualifying_exam_subjects ?? '' }}
                                        </span>
                                    </div>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->qualifying_exam_and_marks_required) )
                              <div class="col-md-8 my-md-2 d-flex align-items-stretch justify-content-center" data-aos="fade-up">
                                 <div class="courses_box shadow rounded p-1 bg-white row w-100">
                                    <div class="exam-ico border-right bg-secondary col-2 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4 text-white">
                                       <i class="fas fa-percent"></i>
                                    </div>
                                    <div class="inner-text col py-2 bg-light h-100 d-grid rounded-right">
                                       <strong class="fs-13 mb-2 text-gray font-weight-bold">Aggregate Percentage / Marks Required :</strong>
                                       <span class="fs-xxl-17 fs-xl-17 fs-lg-15 fs-md-14 fs-14 text-secondary font-weight-bold text-justify">
                                       {{ $exam->qualifying_exam_and_marks_required ?? '' }}
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              @endif   
                           </div>
                        </div>
                     </div>
                     @endif
                     
                     @if( !empty($exam->exam_type) 
                     or !empty($exam->stages) 
                     or !empty($exam->negative_marking) 
                     or !empty($exam->no_of_questions) 
                     or !empty($exam->maximum_marks) 
                     or !empty($exam->cutoff) 
                     )
                     <div class="row mx-0 mt-md-5 mt-4 cut_box">
                        <div class="col-md-12">
                           <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="marking-scheme-pattern-and"></div>
                           <div class="row rounded-top py-3">
                              <div class="col-12 font-weight-bold pl-0 fs-md-18 fs-15" data-aos="fade-up">
                                 Marking Scheme, Pattern & Cut-Offs
                              </div>
                           </div>
                           <div class="row mt-5">
                              @if( !empty($exam->exam_type) )
                              <div class="col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fas fa-chalkboard-teacher"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                       Exam Mode :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->exam_type ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->stages) )
                              <div class="col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fas fa-chart-bar"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                       Stages :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->stages ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->negative_marking) )
                              <div class="col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fas fa-minus"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                       Negative Marking :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->negative_marking ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->no_of_questions) )
                              <div class="col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fas fa-question"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                       Number of Ques. :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->no_of_questions ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              @endif   
                              
                              @php
                              /*
                              <div class="col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fas fa-voicemail"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                       Correct Answer :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->correct_answer ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              */
                              @endphp
                                                            
                              @if( !empty($exam->maximum_marks) )
                              <div class="col-md-4 mb-5 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fas fa-percent"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                       Maximum Marks :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->maximum_marks ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              @endif   
                              
                              @if( !empty($exam->cutoff) )
                              <div class="col-md-4 mb-md-5 mb-4 d-flex align-items-stretch" data-aos="fade-up">
                                 <div class="shadow rounded-10 text-center bg-white pt-4 pb-4 px-3 position-relative courses_box w-100">
                                    <div class="top_icon position-absolute rounded-10 bg-primary left-0 right-0 m-auto top-n30px h-55px fs-20 text-white d-flex align-items-center justify-content-center"><i class="fa fa-search fa-1x text-white"></i></div>
                                    <div class="fs-14 mt-3 text-gray font-weight-bold mb-2">
                                        Cut-Offs :
                                    </div>
                                    <span class="fs-16 text-secondary font-weight-bold text-justify">
                                       {{ $exam->cutoff ?? '' }}
                                    </span>
                                 </div>
                              </div>
                              @endif   
                           </div>
                        </div>
                     </div>
                     @endif
                  </div>
                  @endif

                  @if( !empty($exam->syllabus) )
                  <div class="col-12 mt-3" data-aos="fade-up">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="syllabuss"></div>
                     <div class="row sallaybus_mobile">
                        <div class="col-12">
                           <h2 class="font-weight-bold fs-lg-22 fs-md-18 fs-16 border-bottom pb-2 mb-0">Syllabus </h2>
                        </div>
                        <div class="col-12 mt-4 text-justify">
                           <div class="fs-md-15 fs-14
                           @if( strlen(strip_tags($exam->syllabus)) > 500 )
                           fixed_container
                           @endif
                           ">                     
                              <?php echo $exam->syllabus ?? ''; ?>
                           </div>
                           @if( strlen(strip_tags($exam->syllabus)) > 500 )
                              <div class="display-none col-md-12 d-flex mt-md-3 mt-0 mb-md-0 mb-4 mx-0 justify-content-end">
                              <a href="javascript:;" 
                              class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded"
                              onclick="javascript: this.parentElement.parentElement.firstElementChild.classList.toggle('ellipsis-4'); this.innerHTML == 'Read Less' ? this.innerHTML = 'Read More' : this.innerHTML = 'Read Less';"
                              >Read More</a>
                              </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  @if( !empty($exam->mocks) )
                  <div class="col-12 mt-4" data-aos="fade-up">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="mocks"></div>
                     <div class="row">
                        <div class="col-12">
                           <h2 class="font-weight-bold fs-lg-22 fs-md-18 fs-16 border-bottom pb-2 mb-0">Mocks </h2>
                        </div>
                        <div class="col-md-12">
                           <div class="row mx-0 shadow mt-4 rounded">
                              <div class="col-md-12 
                              @if( strlen(strip_tags($exam->mocks)) > 500 )
                              fixed_container
                              @endif
                              ">
                                 <?php echo $exam->mocks ?? ''; ?>
                              </div>
                              @if( strlen(strip_tags($exam->mocks)) > 500 )
                                 <div class="display-none col-md-12 d-flex mt-3 mx-0 justify-content-end">
                                 <a href="javascript:;" 
                                 class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded"
                                 onclick="javascript: this.parentElement.parentElement.firstElementChild.classList.toggle('fixed_container'); this.innerHTML == 'Read Less' ? this.innerHTML = 'Read More' : this.innerHTML = 'Read Less';"
                                 >Read More</a>
                                 </div>
                              @endif
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  @if( !empty($exam->reservation_criteria) )
                  <div class="col-12 mt-5" data-aos="fade-up">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="reservation-criteria"></div>
                     <div class="row">
                        <div class="col-12">
                           <h2 class="font-weight-bold fs-lg-22 fs-md-18 fs-16 border-bottom pb-2 mb-0">Reservation Criteria </h2>
                        </div>
                        <div class="col-12 mt-4 text-justify scroll_div">
                           <div class="fs-md-15 fs-14 
                           @if( strlen(strip_tags($exam->reservation_criteria)) > 500 )
                           fixed_container
                           @endif
                           ">                                      
                              <?php echo $exam->reservation_criteria ?? ''; ?>
                           </div>
                           @if( strlen(strip_tags($exam->reservation_criteria)) > 500 )
                              <div class="display-none col-md-12 d-flex mt-3 mx-0 justify-content-end">
                              <a href="javascript:;" 
                              class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded"
                              onclick="javascript: this.parentElement.parentElement.firstElementChild.classList.toggle('fixed_container'); this.innerHTML == 'Read Less' ? this.innerHTML = 'Read More' : this.innerHTML = 'Read Less';"
                              >Read More</a>
                              </div>
                           @endif
                           
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  @if( !empty($exam->latest_exam_updates) )
                  <div class="col-12 mt-md-5 mt-4" data-aos="fade-up">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="latest-exam-updates"></div>
                     <div class="row">
                        <div class="col-12">
                           <h2 class="font-weight-bold fs-lg-22 fs-md-18 fs-16 border-bottom pb-2 mb-0">Latest Exam Updates </h2>
                        </div>
                        <div class="col-12 mt-4 scroll_div">
                           <div class="fs-15 
                           @if( strlen(strip_tags($exam->latest_exam_updates)) > 500 )
                           fixed_container
                           @endif
                            text-justify">                                      
                              <?php echo $exam->latest_exam_updates ?? ''; ?>
                           </div>
                           @if( strlen(strip_tags($exam->latest_exam_updates)) > 500 )
                              <div class="display-none col-md-12 d-flex mt-3 mx-0 justify-content-end">
                              <a href="javascript:;" 
                              class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded"
                              onclick="javascript: this.parentElement.parentElement.firstElementChild.classList.toggle('fixed_container'); this.innerHTML == 'Read Less' ? this.innerHTML = 'Read More' : this.innerHTML = 'Read Less';"
                              >Read More</a>
                              </div>
                           @endif
                           
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  @if( !empty($exam->miscellaneous_information) )
                  <div class="col-12 mt-md-5 mt-4" data-aos="fade-up">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="exam-centers-information"></div>
                     <div class="row">
                        <div class="col-12">
                           <h2 class="font-weight-bold fs-lg-22 fs-md-18 fs-16 border-bottom pb-2 mb-0">Exam Information & Centers </h2>
                        </div>
                        <div class="col-12 mt-4 text-justify scroll_div">
                           <div class="fs-md-15 fs-13 
                           @if( strlen(strip_tags($exam->miscellaneous_information)) > 1500 )
                           fixed_container
                           @endif
                            table-responsive tables_examss">                                      
                              <?php echo($exam->miscellaneous_information ?? ''); ?>
                           </div>

                           @if( strlen(strip_tags($exam->miscellaneous_information)) > 1500 )
                              <div class="display-none col-md-12 d-flex mt-3 mx-0 justify-content-end">
                              <a href="javascript:;" 
                              class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded"
                              onclick="javascript: this.parentElement.parentElement.firstElementChild.classList.toggle('fixed_container'); this.innerHTML == 'Read Less' ? this.innerHTML = 'Read More' : this.innerHTML = 'Read Less';"
                              >Read More</a>
                              </div>
                           @endif
                           
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  @if( !empty($exam->faq) )
                  <div class="col-12 mt-5" data-aos="fade-up">
                     <div class="position-absolute h-1px w-1px scroll-to-top-pos" id="faq"></div>
                     <div class="row">
                        <div class="col-12">
                           <h2 class="font-weight-bold fs-lg-22 fs-md-18 fs-16 border-bottom pb-2 mb-0">Frequently Asked Questions </h2>
                        </div>
                        <div class="col-12 mt-4 text-justify">
                           <div class="fs-15 
                           @if( strlen(strip_tags($exam->faq)) > 500 )
                           fixed_container
                           @endif
                           ">     
                                 <?php echo $exam->faq ?? ''; ?>
                              
                           </div>
                           @if( strlen(strip_tags($exam->faq)) > 500 )
                              <div class="display-none col-md-12 d-flex mt-3 mx-0 justify-content-end">
                              <a href="javascript:;" 
                              class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded"
                              onclick="javascript: this.parentElement.parentElement.firstElementChild.classList.toggle('fixed_container'); this.innerHTML == 'Read Less' ? this.innerHTML = 'Read More' : this.innerHTML = 'Read Less';"
                              >Read More</a>
                              </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  @endif

               </div>
               <div class="exam_syllabus_brochure pt-4 mb-5 display-none">
                  <div class="col-12 px-0">
                     <h2 class="font-weight-bold fs-28 border-bottom pb-2 mb-0">JEE Advance 2017 Syllabus & Brochure</h2>
                  </div>
                  <div class="row align-items-center justify-content-start">
                     <div class="col-md-4 mt-4">
                        <div class="brouche_boxes overflow-hidden text-center shadow position-relative rounded border px-2 py-3">
                           <div class="col-12">
                              <img class="img-fluid" 
                              src="{{ asset('public/website/assets/img/brochure.png') }}" 
                              alt="{{ basename( asset('public/website/assets/img/brochure.png') ) }}" 
                           >
                           </div>
                           <h3 class="fs-14 px-3 py-1 rounded-bottom position-absolute top-60px left-n36px bg-secondary text-white">Brochure</h3>
                           <button class="btn btn-sm btn-green border-0 mt-3 rounded-pill"><span>Download Now</span></button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="exam_pattern row pt-4 mb-0 display-none">
                  <div class="col-md-12">
                     <h2 class="font-weight-bold fs-28 border-bottom pb-2 mb-0">JEE Advanced Pattern</h2>
                  </div>
                  <div class="col-md-12">
                     <a class="overflow-hidden d-block hover_fade_img my-4" href="javascript:;"><img class="img-fluid" 
                     src="{{ asset('public/website/assets/img/pattern_exam.jpg') }}" 
                     alt="{{ basename( asset('public/website/assets/img/pattern_exam.jpg') ) }}" 
                     ></a>
                     <div class="col-12 px-0">
                        <h2 class="font-weight-bold fs-20 border-bottom pb-2 mb-0">JEE Advanced Exam Pattern 2017 </h2>
                        <strong class="fs-16 my-3 d-block">SCHEME OF EXAMINATION -</strong>
                        <p class="fs-15">Only candidates who have cleared JEE Mains are only eligible to sit for JEE Advanced.</p>
                        <ul>
                           <li class="fs-15">
                              JEE Advanced comprises of a written examination and counselling based on the written examination results
                              <ul class="my-3">
                                 <li class="mb-2">
                                    <a class="font-weight-bold text-primary" href="javascript:;">Number of Papers:</a> JEE Advanced 2017 will be conducted as two exams : Paper 1 and Paper 2 each of three hours duration. Both the papers are compulsory.
                                 </li>
                                 <li class="mb-2">
                                    <a class="font-weight-bold text-primary" href="javascript:;">Questions Type:</a> The question papers consist of objective type (multiple choice and numerical answer type) questions designed to test comprehension, reasoning and analytical ability of candidates.
                                 </li>
                                 <li class="mb-2">
                                    <a class="font-weight-bold text-primary" href="javascript:;">Sections/Subjects:</a> Each question paper consists of three separate sections, viz., Physics, Chemistry and Mathematics.
                                 </li>
                                 <li class="mb-2">
                                    Number of Questions
                                 </li>
                                 <li class="mb-2">
                                    Time Allotted
                                 </li>
                                 <li class="mb-2">
                                    Maximum Marks
                                 </li>
                                 <li class="mb-2">
                                    <a class="font-weight-bold text-primary" href="javascript:;">Marking Scheme:</a> Negative marks will be awarded for incorrect answers .
                                 </li>
                              </ul>
                           </li>
                        </ul>
                        <p class="fs-15">The candidates must carefully read and adhere to the detailed instructions given in the question paper.</p>
                        <strong class="fs-16 my-3 d-block">ANSWER SHEET INSTRUCTIONS - Optical Response Sheet (ORS) -</strong>
                        <p class="fs-15">The answer sheet of each paper of JEE (Advanced) is a machine‐readable ORS. Please note the following key points about ORS sheets.</p>
                        <ul>
                           <li class="fs-15 mb-2">The ORS has two pages with the same lay‐out. The first page of the ORS is machine readable. It is designed so as to leave impressions of the responses on the second page.
                           </li>
                           <li class="fs-15 mb-2">Candidates should not separate or disturb the alignment of the two pages of the ORS at any stage and under any circumstance.
                           </li>
                           <li class="fs-15 mb-2">The answers to all the questions should be marked on the first page of the ORS by darkening the appropriate bubble or bubbles (as per the instructions given in the question paper.
                           </li>
                           <li class="fs-15 mb-2">Candidates should use BLACK BALL POINT pen for darkening the bubbles.
                           </li>
                           <li class="fs-15 mb-2">Candidates should apply adequate pressure to ensure that a proper impression is made on the second page of the ORS. Other instructions for darkening the bubbles will be printed on the question paper and candidates must strictly adhere to these instructions.
                           </li>
                           <li class="fs-15 mb-2">The second page of the ORS will be handed over to the candidates by the invigilator at the end of the examination.
                           </li>
                        </ul>
                        <strong class="fs-16 my-3 d-block">LANGUAGE OF JEE ADVANCED EXAM -</strong>
                        <ul>
                           <li class="fs-15 mb-2">The question paper will be in either English or Hindi. Candidates must exercise the choice of question paper language while registering for JEE (Advanced) . Change of question paper language will NOT be entertained after the registration.
                           </li>
                        </ul>
                        <strong class="fs-16 my-3 d-block">EXAM INSTRUCTIONS -</strong>
                        <ul>
                           <li class="fs-15 mb-2">Candidates using the services of a scribe will get one hour compensatory time.
                           </li>
                        </ul>
                        <p class="fs-15">CoachingSelect is here to help in case you need any more information support@coachingselect.com.</p>
                     </div>
                  </div>
                  <div class="col-12 mb-0">
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
            <div class="col-lg-4 col-12 sticky_cl position-sticky top-100px">
               <div class="row mb-3">
                  <div class="col-12 mb-4">
                     @if( !empty( $header->advertisement('small') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('small')->url
                           }}" onclick="clickCounter('<?php echo $header->advertisement('small')->id?>')"
                           target="_blank"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('small')->image) }}"
                           alt="{{ basename( asset('public/' . $header->advertisement('small')->image) ) }}"
                        >
                        </a>
                     @endif
                  </div>
                  <div class="col-12 mb-4">
                     @if( !empty( $header->advertisement('small') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('small')->url
                           }}" onclick="clickCounter('<?php echo $header->advertisement('small')->id?>')"
                           target="_blank"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('small')->image) }}"
                           alt="{{ basename( asset('public/' . $header->advertisement('small')->image) ) }}"
                        >
                        </a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Entrance exam section  -->
</main>


<a href="javascript:;" class="position-fixed back-to-top z-inde-10 h-md-50px h-35px w-md-50px w-35px rounded-pill align-items-center justify-content-center text-center bg-white border border-secondary bottom-10px right-10px text-secondary fs-md-25 fs-18 py-md-2 py-1" style="display:none;">
   <i class="fad fa-arrow-up"></i>
</a>

@include('website/layouts/footer')