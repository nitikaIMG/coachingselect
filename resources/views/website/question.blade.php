
<div class="row mx-0 h-100 shadow rounded-10 border overflow-hidden d-block pb-lg-0 pb-md-4 pb-3">
   <div class="col-12 test-inner-header h-md-40px border-bottom bg-light">
      <div class="row h-md-100 align-items-center py-md-0 py-2">
         <div class="col font-weight-bold fs-md-17 fs-14">Question <span id="question_number">1</span></div>
         <div class="col-md-auto font-weight-bold fs-md-15 fs-13">
            <div class="row font-weight-bold justify-content-between">
               <div class="col-auto pr-1"><span class="text-gray">Correct Marks: </span><span class="text-success" id="marks"> {{$question_answer->marks}}</span>,</div> 
               <div class="col-auto pl-1"><span class="text-gray">Negative Marks: </span><span class="text-danger" id="negative_marks"> {{$question_answer->negative_marks}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12 test-inner-body overflow-auto">
      <div class="row">
         <div class="col-12">
            <div class="row">
               <div class="col-12 fs-md-15 fs-13 py-md-3 py-2 border-bottom font-weight-500 text-gray question-box" id="question">
                                    
                  <span class="d-block">{{$question_answer->question}}</span>

                  @if( !empty($question_answer->image) )
                     <img 
                        class="img-fluid"
                        src="{{ asset('public/question_answer/'.$question_answer->image) }}" />
                  @endif
               </div>
            </div>
         </div>
         <div class="col-12 py-3 ">
            <div class="row">
               <div class="col-12">
                  <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-0">
                     <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="question_option1" name="question_option" class="custom-control-input" value="a"
                        @if( !empty($test) and preg_match('/a/', $test->option) )
                           checked
                        @endif
                     >
                     <label class="custom-control-label fs-md-14 fs-14 h-lg-25px d-inline-flex align-items-start" for="question_option1" id="a"><span class="mr-2 font-weight-bold">A.</span>
                     <p>
                     @if($question_answer->a_type == 'text')
                        {{$question_answer->a}}
                     @endif
                     </p>
                     
                     </label>
                     
                     @if($question_answer->a_type == 'text')
                     @else
                        <img 
                           class="w-auto img-fluid d-block"
                           src="{{ asset('public/question_answer/'.$question_answer->a) }}" />
                     @endif
                  </div>
                  <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-0">
                     <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="question_option2" name="question_option" class="custom-control-input" value="b"
                        @if( !empty($test) and preg_match('/b/', $test->option) )
                           checked
                        @endif
                     >
                     <label class="custom-control-label fs-md-14 fs-14 h-lg-25px d-inline-flex align-items-start" for="question_option2" id="b"><span class="mr-2 font-weight-bold">B.</span>
                     <p>
                     @if($question_answer->b_type == 'text')
                        {{$question_answer->b}}
                     @endif
                     </p>
                     </label>
                      @if($question_answer->b_type == 'text')
                     @else
                        <img 
                           class="w-auto img-fluid d-block"
                           src="{{ asset('public/question_answer/'.$question_answer->b) }}" />
                     @endif
                  </div>
                  <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-0">
                     <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="question_option3" name="question_option" class="custom-control-input" value="c"
                        @if( !empty($test) and preg_match('/c/', $test->option) )
                           checked
                        @endif
                     >
                     <label class="custom-control-label fs-md-14 fs-14 h-lg-25px d-inline-flex align-items-start" for="question_option3" id="c"><span class="mr-2 font-weight-bold">C.</span>
                     <p>
                     @if($question_answer->c_type == 'text')
                        {{$question_answer->c}}
                     @endif
                     </p>
                     </label>
                     @if($question_answer->c_type == 'text')
                     @else
                        <img 
                           class="w-auto img-fluid d-block"
                           src="{{ asset('public/question_answer/'.$question_answer->c) }}" />
                     @endif
                  </div>
                  <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-0">
                     <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="question_option4" name="question_option" class="custom-control-input" value="d"
                        @if( !empty($test) and preg_match('/d/', $test->option) )
                           checked
                        @endif
                     >
                     <label class="custom-control-label fs-md-14 fs-14 h-lg-25px d-inline-flex align-items-start" for="question_option4" id="d"><span class="mr-2 font-weight-bold">D.</span>
                     <p>
                     @if($question_answer->d_type == 'text')
                        {{$question_answer->d}}
                     @endif
                     </p>
                     </label>
                     @if($question_answer->d_type == 'text')
                     @else
                        <img 
                           class="w-auto img-fluid d-block"
                           src="{{ asset('public/question_answer/'.$question_answer->d) }}" />
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12 test-inner-footer">
      <div class="row justify-content-between">
         <div class="col-6">
            <div class="row">
               <div class="col-auto">
                  <a href="javascript:;" class="btn btn-orange d-inline-flex justify-content-center align-items-center py-0 px-2 border text-capitalize fs-14 h-35px" id="review_question_btn" data-review_question_id="{{$question_answer->id}}" 
                  data-next_question="{{ $question_answers[1]->id ?? $next_question_id }}"
                  onclick="mark_as_review('{{ $question_answer->id }}', '{{ $question_answers[1]->id ?? $next_question_id }}')"                                                               
                  > <i class="far fa-dot-circle"></i> <span class="ml-1 d-md-inline-block d-none">Mark for Review & Next</span></a>
               </div>
               <div class="col-auto pl-0">
                  <a href="javascript:;" class="btn btn-danger d-inline-flex justify-content-center align-items-center py-0 px-2 border text-capitalize fs-14 h-35px"
                  onclick="reset_answer('{{ $question_answer->id }}', '{{ $question_answers[1]->id ?? $next_question_id }}')"
                  > <i class="far fa-ban"></i> <span class="ml-1 d-md-inline-block d-none">Reset Answer</span></a>
               </div>
            </div>
         </div>
         <div class="col-6">
            <div class="row justify-content-end">
               <div class="col-auto text-right">
                  <a href="javascript:;" class="btn btn-light d-inline-flex justify-content-center align-items-center py-0 px-2 border text-capitalize fs-14 h-35px"
                  onclick="previous_question('{{ $question_answer->id }}')"
                  id="prev_button"
                  ><i class="far fa-long-arrow-alt-left"></i><span class="ml-1 d-md-inline-block d-none">prev</span>  </a>
               </div>
               <div class="col-auto pl-0 text-right">
                  <a href="javascript:;" class="btn btn-success d-inline-flex justify-content-center align-items-center py-0 px-2 border text-capitalize fs-14 h-35px"
                  onclick="save_and_next('{{ $question_answer->id }}', '{{ $question_answers[1]->id ?? $next_question_id }}')"
                  > <i class="far fa-sign-out-alt"></i> <span class="ml-1 d-md-inline-block d-none">Save &amp; Next</span></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
