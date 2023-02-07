Change Password
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
                     <h2 class="fs-16 text-secondary"><span class="bg-secondary h-35px rounded-pill d-inline-flex align-items-center mr-2 justify-content-center w-35px fs-14 shadow"><i class="fas fa-user-tie"></i></span> Type email to reset password</h2>
                     <form id="enterprise_forgot" class="needs-validation mt-4">
                        @csrf
                        <div class="input-group-overlay form-group mb-4">
                           <div class="input-group-prepend-overlay">
                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                           </div>
                           <input 
                              class="form-control prepended-form-control" 
                              type="email" 
                              placeholder="Email" 
                              required=""
                              name="email"
                              id="enterprise_email"
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
                           onclick="return enterprise_forgot()"   
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
   function enterprise_forgot() {

      if (
         $('#enterprise_email').val() == ''
      ) {

         $('.toast-body').text('Please fill out required fields');
         $('#toast_notification').removeClass('d-none');
         $('#toast_bg').removeClass('bg-success');
         $('#toast_bg').addClass('bg-danger');
         $('#toast_msg').toast('show');

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

                  $('.toast-body').text(data.message);
                  $('#toast_notification').removeClass('d-none');
                  $('#toast_bg').removeClass('bg-danger');
                  $('#toast_bg').addClass('bg-success');
                  $('#toast_msg').toast('show');

                  setTimeout(() => {
                     window.location.href = "{{ action('Website\EnterpriseLoginController@change') }}";
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