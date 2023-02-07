@include('website/layouts/header')

<style>

img {
    max-width: 100%;
    height: auto !important;
}

.comment_image {
   width: 35px;
   height: 35px;
}
.setImageSize{
   width: 860px;
   height: 430px;
}
</style>

<main id="main">

   <section id="inner_banner" class="inner_banner">
      <div class="container position-relative z-index-2">
         <div class="text-left" data-aos="fade-right">
            <h2 class="font-weight-bold text-white fs-48">CoachingSelect Webinar</h2>
            <p class="text-white fs-18"></p>
         </div>
         <nav aria-label="breadcrumb text-left" data-aos="fade-right">
            <ol class="breadcrumb text-left mb-0 justify-content-start">
               <li class="breadcrumb-item fs-20">
                  <a 
                     class="text-white font-weight-bold" 
                     href="{{ action('Website\IndexController@index') }}">Home</a></li>
               <li class="breadcrumb-item fs-20 active text-white" aria-current="page">Webinar</li>
            </ol>
         </nav>
      </div>
   </section>
   <!-- Blog Single SECTION START  -->
   <section id="blog_single" class="blog_single">
      <div class="container">
         <div class="row align-items-start">
            <div class="col-md-8 col-12 py-3">
               <div class="row mx-n1 pb-3" data-aos="fade-right">
                  
               </div>
               <div class="blog_single_details">
                 <h1 class="font-weight-bold text-dark fs-34 text-justify" data-aos="fade-right">
                     {{$webinar->title}}
                  </h1>
                  <div class="border-bottom mb-0 mt-3 pb-2 mx-0 row align-items-center" data-aos="fade-right">
                     <p class="text-dark fs-16 col-6 pl-0 d-flex align-items-center mb-0 justify-content-start"> <span class=""><i class="far fa-calendar-alt mr-1"></i>
                        {{date('F d, Y', strtotime($webinar->date) )}}
                     </span></p>

                     <p class="text-dark fs-16 col-6 pl-0 d-flex align-items-center mb-0 justify-content-end"> <span class=""><i class="far fa-clock mr-1"></i>
                     {{date('h:i a', strtotime($webinar->time) )}} 
                     </span></p>
                  </div>
                  <div class="blog_content py-4 text-justify">
                        @php
                           echo $webinar->description;
                        @endphp
                  </div>
               </div>
            </div>
            <div class="col-md-4 position-md-sticky top-md-100px col-12 py-3">
               <div class="row mb-3">
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
                           alt=""
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
                           alt=""
                        >
                        </a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Blog Single SECTION START  -->
</main>

<script type="text/javascript">
   $('#story_image_main').addClass('setImageSize');
</script>
@include('website/layouts/footer')