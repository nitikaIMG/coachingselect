@include('website/layouts/header')

<style>
   .btn-bg-white::after {
   background-color: hsl(var(--color-white)) !important;
   }

   .btn-bg-white:hover {
   color: hsl(var(--color-primary));
   }
</style>

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner">
      <div class="container position-relative z-index-2">
         @php
         
            $years = $years->sort();
            $years = $years->filter();
            
         @endphp

         <div class="text-md-left text-center">
            <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">Free Study Material &  {{ $stream ?? ''}} Exam Papers</h2>
            <p class="fs-md-16 fs-14 text-white mb-md-2 mb-3">
            Attempt or Download  
            
            @if($years->first() != $years->last())
               {{ $years->first() }} - {{ $years->last() }}
            @else 
               {{ $years->first() }}
            @endif

            {{$course_name ?? ''}} Question Papers</p>
         </div>
         <div class="question_select_year">

            @php
               $search_year = '';

               if( !empty($_GET['year']) ) {
                  $search_year = $_GET['year'];
               }
               
               /*
               $stream_id = '';

               if( !empty($_GET['stream_id']) ) {
                  $stream_id = $_GET['stream_id'];
               }
               */
               
               $course_id = '';

               if( !empty($_GET['course_id']) ) {
                  $course_id = $_GET['course_id'];
               }

            @endphp

            <form>
               <select name="year" id="year" title="" class="selectpicker show-tick" data-width="auto" data-container="body" data-live-search="true" placeholder=""
               onchange="this.form.submit()"
               >
                  <option value="" selected="">Year </option>

                  @if( !empty($years) )
                     @foreach($years as $year)
                        @if( !empty($year) )
                           <option 
                              value="{{$year}}"
                              
                              @if($year == $search_year)
                                 selected
                              @endif
                           >{{$year}}</option>
                        @endif
                     @endforeach
                  @endif
               </select>

               <select name="course_id" id="course_id" title="" class="selectpicker show-tick" data-width="auto" data-container="body" data-live-search="true" placeholder=""
               onchange="this.form.submit()"
               >
                  <option value="" disabled selected>Select Exam</option>
                  
                  @if( !empty($courses) )
                     @foreach($courses as $course)
                     <option value="{{$course->id}}"
                        @if($course->id == $course_id)
                           selected
                        @endif
                     >{{$course->name}}</option>
                     @endforeach
                  @endif
               </select>

               <input type="hidden" name="stream_id" id="stream_id" value="{{$stream_id}}">
            </form>
         </div>
      </div>
   </section>
   <!-- inner banner section  -->
   <div class="question_detailss_sec pt-5">
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-12 mb-md-0 mb-3">
               <div class="detailss_sec_box row align-items-stretch rounded mx-0">
                  <div class="col-lg-3 col-md-5 col-3 px-2 d-flex align-items-center text-center justify-content-center border-right-dashded">
                     <span class="fs-lg-18 fs-md-15 fs-14 text-secondary d-flex align-items-center justify-content-center bg-white h-md-60px h-40px w-md-60px w-40px rounded-pill" data-from="0" 
                     data-toggle="counter-up"
                     data-to="{{ count($question_paper_subjects) }}"
                     data-speed="1000" 
                     class="num">
                     {{ count($question_paper_subjects) }}
                     </span>
                  </div>
                  <div class="col-lg-9 col-md-7 col-6 d-flex align-items-center py-md-4 py-3">
                     <h2 class="mb-0 fs-lg-25 fs-md-18 fs-16 py-2 text-white">Papers</h2>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-12 mb-md-0 mb-3">
               <div class="detailss_sec_box row align-items-stretch rounded mx-0">
                  <div class="col-lg-3 col-md-5 col-3 px-2 d-flex align-items-center text-center justify-content-center border-right-dashded">
                     <span class="fs-lg-18 fs-md-15 fs-14 text-secondary d-flex align-items-center justify-content-center bg-white h-md-60px h-40px w-md-60px w-40px rounded-pill" data-from="0"
                     data-toggle="counter-up" 
                     data-to="{{$hours}}" 
                     data-speed="1000" class="num">
                     {{$hours}}
                     </span>
                  </div>
                  <div class="col-lg-9 col-md-7 col-6 d-flex align-items-center py-md-4 py-3">
                     <h2 class="mb-0 fs-lg-25 fs-md-18 fs-16 py-2 text-white">Hours</h2>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-12 mb-md-0 mb-3">
               <div class="detailss_sec_box row align-items-stretch rounded mx-0">
                  <div class="col-lg-3 col-md-5 col-3 px-2 d-flex align-items-center text-center justify-content-center border-right-dashded">
                     <span class="fs-lg-18 fs-md-15 fs-14 text-secondary d-flex align-items-center justify-content-center bg-white h-md-60px h-40px w-md-60px w-40px rounded-pill" 
                     data-from="0" data-toggle="counter-up" 
                     data-to="{{$total_questions}}" 
                     data-speed="1000" class="num">
                     {{$total_questions}}
                     </span>
                  </div>
                  <div class="col-lg-9 col-md-7 col-6 d-flex align-items-center py-md-4 py-3">
                     <h2 class="mb-0 fs-lg-25 fs-md-18 fs-16 py-2 text-white">Questions</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="question_main_sec pt-lg-4 pt-md-0 pt-0 pb-md-5 pb-5">
      <div class="container">
         <div class="row">
            <div class="col-lg-8">
               <div class="row d-none">
                  <div class="col-12">
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
               </div>
               <div class="row">
                  <input type="hidden" name="total_questions" id="total_questions" value="{{ count($question_paper_subjects) }}">
                  @if( !empty($question_paper_subjects->toArray()) )
                     @foreach($question_paper_subjects->sortByDesc('year') as $question_paper_subject)
                        <div class="col-md-6 mt-lg-5 mt-md-4 mt-4 load_more_outer2">
                           <div class="question_main_box_top rounded bg-light d-block text-center py-4 h-100">
                              <span class="">
                                 <img class="" 
                                 src="{{ asset('public/website/') }}/assets/img/question-papers_box.png"
                                 alt="{{ basename( asset('public/website/assets/img/question-papers_box.png') ) }}"
                                 >
                              </span>
                              <div class="py-2 bg-primary my-3">
                                 <h3 class="text-white fs-md-15 fs-14 mb-0 mt-1">
                                    {{$question_paper_subject->name}}
                                 </h3>
                                 <p class="fs-13 mb-1 mt-1 d-none">
                                    {{date('d F Y', strtotime($question_paper_subject->created_at) )}}
                                 </p>
                              </div>
                              <div class="row justify-content-center">
                              
                                 @if(! empty($question_paper_subject->year))
                                 <div class="col-auto px-md-2 px-1 text-center">
                                    <span class="px-md-3 px-2 py-1 rounded fs-md-13 fs-12 text-white bg-secondary">
                                       {{$question_paper_subject->year}}
                                    </span>
                                 </div>
                                 @endif
                                 
                                 @if(! empty($question_paper_subject->total_questions))
                                 <div class="col-auto px-md-2 px-1 text-center">
                                    <span class="px-md-3 px-2 py-1 rounded fs-md-13 fs-12 text-white bg-secondary">
                                    {{$question_paper_subject->total_questions}}
                                     Questions</span>
                                 </div>
                                 @endif
                                 
                                 @if( (isset($question_paper_subject->hours) or isset($question_paper_subject->minutes)) 
                                 # and !empty($question_paper_subject->total_questions)
                                 )
                                 <div class="col-auto px-md-2 px-1 text-center">
                                    <span class="px-2 py-1 rounded fs-12 text-white bg-secondary">
                                    @if(!empty($question_paper_subject->hours) )
                                    {{$question_paper_subject->hours}}
                                     hours
                                    @endif 
                                    @if(!empty($question_paper_subject->minutes) )
                                    {{$question_paper_subject->minutes}}
                                     minutes
                                    @endif
                                    </span>
                                 </div>
                                 @endif
                              </div>

                              @php
                                 $slug = str_replace(' ', '-', $question_paper_subject->name);
                              @endphp

                              <div class="row mx-0 mt-4 px-2">
                                 
                                 @if(
                                    $question_paper_subject->total_questions >= 1
                                 )
                                 <div class="see_all col px-2 text-right">
                                    <a class="btn btn-sm btn-green border border-primary fs-md-13 fs-11 rounded d-flex align-items-center w-100 h-md-40px h-35px justify-content-center" 
                                    
                                    @if(session()->has('student'))
                                       
                                       @if($question_paper_subject->is_test_attempted_by_me and $question_paper_subject->is_test_attempted_by_me_submitted)
                                          href="{{ action('Website\FreePreparationToolController@test_result', [$question_paper_subject->course_id, $slug]) }}"
                                       @elseif($question_paper_subject->is_test_attempted_by_me and ! ($question_paper_subject->is_test_attempted_by_me_submitted) )
                                          href="{{ action('Website\FreePreparationToolController@instructions', [$question_paper_subject->course_id,$slug]) }}"
                                       @else 
                                          href="{{ action('Website\FreePreparationToolController@instructions', [$question_paper_subject->course_id,$slug]) }}"
                                       @endif

                                       href="{{ action('Website\FreePreparationToolController@instructions', [$question_paper_subject->course_id,$slug]) }}"
                                    @else 
                                       data-toggle="modal" data-target="#exampleModal1" href="#"
                                    @endif   
                                    >
                                    <span> 
                                       @if($question_paper_subject->is_test_attempted_by_me and $question_paper_subject->is_test_attempted_by_me_submitted)
                                          See Test Result
                                       @elseif($question_paper_subject->is_test_attempted_by_me and ! ($question_paper_subject->is_test_attempted_by_me_submitted) )
                                          Resume Test
                                       @else 
                                          Start Test
                                       @endif
                                    </span> </a>
                                 </div>
                                 @endif

                                 @if( !empty($question_paper_subject->brochure_or_pdf) )
                                 <div class="see_all col px-2 text-right">
                                    <a class="btn btn-sm btn-outline-secondary fs-md-13 fs-11 rounded d-flex align-items-center w-100 h-md-40px h-35px justify-content-center" 

                                    @if( !empty($question_paper_subject->brochure_or_pdf) )
                                       download
                                       href='{{asset("public/question_paper_subjects/".$question_paper_subject->brochure_or_pdf)}}'
                                    @else 
                                       href="#"
                                    @endif
                                    ><i class="fad fa-arrow-to-bottom mr-2"></i> <span> Download PDF</span> </a>
                                 </div>
                                 @endif
                              </div>
                           </div>                        
                        </div>
                     @endforeach    
                        
                     @if( $question_paper_subjects->count() >= 9 )
                     <div class="col-12 seemore text-center mt-5 seevideoss">
                        <a class="load-more2 rounded-pill m-auto d-inline-flex fs-22 text-white align-items-center justify-content-center h-60px w-60px bg-primary font-weight-bold text-decoration-none shadow" href="javascript:;"><i class="fas fa-chevron-down"></i></a>
                     </div>       
                     @endif          
                  @else 
                     <div class="col-12 d-flex justify-content-center my-5">
                        <h1 class="text-danger text-center">No Question Papers Found</h1>
                     </div>
                  @endif

               </div>
               <div class="row overflow-hidden">
                  <div class="col-12 mt-3">
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
               </div>
            </div>
            <div class="col-lg-4">
               <div class="row bg-white shadow rounded border mx-0 mb-3">
                  
               </div>
               <div class="row mb-3 position-sticky top-100px">
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
   </div>
</main>

@include('website/layouts/footer')

<script>
   $(document).ready(function () {
      $(".load_more_outer2").slice(0, 8).show();
      var i=1;
      $(".load-more2").on("click", function (e) {
         e.preventDefault();
         var total_questions= $('#total_questions').val();
         var ttlqustions= Math.floor((total_questions-4)/4);
         $(".load_more_outer2:hidden").slice(0, 4).slideDown();
         if ($(".load_more_outer2:hidden").length == 0) {
         }
         if(ttlqustions==i){
            $('.seevideoss').hide();
         }
         i++;
      });
   });
</script>


<script>
    function stream_course() {
       
        $.ajax({
            type: 'POST',
            url: '{{action("ExamsController@stream_course")}}',
            data: {
                stream_id: $('#stream_id').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#course_id').html(
                    '<option value="">Select Course</option>'
                );

                data.forEach(element => {

                    var course_id = '{{$course_id}}';

                    var is_selected = '';
                    if (course_id == element.id) {
                        is_selected = 'selected';
                    }

                    $('#course_id').append(
                        '<option value="' + element.id + '" ' + is_selected + '>' + element.name + '</option>'
                    );
                });

                $('.selectpicker').selectpicker('refresh');

                if(is_selected != 'selected') {
                  $('.selectpicker').selectpicker('val', '');
                }
            }
        });

    }

    $(document).on('change', '#stream_id', function() {
    });
    
</script>

<script>
   $(document).ready(function () {
   });
</script>