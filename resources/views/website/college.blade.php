@include('website/layouts/header')
<style>
   .fixed_container {
      max-height: 250px;
      overflow: scroll;
   }

   .fixed_container1 {
      max-height: 450px;
      overflow: hidden;
   }

   .fixed_container2 {
      max-height: 350px;
      overflow: hidden;
   }

   .one-line-only {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 8px;
   }

   @media (max-width: 1199px) {}

   @media (max-width: 1023px) {}

   @media (max-width: 767px) {
      .one-line-only {
         border-radius: 4px;
         margin-bottom: 0px;
         padding: 10px 8px;
         flex-wrap: wrap;
         justify-content: center;
         backdrop-filter: blur(14px);
         border: 2px solid #ffffff1a;
         white-space: unset;
      }

      .fixed_container1 {
         max-height: 530px;
         overflow: hidden;
      }

      .p_text h2 {
         font-size: 18px;
      }
   }
</style>
<main id="main">
   @php
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
   <div class="collage_single_list_banner position-relative d-flex align-items-center justify-content-start" style="background-image:url('{{ asset($image) }}')">
      <div class="container">
         <div class="collage_single_list_banner_inner row z-index-1 position-relative">
            <div class="col">
               <div class="row">
                  <div class="col-md-auto text-center">
                     <span class="collages_logo">
                        @php
                        if( !empty($college->image) ) {
                        $image = 'public/college/'.$college->image;
                        #if( @GetImageSize( asset($image) ) ) {
                        #} else {
                        #$image = 'public/logo.png';
                        #}
                        } else {
                        $image = 'public/logo.png';
                        }
                        $image = asset($image);
                        @endphp
                        <img src="{{ $image }}" alt="{{ $college->image }}"></span>
                     <a href="javacript:;" class="heart_btn
                     @if($college->is_this_my_favorite)
                     btn-primary btn
                     @endif                        
                     " @if(! session()->has('student'))
                        data-toggle="modal" data-target="#exampleModal1"
                        @endif
                        id="add_to_favorite"
                        >
                        <i class="fas fa-heart mt-1"></i>
                     </a>
                  </div>
                  <div class="col">
                     <h2 class="fs-md-20 fs-17 text-white mb-0 text-md-left text-center mt-md-0 mt-3">
                        {{ $college->college_name ?? '' }}
                     </h2>
                     <div class="row collage_single_list1 mx-0 my-md-4 mt-0 mb-4 shadow">
                        @if( !empty($college->city) and !empty($college->state) )
                        <div class="col-lg-4 col-md-6 col-6 mt-md-0 mt-3 px-md-3 px-1 text-md-left text-center d-flex align-items-strecth">
                           <strong class="text-white fs-lg-14 fs-md-13 fs-12 font-weight-normal d-flex one-line-only w-lg-75 w-100">
                              <div class="w-md-10 w-100 text-center mr-md-2">
                                 <i class="fas fa-map-marker-alt"></i>
                              </div>
                              {{$college->city ?? ''}}, {{$college->state ?? ''}}
                           </strong>
                        </div>
                        @endif
                        @if( !empty($college->recognition) )
                        <div class="col-lg-4 col-md-6 col-6 mt-md-0 mt-3 px-md-3 px-1 text-md-left text-center d-flex align-items-strecth">
                           <strong class="text-white fs-lg-14 fs-md-13 fs-12 font-weight-normal d-flex one-line-only w-lg-75 w-100">
                              <div class="w-md-10 w-100 text-center mr-md-2">
                                 <i class="fas fa-tag"></i>
                              </div>
                              {{ $college->recognition ?? '' }}
                           </strong>
                        </div>
                        @endif
                        @if( !empty($college->year) )
                        <div class="col-lg-4 col-md-6 col-6 mt-md-0 mt-3 px-md-3 px-1 text-md-left text-center d-flex align-items-strecth">
                           <strong class="text-white fs-lg-14 fs-md-13 fs-12 font-weight-normal d-flex one-line-only w-lg-75 w-100">
                              <div class="w-md-10 w-100 text-center mr-md-2"><i class="fas fa-map-pin"></i></div>
                              ESTD {{ $college->year ?? '' }}
                           </strong>
                        </div>
                        @endif
                        @if( !empty($college->campus_area) )
                        <div class="col-lg-4 col-md-6 col-6 mt-md-0 mt-3 px-md-3 px-1 text-md-left text-center d-flex align-items-strecth">
                           <strong class="text-white fs-lg-14 fs-md-13 fs-12 font-weight-normal d-flex one-line-only w-lg-75 w-100">
                              <div class="w-md-10 w-100 text-center mr-md-2">
                                 <i class="fas fa-building"></i>
                              </div>
                              {{ $college->campus_area ?? 0 }}
                           </strong>
                        </div>
                        @endif
                        @if( !empty($college->ranking) )
                        <div class="col-lg-4 col-md-6 col-6 mt-md-0 mt-3 px-md-3 px-1 text-md-left text-center d-flex align-items-strecth">
                           <strong class="text-white fs-lg-14 fs-md-13 fs-12 font-weight-normal d-flex one-line-only w-lg-75 w-100">
                              <div class="w-md-10 w-100 text-center mr-md-2"><i class="far fa-chart-bar"></i></div>
                              {{$college->ranking ?? ''}}
                           </strong>
                        </div>
                        @endif
                        @if( !empty($college->total_enrollment) )
                        <div class="col-lg-4 col-md-6 col-6 mt-md-0 mt-3 px-md-3 px-1 text-md-left text-center d-flex align-items-strecth">
                           <strong class="text-white fs-lg-14 fs-md-13 fs-12 font-weight-normal d-flex one-line-only w-lg-75 w-100">
                              <div class="w-md-10 w-100 text-center mr-md-2">
                                 <i class="fas fa-user-friends"></i>
                              </div>
                              {{ $college->total_enrollment ?? '' }}
                           </strong>
                        </div>
                        @endif
                     </div>
                     <div class="row justify-content-md-start justify-content-center">
                        <div class="col-auto mb-md-0 mb-2">
                           <a href="{{ action('Website\StudentQuestionsAnswersController@student_questions') }}" class="btn btn-green border-0 rounded-pill fs-md-13 fs-11"><span><i class="fas fa-question mr-2"></i>Ask Question</span></a>
                        </div>
                        @php
                        if( !empty($college->brochure_or_pdf) ) {
                        $brochure_or_pdf = 'public/college/'.$college->brochure_or_pdf;
                        #if( @GetImageSize( asset($brochure_or_pdf) ) ) {
                        #}
                        $brochure_or_pdf = asset($brochure_or_pdf);
                        }
                        @endphp
                        @if( !empty($brochure_or_pdf) )
                        <div class="col-auto pl-md-0">
                           <a href="{{ $brochure_or_pdf ?? '#' }}" class="btn btn-green border-0 rounded-pill fs-md-13 fs-11" target="_blank"><span><i class="fas fa-download mr-2"></i>Download Brochure</span></a>
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="collage_single_main py-md-5 py-4 overflow-unset">
      <div class="container">
         <div class="row align-items-start">
            <div class="col-lg-8">
               <div class="collage_single_main_outer">
                  @if( !empty($college->about_college ) )
                  <div class="row mx-0">
                     <div class="col-12 px-0">
                        <div class="text-left mb-4">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                              About College
                           </h2>
                        </div>
                     </div>
                     <div class="col-12 collage_single_section1 rounded-10 p-md-4 p-md-3 p-2 position-relative">
                        <div class="row">
                           <div class="col-12">
                              <div class="row ">
                                 <div class="col-12">
                                    <div class="row mx-0">
                                       <div class="w-100 px-md-3 px-2 py-md-4 py-3 mb-md-3 fs-md-16 fs-14 rounded position-relative bg-white border">
                                          <div class="p_text text-justify 
                                             @if( strlen(strip_tags($college->about_college)) > 800 )
                                             fixed_container
                                             @endif
                                             ">
                                             <p class="fs-md-14 fs-14 text-gray mb-3">
                                                @php
                                                echo ($college->about_college ?? '')
                                                @endphp
                                             </p>
                                          </div>
                                          @if( strlen(strip_tags($college->about_college)) > 800 )
                                          <div class="d-none row mx-0 justify-content-end"><a id="toggle" href="javascript:;" class="btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded">Read More</a>
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
                  @endif
                  <?php
                  $getcourse = json_decode($college->courses_details, true);
                  ?>
                  @if( !empty($getcourse) )
                  <div class="row my-md-5 my-5">
                     <div class="col-12">
                        <div class="text-left mb-4">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">Courses </h2>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="collage_single_courses table-responsive">
                           <table class="table shadow rounded">
                              <thead>
                                 <tr>
                                    <th scope="col">COURSE NAME</th>
                                    <th scope="col">FEES</th>
                                    <th scope="col">Seats</th>
                                    <th scope="col">ELIGIBILITY</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if(!empty($allstream->toArray()))
                                 <?php
                                 $si = 0;

                                 $getcourse = json_decode($college->courses_details, true);
                                 $getcoursefee = json_decode($college->course_fee, true);
                                 $getcourseseats = json_decode($college->course_seats, true);
                                 $getcourseeligibility = json_decode($college->course_eligibility, true);

                                 ?>
                                 @foreach($allstream as $streams)
                                 @if(!empty($allcourses->toArray()))
                                 @foreach($allcourses as $course)
                                 @if($streams->id==$course->stream_id)
                                 @if( !empty($getcourse[$course->stream_id]) )
                                 @if(in_array($course->id, $getcourse[$course->stream_id]))
                                 <tr>
                                    <td>
                                       <a href="Javascript:;">
                                          {{$course->name}}
                                       </a>
                                    </td>
                                    <td>
                                       @if( !empty($getcoursefee[$course->stream_id][$course->id]) )
                                       ₹{{$getcoursefee[$course->stream_id][$course->id]}}
                                       (Total Fees)
                                       @else
                                       -
                                       @endif
                                    </td>
                                    <td>
                                       @if( !empty($getcourseseats[$course->stream_id][$course->id]) )
                                       {{$getcourseseats[$course->stream_id][$course->id]}}
                                       @else
                                       -
                                       @endif
                                    </td>
                                    <td>
                                       @if( !empty($getcourseeligibility[$course->stream_id][$course->id]) )
                                       {{$getcourseeligibility[$course->stream_id][$course->id]}}
                                       @else
                                       -
                                       @endif
                                    </td>
                                 </tr>
                                 @endif
                                 @endif
                                 @endif
                                 @endforeach
                                 @endif
                                 <?php $si++; ?>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  @endif
                  <?php
                  $si = 0;

                  $getcourse = json_decode($college->exams_accepted, true);
                  $getcoursefee = json_decode($college->course_fee, true);

                  ?>
                  @if(!empty($getcourse))
                  <div class="row mt-md-5 mt-4 justify-content-center">
                     <div class="col-12">
                        <div class="text-left mb-4">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                              Exam Accepted
                           </h2>
                        </div>
                     </div>
                     @if(!empty($header->exams()->toArray()))
                     @foreach($header->exams() as $streams)
                     @if(!empty($streams->toArray()))
                     @foreach($streams as $exam)
                     @if($streams[0]->sid==$exam->sid)
                     @if( !empty($getcourse[$exam->sid]) )
                     @if(in_array($exam->id, $getcourse[$exam->sid]))
                     @php
                     $exam_name_slug = str_replace(' ', '-', $exam->title);
                     @endphp
                     <a class="btn text-uppercase btn-outline-primary rounded-pill btn-sm mx-1 fs-13 mb-3" href="{{ action('Website\ExamsController@exam', $exam_name_slug) }}">
                        {{$exam->title}}
                     </a>
                     @endif
                     @endif
                     @endif
                     @endforeach
                     @endif
                     <?php $si++; ?>
                     @endforeach
                     @endif
                  </div>
                  @endif
                  @if( !empty($college->cutoff_of_exam ) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                           Cut-Offs
                        </h2>
                     </div>
                     <div class="col-12 mt-lg-4 mt-md-2 mt-2 text-justify fs-md-14 fs-14">
                        <div class="p_text fixed_container">
                           <p class="fs-md-14 fs-14 text-gray mb-3">
                              @php
                              echo ($college->cutoff_of_exam ?? '')
                              @endphp
                           </p>
                        </div>
                        @if( strlen(strip_tags($college->cutoff_of_exam)) > 500 )
                        <div class="d-none row mx-0 justify-content-end">
                           <a href="javascript:;" class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded">Read More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif
                  @if( !empty($college->admissions_details ) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">Admissions </h2>
                     </div>
                     <div class="col-12 mt-lg-4 mt-md-2 mt-2 text-justify fs-md-14 fs-14">
                        <div class="p_text fixed_container">
                           <p class="fs-md-14 fs-14 text-gray mb-3">
                              @php
                              echo ($college->admissions_details ?? '')
                              @endphp
                           </p>
                        </div>
                        @if( strlen(strip_tags($college->admissions_details)) > 500 )
                        <div class="d-none row mx-0 justify-content-end">
                           <a href="javascript:;" class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded">Read More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif
                  @if( !empty($college->placement_details ) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                           Placements
                        </h2>
                     </div>
                     <div class="col-12 mt-lg-4 mt-md-2 mt-2 text-justify fs-md-14 fs-14">
                        <div class="p_text fixed_container">
                           <p class="fs-md-14 fs-14 text-gray mb-3">
                              @php
                              echo ($college->placement_details ?? '')
                              @endphp
                           </p>
                        </div>

                        @if( strlen(strip_tags($college->placement_details)) > 500 )
                        <div class="d-none row mx-0 justify-content-end">
                           <a href="javascript:;" class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded">Read More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif
                  @if( !empty($college->scholarship ) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                           Scholarships
                        </h2>
                     </div>
                     <div class="col-12 mt-lg-4 mt-md-2 mt-2 text-justify fs-md-14 fs-14">
                        <div class="p_text fixed_container">
                           <p class="fs-md-14 fs-14 text-gray mb-3">
                              @php
                              echo ($college->scholarship ?? '')
                              @endphp
                           </p>
                        </div>
                        @if( strlen(strip_tags($college->scholarship)) > 700 )
                        <div class="d-none row mx-0 justify-content-end">
                           <a href="javascript:;" class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded">Read More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif
                  @if( !empty($college->facility->toArray()) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <div class="text-left mb-0">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                              Facilities
                           </h2>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="row1 fixed_container1">
                           <div class="row">
                              @if( !empty($college->facility->toArray()) )
                              @foreach($college->facility as $facility)
                              <div class="service-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                 <div class="inner-box">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box">
                                       @php echo $facility->image; @endphp
                                    </div>
                                    <h6>
                                       <a class="text-decoration-none" href="javascript:;">
                                          {{ $facility->name }}
                                       </a>
                                    </h6>
                                 </div>
                              </div>
                              @endforeach
                              @else
                              Not Available
                              @endif
                           </div>
                        </div>
                        @if( count($college->facility) >= 10 )
                        <div class="col-12 text-center mt-3">
                           <a class="toggle1 btn-primary btn btn-sm fs-md-14 fs-12 py-1 rounded-pill" href="javascript:;">View More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif
                  @php
                  if( !empty($college->videos)) {
                  $college->videos = array_map('array_filter', $college->videos);
                  $college->videos = array_filter($college->videos);
                  }
                  @endphp
                  @if(
                  !empty($college->videos)
                  or
                  !empty($college->photos)
                  )
                  <div class="row mt-md-5 mt-4 overflow-hidden" id="photos_and_videos">
                     <div class="col-12">
                        <div class="fees_and_courses_tabs">
                           <ul class="nav nav-tabs border-0 pb-0" id="myTab" role="tablist">
                              @php
                              if( !empty($college->videos) ) {
                              $college->videos = json_decode( json_encode($college->videos), true);
                              }
                              @endphp
                              @if( !empty($college->photos) and count(array_filter($college->photos)) >= 1)
                              <li class="nav-item" role="presentation">
                                 <a class="nav-link 
                                    @if( !empty($college->photos) and count(array_filter($college->photos)) >= 1)
                                    active
                                    @endif
                                    " id="gallery_inner1-tab" data-toggle="tab" href="#gallery_inner1" role="tab" aria-controls="course" aria-selected="true">Photos</a>
                              </li>
                              @endif
                              @if( !empty($college->videos) and count(array_filter($college->videos)) >= 1)
                              <li class="nav-item" role="presentation">
                                 <a class="nav-link
                                    @if( count(array_filter($college->photos)) == 0)
                                    active
                                    @endif
                                    " id="gallery_inner2-tab" data-toggle="tab" href="#gallery_inner2" role="tab" aria-controls="gallery_inner2" aria-selected="false">Videos</a>
                              </li>
                              @endif
                           </ul>
                           <div class="tab-content pt-0" id="myTabContent">
                              @if( !empty($college->photos) and count(array_filter($college->photos)) >= 1)
                              <div class="tab-pane fade 
                                 @if( !empty($college->photos) and count(array_filter($college->photos)) >= 1)
                                 show active
                                 @endif" id="gallery_inner1" role="tabpanel" aria-labelledby="gallery_inner1-tab">
                                 <div class="row">
                                    <div class="col-md-12 mt-0 col-md-12 mt-0 mr-lg-5 pr-md-5">
                                       <div class="text-left">
                                       </div>
                                       <div class="gallery_photos owl-carousel mt-4">
                                          @if( !empty($college->photos) )
                                          @foreach($college->photos as $photo)
                                          @php
                                          $image = asset('public/college_image/'. $photo);
                                          if(! @GetImageSize($image) ) {
                                          continue;
                                          }
                                          @endphp
                                          <div class="slide_photos mb-4 mx-3">
                                             <img class="img-fluid border rounded shadow mx-2 mb-2" src="{{ asset('/public/s_img_new.php') }}?image={{ $image }}&width=441&height=323&zc=0" alt="{{ $photo }}">
                                          </div>
                                          @endforeach
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              @endif
                              @if( !empty($college->videos) and count(array_filter($college->videos)) >= 1)
                              <div class="tab-pane fade
                                 @if( count(array_filter($college->photos)) == 0)
                                 show active
                                 @endif" id="gallery_inner2" role="tabpanel" aria-labelledby="gallery_inner2-tab">
                                 <div class="row">
                                    <div class="col-md-12 mt-0">
                                       <div class="text-left">
                                      </div>
                                       <div class="row1 fixed_container2">
                                          <div class="row mt-4">
                                             @if( !empty($college->videos) )
                                             @foreach($college->videos as $video)
                                             @php
                                             /*
                                             $video = asset('public/college_video/'. $video[1]);
                                             */
                                             @endphp
                                             <div class="slide_photos col-md-6 mb-4">
                                                <div class="video-box shadow rounded position-relative text-center d-none">
                                                   <iframe width="315" height="315" class="border rounded shadow mx-2 mb-2" width="300" height="200" src="{{ $video[1] }}">
                                                   </iframe>
                                                   <p class="text-danger bg bg-white"></p>
                                                </div>
                                                <div class="video-box shadow rounded position-relative text-center">
                                                   @php
                                                   $video_part = str_replace('embed/', '', strstr($video[1], 'embed/') );
                                                   @endphp
                                                   <img class="img-fluid shadow-none rounded-top" src="https://img.youtube.com/vi/{{$video_part}}/hqdefault.jpg" alt="hqdefault.jpg">
                                                   <div class="video-btn">
                                                      <a href="{{ $video[1] }}" class="venobox play-btn vbox-item" data-vbtype="video" data-autoplay="true"></a>
                                                   </div>
                                                   <div class="thimbnail_text text-left pt-2 pb-2 px-2 rounded-bottom w-100">
                                                      <h3 class="fs-14 text-primary mb-0">{{ $video[0] }}</h3>
                                                   </div>
                                                </div>
                                             </div>
                                             @endforeach
                                             @endif
                                          </div>
                                       </div>
                                       @if( count($college->videos) >= 3 )
                                       <div class="col-12 text-center mt-3">
                                          <a class="toggle2 btn-primary btn btn-sm fs-14 py-1 rounded-pill" href="javascript:;">View More</a>
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
                  @endif
                  @if( !empty($college->valuable->toArray()) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                           Valuables
                        </h2>
                     </div>
                     <!-- <div class="row mt-4"> -->
                     @if( !empty($college->valuable) )
                     @foreach($college->valuable as $valuable)
                     @php
                     $image = asset('public/college_valuable/'. $valuable->image);
                     #if(! @GetImageSize($image) ) {
                     #continue;
                     #}
                     @endphp
                     <div class="col-md-4 col-12 mt-md-4 mt-3 load_more_outer">
                        <div class="Valuable_profile py-3 text-center rounded shadow">
                           <a class="d-flex align-items-center w-70px h-70px mx-auto justify-content-center border rounded p-0"><img class="img-fluid rounded h-60px border shadow" 
                           src="{{ $image }}" 
                           alt="{{ $valuable->image }}"></a>
                           <div class="Valuable_profile_inner mt-4 border-top pt-3">
                              <a class="text-secondary d-block fs-15 font-weight-bold mb-1" href="javascript:;">
                                 {{$valuable->name ?? ''}}
                              </a>
                              <span class="text-gray fs-14">
                                 {{$valuable->description ?? ''}}
                              </span>
                           </div>
                        </div>
                     </div>
                     @endforeach
                     @endif
                     <input type="hidden" name="total_videos" id="total_videos" value="{{ count($college->valuable) }}">
                     @if( $college->valuable->count() >= 4)
                     <div class="seemore col-md-12 text-center seevideoss mt-4">
                        <a href="javascript:void(0)" class="load-more12 rounded-pill m-auto d-flex align-items-center justify-content-center h-50px fs-20 w-50px bg-secondary"><i class="fas fa-arrow-down"></i></a>
                     </div>
                     @endif
                     <!-- </div> -->
                  </div>
                  @endif
                  @if( !empty($college->news_and_articles ) )
                  <div class="row mt-md-5 mt-4">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                           News & Articles
                        </h2>
                     </div>
                     <div class="col-12 mt-lg-4 mt-md-2 mt-2 text-justify fs-md-14 fs-14">
                        <div class="p_text fixed_container">
                           <p class="fs-md-14 fs-14 text-gray mb-3">
                              @php
                              echo ($college->news_and_articles ?? '')
                              @endphp
                           </p>
                        </div>
                        @if( strlen(strip_tags($college->news_and_articles)) > 500 )
                        <div class="d-none row mx-0 justify-content-end">
                           <a href="javascript:;" class="toggle btn btn-primary fs-11 py-1 px-2 text-right mb-n3 mr-n2 rounded">Read More</a>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif
                  @if( !empty( $college->faq->toArray() ) )
                  <div class="row mt-md-5 mt-5 mb-lg-0 mb-md-4 mb-0">
                     <div class="col-12">
                        <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 border-bottom pb-2 mb-0">
                           Frequently Asked Questions
                        </h2>
                     </div>
                     <div class="col-12 mt-lg-4 mt-md-2 mt-2 text-justify fs-md-14 fs-14">
                        <div class="accordion-list">
                           <ul class="list-unstyled fs-md-13 fs-13">
                              @if( !empty($college->faq) )
                              @php
                              $i = 1;
                              @endphp
                              @foreach($college->faq as $faq)
                              <li class="shadow">

                                 <a data-toggle="collapse" class="text-dark collapsed" href="#accordion-list-{{$i}}" aria-expanded="false">
                                    <span>
                                       @if($i <= 9) 0{{$i}} @else {{$i}} @endif </span>
                                          {{$faq->name}}
                                          <i class="far fa-plus icon-show"></i>
                                          <i class="far fa-minus icon-close"></i>
                                 </a>
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
                  @endif
               </div>
            </div>
            <div class="col-lg-4 col-12 position-md-sticky top-lg-100px">
               <div class="row bg-white shadow rounded border mx-0 mb-3 d-none">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">Exam Information</h4>
                  </div>
                  <div class="col-md-12 px-0 col-12">
                     <div class="col-md-12 col-12">
                        <ul class="recent_exam list-unstyled pl-0 pt-3">
                           <li class="pb-3 mb-3 border-bottom">
                              <a class="row mx-0" href="">
                                 <div class="col-auto px-0">
                                    <img class="img-fluid h-60px p-1 border rounded w-60px" src="{{ asset('public/website/') }}/assets/img/recent_exam.jpg" alt="{{ 'recent_exam.jpg' }}">
                                 </div>
                                 <div class="col">
                                    <h4 class="fs-15 mb-1 font-weight-bold text-dark">JEE Main - Exam, Result</h4>
                                    <p class="fs-13 mb-0 text-secondary"><strong class="text-primary"> Oct 1, 2020 - </strong>JEE advanced results 2020 to be declared on 05-10-2020 </p>
                                 </div>
                              </a>
                           </li>
                           <li class="pb-3 mb-3 border-bottom">
                              <a class="row mx-0" href="">
                                 <div class="col-auto px-0">
                                    <img class="img-fluid h-60px p-1 border rounded w-60px" src="{{ asset('public/website/') }}/assets/img/recent_exam_1.jpg" alt="{{ 'recent_exam_1.jpg' }}">
                                 </div>
                                 <div class="col">
                                    <h4 class="fs-15 mb-1 font-weight-bold text-dark">COMEDK UGET</h4>
                                    <p class="fs-13 mb-0 text-secondary"><strong class="text-primary"> Oct 1, 2020 - </strong>JEE advanced results 2020 to be declared on 05-10-2020 </p>
                                 </div>
                              </a>
                           </li>
                           <li class="pb-3 mb-3 border-bottom">
                              <a class="row mx-0" href="">
                                 <div class="col-auto px-0">
                                    <img class="img-fluid h-60px p-1 border rounded w-60px" src="{{ asset('public/website/') }}/assets/img/recent_exam.jpg" alt="{{ 'recent_exam.jpg' }}">
                                 </div>
                                 <div class="col">
                                    <h4 class="fs-15 mb-1 font-weight-bold text-dark">JEE Main - Exam, Result</h4>
                                    <p class="fs-13 mb-0 text-secondary"><strong class="text-primary"> Oct 1, 2020 - </strong>JEE advanced results 2020 to be declared on 05-10-2020 </p>
                                 </div>
                              </a>
                           </li>
                           <li class="pb-3 mb-3 border-bottom">
                              <a class="row mx-0" href="">
                                 <div class="col-auto px-0">
                                    <img class="img-fluid h-60px p-1 border rounded w-60px" src="{{ asset('public/website/') }}/assets/img/recent_exam.jpg" alt="{{ 'recent_exam.jpg' }}">
                                 </div>
                                 <div class="col">
                                    <h4 class="fs-15 mb-1 font-weight-bold text-dark">JEE Main - Exam, Result</h4>
                                    <p class="fs-13 mb-0 text-secondary"><strong class="text-primary"> Oct 1, 2020 - </strong>JEE advanced results 2020 to be declared on 05-10-2020 </p>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-12 mb-4">
                     @if( !empty( $header->advertisement('small') ) )
                     <a class="overflow-hidden d-block position-relative" href="{{
                        $header->advertisement('small')->url
                        }}" onclick="clickCounter('<?php echo $header->advertisement('small')->id ?>')" target="_blank">
                        <img class="img-fluid shadow rounded border" src="{{ asset('public/' . $header->advertisement('small')->image) }}" alt="{{ str_replace('advertisement/', '', $header->advertisement('small')->image) }}">
                        
                     </a>
                     @endif
                  </div>
               </div>
               <div class="row bg-white shadow rounded border mx-0 my-3">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">Blog Posts</h4>
                  </div>
                  <div class="col-md-12 col-12">
                     <ul class="blog_post_list pl-4">
                        @if( !empty($header->blogs($college->stream_id ?? '')) )
                        @foreach($header->blogs($college->stream_id ?? '') as $recent_blog)
                        <li class="border-bottom pb-2 mb-2">
                           <div class="d-flex justify-content-between">
                              @php
                              $slug = str_replace(' ', '-', $recent_blog->title);
                              @endphp
                              <a target="_blank" class="text-secondary fs-md-15 fs-14" href="{{ action('Website\BlogsController@blog', $slug) }}">{{$recent_blog->title}}</a>
                           </div>
                        </li>
                        @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
               <div class="row bg-white shadow rounded border mx-0 mt-4 mb-3">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">
                        @if( session()->has('student') )
                        Contact Information
                        @else
                        Login to get Contact Information
                        @endif
                     </h4>
                  </div>
                  <div class="col-md-12 px-0 col-12">
                     <div class="row justify-content-center">
                        @if( !empty($college->address) )
                        <div class="col-11 my-md-2 my-2 d-flex align-items-stretch justify-content-center">
                           <div class="exam_single_box my-2 shadow rounded row w-100">
                              <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                 <i class="far fa-map-marked"></i>
                              </div>
                              <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                 @if(session()->has('student'))
                                 <a class="fs-13 text-white" target="_blank" href="http://maps.google.co.in/maps?q={{ $college->address ?? '' }}">
                                    {{ $college->address ?? '' }}
                                 </a>
                                 @else
                                 <a class="fs-13 text-white" target="_blank" href="#">
                                    {{ substr($college->address ?? '', 0, 5) }}XXX
                                 </a>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @endif
                        @if( !empty($college->website) )
                        <div class="col-11 my-md-2 d-flex align-items-stretch justify-content-center">
                           <div class="exam_single_box my-2 shadow rounded row w-100">
                              <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                 <i class="fas fa-tv"></i>
                              </div>
                              <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                 @if(session()->has('student'))
                                 <a class="fs-13 text-white" target="_blank" href="{{ $college->website ?? '' }}">
                                    {{ $college->website ?? '' }}
                                 </a>
                                 @else
                                 <a class="fs-13 text-white" target="_blank" href="#">
                                    {{ substr($college->website ?? '', 0, 5) }}XXX
                                 </a>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @endif
                        @if( !empty($college->mobile) )
                        <div class="col-11 my-md-2 d-flex align-items-stretch justify-content-center">
                           <div class="exam_single_box my-2 shadow rounded row w-100">
                              <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                 <i class="fas fa-mobile-alt"></i>
                              </div>
                              <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                 @if(session()->has('student'))
                                 <a class="fs-13 text-white d-inline-block" target="_blank" href="tel:{{ $college->mobile ?? '' }}">
                                    {{ $college->mobile ?? '' }}
                                 </a>
                                 @else
                                 <a class="fs-13 text-white d-inline-block" target="_blank" href="#">
                                    {{ substr($college->mobile ?? '', 0, 5) }}XXX
                                 </a>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @endif
                        @if( !empty($college->email) )
                        <div class="col-11 my-md-2 d-flex align-items-stretch justify-content-center">
                           <div class="exam_single_box my-2 shadow rounded row w-100">
                              <div class="exam-ico bg-primary col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-24 py-2 px-4">
                                 <i class="fas fa-envelope-open"></i>
                              </div>
                              <div class="inner-text col py-2 bg-secondary h-100 d-grid rounded-right">
                                 @if(session()->has('student'))
                                 <a class="fs-13 text-white d-inline-block ellipsis-2" target="_blank" href="mailto:{{ $college->email ?? '' }}">
                                    {{ $college->email ?? '' }}
                                 </a>
                                 @else
                                 <a class="fs-13 text-white d-inline-block ellipsis-2" target="_blank" href="#">
                                    {{ substr($college->email ?? '', 0, 5) }}XXX
                                 </a>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @endif
                        <div class="col-11">
                           <ul class="blog_social_list d-flex justify-content-center list-unstyled pl-0 mt-3">
                              @if( !empty($college->twitter) )
                              <li class="mx-2">
                                 <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $college->twitter ?? '' }}">
                                    <i class="fab fa-twitter"></i>
                                 </a>
                              </li>
                              @endif
                              @if( !empty($college->facebook) )
                              <li class="mx-2">
                                 <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $college->facebook ?? '' }}">
                                    <i class="fab fa-facebook"></i>
                                 </a>
                              </li>
                              @endif
                              @if( !empty($college->instagram) )
                              <li class="mx-2">
                                 <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $college->instagram ?? '' }}">
                                    <i class="fab fa-instagram"></i>
                                 </a>
                              </li>
                              @endif
                              @if( !empty($college->youtube) )
                              <li class="mx-2">
                                 <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $college->youtube ?? '' }}">
                                    <i class="fab fa-youtube"></i>
                                 </a>
                              </li>
                              @endif
                              @if( !empty($college->linkedin) )
                              <li class="mx-2">
                                 <a class="d-flex align-items-center justify-content-center fs-18 h-45px w-45px rounded text-white" target="_blank" href="{{ $college->linkedin ?? '' }}">
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
         </div>
      </div>
   </div>
   <div class="container pb-md-5 pb-4">
      <div class="row mx-md-0 overflow-hidden">
         <div class="col-12 mt-md-3">
            @if( !empty( $header->advertisement('full') ) )
            <a class="overflow-hidden d-block position-relative" href="{{
               $header->advertisement('full')->url
               }}" onclick="clickCounter('<?php echo $header->advertisement('full')->id ?>')" target="_blank">
               <img class="img-fluid shadow rounded border" src="{{ asset('public/' . $header->advertisement('full')->image) }}" alt="{{ str_replace('advertisement/', '', $header->advertisement('full')->image) }}">
               
            </a>
            @endif
         </div>
      </div>
   </div>
</main>
<!-- reviews -->

<script>
   $(document).on('click', '.stars', function() {

      $('.stars').removeClass('text-warning');

      for (var i = 1; i <= $(this).data('id'); i++) {
         $('[data-id=' + i + ']').addClass('text-warning');
      }

      $('input[name="stars"]').attr('value', $(this).data('id'));
      $('input[name="stars"]').val($(this).data('id'));

   });
</script>



<script>
   function is_stars_selected() {
     
      return true;
   }
</script>
@include('website/layouts/footer')
<script>
   $(document).ready(function() {
      $("#toggle").click(function() {
         var elem = $("#toggle").text();
         if (elem == "Read More") {
            $("#toggle").text("Read Less");
         } else {
            $("#toggle").text("Read More");
         }

         $('.p_text').toggleClass('fixed_container');
      });
   });
</script>
<script>
   $('#add_to_favorite').click(
      function() {
         var is_favorite = $('#add_to_favorite').hasClass('btn-primary btn');

         $.ajax({
            url: '{{ action("Website\CollegeController@add_to_favorite", $college->id) }}',

            success: function(data) {
               if (data == 1) {

                  if (is_favorite) {
                     $('#add_to_favorite').removeClass('btn-primary btn');
                  } else {
                     $('#add_to_favorite').addClass('btn-primary btn');
                  }

               } else {
               }
            }
         });
      }
   );
</script>
<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle", function() {
         var elem = $(this).text();
         if (elem == "Read More") {
            $(this).text("Read Less");
         } else {
            $(this).text("Read More");
         }

         $(this).parent().parent().children('.p_text').toggleClass('fixed_container');
      });
   });
</script>
<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle1", function() {
         var elem = $(this).text();
         if (elem == "View More") {
            $(this).text("View Less");
         } else {
            $(this).text("View More");
         }

         $(this).parent().parent().children(':first-child').toggleClass('fixed_container1');
      });
   });
</script>
<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle2", function() {
         var elem = $(this).text();
         if (elem == "View More") {
            $(this).text("View Less");
         } else {
            $(this).text("View More");
         }

         $(this).parent().parent().children(':nth-child(2)').toggleClass('fixed_container2');
      });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
      $(".load_more_outer").slice(0, 3).show();
      var i = 1;
      $(".load-more12").on("click", function(e) {
         var ttlvideos = $('#total_videos').val();
         var ttlcount = Math.floor(ttlvideos / 3);
         e.preventDefault();
         $(".load_more_outer:hidden").slice(0, 3).slideDown();
         if ($(".load_more_outer:hidden").length == 0) {}
         if (ttlcount == i) {
            $('.seevideoss').hide();
         }
         i++;
      });
   });
</script>