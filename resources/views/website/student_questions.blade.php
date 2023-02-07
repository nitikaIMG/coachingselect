
@include('website/layouts/header')

<style>
   h2.text-graydark {
      white-space: pre-line;
   }
   
   p.text-gray {
      white-space: pre-line;
   }

   .ellipsis-5 {
      display: -webkit-box;
      -webkit-line-clamp: 5;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
   }
   @media (max-width: 1023px){
      .ask_que_expert a::before { 
         left: 0;
         top: -40px
      }

   }
</style>

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner">
      <div class="container position-relative z-index-2">
         <div class="text-center">
            <h1 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">
               Your Question matters to our Community!</h1>
         </div>
      </div>
   </section>
   <!-- inner banner section  -->
   <section id="question_to_experts" class="question_to_experts mt-4 overflow-unset">
      <div class="container">
         <div class="row align-items-start">
            <div class="col-lg-8 order-lg-0 order-md-1 order-1">
               <div class="row mx-0">
                  <div class="col-md-12">
                     <div class="row align-items-center justify-content-center shadow bg-secondary rounded p-2">
                        <div class="col-md-6 px-md-3 px-1 mb-md-0 mb-2">
                           <span class="fs-13">{{ count($student_questions) }} Questions</span>
                        </div>
                        <div class="col-md-6 px-md-3 px-1 text-right">
                           <form>
                              <div class="review_select_box d-flex justify-content-center">
                                 <select name="tab" id="exam" title="" class="selectpicker show-tick" data-width="auto" data-container="body" data-live-search="false" placeholder="" onchange="this.form.submit()">
                                    <option value="newest"
                                       @if( ($_GET['tab'] ?? '') == "newest" )
                                          selected
                                       @endif
                                    >Newest</option>
                                    <option value="popular"
                                       @if( ($_GET['tab'] ?? '') == "popular" )
                                          selected
                                       @endif
                                    >Most Popular</option>
                                    <option value="unanswered"
                                       @if( ($_GET['tab'] ?? '') == "unanswered" )
                                          selected
                                       @endif
                                    >Unanswered Questions</option>
                                 </select>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="row" id="box_to_load">
                        @if(! empty( $student_questions->toArray() ) )
                           
                           @php
                              $counter = 0;
                              $limit = 10;
                           @endphp

                           @foreach($student_questions as $student_question)
                              
                              @php
                                 $tags_initial = array();
                                 foreach(explode(',', $student_question->tags) ?? [] as $key=>$tag) {

                                    if( !empty($tag) ) {
                                       $new_tag_never_used = array();
                                       $new_tag_never_used['text'] = $tag;
                                       $new_tag_never_used['value'] = $tag;

                                       $tags_initial[] = $new_tag_never_used;
                                    }
                                 }

                                 $tags_initial = json_encode(json_decode(json_encode($tags_initial)));

                              @endphp

                              <div class="
                                 box_to_be_loaded
                                 @if($counter >= $limit)
                                    d-none
                                 @endif
                              col-md-12 col-12 mt-4">
                                 <div class="row rounded bg-white px-2 py-3 position-relative shadow rounded-15 border bg-card2 qna_box_outer">
                                    <div class="col-12">
                                       <div class="row align-items-center mr-md-0 justify-content-md-start justify-content-center">
                                          <div class="col-md-auto pr-md-0">
                                             <a href="#" data-toggle="modal" data-target="#profile_modal{{$student_question->id}}"
                                             class="d-flex align-items-center w-70px h-70px mx-auto justify-content-center border rounded-pill p-0">
                                             
                                             @php
                                                $image = $student_question->image;
                                                
                                                if(! @GetImageSize($image) ) {
                                                   $image = asset('public/user.png');
                                                }

                                             @endphp

                                             <img class="img-fluid rounded-pill h-60px border shadow" src="{{$image}}" alt=""></a>
                                          </div>
                                          <div class="col-md qna_box_col text-md-left text-center my-md-0 my-2">
                                             <a 
                                             data-toggle="modal" data-target="#profile_modal{{$student_question->id}}"
                                             class="text-primary d-block fs-md-18 fs-15 font-weight-bold" href="javascript:;">{{$student_question->student_name}}</a>
                                             <span class="fs-12 text-gray text-uppercase">{{ date('F d, Y', strtotime($student_question->created_at)) }}</span>
                                          </div>
                                           
                                        
                                          <form class="" action="{{ action('Website\StudentQuestionsAnswersController@report', $student_question->id) }}" method="post" id="report_form{{$student_question->id}}">
                                             @csrf
                                          </form>

                                          <a href="javascript:;"
                                             @if( session()->has('student') and !$student_question->reported_by_me)
                                               @php $sessiondata= session()->get('student');
                                               @endphp
                                               @if($sessiondata->id!=$student_question->user_id)
                                                onclick="return confirmation('report_form{{$student_question->id}}')"
                                                @endif
                                             @endif
                                             
                                             @if( ! session()->has('student') )
                                                data-toggle="modal" data-target="#exampleModal1"
                                             @endif
                                            @php $checkuser=false; @endphp
                                          @if( session()->has('student') )
                                          @php $sessiondata= session()->get('student');
                                               @endphp
                                             @if($sessiondata->id==$student_question->user_id)
                                                @php $checkuser= true; @endphp
                                             @endif
                                           @endif
                                          @if($checkuser==false)
                                          class="col-auto d-flex align-items-center fs-13 font-weight-bold rounded-pill 
                                          
                                          @if($student_question->reported_by_me)
                                          border-primary 
                                          bg-primary
                                          @else
                                          bg-light
                                          @endif                                          

                                          px-0 border align-self-start mr-2"> <i class="fas fa-shield-check ml-2"></i> <span class="ml-0 pl-1 pr-2">
                                          
                                          @if($student_question->reported_by_me)
                                             Reported
                                          @else
                                             Report
                                          @endif
                                         
                                          </span>
                                           @endif
                                          </a>

                                          <!-- edit -->
                                          @if( session()->has('student') )
                                             @if( $student_question->user_id == session()->get('student')->id )
                                                <a data-toggle="modal" 

                                                   @if( session()->has('student') )
                                                      data-target="#exampleModal7-update-{{$student_question->id}}"
                                                   @else
                                                      data-target="#exampleModal1"
                                                   @endif

                                                   href="javascript:;" class="btn btn-green btn-sm col-auto d-flex align-items-center fs-11 font-weight-bold rounded-pill bg-primary px-0 border-0 align-self-start mr-2 text-transform-none">
                                                      <span class="ml-0 pl-1 pr-2"><i class="fas fa-edit ml-2"></i> Edit</span>
                                                </a>
                                                <div class="modal fade ask_question_modal" id="exampleModal7-update-{{$student_question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content shadow">
                                                         <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                                                            <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Update Question</h5>
                                                            <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                                                               <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <form action="{{ action('Website\StudentQuestionsAnswersController@update_question') }}" method="post">
                                                            @csrf
                                                               <input type="hidden" name="id" value="{{$student_question->id}}">
                                                               <div class="form-group">
                                                                  <p class="fs-12 mb-2 text-secondary font-weight-bold"><span></span> </p>
                                                                  <textarea class="form-control shadow-none" placeholder="Type Your Answer..." rows="3" style="height: 100px;" name="name" required
                                                                  minlength="25"
                                                                  maxlength="300"
                                                                  >{{$student_question->name}}</textarea>
                                                                  <p class="text-danger d-none">The Question must contains atleast 25 characters.</p>
                                                                  <span class="total_characters_typed mt-2">{{ strlen($student_question->name) }}</span>/300
                                                               </div>
                                                               <div class="row align-items-center">

                                                                  <div class="form-group col mb-0">
                                                                     <input type="text" multiple class="tagsInput" value="{{ $student_question->tags ?? '' }}" data-initial-value='{{$tags_initial}}' data-user-option-allowed="true" placeholder="Select Tags" 
                                                                     data-url="{{ action('Website\StudentQuestionsAnswersController@tags_for_questions') }}"
                                                                     data-load-once="true" name="tags" />
                                                                  </div>
                                                                  <div class="text-left mt-0 col-auto">
                                                                     <button type="submit" class="btn btn-sm px-3 btn-green border-0 rounded-pill"><span class="z-index-2">Update</span>
                                                                     </button>
                                                                  </div>
                                                               </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             @endif
                                          @endif

                                          <!-- delete -->
                                          @if( session()->has('student') )
                                             @if( $student_question->user_id == session()->get('student')->id )
                                                
                                                <form action="{{ action('Website\StudentQuestionsAnswersController@delete_question', $student_question->id) }}" method="post" id="delete_form{{$student_question->id}}">
                                                   @csrf
                                                </form>
                                                <a 
                                                   href="javascript:;"
                                                   @if( session()->has('student') )
                                                      onclick="return confirmation('delete_form{{$student_question->id}}')"
                                                   @endif
                                                class="btn btn-green btn-sm col-auto d-flex align-items-center fs-11 font-weight-bold rounded-pill bg-primary px-0 border-0 border-primary align-self-start mr-2 text-transform-none"> <span class="ml-0 pl-1 pr-2"><i class="fas fa-trash ml-2"></i> Delete</span>
                                                </a>
                                             @endif
                                          @endif

                                          <!-- student profile -->
                                          <!-- Modal -->
                                          <div class="modal fade profile_modal" id="profile_modal{{$student_question->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-sm">
                                             <div class="modal-content shadow">
                                                <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center">
                                                <h5 class="modal-title fs-16" id="staticBackdropLabel">Student Profile </h5>
                                                <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
                                                   <span class="text-white" aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="student_profile">
                                                      <a data-toggle="modal" data-target="#profile_modal" href="javascript:;" class="d-flex align-items-center w-70px h-70px justify-content-center border rounded-pill p-0 mx-auto"><img class="img-fluid rounded-pill h-60px border shadow" src="{{$student_question->student_image}}" alt=""
                                                      onerror="this.src='<?php echo asset('public/user.png'); ?>'"
                                                      ></a>
                                                      <h3 class="font-weight-bold fs-18 text-center mt-3">{{$student_question->student_name}}</h3>

                                                      @if( !empty($student_question->education) )
                                                         <span class="fs-14 d-block text-center mb-2">{{$student_question->education}} Aspirant</span>
                                                      @endif

                                                      @if( !empty($student_question->student_state) )
                                                      <span class="fs-14 d-block text-center mb-2"><i class="fas fa-map-marked-alt mr-2"></i>{{$student_question->student_state}}</span>
                                                      @endif
                                                      <span class="fs-14 d-block text-center"><i class="fal fa-calendar-check mr-2"></i>Member Since {{$student_question->student_member_since}}</span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>

                                          <div class="col-auto d-flex align-items-center fs-13 font-weight-bold rounded-pill bg-primary px-0 border border-primary align-self-start"> <i class="fas fa-eye ml-2"></i> <span class="ml-1 bg-white rounded-pill px-1">{{$student_question->views}}</span>
                                          </div>
                                          
                                          @if($student_question->total_answered!=1 && $student_question->total_answered!=0)
                                          <div class="mx-2 col-auto d-flex align-items-center fs-13 font-weight-bold rounded-pill bg-primary px-0  align-self-start">
                                          <a href="{{ action('Website\StudentQuestionsAnswersController@student_answers', base64_encode($student_question->id) ) }}" class="btn btn-green btn-sm text-transform-none col-auto d-flex align-items-center fs-13 font-weight-bold rounded-pill bg-primary px-0 border-0 align-self-start pl-1 pr-1 py-0"> <span class="ml-0 pl-1 pr-2 ">+ {{$student_question->total_answered}} More Ans</span></a>
                                          </div>
                                          @endif
                                       </div>
                                    </div>  
                                    <div class="col-md-12 col-12 mt-3">

                                       <div class="row mb-2">
                                          <div class="col-12">

                                             @php
                                                $question_tags = explode(',', $student_question->tags);

                                                $has_any_tag = false;
                                             @endphp

                                             @if( !empty($question_tags) )
                                                @foreach($question_tags as $question_tag)
                                                   @if( !empty($question_tag) )
                                                      @php
                                                         $has_any_tag = true;
                                                      @endphp
                                                   <a class="text-capitalize fs-md-13 fs-11 border border-secondary text-secondary rounded-pill px-2 mr-1 d-inline-flex" href="javascript:;">
                                                      # {{$question_tag}}
                                                   </a>
                                                   @endif
                                                @endforeach
                                             @endif

                                             @if( session()->has('student') )
                                                @if( ($student_question->user_id == session()->get('student')->id) and !($has_any_tag) )
                                                   <a class="btn btn-green btn-sm border-0 fs-10 rounded-pill py-1 text-transform-none" 
                                                   @if( session()->has('student') )
                                                      data-target="#exampleModal7-update-{{$student_question->id}}"
                                                   @else
                                                      data-target="#exampleModal1"
                                                   @endif
                                                   data-toggle="modal"
                                                   href="javascript:;"
                                                   ><span>Add Tag</span></a>
                                                @endif
                                             @endif
                                          </div>
                                       </div>

                                       <div class="row">
                                          <div class="col">
                                             <a 
                                                href="{{ action('Website\StudentQuestionsAnswersController@student_answers', base64_encode($student_question->id) ) }}"
                                                class="">
                                             <h2 class="fs-md-17 fs-15 text-graydark ellipsis-2 mb-0">{{$student_question->name}}</h2>
                                             </a>
                                          </div>

                                          @if(! $student_question->has_my_answer)
                                          <div class="col-md-auto mt-md-0 mt-3 text-right">
                                             <a data-toggle="modal" 

                                             @if( session()->has('student') )
                                                data-target="#exampleModal7-{{$student_question->id}}"
                                             @else
                                                data-target="#exampleModal1"
                                             @endif

                                             href="javascript:;" class="d-inline-block btn btn-sm outline-0 border-0 btn-green fs-md-14 fs-11 px-2 bg-primary text-center rounded-pill shadow font-weight-bold py-md-2 py-1">
                                                <span><i class="fas fa-pencil-alt mr-1"></i>Answer</span>
                                             </a>
                                          </div>
                                          @endif

                                          <div class="modal fade ask_question_modal" id="exampleModal7-{{$student_question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content shadow">
                                                   <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                                                      <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Add Answer</h5>
                                                      <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                                                         <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <form action="{{ action('Website\StudentQuestionsAnswersController@give_answer') }}" method="post">
                                                      @csrf
                                                         <input type="hidden" name="student_question_id" value="{{$student_question->id}}">
                                                         <div class="form-group fs-md-14 fs-12">
                                                            <p class="fs-12 mb-2 text-secondary font-weight-bold"><span>{{$student_question->name}}</span> </p>
                                                            <textarea class="form-control shadow-none" placeholder="Type Your Answer..." rows="3" style="height: 100px;" name="name" required
                                                            minlength="25"
                                                            maxlength="4000"
                                                            ></textarea>
                                                            <p class="text-danger d-none">The Answer must contains atleast 25 characters.</p>
                                                            <span class="total_characters_typed">0</span>/4000
                                                         </div>
                                                         <div class="row align-items-center">
                                                            <div class="text-left mt-0 col-auto">
                                                               <button type="submit" class="btn btn-sm px-3 btn-green border-0 rounded-pill"><span class="z-index-2">Post</span>
                                                               </button>
                                                            </div>
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       @if( !empty($student_question->latest_answer) )
                                       
                                       <div class="col-auto d-inline-block text-capitalize fs-14 font-weight-bold text-dark px-0 position-relative z-index-1 bottom-n13px bg-white left-10px px-2 py-1">answer </div>
                                       <div class="bg-white pb-3 px-3 mb-3 position-relative border">
                                       
                                          <div class="mt-4 mb-0">
                                             
                                             <div class="row align-items-center mr-md-0 justify-content-md-start justify-content-center mb-3">
                                                <div class="col-auto pr-0">
                                                   <a 
                                                   href="#"
                                                   data-toggle="modal" data-target="#profile_modal_latest_answer{{$student_question->latest_answer->id}}"
                                                   class="d-flex align-items-center w-60px h-60px justify-content-center border rounded-pill p-0">
                                                   
                                                   @php
                                                      $image = $student_question->latest_answer->image;

                                                      if(! @GetImageSize($image) ) {
                                                         $image = asset('public/user.png');
                                                      }

                                                   @endphp

                                                   <img class="img-fluid rounded-pill h-50px w-50px border shadow" src="{{$image}}" alt=""></a>
                                                </div>
                                                <div class="col-sm text-md-left text-center my-md-0 my-2">
                                                   <a 
                                                   data-toggle="modal" data-target="#profile_modal_latest_answer{{$student_question->latest_answer->id}}"
                                                   class="text-primary d-block fs-md-18 fs-14 font-weight-bold" href="javascript:;">{{$student_question->latest_answer->student_name}}</a>
                                                   <span class="fs-12 text-gray text-uppercase">{{ date('F d, Y', strtotime($student_question->latest_answer->created_at)) }}</span>
                                                </div>

                                                   
                                                <!-- edit answer -->
                                                @if( session()->has('student') )
                                                   @if( $student_question->latest_answer->user_id == session()->get('student')->id )
                                                      <a data-toggle="modal" 

                                                         @if( session()->has('student') )
                                                            data-target="#exampleModal7-update-answer-{{$student_question->latest_answer->id}}"
                                                         @else
                                                            data-target="#exampleModal1"
                                                         @endif

                                                         href="javascript:;" class="btn btn-green btn-sm col-auto d-flex align-items-center fs-11 font-weight-bold rounded-pill bg-primary px-0 border-0 border-primary align-self-start mr-2 text-transform-none">
                                                            <span class="ml-0 pl-1 pr-2"><i class="fas fa-edit ml-2"></i> Edit</span>
                                                      </a>
                                                      <div class="modal fade ask_question_modal" id="exampleModal7-update-answer-{{$student_question->latest_answer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content shadow">
                                                               <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
                                                                  <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Update Your Answer</h5>
                                                                  <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
                                                                     <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
                                                                  </button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <form action="{{ action('Website\StudentQuestionsAnswersController@update_answer') }}" method="post">
                                                                  @csrf
                                                                     <input type="hidden" name="id" value="{{$student_question->latest_answer->id}}">
                                                                     <div class="form-group">
                                                                        <p class="fs-12 mb-2 text-secondary font-weight-bold"><span></span> </p>
                                                                        <textarea class="form-control shadow-none" placeholder="Type Your Answer..." rows="3" style="height: 100px;" name="name" required                                                                              
                                                                        minlength="25"
                                                                        maxlength="4000"
                                                                        >{{$student_question->latest_answer->name}}</textarea>
                                                                        <p class="text-danger d-none">The Answer must contains atleast 25 characters.</p>
                                                                        <span class="total_characters_typed mt-2">{{ strlen($student_question->latest_answer->name) }}</span>/4000
                                                                     </div>
                                                                     <div class="row align-items-center">
                                                                        <div class="text-left mt-0 col-auto">
                                                                           <button type="submit" class="btn btn-sm px-3 btn-green border-0 rounded-pill"><span class="z-index-2">Update</span>
                                                                           </button>
                                                                        </div>
                                                                     </div>
                                                                  </form>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   @endif
                                                @endif

                                                <!-- delete answer -->
                                                @if( session()->has('student') )
                                                   @if( $student_question->latest_answer->user_id == session()->get('student')->id )
                                          
                                                      <form action="{{ action('Website\StudentQuestionsAnswersController@delete_answer', $student_question->latest_answer->id) }}" method="post" id="delete_form{{$student_question->latest_answer->id}}">
                                                         @csrf
                                                      </form>
                                                      <a 
                                                         href="javascript:;"
                                                         @if( session()->has('student') )
                                                            onclick="return confirmation('delete_form{{$student_question->latest_answer->id}}')"
                                                         @endif
                                                      class="btn btn-green btn-sm col-auto d-flex align-items-center fs-11 font-weight-bold rounded-pill bg-primary px-0 border-0 border-primary align-self-start mr-2 text-transform-none">  <span class="ml-0 pl-1 pr-2"><i class="fas fa-trash ml-2"></i> Delete</span>
                                                      </a>
                                                   
                                                   @endif
                                                @endif
                                             </div>

                                             <!-- student profile -->
                                             <!-- Modal -->
                                             <div class="modal fade profile_modal" id="profile_modal_latest_answer{{$student_question->latest_answer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                   <div class="modal-content shadow">
                                                      <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center">
                                                      <h5 class="modal-title fs-md-16 fs-14" id="staticBackdropLabel">Student Profile </h5>
                                                      <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
                                                         <span class="text-white" aria-hidden="true">&times;</span>
                                                      </button>
                                                      </div>
                                                      <div class="modal-body">
                                                         <div class="student_profile">
                                                            <a data-toggle="modal" data-target="#profile_modal_latest_answer" href="javascript:;" class="d-flex align-items-center w-70px h-70px justify-content-center border rounded-pill p-0 mx-auto"><img class="img-fluid rounded-pill h-60px border shadow" src="{{$student_question->latest_answer->student_image}}" alt=""
                                                            onerror="this.src='<?php echo asset('public/user.png'); ?>'"
                                                            ></a>
                                                            <h3 class="font-weight-bold fs-18 text-center mt-3">{{$student_question->latest_answer->student_name}}</h3>

                                                            @if( !empty($student_question->latest_answer->education) )
                                                               <span class="fs-14 d-block text-center mb-2">{{$student_question->latest_answer->education}} Aspirant</span>
                                                            @endif

                                                            @if( !empty($student_question->latest_answer->student_state) )
                                                            <span class="fs-14 d-block text-center mb-2"><i class="fas fa-map-marked-alt mr-2"></i>{{$student_question->latest_answer->student_state}}</span>
                                                            @endif
                                                            <span class="fs-14 d-block text-center"><i class="fal fa-calendar-check mr-2"></i>Member Since {{$student_question->latest_answer->student_member_since}}</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="p_text text-justify">
                                             <p class="fs-md-15 fs-13 text-gray mb-0 ellipsis-5">
                                                @php
                                                   echo substr($student_question->latest_answer->name, 0)
                                                @endphp
                                             </p>
                                             <p class="text fs-14 text-gray mb-2 d-none" id="read_more-{{$student_question->id}}">
                                                @php
                                                   echo substr($student_question->latest_answer->name, 200)
                                                @endphp
                                             </p>

                                             @if( strlen($student_question->latest_answer->name) > 200 )
                                                <div class="row mx-0 justify-content-end"><a id="{{$student_question->id}}" href="javascript:;" class="bg-primary rounded-0 fs-11 py-1 px-2 text-right mb-n4 mr-n4 toggle1">Read More</a></div>
                                             @endif
                                          </div>

                                       </div>
                                       @endif
                                    </div>
                                 </div> 
                              </div>

                              @php
                                 $counter += 1;
                              @endphp
                           @endforeach
                        @else
                           <div class="col-md-12 col-12 mt-4">
                              <div class="row rounded bg-white px-2 py-3 position-relative shadow rounded-15 border bg-card2">
                                 <div class="col-12">
                                    <div class="row align-items-center mr-0 justify-content-center">
                                       <h1 class="text-danger text-center">No Student Questions Found!</h1>
                                    </div>
                                 </div>
                              </div>
                           </div>                           
                        @endif

                        @if( 
                           !empty($student_questions->toArray())
                           and
                           count($student_questions) >= 11
                        )
                           <div id="load_more_loader" class="col-12 text-center py-2">
                              <img src="{{ asset('public/website') }}/assets/img/loader.gif" class="w-100px" alt="">
                           </div>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12 mx-0 px-0 mt-4">
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
                           alt=""
                        >
                        </a>
                     @endif
                  </div>
               </div>
            </div>
            <div class="col-lg-4 top-md-160px position-md-sticky">
               <div class="row">
                  <div class="col-md-12 position-relative">
                     <div class="ask_que_expert position-sticky top-90px right-0 z-index-3 d-block mb-4 mx-auto">
                        <a class="bg-primary shadow  pl-3 pr-md-2 pr-3 h-md-60px h-50px fs-md-17 fs-15  font-weight-bold w-100 rounded d-flex align-items-center justify-content-between" href="javascript:;" data-toggle="modal" 
                        @if( session()->has('student') )
                           data-target="#exampleModal5"
                        @else
                           data-target="#exampleModal1"
                        @endif
                        >Ask Your Question <span class="pulse-button position-relative w-md-45px w-30px h-30px h-md-45px border-0 rounded-pill text-center d-grid fs-md-23 fs-16 bg-white text-secondary align-items-center justify-content-center"><i class="fas fa-plus"></i></span></a>
                     </div>
                  </div>
               </div>
               <div class="row d-block bg-white shadow rounded border mx-0 mb-3">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-flex align-items-center justify-content-between position-relative z-index-2 text-white">Search Question <a data-toggle="modal" data-target="#exampleModal6" class="text-white" href="javascripts:;"><i class="fas fa-search"></i></a></h4>
                  </div>
                  <div class="col-md-12 col-xs-12 px-3 widget widget_text pb-0 position-relative pt-md-4 pt-3">
                     <div class="position-absolute top-0px right-10px">
                        @if( !empty($_GET['tag']) )
                        <button class="btn btn-sm fs-md-11 fs-10 px-2 btn-green border-0 rounded-pill" onclick="window.location.href='{{ action('Website\StudentQuestionsAnswersController@student_questions') }}'"><span>Clear all</span></button>
                        @endif
                     </div>
                     <ul class="blog_post_list  mx-0 list-unstyled row mt-md-3 mt-3">
                        @if( !empty($tags) )
                           @foreach($tags as $tag)            
                              @if( !empty($tag) )
                              <li class="border border-secondary mb-2 px-2 py-0 rounded-pill mr-1 col-auto 
                                 @if($tag == ($_GET['tag'] ?? ''))
                                    active
                                 @endif
                              ">
                                 <a class="fs-md-15 fs-12 d-block" href="{{ action('Website\StudentQuestionsAnswersController@student_questions', 'tag='.$tag) }}"> # {{$tag}} </a>
                              </li>
                              @endif
                           @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
               <div class="row mb-md-3">
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
</main>
<div class="modal fade ask_question_modal" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow">
         <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
            <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Ask Your Question</h5>
            <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
               <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ action('Website\StudentQuestionsAnswersController@ask_question') }}" method="post">
               @csrf
               <div class="form-group fs-md-14 fs-12">
                  <p class="fs-12 mb-2 text-secondary font-weight-bold">
                     Our Users will Answer you shortly
                  </p>
                  <textarea class="form-control shadow-none" placeholder="Ask Your Question..." rows="3" style="height: 100px;" name="name" required
                  minlength="25"
                  maxlength="300"
                  ></textarea>
                  <p class="text-danger d-none">The Question must contains atleast 25 characters.</p>
                  <span class="total_characters_typed mt-2">0</span>/300
               </div>
               <div class="row align-items-center">
                  <div class="form-group col mb-0">
                     <input type="text" multiple class="tagsInput" value="" data-initial-value='' data-user-option-allowed="true" placeholder="Select Tags" 
                     data-url="{{ action('Website\StudentQuestionsAnswersController@tags_for_questions') }}" 
                     data-load-once="true" name="tags"/>
                  </div>
                  <div class="text-left mt-md-0 mt-2 col-md-auto">
                     <button type="submit" class="btn btn-sm px-3 btn-green border-0 rounded-pill"><span class="z-index-2">Post</span>
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade ask_question_modal" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow">
         <div class="modal-header d-flex justify-content-start bg-secondary position-relative text-center">
            <h5 class="modal-title text-left fs-lg-20 fs-md-18 fs-15" id="exampleModalLabel">Find a Question</h5>
            <button type="button" class="font-weight-normal close position-absolute right-15px top-15px " data-dismiss="modal" aria-label="Close">
               <span class="text-white " aria-hidden="true"><i class="far fa-times text-white fs-20 font-weight-normal"></i></span>
            </button>
         </div>
         <div class="modal-body pb-md-5 pb-4 mb-4">
            <div class="find_coaching mt-md-3 position-relative">
               <form action="{{ action('Website\StudentQuestionsAnswersController@student_questions') }}">
               <input type="text" class="shadow" placeholder="Search" name="topic" id="topic" value="{{$_GET['topic'] ?? ''}}">
               <input type="button" onclick="this.form.submit()">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle", function() {
         
         var elem = $(this).text();
         var id = $(this).attr('id');
         if (elem == "Read More") {
            $(this).text("Read Less");
            $("#read_more-"+id).slideDown();
         } else {
            $(this).text("Read More");
            $("#read_more-"+id).slideUp();
         }
      });
   });
</script>


<script>
   $(document).ready(function() {
      $(document).on('click', ".toggle1", function() {
         var elem = $(this).text();
         if (elem == "Read More") {
            $(this).text("Read Less");
         } else {
            $(this).text("Read More");
         }

         $(this).parent().parent().children(':first-child').toggleClass('ellipsis-5', 500);
      });
   });
</script>


    <!-- question answer min max limit -->
    <script>
      $(document).on('input change', 'textarea', function() {
         
         var text = $(this).val();

         if(text.length>0){

            var minlength = $(this).attr('minlength');
            var maxlength = $(this).attr('maxlength');
            
            $(this).parent().find('.total_characters_typed').text(text.length);
         }
      });

      $(document).on('keyup', 'textarea', function() {
         
         var text = $(this).val();
         $(this).parent().find('.total_characters_typed').text(text.length);
      });
    </script>
    
    <!-- question answer min max limit -->
   <script>
      $(document).on('submit', 'form', function(event) {
         var minlength = $("textarea",this).attr('minlength');
         var maxlength = $("textarea",this).attr('maxlength');
         
         if(minlength != '' || maxlength != '') {
            
            var textarea_value = $("textarea",this).val();       
            
            if(textarea_value.length >= minlength && textarea_value.length <= maxlength) {
               return true;
            } else {
               
               $("textarea",this).parent().find('p.text-danger').removeClass('d-none').show().delay(2000).fadeOut('slow');

               event.preventDefault();
               return false;
            }
         }
      });
   </script>

   
   <script>
      $(window).scroll(function(){
         if($(window).scrollTop() + $(window).height() 
         > $("#box_to_load").height()-50)
         {

            if( 
               $("#box_to_load")
               .find('.box_to_be_loaded.d-none')
               .slice(0,10)
               .length == 0
            ) {
               $('#load_more_loader').remove();
            } else {

               $("#box_to_load")
                  .find('.box_to_be_loaded.d-none')
                  .slice(0,10)
                  .removeClass('d-none', 800);
            }
         }
      });
   </script>
@include('website/layouts/footer')