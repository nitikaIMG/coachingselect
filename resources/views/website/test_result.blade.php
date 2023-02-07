@include('website/layouts/header')

<style>
   
   p {
      overflow-wrap: anywhere;
   }
</style>

<main id="main">
   <section class="scoreboard">
      <div class="container">
         <div class="group-title-index mb-lg-5 mb-md-4 mb-3">
            <!-- <h4 class="top-title">India's no.1 and fastest growing education portal</h4> -->
            <h2 class="center-title">Scorecard</h2>
         </div>
         <div class="row mx-0 border shadow bg-light p-md-4 p-2 align-items-center justify-content-between rounded-10">
            <div class="col-auto px-lg-3 px-1">
               <div class="fs-md-20 fs-16 rounded">Total Score :</div>
            </div>
            <div class="col-auto px-lg-3 px-1">
               <div class="text-secondary fs-md-26 fs-20 arrow_right"><i class="fad fa-long-arrow-right"></i></div>
            </div>
            <div class="col-auto px-lg-3 px-1">
               <div class="fs-md-22 fs-15">{{ $result['score'] ?? 0 }}</div>
            </div>
         </div>
         
         <div class="row">
            <div class="col-sm">                     
               <div class="mt-md-4 mt-3 row mx-0 border shadow bg-light p-lg-4 p-md-3 p-2 align-items-center justify-content-between rounded-10">
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-15 fs-md-13 fs-13 rounded">Correct :</div>
                  </div>
                  
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-18 fs-md-16 fs-14">{{ $result['correct'] ?? 0 }}</div>
                  </div>
               </div>
            </div>
            <div class="col-sm">
               <div class="mt-md-4 mt-3 row mx-0 border shadow bg-light p-lg-4 p-md-3 p-2 align-items-center justify-content-between rounded-10">
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-15 fs-md-13 fs-13 rounded">Incorrect :</div>
                  </div>
                  
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-18 fs-md-16 fs-14">{{ $result['incorrect'] ?? 0 }}</div>
                  </div>
               </div>
            </div>
            <div class="col-sm">                     
               <div class="mt-md-4 mt-3 row mx-0 border shadow bg-light p-lg-4 p-md-3 p-2 align-items-center justify-content-between rounded-10">
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-15 fs-md-13 fs-13 rounded">Attempted :</div>
                  </div>
                  
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-18 fs-md-16 fs-14">{{ $result['attempted'] ?? 0 }}</div>
                  </div>
               </div>
            </div>
            <div class="col-sm">
               <div class="mt-md-4 mt-3 row mx-0 border shadow bg-light p-lg-4 p-md-3 p-2 align-items-center justify-content-between rounded-10">
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-15 fs-md-13 fs-13 rounded">Not Attempted :</div>
                  </div>
                  
                  <div class="col-auto px-lg-3 px-1">
                     <div class="fs-lg-18 fs-md-16 fs-14">{{ $result['not_attempted'] ?? 0 }}</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="solutions py-md-5 pt-3 pb-4">
      <div class="container">
         <div class="group-title-index mb-lg-5 mb-md-4 mb-0">
            <h2 class="center-title">Solutions</h2>
         </div>
         <div class="row">
            <div class="col test-body-left py-3 h-100">
               
               @if( !empty($result['question_answers']) )
                  @php
                     $i = 1;
                  @endphp

                  @foreach($result['question_answers'] as $question_answer)
                     <div class="row mx-0 h-100 shadow rounded-10 border overflow-hidden d-block mb-md-5 mb-4">
                        <div class="col-12 test-inner-header h-40px border-bottom bg-light">
                           <div class="row h-100 align-items-center">
                              <div class="col font-weight-bold fs-md-17 fs-15">Question {{$i}}</div>
                           </div>
                        </div>
                        <div class="col-12 overflow-auto">
                           <div class="row">
                              <div class="col-12">
                                 <div class="row">
                                    <div class="col-12 fs-md-15 fs-13 py-3 border-bottom font-weight-500 text-gray question-box d-block">{{$question_answer->question}}.
                                    
                                    @if( !empty($question_answer->image) )
                                       <img 
                                          class="img-fluid d-block"
                                          src="{{ asset('public/question_answer/'.$question_answer->image) }}" />
                                    @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 py-md-3 py-4">
                                 <div class="row">
                                    <div class="col-12">
                                       <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-1">
                                          <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}1a{{$i}}" name="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}{{$i}}" class="custom-control-input" disabled
                                             @if(
                                                preg_match('/a/', $question_answer->answer)
                                             )
                                                checked
                                             @endif
                                          >
                                          <label class="custom-control-label fs-14 h-lg-25px d-inline-flex align-items-start
                                             @if(
                                                preg_match('/a/', $question_answer->answer)
                                             )
                                                text-success
                                             @elseif(
                                                $question_answer->attempt == 'a'
                                                and
                                                ! preg_match('/a/', $question_answer->answer)
                                             )
                                                text-danger
                                             @endif
                                          " for="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}1a{{$i}}"><span class="mr-2 font-weight-bold">A.</span> 
                                          <p>
                                          @if($question_answer->a_type == 'text')
                                             {{$question_answer->a}}
                                          @endif
                                           </p>
                                          
                                             @if(
                                                preg_match('/a/', $question_answer->answer)
                                                and
                                                $question_answer->attempt == $question_answer->answer
                                             )
                                             <div class="fs-14 ml-2"><i class="fas fa-check"></i></div>
                                             @endif

                                             @if(
                                                $question_answer->attempt == 'a'
                                                and
                                                !preg_match('/a/', $question_answer->answer)
                                             )
                                             <div class="fs-15 ml-2"><i class="fas fa-times"></i></div>
                                             @endif
                                          </label>
                                          @if($question_answer->a_type == 'text')
                                          @else
                                             <img 
                                                class="w-auto img-fluid d-block"
                                                src="{{ asset('public/question_answer/'.$question_answer->a) }}" />
                                          @endif
                                       </div>
                                       <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-1">
                                          <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}2b{{$i}}" name="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}{{$i}}" class="custom-control-input" disabled
                                             @if(
                                                preg_match('/b/', $question_answer->answer)
                                             )
                                                checked
                                             @endif
                                          >
                                          <label class="custom-control-label fs-14 h-lg-25px d-inline-flex align-items-start
                                             @if(
                                                preg_match('/b/', $question_answer->answer)
                                             )
                                                text-success
                                             @elseif(
                                                $question_answer->attempt == 'b'
                                                and
                                                ! preg_match('/b/', $question_answer->answer)
                                             )
                                                text-danger
                                             @endif
                                          " for="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}2b{{$i}}">
                                             <span class="mr-2 font-weight-bold">B.</span> 
                                             <p>
                                             @if($question_answer->b_type == 'text')
                                                {{$question_answer->b}}
                                             @endif
                                              </p>

                                             <div class="fs-12"></div>

                                             @if(
                                                preg_match('/b/', $question_answer->answer)
                                                and
                                                $question_answer->attempt == $question_answer->answer
                                             )
                                             <div class="fs-14 ml-2"><i class="fas fa-check"></i></div>
                                             @endif

                                             @if(
                                                $question_answer->attempt == 'b'
                                                and
                                                ! preg_match('/b/', $question_answer->answer)
                                             )
                                             <div class="fs-15 ml-2"><i class="fas fa-times"></i></div>
                                             @endif
                                             
                                          </label>
                                          
                                             @if($question_answer->b_type == 'text')
                                             @else
                                                <img 
                                                   class="w-auto img-fluid d-block"
                                                   src="{{ asset('public/question_answer/'.$question_answer->b) }}" />
                                             @endif
                                       </div>
                                       <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-1">
                                          <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}new4c{{$i}}" name="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}{{$i}}"  class="custom-control-input" disabled
                                             @if(
                                                preg_match('/c/', $question_answer->answer)
                                             )
                                                checked
                                             @endif
                                          >
                                          <label class="custom-control-label fs-14 h-lg-25px d-inline-flex align-items-start
                                             @if(
                                                preg_match('/c/', $question_answer->answer)
                                             )
                                                text-success
                                             @elseif(
                                                $question_answer->attempt == 'c'
                                                and
                                                ! preg_match('/c/', $question_answer->answer)
                                             )
                                                text-danger
                                             @endif
                                          " for="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}new4c{{$i}}">
                                             <span class="mr-2 font-weight-bold">C.</span> 
                                             <p>
                                             @if($question_answer->c_type == 'text')
                                                {{$question_answer->c}}
                                             @endif
                                              </p>
                                             
                                             @if(
                                                preg_match('/c/', $question_answer->answer)
                                                and
                                                $question_answer->attempt == $question_answer->answer
                                             )
                                             <div class="fs-14 ml-2"><i class="fas fa-check"></i></div>
                                             @endif

                                             @if(
                                                $question_answer->attempt == 'c'
                                                and
                                                ! preg_match('/c/', $question_answer->answer)
                                             )
                                             <div class="fs-15 ml-2"><i class="fas fa-times"></i></div>
                                             @endif
                                             
                                          </label>
                                          
                                             @if($question_answer->c_type == 'text')
                                             @else
                                                <img 
                                                   class="w-auto img-fluid d-block"
                                                   src="{{ asset('public/question_answer/'.$question_answer->c) }}" />
                                             @endif
                                       </div>
                                       <div class="custom-control custom-{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }} mb-md-2 mb-1">
                                          <input type="{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}" id="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}4d{{$i}}" name="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}{{$i}}" class="custom-control-input" disabled
                                             @if(
                                                preg_match('/d/', $question_answer->answer)
                                             )
                                                checked
                                             @endif
                                          >
                                          <label class="custom-control-label fs-14 h-lg-25px d-inline-flex align-items-start
                                             @if(
                                                preg_match('/d/', $question_answer->answer)
                                             )
                                                text-success
                                             @elseif(
                                                $question_answer->attempt == 'd'
                                                and
                                                ! preg_match('/d/', $question_answer->answer)
                                             )
                                                text-danger
                                             @endif
                                          " for="custom{{ $question_answer->is_mcq == 'true' ? 'checkbox' : 'radio' }}4d{{$i}}"><span class="mr-2 font-weight-bold">D.</span> 
                                          <p>
                                          @if($question_answer->d_type == 'text')
                                             {{$question_answer->d}}
                                          @endif
                                           </p>

                                             @if(
                                                preg_match('/d/', $question_answer->answer)
                                                and
                                                $question_answer->attempt == $question_answer->answer
                                             )
                                             <div class="fs-14 ml-2"><i class="fas fa-check"></i></div>
                                             @endif

                                             @if(
                                                $question_answer->attempt == 'd'
                                                and
                                                ! preg_match('/d/', $question_answer->answer)
                                             )
                                             <div class="fs-15 ml-2"><i class="fas fa-times"></i></div>
                                             @endif

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