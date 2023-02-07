@include('website.layouts.header')
<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner_2 pb-5 pt-4" style="background: linear-gradient(-550deg, hsl(var(--color-secondary) / 96%), hsl(var(--color-primary) / 80%) ),url({{ asset('public/website/') }}/assets/img/bg_756454.jpg); background-size: cover !important;background-position: center;">
      <div class="container position-relative z-index-2">
         <div class="row text-center pb-5">
            <h2 class="col-12 font-weight-bold text-white fs-lg-30 fs-md-22 fs-18 text-right">Page Leads</h2>
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
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" width="50" style="text-align:center;">
                                       S. No</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" style="text-align:center;">
                                       Name</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" style="text-align:center;">
                                       Email</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" style="text-align:center;">
                                      Mobile</th>
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" style="text-align:center;">
                                       Class</th>                                    
                                    <th class="text-white fs-md-15 fs-13 text-nowrap" style="text-align:center;">
                                       City</th>
                                    

                                 </tr>
                              </thead>
                              <tbody>
                                 @if(!empty($enterprise->pagelead)) 
                                    
                                    @php 
                                       $i = 1;
                                    @endphp

                                    @foreach ($enterprise->pagelead as $post)

                                       <tr>
                                          <th class="fs-md-15 fs-13" scope="row" style="text-align:center;">
                                             {{$i}}.
                                          </th>
                                          <td class="fs-md-15 fs-13" style="text-align:center;">
                                             {{ $post['name'] }}
                                          </td>
                                           <td class="fs-md-15 fs-13" style="text-align:center;">
                                             {{ $post['email'] }}
                                          </td>

                                          <td class="fs-md-15 fs-13" style="text-align:center;">
                                             {{ $post['mobile'] }}
                                          </td>
                                          <td class="fs-md-15 fs-13" style="text-align:center;">
                                             {{ $post['class'] }}
                                          </td>
                                          <td class="fs-md-15 fs-13" style="text-align:center;">
                                             {{ $post['city'] }}
                                          </td>
                                       </tr>
                                       
                                       @php 
                                          $i += 1;
                                       @endphp

                                    @endforeach
                                 
                                 @endif
                              </tbody>
                           </table>
                           @if(empty($enterprise->pagelead))
                              <div class="col-12 text-center">
                                 No Page Lead Found
                              </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- blog-section SECTION START  -->
</main>

@include('website.layouts.footer')