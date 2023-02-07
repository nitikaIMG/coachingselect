@include('website.layouts.header')
<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner_2 pb-5 pt-4" style="background: linear-gradient(-550deg, hsl(var(--color-secondary) / 96%), hsl(var(--color-primary) / 80%) ),url({{ asset('public/website/') }}/assets/img/bg_756454.jpg); background-size: cover !important;background-position: center;">
      <div class="container position-relative z-index-2">
         <div class="row text-center pb-5">
            <h2 class="col-12 font-weight-bold text-white fs-lg-30 fs-md-22 fs-18 text-right">Student Reviews</h2>
         </div>
      </div>
   </section>
   <!-- blog-section SECTION START  -->
   <div class="container-fluid mt-n5 position-relative top-n30px">
      <div class="container mt-n5">
         <div class="row">
            <div class="col-md-12 col-12 py-3 userProfiles">
               <div class="row mx-0">
                  <div class="col-12">
                     <div class="row">
                        <div class="col-12 table-responsive">
                           <table class="table table-borderless">
                              <thead>
                                 <tr>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" width="50">
                                       S. No</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap">
                                       Student Name</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap">
                                       Name</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap">
                                       Description</th> 
                                    <th class="text-white fs-md-15 fs-13 text-nowrap">
                                       Total Ratings</th> 

                                 </tr>
                              </thead>
                              <tbody>
                                 @if(!empty($enterprise->reviews)) 
                                    
                                    @php 
                                       $i = 1;
                                    @endphp

                                    @foreach ($enterprise->reviews as $post)

                                       <tr>
                                          <th class="fs-md-15 fs-13" scope="row">
                                             {{$i}}.
                                          </th>
                                          <td class="fs-md-15 fs-13"><a class="font-weight-bold d-inline-block text-secondary" href="javascript:;" data-toggle="modal" data-target="#profile_modal_new{{$i}}">
                                             {{ $post['student_name'] }}
                                          </a></td>
                                          <td class="fs-md-15 fs-13">
                                             {{ $post['name'] }}
                                          </td>
                                          <td class="fs-md-15 fs-13">
                                             <div class="row">
                                                <div class="col-12 overflow-auto" style="max-width: 100%;">
                                                   {{ $post['description'] }}
                                                </div>
                                             </div>
                                          </td>
                                          <td class="fs-md-15 fs-13">
                                             {{ $post['total_ratings'] }}
                                          </td>
                                       </tr>
                                       
                                       @php 
                                          $i += 1;
                                       @endphp

                                    @endforeach
                                 
                                 @endif
                              </tbody>
                           </table>
                           @if(empty($enterprise->reviews))
                              <div class="col-12 text-center">
                                 No Reviews Found
                              </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 px-0 my-4">
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
                     <!-- <span class="bg-black fs-11 position-absolute px-2 py-1 left-1px d-block bottom-1px rounded-right font-weight-bold">
                        AD
                     </span> -->
                  </a>
               @endif
            </div>
         </div>
      </div>
   </div>
   <!-- blog-section SECTION START  -->
</main>
@if(!empty($enterprise->reviews)) 
   
   @php 
      $i = 1;
   @endphp

   @foreach ($enterprise->reviews as $post)
        
      <div class="modal fade profile_modal" id="profile_modal_new{{$i}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content shadow">
               <div class="modal-header d-flex justify-content-center py-2 bg-secondary position-relative text-center">
               <h5 class="modal-title fs-16" id="staticBackdropLabel">User Details </h5>
               <button type="button" class="font-weight-normal close position-absolute right-15px top-15px py-2" data-dismiss="modal" aria-label="Close">
                  <span class="text-white" aria-hidden="true">&times;</span>
               </button>
               </div>
               <div class="modal-body">
                  <div class="student_profile">
                     <a href="javascript:;" class="d-flex align-items-center w-70px h-70px justify-content-center border rounded-pill p-0 mx-auto">
                        <img 
                           class="img-fluid rounded-pill h-60px border shadow" 
                           src="{{ $post['student_image'] }}"
                           alt=""></a>
                     <h3 class="font-weight-bold fs-18 text-center mt-3">
                        {{ $post['student_name'] }}
                     </h3>
                     <p class="fs-18 text-center mt-3">
                        {{ $post['student_email'] }}
                     </p>
                     <p class="fs-18 text-center mt-3">
                        {{ $post['student_mobile'] }}
                     </p>
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
@include('website.layouts.footer')