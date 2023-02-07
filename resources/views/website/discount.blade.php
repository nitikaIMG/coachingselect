@include('website/layouts/header')
<style type="text/css">
   .offercode_span{
          margin-left: 40px;
        color: green;
   }
</style>
<main id="main">
   <section id="discount-page" class="discount-page" 
   style="background-image: url({{asset('public/website/')}}/assets/img/discount.jpg);" >
      <div class="container position-relative z-index-2">
         <div class="row align-items-center">
            <div class="col-lg-7 mb-lg-0 mb-md-5 mb-4">
               <div class="discount_heading">
                   <h2 class="fs-md-36 fs-22 font-weight-bold text-white mb-md-4 mb-3">
                     {{ $coaching_course->course->course_name ?? '' }} ({{ $coaching_course->course->course_name ?? '' }})
                   </h2>
                  <h3 class="fs-md-20 fs-17 text-white text-uppercase mb-md-4 mb-3">
                     {{ $coaching_course->offering ?? '' }}
                  </h3>
                  <p class="fs-md-15 fs-14 mb-0 text-white text-justify"><strong>Note:</strong>
                     {{ $coaching_course->description ?? '' }}
                  </p>

                  <h2 class="mt-md-4 mt-3 fs-md-22 fs-18 text-white text-uppercase mb-md-4 mb-3">
                     Offers
                  </h2>

                  <div class="row fs-md-20 fs-17" id="offer_div">
                  
                     @if( !empty( $header->offers()->toArray() ) ) 
                        @foreach($header->offers() as $offer)
                           <div class="col-lg-4 col-md-6 col-6 offer" 
                              data-minamount={{ $offer->minamount ?? 0 }}
                              data-maxamount={{ $offer->maxamount ?? 0 }}
                           >
                              <div class="card mb-md-3 md-3 box-shadow">
                                 <div class="card-header px-2">
                                    <h4 class="text-center fs-md-16 fs-14 my-0 font-weight-600">
                                       {{$offer->title ?? ''}}
                                    </h4>
                                 </div>
                                 <div class="card-body p-3">
                                    <h1 class="text-center card-title pricing-card-title fs-md-34 fs-24 mb-0">
                                       @if($offer->bonus_type=='rs')
                                       ₹{{$offer->bonus ?? ''}}
                                       @else
                                       {{$offer->bonus ?? ''}}%
                                       @endif
                                    </h1>
                                    <ul class="text-center list-unstyled mt-2 mb-2 fs-md-16 fs-14">
                                    <li>
                                       {{$offer->offercode ?? ''}}
                                    </li>
                                    </ul>
                                    <button type="button" class="btn fs-13 btn-sm btn-block btn-outline-primary offercode_span1"
                                       onclick="apply('{{$offer->offercode ?? ''}}')" id="id{{$offer->offercode}}" >
                                       Apply
                                    </button>
                                    <span class="offercode_span d-none" id="span{{$offer->offercode}}">Applied</span>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     @else
                        <h4 class="text-white fs-md-20 fs-17">
                           No Offers Found
                           
                        </h4>
                     @endif
                  </div>
               </div>
            </div>

            <div class="col-lg-5">
               <div class="rounded bg-light shadow p-3">
                  <div class="py-1 px-3 rounded shadow bg-white">
                     <div class="row align-items-center border-bottom py-3">
                        <div class="col-md-auto text-md-left text-center mb-md-0 mb-2">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">{{ $coaching_course->course->coaching_name ?? '' }} :</h3>
                        </div>
                        <div class="col-sm text-md-right text-center">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">
                              <img src="{{ asset('public/coaching/'.$coaching_course->course->coaching_image ) }}" class="img-resposive " width="60px">
                           </h3>
                        </div>
                     </div>
                     <div class="row align-items-center border-bottom py-3">
                        <div class="col-md-auto text-md-left text-center mb-md-0 mb-2">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">Course Name :</h3>
                        </div>
                        <div class="col-sm text-md-right text-center">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">
                              {{ $coaching_course->course->course_name ?? '' }}
                           </h3>
                        </div>
                     </div>
                     @php
                        $discount_price = ($coaching_course->fee * $coaching_course->offer_percentage) / 100;
                        $final_price = ($coaching_course->fee - $discount_price);
                     @endphp
                     <div class="row align-items-center border-bottom py-3">
                        <div class="col-sm text-md-left text-center mb-md-0 mb-2">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">Course Fee :</h3>
                        </div>
                        <div class="col-md-auto text-md-right text-center">
                           <strong class="text-secondary fs-md-14 fs-13">
                              @if( !empty($coaching_course->offer_percentage) )
                              <del class="fs-md-14 mr-2">
                                 ₹ {{ $coaching_course->fee ?? '' }}
                              </del>&nbsp;&nbsp; {{ $coaching_course->offer_percentage }}% Off <br>
                              @endif
                           ₹ {{ $final_price ?? '' }}</strong>
                        </div>
                     </div>
                     
                     @if($coaching_course->gst_inclusive_exclusive == 'exclusive')
                     <div class="row align-items-center border-bottom py-3">
                        <div class="col-sm text-md-left text-center mb-md-0 mb-2">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">GST :</h3>
                        </div>
                        <div class="col-md-auto text-md-right text-center">
                           <strong class="text-secondary fs-md-14 fs-13">
                           ₹ <span id="gst_price">{{$final_price * 18 / 100}}</span></strong>
                        </div>
                     </div>
                     <?php $final_price= $final_price+$final_price * 18 / 100; ?>
                    
                     <div class="row py-3 border-bottom align-items-center">
                        <div class="col-sm text-md-left text-center mb-md-0 mb-2">
                           <h3 class="text-secondary fs-md-16 fs-13 font-weight-bold mb-0">Final Price :</h3>
                        </div>
                        <div class="col-md-auto text-md-right text-center">
                           <strong class="text-secondary fs-md-16 fs-13">
                           ₹ 
                           <span id="">
                              {{ $final_price ?? '' }}
                           </span>
                           <span class="d-none" id="final_price">
                              {{ $final_price ?? '' }}
                           </span>
                           </strong>
                        </div>
                     </div>
                      @endif
                     <div class="row align-items-center border-bottom py-3 justify-content-between">
                        <div class="col-md-auto text-md-left text-center mb-md-0 mb-2">
                           <h3 class="text-secondary fs-md-14 fs-13 font-weight-bold mb-0">Discount Code :</h3>
                        </div>
                        <div class="col-sm text-md-right text-center">
                           <form 
                              action="{{ action('Website\OrderController@order') }}" 
                              method="post" 
                              class="row" 
                              autocomplete="FALSE"
                              id="order_form"
                              >
                              @csrf
                              <div class="form-group mb-0 col-12">
                                 <div class="input-group justify-content-end">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text d-grid align-items-center justify-content-center bg-secondary">
                                       <i class="fas fa-tags"></i>
                                       </span>
                                    </div>
                                    <input type="text" 
                                    name="code" class="form-control shadow-none h-50px" id="input-email" placeholder="Discount code">


                                    <button 
                                       onclick="remove_code()"

                                       class="bg-danger border-0 rounded-right h-38px w-40px fs-15  d-none" type="button" id="danger_btn_id">
                                       <i class="fas fa-times"></i>
                                    </button>

                                    <button onclick="check_code()"
                                    class="bg-success border-0 rounded-right h-38px w-40px fs-15" type="button" id="success_btn_id">
                                    <i class="fas fa-check"></i>
                                    </button>
                                 </div>
                              </div>
                              <input name="registration_fee"  type="hidden" id="registration_fee_id_id" value="{{ $registration_fee }}">
                              <input name="ttl_price" type="hidden" id="ttl_price_id_id" value="{{ $final_price }}">
                              <input name="remaining_fee" type="hidden" id="remaining_fee_id_id" value="{{$remaining_fee}}">
                              <input 
                              name="discount_total" 
                              type="hidden" 
                              id="discount_total" 
                              value=""
                              >
                           </form>
                        </div>
                     </div>
                     <div class="row align-items-center">
                        <div class="col-12">
                           <div 
                           id="discount_container"
                           class="d-none row py-3 border-bottom align-items-center">
                              <div class="col-sm text-md-left text-center mb-md-0 mb-2">
                                 <h3 class="text-secondary fs-md-16 fs-13 font-weight-bold mb-0">
                                 Discount :</h3>
                              </div>
                              <div class="col-md-auto text-md-right text-center">
                                 <strong class="text-secondary fs-md-16 fs-13">
                                 - ₹ 
                                 <span id="discount"></span>
                                 <span id="discount1"></span>

                                 </strong>
                              </div>
                           </div>

                           <div class="row py-3 border-bottom align-items-center">
                              <div class="col-sm text-md-left text-center mb-md-0 mb-2">
                                 <h3 class="text-secondary fs-md-16 fs-13 font-weight-bold mb-0">@if($registration_fee==0) Amount Paid @else Reg. Fee @endif :</h3>
                              </div>
                              <div class="col-md-auto text-md-right text-center">
                                 <strong class="text-secondary fs-md-16 fs-13">

                                 <del class="fs-md-14 mr-2 d-none" id="del_final_price_id1">
                                        ₹{{ $final_price ?? '' }}</del>&nbsp;&nbsp;
                                 ₹<span id="final_price21">
                                    @if($registration_fee==0)
                                    
                                       {{ $final_price ?? '' }}
                                       

                                    @else
                                    {{ $registration_fee ?? '' }}
                                    @endif
                                 </span>
                                 
                                 </strong>
                              </div>
                           </div>

                           <div class="row py-3 border-bottom align-items-center">
                              <div class="col-sm text-md-left text-center mb-md-0 mb-2">
                                 <h3 class="text-secondary fs-md-16 fs-13 font-weight-bold mb-0">Remaining Amount :</h3>
                              </div>
                              <div class="col-md-auto text-md-right text-center">

                                 <strong class="text-secondary fs-md-16 fs-13">
                                    <del class="fs-md-14 mr-2 d-none" id="del_final_price_id">
                                       ₹ {{ $final_price-$registration_fee ?? '' }}</del>&nbsp;&nbsp; 
                                    ₹<span id="remaining_fee"> @if($remaining_fee==0)
                                    0
                                    @else
                                       {{ $remaining_fee ?? '' }}
                                       <p class="fs-10">“Rest of the fees is to be paid on coaching”</p>
                                    @endif
                                 </span></strong>
                              </div>
                           </div>
                           <div class="row py-3 align-items-center">
                              <div class="col-12 text-left">
                                 <div class="custom-control custom-checkbox">
                                    <input 
                                    required
                                    form="order_form"
                                    type="checkbox" name="terms" class="custom-control-input" id="check-new" value="1" required="">
                                    <label class="custom-control-label fs-md-14 fs-13" for="check-new">I agree with the <a href="{{ asset('terms_condition') }}" target="_blank">Terms & Conditions </a> and <a href="{{ asset('privacy_policy') }}" target="_blank">Privacy Policy </a> of CoachingSelect.</label>
                                 </div>
                                 <button 
                                 form="order_form"
                                 type="submit" class="btn btn-primary btn-block mt-4" href="javascript:;">Proceed To Pay
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>

<!-- hide offers -->
<script>
   var final_price = {{ $final_price ?? 0 }};

   $('.offer').each(
      function() {
         if(
            $(this).data('maxamount') >= final_price &&  $(this).data('minamount') <= final_price
         )
         ;
         else
            $(this).remove();
      }
   );

   if( 
      $('.offer').length == 0
   ) {
      $('#offer_div').html(`<h4 class="text-white">
                              No Offers Found
                           </h4>`);
   }
</script>

<script>
   function remove_code() {
      var code = $('input[name="code"]').val();
     var discount =$('#discount').text();
      var registration_fee= $('#registration_fee_id_id').val();
      <?php if($registration_fee!=0){?>
         var final_price =$('#final_price').text();
         var remaining_fee =$('#remaining_fee').text();
          var ttlamount= parseInt(final_price) + parseInt(discount);
         var ttlamount1= parseInt(remaining_fee) + parseInt(discount);
         $('#final_price').text(ttlamount);
         $('#remaining_fee').text(ttlamount1);
         $('#remaining_fee_id_id').val(ttlamount1);
         $('#del_final_price_id').addClass('d-none');
      <?php }else{?>
         var final_price =$('#final_price21').text();
         var ttlamount= parseInt(final_price) + parseInt(discount);
         $('#final_price21').text(ttlamount);
         $('#del_final_price_id1').addClass('d-none');
         $('#ttl_price_id_id').val(ttlamount);
      <?php }?>
         $('#discount').addClass('d-none');
         $('#discount_container').addClass('d-none');
         $('#success_btn_id').removeClass('d-none');
         $('#danger_btn_id').addClass('d-none');
         $('#span'+code).addClass('d-none');
         $('#id'+code).removeClass('d-none');
         $('#input-email').val('');
         $('#del_final_price_id1').addClass('d-none');
         $('#del_final_price_id').addClass('d-none');
   }

   function check_code() {
      var code = $('input[name="code"]').val();
      var final_price = {{ $final_price ?? 0 }};
      if(code != '') {
         $.ajax({
            url: '{{ action("Website\OrderController@code") }}',
            data: {
               code,
               final_price
            },
            success: function(data) {

               if(data == 0) {   
                  $('#discount_container').addClass('d-none');
                  
                  $('#discount').text(0);

                  $('#discount_total').val(0);
                  
                  $('#final_price').text("{{ $final_price ?? '' }}");

                  Swal.fire('Invalid Offer Code');
               } else {
                  var applied = $('#input-email').val();
                  if(applied==code){
                     $('#span'+code).removeClass('d-none');
                     $('#id'+code).addClass('d-none');
                  }
                  $('#discount_container').removeClass('d-none');
                  $('#discount').text(data);

                  $('#discount_total').val(data);

                  var final_price = {{ $final_price ?? 0 }};
                  var registration_fee= $('#registration_fee_id_id').val();

                  <?php if($registration_fee!=0){?>
                     $('#final_price').text(final_price - data);
                     $('#remaining_fee').text(final_price - data - registration_fee);
                     $('#remaining_fee_id_id').val(final_price - data-registration_fee);
                     $('#del_final_price_id').removeClass('d-none');
                  <?php }else{?>
                     $('#del_final_price_id1').removeClass('d-none');
                     $('#final_price21').text(final_price - data);
                     $('#ttl_price_id_id').val(final_price - data);
                  <?php }?>
                 
                  
                  $('#success_btn_id').addClass('d-none');
                  $('#danger_btn_id').removeClass('d-none');
                  Swal.fire('Offer Code Applied Successfully');
               }

            }
         });
      }
   }
</script>


<script>
   function apply(code) {
      var oldcode = $('#input-email').val();
      $('input[name="code"]').val(code);
      var final_price = {{ $final_price ?? 0 }};
      $('#discount').removeClass('d-none');
      if(code != '') {
         $.ajax({
            url: '{{ action("Website\OrderController@code") }}',
            data: {
               code,
               final_price
            },
            success: function(data) {
               if(data == 0) {   
                  $('#discount_container').addClass('d-none');
                  
                  $('#discount').text(0);
                  
                  $('#discount_total').val(0);

                  $('#final_price').text("{{ $final_price ?? '' }}");

                  Swal.fire('Invalid Offer Code');
               } else {
                  var applied = $('#input-email').val();
                  if(applied==code){
                     $('#span'+code).removeClass('d-none');
                     $('#id'+code).addClass('d-none');
                     $('#span'+oldcode).addClass('d-none');
                     $('#id'+oldcode).removeClass('d-none');
                  }
                  $('#discount_container').removeClass('d-none');
                  $('#discount').text(data);

                  $('#discount_total').val(data);

                  var final_price = {{ $final_price ?? 0 }};
                  var registration_fee= $('#registration_fee_id_id').val();

                  <?php if($registration_fee!=0){?>
                     $('#final_price').text(final_price - data);
                     $('#remaining_fee').text(final_price - data - registration_fee);
                     $('#remaining_fee_id_id').val(final_price - data-registration_fee);
                     $('#del_final_price_id').removeClass('d-none');
                  <?php }else{?>
                     $('#del_final_price_id1').removeClass('d-none');
                     $('#final_price21').text(final_price - data);
                     $('#ttl_price_id_id').val(final_price - data);
                  <?php }?>
                 
                  
                  $('#success_btn_id').addClass('d-none');
                  $('#danger_btn_id').removeClass('d-none');
                  Swal.fire('Offer Code Applied Successfully');
               }

            }
         });
      }
   }
</script>

<script>

   // purchase lead

   $(document).ready(
      function() {

         var coaching_id = {{ $coaching_course->coaching_id ?? 0 }};
         var coaching_courses_detail_id = {{ $coaching_course->id ?? 0 }};

         $.ajax({
            url: '{{ action("Website\CoachingController@request_callback_purchase") }}',
            data: {
               coaching_id,
               coaching_courses_detail_id
            },
            success: function(data) {
            }
         });

      }
   );

</script>

@include('website/layouts/footer')