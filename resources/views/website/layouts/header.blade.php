<!DOCTYPE html>
<html lang="en">
   <head>
      <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
      <meta http-equiv=Content-Type content="text/html; charset=utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
      <title>
         @if(!empty($metatitle))
         {{ $metatitle }}
         @else
         CoachingSelect
         @endif
      </title>
      <?php 
      if(!empty($metatitle)){
         $metatitle= $metatitle;
      }else{
         $metatitle= 'CoachingSelect';
      }
      if(!empty($metadescription)){
         $metadescription= $metadescription;
      }else{
         $metadescription= 'CoachingSelect';
      }
      if(!empty($metakeywords)){
         $metakeywords= $metakeywords;
      }else{
         $metakeywords= 'CoachingSelect';
      }
         ?>
      
      <?php
      /*
      <meta name=title content="{{ $metatitle }}" />
      */
      ?>

      <meta name=description content="{{ $metadescription }}" />
      <meta name=keywords content="{{ $metakeywords }}" />
      <meta name="msvalidate.01" content="" />
      <meta name="web-author" content="CoachingSelect" />
      <meta name="googlebot" content="all">
      <meta name="robots" content="index, follow" />
      <meta name="revisit-after" content="3 days">
      <meta name="copyright" content="CoachingSelect ">
      <meta name="language" content="English">
      <meta name="reply-to" content="">
      <meta name="classification" content="CoachingSelect" />
      <meta name="distribution" content="Global" />
      <meta name="rating" content="General" />
      <link rel="canonical" href="" />
      <meta name="facebook-domain-verification" content="776du3o6duuk71mtntvu6yqyds3lvm" />
      @hasSection('facebook_share')
      @yield('facebook_share')
      @else
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content="CoachingSelect" />
      <meta property="og:title" content="CoachingSelect" />
      <meta property="og:description" content="CoachingSelect" />
      <meta property="og:url" content="" />
      <meta property="og:site_name" content="CoachingSelect" />
      <meta property="og:image" content="{{ asset('public/website/assets/img/site_logo.png') }}" />
      @endif
      <script src="{{ asset('public/website/assets/vendor/jquery/jquery.min.js') }}"></script>
      
<script src="https://unpkg.com/smooth-scrollbar@latest/dist/smooth-scrollbar.js"></script>
      <link rel="icon" type="image/png" href="{{ asset('public/website/assets/img/favicon_icon.png') }}" sizes="192x192">
      <meta name="theme-color" content="#ee3a46" />
      <meta name="google-site-verification" content="" />
      <!-- Vendor CSS Files -->
      <link rel="stylesheet" href="{{ asset('public/test.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/bijarniadream/bijarniadream.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/color_style/color_style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/website/assets/vendor/vendors.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/website/assets/vendor/select2/bootstrap-select.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/website/assets/vendor/fast-select/fastselect.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/venobox/venobox.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/aos/aos.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/datepicker/css/bootstrap-datepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/css/sample.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/css/style-layouts.min.css') }}">
      {{-- <link rel="stylesheet" href="{{ asset('public/website/assets/css/style-home.min.css') }}"> --}}
      <link rel="stylesheet" href="{{ asset('public/website/assets/css/style.min.css') }}"> 
      <link rel="stylesheet" href="{{ asset('public/website/assets/css/responsive.min.css') }}">
      <!-- sweet alert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.6/dist/sweetalert2.all.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.6/dist/sweetalert2.css">
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
      
      <link rel="stylesheet" href="https://unpkg.com/smooth-scrollbar@latest/dist/smooth-scrollbar.css">
      <!-- Google Tag Manager -->
         <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','GTM-TBQTH7R');</script>
      <!-- End Google Tag Manager -->
<script>
   
   document.addEventListener("DOMContentLoaded", (function() {
       let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"))
         , active = !1;
       const lazyLoad = function() {
           !1 === active && (active = !0,
           setTimeout((function() {
               lazyImages.forEach((function(lazyImage) {
                   lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0 && "none" !== getComputedStyle(lazyImage).display && (lazyImage.src = lazyImage.dataset.src,
                   lazyImage.srcset = lazyImage.dataset.srcset,
                   lazyImage.classList.remove("lazy"),
                   lazyImages = lazyImages.filter((function(image) {
                       return image !== lazyImage
                   }
                   )),
                   0 === lazyImages.length && (document.removeEventListener("scroll", lazyLoad),
                   window.removeEventListener("resize", lazyLoad),
                   window.removeEventListener("orientationchange", lazyLoad)))
               }
               )),
               active = !1
           }
           ), 200))
       };
       document.addEventListener("scroll", lazyLoad),
       window.addEventListener("resize", lazyLoad),
       window.addEventListener("orientationchange", lazyLoad)
   }
   ));
$(document).ready(function() {
    window.scrollBy(0, 1)
});
</script>

      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script>
         // $.noConflict();
         // Code that uses other library's $ can follow here.
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
      <style>
         /* jquery validation error */
         .input-group .dropdown.bootstrap-select {
         display: grid;
         }
         .z-index-1000 {
         z-index: 100000 !important;
         }
         .title_min_height {
         min-height: 44px !important;
         /* text-align: justify !important; */
         /* word-break: break-all; */
         overflow-wrap: break-word;
         hyphens: auto;
         }
         .description_min_height {
         min-height: 60px !important;
         text-align: justify !important;
         }
         .title_dec {
         text-align: justify !important;
         }
         .blog_image_min_height5 {
         min-height: 220px !important;
         }
         /* .owl-item {
         min-height: 348px !important;
         } */
         .review_box_inner {
         min-height: 232px !important;
         }
         .review_box_inner > p:nth-child(3) {
         max-height: 120px !important;
         min-height: 120px !important;
         overflow: auto;
         }
         .college_image {         
         max-height: 211px !important;
         min-height: 211px !important;
         overflow: auto;
         }
         .blog_box .shadow img {
         height: 210px;
         width: 100%;
         object-fit: unset;
         }
         /* tooltip margin */
         .tooltip.top {
         padding: 25px 0;
         margin-top: 50px;
         }
         .tooltip-inner {
         text-align: left;
         padding: 10px;
         width: fit-content;
         font-size: 12px;
         max-width: 100% !important;
         }
         .custom_dropdown2 .bootstrap-select{
         width: 318px !important;
         }
         @media (max-width: 1023px) {
          .custom_dropdown2 .bootstrap-select {
             width: 100% !important;
          }
       }
      </style>
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/venbox-img/baguetteBox.min.css') }}">
      <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">
   </head>
   <body onbeforeunload="HandleBackFunctionality()">    
     <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBQTH7R" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
      <script type="text/javascript">
      </script>
      <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "CollegeOrUniversity",
        "name": "Coaching Select",
        "url": "https://www.coachingselect.com/",
        "logo": "https://www.coachingselect.com/public/website/assets/img/site_logo1.png",
        "sameAs": [
          "https://twitter.com/coaching_select",
          "https://www.instagram.com/coachingselect/",
          "https://www.youtube.com/channel/UC-oidnNJnMpKn9LdiTplnHQ",
          "https://www.linkedin.com/company/coachingselect/",
          "https://www.facebook.com/CoachingSelect-108903201456076/"
        ]
      }
</script>
      @include('website/layouts/website_theme')
      <!-- ======= Header ======= -->
      <div id="topbar" class="d-flex align-items-center fixed-top">
         <div class="container">
            <div class="row align-items-center justify-content-between">
               <div class="search-section col-lg-4 col">
                  <form 
                     action="{{ action('Website\CoachingSearchController@coaching_search') }}"
                     >
                     <div class="header-search position-relative">
                        <input 
                           type="text"
                           name="coaching_name" 
                           placeholder="Search your favourite coaching"
                           id="top_search"
                           value="{{ request()->get('coaching_name') ?? '' }}"
                           >
                        <input type="submit" value="">
                     </div>
                  </form>
               </div>
               <div class="col-auto px-0 top_bar_btn border-left-0 d-lg-block d-none">
                  <button 
                     onclick="window.location='{{ action('Website\BlogsController@blogs') }}'"
                     class="btn btn-sm btn-green border-0 rounded-pill fs-12"><span><i class="far fa-edit mr-1"></i></i>Blog</span></button>
               </div>
               <div class="col-auto qna_btn d-lg-block d-none">
                  <a 
                     href="{{ action('Website\StudentQuestionsAnswersController@student_questions') }}" class="justify-content-center align-items-center d-grid h-25px rounded-20 px-2 text-uppercase fs-13"><span><i class="fas fa-comments mr-1"></i>Q&A</span></a>
               </div>
               <div class="social-links d-flex justify-content-end align-items-center col-lg-6 col-md-auto col-auto text-right pl-lg-3 pl-md-0 pl-0">
                  <div class="d-lg-flex d-none">
                     <a target="_blank" href="https://twitter.com/coaching_select" class="twitter mx-1 justify-content-center align-items-center d-grid h-25px w-25px p-0"><i class="fab fa-twitter"></i></a>
                     <a target="_blank" href="https://www.facebook.com/CoachingSelect-108903201456076/" class="facebook mx-1 justify-content-center align-items-center d-grid h-25px w-25px p-0"><i class="fab fa-facebook"></i></a>
                     <a target="_blank" href="https://www.instagram.com/coachingselect/" class="instagram mx-1 justify-content-center align-items-center d-grid h-25px w-25px p-0"><i class="fab fa-instagram"></i></a>
                     <a target="_blank" href="https://www.youtube.com/channel/UC-oidnNJnMpKn9LdiTplnHQ" class="skype mx-1 justify-content-center align-items-center d-grid h-25px w-25px p-0"><i class="fab fa-youtube"></i></a>
                     <a target="_blank" href="https://www.linkedin.com/company/coachingselect/" class="linkedin mx-1 justify-content-center align-items-center d-grid h-25px w-25px p-0"><i class="fab fa-linkedin"></i></a>
                  </div>
                  @if(! session()->has('student') and ! session()->has('enterprise'))
                  <div class="top_bar_btn ml-lg-2">
                     <div class="row align-items-center mx-0">
                        <div class="col-auto px-1">
                           <a href="javascript:;" class=" justify-content-center align-items-center d-grid h-25px px-md-3 px-2 text-uppercase fs-md-13 fs-12" data-toggle="modal" data-target="#exampleModal1"><span>Login</span></a>
                        </div>
                        <div class="col-auto pr-1 pl-0">
                           <button class="btn btn-sm btn-green border-0 rounded-pill" data-toggle="modal" data-target="#exampleModal2"><span>Sign Up</span></button>
                        </div>
                     </div>
                  </div>
                  @elseif( session()->has('student'))
                  <div class="top_bar_profile ml-2">
                     <div class="dropdown shadow">
                        <a class="text-white text-decoration-none fs-14 d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                           <span class="d-lg-inline d-none bg-transparent me-3 ellipsis-1">
                           {{ session()->get('student')->name }}
                           <i class="far fa-angle-down ml-1"></i></span>
                           <div class="col-auto h-32px ml-md-3 d-grid align-items-center text-white text-decoration-none position-relative fs-22 px-0 me-md-4 me-2 top-n1px" header-profile="">
                              <img src="{{ session()->get('student')->image }}" class="h-32px w-32px rounded-pill" alt="{{ session()->get('student')->image }}" onerror="this.src='{{ asset('public/user.png') }}'">
                           </div>
                        </a>
                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuLink">
                           <li><a class="dropdown-item text-secondary py-3 fs-15 border-bottom" href="{{ action('Website\StudentProfileController@student_profile') }}"><i class="mr-2 fs-18 fas fa-user-circle"></i>Profile</a></li>
                           <form action="{{ action('Website\LoginController@logout') }}" method="post" id="logout_form">
                              @csrf
                           </form>
                           <li><a class="dropdown-item text-secondary py-3 fs-15" href="#" onclick="document.getElementById('logout_form').submit()"><i class="fad fa-sign-out-alt mr-2 fs-18"></i>Logout</a></li>
                        </ul>
                     </div>
                  </div>
                  @elseif(session()->has('enterprise'))
                  <div class="top_bar_profile ml-2">
                     <div class="dropdown shadow">
                        <a class="text-white text-decoration-none fs-14 d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                           <span class="d-lg-inline d-none bg-transparent me-3 ellipsis-1">
                           {{ session()->get('enterprise')->name }}
                           <i class="far fa-angle-down ml-1"></i></span>
                           <div class="rounded-pill col-auto h-32px ml-3 d-grid align-items-center text-white text-decoration-none position-relative fs-22 px-0 me-md-4 me-2 top-n1px bg-white" header-profile="">
                              @if( !empty( session()->get('enterprise')->image ) )
                              <img src="{{ asset('public/coaching/'. session()->get('enterprise')->image ?? '') }}" class="h-32px w-32px rounded-pill" alt="{{ session()->get('enterprise')->image ?? '' }}" 
                                 >
                              @else
                              <img src="{{ asset('public/logo.png') }}" class="h-32px w-32px rounded-pill" alt="logo.png" 
                                 >
                              @endif
                           </div>
                        </a>
                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuLink">
                           <li>
                              <a class="dropdown-item text-secondary py-3 fs-15 border-bottom" 
                                 href="{{ action('Website\EnterpriseController@index') }}">
                              <i class="fas fa-th"></i>
                              Dashboard
                              </a>
                           </li>
                           <li><a class="dropdown-item text-secondary py-3 fs-15 border-bottom" href="{{ action('Website\EnterpriseProfileController@enterprise_profile') }}"><i class="mr-2 fs-18 fas fa-user-circle"></i>Profile</a></li>
                           <form action="{{ action('Website\EnterpriseLoginController@logout') }}" method="post" id="logout_form">
                              @csrf
                           </form>
                           <li><a class="dropdown-item text-secondary py-3 fs-15" href="#" onclick="document.getElementById('logout_form').submit()"><i class="fad fa-sign-out-alt mr-2 fs-18"></i>Logout</a></li>
                        </ul>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <header id="header" class="fixed-top">
         <div class="container d-flex align-items-start">
            <div class="header_logo">
               <a href="{{ asset('/') }}" class="logo"><img src="{{ asset('public/website/assets/img/site_logo1.png') }}" alt="site_logo1.png" class="img-fluid">
               </a>
            </div>
            <div class="menu-bar d-xxl-none d-xl-none d-block">
               <a href="javascript:void(0)">
               <span class="first"></span>
               <span class="middle"></span>
               <span class="last"></span>
               </a>
            </div>
            <div class="row menu_mobile_btns d-lg-none d-md-flex d-flex position-absolute right-0 left-0 top-md-10px top-5px w-100 text-center justify-content-center pl-md-0 pl-5 ml-md-0 ml-2">
               <div class="col-auto btns_1 px-0">
                  <button 
                     onclick="window.location='{{ action('Website\BlogsController@blogs') }}'"
                     class="border-0 bg-primary text-white py-1 w-md-100 px-md-3 px-2 rounded-pill fs-md-12 fs-10 d-inline-block"><span><i class="far fa-edit mr-1"></i></i>Blog</span></button>
               </div>
               <div class="col-auto px-md-3 px-2 menu_mobile_btns_1">
                  <a 
                     href="{{ action('Website\StudentQuestionsAnswersController@student_questions') }}" class="border-0 bg-secondary text-white py-1 w-md-100 px-md-3 px-2 rounded-pill fs-md-12 fs-10 d-inline-block"><span><i class="fas fa-comments mr-1"></i>Q&A</span></a>
               </div>
            </div>
            <nav class="nav-menu w-100 d-xxl-flex d-xl-flex d-none align-items-center justify-content-end position-relative">
               <ul class="desktop_menu">
                  <li class="themes-nav">
                     <a href="#">Top Coaching
                     <i class="fas fa-chevron-down ml-2"></i>
                     </a>
                     <ul>
                        @if( !empty($header->coachings()) )
                        @php
                        $i = 1;
                        @endphp
                        @foreach($header->coachings() as $stream => $coachings)
                        @if($i <= 8)
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-wrap">{{$stream}}</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if( !empty($coachings) )
                              @php
                              $j = 1;
                              @endphp
                              @foreach($coachings as $coaching)
                              @if($j <= 8)
                              <li>
                                 <a 
                                    href="{{ action('Website\CoachingSearchController@coaching_search') }}?tab=all&exam={{$coaching->course_name}}" 
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">{{$coaching->course_name}}</p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $j += 1;
                              @endphp
                              @endforeach
                              @endif
                           </ul>
                        </li>
                        @endif
                        @php
                        $i += 1;
                        @endphp
                        @endforeach
                        @endif
                     </ul>
                  </li>
                  <li class="themes-nav">
                     <a href="#">Premium Colleges
                     <i class="fas fa-chevron-down ml-2"></i>
                     </a>
                     <ul>
                        @if( !empty($header->colleges()) )
                        @php
                        $i = 1;
                        @endphp
                        @foreach($header->colleges() as $stream => $colleges)
                        @if($i <= 8)
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-wrap">{{$stream}}</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if( !empty($colleges) )
                              @php
                              $j = 1;
                              @endphp
                              @foreach($colleges as $college)
                              @if($j <= 8)
                              <li>
                                 <a 
                                    href="{{ action('Website\CollegeController@colleges') }}?filters[streams][]={{$stream}}"
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">{{$college->course_name}}</p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $j += 1;
                              @endphp
                              @endforeach
                              @endif
                           </ul>
                        </li>
                        @endif
                        @php
                        $i += 1;
                        @endphp
                        @endforeach
                        @endif
                     </ul>
                  </li>
                  <li class="themes-nav">
                     <a href="#">
                     Exams
                     <i class="fas fa-chevron-down ml-2"></i>
                     </a>
                     <ul>
                        @if( !empty($header->exams()) )
                        @php
                        $i = 1;
                        @endphp
                        @foreach($header->exams() as $stream => $exams)
                        @if($i <= 8)
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-wrap">{{$stream}}</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if( !empty($exams) )
                              @php
                              $j = 1;
                              @endphp
                              @foreach($exams as $exam)
                              @if($j <= 8)
                              <li>
                                 @php
                                 $exam_slug = str_replace(' ', '-', $exam->title);
                                 @endphp
                                 <a 
                                    href="{{ action('Website\ExamsController@exam', $exam_slug) }}"
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">{{$exam->title}}</p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $j += 1;
                              @endphp
                              @endforeach
                              @endif
                           </ul>
                        </li>
                        @endif
                        @php
                        $i += 1;
                        @endphp
                        @endforeach
                        @endif
                     </ul>
                  </li>
                  <li class="themes-nav">
                     <a href="#">Study Material
                     <i class="fas fa-chevron-down ml-2"></i>
                     </a>
                     <ul>
                        @if( !empty($header->question_papers()) )
                        @php
                        $i = 1;
                        @endphp
                        @foreach($header->question_papers() as $stream => $question_papers)
                        @if($i <= 8)
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-wrap">{{$stream}}</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if( !empty($question_papers) )
                              @php
                              $j = 1;
                              @endphp
                              @foreach($question_papers as $question_paper)
                              @php
                              $stream_slug = str_replace(' ', '-', $stream);
                              @endphp
                              @if($j <= 8)
                              <li>
                                 <a 
                                    href="{{ action('Website\FreePreparationToolController@question_papers', $stream_slug) }}?course_id={{$question_paper->id}}"
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">{{$question_paper->course_name}}</p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $j += 1;
                              @endphp
                              @endforeach
                              @endif
                           </ul>
                        </li>
                        @endif
                        @php
                        $i += 1;
                        @endphp
                        @endforeach
                        @endif
                     </ul>
                  </li>
                  <li class="themes-nav">
                     <a href="#">
                     Executive Education <i class="fas fa-chevron-down ml-2"></i>
                     </a>
                     <ul>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-12 text-wrap">Top Colleges</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if( !empty($header->college_category()) )
                              @php
                              $i = 1;
                              @endphp
                              @foreach($header->college_category() as $category)
                              @if($i <= 8)
                              <li>
                                 <a 
                                    href="{{ action('Website\CollegeController@colleges') }}?filters[category][]={{$category->name}}"
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">{{$category->name}}</p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $i += 1;
                              @endphp
                              @endforeach
                              @endif
                           </ul>
                        </li>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-12 text-wrap">Courses</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if( !empty($header->executiveExecutionCourses()) )
                              @php
                              $i = 1;
                              @endphp
                              @foreach($header->executiveExecutionCourses() as $course)
                              @if($i <= 8)
                              <li>
                                 <a 
                                    href="{{ action('Website\CoachingSearchController@coaching_search') }}?tab=all&exam={{$course->name}}"
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">{{$course->name}}</p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $i += 1;
                              @endphp
                              @endforeach
                              @endif
                           </ul>
                        </li>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a href="javascripts:;" class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-12 text-wrap">Technology Partners</p>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-angle-right"></i>
                              </div>
                           </a>
                           <ul>
                              @if(!empty($header->technlogyPatners()))
                              @php
                              $i = 1;
                              @endphp
                              @foreach($header->technlogyPatners() as $technlogy)
                              @if($i <= 8)
                              <li>
                                 <a 
                                    href="{{ action('Website\CoachingController@overview', str_replace(' ', '-', $technlogy)) }}"
                                    class="row d-flex justify-content-between">
                                    <div class="col">
                                       <p class="mb-0 fs-13 text-wrap">
                                          {{ $technlogy }}
                                       </p>
                                    </div>
                                 </a>
                              </li>
                              @endif
                              @php
                              $i += 1;
                              @endphp 
                              @endforeach
                              @endif                     
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li class="themes-nav">
                     <a href="#">Counselling
                     <i class="fas fa-chevron-down ml-2"></i>
                     </a>
                     <ul>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a 
                              href="{{ action('Website\CounsellingController@career_counselling','type=Career after X') }}"
                              class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-center">
                                    Careers after Class X
                                 </p>
                              </div>
                           </a>
                        </li>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a 
                              href="{{ action('Website\CounsellingController@career_counselling','type=Career after XII') }}"
                              class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-center">
                                    Career after Class XII
                                 </p>
                              </div>
                           </a>
                        </li>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a 
                              href="{{ action('Website\CounsellingController@career_counselling','type=Career after graduation') }}"
                              class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-center">
                                    Career after Graduation
                                 </p>
                              </div>
                           </a>
                        </li>
                        <li class="themes-nav themes-nav_sub position-relative">
                           <a 
                              href="{{ action('Website\CounsellingController@career_counselling','type=Customize Counselling') }}"
                              class="row d-flex justify-content-between">
                              <div class="col">
                                 <p class="mb-0 fs-13 text-center">
                                    Customize Counselling
                                 </p>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </nav>
            <!-- .nav-menu -->
         </div> 
         <nav class="mobile_nav nav-menu position-relative d-xxl-none d-xl-none d-block">
            <div class="row menu_mobile_btns d-lg-none d-md-flex d-flex position-absolute left-20px top-10px w-100 mx-0 text-center justify-content-start">
               <div class="col-auto btns_1">
                  <button 
                     onclick="window.location='{{ action('Website\BlogsController@blogs') }}'"
                     class="border-0 bg-primary text-white py-1 w-md-100 px-md-3 px-2 rounded-pill fs-md-12 fs-10 d-inline-block"><span><i class="far fa-edit mr-1"></i></i>Blog</span></button>
               </div>
               <div class="col-auto px-md-3 px-2 menu_mobile_btns_1">
                  <a 
                     href="{{ action('Website\StudentQuestionsAnswersController@student_questions') }}" class="border-0 bg-secondary text-white py-1 w-md-100 px-md-3 px-2 rounded-pill fs-md-12 fs-10 d-inline-block"><span><i class="fas fa-comments mr-1"></i>Q&A</span></a>
               </div>
            </div>
            <div class="mobile_menuss_only">
               <div class="accordion" id="accordionExample">
                  <div class="card border-0 px-3">
                     <div class="card-header border-0" id="headingOne">
                        <h2 class="mb-0">
                           <button class="btn btn-link btn-block text-left menuss_1_design" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           Top Coaching
                           <i class="fas fa-chevron-down ml-md-2"></i>
                           </button>
                        </h2>
                     </div>
                     <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="outer_inner_submenu">
                           <div class="accordion" id="accordionExample_submenus">
                              @if( !empty($header->coachings()) )
                                 @php
                                 $i = 1;
                                 @endphp
                                 @foreach($header->coachings() as $stream => $coachings)

                                 @if($i <= 8)
                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenus{{ $i }}">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus{{ $i }}" aria-expanded="true" aria-controls="collapsesubmenus{{ $i }}">
                                       {{$stream}}
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus{{ $i }}" class="collapse" aria-labelledby="headingsubmenus{{ $i }}" data-parent="#accordionExample_submenus">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">
                                          @if( !empty($coachings) )
                                          @php
                                          $j = 1;
                                          @endphp
                                          @foreach($coachings as $coaching)
                                          @if($j <= 8)
                                             <li><a href="{{ action('Website\CoachingSearchController@coaching_search') }}?tab=all&exam={{$coaching->course_name}}">{{$coaching->course_name}}</a></li>
                                          @endif
                                          @php
                                          $j += 1;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              @endif
                              @php
                              $i += 1;
                              @endphp
                              @endforeach
                              @endif
                           </div>
                        </div>
                     </div>
                  </div> 
                  <div class="card border-0 px-3">
                     <div class="card-header border-0" id="headingtwo">
                        <h2 class="mb-0">
                           <button class="btn btn-link btn-block text-left menuss_1_design" type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                           Premium Colleges
                           <i class="fas fa-chevron-down ml-md-2"></i>
                           </button>
                        </h2>
                     </div>
                     <div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample">
                        <div class="outer_inner_submenu">
                           <div class="accordion" id="accordionExample_submenus1">
                               @if( !empty($header->colleges()) )
                              @php
                              $i = 1;
                              @endphp
                              @foreach($header->colleges() as $stream => $colleges)
                              @if($i <= 8)
                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenus1{{$i}}">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus1{{$i}}" aria-expanded="true" aria-controls="collapsesubmenus{{$i}}">
                                       {{$stream}}
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus1{{$i}}" class="collapse" aria-labelledby="headingsubmenus1{{$i}}" data-parent="#accordionExample_submenus1">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">
                                          @if( !empty($colleges) )
                                          @php
                                          $j = 1;
                                          @endphp
                                          @foreach($colleges as $college)
                                          @if($j <= 8)
                                          <li><a href="{{ action('Website\CollegeController@colleges') }}?filters[streams][]={{$stream}}">{{$college->course_name}}</a></li>
                                           @endif
                                          @php
                                          $j += 1;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              @endif   
                              @php
                              $i += 1;
                              @endphp
                              @endforeach
                              @endif

                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card border-0 px-3">
                     <div class="card-header border-0" id="headingthree">
                        <h2 class="mb-0">
                           <button class="btn btn-link btn-block text-left menuss_1_design" type="button" data-toggle="collapse" data-target="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
                           Exams
                           <i class="fas fa-chevron-down ml-md-2"></i>
                           </button>
                        </h2>
                     </div>
                     <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample">
                        <div class="outer_inner_submenu">
                           <div class="accordion" id="accordionExample_submenus2">
                              @if( !empty($header->exams()) )
                              @php
                              $i = 1;
                              @endphp
                              @foreach($header->exams() as $stream => $exams)
                              @if($i <= 8)
                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenusi">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus{{$i}}" aria-expanded="true" aria-controls="collapsesubmenus{{$i}}">
                                       {{$stream}}
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus{{$i}}" class="collapse" aria-labelledby="headingsubmenus{{$i}}" data-parent="#accordionExample_submenus2">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">
                                          @if( !empty($exams) )
                                          @php
                                          $j = 1;
                                          @endphp
                                          @foreach($exams as $exam)
                                          @if($j <= 8)
                                          @php
                                             $exam_slug = str_replace(' ', '-', $exam->title);
                                          @endphp
                                             <li><a href="{{ action('Website\ExamsController@exam', $exam_slug) }}">{{$exam->title}}</a></li>
                                          @endif
                                          @php
                                          $j += 1;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           @endif
                           @php
                           $i += 1;
                           @endphp
                           @endforeach
                           @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card border-0 px-3">
                     <div class="card-header border-0" id="headingfour">
                        <h2 class="mb-0">
                           <button class="btn btn-link btn-block text-left menuss_1_design" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                           Study Material
                           <i class="fas fa-chevron-down ml-md-2"></i>
                           </button>
                        </h2>
                     </div>
                     <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
                        <div class="outer_inner_submenu">
                           <div class="accordion" id="accordionExample_submenus3">
                              @if( !empty($header->question_papers()) )
                              @php
                              $i = 1;
                              @endphp
                              @foreach($header->question_papers() as $stream => $question_papers)
                              @if($i <= 8)

                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenus{{$i}}">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus{{$i}}" aria-expanded="true" aria-controls="collapsesubmenus{{$i}}">
                                       {{$stream}}
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus{{$i}}" class="collapse" aria-labelledby="headingsubmenus{{$i}}" data-parent="#accordionExample_submenus3">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">
                                          @if( !empty($question_papers) )
                                          @php
                                          $j = 1;
                                          @endphp
                                          @foreach($question_papers as $question_paper)
                                          @php
                                          $stream_slug = str_replace(' ', '-', $stream);
                                          @endphp
                                          @if($j <= 8)
                                          <li><a href="{{ action('Website\FreePreparationToolController@question_papers', $stream_slug) }}?course_id={{$question_paper->id}}">{{$question_paper->course_name}}</a></li>
                                           @endif
                                          @php
                                          $j += 1;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              @endif
                              @php
                              $i += 1;
                              @endphp
                              @endforeach
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card border-0 px-3">
                     <div class="card-header border-0" id="headingfive">
                        <h2 class="mb-0">
                           <button class="btn btn-link btn-block text-left menuss_1_design" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                           Executive Education
                           <i class="fas fa-chevron-down ml-md-2"></i>
                           </button>
                        </h2>
                     </div>
                     <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
                        <div class="outer_inner_submenu">
                           <div class="accordion" id="accordionExample_submenus5"> 


                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenus27">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus27" aria-expanded="true" aria-controls="collapsesubmenus27">
                                       Top Colleges
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus27" class="collapse" aria-labelledby="headingsubmenus27" data-parent="#accordionExample_submenus5">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">
                                          @if( !empty($header->college_category()) )
                                          @php
                                          $i = 1;
                                          @endphp
                                          @foreach($header->college_category() as $category)
                                          @if($i <= 8)
                                          <li><a href="{{ action('Website\CollegeController@colleges') }}?filters[category][]={{$category->name}}">{{$category->name}}</a></li>
                                          @endif
                                          @php
                                          $i += 1;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>


                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenus28">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus28" aria-expanded="true" aria-controls="collapsesubmenus28">
                                       Courses
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus28" class="collapse" aria-labelledby="headingsubmenus28" data-parent="#accordionExample_submenus5">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">

                                          @if( !empty($header->executiveExecutionCourses()) )
                                          @php
                                          $i = 1;
                                          @endphp
                                          @foreach($header->executiveExecutionCourses() as $course)
                                          @if($i <= 8)
                                          <li><a href="{{ action('Website\CoachingSearchController@coaching_search') }}?tab=all&exam={{$course->name}}">{{$course->name}}</a></li>
                                          @endif
                                          @php
                                          $i += 1;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                              </div>

                              <div class="card border-0">
                                 <div class="card-header border-0" id="headingsubmenus29">
                                    <h2 class="mb-0">
                                       <button class="btn btn-link btn-block text-left submenuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesubmenus29" aria-expanded="true" aria-controls="collapsesubmenus29">
                                       Technology Partners
                                       <i class="fas fa-chevron-down ml-md-2"></i>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapsesubmenus29" class="collapse" aria-labelledby="headingsubmenus29" data-parent="#accordionExample_submenus5">
                                    <div class="card-body p-2">
                                       <ul class="menus_links111 bg-white rounded-5">
                                          @if(!empty($header->technlogyPatners()))
                                          @php
                                          $i = 1;
                                          @endphp
                                          @foreach($header->technlogyPatners() as $technlogy)
                                          @if($i <= 8)
                                          <li><a href="{{ action('Website\CoachingController@overview', str_replace(' ', '-', $technlogy)) }}"> {{ $technlogy }}</a></li>
                                          @endif
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
                        </div>
                     </div>
                  </div>
                  <div class="card border-0 px-3">
                     <div class="card-header border-0" id="headingsix">
                        <h2 class="mb-0">
                           <button class="btn btn-link btn-block text-left menuss_1_design" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                           Counselling
                           <i class="fas fa-chevron-down ml-md-2"></i>
                           </button>
                        </h2>
                     </div>
                     <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="outer_inner_submenu">
                              <ul class="menus_links111 bg-white rounded-5">

                                    <li><a href="{{ action('Website\CounsellingController@career_counselling','type=Career after X') }}">Careers after Class X</a></li>
                                    <li><a href="{{ action('Website\CounsellingController@career_counselling','type=Career after XII') }}">Career after Class XII</a></li>
                                    <li><a href="{{ action('Website\CounsellingController@career_counselling','type=Career after graduation') }}">Career after Graduation</a></li>
                                    <li><a href="{{ action('Website\CounsellingController@career_counselling','type=Customize Counselling') }}">Customize Counselling</a></li>
                              </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div> 
         </nav>
      </header>
      <div class="position-fixed top-15px right-15px z-index-1000 d-none" id="toast_notification">
         <div role="alert" aria-live="assertive" aria-atomic="true" class="toast ml-auto" style="width:100vw;" data-delay="2000" id="toast_msg">
            <div class="toast-header text-white" id="toast_bg">
               <strong class="mr-auto">Alert</strong>
               <small>Just Now</small>
               <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
               <span aria-hidden="true" class="text-white">&times;</span>
               </button>
            </div>
            <div class="toast-body">
            </div>
         </div>
      </div>
      <!-- End Header -->
      <div class="modal comman_modal_popup fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="login_tabs">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <a class="nav-link active" id="student_login-tab" data-toggle="tab" href="#student_login" role="tab" aria-controls="login" aria-selected="true">Student Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link" id="login-2-tab" data-toggle="tab" href="#login-2" role="tab" aria-controls="login-2" aria-selected="false">Enterprise Login</a>
                        </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="student_login" role="tabpanel" aria-labelledby="student_login-tab">
                           <div class="card col-md-12 border-0 mb-0">
                              <div class="card-body py-md-4 pt-3 pb-3 px-sm-4">
                                 <div>
                                    <div class="mb-5 text-center d-none">
                                       <h6 class="h3 mb-1">Student Login</h6>
                                       <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                    </div>
                                    <span class="clearfix"></span>
                                    <form id="login" method="post" class="row mt-4" autocomplete="FALSE">
                                       @csrf
                                       <input type="hidden" name="callback">
                                       <div class="form-group col-12">
                                          <label class="form-control-label">
                                          Mobile Number / Email
                                          </label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-user"></i>
                                                </span>
                                             </div>
                                             <input type="text" name="email" 
                                                class="student_enter_email_mobile form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="login-input-email" placeholder="name@example.com" required>
                                             <div class="input-group-prepend student_enter_box d-none">
                                                <button type="button" class="search_btn border-0 btn btn-sm fs-md-14 fs-12 btn-green border-0 rounded-right"> <span class="d-flex align-items-center student_enter_box_btn">Get OTP</span></button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-12 mb-0 student_password_box">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                <label class="form-control-label">Password</label>
                                             </div>
                                          </div>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-key"></i>
                                                </span>
                                             </div>
                                             <input type="password" name="password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="login-input-password" placeholder="Password" required>
                                          </div>
                                          <div class="row mt-2 align-items-center justify-content-between">
                                             <div class="col-12 text-right">
                                                <a class="text-decoration-none fs-md-15 fs-14" href="javascript:;" data-toggle="modal" data-target="#forgot-password" data-dismiss="modal">Forgot Password?</a>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-12 mb-0 student_otp_box d-none">
                                          <div class="d-flex align-items-center justify-contenEnter t-between">
                                             <div>
                                                <label class="form-control-label">Enter OTP</label>
                                             </div>
                                          </div>
                                          <div class="digit-group row">
                                             <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" type="text" id="digit-1" data-next="digit-2" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             </div>
                                       </div>
                                       <div class="mt-4 col-12">
                                          <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return login()">Sign in</button>
                                          <!-- <button type="submit" id="createacc" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px">Sign in</button> -->
                                       </div>
                                    </form>
                                    <div class="py-md-3 py-2 text-center">
                                       <span class="text-xs text-uppercase fs-md-15 fs-14">or</span>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <a href="{{ action('Website\SocialLoginController@redirect', 'facebook') }}" class="btn w-100 d-flex align-items-center btn-sm btn-outline-light border btn-sm btn-icon mb-md-3 mb-2 justify-content-center">
                                          <span class="btn-sm btn-inner--icon mr-md-2">
                                          <img src="{{ asset('public/website/assets/img/facebook.png') }}" class="h-md-35px" alt="facebook.png">
                                          </span>
                                          <span class="btn-sm btn-inner--text">Facebook</span>
                                          </a>
                                       </div>
                                       <div class="col-sm-6">
                                          <a 
                                             href="{{ action('Website\SocialLoginController@redirect', 'google') }}" class="btn w-100 d-flex align-items-center btn-sm btn-outline-light border btn-sm btn-icon justify-content-center">
                                          <span class="btn-sm btn-inner--icon mr-md-2">
                                          <img src="{{ asset('public/website/assets/img/google.svg') }}" alt="google.svg">
                                          </span>
                                          <span class="btn-sm btn-inner--text">Google</span>
                                          </a>
                                       </div>
                                    </div>
                                    <div class="mt-md-4 mt-3 text-center">
                                       <small>Not Registered?</small>
                                       <a href="javascript:;" data-toggle="modal" data-target="#exampleModal2" data-dismiss="modal" class="small font-weight-bold fs-16">Create Account</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="login-2" role="tabpanel" aria-labelledby="profile-tab">
                           <div class="card col-md-12 border-0 mb-0">
                              <div class="card-body py-md-4 pt-3 pb-3 px-sm-4">
                                 <div>
                                    <div class="mb-5 text-center d-none">
                                       <h6 class="h3 mb-1">Enterprise Login</h6>
                                       <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                    </div>
                                    <span class="clearfix"></span>
                                    <form id="enterprise_login" method="post" class="row mt-4" autocomplete="FALSE">
                                       @csrf
                                       <div class="form-group col-12">
                                          <label class="form-control-label">Mobile Number / Email</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-user"></i>
                                                </span>
                                             </div>
                                             <input 
                                                type="text" 
                                                placeholder="name@example.com" 
                                                required=""
                                                name="email"
                                                id="enterprise_email"
                                                class="enterprise_enter_email_mobile form-control shadow-none h-md-50px h-40px fs-md-15 fs-14"
                                                />
                                             <div class="input-group-prepend enterprise_enter_box d-none">
                                                <button type="button" class="search_btn border-0 btn btn-sm fs-md-14 fs-12 btn-green border-0 rounded-right"> <span class="d-flex align-items-center enterprise_enter_box_btn">Get OTP</span></button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-12 mb-0 enterprise_password_box">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                <label class="form-control-label">Password</label>
                                             </div>
                                          </div>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-key"></i>
                                                </span>
                                             </div>
                                             <input                                              
                                                id="enterprise_password" 
                                                type="password" 
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14"
                                                name="password" 
                                                placeholder="Password"
                                                required
                                                />
                                          </div>
                                          <div class="row mt-2 align-items-center justify-content-between">
                                             <div class="col-12 text-right">
                                                <a class="text-decoration-none fs-md-15 fs-14" href="javascript:;" data-toggle="modal" data-target="#enterprise_forgot-password" data-backdrop="static" data-keyboard="false" data-dismiss="modal">Forgot Password?</a>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-12 mb-0 enterprise_otp_box d-none">
                                          <div class="d-flex align-items-center justify-contenEnter t-between">
                                             <div>
                                                <label class="form-control-label">Enter OTP</label>
                                             </div>
                                          </div>
                                          <div class="digit-group row">
                                             <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" type="text" id="digit-1" data-next="digit-2" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             {{--<input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-5" data-next="digit-6" data-previous="digit-4" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >
                                             <input class="inputs col px-0 text-center mr-3 ml-1 h-50px form-control shadow-none" type="text" id="digit-6" data-previous="digit-5" 
                                                name="otp[]"
                                                maxlength="1" autocomplete="off" >--}}
                                          </div>
                                       </div>
                                       <div class="mt-4 col-12">
                                          <button 
                                             onclick="return enterprise_login(this)" 
                                             class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid">Sign in</button>
                                       </div>
                                    </form>
                                    <div class="py-md-3 py-2 text-center">
                                       <span class="text-xs text-uppercase fs-md-15 fs-14">or</span>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <a href="{{ action('Website\EnterpriseSocialLoginController@redirect', 'facebook') }}" class="btn w-100 d-flex align-items-center btn-sm btn-outline-light border btn-sm btn-icon mb-md-3 mb-2 justify-content-center">
                                          <span class="btn-inner--icon mr-2">
                                          <img src="{{ asset('public/website/') }}/assets/img/facebook.png" class="h-md-35px" alt="facebook.png">
                                          </span>
                                          <span class="btn-inner--text">Facebook</span>
                                          </a>
                                       </div>
                                       <div class="col-sm-6">
                                          <a 
                                             href="{{ action('Website\EnterpriseSocialLoginController@redirect', 'google') }}"  class="btn w-100 d-flex align-items-center btn-outline-light border btn-icon justify-content-center btn-sm">
                                          <span class="btn-inner--icon mr-2">
                                          <img src="{{ asset('public/website/') }}/assets/img/google.svg" alt="google.svg">
                                          </span>
                                          <span class="btn-inner--text">Google</span>
                                          </a>
                                       </div>
                                    </div>
                                    <div class="mt-md-4 mt-3 text-center">
                                       <small>Not Registered?</small>
                                       <a href="javascript:;" data-toggle="modal" data-target="#exampleModal2" data-backdrop="static" data-keyboard="false" data-dismiss="modal" class="small font-weight-bold fs-16">Create Account</a>
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
      <div class="modal comman_modal_popup fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-md-5 mb-4 mt-md-0 mt-4 text-center">
                              <h6 class="h3 mb-1 fs-md-28 fs-22">Forgot Password</h6>
                              <p class="text-muted mb-0 fs-md-16 fs-14">Sign in to your account to continue.</p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="forgot" method="post" class="row" autocomplete="FALSE" onsubmit="return false;">
                              @csrf
                              <div class="form-group col-12">
                                 <label class="form-control-label">Mobile Number</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-mobile"></i>
                                       </span>
                                    </div>
                                    <input name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="forgot-input-mobile" placeholder="9800000000" required onkeypress="return isNumberKey(event)" 
                                       pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid mobile number" minlength="10" maxlength="10" name="mobile" type="tel">
                                 </div>
                              </div>
                              <div class="mt-4 col-12">
                                 <butto type="submit" href="javascript:;" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return forgot()">
                                 Get OTP</a>
                                 </div>
                           </form>
                           <div class="mt-md-4 mt-3 text-center">
                              <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" data-dismiss="modal" class="small font-weight-bold">Back to login</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-4 text-center">
                              <h6 class="h3 mb-1">Reset Password</h6>
                              <p class="text-muted mb-0">OTP sent to your mobile number..</p>
                              <p class="text-muted mb-0 font-weight-bold" id="mobile_display"></p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="resetPassword" method="post" class="row" autocomplete="off" autofill="off">
                              @csrf
                              <input type="hidden" name="mobile" id="forgot-mobile">
                              <div class="form-group col-12" id="reset_password_otp_box">
                                 <label class=form-control-label>OTP</label>
                                 <div class="digit-group row">
                                    <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" name="forgot-otp[1]" type="text" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[2]" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[3]" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[4]" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" >
                                 </div>
                                 <a href="javascript:;" onclick="document.getElementById('resetPassword').reset(); return resend_otp(document.getElementById('forgot-mobile').value, 'forgot', 'student');" class="small font-weight-bold">Resend OTP</a>
                              </div>
                              <div class="form-group col-12 d-none" id="reset_password_password_box">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                       <label class="form-control-label">Password</label>
                                    </div>
                                 </div>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-key"></i>
                                       </span>
                                    </div>
                                    <input type="password" name="password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="reset_password" placeholder="Password" value="" required>
                                 </div>
                                 <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                                    <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-md-12 fs-10" style="
                                       /* right: 19px; */
                                       "></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="form-group col-12 mb-0 d-none" id="reset_password_confirm_password_box">
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
                                    <input type="password" name="reset_confirm_password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="reset-confirm-password" placeholder="Password" required>
                                 </div>
                                 <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                                    <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-md-12 fs-10" style="
                                       /* right: 19px; */
                                       "></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="mt-4 col-12">
                                 <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" data-iid="1" onclick="return resetPassword()" id="reset_password_submit_btn">Verify Otp</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-4 text-center">
                              <h6 class="h3 mb-1">Change Password</h6>
                              <p class="text-muted mb-0">OTP is sent on your mail id.</p>
                              <p class="text-muted mb-0 font-weight-bold" id="email_display"></p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="change" method="post" class="row" autocomplete="off">
                              @csrf
                              <input type="hidden" name="email" id="forgot-email">
                              <div class="form-group col-12" id="change_password_otp_box">
                                 <label class=form-control-label>OTP</label>
                                 <div class="digit-group row">
                                    <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" name="forgot-otp[1]" type="text" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[2]" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[3]" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[4]" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" >
                                 </div>
                              </div>
                              <div class="form-group col-12 d-none" id="change_password_password_box">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                       <label class="form-control-label">Password</label>
                                    </div>
                                 </div>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-key"></i>
                                       </span>
                                    </div>
                                    <input type="password" name="password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="password" placeholder="Password" required>
                                 </div>
                                 <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                                    <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-md-12 fs-10" style="
                                       /* right: 19px; */
                                       "></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="form-group col-12 mb-0 d-none" id="change_password_confirm_password_box">
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
                                    <input type="password" name="confirm_password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="confirm-password" placeholder="Password" required>
                                 </div>
                                 <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                                    <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                    <span class="fa fa-info text-dark fs-md-12 fs-10" style="
                                       /* right: 19px; */
                                       "></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="mt-4 col-12">
                                 <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return change()" id="change_password_submit_btn">Verify Otp</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="col-xxl-5 col-xl-5 bg-secondary d-xxl-block d-xl-block d-none p-0">
                     <div class="logo text-center w-100 pt-3 bg bg-white pb-3"><img alt="site_logo1.png" class="h-60px bg bg-white" src="{{ asset('public/website/assets/img/site_logo1.png') }}"></div>
                     <ul class="fs-xxl-18 fs-xl-16 fs-lg-16 fs-md-15 fs-14 mt-4">
                        <li>Gateway to Best Coaching for exam preparation</li>
                        <li>Compare Tutor & Online/Classroom Coachings</li>
                        <li>Exam Updates & its Notifications</li>
                        <li>Ace your prep with previous year Papers & Mock Tests with answers </li>
                        <li>Question & Answer from experts & other users</li>
                        <li>Online Career Counselling Which helps Discover Your Perfect Career</li>
                        <li>The Ultimate Guide to the College Search</li>
                     </ul>
                  </div>
                  <div class="card shadow-lg col-xxl-7 col-xl-7 border-0 mb-0">
                     <div class="login_tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="register2-tab" data-toggle="tab" href="#register2" role="tab" aria-controls="register" aria-selected="true">Student Register</a>
                           </li>
                           <li class="nav-item" role="presentation">
                              <a class="nav-link" id="register1-tab" data-toggle="tab" href="#register1" role="tab" aria-controls="register1" aria-selected="false">Enterprise Register</a>
                           </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade show active" id="register2" role="tabpanel" aria-labelledby="register-tab">
                              <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                                 <div>
                                    <div class="mb-5 text-center d-none">
                                       <h6 class="h3 mb-1">Create your account</h6>
                                       <p class="text-muted mb-0">Made with love for designers &amp; developers.</p>
                                    </div>
                                    <span class="clearfix"></span>
                                    <form id="tempregister" method="post" class="row" autocomplete="off">
                                       @csrf
                                       <div class="form-group col-lg-6 col-12">
                                          <label class="form-control-label">Name</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-user"></i>
                                                </span>
                                             </div>
                                             <input type="text" name="name" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="tempregister-input-name" placeholder="Name*" required autocomplete="off">
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6 col-12">
                                          <label class="form-control-label">Email</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-at"></i>
                                                </span>
                                             </div>
                                             <input type="email" name="email" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="tempregister-input-email" placeholder="Email*" required autocomplete="off">
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6 col-12">
                                          <label class="form-control-label">Mobile Number</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-mobile"></i>
                                                </span>
                                             </div>
                                             <input name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="tempregister-input-mobile" placeholder="Mobile*" required onkeypress="return isNumberKey(event)" 
                                                pattern="[6-9]{1}[0-9]{9}" minlength="10" maxlength="10" name="mobile" type="text" autocomplete="off"
                                                title="Please enter valid mobile number">
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6 col-12 mb-0">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                <label class="form-control-label">Create Password</label>
                                             </div>
                                          </div>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-key"></i>
                                                </span>
                                             </div>
                                             <input type="password" name="password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="tempregister-input-password" placeholder="Create Password" required autocomplete="off">
                                          </div>
                                          <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                            Min. of 6 characters <br/>
                                            {{-- 2) Must include letters and numbers <br> --}}
                                            ">
                                             <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                             <span class="fa fa-info text-dark fs-md-12 fs-10" style="
                                                /* right: 19px; */
                                                "></span>
                                             </span>
                                          </div>
                                       </div>
                                       <div class="form-group col-12 mb-0 d-none">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                <label class="form-control-label">
                                                <label class="fs-16 text-danger">
                                                </label>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="mt-lg-2 mt-md-4 mt-4 col-12">
                                          <div class="custom-control custom-checkbox mb-3 d-grid">
                                             <input type="checkbox" class="custom-control-input" id="check-terms" required name="checkbox">
                                             <label class="custom-control-label fs-lg-18 fs-md-15 fs-14" for="check-terms">I agree with the <a href="{{asset('/privacy_policy')}}">Privacy Policy</a> and <a href="{{asset('/terms_condition')}}">Terms & Conditions</a></label>
                                          </div>
                                       </div>
                                       <div class="mt-1 col-12">
                                          <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return tempregister()">SIGN UP</button>
                                       </div>
                                    </form>
                                    <div class="py-md-3 py-2 text-center">
                                       <span class="text-xs text-uppercase fs-md-15 fs-14">or</span>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <a href="{{ action('Website\SocialLoginController@redirect', 'facebook') }}" class="btn w-100 d-flex align-items-center btn-sm btn-outline-light border btn-sm btn-icon mb-md-3 mb-2 justify-content-center">
                                          <span class="btn-sm btn-inner--icon mr-md-2">
                                          <img src="{{ asset('public/website/assets/img/facebook.png') }}" class="h-md-35px" alt="facebook.png">
                                          </span>
                                          <span class="btn-sm btn-inner--text">Facebook</span>
                                          </a>
                                       </div>
                                       <div class="col-sm-6">
                                          <a 
                                             href="{{ action('Website\SocialLoginController@redirect', 'google') }}"  class="btn w-100 d-flex align-items-center btn-sm btn-outline-light border btn-sm btn-icon justify-content-center">
                                          <span class="btn-sm btn-inner--icon mr-md-2">
                                          <img src="{{ asset('public/website/assets/img/google.svg') }}" alt="google.svg">
                                          </span>
                                          <span class="btn-sm btn-inner--text">Google</span>
                                          </a>
                                       </div>
                                    </div>
                                    <div class="mt-md-4 mt-3 text-center">
                                       <small>Already have an Account?</small>
                                       <a href="#" data-toggle="modal" data-target="#exampleModal1" data-dismiss="modal" class="small font-weight-bold">Sign In</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="register1" role="tabpanel" aria-labelledby="register1-tab">
                              <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                                 <div>
                                    <div class="mb-5 text-center d-none">
                                       <h6 class="h3 mb-1">Register your account</h6>
                                       <p class="text-muted mb-0">Made with love for designers &amp; developers.</p>
                                    </div>
                                    <span class="clearfix"></span>
                                    <form id="enterprise_tempregister" method="post" class="row" autocomplete="off">
                                       @csrf
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">Coaching Name</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-school"></i>
                                                </span>
                                             </div>
                                             <input type="text" name="name" id="enterprise_name" 
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" placeholder="Coaching Name" required="">
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">Email</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-at"></i>
                                                </span>
                                             </div>
                                             <input 
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" 
                                                type="email" 
                                                id="enterprise_email" 
                                                name="email" 
                                                placeholder="Email*" required="">
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">Mobile Number</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-mobile"></i>
                                                </span>
                                             </div>
                                             <input 
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14"
                                                type="tel" 
                                                id="enterprise_mobile" 
                                                name="mobile" 
                                                placeholder="Mobile*" required=""
                                                pattern="[6-9]{1}[0-9]{9}" minlength="10" maxlength="10"
                                                onkeypress="return isNumberKey(event)" 
                                                title="Please enter valid mobile number"
                                                >
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                <label class="form-control-label">Create Password</label>
                                             </div>
                                          </div>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-key"></i>
                                                </span>
                                             </div>
                                             <input 
                                                id="enterprise_password"
                                                type="password"
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14"
                                                name="password"
                                                placeholder="Create Password*"
                                                required
                                                >
                                          </div>
                                          <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" 
                                             data-original-title="Password rules - <br/>
                                             1) Min. of 6 characters <br/>
                                             2) Must include letters and numbers <br/>">
                                             <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
                                             <span class="fa fa-info text-dark fs-md-12 fs-10" style="
                                                /* right: 19px; */
                                                "></span>
                                             </span>
                                          </div>
                                       </div>
                                       <div class="form-group col-12">
                                          <label class="form-control-label">Coaching Address</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                             </div>
                                             <input 
                                                type="text"                                                       
                                                name="address"
                                                id="enterprise_address"
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" 
                                                placeholder="Type Your Address.."
                                                required="" autocomplete="off"
                                                >
                                             <input 
                                                type="hidden"                                                       
                                                name="latitude"
                                                id="enterprise_latitude"
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" 
                                                required=""
                                                >
                                             <input 
                                                type="hidden"                                                       
                                                name="longitude"
                                                id="enterprise_longitude"
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" 
                                                required=""
                                                >
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">URL</label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-link"></i>
                                                </span>
                                             </div>
                                             <input 
                                                type="text"                                                       
                                                name="url"
                                                id="url"
                                                class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" 
                                                placeholder="URL"                                             
                                                >   
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">Select Country</label>
                                          <div class="input-group position-relative">
                                             <div class="input-group-prepend position-absolute z-index-2 top-0 h-md-50px h-40px">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-globe"></i>
                                                </span>
                                             </div>
                                             <select required name="country" id="country_id"  class="selectpicker w-100 show-tick" data-width="auto" data-container="container" data-size="10" data-live-search="true" placeholder="Country">
                                                <option value="" disabled selected="">Country </option>
                                                @if( !empty($header->countries()) )
                                                @foreach($header->countries() as $country)
                                                <option 
                                                   value="{{$country->name}}"
                                                   >{{$country->name}}</option>
                                                @endforeach
                                                @endif
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">Select State</label>
                                          <div class="input-group position-relative">
                                             <div class="input-group-prepend position-absolute z-index-2 top-0 h-md-50px h-40px">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-globe"></i>
                                                </span>
                                             </div>
                                             <select required name="state" id="state_id" class="selectpicker w-100 show-tick" data-width="auto" data-size="10"  data-container="container" data-live-search="true" placeholder="State">
                                                <option value="" selected disabled>State</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-6">
                                          <label class="form-control-label">Select City</label>
                                          <div class="input-group position-relative">
                                             <div class="input-group-prepend position-absolute z-index-2 top-0 h-md-50px h-40px">
                                                <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                                <i class="fas fa-globe"></i>
                                                </span>
                                             </div>
                                             <select required name="city" id="city_id" class="selectpicker w-100 show-tick" data-width="auto" data-size="10"  data-container="container" data-live-search="true" placeholder="City">
                                                <option value="" disabled selected="">City </option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="mt-2 col-12">
                                          <div class="custom-control custom-checkbox mb-3 d-grid">
                                             <input type="checkbox" name="terms" class="custom-control-input" id="check-terms1" value="1" required="">
                                             <label class="custom-control-label fs-lg-18 fs-md-15 fs-14" for="check-terms1">I agree with the <a href="{{asset('/privacy_policy')}}">Privacy Policy</a> and <a href="{{asset('/terms_condition')}}">Terms & Conditions</a></label>
                                          </div>
                                       </div>
                                       <div class="mt-1 col-12">
                                          <button 
                                             class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid"
                                             type="submit"
                                             onclick="return enterprise_tempregister(this)"   
                                             >SIGN UP</button>
                                        </div>
                                    </form>
                                    <div class="py-md-3 py-2 text-center">
                                       <span class="text-xs text-uppercase fs-md-15 fs-14">or</span>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <a href="{{ action('Website\EnterpriseSocialLoginController@redirect', 'facebook') }}" class="btn w-100 d-flex align-items-center btn-sm btn-outline-light border btn-sm btn-icon mb-md-3 mb-2 justify-content-center">
                                          <span class="btn-inner--icon mr-2">
                                          <img src="{{ asset('public/website/') }}/assets/img/facebook.png" class="h-md-35px" alt="acebook.png">
                                          </span>
                                          <span class="btn-inner--text">Facebook</span>
                                          </a>
                                       </div>
                                       <div class="col-sm-6">
                                          <a 
                                             href="{{ action('Website\EnterpriseSocialLoginController@redirect', 'google') }}" class="btn w-100 d-flex align-items-center btn-outline-light border btn-icon justify-content-center btn-sm">
                                          <span class="btn-inner--icon mr-2">
                                          <img src="{{ asset('public/website/') }}/assets/img/google.svg" alt="google.svg">
                                          </span>
                                          <span class="btn-inner--text">Google</span>
                                          </a>
                                       </div>
                                    </div>
                                    <div class="mt-md-4 mt-3 text-center">
                                       <small>Already have an Account?</small>
                                       <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" data-backdrop="static" data-keyboard="false" data-dismiss="modal" class="small font-weight-bold">Sign In</a>
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
      <div class="modal comman_modal_popup fade" id="number-verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-5 text-center">
                              <h6 class="h3 mb-1">Verify Phone Number</h6>
                              <p class="text-muted mb-0 mt-4">OTP is sent on +91-<span id="mobile_display1"></span></p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="register" method="post" class="row mx-0" autocomplete="off">
                              @csrf
                              <input type="hidden" name="mobile" id="mobile">
                              <div class=form-group>
                                 <label class=form-control-label>OTP</label>
                                 <div class="digit-group row">
                                    <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" type="text" name="otp[1]" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" name="otp[2]" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" name="otp[3]" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" name="otp[4]" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" >
                                 </div>
                                 <a href="javascript:;" onclick="document.getElementById('register').reset();return resend_otp(document.getElementById('mobile').value, 'register', 'student');" class="small font-weight-bold">Resend OTP</a>
                              </div>
                              <div class="mt-4 col-12 px-0">
                                 <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-flex justify-content-center"
                                 onclick="return register()">Verify &nbsp;<span class="spinner-border spinner-border-sm" role="status"
                                 style="display:none;"
                                 >
                                 </span></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="enterprise_number-verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-5 text-center">
                              <h6 class="h3 mb-1">Verify Phone Number</h6>
                              <p class="text-muted mb-0 mt-4">OTP is sent on +91-<span id="mobile_display2"></span></p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="enterprise_register" method="post" class="row mx-0" autocomplete="off">
                              @csrf
                              <input type="hidden" name="mobile" id="enterprise_mobile_verify">
                              <div class=form-group>
                                 <label class=form-control-label>OTP</label>
                                 <div class="digit-group row">
                                    <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" type="text" name="otp[1]" id="enterprise_verify_digit-1" data-next="enterprise_verify_digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" name="otp[2]" id="enterprise_verify_digit-2" data-next="enterprise_verify_digit-3" data-previous="enterprise_verify_digit-1" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" name="otp[3]" id="enterprise_verify_digit-3" data-next="enterprise_verify_digit-4" data-previous="enterprise_verify_digit-2" maxlength="1" autocomplete="off" >
                                    <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" name="otp[4]" id="enterprise_verify_digit-4" data-next="enterprise_verify_digit-5" data-previous="enterprise_verify_digit-3" maxlength="1" autocomplete="off" >
                                 </div>
                                 <a href="javascript:;" onclick="document.getElementById('enterprise_register').reset();return resend_otp(document.getElementById('enterprise_mobile_verify').value, 'register', 'enterprise');" class="small font-weight-bold">Resend OTP</a>
                              </div>
                              <div class="mt-4 col-12 px-0">
                                 <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-flex justify-content-center" onclick="return enterprise_register()">Verify &nbsp;<span class="spinner-border spinner-border-sm" role="status"
                                 style="display:none;"
                                 >
                                 </span></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jquery autocomplete -->
      <script>
         $(function() {
            var availableTutorials = [];
            
            @if( !empty($header->coaching_search_autocomplete()) )
               @php
                  $i = 0;
               @endphp
         
               @foreach($header->coaching_search_autocomplete() as $blog)
         
                  availableTutorials[{{$i}}] = "<?php echo $blog; ?>";
         
                  @php
                     $i += 1;
                  @endphp
               @endforeach
            @endif
         
            $( "#top_search" ).autocomplete({
               source: availableTutorials,
               select: function (e, ui) {
         
                  setTimeout(() => {    
         
                     // search lead
                     $.ajax({
                        url: '{{ action("Website\CoachingSearchController@search_lead") }}',
                        data: {
                           text: ui.item.value,
                        },
                        success: function(data) {
         
                        }
                     });
                     
                     window.location.href = "{{ asset('coaching') }}/" + ui.item.value.split(' ').join('-');
                        
                  }, 300);
               },
            });
         
            $('.ui-helper-hidden-accessible').remove();
            $('ul.ui-autocomplete').css(
               'z-index', '10000000000000'
            );
         });
      </script>
      <!-- Modal -->
      <div class="modal fade basics_info_modal" id="payment_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0">
               <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center border-0">
                  <h5 class="modal-title fs-16" id="staticBackdropLabel">Registration Form</h5>
                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
                  <span class="text-white" aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div 
                  id="payment_modal_div"
                  class="modal-body bg-secondary p-0">
                  <div class="row mx-0">
                     <div class="col-lg-6 px-0">
                        <div class="basics_modal_inner bg-white py-4 px-4 h-100 d-flex align-items-center">
                           <form 
                              id="payment_form"
                              action="{{ action('Website\OrderController@discount') }}" 
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
                                       <option value="" disabled>States </option>
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
                                       name="coaching_courses_detail_id"
                                       id="coaching_courses_detail_id" 
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
                                    type="text" name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="mobile" placeholder="Enter Mobile Number"
                                    onkeypress="return isNumberKey(event)" 
                                    pattern="[6-9]{1}[0-9]{9}" minlength="10" maxlength="10"
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
                                          onclick="send_otp_on_mobile(this)"
                                          class="p-2 d-flex align-items-center">Get OTP</span></button>
                                    </div>
                                 </div>
                              </div>
                              <div class="mb-3 form-group col-12 mb-0 otp_div d-none">
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
                                       id="otp_sent_msg"
                                       class="d-none my-2 text-success">OTP Sent</label>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-lg-6 bg-primary">
                        <div class="basics_modal_left py-3">
                           <div class="row align-items-center">
                              <div class="col">
                                 <h3 class="fs-14 mb-0" id="coaching_name_id2"></h3>
                              </div>
                              <div class="col-auto d-none"> 
                                 <a href="javascript:;" data-toggle="tooltip" data-placement="top" data-original-title="Change Course" title="" class="text-white fs-md-14"fs-13 ><i class="far fa-sync"></i></a>
                              </div>
                           </div>
                           <div class="row bg-white rounded mx-0 mt-3 mb-2 py-3 shadow">
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fal fa-users-class"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Course Name :
                                    </span>
                                    <strong class="d-block fs-md-14 fs-12" 
                                       id="course_name"
                                       > 
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-clipboard-list-check"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Duration :</span>
                                    <strong class="d-block fs-md-14 fs-12"
                                       id="duration"
                                       >
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-books"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Targeting :</span>
                                    <strong class="d-block fs-md-14 fs-12"
                                       id="targeting"
                                       >
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-money-check"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">Course Fee :</span>
                                    <strong class="d-block fs-md-14 fs-12">
                                    &#8377; 
                                    <span
                                       id="amount"
                                       >
                                    </span>
                                    </strong>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="row align-items-center py-3 border-bottom">
                                    <div class="col-5">
                                       <span class="text-white fs-md-14 fs-13 d-block mb-0">Amount Payable :</span>
                                    </div>
                                    <div class="col-2 text-center">
                                       <span class="text-white fs-md-14 fs-13 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="col-5 text-right">
                                       <span class="text-white fs-md-14 fs-13 d-block mb-0">&#8377; 
                                       <span
                                          id="subtotal_amount"
                                          >
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="row align-items-center py-3 border-bottom bg-white">
                                    <div class="col-5">
                                       <span class="text-primary fs-14 d-block mb-0">Total Amount :</span>
                                    </div>
                                    <div class="col-2 text-center">
                                       <span class="text-primary fs-14 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="col-5 text-right">
                                       <span class="text-primary fs-14 d-block mb-0">&#8377; 
                                       <span
                                          id="total_amount"
                                          >
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="mt-4 col-12">
                                 <button 
                                    type="submit"
                                    form="payment_form"
                                    class="btn btn-block btn-secondary h-md-50px h-40px btn-sm align-items-center d-flex justify-content-center"><i class="fad fa-check-circle mr-1"></i>Proceed
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
      <div class="modal fade registration_info_modal" id="payment_modal1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0">
               <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center border-0">
                  <h5 class="modal-title fs-16" id="staticBackdropLabel">Registration Form</h5>
                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
                  <span class="text-white" aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div id="payment_modal_div1" class="modal-body bg-secondary p-0">
                  <div class="row mx-0">
                     <div class="col-lg-6 px-0">
                        <div class="basics_modal_inner bg-white py-4 px-4 h-100 d-flex align-items-center">
                           <form 
                              id="payment_form1"
                              action="{{ action('Website\OrderController@discount') }}" 
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
                              <?php $userdata=  session()->get('student'); 
                              ?>
                              <div class="form-group col-12 custom_dropdown2">
                                 <label class="form-control-label">State Name</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-globe"></i>
                                       </span>
                                    </div>
                                    <select required name="parent_name" id="statess_id"  class="selectpicker shadow-none h-md-50px h-40px show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="States">
                                       <option value="" disabled>States </option>
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
                                    type="email" name="email" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="email1" placeholder="Email Id">
                                    
                                    
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
                                       id="email_or_mobile1"                                       
                                       >
                                    <input type="hidden"
                                       name="coaching_courses_detail_id"
                                       id="coaching_courses_detail_id1" 
                                       required                                      
                                       >
                                    <input type="hidden"
                                       name="is_email_verified"
                                       id="is_email_verified1" 
                                       required  
                                       value="yes"                                    
                                       >
                                    <input type="hidden"
                                       name="is_mobile_verified"
                                       id="is_mobile_verified1" 
                                       required                                    
                                       >
                                    <input
                                    required
                                    type="text" name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="mobile1" placeholder="Enter Mobile Number"
                                    onkeypress="return isNumberKey(event)" 
                                    pattern="[6-9]{1}[0-9]{9}" minlength="10" maxlength="10"
                                    @if( session()->has('student') )
                                    value="{{ session()->get('student')->mobile ?? '' }}"
                                    @endif
                                    >
                                    <div 
                                       id="mobile_prepend1"
                                       class="input-group-prepend">
                                       <button 
                                          type="button" class="search_btn border-0 btn btn-sm fs-md-14 fs-12 btn-green border-0 rounded-right"> 
                                       <span 
                                          onclick="send_otp_on_mobile1(this)"
                                          class="p-2 d-flex align-items-center">Get OTP</span></button>
                                    </div>
                                 </div>
                              </div>
                              <div class="mb-3 form-group col-12 mb-0 otp_div1 d-none">
                                 <div class="d-flex align-items-center justify-contenEnter t-between">
                                    <div>
                                       <label class="form-control-label">Enter OTP</label>
                                    </div>
                                 </div>
                                 <div class="digit-group row">
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" type="text" id="digit-11" data-next="digit-12" maxlength="1" autocomplete="off" >
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-12" data-next="digit-13" data-previous="digit-11" maxlength="1" autocomplete="off" >
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-13" data-next="digit-14" data-previous="digit-12" maxlength="1" autocomplete="off" >
                                    <input
                                       name="otp_digits[]"
                                       class="inputs otp_digits col px-0 text-center mx-1 h-50px form-control shadow-none" type="text" id="digit-14" data-next="digit-15" data-previous="digit-13" maxlength="1" autocomplete="off" >
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-contenEnter t-between">
                                 <div>
                                    <label 
                                       id="otp_sent_msg1"
                                       class="d-none my-2 text-success">OTP Sent</label>
                                 </div>
                              </div>
                              <input name="registration_fee"  type="hidden" id="registration_fee_id">
                              <input name="remaining_fee"  type="hidden" id="remaining_fee_id">
                           </form>
                        </div>
                     </div>
                     <div class="col-lg-6 bg-primary">
                        <div class="basics_modal_left py-3">
                           <div class="row align-items-center">
                              <div class="col">
                                 <h3 class="fs-14 mb-0" id="coaching_name_id1"></h3>
                              </div>
                              <div class="col-auto d-none"> 
                                 <a href="javascript:;" data-toggle="tooltip" data-placement="top" data-original-title="Change Course" title="" class="text-white fs-md-14"fs-13 ><i class="far fa-sync"></i></a>
                              </div>
                           </div>
                           <div class="row bg-white rounded mx-0 mt-3 mb-2 py-3 shadow">
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fal fa-users-class"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Course Name :
                                    </span>
                                    <strong class="d-block fs-md-14 fs-12" 
                                       id="course_name1"
                                       >
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-clipboard-list-check"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    Duration :</span>
                                    <strong class="d-block fs-md-14 fs-12"
                                       id="duration1"
                                       >
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-books"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">
                                    TARGETING :</span>
                                    <strong class="d-block fs-md-14 fs-12"
                                       id="targeting1"
                                       >
                                    </strong>
                                 </div>
                              </div>
                              <div class="col-md-6 mb-md-4 mb-2">
                                 <div class="selectcourse_box text-left">
                                    <i class="fad fa-money-check"></i>
                                    <span class="text-gray fs-13 d-block mb-1 mt-1">Course Fee :</span>
                                    <strong class="d-block fs-md-14 fs-12">
                                    &#8377; 
                                    <span
                                       id="amount1"
                                       >
                                    </span>
                                    </strong>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="row align-items-center py-3 border-bottom">
                                    <div class="col-5">
                                       <span class="text-white fs-md-14 fs-13 d-block mb-0">Registration Amount :</span>
                                    </div>
                                    <div class="col-2 text-center">
                                       <span class="text-white fs-md-14 fs-13 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="col-5 text-right">
                                       <span class="text-white fs-md-14 fs-13 d-block mb-0">&#8377; 
                                       <span
                                          id="subtotal_amount1"
                                          >
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="row align-items-center py-3 border-bottom bg-white">
                                    <div class="col-5">
                                       <span class="text-primary fs-14 d-block mb-0">Remaining Amount :</span>
                                    </div>
                                    <div class="col-2 text-center">
                                       <span class="text-primary fs-14 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                                    </div>
                                    <div class="col-5 text-right">
                                       <span class="text-primary fs-14 d-block mb-0">&#8377; 
                                       <span
                                          id="total_amount1"
                                          >
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="mt-4 col-12">
                                 <button 
                                    type="submit"
                                    form="payment_form1"
                                    class="btn btn-block btn-secondary h-50px align-items-center d-flex justify-content-center"><i class="fad fa-check-circle mr-1"></i>Proceed
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
      <!-- Button trigger modal -->
      <div class="modal fade write_blog_modal" id="staticBackdrop_blog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
               <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                  <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Write A Blog</h5>
                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                  <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                  </button>
               </div>
               <div class="modal-body persnol-details">
                  <form 
                     action="{{ action('Website\BlogsController@add_blog') }}" 
                     method="post" autocomplete="FALSE"
                     enctype="multipart/form-data"
                     id="write_a_blog_form"
                     >
                     @csrf
                     <div class="row">
                        <div class="col-md-4 px-2">
                           <div class="row mx-0 mb-md-3">
                              <div class="col-12 px-2"><label for="dob" class="mb-0 fs-md-13 fs-12 font-weight-bold text-uppercase text-gray">Category :</label></div>
                              <div class="col-12 px-2">
                                 <div class="row">
                                    <div class="col-12">
                                       <div class="form-group">
                                          <select name="blog_category_id" id="blog_category_id" class="selectpicker w-100 show-tick" data-width="auto" data-container="container" data-live-search="true" placeholder="Category" required>
                                             <option value="">Select Category</option>
                                             @if( !empty($header->blogs_category()) )
                                             @foreach($header->blogs_category() as $blog_category)
                                             <option value="{{$blog_category->id}}">{{$blog_category->name}}</option>
                                             @endforeach
                                             @endif
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 px-2">
                           <div class="row mx-0 mb-0">
                              <div class="col-12 px-2"><label for="tagline" class="mb-0 fs-md-13 fs-12 font-weight-bold text-uppercase text-gray">Title :</label></div>
                              <div class="col-12 px-2">
                                 <div class="form-group">
                                    <input type="text" class="form-control shadow-none rounded-0 fs-md-14 fs-13 " placeholder="Enter Title" id="tagline"
                                       name="title" minlength="60" required
                                       >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 px-2">
                           <div class="row mx-0 mb-0">
                              <div class="col-12 px-2"><label for="number" class="mb-0 fs-md-13 fs-12 font-weight-bold text-uppercase text-gray">Upload Image :</label></div>
                              <div class="col-12 px-2">
                                 <div class="form-group position-relative">
                                    <label class="form-control fs-13 h-38px rounded-0 d-flex align-items-center" for="">Upload Image</label>
                                    <input type="file" class="position-absolute top-3px w-100 h-38px" style="opacity: 0;" id="customFile"
                                       name="image" required
                                       >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 px-2">
                           <div class="row mx-0 mb-0">
                              <div class="col-12 px-2"><label for="tagline" class="mb-0 fs-md-13 fs-12 font-weight-bold text-uppercase text-gray">Short Description :</label></div>
                              <div class="col-12 px-2">
                                 <div class="form-group">
                                    <textarea class="form-control shadow-none rounded-0 fs-md-14 fs-13 " name="short_description" id="short_description" placeholder="Enter Short Description" required ></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 px-2">
                           <div class="row mx-0 mb-0">
                              <div class="col-12 px-2"><label for="tagline" class="mb-0 fs-md-13 fs-12 font-weight-bold text-uppercase text-gray">About Yourself :</label></div>
                              <div class="col-12 px-2">
                                 <div class="form-group">
                                    <textarea class="form-control shadow-none rounded-0 fs-md-14 fs-13" name="about_writer" id="about_writer" placeholder="Enter About Yourself" required ></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 text_editor_modall">
                           <div class="row mx-0 mb-0 text_editor_main">
                              <div class="col-12 px-2"><label for="tagline" class="mb-0 fs-md-13 fs-12 font-weight-bold text-uppercase text-gray">Description :</label></div>
                              <div class="col-12 px-2">
                                 <div class="form-group">
                                    <textarea class="form-control shadow-none rounded-0 fs-md-14 fs-13 " name="description" id="editor1" placeholder="Enter Description" ></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 border-top mt-3">
                           <div class="btn_editor mt-3 text-left">
                              <button type="submit" class="btn btn-green fs-14 border-0 rounded-pill"><span class="mr-2"><i class="far fa-check-circle"></i></span><span>Submit</span></button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script>
         $(document).on(
            'input', 
            '.student_enter_email_mobile',
            function() {
                        
            }            
         );
         
         $(document).on(
            'click', 
            '.student_enter_box_btn',
            function() {               
         
               var mobile = $('#login #login-input-email').val();
         
               $.ajax({
                  url: '{{ action("Website\OrderController@otp") }}',
                  data: {
                     mobile,
                  },
                  success: function(data) {
         
                     if(data == 1) {
                        $('.student_otp_box').removeClass('d-none');
                        
                        Swal.fire('OTP sent on your registered mobile number: ' + mobile);
                     } else {
                        Swal.fire('There is no such account with this mobile');
                     }
         
                  }
               });
         
            }            
         );
      </script>
      <script>
         $(document).on(
            'input', 
            '.enterprise_enter_email_mobile',
            function() {
               
            }            
         );
         
         $(document).on(
            'click', 
            '.enterprise_enter_box_btn',
            function() {               
         
               var mobile = $('#enterprise_login #enterprise_email').val();
         
               $.ajax({
                  url: '{{ action("Website\OrderController@enterprise_otp") }}',
                  data: {
                     mobile,
                  },
                  success: function(data) {
         
                     if(data == 1) {
                        $('.enterprise_otp_box').removeClass('d-none');
                        
                        Swal.fire('OTP sent on your registered mobile number: ' + mobile);
                     } else {
                        Swal.fire('There is no such account with this mobile');
                     }
         
                  }
               });
         
            }            
         );
      </script>
      <!-- write a blog description validation -->
      <script>
         $(document).on('submit', '#write_a_blog_form', function(){
            
            if(
               this.description.value == ''
            ) {
         
               Swal.fire('Description is required');
         
               return false;
         
            } else {
                
                if( !$(this).valid() )
                    return false;
                else
                    return true;
            }
         });
      </script>
      <!-- enterprise forgot and change password -->
      <div class="modal comman_modal_popup fade" id="enterprise_forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-5 text-center">
                              <h6 class="h3 mb-1">Forgot Password</h6>
                              <p class="text-muted mb-0">Sign in to your account to continue.</p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="enterprise_forgot" method="post" class="row" autocomplete="FALSE" onsubmit="return false;">
                              @csrf
                              <div class="form-group col-12">
                                 <label class="form-control-label">Mobile Number</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-mobile"></i>
                                       </span>
                                    </div>
                                    <input name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="enterprise_forgot-input-mobile" placeholder="9800000000" required onkeypress="return isNumberKey(event)" 
                                       pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid mobile number" minlength="10" maxlength="10" name="mobile" type="tel">
                                 </div>
                              </div>
                              <div class="mt-4 col-12">
                                 <button type="submit" href="javascript:;" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return enterprise_forgot()">
                                    Get OTP</a>
                              </div>
                           </form>
                           <div class="mt-md-4 mt-3 text-center">
                           <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" data-dismiss="modal" class="small font-weight-bold">Back to login</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="enterprise_change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content border-0">
      <div class="modal-body p-0 row mx-0 border-0 position-relative">
      <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
      <div class="card shadow-lg col-md-12 border-0 mb-0">
      <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
      <div>
      <div class="mb-4 text-center">
      <h6 class="h3 mb-1">Reset Password</h6>
      <p class="text-muted mb-0">OTP sent to your mobile number..</p>
      <p class="text-muted mb-0 font-weight-bold" id="enterprise_mobile_display"></p>
      </div>
      <span class="clearfix"></span>
      <form id="enterprise_change" method="post" class="row" autocomplete="off">
      @csrf
      <input type="hidden" name="mobile" id="enterprise_forgot-mobile">
      <div class="form-group col-12" id="enterprise_reset_password_otp_box">
      <label class=form-control-label>OTP</label>
      <div class="digit-group row">
      <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" name="forgot-otp[1]" type="text" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[2]" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[3]" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[4]" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" >
      </div>
      <a href="javascript:;" onclick="document.getElementById('enterprise_change').reset();return resend_otp(document.getElementById('enterprise_forgot-mobile').value, 'forgot', 'enterprise');" class="small font-weight-bold">Resend OTP</a>
      </div>
      <div class="form-group col-12 d-none" id="enterprise_reset_password_password_box">
      <div class="d-flex align-items-center justify-content-between">
      <div>
      <label class="form-control-label">Password</label>
      </div>
      </div>
      <div class="input-group">
      <div class="input-group-prepend">
      <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
      <i class="fas fa-key"></i>
      </span>
      </div>
      <input type="password" name="password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="enterprise_password" placeholder="Password" required>
      </div>
      <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
         1) Min. of 6 characters <br/>
         2) Must include letters and numbers <br/>">
      <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
      <span class="fa fa-info text-dark fs-md-12 fs-10" style="
         /* right: 19px; */
         "></span>
      </span>
      </div>
      </div>
      <div class="form-group col-12 mb-0 d-none" id="enterprise_reset_password_confirm_password_box">
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
      <input type="password" name="confirm_password" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="enterprise_confirm-password" placeholder="Password" required>
      </div>
      <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
         1) Min. of 6 characters <br/>
         2) Must include letters and numbers <br/>">
      <span class="d-grid align-items-center justify-content-center w-md-20px w-15px h-md-20px h-15px">
      <span class="fa fa-info text-dark fs-md-12 fs-10" style="
         /* right: 19px; */
         "></span>
      </span>
      </div>
      </div>
      <div class="mt-4 col-12">
      <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return enterprise_change()" id="enterprise_reset_password_submit_btn">Verify Otp</button>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <!-- student mobile verify modal -->
      <div class="modal comman_modal_popup fade" id="student_mobile_verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <a class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" href="{{ action('Website\IndexController@cancel_signup', 'student') }}"><i class="fas fa-times"></i></a>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-5 text-center">
                              <h6 class="h3 mb-1">Verify Mobile Number</h6>
                              <p class="text-muted mb-0">Verify your mobile number to complete register.</p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="student_mobile_verify_form" method="post" class="row" autocomplete="FALSE" onsubmit="return false;">
                              @csrf
                              <div class="form-group col-12">
                                 <label class="form-control-label">Mobile Number</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-mobile"></i>
                                       </span>
                                    </div>
                                    <input name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="student_mobile_verify_mobile" placeholder="9800000000" required onkeypress="return isNumberKey(event)" 
                                       pattern="[6-9]{1}[0-9]{9}" title="Please enter valid mobile number" minlength="10" maxlength="10" name="mobile" type="tel">
                                 </div>
                              </div>
                              <div class="mt-4 col-12">
                                 <button type="submit" href="javascript:;" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return student_mobile_verify_form_submit()">
                                    Get OTP</a>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="student_mobile_verify_otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content border-0">
      <div class="modal-body p-0 row mx-0 border-0 position-relative">
      <a class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" href="{{ action('Website\IndexController@cancel_signup', 'student') }}"><i class="fas fa-times"></i></a>
      <div class="card shadow-lg col-md-12 border-0 mb-0">
      <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
      <div>
      <div class="mb-4 text-center">
      <h6 class="h3 mb-1">Verify OTP</h6>
      <p class="text-muted mb-0">OTP sent to your mobile number..</p>
      <p class="text-muted mb-0 font-weight-bold" id="student_mobile_verify_display"></p>
      </div>
      <span class="clearfix"></span>
      <form id="student_mobile_verify_otp_form" method="post" class="row" autocomplete="off">
      @csrf
      <input type="hidden" name="mobile" id="student_mobile_verify_mobile_input">
      <div class="form-group col-12">
      <label class=form-control-label>OTP</label>
      <div class="digit-group row">
      <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" 
         name="student_mobile_verify-otp[1]" type="text" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" 
         name="student_mobile_verify-otp[2]" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" 
         name="student_mobile_verify-otp[3]" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" 
         name="student_mobile_verify-otp[4]" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" >
      </div>
      <a href="javascript:;" onclick="document.getElementById('student_mobile_verify_otp_form').reset();return resend_otp(document.getElementById('student_mobile_verify_mobile_input').value, 'tempregister', 'student');" class="small font-weight-bold">Resend OTP</a>
      </div>
      <div class="mt-4 col-12">
      <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return student_mobile_verify_otp_form_submit()">Verify Otp</button>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <!-- enterprise mobile verify -->
      <div class="modal comman_modal_popup fade" id="enterprise_mobile_verify1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
               <div class="modal-body p-0 row mx-0 border-0 position-relative">
                  <a class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" href="{{ action('Website\IndexController@cancel_signup', 'enterprise') }}"><i class="fas fa-times"></i></a>
                  <div class="card shadow-lg col-md-12 border-0 mb-0">
                     <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
                        <div>
                           <div class="mb-5 text-center">
                              <h6 class="h3 mb-1">Verify Mobile Number</h6>
                              <p class="text-muted mb-0">Verify your mobile number to complete register.</p>
                           </div>
                           <span class="clearfix"></span>
                           <form id="enterprise_mobile_verify_form" method="post" class="row" autocomplete="FALSE" onsubmit="return false;">
                              @csrf
                              <div class="form-group col-12">
                                 <label class="form-control-label">Mobile Number</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                       <i class="fas fa-mobile"></i>
                                       </span>
                                    </div>
                                    <input name="mobile" class="form-control shadow-none h-md-50px h-40px fs-md-15 fs-14" id="enterprise_mobile_verify_mobile" placeholder="9800000000" required onkeypress="return isNumberKey(event)" 
                                       pattern="[6-9]{1}[0-9]{9}" title="Please enter valid mobile number" minlength="10" maxlength="10" name="mobile" type="tel">
                                 </div>
                              </div>
                              <div class="mt-4 col-12">
                                 <button type="submit" href="javascript:;" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return enterprise_mobile_verify_form_submit()">
                                    Get OTP</a>
                                    
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal comman_modal_popup fade" id="enterprise_mobile_verify_otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content border-0">
      <div class="modal-body p-0 row mx-0 border-0 position-relative">
      <a class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" href="{{ action('Website\IndexController@cancel_signup', 'enterprise') }}"><i class="fas fa-times"></i></a>
      <div class="card shadow-lg col-md-12 border-0 mb-0">
      <div class="card-body py-lg-5 py-md-4 py-3 px-lg-5 px-md-4 px-3">
      <div>
      <div class="mb-4 text-center">
      <h6 class="h3 mb-1">Verify OTP</h6>
      <p class="text-muted mb-0">OTP sent to your mobile number..</p>
      <p class="text-muted mb-0 font-weight-bold" id="student_mobile_verify_display"></p>
      </div>
      <span class="clearfix"></span>
      <form id="enterprise_mobile_verify_otp_form" method="post" class="row" autocomplete="off">
      @csrf
      <input type="hidden" name="mobile" id="enterprise_mobile_verify_mobile_input">
      <div class="form-group col-12">
      <label class=form-control-label>OTP</label>
      <div class="digit-group row">
      <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" 
         name="enterprise_mobile_verify-otp[1]" type="text" id="digit-1" data-next="digit-2" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" 
         name="enterprise_mobile_verify-otp[2]" type="text" id="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" 
         name="enterprise_mobile_verify-otp[3]" type="text" id="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off" >
      <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" 
         name="enterprise_mobile_verify-otp[4]" type="text" id="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off" >
      </div>
      <a href="javascript:;" onclick="document.getElementById('enterprise_mobile_verify_otp_form').reset();return resend_otp(document.getElementById('enterprise_mobile_verify_mobile_input').value, 'tempregister', 'enterprise');" class="small font-weight-bold">Resend OTP</a>
      </div>
      <div class="mt-4 col-12">
      <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return enterprise_mobile_verify_otp_form_submit()">Verify Otp</button>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      @hasSection('content')
      @yield('content')
      @endif