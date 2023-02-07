@include('website/layouts/header')

<style>
   img {
      max-width: 100%;
      height: auto !important;
   }

   .comment_image {
      width: 35px;
      height: 35px;
   }

   .setImageSize {
      width: 860px;
      height: 430px;
   }

   .latest_news_date {
      margin-left: -60px;
   }
   @media (max-width: 767px){
      .latest_news_date {
         margin-left: -14px;
         display: inline-flex;
      }  
   }
</style>

<main id="main">

   <div class="contaier-fluid latest_coaching_news py-5">
      <div class="container pt-md-3">
         <div class="row" id="box_to_load">
            <div class="col-12">
               <div class=" mb-4">
                  <span class="text-gray font-weight-bold fs-13">
                     CoachingSelect
                  </span>
                  
                  <h2 class="fs-lg-36 fs-md-30 fs-18 text-secondary font-weight-bold">
                     <span class="text-primary">News</span> 
                     and  
                     <span class="text-primary">Articles</span>
                  </h2>
               </div>
            </div>

            @if( !empty($news->toArray()) )
               
               @php
                  $counter = 0;
                  $limit = 10;
               @endphp

               @foreach($news as $trending_today_single)
                     
                  @php
                     $trending_today_single_slug = str_replace(' ', '-', $trending_today_single->title);
                  @endphp
                                    
                  <div class="col-md-6 mb-4
                     box_to_be_loaded
                     @if($counter >= $limit)
                        d-none
                     @endif
                  ">
                     <div class="latest_news_box bg-light shadow border rounded p-3">
                        <div class="row bg-white mx-0 py-3 px-2 align-items-start">
                           <div class="col-md-auto">
                              <div class="latest_news_date rounded text-center w-md-50px w-auto border">
                                 <div class="bg-secondary text-white rounded-top h-35px d-flex align-items-center justify-content-center px-2">
                                    <span class="fs-md-15 fs-14 font-weight-bold">
                                       {{date('d', strtotime($trending_today_single->created_at) )}}   
                                    </span>
                                 </div>
                                 <div class="bg-white rounded-bottom h-35px d-flex align-items-center justify-content-center px-2">
                                    <span class="fs-14">
                                       {{date('M', strtotime($trending_today_single->created_at) )}}
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="col pl-0">
                              <div class="latest_news_text">
                                 <h2 class="fs-lg-17 fs-md-14 fs-14 mt-md-2 mt-3 font-weight-bold">
                                    {{$trending_today_single->title}}
                                 </h2>
                                 <a class="d-inline-flex fs-13 font-weight-600 align-items-center" 
                                    @if($trending_today_single->type == 'url')
                                       href="{{$trending_today_single->url}}"
                                    @else 
                                       href="{{ action('Website\TrendingTodayController@news', $trending_today_single_slug) }}"
                                    @endif

                                    target="_blank"
                                 >VIEW MORE<i class="fas fa-chevron-right ml-2"></i></a>
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
               Not available
            @endif

            @if( 
               !empty($news->toArray())
               and
               count($news) >= 11
            )
               <div id="load_more_loader" class="col-12 text-center py-2">
                  <img src="{{ asset('public/website') }}/assets/img/loader.gif" class="w-100px" alt="">
               </div>
            @endif
         </div>
      </div>
   </div>

</main>

<script type="text/javascript">
   $('#story_image_main').addClass('setImageSize');
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