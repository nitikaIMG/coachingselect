@include('website/layouts/header')
<main id="main">
   <section id="enterprise_section" class="enterprise_section">
      <div class="container">
         <div class="group-title-index mb-5">
            <h4 class="top-title">India's no.1 and fastest growing education portal</h4>
            <h2 class="center-title">Enterprise Login</h2>
         </div>
         <div class="row">
            <div class="col-md-5">
               <div class="enterprise_login shadow rounded bg-secondary p-3">
                  <div class="p-4 border rounded bg-light">
                     <h2 class="fs-16 text-secondary"><span class="bg-secondary h-35px rounded-pill d-inline-flex align-items-center mr-2 justify-content-center w-35px fs-14 shadow"><i class="fas fa-user-tie"></i></span> 
                     Type otp and new password to change password</h2>
                     <form id="enterprise_change" class="needs-validation mt-4">
                        @csrf
                        <div class="input-group-overlay form-group mb-4">
                           <input 
                              class="form-control prepended-form-control" 
                              type="hidden" 
                              placeholder="Email" 
                              required=""
                              name="email"
                              id="enterprise_email"
                              value="{{ session()->get('forgot_email') }}"
                           >
                        </div>
                        <div class="input-group-overlay form-group mb-4">
                           <div class="digit-group row">
                              <input class="inputs col px-0 text-center ml-3 mr-1 h-50px form-control shadow-none" name="forgot-otp[1]" type="text" id="change-password-digit-1" data-next="change-password-digit-2" maxlength="1" autocomplete="off">
                              <input class="inputs col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[2]" type="text" id="change-password-digit-2" data-next="change-password-digit-3" data-previous="digit-1" maxlength="1" autocomplete="off">
                              <input class="col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[3]" type="text" id="change-password-digit-3" data-next="change-password-digit-4" data-previous="digit-2" maxlength="1" autocomplete="off">
                              <input class="col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[4]" type="text" id="change-password-digit-4" data-next="change-password-digit-5" data-previous="digit-3" maxlength="1" autocomplete="off">
                              <input class="col px-0 text-center mx-1 h-50px form-control shadow-none" name="forgot-otp[5]" type="text" id="change-password-digit-5" data-next="change-password-digit-6" data-previous="digit-4" maxlength="1" autocomplete="off">
                              <input class="col px-0 text-center mr-3 ml-1 h-50px form-control shadow-none" name="forgot-otp[6]" type="text" id="change-password-digit-6" data-previous="digit-5" maxlength="1" autocomplete="off">

                           </div>
                        </div>
                        <div class="input-group-overlay form-group mb-3">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-lock-alt"></i></span>
                           </div>
                           <input 
                              id="enterprise_password"
                              type="password"
                              class="form-control"
                              name="password"
                              placeholder="Password*">
                        </div>
                        <div class="input-group-overlay form-group mb-3">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-lock-alt"></i></span>
                           </div>
                           <input 
                              id="enterprise_confirm_password"
                              type="password"
                              class="form-control"
                              name="confirm_password" 
                              placeholder="Confirm Password*"
                              required   
                           >
                        </div>
                        <div class="d-flex justify-content-between align-items-center form-group">
                           <div class="custom-control custom-checkbox d-flex align-items-center">
                           </div>
                           <a 
                              class="nav-link-style fs-14" 
                              href="{{ action('Website\EnterpriseLoginController@login') }}"
                           >Go Back and Login</a>
                        </div>
                        <button 
                           class="btn btn-primary btn-block" 
                           type="submit"
                           onclick="return enterprise_change()"   
                        >Send</button>
                        <p class="fs-14 pt-3 mb-0">Don't have an account? 
                           <a href="{{ action('Website\EnterpriseRegisterController@register') }}" class="font-weight-medium">Sign up</a>
                        </p>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-md-7">
               <div class="enterprise_slider owl-carousel rounded bg-light border bg-secondary p-3">
                  <div class="enterprise_slider_inner p-4 rounded shadow bg-white">
                     <h2 class="fs-26 font-weight-bold text-left mb-0 position-relative">Get High Quality Leads</h2>
                     <ul class="my-5 list-unstyled pl-3">
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Faster and Higher reach to market.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>ew, HOT and highly responsive Leads.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Get advantage by access to leads before competitors.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Increase ROI of your enterprise account.</p>
                        </li>
                     </ul>
                     <strong class="fs-14 d-block text-secondary">View institute activity feed, performance, responses and queries all in one place with interactive reports and graphs</strong>
                  </div>
                  <div class="enterprise_slider_inner p-4 rounded shadow bg-white">
                     <h2 class="fs-26 font-weight-bold text-left mb-0 position-relative">Manage Your Data Better</h2>
                     <ul class="my-5 list-unstyled pl-3">
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Faster and Higher reach to market.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>ew, HOT and highly responsive Leads.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Get advantage by access to leads before competitors.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Increase ROI of your enterprise account.</p>
                        </li>
                     </ul>
                     <strong class="fs-14 d-block text-secondary">View institute activity feed, performance, responses and queries all in one place with interactive reports and graphs</strong>
                  </div>
                  <div class="enterprise_slider_inner p-4 rounded shadow bg-white">
                     <h2 class="fs-26 font-weight-bold text-left mb-0 position-relative">Get High Quality Leads</h2>
                     <ul class="my-5 list-unstyled pl-3">
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Faster and Higher reach to market.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>ew, HOT and highly responsive Leads.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Get advantage by access to leads before competitors.</p>
                        </li>
                        <li class="mb-4">
                           <p class="fs-16 mb-0"><i class="far fa-star mr-2 text-secondary"></i>Increase ROI of your enterprise account.</p>
                        </li>
                     </ul>
                     <strong class="fs-14 d-block text-secondary">View institute activity feed, performance, responses and queries all in one place with interactive reports and graphs</strong>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </section>
</main>


<script>
   function enterprise_change() {

      if (
         $('#enterprise_email').val() == '' ||
         $('#enterprise_confirm_password').val() == '' ||
         $('#enterprise_password').val() == '' ||
         $('#change-password-digit-1').val() == '' ||
         $('#change-password-digit-2').val() == '' ||
         $('#change-password-digit-3').val() == '' ||
         $('#change-password-digit-4').val() == '' ||
         $('#change-password-digit-5').val() == '' ||
         $('#change-password-digit-6').val() == ''
      ) {

         $('.toast-body').text('Please fill out required fields');
         $('#toast_notification').removeClass('d-none');
         $('#toast_bg').removeClass('bg-success');
         $('#toast_bg').addClass('bg-danger');
         $('#toast_msg').toast('show');

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

                  $('.toast-body').text(data.message);
                  $('#toast_notification').removeClass('d-none');
                  $('#toast_bg').removeClass('bg-danger');
                  $('#toast_bg').addClass('bg-success');
                  $('#toast_msg').toast('show');

                  setTimeout(() => {
                     window.location.href = '{{ action("Website\EnterpriseLoginController@login") }}';
                  }, 3000);

               } else {

                  $('.toast-body').text(data.message);
                  $('#toast_notification').removeClass('d-none');
                  $('#toast_bg').removeClass('bg-success');
                  $('#toast_bg').addClass('bg-danger');
                  $('#toast_msg').toast('show');

                  return false;
               }

               return false;
            }
         });

         return false;
      }
   }
</script>

@include('website/layouts/footer')
<script>
   $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fas fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
      input.attr("type", "text");
      } else {
      input.attr("type", "password");
      }
   });
</script>