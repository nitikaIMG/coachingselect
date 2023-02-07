@include('website/layouts/header')
<style type="text/css">
   .img_height{
      height: 225px;
   }
</style>
<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner">
      <div class="container position-relative z-index-2">
         <div class="text-left" data-aos="fade-right">
            <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">Your right exam search ends here..</h2>
            <p class="text-white fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-15 fs-14 mb-lg-3 mb-md-2 mb-2">List of Competitive Exams in India after 10th, 12th, Graduation</p>
         </div>
         <nav aria-label="breadcrumb text-left" data-aos="fade-right">
            <ol class="breadcrumb text-left mb-0 justify-content-start">
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14"><a class="text-white font-weight-bold " href="{{ action('Website\IndexController@index') }}">Home</a></li>
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14 active text-white" aria-current="page">Exams</li>
            </ol>
         </nav>
      </div>
   </section>
   <!-- inner banner section  -->
   <!-- Entrance exam section  -->
   <section id="entrance_exams" class="entrance_exams py-md-5 py-4 position-relative">
      <div class="container">
         <div class="row">
            <div class="col-12 mb-4">
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
                     class="img-fluid shadow rounded border img_height" 
                     src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                     alt="{{ basename( asset('public/' . $header->advertisement('full')->image)
                     ) }}"
                     
                  >
                  </a>
               @endif
            </div>

            @if( !empty($exams) )
               @foreach($exams as $stream => $exam)
                  <div class="col-lg-4 col-md-6 col-12 mb-md-4 mb-3 d-flex align-items-stretch justify-content-center" data-aos="fade-up">
                     <div class="exam_single_box shadow rounded row w-100">
                        <div class="exam-ico bg-primary col-md-4 col-3 justify-content-center rounded-left d-grid align-items-center h-100 fs-lg-50 fs-md-40 fs-32 py-md-4 py-3 px-md-4 px-3">
                           <?php echo $exam[0]->stream_image ?? ''; ?>
                        </div>
                        <div class="inner-text col py-3 bg-secondary h-100 d-grid rounded-right">
                           
                           @php
                              $stream_slug = str_replace(' ', '-', $stream);
                           @endphp

                           <a href="{{ action('Website\ExamsController@stream_wise_exams', $stream_slug) }}" class="font-weight-bold fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-15 fs-14 text-uppercase mb-lg-4 mb-md-3 mb-2 text-white">{{ $stream }}</a>
                           <p class="fs-xxl-14 fs-xl-14 fs-lg-13 fs-md-13 fs-12 mb-0 font-weight-600">
                              
                              @php
                                 $i = 1;
                                 $limit = 4;
                              @endphp

                              @foreach($exam as $course)
                                       
                                 @php
                                    $exam_name_slug = str_replace(' ', '-', $course->exam_name);
                                 @endphp
                                 
                                 <a class="text-white" href="{{ action('Website\ExamsController@exam', $exam_name_slug) }}">{{ $course->exam_name }} 
                                 
                                 |

                                 @php
                                    if($i == $limit) {
                                       break;
                                    }

                                    $i += 1;
                                 @endphp
                                 </a>
                              @endforeach

                              <a class="text-white text-nowrap" href="{{ action('Website\ExamsController@stream_wise_exams', $stream_slug) }}">ALL EXAMS <i class="fad fa-chevron-right"></i></a>
                           </p>
                        </div>
                     </div>
                  </div>
               @endforeach
            @endif
            <div class="col-12 mb-0">
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
                     class="img-fluid shadow rounded border img_height" 
                     src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                     alt="{{ basename( asset('public/' . $header->advertisement('full')->image
                        ) ) }}"
                     
                  >
                  </a>
               @endif
            </div>
         </div>
      </div>
   </section>
   <!-- Entrance exam section  -->
</main>
@include('website/layouts/footer')