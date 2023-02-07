@include('website.layouts.header')

<style>
   .plan-title {
      text-transform: none !important;
   }
</style>

<main id="main">
   <!-- inner banner section  -->
   <section id="inner_banner" class="inner_banner_2 pb-5 pt-4" style="background: linear-gradient(-550deg, hsl(var(--color-secondary) / 96%), hsl(var(--color-primary) / 80%) ),url({{ asset('public/website/') }}/assets/img/bg_756454.jpg); background-size: cover !important;background-position: center;">
      <div class="container position-relative z-index-2">
         <div class="row text-center pb-md-5 pb-4">
            <h2 class="col-12 font-weight-bold text-white fs-lg-30 fs-md-22 fs-18 text-right">Coaching Plans</h2>
         </div>
      </div>
   </section>
   <!-- inner banner section  -->
   <div class="plans_box pb-4">
      <div class="container">
         <div class="row justify-content-center">

            @if( !empty($plans) )
               @foreach($plans as $type => $plan)
                  @if( !empty($plan) )
                     
                     @php
                        $i = 1;
                     @endphp
                     
                     @foreach($plan as $result) 
                        <div class="card_plans col-lg-4 col-md-6 d-flex align-items-stretch">
                           <div class="plan">
                              <div class="header_outer">
                                 <h4 class="plan-title">
                                    {{$result->name}}
                                 </h4>
                                 <div class="plan-cost"><span class="plan-price">
                                 ₹{{$result->fee}}</span><span class="plan-type">
                                 /{{$type}}</span></div>
                              </div>
                              <ul class="plan-features">
                                 @if( !empty($all_plans_specification) )
                                    @foreach($all_plans_specification as $specification)
                                       @if( in_array($specification, $result->specification))
                                       <li>

                                          @if( in_array($specification, $result->specification))
                                             <i class="fad fa-check-circle mr-2 text-white fs-15"></i> </i>
                                             {{$specification}} 
                                          @else                                             
                                          @endif 
                                       </li>                                           
                                       @endif 
                                    @endforeach
                                 @endif

                              </ul>
                              <div class="plan-select position-relative bottom-0 left-0 right-0">
                              
                              <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                 <form 
                                    action="{{ action('Website\EnterpriseProfileController@select_plan')}}"
                                    method="POST"
                                 >
                                 @csrf
                                 <input 
                                 required
                                 type="hidden" 
                                 name="id"
                                 value="{{$result->id}}">
                                 <button 
                                    type="submit"
                                    class="btn btn-sm btn-primary">
                                    <span>
                                       Select Plan
                                    </span>
                                 </button>
                                 </form>
                              </div>

                              </div>
                           </div>
                        </div>
                     @endforeach
                  @endif
               @endforeach
            @endif
         </div>
      </div>
   </div>
</main>

@include('website.layouts.footer')