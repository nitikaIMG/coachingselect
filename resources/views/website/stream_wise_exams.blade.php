@include('website/layouts/header')
<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner_2">
      <div class="container position-relative z-index-2">
         <div class="text-left" data-aos="fade-right">
            <h1 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">
            Top 
            {{$exams[0]->stream_name ?? ''}}  
            Exams in India</h1>
            <h2 class="text-white fs-xxl-18 fs-xl-18 fs-lg-16 fs-md-15 fs-14 mb-lg-3 mb-md-2 mb-2">
               Check & Apply Top 
               {{$exams[0]->stream_name ?? ''}}  
               Exam in India 
            </h2>
         </div>
         <nav aria-label="breadcrumb text-left" data-aos="fade-right">
            <ol class="breadcrumb text-left mb-0 justify-content-start">
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14"><a class="text-white font-weight-bold " href="{{ action('Website\IndexController@index') }}">Home</a></li>
               <li class="breadcrumb-item fs-xxl-20 fs-xl-20 fs-lg-18 fs-md-16 fs-14 active text-white" aria-current="page">Exam</li>
            </ol>
         </nav>
      </div>
   </section>
   <?php //echo '<pre>';print_r($header->advertisement('full'));die;?>
   <!-- inner banner section  -->
   <section id="exams_details" class="exams_details py-lg-5 pt-md-5 pt-5 pb-md-0 pb-0 overflow-unset">
      <div class="container">
         <div class="row align-items-start">
            <div class="col-lg-8 px-md-0">
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
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                           alt="{{ basename( asset('public/' . $header->advertisement('full')->image) ) }}"
                        >
                        </a>
                     @endif
                  </div>
                  @if( !empty($exams) )
                     
                     @php
                        $delay = 0;
                     @endphp

                     @foreach($exams as $exam)
                        @php
                           $exam_name_slug = str_replace(' ', '-', $exam->exam_name);
                        @endphp
                         @php
                           $image = asset('public/exams/'. $exam->image);

                           if(! @GetImageSize($image) ) {
                              $image = asset('public/logo.png');
                           }
                        @endphp
                        <div 
                           class="col-md-3 col-6 text-center mb-4 d-flex align-items-stretch aos-init aos-animate" 
                           data-aos="fade-up" 
                           data-aos-delay="{{ $delay }}">
                           <a href="{{ action('Website\ExamsController@exam', $exam_name_slug) }}" class="row mx-0 align-items-stretch exam_single_box w-100">
                              
                              <div class="col-md-12 shadow rounded d-flex align-items-center py-3 justify-content-center px-0 position-relative">
                                 <div class="text-center">
                                    <img class="img-fluid w-xxl-90px w-xl-90px w-lg-70px w-md-60px w-80px h-xxl-90px h-xl-90px h-lg-70px h-md-60px h-80px" 
                                    src="{{ $image }}" 
                                    alt="{{ basename($image) }}" 
                                    > 
                                    <h2 class="text-secondary fs-xxl-16 fs-xl-16 fs-lg-14 fs-md-14 fs-12 font-weight-bold text-uppercase mb-3 mt-3">
                                       {{ substr($exam->exam_name,0,15) }}
                                    </h2>
                                    <div class="text-center w-100">
                                       <button class="btn btn-sm btn-green border-0 rounded text-transform-none"><span>Explore Now</span></button>
                                    </div>
                                 </div>
                              </div>
                           </a>
                        </div>
                           
                        @php
                           $delay += 50;
                        @endphp
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
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $header->advertisement('full')->image) }}"
                           alt="{{ basename(asset('public/' . $header->advertisement('full')->image) ) }}"
                           
                        >
                        </a>
                     @endif
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-12 px-lg-3 px-md-0 position-sticky top-100px">
               <div class="row mb-lg-3 mt-lg-0 mt-md-4 mt-4">
                  <div class="col-12 mb-4">
                     @if( !empty( $header->advertisement('small') ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $header->advertisement('small')->url
                           }}"
                           target="_blank"
                           onclick="clickCounter('<?php echo $header->advertisement('small')->id?>')"
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
                           }}"
                           target="_blank"
                           onclick="clickCounter('<?php echo $header->advertisement('small')->id?>')"
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
   <section id="blog-section" class="blog-section py-lg-5 pt-md-3 pt-0 pb-md-5 pb-5 overflow-hidden">
      <div class="container px-md-0">
         <div class="row align-items-start justify-content-start">
            <div class="col-12" data-aos="fade-right">
               <h2 class="font-weight-bold fs-xxl-34 fs-xl-34 fs-lg-28 fs-md-22 fs-20 border-bottom pb-2 mb-0">Latest Reads</h2>
            </div>

            @if( !empty($blogs) )

            @php
            $i = 1;
            @endphp

            @foreach($blogs as $blog)

            @php
            $fade_class = '';

            if($i == 1) {
            $fade_class = "fade-right";
            } else if($i == 2) {
            $fade_class = "fade-up";
            } else {
            $fade_class = "fade-left";
            }
            @endphp

            <div class="col-lg-4 col-md-6 mb-0 mt-4 aos-init" data-aos="{{$fade_class}}">
               <div class="blog_box shadow pb-0 rounded">
                  @php
                  $slug = str_replace(' ', '-', $blog->title);
                  @endphp

                  <a 
                     target="_blank"
                     href="{{ action('Website\BlogsController@blog', $slug) }}">
                     <div class="basic-effect overflow-hidden position-relative">
                        <div class="shadow">
                           <img 
                           src="{{ asset('public/blogs/'.$blog->image) }}" 
                           alt="{{ basename( asset('public/blogs/'.$blog->image) ) }}" 
                           class="img-fluid rounded-top blog_image_min_height" 
                           >
                        </div>
                        <p class="position-absolute shadow bottom-10px mb-0 fs-13 left-10px d-flex align-items-center justify-content-center pl-2 h-25px rounded bg-secondary text-white z-index-2"> Like <span class="h-25px px-2 ml-2 rounded-right d-flex align-items-center border-white bg-white">{{$blog->likes}}</span>
                        </p>
                        <p class="position-absolute shadow mb-0 bottom-10px fs-13 right-10px d-flex align-items-center justify-content-center pl-2 h-25px rounded bg-secondary text-white z-index-2"> Views <span class="h-25px px-2 ml-2 rounded-right d-flex align-items-center border-white bg-white">{{$blog->views}}</span>
                        </p>
                     </div>
                     <div class="blog-details position-relative text-left p-3">
                        <p class="fs-md-15 fs-14 mb-2 font-weight-bold text-secondary text-capitalize title_min_height ellipsis-2">
                           @php echo strip_tags($blog->title);
                                       @endphp
                        </p>
                        <p class="text-secondary text-left fs-13 mb-3 ellipsis-3 description_min_height">
                           @php echo strip_tags($blog->description);
                                       @endphp
                        </p>
                        <h4 class="fs-md-13 fs-13 mb-0 text-dark font-weight-normal mt-0 d-flex align-items-center justify-content-between"><span class="ellipsis-1 w-40">{{ $blog->written_by ?? 'CoachingSelect' }}</span>
                           {{date('F d, Y', strtotime($blog->created_at) )}}
                        </h4>
                     </div>
                  </a>
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
   </section>
</main>
@include('website/layouts/footer')