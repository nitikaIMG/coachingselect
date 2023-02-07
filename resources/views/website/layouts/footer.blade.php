<footer class="footer_wrapper w-100 overflow-hidden">
   <div class="container-fluid px-md-3 px-0">
      <div class="footer_link_block row mx-0 pb-5">
         <div class="container">
            <div class="row">
               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">top colleges</span>

                     @php
                        $i = 1;
                     @endphp

                     @if( !empty($header->college_category()) )
                        @foreach($header->college_category() as $category)

                           @if($i <= 6)
                           <a 
                              href="{{ action('Website\CollegeController@colleges') }}?filters[category][]={{$category->name}}"
                              class="link d-block shadow-none">
                              {{$category->name}}
                           </a>
                           @endif

                           @php
                              $i += 1;
                           @endphp
                        
                        @endforeach
                     @endif
                  </div>

               </div>

               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">top coachings</span>

                     @php
                        $i = 1;
                     @endphp

                     @if( !empty($footer->coachings()) )
                     @foreach($footer->coachings() as $coaching)
                     
                     @if($i <= 6)
                     <a 
                        href="{{ action('Website\CoachingSearchController@coaching_search') }}?course={{$coaching->name}}"
                        class="link d-block shadow-none">
                        {{$coaching->name}}
                     </a>
                     @endif
               
                     @php
                        $i += 1;
                     @endphp

                     @endforeach
                     @endif
                  </div>

               </div>

               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs green-border">top exams</span>
                     
                     @if( !empty($footer->exams()) )
                        @foreach($footer->exams() as $exam)

                           @php
                              $stream_slug = str_replace(' ', '-', $exam->title);
                           @endphp

                        <a 
                           href="{{ action('Website\ExamsController@stream_wise_exams', $stream_slug) }}"
                           class="link d-block shadow-none">
                           {{$exam->title}}
                        </a>
                        @endforeach
                     @endif

                  </div>
               </div>
               
               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">
                        Study Material
                     </span>

                     @if( !empty($footer->question_paper_subjects()) )
                     @foreach($footer->question_paper_subjects() as $question_paper_subject)
                        @php
                           $stream_slug = str_replace(' ', '-', $question_paper_subject->name);
                        @endphp
                     <a 
                        href="{{ action('Website\FreePreparationToolController@question_papers', $stream_slug) }}"
                        class="link d-block shadow-none">
                        {{$question_paper_subject->name}}
                     </a>
                     @endforeach
                     @endif
                  </div>

               </div>
            </div>
            <div class="row">
               
               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">
                        Resources
                     </span>
                     <a href="{{ action('Website\StudentQuestionsAnswersController@student_questions') }}" class="link d-block shadow-none">
                        Question & Answer   
                     </a>
                     <a href="{{ action('Website\BlogsController@blogs') }}" class="link d-block shadow-none">
                        Blogs
                     </a>
                     <a href="{{ action('Website\CounsellingController@career_counselling') }}" class="link d-block shadow-none">
                        Counselling
                     </a>
                     <a href="{{ action('Website\CoachingSearchController@coaching_search') }}?course=Executive Education&tab=all" class="link d-block shadow-none">
                        Executive Education
                     </a>
                     <a href="{{ action('Website\CoachingCompareController@compare') }}" class="link d-block shadow-none">
                        Coaching Compare
                     </a>
                  </div>

               </div>

               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">
                        CoachingSelect
                     </span>
                     
                     <a href="{{asset('/aboutus')}}" class="link d-block shadow-none">
                        About Us
                     </a>
                     <a href="{{asset('/careers')}}" class="link d-block shadow-none">
                        Careers
                     </a>
                     <a href="{{asset('/contactus')}}" class="link d-block shadow-none">
                        Contact
                     </a>
                     <a href="https://www.coachingselect.com/blog/Content-Guidelines-at-CoachingSelect" class="link d-block shadow-none">
                        Content Guidelines
                     </a>
                     <a href="https://www.coachingselect.com/team" class="link d-block shadow-none">
                        Management Team
                     </a>
                  </div>

               </div>

               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">
                        Coaching
                     </span>
                     
                     <a 
                        data-toggle="modal"
                        data-target="#exampleModal2"
                        href="#" class="link d-block shadow-none"
                        onclick="enterprise_register_tab()"
                     >
                        Add Coaching
                     </a>
                     <a 
                        data-toggle="modal"
                        data-target="#exampleModal1"
                        href="#" class="link d-block shadow-none"
                        onclick="enterprise_login_tab()"
                     >
                        Client Login
                     </a>
                     <a href="{{asset('/contactus')}}?type=advertise" class="link d-block shadow-none">
                        Advertise with us
                     </a>
                     <a href="{{ action('Website\BlogsController@blogs') }}" class="link d-block shadow-none">
                        Write for Us
                     </a>
                  </div>

               </div>
               
               <div class="col">
                  <div class="link_block text-tiny">
                     <span class="link_head text-xs blue-border">
                        Others
                     </span>
                     
                     <a href="{{asset('/privacypolicy')}}" class="link d-block shadow-none">
                        Privacy Policy
                     </a>
                     <a href="{{asset('/terms-condition')}}" class="link d-block shadow-none">
                        Terms & Conditions
                     </a>
                     <a href="{{asset('/faq')}}" class="link d-block shadow-none">
                        FAQs
                     </a>
                     <a href="{{asset('/sitemap.xml')}}" class="link d-block shadow-none">
                        Sitemap
                     </a>
                     <a href="{{asset('/disclaimer')}}" class="link d-block shadow-none">
                        Disclaimer
                     </a>
                  </div>

               </div>

               
            </div>
         </div>
      </div>
      <div class="row app-row py-3">
         <div class="app-section container">
            <div class="row align-items-center">
               <div class="col-md-4 text-md-left text-center mb-md-0 mb-1">
                  <div class="share_block">
                     <div class="bottom_block">
                        <a href="https://twitter.com/coaching_select" class="social_share facebook" target="_blank">
                           <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/CoachingSelect-108903201456076/" class="social_share twitter" target="_blank">
                           <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/coachingselect/" class="social_share youtube" target="_blank">
                           <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UC-oidnNJnMpKn9LdiTplnHQ" class="social_share linkedin" target="_blank">
                           <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/coachingselect/" class="social_share rss" target="_blank">
                           <i class="fab fa-linkedin"></i>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-8 d-flex align-items-center justify-content-md-end justify-content-center app-img text-right">
                  <div class="copyright-block">
                     <p class="fs-13">© {{date('Y')}} CoachingSelect All Rights Reserved</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- Vendor JS Files -->

<script src="{{ asset('public/website/assets/vendor/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('public/website/assets/vendor/select2/bootstrap-select.js') }}"></script>

<script src="{{ asset('public/website/assets/vendor/datepicker/js/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('public/website/assets/vendor/fast-select/fastselect.standalone.js') }}"></script>

<script>
    
    //  facebook redirect uri
     if (window.location.hash == "#_=_") {
        
        window.location.hash = "";
        
     }
</script>


<script src="{{ asset('public/website/assets/vendor/main-js/main.js') }}"></script>

@if( url()->current() . '/' == asset('/') )
@else
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
@endif

<script src="{{ asset('public/website/assets/vendor/venbox-img/baguetteBox.min.js') }}"></script>


<script type="text/javascript">
   window.onload = function() {
    if (window.jQuery) {  
        // jQuery is loaded  
        $("form").removeAttr("novalidate");
    }
}
</script>

<script>
   baguetteBox.run('.baguetteBoxOne' , {
     animation: 'fadeIn',
     noScrollbars: true
   });
</script>

<!-- call api -->
<script>
   function tempregister() {

      if (!$('#tempregister').valid())
        return;

      console.log('no error');
      
      if (
         $('#tempregister-input-name').val() == '' || $('#tempregister-input-mobile').val() == '' ||
         $('#tempregister-input-email').val() == '' || $('#tempregister-input-password').val() == '' ||
         !$('#check-terms').is(':checked')
      ) {
         $('#tempregister').find('.error_message_to_show').remove();
         $('#tempregister').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields and accept our terms and conditions'+'</p>');

         return false;

      } else {

         if( $('#tempregister-input-mobile').val().length != 10) {

            $('#tempregister').find('.error_message_to_show').remove();
            $('#tempregister').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid mobile number'+'</p>');

            return false;
         }

         var regx = /^[6-9]\d{9}$/;

         if(! regx.test( $('#tempregister-input-mobile').val() ) ) {

            $('#tempregister').find('.error_message_to_show').remove();
            $('#tempregister').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid mobile number'+'</p>');

            return false;
         }

         var regx1 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

         if(! regx1.test( $('#tempregister-input-email').val() ) ) {

            $('#tempregister').find('.error_message_to_show').remove();
            $('#tempregister').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid email'+'</p>');

            return false;
         }

         // if(! (/[A-Za-z]/i.test($('#tempregister-input-password').val()) &&
         //   /[0-9]/.test($('#tempregister-input-password').val()) &&
         //   $('#tempregister-input-password').val().length >= 6) ) {

            if(! ($('#tempregister-input-password').val().length >= 6))  {
               
            $('#tempregister').find('.error_message_to_show').remove();
            $('#tempregister').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Min 6 Characters Password Required'+'</p>');

            return false;
         }

         var url = '{{ action("Website\RegisterController@tempregister") }}';
         var post_data = $('#tempregister').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  var mobile = $('#tempregister-input-mobile').val();

                  $('#mobile_display1').text(mobile);
                  $('#mobile').val(mobile);
                  $('#number-verify').modal('show');

               } else {

                  $('#tempregister').find('.error_message_to_show').remove();
                  $('#tempregister').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

<script>
   function register() {

      if (!$('#register').valid())
        return;

      if (
         $('#mobile').val() == '' ||
         $('input[name="otp[1]"]').val() == '' ||
         $('input[name="otp[2]"]').val() == '' ||
         $('input[name="otp[3]"]').val() == '' ||
         $('input[name="otp[4]"]').val() == '' ||
         $('input[name="otp[5]"]').val() == '' ||
         $('input[name="otp[6]"]').val() == ''
      ) {

         $('#register').find('.error_message_to_show').remove();
         $('#register').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'OTP is required'+'</p>');

         return false;

      } else {

         $('.spinner-border').show();

         var url = '{{ action("Website\RegisterController@register") }}';
         var post_data = $('#register').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  $('#register').find('.error_message_to_show').remove();
                  $('#register').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

                  window.location.href = window.location.href;

                  $('.spinner-border').hide();

                  return false;

               } else {

                  $('#register').find('.error_message_to_show').remove();
                  $('#register').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  $('.spinner-border').hide();
                  
                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

<script>
   function login() {
      if (!$('#login').valid())
        return;

      if (
         $('#login-input-email').val() == '' || $('#login-input-password').val() == ''
      ) {

         $('#login').find('.error_message_to_show').remove();
         $('#login').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         var url = '{{ action("Website\LoginController@login") }}';
         var post_data = $('#login').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  if(data.callback != '') {
                     window.location.href = data.callback;
                  } else {
                     window.location.href = window.location.href;

                     return false;
                  }

               } else {
                  $('#login').find('.error_message_to_show').remove();
                  $('#login').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');
                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

<script>
   function forgot() {

      console.log($('#forgot').valid());
      
      if (!$('#forgot').valid())
        return;

      console.log('validated');

      if (
         $('#forgot-input-mobile').val() == ''
      ) {

         $('#forgot').find('.error_message_to_show').remove();
         $('#forgot').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         var url = '{{ action("Website\LoginController@forgot") }}';
         var post_data = $('#forgot').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  var mobile = $('#forgot-input-mobile').val();

                  $('#mobile_display').text(mobile);
                  $('#forgot-mobile').val(mobile);

                  $('#reset_password_otp_box').removeClass('d-none');

                  $('#reset_password_password_box').addClass('d-none');
                  $('#reset_password_confirm_password_box').addClass('d-none');

                  $('#reset_password_submit_btn').text('Verify Otp');

                  $('#reset-password').modal('show');

               } else {

                  $('#forgot').find('.error_message_to_show').remove();
                  $('#forgot').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

<script>
   function change() {

      if (!$('#change').valid())
        return;
        
      if (
         $('#forgot-email').val() == '' ||
         $('input[name="forgot-otp[1]"]').val() == '' ||
         $('input[name="forgot-otp[2]"]').val() == '' ||
         $('input[name="forgot-otp[3]"]').val() == '' ||
         $('input[name="forgot-otp[4]"]').val() == '' ||
         $('input[name="forgot-otp[5]"]').val() == '' ||
         $('input[name="forgot-otp[6]"]').val() == '' 
      ) {

         $('#change').find('.error_message_to_show').remove();
         $('#change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         if(
            $('#password').val() != '' ||
            $('#confirm-password').val() != ''
         ) {
            
            if(! (/[A-Za-z]/i.test($('#password').val()) &&
            /[0-9]/.test($('#password').val()) &&
            $('#password').val().length >= 6) ) {
                  
               $('#change').find('.error_message_to_show').remove();
               $('#change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid password'+'</p>');

               return false;
            }

            if(! (/[A-Za-z]/i.test($('#confirm-password').val()) &&
            /[0-9]/.test($('#confirm-password').val()) &&
            $('#confirm-password').val().length >= 6) ) {
                  
               $('#change').find('.error_message_to_show').remove();
               $('#change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Password does not match'+'</p>');

               return false;
            }
         }

         var url = '{{ action("Website\LoginController@change") }}';
         var post_data = $('#change').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  if(
                     $('#password').val() == '' ||
                     $('#confirm-password').val() == ''
                  ) {
                     
                     if($('#change_password_otp_box').hasClass('d-none')) {
                  
                        $('#change').find('.error_message_to_show').remove();
                        $('#change').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+'Please enter password and confirm password'+'</p>');

                     } else {

                        $('#change_password_otp_box').addClass('d-none');

                        $('#change_password_password_box').removeClass('d-none');
                        $('#change_password_confirm_password_box').removeClass('d-none');

                        $('#change_password_submit_btn').text('Change Password');

                     }

                     return false;

                  } else {
                  
                     $('.modal').modal('hide');
                     $('#exampleModal1').modal('show');

                  }

               } else {

                  $('#change').find('.error_message_to_show').remove();
                  $('#change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>
<script>
   function resetPassword() {
      iid = $('#reset_password_submit_btn').data('iid');
      if(iid == 1){
         if (
         $('#forgot-mobile').val() == '' ||
         $('input[name="forgot-otp[1]"]').val() == '' ||
         $('input[name="forgot-otp[2]"]').val() == '' ||
         $('input[name="forgot-otp[3]"]').val() == '' ||
         $('input[name="forgot-otp[4]"]').val() == '' ||
         $('input[name="forgot-otp[5]"]').val() == '' ||
         $('input[name="forgot-otp[6]"]').val() == '' 
         ) {

            $('#resetPassword').find('.error_message_to_show').remove();
            $('#resetPassword').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

            return false;

         }
         var url = '{{ action("Website\LoginController@getotp") }}';
      }else if(iid == 2){
         if(
            $('#reset_password').val() != '' ||
            $('#reset-confirm-password').val() != ''
         ) {
            
            if(! (/[A-Za-z]/i.test($('#reset_password').val()) &&
            /[0-9]/.test($('#reset_password').val()) &&
            $('#reset_password').val().length >= 6) ) {
                  
               $('#resetPassword').find('.error_message_to_show').remove();
               $('#resetPassword').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid password'+'</p>');

               return false;
            }
            
            if(! (/[A-Za-z]/i.test($('#reset-confirm-password').val()) &&
            /[0-9]/.test($('#reset-confirm-password').val()) ) ){
                  
               $('#resetPassword').find('.error_message_to_show').remove();
               $('#resetPassword').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Password does not match'+'</p>');

               return false;
            }
         }
         var url = '{{ action("Website\LoginController@resetPassword") }}';
      }
      if (!$('#resetPassword').valid())
        return;


         var post_data = $('#resetPassword').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  if(
                     $('#reset_password').val() == '' ||
                     $('#reset-confirm-password').val() == ''
                  ) {
                     
                     if($('#reset_password_otp_box').hasClass('d-none')) {
                  
                        $('#resetPassword').find('.error_message_to_show').remove();
                        $('#resetPassword').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter password and confirm password'+'</p>');

                     } else {

                        $('#reset_password_otp_box').addClass('d-none');

                        $('#reset_password_password_box').removeClass('d-none');
                        $('#reset_password_confirm_password_box').removeClass('d-none');

                        $('#reset_password_submit_btn').text('Reset Password');
                        $('#reset_password_submit_btn').data('iid',2);

                     }

                     return false;

                  } else {
                     $('#reset_password').val('');;
                     $('#reset-confirm-password').val('');
                     setTimeout(() => {
                        window.location.reload();
                     }, 1000);

                  }

               } else {

                  $('#resetPassword').find('.error_message_to_show').remove();
                  $('#resetPassword').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');
                  
                  return false;
               }
               return false;
            }
         });

         return false;
   }
</script>

<!-- sweet alert -->

<script>
   function delete_sweet_alert(url, msg) {
      // sweet alert
      const swalWithBootstrapButtons = Swal.mixin({
         customClass: {
            confirmButton: 'btn btn-sm btn-success ml-2',
            cancelButton: 'btn btn-sm btn-danger'
         },
         buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
         title: msg,
         text: "You won't be able to revert this!",
         icon: 'success',
         showCancelButton: true,
         confirmButtonText: 'Yes',
         cancelButtonText: 'No',
         reverseButtons: true
      }).then((result) => {
         if (result.isConfirmed) {

            window.location.href = url;


         } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
         ) {
            return false;
         }
      })
   }
</script>

<script>
   $('.tagsInput').fastselect();
</script>

<script>

   $(document).on('input', '.fstQueryInput', function(){

      $(this).attr('maxlength', 30);

      var element_value = $(this).val();
      if(
         element_value.length > 30
      ) {
         swal.fire({
            title: 'Alert!',
            text: 'Tag length limit exceed'
         });
      }
   });
</script>

<script>

   function confirmation(form) {

      // sweet alert
      const swalWithBootstrapButtons = Swal.mixin({
         customClass: {
            confirmButton: 'btn btn-sm btn-success ml-2',
            cancelButton: 'btn btn-sm btn-danger'
         },
         buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'success',
         showCancelButton: true,
         confirmButtonText: 'Yes',
         cancelButtonText: 'No',
         reverseButtons: true
      }).then((result) => {
         if (result.isConfirmed) {

            document.getElementById(form).submit();


         } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
         ) {

            return false;
         }
      })
   }

</script>

<script>
  function isNumberKey(evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode != 46 && charCode > 31 &&
      (charCode < 48 || charCode > 57))

      return false;
    else {
      var itemdecimal = evt.srcElement.value.split('.');
      if (itemdecimal.length > 1 && charCode == 46)
        return false;

      return true;
    }
  }
</script>

<script>
   $(function() {
    $(".inputs").keyup(function () {
        if (this.value.length == this.maxLength) {
            
            $(this).next('.inputs').removeAttr('readonly');

            $(this).next('.inputs').focus();
            
        } else if (this.value.length != this.maxLength) {
            
            $(this).prev('.inputs').removeAttr('readonly');

            $(this).prev('.inputs').focus();
            
        }
    });
});
</script>

<!-- enterprise login -->

<script>
   function enterprise_login(element) {

      
      if (!$(element.form).valid())
        return;

      if (
         element.form.email.value == '' || element.form.email.value == ''
      ) {

         $(element.form).find('.error_message_to_show').remove();
         $(element.form).prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         var url = '{{ action("Website\EnterpriseLoginController@login") }}';
         var post_data = $(element.form).serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  window.location.href = '{{ action("Website\EnterpriseLoginController@login") }}';
                  
                  return false;

               } else {

                  $(element.form).find('.error_message_to_show').remove();
                  $(element.form).prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

<!-- enterprise register -->

<script>
   function enterprise_tempregister(element) {
      if (! $(element.form).valid() )
        return;

      if (
         element.form.name.value == '' || element.form.mobile.value == '' ||
         element.form.email.value == '' || element.form.password.value == '' ||
         element.form.address.value == '' ||
         element.form.country.value == '' || element.form.state.value == '' ||
         element.form.city.value == '' ||
         !$('#check-terms1').is(':checked')
      ) {

         $(element.form).find('.error_message_to_show1').remove();
         $(element.form).prepend('<p class="col-12 error_message_to_show1 text-danger text-center"> '+'Please fill out required fields and accept our terms and conditions'+'</p>');

         return false;

      } else {

         if( element.form.mobile.value.length != 10) {
               
            $(element.form).find('.error_message_to_show1').remove();
            $(element.form).prepend('<p class="col-12 error_message_to_show1 text-danger text-center"> '+'Please enter a valid mobile number'+'</p>');

            return false;
         }

         var regx = /^[6-9]\d{9}$/;

         if(! regx.test( element.form.mobile.value ) ) {
               
            $(element.form).find('.error_message_to_show1').remove();
            $(element.form).prepend('<p class="col-12 error_message_to_show1 text-danger text-center"> '+'Please enter a valid mobile number'+'</p>');

            return false;
         }

         if(! (/[A-Za-z]/i.test(element.form.password.value) &&
         /[0-9]/.test(element.form.password.value) &&
         element.form.password.value.length >= 6) ) {
            
            $(element.form).find('.error_message_to_show1').remove();
            $(element.form).prepend('<p class="col-12 error_message_to_show1 text-danger text-center"> '+'Please enter a valid password'+'</p>');

            return false;
         }

         var url = '{{ action("Website\EnterpriseRegisterController@tempregister") }}';
         var post_data = $(element.form).serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  $(element.form).find('.error_message_to_show1').remove();
                  $(element.form).prepend('<p class="col-12 error_message_to_show1 text-success text-center"> '+data.message+'</p>');

                  var mobile = element.form.mobile.value;

                  $('#mobile_display2').text(mobile);
                  $('#enterprise_mobile_verify').val(mobile);
                  $('#enterprise_number-verify').modal('show');

               } else {

                  $(element.form).find('.error_message_to_show1').remove();
                  $(element.form).prepend('<p class="col-12 error_message_to_show1 text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>


<script>
   function enterprise_register() {

      if (! $('#enterprise_register').valid() )
        return;

      if (
         $('#enterprise_mobile_verify').val() == '' ||
         
         $('#enterprise_verify_digit-1').val() == '' ||
         $('#enterprise_verify_digit-2').val() == '' ||
         $('#enterprise_verify_digit-3').val() == '' ||
         $('#enterprise_verify_digit-4').val() == '' 
      ) {

         $('#enterprise_register').find('.error_message_to_show').remove();
         $('#enterprise_register').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'OTP is required'+'</p>');

         return false;

      } else {

         $('.spinner-border').show();

         var url = '{{ action("Website\EnterpriseRegisterController@register") }}';
         var post_data = $('#enterprise_register').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  $('#enterprise_register').find('.error_message_to_show').remove();
                  $('#enterprise_register').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

                  setTimeout(() => {
                     
                     window.location.href = '{{ action("Website\EnterpriseController@index") }}';
                     
                  }, 2000);

                  $('.spinner-border').hide();

                  return false;

               } else {

                  $('#enterprise_register').find('.error_message_to_show').remove();
                  $('#enterprise_register').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  $('.spinner-border').hide();

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

@include('alert_msg')

<!-- country state city -->

<script>
   
   $(document).on('change', '#country_id', function() {

      $('#city_id').html('');
      $('#city_id').selectpicker('refresh');
      
      states(this.form);
   });
</script>

<script>
   $(document).on('change', '#state_id', function() {

      cities(this.form);

   });
</script>

<script>
function states(form) {

      $.ajax({
            type: 'POST',
            url: '{{action("Website\StudentProfileController@states")}}',
            data: {
               country_id: $(form.country).val(),
               _token: '{{csrf_token()}}'
            },
            success: function(data) {

               $(form.state).html(
                  '<option value="">State</option>'
               );

               data.forEach(element => {
                        
                  var is_selected = '';

                  $(form.state).append(
                        '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
                  );
               });

               $(form.state).selectpicker('refresh');
                     
            
            cities(form);         
               
            }
      });
   }
</script>

<script>
function cities(form) {

      $.ajax({
            type: 'POST',
            url: '{{action("Website\StudentProfileController@cities")}}',
            data: {
               state_id: $(form.state).val(),
               _token: '{{csrf_token()}}'
            },
            success: function(data) {

            $(form.city).html(
               '<option value="">City</option>'
            );

            data.forEach(element => {
                     
               var is_selected = '';

               $(form.city).append(
                     '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
               );
            });

            $(form.city).selectpicker('refresh');
            }
      });
   }
</script>


<script>
	ClassicEditor
		.create( document.querySelector( '#editor1' ), {
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>

<!-- ClickCounter -->
<script type="text/javascript">
   var clicks = 1;

  function clickCounter(val) {
     $.ajax({
        type: "POST",
        url: "<?php echo asset('/clickcounter') ?>",
        data: {'clicks':clicks,'id':val,'_token':"<?php echo csrf_token() ?>"},

     });
  };
   </script>

   <!-- enterprise forgot and change password -->
   
<script>
   function enterprise_forgot() {

      if (!$('#enterprise_forgot').valid())
        return;

      if (
         $('#enterprise_forgot-input-mobile').val() == ''
      ) {

         $('#enterprise_forgot').find('.error_message_to_show').remove();
         $('#enterprise_forgot').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         var url = '{{ action("Website\EnterpriseLoginController@forgot") }}';
         var post_data = $('#enterprise_forgot').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  $('#enterprise_forgot').find('.error_message_to_show').remove();
                  $('#enterprise_forgot').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

                  var mobile = $('#enterprise_forgot-input-mobile').val();

                  $('#enterprise_mobile_display').text(mobile);
                  $('#enterprise_forgot-mobile').val(mobile);

                  $('#enterprise_reset_password_otp_box').removeClass('d-none');

                  $('#enterprise_reset_password_password_box').addClass('d-none');
                  $('#enterprise_reset_password_confirm_password_box').addClass('d-none');

                  $('#enterprise_reset_password_submit_btn').text('Verify Otp');
                  
                  $('#enterprise_change-password').modal('show');

               } else {

                  $('#enterprise_forgot').find('.error_message_to_show').remove();
                  $('#enterprise_forgot').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

<script>
   function enterprise_change() {

      if (!$('#enterprise_change').valid())
        return;
        
      if (
         $('#enterprise_change #enterprise_forgot-mobile').val() == '' ||
         $('#enterprise_change input[name="forgot-otp[1]"]').val() == '' ||
         $('#enterprise_change input[name="forgot-otp[2]"]').val() == '' ||
         $('#enterprise_change input[name="forgot-otp[3]"]').val() == '' ||
         $('#enterprise_change input[name="forgot-otp[4]"]').val() == '' ||
         $('#enterprise_change input[name="forgot-otp[5]"]').val() == '' ||
         $('#enterprise_change input[name="forgot-otp[6]"]').val() == '' 
      ) {

         $('#enterprise_change').find('.error_message_to_show').remove();
         $('#enterprise_change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         var url = '{{ action("Website\EnterpriseLoginController@change") }}';
         var post_data = $('#enterprise_change').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  if(
                     $('#enterprise_change #enterprise_password').val() == '' ||
                     $('#enterprise_change #enterprise_confirm-password').val() == ''
                  ) {
                     
                     if($('#enterprise_reset_password_otp_box').hasClass('d-none')) {
                        
                        $('#enterprise_change').find('.error_message_to_show').remove();
                        $('#enterprise_change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter password and confirm password'+'</p>');

                     } else {

                        $('#enterprise_reset_password_otp_box').addClass('d-none');

                        $('#enterprise_reset_password_password_box').removeClass('d-none');
                        $('#enterprise_reset_password_confirm_password_box').removeClass('d-none');

                        $('#enterprise_reset_password_submit_btn').text('Reset Password');

                     }

                     return false;

                  } else {
                        
                     $('#register').find('.error_message_to_show').remove();
                     $('#register').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

                     setTimeout(() => {
                        window.location.reload();
                     }, 1000);

                  }

               } else {

                  $('#enterprise_change').find('.error_message_to_show').remove();
                  $('#enterprise_change').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>


    <script>
      $(document).ready(
        function() {
            $('.img-fluid.shadow.rounded.border').addClass('w-100');
        }
      );
    </script>

    <!-- restrict special characters from name becoz of slug -->
    <script>
        $(document).on('change input','input', function () {

            if( this.name.includes('name') || this.name.includes('title') ) {
                if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                }
            } 

        });
    </script>

    <script>
      $(document).on('input change', 'textarea', function() {
         
         var txt = $(this).val();
         count = txt == '' ? 0 : txt.split(' ');
         if(count.length>0){
            for (var i = 0; i < count.length; i++) {
               if(count[i].length>=31){

                  count[i] = count[i].substring(0,30);
               }
            }

            console.log(count.join(' '));
            $(this).text(count.join(' '));
            $(this).val(count.join(' '));
         }
      });
    </script>

    <!-- restrict only spaces in input -->
    <script>
        $(document).on('change','input', function () {

            if($(this).val().trim() === "" || $(this).val() === null){
                this.value = '';
                $(this).val('');
            }

        });
    </script>

    <!-- restrict abusive words -->
    <script>
      var blackList =  ['ahole','anal','analprobe','anilingus','areole','assbang','assbanged','assbangs','asses','assfuck','assfucker','assh0le','asshat','asshole','assholes','assmaster','assmunch','asswipe','asswipes','aulad','aulda','awlat','azazel','baap','ballsack','bambu','banger','barf','bastard','bastards','bawdy','beaner','beardedclam','beastiality','beatch','beaver','beeyotch','beotch','beti','Bhadhava','Bhains','Bhen','bhigi','Bhonsri','bhoosri','Bhosad','Bhosadike','Bhosadike','bhosda','Bhosdike ','biatch','big','tits','bigtits','bimbo','bitch','bitched','bitches','bitchy','blow','blowjob','blowjobs','boob','boobies','boobs','booby','booger','bosom','bosomy','brassiere','bukkake','bull', 'shit','bullshit','bullshits','bullshitted','busty','butt','butt', 'fuck','buttfuck','buttfucker','buttplug','c.0.c.k','c.o.c.k.','c.u.n.t','c0ck','c-0-c-k','chatani','Chhed','Chinaal','Chipkali','chod','chode','chodes','Chodu','choos','Choot','Chootiya','Chudai','Chudan','Chudwana','Chunni','Chus','Chusnawali','chut','Chutiya','cock', 'sucker','cockblock','cockholster','cockknocker','cocksmoker','cocksucker','coital','condom','corksucker','crackwhore','crappy','cumshot','cumshots','cumslut','cumstain','cunilingus','cunnilingus','cunny','cunt','c-u-n-t','cuntface','cunthunter','cuntlick','cuntlicker','Cuntmama','cunts','danda','dick','dickbag','dickdipper','dickface','dickflipper','dickhead','dickheads','dickish','dick-ish','dickripper','dicksipper','dickweed','dickwhipper','dickzipper','dildo','dildos','doggie-style','doggy-style','dumbass','dumbasses','f.u.c.k','fack','faggot','fagot','fartknocker','felch','felcher','felching','fellatio','feltch','feltcher','fisted','fisting','fisty','fondle','foreskin','freex','frigg','fuck','f-u-c-k','fuckass','fucked','fucker','fuckface','fuckin','fucking','fucknugget','fucknut','fuckoff','fucks','fucktard','fuck-tard','fuckup','fuckwad','fuckwit','fudgepacker','fuk','fvck','fxck','gaand','Gaandfat- Busted ass','Gaandu','gadde','Gadha','gand','gays','ghondoo','glans','goatse','godamnit','goddammit','goddamn','goldenshower','gonad','gonads','gringo','gspot','g-spot','handjob','Haraamjaada','heroin','Hijra','hobag','hom0','hookah','hooker','horny','hymen','incest','jackass','jackhole','jackoff','jerk','jerk0ff','jerked','jerkoff','jhaahtu','Jhaant','Jhaant','jhaat','Jhat','jism','jizm','jizz','jizzed','junkie','junky','Kamina','Keeda','keede','keera','Khatmal','Khotey','kinky','knobend','kooch','kooches','kootch','kute','Kutte','Kuttiya','labia','Ladkichod','lassan','Lauda','laude','lavda','Lavde','lesbians','lesbo','lezbian','lezbo','lezzie','lezzy','lmao','loda','luli','lund','lusty','maa','maaiya ','madarchod','Maderchod','mahdarchod','mahderchod','marani','masterbate','masterbating','masterbation','masturbate','masturbating','masturbation','menses','menstruate','menstruation','molest','Moot','Mootna','motherfucka','motherfucker','motherfucking','mtherfucker','mthrfucker','mthrfucking','muth','muthafucker','mutherfucker','mutherfucking','muthi','muthrfucking','Najayaz','naked','nipple','nude','nympho','oral','orgasm','orgy','ovary','ovum','p.u.s.s.y.','Paad','pantie','panty','paseene','Pasine','pecker','pedo','pee','penetrate','penetration','penial','penile','penis','perversion','phallic','phuck','pillowbiter','piss','pissu','poontang','porn','pornography','potty','prostitute','prude','pube','pubic','pubis','puss','pussy','queef','quim','Raapchik','racy','Rakhail','Rand ','Randi','rape','raped','raper','rapist','rimjob','Rundi','s.h.i.t.','Saala','saale','Saali','sadism','sadist','Sarkandi','scantily','schlong','seduce','semen','sex','sexual','shamedame','shit','s-h-i-t','shite','slave','sleaze','slut','slutkiss','smegma','smut','smutty','Soover','sperm','steamy','stfu','stiffy','strip','stupid','suck','sucked','sucking','Suwwar','takke','tatate','tatte','Tatti','teabagging','teat','terd','teste','testicle','testis','titfuck','tits','tittiefucker','titties','titty','tittyfuck','tittyfucker','toots','transsexual','trashy','tubgirl','turd','tush','Ukhaadna','undies','urinal','urine','uterus','vagina','virgin','vixen','voyeur','vulgar','vulva','wedgie','weiner','whoralicious','whore','whorealicious','whoreface','whorehopper','whorehouse','whoring','wtf','x-rated','yeasty'];

      function checkBlackList(element, str) {
         
         $.each(blackList, function(i, n) {
            
            if(new RegExp('\\b(' + n + ')\\b', 'gi').test(str)) {
               $(element).focus();

               console.log($(element));

               $(element).val($(element).val().replace(new RegExp('\\b(' + n + ')\\b', 'gi'), ""));

               $(element).focus();
            }
         })
      }
      
      $(document).on('keydown input keyup change', 'input, textarea', function(e) {
         checkBlackList(this, this.value);
      });

      window.editor.model.document.on( 'change:data', () => {
          $.each(blackList, function(i, n) {
            if(new RegExp('\\b(' + n + ')\\b', 'gi').test(window.editor.getData())) {
               window.editor.setData(window.editor.getData().replace(new RegExp('\\b(' + n + ')\\b', 'gi'), ""))
            }
         })
      } );

    </script>

    <script>
      $('.modal').on('show.bs.modal', function (e) {
         $('.modal').modal('hide');
      });
    </script>

    <script>
      $('.modal').on('hidden.bs.modal', function () {
          
         $(this).find('form').trigger('reset');
         $('.selectpicker').selectpicker('refresh');
         
         $('.nav-tabs li:first-child a').tab('show');
      });
    </script>

    <script>
      function enterprise_login_tab() {
         $('#login-2-tab').tab('show');
      }
      
      function enterprise_register_tab() {
         $('#register1-tab').tab('show');
      }
    </script>

    
<script>
   function resend_otp(value, type, student_or_enterprise) {

      var url = '{{ action("Website\LoginController@resend_otp") }}';

      $.ajax({
         url: url,
         type: "POST",
         dataType: "json",
         data: {
            value,
            type,
            student_or_enterprise,
            _token: '{{ csrf_token() }}'
         },
         success: function(data) {

            if (data.success) {

               $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

               var mobile = $('#forgot-input-mobile').val();

            } else {

               $('.modal.show').find('form .error_message_to_show').remove();
               $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

               return false;
            }

            return false;
         }
      });

      return false;
   }
</script>
<script>
   $(document).ready(function () {
    $('.menu-bar a').on('click', function () { 
      $('.mobile_nav').toggleClass('show-menu');
      $('body').toggleClass('open-menu');
    })
  });
</script>

<script>

   $(document).on('DOMNodeInserted', function(e) {
      if ( $(e.target).hasClass('error') ) {
         //element with .MyClass was inserted.
         $('label.error').addClass('text-danger p-0 col-12 order-12');
      }
      
   });

   jQuery(document).ready(function() {
      $('form').validate({
         ignore:":not(:visible)"
      });
   });

   $(document).on('DOMNodeInserted', function(e) {
      if ( $(e.target).hasClass('error_message_to_show') ) {
         //element with .MyClass was inserted.
         $('.error_message_to_show').delay(2000).fadeOut(1000);
      }
   });
</script>

<!-- signup popup after 1 min -->
<script>
   $(document).ready(
      function () {

         @if(session()->has('student') or session()->has('enterprise'))
         @else
             setTimeout(() => {
                 
                if(
                     $('.modal').hasClass('show')
                ) {
                    
                } else {
                        
                    $('#exampleModal2').modal('show');
                    
                }
                
             }, (500*40)); 
         @endif
      }
   );
</script>

<!--google location enterprise signup-->
<script 
      type="text/javascript" 
      src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places&key={{ config('app.GOOGLE_MAPS_API_KEY') }}"></script>

    <script type="text/javascript">
        var city;
        var state;
        var country;

        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('enterprise_address'));
            google.maps.event.addListener(places, 'place_changed', function (event) {
                
                var place = places.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Do whatever with the value!
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();

                geocodeLatLng(latitude,longitude);

                $('#enterprise_latitude').val(latitude);
                $('#enterprise_longitude').val(longitude);
                
                $('#enterprise_latitude').attr('value', latitude);
                $('#enterprise_longitude').attr('value', longitude);

            });
        });

        var input = document.getElementById('enterprise_address');
        google.maps.event.addDomListener(input, 'keydown', function(event) { 
            if (event.keyCode === 13) { 
                event.preventDefault(); 
            }
        }); 
    </script>

    <script>
        function geocodeLatLng(lat, lng) {

            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);
            
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        console.log(results);
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                                switch (results[0].address_components[i].types[b]) {
                                    case 'locality':
                                        city = results[0].address_components[i].long_name;
                                        break;
                                    case 'administrative_area_level_1':
                                        state = results[0].address_components[i].long_name;
                                        break;
                                    case 'country':
                                        country = results[0].address_components[i].long_name;
                                        break;
                                }
                            }
                        }
                        console.log('City = ' + city + ', ' + 'State = ' +  state + ', ' + 'Country = ' +  country);

                        // set country
                        $("#enterprise_tempregister #country_id option").filter(function() {
                            return this.text == country; 
                        }).prop('selected', true);

                        $('#enterprise_tempregister #country_id').selectpicker('refresh');

                        $.ajax({
                            'type': 'POST',
                            'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                            'data': {
                                _token: "{{csrf_token()}}",
                                x: $('#enterprise_tempregister #country_id option:selected').val()
                            },
                            'success': function(data) {
                                $("#enterprise_tempregister #state_id").html(data);
                                $('#enterprise_tempregister #state_id').selectpicker('refresh');

                                // set state
                                $("#enterprise_tempregister #state_id option").filter(function() {
                                    return this.text == state; 
                                }).prop('selected', true);
                                        
                                $('#enterprise_tempregister #state_id').selectpicker('refresh');

                                $.ajax({
                                    'type': 'POST',
                                    'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                                    'data': {
                                        _token: "{{csrf_token()}}",
                                        x: $('#enterprise_tempregister #state_id option:selected').val()
                                    },
                                    'success': function(data) {
                                        $("#enterprise_tempregister #city_id").html(data);
                                        $('#enterprise_tempregister #city_id').selectpicker('refresh');
                                                
                                        // set city
                                        $("#enterprise_tempregister #city_id option").filter(function() {
                                            return this.text == city; 
                                        }).prop('selected', true);
                                        
                                        $('#enterprise_tempregister #city_id').selectpicker('refresh');

                                    },
                                });

                            },
                        });
                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        }
    </script>
    
    <script>
      $(document).ready(
        function() {
            setTimeout(() => {
                console.clear();
                
                console.log('You will not find anything on console 😄');
             }, 1);
             
             $('form').prop('autocomplete', 'off');
             
        }
      );
    </script>
    
    <!-- student mobile verify-->
      
   <script>
      function student_mobile_verify_form_submit() {

         if (!$('#student_mobile_verify_form').valid())
         return;

         if (
            $('#student_mobile_verify_mobile').val() == ''
         ) {

            $('#student_mobile_verify_form').find('.error_message_to_show').remove();
            $('#student_mobile_verify_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

            return false;

         } else {

            var url = '{{ action("Website\SocialLoginController@student_mobile_verify") }}';
            var post_data = $('#student_mobile_verify_form').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  if (data.success) {

                     $('#student_mobile_verify_form').find('.error_message_to_show').remove();
                     $('#student_mobile_verify_form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

                     var mobile = $('#student_mobile_verify_mobile').val();

                     $('#student_mobile_verify_display').text(mobile);
                     $('#student_mobile_verify_mobile_input').val(mobile);

                     $('#student_mobile_verify_otp').modal('show');

                  } else {

                     $('#student_mobile_verify_form').find('.error_message_to_show').remove();
                     $('#student_mobile_verify_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                     return false;
                  }

                  return false;
               }
            });

            return false;
         }
      }
   </script>

   <script>
      function student_mobile_verify_otp_form_submit() {
         
         if (!$('#student_mobile_verify_otp_form').valid())
         return;

         if (
            $('#student_mobile_verify_mobile_input').val() == '' ||
            $('input[name="student_mobile_verify-otp[1]"]').val() == '' ||
            $('input[name="student_mobile_verify-otp[2]"]').val() == '' ||
            $('input[name="student_mobile_verify-otp[3]"]').val() == '' ||
            $('input[name="student_mobile_verify-otp[4]"]').val() == '' ||
            $('input[name="student_mobile_verify-otp[5]"]').val() == '' ||
            $('input[name="student_mobile_verify-otp[6]"]').val() == '' 
          ) {

            $('#student_mobile_verify_otp_form').find('.error_message_to_show').remove();
            $('#student_mobile_verify_otp_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

            return false;

         } else {

            var url = '{{ action("Website\SocialLoginController@student_mobile_verify_otp") }}';
            var post_data = $('#student_mobile_verify_otp_form').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  if (data.success) {
                                                
                        setTimeout(() => {
                           window.location.reload();
                        }, 1000);


                  } else {

                     $('#student_mobile_verify_otp_form').find('.error_message_to_show').remove();
                     $('#student_mobile_verify_otp_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                     return false;
                  }

                  return false;
               }
            });

            return false;
         }
      }
   </script>

   @if( session()->has('tempstudent') and empty( session()->get('tempstudent')->mobile ) )
   <script>
      $(document).ready(
         function () {

            $('#student_mobile_verify').modal('show');
         }
      );
   </script>
   
   @php
        # session()->forget('tempstudent');
   @endphp
   
   @endif

   <!-- enterprise mobile verify-->
      
   <script>
      function enterprise_mobile_verify_form_submit() {

         if (!$('#enterprise_mobile_verify_form').valid())
         return;

         if (
            $('#enterprise_mobile_verify_mobile').val() == ''
         ) {

            $('#enterprise_mobile_verify_form').find('.error_message_to_show').remove();
            $('#enterprise_mobile_verify_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

            return false;

         } else {

            var url = '{{ action("Website\EnterpriseSocialLoginController@enterprise_mobile_verify") }}';
            var post_data = $('#enterprise_mobile_verify_form').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  if (data.success) {

                     $('#enterprise_mobile_verify_form').find('.error_message_to_show').remove();
                     $('#enterprise_mobile_verify_form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');

                     var mobile = $('#enterprise_mobile_verify_mobile').val();

                     $('#enterprise_mobile_verify_display').text(mobile);
                     $('#enterprise_mobile_verify_mobile_input').val(mobile);

                     $('#enterprise_mobile_verify_otp').modal('show');

                  } else {

                     $('#enterprise_mobile_verify_form').find('.error_message_to_show').remove();
                     $('#enterprise_mobile_verify_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                     return false;
                  }

                  return false;
               }
            });

            return false;
         }
      }
   </script>

   <script>
      function enterprise_mobile_verify_otp_form_submit() {
         
         if (!$('#enterprise_mobile_verify_otp_form').valid())
         return;

         if (
            $('#enterprise_mobile_verify_mobile_input').val() == '' ||
            $('input[name="enterprise_mobile_verify-otp[1]"]').val() == '' ||
            $('input[name="enterprise_mobile_verify-otp[2]"]').val() == '' ||
            $('input[name="enterprise_mobile_verify-otp[3]"]').val() == '' ||
            $('input[name="enterprise_mobile_verify-otp[4]"]').val() == '' 
         ) {

            $('#enterprise_mobile_verify_otp_form').find('.error_message_to_show').remove();
            $('#enterprise_mobile_verify_otp_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

            return false;

         } else {

            var url = '{{ action("Website\EnterpriseSocialLoginController@enterprise_mobile_verify_otp") }}';
            var post_data = $('#enterprise_mobile_verify_otp_form').serialize();

            $.ajax({
               url: url,
               type: "POST",
               dataType: "json",
               data: post_data,
               success: function(data) {

                  if (data.success) {
                                                
                        setTimeout(() => {
                           window.location.reload();
                        }, 1000);

                  } else {

                     $('#enterprise_mobile_verify_otp_form').find('.error_message_to_show').remove();
                     $('#enterprise_mobile_verify_otp_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

                     return false;
                  }

                  return false;
               }
            });

            return false;
         }
      }
   </script>

   @if( session()->has('tempenterprise') and empty( session()->get('tempenterprise')->mobile ) )
   <script>
      $(document).ready(
         function () {

            $('#enterprise_mobile_verify1').modal('show');
         }
      );
   </script>
   
   @php
        # session()->forget('tempenterprise');
   @endphp
   
   @endif
   
   <script>
        $(document).ready(function () {
        
            if( 
                window.location.href.toString().includes('profile') 
            ) {

            } else {
                setTimeout(() => {
                    $('input').attr("readonly", 'readonly');

                    $('input[readonly]').css("backgroundColor", 'transparent');
                    
                    $('input').attr("onfocus", "this.removeAttribute('readonly')");
                    $('input').attr("ontouchstart", "this.removeAttribute('readonly')");
                }, 100);
            }            
        });
   </script>
   
   <!--required-->
   <script>
   
        if( 
            window.location.href.toString().includes('profile') 
        ) {

        } else {
            
           $(document).on('submit', 'form', function() {
               
                if(! $(this).valid())
                    return false;
                else 
                    return true;
               
           });
        }
   </script>
   
   
   <!--otp only number keypad-->
   <script>
   
        $(document).ready(
            function () {
                $("input[name*='otp']").attr('type', 'tel'); 
                
                $("input[name*='otp']").attr('oninput', "this.value=this.value.replace(/[^0-9]/g,'');this.value=this.value.slice(0,1)"); 
                
              
            }
        );



   </script>


</body>
</html>