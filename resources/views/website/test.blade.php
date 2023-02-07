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
      
      <meta name="_token" content="{{csrf_token()}}" />

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
      <link rel="stylesheet" href="{{ asset('public/website/assets/css/responsive.css') }}">
      
      
      <!-- sweet alert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.6/dist/sweetalert2.all.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.6/dist/sweetalert2.css">

      @include('website/layouts/website_theme')

      <style>
         .test-question-box-h {
         height: calc(100vh - 383px);
         }
         p {
            overflow-wrap: anywhere;
         }
      </style>
   </head>
   <body class="pt-0">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 text-header h-80px shadow">
               <div class="row h-100 align-items-center">
                  <div class="col-12">
                     <div class="row align-items-center">
                        <div class="col-auto">
                           <div class="row">
                              <div class="col">
                                 <a href="{{ action('Website\IndexController@index') }}"><img src="{{ asset('public/website/assets/img/site_logo1.png') }}" alt="logo" class="h-50px"></a>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="row">
                              <div class="col text-center font-weight-bold text-gray text-uppercase fs-lg-18 fs-md-16 fs-14">
                                   @if(!empty($paper->image))
                                  <img src="{{ asset('public/question_paper_subjects/'.$paper->image) }}" class="w-4">
                                   @endif
                                  {{$paper->name}}</div>
                           </div>
                        </div>
                        <div class="col-auto">
                           <div class="row">
                              <div class="dropdown col-auto btn-group dropleft">
                                 <a class="btn btn-secondary dropdown-toggle border-0 shadow-none" href="javascript:;" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span>
                                 <i class="fas fa-user-circle"></i>
                                 </span>
                                 </a>
                                 <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item py-2" href="{{ action('Website\StudentProfileController@student_profile') }}">Profile</a>
                                    <a class="dropdown-item py-2" href="{{ action('Website\IndexController@index') }}">Go to Home</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 test-body">
               <div class="row h-100">
                  <div class="col-12 h-100">
                    <div class="row mx-0 mt-4 d-md-none d-block">
                        <div class="col-12 border test-times">
                          <div class="row text-center font-weight-bold fs-17 py-1 align-items-center">
                            <div class="col">
                                <div class="row">
                                  <div class="col hour">00</div>
                                </div>
                                <div class="row">
                                  <div class="col fs-10 text-gray">Hours</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                  <div class="col minute">00</div>
                                </div>
                                <div class="row">
                                  <div class="col fs-10 text-gray">Minutes</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                  <div class="col second">00</div>
                                </div>
                                <div class="row">
                                  <div class="col fs-10 text-gray">Seconds</div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div> 
                     <div class="row h-100"> 
                        <div class="col test-body-left py-3 h-100" id="question">
                           <!-- question will go over here -->
                        </div>
                        <div class="col-xl-auto col-lg-4 test-body-right py-md-3 pb-3 pt-0 pl-lg-0 h-100">
                           <div class="row mx-0 h-100 overflow-hidden d-block">
                              <div class="col-12">
                                 <div class="row">
                                    <div class="col-12 border test-times d-md-block d-none">
                                       <div class="row text-center font-weight-bold fs-17 py-1 align-items-center">
                                          <div class="col">
                                             <div class="row">
                                                <div class="col hour">00</div>
                                             </div>
                                             <div class="row">
                                                <div class="col fs-10 text-gray">Hours</div>
                                             </div>
                                          </div>
                                          <div class="col">
                                             <div class="row">
                                                <div class="col minute">00</div>
                                             </div>
                                             <div class="row">
                                                <div class="col fs-10 text-gray">Minutes</div>
                                             </div>
                                          </div>
                                          <div class="col">
                                             <div class="row">
                                                <div class="col second">00</div>
                                             </div>
                                             <div class="row">
                                                <div class="col fs-10 text-gray">Seconds</div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-12 shadow border test-questions-box mt-2">
                                       <div class="row py-1 align-items-center">
                                          <div class="col-12">
                                             <div class="row">
                                                <div class="col-12 font-weight-bold fs-15 h-40px d-grid align-items-center bg-light border-bottom">
                                                   {{ $paper->name }}
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 mb-2 overflow-auto test-question-box-h">
                                             <div class="row">
                                                <div class="col-12">
                                                   <div class="row row-cols-7 mx-n2">
                                                      
                                                      @if( !empty($question_answers) )
                                                         
                                                         @php
                                                            $i = 1;
                                                         @endphp

                                                         @for($j = 0; $j < count($question_answers); $j++)

                                                            @php
                                                               $current_question = $question_answers[$j]->id;
                                                            @endphp

                                                            <div class="col text-center py-2 px-0">
                                                               <a href="javascript:;" class="btn border p-0 mx-auto rounded-pill fs-md-14 fs-12 w-35px h-35px d-grid align-items-center justify-content-center change_question
                                                               @if( !empty($test) )
                                                                  @if( !empty($test[$current_question][0]) )
                                                                     
                                                                     @if($test[$current_question][0]->status == 'save_and_review')
                                                                        save_and_remark
                                                                     @endif

                                                                     @if($test[$current_question][0]->status == 'review')
                                                                        btn-orange
                                                                     @endif

                                                                     @if($test[$current_question][0]->status == 'save')
                                                                        btn-danger
                                                                     @endif

                                                                     @if($test[$current_question][0]->status == 'save_and_next')
                                                                        btn-success
                                                                     @endif                

                                                                  @endif
                                                               @endif
                                                               " data-id="{{$question_answers[$j]->id}}" data-next_id="{{$question_answers[$j + 1]->id ?? ''}}"
                                                               onclick="question('{{ $question_answers[$j]->id }}', '{{ $question_answers[$j + 1]->id ?? ''}}')"
                                                               >{{$i}}</a>
                                                            </div>
                                                               
                                                            @php
                                                               $i += 1;
                                                            @endphp

                                                         @endfor
                                                      @endif
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 test-finish-btn">
                                             <div class="row">
                                                <div class="col-12 py-1">
                                                   <a href="javascript:;" class="btn btn-danger d-block py-1 fs-md-15 fs-14 text-capitalize"
                                                   onClick="return attempts()"
                                                   ><i class="far fa-lock"></i> <span class="ml-1">Exam Finish</span></a>
                                                </div>
                                                <div class="col-12 py-1">
                                                   <a href="javascript:;" data-toggle="modal" data-target="#instruction" class="btn btn-info d-block py-1 fs-md-15 fs-14 text-capitalize"><i class="fal fa-question"></i> <span class="ml-1">instruction</span></a>
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
            </div>
            <div class="col-12 text-footer h-lg-60px shadow border-top">
               <div class="row h-100 align-items-center">
                  <div class="col-12">
                     <div class="row align-items-center py-md-0 py-1">
                        <div class="py-lg-0 py-md-2 py-1 col-lg-auto fs-md-14 fs-13 text-center text-gray">Copyright &copy; 2021 <b>CoachingSelect</b></div>
                        <div class="py-lg-0 py-md-2 py-1 col fs-14 text-center text-gray"><b>Date & Time </b> <span id="current_date_time">
                        </span> </div>
                        <div class="py-lg-0 py-md-2 py-1 col-lg-auto fs-md-14 fs-13 text-center text-gray"><b>Powered by</b> <a target="_blank" href="{{ action('Website\IndexController@index') }}" class="text-decoration-none font-weight-bold">coachingselect.com</a></div>
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
      
      </script>
   </body>
</html>
<div class="modal fade exam_finish" id="exam_finish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header text-center bg-light shadow">
            <h5 class="modal-title w-100 fs-md-18 fs-15 text-uppercase" id="exampleModalLabel">Your Attempts</h5>
            <button type="button" class="close position-absolute bg-light border shadow text-wite right-30px rounded-pill fs-20 w-25px h-25px p-0 d-flex justify-content-center align-items-center font-weight-normal top-32px" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <div class="exam_attemped">
               <div class="row">
                  <div class="col-6">
                     <div class="row d-inline-flex align-items-center mx-0 bg-green rounded py-0 px-0">
                        <div class="col-auto pl-1 pr-2">
                           <h3 class="fs-md-13 fs-11 mb-0 text-white">Total Attempted:</h3>
                        </div>
                        <div class="col-auto pr-1  pl-0">
                           <span class="fs-md-13 fs-11 text-white" id="total_attempted">12</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 text-right">
                     <div class="row mx-0 d-inline-flex align-items-center bg-primary rounded py-0 px-0">
                        <div class="col-auto pl-1 pr-2">
                           <h3 class="fs-md-13 fs-11 mb-0 text-white">Not Attempted:</h3>
                        </div>
                        <div class="col-auto pr-1 pl-0">
                           <span class="fs-md-13 fs-11 text-white" id="not_attempted">18</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mt-md-5 mt-4">
                  <div class="col-12">
                     <table class="table">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">Q NO.</th>
                              <th scope="col">Status</th>
                              <th scope="col">Q NO.</th>
                              <th scope="col">Status</th>
                              <th scope="col">Q NO.</th>
                              <th scope="col">Status</th>
                              <th scope="col">Q NO.</th>
                              <th scope="col">Status</th>
                           </tr>
                        </thead>
                        <tbody id="attempts">
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row border-top shadow bg-light mt-4 pt-3 pb-3">
                  <div class="col-6 text-left">
                     @php
                        $slug = str_replace(' ', '-', $paper->name);
                     @endphp
                  
                     <form id="test_submit" method="post"
                     action="{{ action('Website\FreePreparationToolController@test_submit', [$paper->course_id, $slug]) }}"
                     >
                        @csrf
                     </form>
                     <a class="btn btn-danger d-inline-block py-1 mt-0 fs-md-14 fs-12 text-capitalize" 
                        href="javascript:;"
                        @if( session()->has('student') )
                           onclick="return confirmation('test_submit', 'Are you sure?')"
                        @endif
                     ><span class="">Submit</span></a>
                  </div>
                  <div class="col-6 text-right">
                     <a href="javascript:;" data-dismiss="modal" class="btn btn-danger d-inline-block py-1 mt-0 fs-md-14 fs-12 text-capitalize"><span class="">Close</span></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade instruction" id="instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-body bg-light border rounded">
            <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
            <div class="instruction_content position-relative row mx-0 shadow rounded bg-white p-3 mt-4">
               <div class="col-12 text-md-center text-start mt-3">
      
               <span class="bg-secondary px-2 py-1 fs-md-13 fs-12 rounded mt-md-3 mt-5 d-inline-flex">{{$paper->name}}</span>
               </div>
               <div class="col-auto position-absolute right-md-0 right-0 left-md-auto left-0 top-0">
                  <div class="row timer-box align-items-center bg-secondary shadow py-2">
                     <div class="col-auto">

                        @php

                           $image = asset('public/user.png');

                           if( session()->has('student') ) {
                              $image = session()->get('student')->image;
                           }

                           if(! @GetImageSize($image) ) {
                              $image = asset('public/user.png');
                           }

                        @endphp

                        <span class="d-flex align-items-center w-50px h-50px justify-content-center border rounded-pill p-0"><img class="img-fluid rounded-pill h-40px border shadow" src="{{$image}}" alt=""></span>
                     </div>
                     <div class="col pl-0">
                        <div id="timer" class="fs-13 d-flex ">
                           <p class="fs-13 mr-1 mb-0">Time Left </p>
                           <strong id="minutes" class="d-block hour">00</strong>
                           <span class="d-inline-block mx-1">:</span>
                           <strong id="minutes" class="d-block minute">00</strong>
                           <span class="d-inline-block mx-1">:</span>
                           <strong id="seconds" class="d-block second">00</strong>
                        </div>
                        <span class="fs-14">
                           @if( session()->has('student') )
                              {{ session()->get('student')->name }}
                           @endif
                        </span>
                     </div>
                  </div>
               </div>
               <div class="col-12 my-md-4 my-3 px-md-3 px-0">
                     <div class="row">
                        <div class="col-12 mb-md-3 mb-2 fs-md-18 fs-15 text-secondary font-weight-bold">General Instructions :</div>
                        <div class="col-12">
                           <ul class="list_count list_count pl-4 mb-4 fs-md-16 fs-13">
                              <li class="">
                                 <p class="fs-md-15 fs-13">
                                 You have {{ $paper->hours }} hours {{ $paper->minutes }} minutes to complete the test.</p>
                              </li>
                              <li class="">
                                 <p class="fs-md-15 fs-13">
                                 There are total {{ $paper->total_questions }} questions in this exam.
                                 </p>
                              </li>
                              <li class="">
                                 <p class="fs-md-15 fs-13">A countdown timer at the top right corner of your screen will display the time remaining for you to complete the exam. When the clock runs out, the exam ends by default - you are not required to end or submit your exam.</p>
                              </li>
                              <li class="">
                                 <p class="fs-md-15 fs-13">The question palette at the right of the screen shows one of the following statuses of each of the questions numbered:</p>
                                 <ul class="list-unstyled">
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-md-14 fs-12 bg-light border shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-0 d-flex align-items-center ml-2 w-90">You have not visited the question yet.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-md-14 fs-12 bg-red shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-0 d-flex align-items-center ml-2 w-90">You have not answered the question.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-md-14 fs-12 bg-success shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-0 d-flex align-items-center ml-2 w-90">You have answered the question.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-md-14 fs-12 bg-orange shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-0 d-flex align-items-center ml-2 w-90">You have NOT answered the question but have marked the question for review.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class=" position-relative rounded-pill fs-md-14 fs-12 bg-orange shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fas fa-hand-point-right"></i>
                                       <span class="fs-14 position-absolute top-n5px right-n2px"><i class="fas fa-check text-success font-weight-bold"></i></span>  </a> 
                                       <p class="fs-md-15 fs-13 mb-0 d-flex align-items-center ml-2 w-90">You have answered the question but marked it for review.</p>
                                    </li>
                                    <li class="d-flex aligh-items-start mb-2">
                                       <a href="javascript:;" class="rounded-pill fs-md-14 fs-12 bg-blue shadow h-30px w-30px d-flex align-items-center justify-content-center"><i class="fad fa-hand-point-right"></i></a> 
                                       <p class="fs-md-15 fs-13 mb-0 d-flex align-items-center ml-2 w-90">The current question that you are on.</p>
                                    </li>
                                 
                                 </ul>
                              </li>
                           </ul>
      
                        </div>
                     </div>
                  </div>
                  <div class="col-12 my-2">
                     <div class="row">
                        <div class="col-12 mb-md-3 mb-2 fs-md-18 fs-15 text-secondary font-weight-bold">Question Paper Instructions :</div>
                        <div class="col-12">
                           {!! $paper->description ?? '' !!}
                           <ul class="list_count list_count pl-4 mb-4 d-none">
                              <li class="">
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- prevent go back after submit -->
<script type="text/javascript">
    if(!!window.performance && window.performance.navigation.type == 2)
   {
      window.location.reload();
   }
</script>

<script>
// Set the date we're counting down to

   @if( !empty($timer) )
   var h = "{{ $timer->hours ?? 00 }}";
   var m = "{{ $timer->minutes ?? 00 }}";
   var s = "{{ $timer->seconds ?? 00 }}";
   @else 
   var h = "{{ $paper->hours ?? '' }}";
   var m = "{{ $paper->minutes ?? '' }}";
   var s = 00;
   @endif

   var x;
     
   function timer(hours, minutes, seconds) {
      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@timer') }}",
         dataType: "JSON",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            question_paper_subject_id: '{{ $paper->id }}',
            hours: hours,
            minutes: minutes,
            seconds: seconds
         },
         success: function (data) {
                       
            if(data) {
               h = data.hours;
               m = data.minutes;
               s = data.seconds;

               if((h == 00)&&(m == 00)&&(s==00)&&(h == 0)&&(m == 0)&&(s==0)){
                  clearInterval(x);
                  
                  swal.fire({
                     title: "Alert!",
                     text: "Time Over.",
                     allowOutsideClick: false
                     }).then((result) => {
                     if (result.isConfirmed) {
                        $('#test_submit').submit();
                     }
                  });

               }else if((m == 00)&&(s==00)){
                  h = h - 01;
                  m = 59;
                  s = 59;
               }else if((s==00)){
                  m = m - 01;
                  s = 59;
               }else{
                  s = s - 01;
               }

               $('.hour').text(h > 9 ? h : 0 + '' + h);
               $('.minute').text(m > 9 ? m : 0 + '' + m);
               $('.second').text(s > 9 ? s : 0 + '' + s);   
            
            }

         }
      });
   }

   x = setInterval(function() {
      timer(h, m, s);

   }, 1000);
 
</script>

<script>

   // show current time

   var y = setInterval(function() {
      $('#current_date_time').text(
         new Date().toLocaleString('en-us',{month:'long', year:'numeric', day:'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'})
      );
   }, 1000);
</script>

<script>
   function question_number(current_question_id) {

      $('a[data-id]').each(
         function() {
            
            if( $(this).data('id') == current_question_id ) {
               $('#question_number').text(
                  $(this).text()
               );

               if($(this).text() == '1') {
                  $('#prev_button').attr('style','display:none !important');

               } else {
                  $('#prev_button').removeAttr('style');

               }
            }

         }
      )
   }

   question_number('{{ $question_answers[0]->id ?? "" }}');
</script>

<script>

   function question(current_question_id, next_question_id, clicked = 0) {
      
      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@question') }}",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            question_paper_subject_id: '{{ $paper->id }}',
            current_question_id, 
            next_question_id
         },
         success: function (data) {
            
            if(data) {
               $('#question').html(data);
            }

            question_number(current_question_id);
            
            mark_as_active(current_question_id);

         }
      });
   }

   question('{{ $question_answers[0]->id ?? "" }}', '{{ $question_answers[1]->id ?? "" }}');
</script>

<script>
   function mark_as_review(current_question_id, next_question_id) {

      var option = Array();

      $('input[name="question_option"]:checked').each(function(){
         option.push($(this).val());
      });

      option = option.join(',');

      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@mark_as_review') }}",
         dataType: "JSON",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            question_paper_subject_id: '{{ $paper->id }}',
            question_answer_id: current_question_id,
            option
         },
         success: function (data) {

            var modals = [];

            if(data) {

               if(option != undefined && option != '') {
                  update_status(current_question_id, 'save_and_review');
               } else {                  
                  update_status(current_question_id, 'review');
               }

               if(next_question_id == '') {
               } else {

                  // next question
                  current_question_id = next_question_id;

                  next_question(current_question_id);
               }

               swal.queue(modals);
               
            } else {
               window.location.href = '{{ action("Website\IndexController@index") }}';
            }
         }
      });
   }
</script>

<script>

   function next_question(current_question_id) {

      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@next_question') }}",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            paper_id: "{{ $paper->id }}",
            current_question_id
         },
         success: function (data) {
                  
            var next_question_id = data;

            question(current_question_id, next_question_id);
            
         }
      });
   }
</script>

<script>
   function reset_answer(current_question_id, next_question_id) {
      
      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@reset_answer') }}",
         dataType: "JSON",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            question_paper_subject_id: '{{ $paper->id }}',
            question_answer_id: current_question_id,
         },
         success: function (data) {

            var modals = [];

            if(data) {

               update_status(current_question_id, 'reset');               

               swal.queue(modals);

               question(current_question_id, next_question_id);
               
            } else {
               window.location.href = '{{ action("Website\IndexController@index") }}';
            }
         }
      });
   }
</script>

<script>

   function previous_question(current_question_id) {

      var option = Array();

      $('input[name="question_option"]:checked').each(function(){
         option.push($(this).val());
      });

      option = option.join(',');

      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@previous_question') }}",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            paper_id: "{{ $paper->id }}",
            current_question_id,
            option,
            question_paper_subject_id: '{{ $paper->id }}',
            question_answer_id: current_question_id
         },
         success: function (data) {
                  
            var previous_question_id = data;

            if(option != undefined && option != '') {
                  update_status(current_question_id, 'save_and_next');
               } else {                  
                  update_status(current_question_id, 'save');
               }

            question(previous_question_id, current_question_id);
            
         }
      });
   }
</script>


<script>
   function save_and_next(current_question_id, next_question_id) {
      
      var option = Array();

      $('input[name="question_option"]:checked').each(function(){
         option.push($(this).val());
      });

      option = option.join(',');
      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@save_and_next') }}",
         dataType: "JSON",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            question_paper_subject_id: '{{ $paper->id }}',
            question_answer_id: current_question_id,
            option
         },
         success: function (data) {

            var modals = [];

            if(data) {   
               
               if(option != undefined && option != '') {
                  update_status(current_question_id, 'save_and_next');
               } else {                  
                  update_status(current_question_id, 'save');
               }

               if(next_question_id == '') {
                  
                  if(option != undefined) {
                  }
               } else {

                  // next question
                  current_question_id = next_question_id;

                  next_question(current_question_id);
               }

               swal.queue(modals);
               
            } else {
               window.location.href = '{{ action("Website\IndexController@index") }}';
            }
         }
      });
   }
</script>

<script>
   function update_status(current_question_id, event) {

      $('a[data-id]').each(
         function() {
            
            if( $(this).data('id') == current_question_id ) {

               // remove all the previous class or events
               $(this).removeClass('save_and_remark');                  
               $(this).removeClass('btn-orange');
               $(this).removeClass('btn-danger');
               $(this).removeClass('btn-success');
               
               if(event == 'save_and_review') {
                  $(this).addClass('save_and_remark');
               }
               
               if(event == 'review') {
                  $(this).addClass('btn-orange');
               }
               
               if(event == 'save') {
                  $(this).addClass('btn-danger');
               }
               
               if(event == 'save_and_next') {
                  $(this).addClass('btn-success');
               }
               
            }

         }
      )
   }
</script>

<script>
   function mark_as_active(current_question_id) {

      $('a[data-id]').each(
         function() {
            var total = {{$paper->total_questions}};

            // if last question don't show as active
            if({{ $question_answers[count($question_answers) - 1]->id ?? "" }} != current_question_id) {
               
               if( $(this).data('id') == current_question_id && total >= 2) {
                  $(this).addClass('btn-blue'); 
               } else {
                  $(this).removeClass('btn-blue'); 
               }
            } else {
               $(this).removeClass('btn-blue'); 
            }

         }
      )
   }
</script>

<script>
   function attempts() {
      
      $.ajax({
         url: "{{ action('Website\FreePreparationToolController@attempts') }}",
         dataType: "JSON",
         method: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            question_paper_subject_id: '{{ $paper->id }}',
         },
         success: function (data) {

            if(data) {

               var attempts = '<tr>';
               var i = 1;
               var j = 1;

               for (const question_answer in data.question_answers) {
                  if (Object.hasOwnProperty.call(data.question_answers, question_answer)) {
                     const question = data.question_answers[question_answer];


                     if(question) {

                        var padding = '';

                        if(
                           question.attempt.split(',').length >= 2
                        ) {
                           padding = 'px-' + question.attempt.split(',').length;
                        }

                        if(question.attempt != '') {
                           attempts += `                                 
                              <td><strong class="fs-14">${j}</strong></td>
                              <td> <span class="bg-success fs-13 h-25px w-25px d-flex align-items-center justify-content-center rounded-pill mx-auto ${padding}">${question.attempt}</span></td>
                           `;                        
                        } else {
                           attempts += `                                 
                              <td><strong class="fs-14">${j}</strong></td>
                              <td> <span class="bg-danger fs-13 h-25px w-25px d-flex align-items-center justify-content-center rounded-pill mx-auto ${padding}">${question.attempt}</span></td>
                           `;
                        } 
                        
                        if(i == 4) {
                           attempts += `
                              </tr>
                              <tr>
                           `;

                           i = 0;
                        } 
                     }

                     i += 1;
                     j += 1;
                     
                  }
               }
         
               $('#attempts').html(attempts);
               $('#total_attempted').text(data.total_attempted);
               $('#not_attempted').text(data.not_attempted);
               $('#exam_finish').modal('show');

            } else {
               window.location.href = '{{ action("Website\IndexController@index") }}';
            }
         }
      });
   }
</script>

<script>
   function confirmation(form, msg) {
      // sweet alert
      const swalWithBootstrapButtons = Swal.mixin({
         customClass: {
            confirmButton: 'btn btn-sm btn-success ml-2',
            cancelButton: 'btn btn-sm btn-danger'
         },
         buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
         title: msg,
         text: "You won't be able to revert this!",
         icon: 'success',
         showCancelButton: true,
         confirmButtonText: 'Yes',
         cancelButtonText: 'No',
         reverseButtons: true
      }).then((result) => {
         if (result.isConfirmed) {
            
            window.history.replaceState({}, 'foo', "{{ action('Website\IndexController@index') }}");

            document.getElementById(form).submit();

         } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
         ) {

            return false;
         }
      })
   }

</script>

<script>

   var how_many_times_did_cheeting = 0;

   $(document).ready(
      function() {
         $(window).blur(

            function() {

               how_many_times_did_cheeting += 1;

               if(how_many_times_did_cheeting == 5) {

                  setTimeout(
                     function() {
                     },
                     3000
                  );
                  
               } 
            }
         );
      }
   );

</script>
