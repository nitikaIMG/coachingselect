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

@media (max-width: 767px){

   .blog_content p span{
      font-size: 14px !important;
   } 
   .blog_content .Table{
      margin-left: 0px !important;
      width: 100% !important;
   }
   .blog_content .Table tr p span{
      font-size: 10px !important;
   }
   .blog_content p span span {
      font-size: 14px !important;
   } 
   .blog_content ul li span {
      font-size: 14px !important;
   } 
   .blog_content  a strong span{
      font-size: 20px;
   }
   .blog_content .Table tr td p{
      text-align: start !important;
   }
}
@media (max-width: 1023px){
   .blog_single {
      padding-top: 36px !important;
   }
   .blog_content p span{
      font-size: 16px !important;
   } 
   .blog_content .Table{
      margin-left: 0px !important;
      width: 100% !important;
   }
   .blog_content .Table tr p span{
      font-size: 12px !important;
   }
   .blog_content p span span {
      font-size: 14px !important;
   } 
   .blog_content ul li span {
      font-size: 14px !important;
   } 
   .blog_content  a strong span{
      font-size: 20px;
   }
   .blog_content .Table tr td p{
      text-align: start !important;
   }
}
</style>

<main id="main">

   <section id="inner_banner" class="inner_banner">
      <div class="container position-relative z-index-2">
         <div class="text-left" data-aos="fade-right">
            <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">CoachingSelect News</h2>
            <p class="text-white fs-18"></p>
         </div>
         <nav aria-label="breadcrumb text-left" data-aos="fade-right">
            <ol class="breadcrumb text-left mb-0 justify-content-start">
               <li class="breadcrumb-item fs-20">
                  <a 
                     class="text-white font-weight-bold" 
                     href="{{ action('Website\IndexController@index') }}">Home</a></li>
               <li class="breadcrumb-item fs-20 active text-white" aria-current="page">NEWS</li>
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
                 <h1 class="font-weight-bold text-dark font-weight-bold text-dark fs-xxl-34 fs-xl-34 fs-lg-34 fs-md-26 fs-22 text-justify" data-aos="fade-right">
                     {{$news->title}}
                  </h1>
                  <div class="border-bottom mb-0 mt-3 pb-2 mx-0 row align-items-center" data-aos="fade-right">
                     <p class="text-dark fs-xxl-16 fs-xl-16 fs-lg-16 fs-md-16 fs-12 col-5 pl-0 d-flex align-items-center mb-0 justify-content-start"> <span class=""><i class="far fa-calendar-alt mr-1"></i>
                        {{date('F d, Y', strtotime($news->created_at) )}}
                     </span></p>
                  </div>
                  <div class="blog_content py-4 text-justify">
                        @php
                           echo $news->description;
                        @endphp
                  </div>
               </div>
            </div>
            <div class="col-md-4 position-md-sticky top-md-100px col-12 py-3">
               <div class="row mb-3">
                  <div class="col-12 mb-4">
                     @php
                        $newsdata = $header->advertisement('small');
                     @endphp
                     @if( !empty( $newsdata ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $newsdata->url
                           }}"
                           target="_blank"
                           onclick="clickCounter('<?php echo $newsdata->id?>')"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $newsdata->image) }}"
                           alt=""
                        >
                        </a>
                     @endif
                  </div>
                  <div class="col-12 mb-4">
                     @php
                        $newsdata1 = $header->advertisement('small');
                        if($newsdata->id == $newsdata1->id){
                           $newsdata1 = $header->advertisement('small');
                        }
                     @endphp
                     @if( !empty( $newsdata1 ) )
                        <a 
                           class="overflow-hidden d-block position-relative" 
                           href="{{
                              $newsdata1->url
                           }}"
                           target="_blank"
                           onclick="clickCounter('<?php echo $newsdata1->id?>')"
                        >
                        <img 
                           class="img-fluid shadow rounded border" 
                           src="{{ asset('public/' . $newsdata1->image) }}"
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