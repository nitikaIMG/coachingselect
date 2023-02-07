<!DOCTYPE html>
<html lang="en">
   <head>
      <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
      <title>
         @if(!empty($metatitle))
         {{ $metatitle }}
         @else
            CoachingSelect
         @endif
      </title>
      <meta name=description content="Website Design" />
      <meta name=keywords content="Website Design" />
      <meta name="msvalidate.01" content="" />
      <meta name="web-author" content="Website Design" />
      <meta name="googlebot" content="all">
      <meta name="robots" content="index, follow" />
      <meta name="revisit-after" content="3 days">
      <meta name="copyright" content="Website Design ">
      <meta name="language" content="English">
      <meta name="reply-to" content="">
      <meta name="classification" content="Website Design" />
      <meta name="distribution" content="Global" />
      <meta name="rating" content="General" />
      <link rel="canonical" href="" />
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content="website" />
      <meta property="og:title" content="Website Design" />
      <meta property="og:description" content="Website Design" />
      <meta property="og:url" content="" />
      <meta property="og:site_name" content="Website Design" />
      <meta property="og:image" content="" />
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:description" content="Website Design" />
      <meta name="twitter:url" content="" />
      <meta name="twitter:title" content="Website Design" />
      <meta name="twitter:site" content="@website-design" />
      <meta name="twitter:creator" content="@website-design " />
      <meta name="twitter:image" content="{{ asset('public/website/assets/img/header/logo.png') }}" />
      <link rel="icon" type="image/png" href="{{ asset('public/website/assets/img/favicon_icon.png') }}" sizes="192x192">
      <meta name="theme-color" content="#139ed9" />
      <meta name="google-site-verification" content="" />
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/bijarniadream/bijarniadream.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/color_style/color_style.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/materialize/materialize.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/website/assets/vendor/vendors.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/website/assets/vendor/select2/bootstrap-select.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/website/assets/vendor/fast-select/fastselect.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/venobox/venobox.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/aos/aos.css') }}">
      <link rel="stylesheet" href="{{ asset('public/website/assets/css/style.css') }}">
      <script src="{{ asset('public/website/assets/vendor/jquery/jquery.min.js') }}"></script>
      @include('website/layouts/website_theme')
   </head>
   <body class="pt-0">
      <div class="container-fluid">
         <div class="row">
            <div class="modal-body bg-light border rounded">
               <div class="instruction_content position-relative row mx-0 shadow rounded bg-white p-3">
                  <div class="col-12 text-center">
                     @if(!empty($paper->image))
                     <img src="{{ asset('public/question_paper_subjects/'.$paper->image) }}" class="w-md-4 w-20">
                     @endif
                     <strong class="fs-18 d-none text-center text-secondary">- Please read the following instructions carefully -</strong>
                     <span class="bg-secondary px-2 py-1 fs-13 rounded mt-3 d-inline-flex">
                     {{ $paper->name }}
                     </span>
                  </div>
                  <div class="col-12 my-4 text-justify">
                     <div class="row">
                        <div class="col-12 mb-md-3 mb-2 fs-md-18 fs-md-15 fs-13 mb-mb-3 mb-2 text-secondary font-weight-bold">General Instructions :</div>
                        <div class="col-12">
                           <ul class="list_count list_count pl-md-4 pl-2 mb-md-4 mb-3 fs-md-15 fs-13">
                              <li class="">
                                 <p class="fs-md-15 fs-13 mb-mb-3 mb-2">
                                 You have {{ $paper->hours }} hours {{ $paper->minutes }} minutes to complete the test.</p>
                              </li>
                              <li class="">
                                 <p class="fs-md-15 fs-13 mb-mb-3 mb-2">
                                 There are total {{ $paper->total_questions }} questions in this exam.
                                 </p>
                              </li>
                              <li class="">
                                 <p class="fs-md-15 fs-13 mb-mb-3 mb-2">A countdown timer at the top right corner of your screen will display the time remaining for you to complete the exam. When the clock runs out, the exam ends by default - you are not required to end or submit your exam.</p>
                              </li>
                              <li class="">
                                 <p class="fs-md-15 fs-13 mb-mb-3 mb-2">The question palette at the right of the screen shows one of the following statuses of each of the questions numbered:</p>
                                 <ul class="list-unstyled">
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-14 bg-light border shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-mb-3 mb-2 mb-0 d-flex align-items-center ml-2 w-80">You have not visited the question yet.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-14 bg-red shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-mb-3 mb-2 mb-0 d-flex align-items-center ml-2 w-80">You have visited but not answered the question yet.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-14 bg-success shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-mb-3 mb-2 mb-0 d-flex align-items-center ml-2 w-80">You have answered the question.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-14 bg-orange shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-mb-3 mb-2 mb-0 d-flex align-items-center ml-2 w-80">You have NOT answered the question but have marked the question for review.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class=" position-relative rounded-pill fs-14 bg-orange shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fas fa-hand-point-right"></i>
                                       <span class="fs-14 position-absolute top-n5px right-n2px"><i class="fas fa-check text-success font-weight-bold"></i></span>  </a> 
                                       <p class="fs-md-15 fs-13 mb-mb-3 mb-2 mb-0 d-flex align-items-center ml-2 w-80">You have answered the question but marked it for review.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-14 bg-blue shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-mb-3 mb-2 mb-0 d-flex align-items-center ml-2 w-80">The current question that you are on.</p>
                                    </li>
                                 
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 my-2 text-justify">
                     <div class="row">
                        <div class="col-12 mb-md-3 mb-2 fs-md-18 fs-15 text-secondary font-weight-bold">Question Paper Instructions :</div>
                        <div class="col-12 fs-md-15 fs-13 mb-mb-3 mb-2">
                           {!! $paper->description ?? '' !!}
                           <ul class="list_count list_count pl-md-4 pl-1 mb-md-4 mb-3 fs-md-15 fs-13 d-none">
                              <li class="">
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 px-md-3 px-0">
                           <div class="instruction_footer mt-2 text-center border bg-light rounded shadow px-4 py-4">
                              <div class="custom-control custom-checkbox mt-1 d-flex align-items-center">
                                 <input class="custom-control-input" type="checkbox" id="start-test">
                                 <label class="custom-control-label fs-md-15 fs-13 mb-mb-3 mb-2 text-justify" for="start-test">I have read and understood the instructions. All computer hardware allotted to me are in proper working condition. I declare that I am not in possession of /not wearing /not carrying any prohibited gadget like mobile phone, Bluetooth device etc. /any prohibited material during the Examination. I agree that in case of not adhering to the instruction, I shall be liable to be debarred from this Test and/or to a disciplinary action, which may include ban from future Tests / Examinations.<label>
                              </div>
                              <a 
                                 href="{{ action('Website\FreePreparationToolController@test', [$paper->course_id, $slug]) }}" class="btn btn-danger d-inline-block py-1 mt-3 fs-md-15 fs-13 mb-mb-3 mb-2 text-capitalize disabled"
                                 id="start_test_btn"                                    
                              ><i class="far fa-edit"></i> <span class="ml-1">Start Exam</span></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Vendor JS Files -->
      <script src="{{ asset('public/website/assets/vendor/venobox/venobox.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/aos/aos.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/php-email-form/validate.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/counterup/counterup.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/select2/bootstrap-select.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/fast-select/fastselect.standalone.js') }}"></script>
      <script src="{{ asset('public/website/assets/vendor/main-js/main.js') }}"></script>
      <script>
         $('.digit-group').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
               var parent = $($(this).parent());
         
               if (e.keyCode === 8 || e.keyCode === 37) {
                  var prev = parent.find('input#' + $(this).data('previous'));
         
                  if (prev.length) {
                     $(prev).select();
                  }
               } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                  var next = parent.find('input#' + $(this).data('next'));
         
                  if (next.length) {
                     $(next).select();
                  } else {
                     if (parent.data('autosubmit')) {
                        parent.submit();
                     }
                  }
               }
            });
         });
         
         function checkCode(e) {
            if ($('#digit-1').val() == '') {
               $('#digit-1').addClass('box-invalid');
               e.preventDefault();
            } else if ($('#digit-2').val() == '') {
               $('#digit-2').addClass('box-invalid');
               e.preventDefault();
            } else if ($('#digit-3').val() == '') {
               $('#digit-3').addClass('box-invalid');
               e.preventDefault();
            } else if ($('#digit-4').val() == '') {
               $('#digit-4').addClass('box-invalid');
               e.preventDefault();
            } else if ($('#digit-5').val() == '') {
               $('#digit-5').addClass('box-invalid');
               e.preventDefault();
            } else if ($('#digit-6').val() == '') {
               $('#digit-6').addClass('box-invalid');
               e.preventDefault();
            } else {
               $('#digit-1,#digit-2,#digit-3,#digit-4,#digit-5,#digit-6').addClass('box-valid');
               $('#code').val($('#digit-1').val() + $('#digit-2').val() + $('#digit-3').val() + $('#digit-4').val() + $('#digit-5').val() + $('#digit-6').val());
               if ($('#code').val().length == 6) {
                  $.ajax({
                        url: '{{asset("/checkcode")}}',
                        type: 'POST',
                        data: {
                           _token: "{{csrf_token()}}",
                           code: $('#code').val(),
                           email: '{{$_GET["email"] ?? ""}}',
                           mobile: '{{$_GET["mobile"] ?? ""}}'
                        },
                     })
                     .done(function(data) {
                        if (data == 1) {
                           $('#digit-1, #digit-2, #digit-3, #digit-4, #digit-5, #digit-6').removeClass('box-invalid');
                           $('#digit-1, #digit-2, #digit-3, #digit-4, #digit-5, #digit-6').addClass('box-valid');
                           $('form').submit();
                        } else {
                           $('#digit-1, #digit-2, #digit-3, #digit-4, #digit-5, #digit-6').removeClass('box-valid');
                           $('#digit-1, #digit-2, #digit-3, #digit-4, #digit-5, #digit-6').addClass('box-invalid');
                           $('#digit-1, #digit-2, #digit-3, #digit-4, #digit-5, #digit-6, #code').val('');
                           e.preventDefault();
                        }
                     })
                     .fail(function() {
                        console.log("error");
                     });
         
               } else {
                  e.preventDefault();
               }
         
            }
         }
      </script>

      <script>
         $(document).on('click', '#start-test', function () {

            var is_terms_selected = $('#start-test').is(':checked');

            if(is_terms_selected) {
               $('#start_test_btn').removeClass('disabled');
            } else {               
               $('#start_test_btn').addClass('disabled');
            }

         });
      </script>
   </body>
</html>