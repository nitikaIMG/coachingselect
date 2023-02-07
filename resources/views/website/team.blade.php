@include('website/layouts/header')

<style>
   .img-responsive {
      height: 100%;
   }

   .min_height_fa {
      min-height: 70px !important;
   }

   .bac_color {
      background: white !important;
   }

   .btn-dds:hover {
      color: #000000 !important;
   }
</style>

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner offer_single_banner">
      <div class="container position-relative z-index-2">
         <div class="row align-items-start">
            <div class="col-lg-auto text-center mb-md-0 mb-3">
               <span class="h-md-100px h-75px p-1 d-flex rounded-pill align-items-center justify-content-center border shadow bg-white position-relative w-md-100px w-75px mx-auto">
                  @php
                  $image = asset('public/coaching/'. $coaching->image);

                  if(! @GetImageSize($image) ) {
                  $image = asset('public/logo.png');
                  }
                  @endphp

                  <img class="w-100 h-100 rounded-pill" src="{{ $image }}" alt="">

                  @if($coaching->is_verified == 'yes')
                  <a class="d-flex bg-success position-absolute align-items-center top-n2px right-0 justify-content-center fs-md-14 fs-12 text-white rounded-pill w-md-30px w-24px h-md-30px h-24px shadow" href="javascripts:;"><i class="fas fa-shield-check"></i>
                  </a>
                  @endif
               </span>
            </div>
            <div class="text-left col">
               <h2 class="font-weight-bold text-white fs-xxl-48 fs-xl-48 fs-lg-40 fs-md-32 fs-22">{{ $coaching->name ?? '' }}</h2>
               <p class="fs-md-16 fs-14 text-white mb-md-2 mb-1">

                  @switch($coaching->offering)
                  @case('online')
                  Online Coaching
                  @break

                  @case('classroom')
                  Classroom Coaching
                  @break

                  @case('tutor')
                  Tutor
                  @break

                  @default
                  {{ ucwords( str_replace(',', ' & ', $coaching->offering) ) }} Coaching
                  @break

                  @endswitch

               </p>
               <p class="fs-md-16 fs-14 text-white mb-md-2 mb-1">{{$coaching->tagline ?? ''}}</p>
               <div class="row mt-3 mb-md-0 mb-3 justify-content-md-start justify-content-center">
                  <div class="col-auto px-lg-3 px-md-2 px-2 pr-md-0 mb-md-0 mb-2">
                     @if( session()->has('student'))
                     @if(empty($coaching->is_this_my_favorite))

                     <form action='{{ action("Website\CoachingController@add_to_favorite", $coaching->id) }}' method="post" id="add_to_favorite{{$coaching->id}}">
                        @csrf

                        <button type="submit" class="favroute_btn btn btn-sm border-0 rounded-pill text-white
                           " id="add_to_favorite{{$coaching->id}}"><i class="fas fa-heart mr-2  text-white" id="add_to_favorite_icon"></i>
                           <span id="add_to_fav_status">
                              @if($coaching->is_this_my_favorite)
                              Add to Favourites
                              @else
                              Add to Favourites

                              @endif
                           </span>
                        </button>
                     </form>
                     @else
                     <a href="javascript:;" class="favroute_btn btn btn-sm border-0 rounded-pill text-dark active bac_color"><i class="fas fa-heart mr-2 text-dark bac_color" id="add_to_favorite_icon"></i>
                        <span id="add_to_fav_status">
                           Add to Favourites
                        </span>
                     </a>
                     @endif
                     @else
                     <a href="javascript:;" class="favroute_btn btn btn-sm border-0 rounded-pill text-white" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-heart mr-2 text-white" id="add_to_favorite_icon"></i>Add to Favourites</a>
                     @endif
                  </div>
                  <div class="col-auto px-lg-3 px-md-2 px-2">
                     <form action="{{ action('Website\CoachingCompareController@compare') }}" id="compare">
                        <input type="hidden" name="coachings[]" value="{{$coaching->name ?? ''}}" class="shadow coachings" placeholder="Find Coaching">
                        <a onclick="this.parentElement.submit()" href="javascript:;" class="compare_btn btn btn-sm btn-green border-0 rounded btn-dds"><span><i class="fas fa-balance-scale-right mr-2"></i>Add to Compare </span></a>
                     </form>

                  </div>
               </div>
            </div>
            <div class="col text-right my-md-0 my-4">
               <div class="row align-items-stretch">
                  <div class="col-12">
                     <form action='{{ action("Website\CoachingController@request_callback", $coaching->id) }}' method="post" id="request_callback{{$coaching->id}}">
                        @csrf
                        @if( session()->has('student'))
                        <button type="submit" @if( session()->has('student') and !$coaching->has_requested_for_callback)

                           @elseif(! session()->has('student') )
                           data-toggle="modal" data-target="#exampleModal1"
                           @endif
                           class="btn btn-sm btn-outline-white text-white

                           @if($coaching->has_requested_for_callback)
                           active text-dark
                           @endif

                           "
                           >
                           <i class="fas 
                              @if($coaching->has_requested_for_callback)
                                 text-dark
                              @else 
                                 text-white
                              @endif  
                           fa-phone-volume text-primary mr-2"></i>
                           @if($coaching->has_requested_for_callback)
                           Requested Call back
                           @else
                           Request a Call back
                           @endif
                        </button>
                        @else
                        <a data-toggle="modal" data-target="#exampleModal1" class="btn btn-sm btn-outline-white text-white"><i class="fas  text-white
                           fa-phone-volume text-primary mr-2"></i>Request a Call back</a>
                        @endif
                     </form>
                  </div>
                  <div class="col-12 d-flex align-items-center justify-content-md-end justify-content-center my-lg-4 my-md-2 my-2">
                     <div class="set-size">
                        <div class="pie-wrapper progress-45 style-2">
                           <span class="label d-flex align-items-center flex-wrap justifi-content-center">
                              @if($coaching->ratings!=0)
                              {{ $coaching->ratings ?? ''}} <strong class="d-block w-100"><i class="ml-1 fs-10 fas fa-star"></i></strong></span>
                           @else
                           <p class="mar_top_pro">N/A</p>
                           @endif
                           <strong class="d-block w-100 ml-1"></strong></span>
                           <div class="pie">
                              <div class="left-side half-circle"></div>
                              <div class="right-side half-circle"></div>
                           </div>
                           <div class="shadow"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <a href="#review_sec" class="btn scroll-to btn-sm btn-outline-secondary btn-secondary text-white"><i class="fas fa-pencil-alt mr-2"></i>Leave A Review </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- inner banner section  -->
   <!-- get offer section  -->
   <section id="get_offer" class="get_offer overflow-hidden">
      <div class="container">
         <div class="row">
            <div class="col-md-12 mx-0">
               <div class="row shadow mx-0 px-3 py-3 bg-white rounded">
                  <div class="d-flex tab_offer align-items-center col border-0 justify-content-start">
                     <a href="{{ action('Website\CoachingController@overview', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right rounded-left border-0">Overview</a>
                     <a href="{{ action('Website\CoachingController@courses', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Course</a>
                     <a class="active-tab text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Team</a>
                     <a href="{{ action('Website\CoachingController@results', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Results</a>
                     <a href="{{ action('Website\CoachingController@gallery', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0">Gallery</a>
                     <a href="{{ action('Website\CoachingController@reviews', $coaching->coaching_name_slug) }}" class="text-uppercase bg-secondary text-white px-4 py-2 w-100 text-center border-right border-0  rounded-right">Reviews</a>
                  </div>
               </div>
               <div class="overview_section mt-md-5 mt-4">
                  @if( !empty($coaching->faculty->toArray()) )
                  <div class="row mt-lg-5 mt-md-4 mt-0 mx-lg-0 mx-md-4 overflow-hidden">
                     <div class="col-md-12 mt-3 faculty_courses">
                        <div class="text-left border-bottom">
                           <h2 class="font-weight-bold fs-lg-20 fs-md-18 fs-16 mb-2">Our Esteemed Mentors of {{ $coaching->name ?? '' }} </h2>
                        </div>
                        <div class="our_team_slider mt-4 owl-carousel">

                           @foreach($coaching->faculty as $faculty)
                           <div class="team_box bg-white overflow-hidden position-relative p-3 shadow rounded text-center mx-md-3 mx-2">
                              <div class="mt-2 mb-3">
                                 <span class="h-80px w-80px mx-auto d-flex align-items-center justify-content-center shadow rounded-pill p-1 border position-relative">

                                    @php
                                    $image = asset('public/coaching_faculty/'. $faculty->image);

                                    if(! @GetImageSize($image) ) {
                                    $image = asset('public/user.png');
                                    }
                                    @endphp

                                    <img class="img-fluid rounded-pill h-100" src="{{ $image }}" alt="">
                                    <a class="d-flex bg-primary position-absolute align-items-center top-0 right-0 justify-content-center fs-10 text-white rounded-pill w-20px h-20px shadow" href="{{ $faculty->link }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                 </span>
                              </div>
                              <h2 class="bg-primary d-block fs-md-16 fs-14 text-white py-2 my-2">
                                 {{ substr($faculty->name,0,26) ?? '' }}
                              </h2>
                              <div class="min_height_fa">
                                 <span class="d-block fs-md-14 fs-12 text-nowrap overflow-hidden">
                                    {{ substr($faculty->designation,0,30) ?? '' }}
                                 </span>
                                 <label class="d-block fs-md-14 fs-12 text-nowrap overflow-hidden">
                                    @if( !empty($faculty->education) )
                                    {{ substr($faculty->education,0,30) ?? '' }}
                                    <br>
                                    @endif
                                    @if(!empty($faculty->experience))
                                    {{ $faculty->experience ?? '' }}+ Years Exp
                                    @else
                                    <br>
                                    @endif

                                 </label>
                              </div>
                              <div class="hover_linkden rounded">
                                 <a class="d-flex align-items-center justify-content-center text-white rounded-pill w-50px h-50px shadow" href="{{ $faculty->link }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                              </div>
                           </div>
                           @endforeach

                        </div>
                     </div>
                  </div>

               </div>
               @endif
            </div>
         </div>
      </div>
   </section>
   <!-- get offer section  -->
</main>

<script>
   $('#add_to_favorite').click(
      function() {
         var is_favorite = $('#add_to_favorite').hasClass('active');

         $.ajax({
            url: '{{ action("Website\CoachingController@add_to_favorite", $coaching->id) }}',

            success: function(data) {
               if (data == 1) {

                  if (is_favorite) {
                     $('#add_to_favorite').removeClass('text-dark active');
                     $('#add_to_favorite').removeClass('bac_color');
                     $('#add_to_favorite').addClass('text-white');
                     $('#add_to_favorite_icon').removeClass('text-dark');
                     $('#add_to_favorite_icon').addClass('text-white');
                     $('#add_to_fav_status').text('Add to Favourites');
                  } else {
                     $('#add_to_favorite').addClass('text-dark active');
                     $('#add_to_favorite').addClass('bac_color');
                     $('#add_to_favorite').removeClass('text-white');
                     $('#add_to_favorite_icon').addClass('text-dark');
                     $('#add_to_favorite_icon').removeClass('text-white');
                     $('#add_to_fav_status').text('Remove from Favourites');
                  }

               } else {
                  swal.fire({
                     title: 'Alert',
                     'text': 'Unable to add favorite. Please login to proceed.'
                  });
               }
            }
         });
      }
   );
</script>

<!-- reviews -->

<script>
   $(document).on('click', '.stars', function() {

      $('.stars').removeClass('text-warning');

      for (var i = 1; i <= $(this).data('id'); i++) {
         $('[data-id=' + i + ']').addClass('text-warning');
      }

      $('input[name="stars"]').attr('value', $(this).data('id'));
      $('input[name="stars"]').val($(this).data('id'));

   });
</script>

<script>
   function is_stars_selected() {
      if (
         $('input[name="stars"]').attr('value')
      ) {
         return true;
      } else {

         swal.fire({
            'title': 'Alert!',
            'text': 'Please choose stars'
         });

         return false;
      }
   }
</script>

@include('website/layouts/footer')