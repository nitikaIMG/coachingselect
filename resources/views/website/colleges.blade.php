@include('website/layouts/header')
<style type="text/css">
   .width_know_btn{
      width: 180px;
   }
   .width_brochure_btn{
      width: 206px;
   }
   .sticky_cl{
      position: sticky;
      top: 153px;
   }

   .display-none {
      display: none !important;
   }
   
   .featured_collages_inner {
       height: 47% !important;
   }
</style>
<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner_2 py-5">
      <div class="container position-relative z-index-2">
         <div class="row text-center aos-init">
            <h1 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22 text-center d-block w-100">
               Top 
               @if( !empty(
                  request()->get('filters')['streams']
               ) )
                  {{ implode(', ', request()->get('filters')['streams']) }}
               @endif
               Colleges in India</h1>
            <p class="col-12 text-white fs-md-15 fs-13 mb-0">
               FOUND 
                  <span class="font-weight-bold">
                  @if( !empty($colleges->toArray()) )
                     {{ count($colleges) }}
                  @else 
                     0
                  @endif                              
                  </span> 
                  @if(count($colleges) <= 1)
                  COLLEGE
                  @else
                  COLLEGES
                  @endif
            </p>
         </div>
      </div>
   </section>
   <!-- blog-section SECTION START  -->
   <div class="container-fluid">
      <div class="row pt-md-0 pt-3">
         <div class="col-lg-auto filterses position-relative col-12 py-3">
            <div class="bg-white my-3 row position-sticky top-90px right-0 z-index-3 pt-3 pb-2 shadow d-none">
               <div class="col-md-12 col-12 px-3">
                  <form action="https://www.imgglobalinfotech.com/blog/search" method="GET" class="row mx-0">
                     <div class="col-md-12 col-12 px-0 dp-0">
                        <input type="text" class="form-control shadow-none" placeholder="Search Blog" value="" name="value" required="">
                     </div>
                     <div class="col-auto px-0 position-absolute right-15px top-n1px bottom-0">
                        <a href="javascipt:;" class="btn shadow-none"><i class="far fa-search"></i></a>
                     </div>
                  </form>
               </div>
            </div>
            <form id="filter_form" class="sticky_cl">
               <div class="row bg-white shadow right-0 rounded border mx-0 mb-md-3">
                  <div class="col-md-12 post_heading px-0 col-12">
                     <div class="row">
                        <div class="col-12">
                           <h4 class="font-weight-bold shadow bg-primary text-center fs-16 px-3 py-2 d-inline-flex align-items-center justify-content-start position-relative z-index-2 text-white">
                              <div class="col text-left">FILTERS</div>
                              <div class="col-auto fs-10 font-weight-light">FOUND 
                              <span class="font-weight-bold">
                              @if( !empty($colleges->toArray()) )
                                 {{ count($colleges) }}
                              @else 
                                 0
                              @endif                              
                              </span> 
                              @if(count($colleges) <= 1)
                              COLLEGE
                              @else
                              COLLEGES
                              @endif
                              </div>
                           </h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 pt-2">
                     <div class="row mx-0">
                        @php                           
                           $filters_sidebar = '';

                           if( !empty($_GET['filters']) ) {
                              $filters_sidebar = $_GET['filters'];
                           }
                        @endphp

                        @if( !empty($filters_sidebar['streams']) )
                           @foreach($filters_sidebar['streams'] as $filter)
                           <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                              {{$filter}}
                              <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                           </div>
                           @endforeach
                        @endif
                        
                        @if( !empty($filters_sidebar['states']) )
                           @foreach($filters_sidebar['states'] as $filter)
                           <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                              {{$filter}}
                              <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                           </div>
                           @endforeach
                        @endif
                        
                        @if( !empty($filters_sidebar['category']) )
                           @foreach($filters_sidebar['category'] as $filter)
                           <div class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center">
                              {{$filter}}
                              <span class="closebtn" data-selected-filter="{{$filter}}" onclick="this.parentElement.style.display='none'"><i class="ml-1 fas fa-times"></i></span>
                           </div>
                           @endforeach
                        @endif

                        @if( !empty($filters_sidebar) )
                           <a 
                              href="{{ action('Website\CollegeController@colleges') }}"
                              class="chip col-auto bg-secondary px-2 py-0 mr-1 mb-1 rounded-pill fs-12 text-center"
                           >
                              Clear All
                           </a>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12 px-0 col-12">
                     <div class="row mx-0 pb-0 border-bottom">
                        <div class="col-12">
                           <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="true" aria-controls="collapseExample">
                              STREAM
                           </a>
                        </div>
                        <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                           <div class="collapse show" id="collapseExample1">
                              <div class="card card-body border-0 px-0 pt-0 pb-2">
                                 @if( !empty($filters['streams']->toArray()) )
                                    @foreach($filters['streams'] as $index => $filter)
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-streams{{$index}}" name="filters[streams][]" value="{{ $filter->name }}" 
                                             
                                             @if( !empty($filters_sidebar['streams']) )
                                                @if(in_array($filter->name, $filters_sidebar['streams']))
                                                   checked
                                                @endif
                                             @endif

                                          >
                                       <label class="custom-control-label d-flex justify-content-between fs-md-15 fs-13" for="customCheck-filter-streams{{$index}}"><span class="fs-md-15 fs-13">
                                       {{ $filter->name }}
                                       </span> <span class="text-primary fs-md-15 fs-13">
                                       ({{ $filter->total_colleges }})
                                       </span></label>
                                    </div>
                                    @endforeach
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row mx-0 pb-0 border-bottom">
                        <div class="col-12">
                           <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample">
                              STATE
                           </a>
                        </div>
                        <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                           <div class="collapse show" id="collapseExample2">
                              <div class="card card-body border-0 px-0 pt-0 pb-2">
                                 @if( !empty($filters['states']->toArray()) )
                                    @foreach($filters['states'] as $index => $filter)
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-states{{$index}}" name="filters[states][]" value="{{ $filter->name }}" 
                                             
                                             @if( !empty($filters_sidebar['states']) )
                                                @if(in_array($filter->name, $filters_sidebar['states']))
                                                   checked
                                                @endif
                                             @endif

                                          >
                                       <label class="custom-control-label d-flex justify-content-between fs-md-15 fs-13" for="customCheck-filter-states{{$index}}"><span class="fs-md-15 fs-13">
                                       {{ $filter->name }}
                                       </span> <span class="text-primary fs-md-15 fs-13">
                                       ({{ $filter->total_colleges }})
                                       </span></label>
                                    </div>
                                    @endforeach
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row mx-0 pb-0 border-bottom">
                        <div class="col-12">
                           <a class="text-secondary font-weight-bold py-md-3 py-2 d-block w-100 fs-md-15 fs-13 filterssss" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="true" aria-controls="collapseExample">
                              COLLEGE CATEGORY
                           </a>
                        </div>
                        <div class="col-12 overflow-auto collapse_outer" style="max-height: 200px;">
                           <div class="collapse show" id="collapseExample3">
                              <div class="card card-body border-0 px-0 pt-0 pb-2">
                                 @if( !empty($filters['category']->toArray()) )
                                    @foreach($filters['category'] as $index => $filter)
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input checkboxes" id="customCheck-filter-category{{$index}}" name="filters[category][]" value="{{ $filter->category }}" 
                                             
                                             @if( !empty($filters_sidebar['category']) )
                                                @if(in_array($filter->category, $filters_sidebar['category']))
                                                   checked
                                                @endif
                                             @endif

                                          >
                                       <label class="custom-control-label d-flex justify-content-between fs-md-15 fs-13" for="customCheck-filter-category{{$index}}"><span class="fs-md-15 fs-13">
                                       {{ $filter->category }}
                                       </span> <span class="text-primary fs-md-15 fs-13">
                                       ({{ $filter->total_colleges }})
                                       </span></label>
                                    </div>
                                    @endforeach
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>

         <div class="col-md col-12 py-3">
            <div class="row mx-0">
               <div class="col-12 bg-white shadow mb-4 border border-light">
                  <div class="row p-md-0 p-3 justify-content-md-between justify-content-center">
                     <div class="col-md-6 col-12 align-self-center fs-md-15 fs-14 text-md-left text-center font-weight-bold text-uppercase mb-md-0 mb-2">Sort By</div>
                     <div class="col-md-auto px-md-3 px-1 col sorting_9353 h-md-100 text-center position-relative d-none">
                        <input type="radio" class="" 
                        id="popularity"
                        value="popularity"
                        
                        @if( 
                           !empty( request()->get('sort') )
                           and
                           request()->get('sort') == 'popularity'
                        )
                           checked
                        @endif

                        name="sort"
                        form="filter_form"
                        >
                     </div>
                     <div class="col-md-auto px-md-3 px-1 col sorting_9353 h-md-100 text-center position-relative">
                        <input type="radio" class="d-none" 
                        id="Rating"
                        value="rating"
                        name="sort"
                        form="filter_form"
                        
                        @if( 
                           !empty( request()->get('sort') )
                           and
                           request()->get('sort') == 'rating'
                        )
                           checked
                        @endif

                        >
                        <label for="Rating" class="mb-0 py-md-2 py-1 fs-md-14 fs-12"><i class="fad fa-sort-circle-down fs-16"></i> <span>
                        Ranking</span></label>
                     </div>
                     <div class="col-md-auto px-md-3 px-1 col sorting_9353 h-md-100 text-center position-relative">
                        <input type="radio" class="d-none" 
                        id="HighestFees"
                        value="highest_fees"
                        name="sort"
                        form="filter_form"
                        
                        @if( 
                           !empty( request()->get('sort') )
                           and
                           request()->get('sort') == 'highest_fees'
                        )
                           checked
                        @endif

                        >
                        <label for="HighestFees" class="mb-0 py-md-2 py-1 fs-md-14 fs-12"><i class="fad fa-sort-circle-down fs-16"></i> <span>Highest Fees</span></label>
                     </div>
                     <div class="col-md-auto px-md-3 px-1 col sorting_9353 h-md-100 text-center position-relative">
                        <input type="radio" class="d-none" 
                        id="LowestFees"
                        value="lowest_fees"
                        name="sort"
                        form="filter_form"
                        
                        @if( 
                           !empty( request()->get('sort') )
                           and
                           request()->get('sort') == 'lowest_fees'
                        )
                           checked
                        @endif

                        >
                        <label for="LowestFees" class="mb-0 py-md-2 py-1 fs-md-14 fs-12"><i class="fad fa-sort-circle-down fs-16"></i> <span>Lowest Fees</span></label>
                     </div>
                  </div>
               </div>
               <div class="col-12 px-0 mb-4">
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
                        src="https://www.coachingselect.com/public/s_img_new.php?image={{ asset('public/' . $header->advertisement('full')->image) }}&width=958&height=224&zc=1"
                        alt="{{ 
                           basename( asset('public/' . $header->advertisement('full')->image) )
                        }}"
                     >
                     </a>
                  @endif
               </div>
               <div class="col-12">
                  <div class="row"  id="box_to_load">
                           
                     @if( !empty($colleges->toArray()) )
                        
                        @php
                           $counter = 0;
                           $limit = 10;
                        @endphp

                        @foreach($colleges as $college)

                           @php
                              
                              
                              if( !empty($college->background_image) ) {
                              $image = 'public/college/'.$college->background_image;

                              #if( @GetImageSize( asset($image) ) ) {

                              #} else {
                              #$image = 'public/logo.png';
                              #}

                              } else {
                                 $image = 'public/logo.png';
                              }
                           @endphp

                           <div class="
                                 box_to_be_loaded
                                 @if($counter >= $limit)
                                    display-none
                                 @endif
                              col-md-6 text-center mb-4 align-items-stretch px-md-3 px-0" data-aos="fade-up">
                              <div class="top_featured rounded border border-muted rounded h-100">
                                 <div class="row mx-md-0 mx-1 align-items-stretch">
                                    <div class="col-12 px-0 position-relative">
                                       <div class="row mx-0 align-items-start top_featured_bg position-relative rounded-top h-100px pt-2" style="background-image:url(<?php echo asset('/public/s_img_new.php')?>?image=<?php echo asset($image) ?>&width=446&height=100&zc=1)">
                                          <div class="col text-left px-2">
                                             @php                                 
                                                if( !empty($college->image) ) {
                                                   $image = 'public/college/'.$college->image;

                                                   #if( @GetImageSize( asset($image) ) ) {

                                                   #} else {
                                                   #$image = 'public/logo.png';
                                                   #}

                                                } else {
                                                   $image = 'public/logo.png';
                                                }

                                                $image = asset($image);
                                             @endphp

                                             <img 
                                                class="img-fluid h-md-80px h-50px w-md-80px w-50px mr-auto rounded p-md-2 p-1"
                                                src="https://www.coachingselect.com/public/s_img_new.php?image={{ $image }}&width=80&height=80&zc=1"
                                                alt="{{ 
                                                   basename( $image )
                                                }}"
                                                style="backdrop-filter: blur(5px);">
                                          </div>
                                          <div class="col-auto fs-11 text-white bg-all-section py-1 rounded d-flex align-items-center  left-0 top-0px mr-2">
                                             <a 
                                                href="javascript:;"
                                             ></a>
                                             <p class="mb-0 text-white text-left"><span class="d-block fs-10">
                                             </span>
                                                <strong>{{ substr($college->reviews_ratings ?? '', 0, 3) }} <i class="far fa-heart fs-12"></i></strong>
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-12 bg-white rounded-right px-0 text-right h-100">
                                       <div class="row mx-0 featured_collages_inner text-left px-2 py-2 bg-white rounded-top">
                                          <a 
                                             href="{{ action('Website\CollegeController@college', $college->college_name_slug) }}"
                                             class="col-12 px-2">
                                             <h2 class="fs-lg-15 fs-md-14 fs-13 font-weight-bold text-secondary mt-0 mb-0 ellipsis-1">
                                                {{$college->college_name}}
                                             </h2>
                                          </a>
                                       </div>
                                       <div class="row mx-0 featured_collages_inner bg-light rounded-bottom row text-left px-2 pb-2 pt-2">
                                          <div class="col-6 px-2">
                                             <a class="row justify-content-between align-items-center" href="javascript:;">
                                                <div class="col-12 text-secondary fs-12 mb-1"> 
                                                   {{$college->city ?? ''}}, {{$college->state ?? ''}} 
                                                </div>
                                                <div class="col-12 fs-12 text-dark">
                                                   @php
                                                      $getcourse = json_decode($college->courses_details, true);
                                                      $getcoursefee = json_decode($college->course_fee, true);
                                                   @endphp

                                                      @if( 
                                                         !empty(
                                                            $college->course_name
                                                         ) 
                                                      )
                                                         {{$college->course_name}}
                                                      @endif
                                                </div>
                                             </a>
                                          </div>
                                          <div class="col-6 px-2">
                                             <div class="row">
                                                @if( 
                                                   !empty(
                                                   $getcoursefee
                                                   [$college->course_stream_id]
                                                   [$college->landing_page_highlight_course]
                                                   ) 
                                                )
                                                <span class="col-12 fs-11 text-dark text-right">
                                                
                                                <strong class="text-all-section fs-13">
                                                ₹{{$getcoursefee
                                                   [$college->course_stream_id]
                                                   [$college->landing_page_highlight_course]}}</strong> OVERALL FEES
                                                
                                                </span>
                                                @endif
                                                <a 
                                                   class="col-12 d-block text-dark text-right text-underline fs-12"
                                                   href="{{ action('Website\CollegeController@college', $college->college_name_slug) }}">
                                                   VIEW ALL COURSES &amp; FEES
                                                </a>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-12">
                                             <div class="row mx-0 my-3 justify-content-center">
                                                <div class="see_all col-6 text-right">
                                                   <a 
                                                      class="w-md-100 w-auto btn btn-sm btn-green border border-primary rounded-0 d-flex align-items-center h-40px justify-content-center width_know_btn fs-md-13 fs-12" 
                                                      href="{{ action('Website\CollegeController@college', $college->college_name_slug) }}"
                                                      ><span> Know More</span> </a>
                                                </div
                                                >@php   
                                                   $brochure_or_pdf = '';                              
                                                   if( !empty($college->brochure_or_pdf) ) {
                                                      $brochure_or_pdf = 'public/college/'.$college->brochure_or_pdf;

                                                      #if( @GetImageSize( asset($brochure_or_pdf) ) ) {

                                                      #} 

                                                      $brochure_or_pdf = asset($brochure_or_pdf);
                                                   } 

                                                @endphp
                                                         
                                                @if( !empty($brochure_or_pdf) )
                                                <div class="see_all col-6 text-right">
                                                   
                                                   <a 
                                                      class="w-100 btn btn-sm btn-outline-secondary rounded-0 d-flex align-items-center h-40px justify-content-center width_brochure_btn" 
                                                      href="{{ $brochure_or_pdf ?? '#' }}" target="_blank">
                                                      <i class="fad fa-arrow-to-bottom mr-2"></i> <span> Brochure</span> </a>
                                                </div>
                                                @endif
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>       

                           @php
                              $counter += 1;
                           @endphp                 
                        @endforeach
                     @else                  
                        <div class="col-12 d-flex justify-content-center my-3">
                           <h3 class="text-danger text-center">No Results Found</h3>
                        </div>
                     @endif

                     @if( 
                        !empty($colleges->toArray())
                        and
                        count($colleges) >= 11
                     )
                        <div id="load_more_loader" class="col-12 text-center py-2">
                           <img src="{{ asset('public/website') }}/assets/img/loader.gif" class="w-100px" 
                           alt="{{ 
                              basename( asset('public/website/assets/img/loader.gif') )
                           }}">
                        </div>
                     @endif
                  </div>
               </div>
               <div class="col-12 px-0 mb-4">
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
      </div>
      <!-- </div> -->
   </div>
   <!-- blog-section SECTION START  -->
</main>


<script>
   $(document).on(
      'click',
      '.checkboxes',
      function() {
         $('#filter_form').submit();
      }
   );
</script>

<script>
   $(document).on(
      'click',
      '.closebtn',
      function() {

         var selected_filter = $(this).data('selected-filter');

         $('input[value="' + selected_filter + '"]').prop('checked', false);

         $('#filter_form').submit();
      }
   );
</script>

<script>
   $(document).on(
      'change',
      'input[name="sort"]',
      function() {
         $('#filter_form').submit();
      }
   );
</script>


<script>
   $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() 
      > $("#box_to_load").height()-50)
      {

         if( 
            $("#box_to_load")
            .find('.box_to_be_loaded.display-none')
            .slice(0,10)
            .length == 0
         ) {
            $('#load_more_loader').remove();
         } else {

            $("#box_to_load")
               .find('.box_to_be_loaded.display-none')
               .slice(0,10)
               .removeClass('display-none', 800);
         }
      }
   });
</script>

@include('website/layouts/footer')