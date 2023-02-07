@include('website/layouts/header')
@include('alert_msg')

<!-- google recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style type="text/css">

</style>
<main id="main">
   <!-- Contact page Start -->
   <section id="contact_page" class="contact_page position-relative" style="background-image: linear-gradient(45deg, hsl(var(--color-secondary) / 50%), transparent),url({{ asset('public') }}/website/assets/img/contact_us_banner.jpg);">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-7 pr-lg-0 pr-md-5 pr-3">
               <div class="contact_outer rounded-20 shadow">
                  <div class="contact_heading mb-5 position-relative">
                     <h1 class="fs-lg-40 fs-md-30 fs-22 font-weight-bold text-primary">Contact Us</h1>
                     <h2 class="mb-0 fs-lg-16 fs-md-15 fs-13 text-dark">Have a question? Need Some Help? Or Just want to say hello?<br><span>We would love to hear from you</span></h2>
                  </div>
                  <form action="{{asset('/contact_us')}}" method="post" onsubmit="return validateForm()">
                     @csrf
                     <div class="form-group row">
                        <div class="form-field col-md-6 position-relative">
                           <input type="text" name="fullname" id="fullname" class="form-control shadow floating" required>
                           <label class="form-control-placeholder position-absolute top-0 text-dark fs-13 mb-0" for="fullname">Full Name</label>
                        </div>
                        <div class="form-field col-md-6 position-relative">
                           <input name="phone" id="phone" class="form-control shadow floating" required
                           minlength=10 maxlength=10 oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel"
                           pattern="[6789][0-9]{9}"
                           >
                           <label class="form-control-placeholder position-absolute top-0 text-dark fs-13 mb-0" for="phone">Phone Number</label>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="form-field col-md-6 position-relative">
                           <input type="email" name="email" id="emailss" class="form-control shadow floating" required>
                           <label class="form-control-placeholder position-absolute top-0 text-dark fs-13 mb-0" for="emailss">Email address</label>
                        </div>
                        <div class="form-field position-relative col-md-6">
                           <select class="form-control  shadow" name="franchise" id="franchise" required="">
                              <option value="">How can we help you?</option>
                              <option value="I would like to list my Coaching">I would like to list my Coaching</option>
                              <option value="I found incorrect/outdated information on a page">I found incorrect/outdated information on a page</option>
                              <option value="Sales & Advertising Query/Become a paid member"
                                 @if( !empty($_GET['type']) and $_GET['type'] == 'advertise' )
                                    selected
                                 @endif
                              >Sales & Advertising Query/Become a paid member</option>
                              <option value="Require help in Career/Counseling/Coaching Guidance">Require help in Career/Counseling/Coaching Guidance</option>
                              <option value="I would like to give/suggestions">I would like to give/suggestions</option>
                              <option value="Other">Other</option>
                           </select>
                           <div class="validate"></div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="form-field position-relative">
                           <textarea class="form-control shadow floating" name="message" id="messages"
                           ></textarea>
                           <label class="form-control-placeholder position-absolute top-0 text-dark fs-13 mb-0" for="messages">Message</label>
                        </div>
                        <h6 id="msg_is_required" class="d-none mt-2 text-danger">
                           Minimum 25 characters are required.
                        </h6>
                     </div>
                     <!-- google recaptcha -->
                     <div class="form-group">
                        <div class="form-field position-relative">
                              <div class="g-recaptcha" data-sitekey="6LcTS4MeAAAAALLnvWTwqSlUhp1nrD_HnE8_7blr"></div>
                        </div>
                     </div>
                     <div class="form-group appointment-btn mb-0 text-left">
                        <button class="btn btn-green border-0 rounded-pill"><span>Submit</span></button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="contact_details col-lg-4 col-md-6 col-11 position-absolute right-0px px-0">
               <span class="d-inline-flex contact_btn align-items-center justify-content-center bg-secondary text-white fs-md-16 fs-14 py-2 px-md-3 px-2 font-weight-bold rounded-top"><i class="fas fa-phone-volume mr-2"></i>Contact Details</span>
               <div class="hover_info_part bg-white shadow px-3 py-4">
                  <h2 class="fs-md-22 fs-19 border-light pb-3 mb-2 text-center text-secondary position-relative px-4">
                     Contact Details
                  </h2>
                  <a href="mailto:support@coachingselect.com" target="_blank" class="row justify-content-center text-left py-md-3 py-2 border-bottom border-light courses_box mx-md-3 mx-2 align-items-center">
                     <div class="col-auto w-40px h-40px rounded-20 d-grid align-items-center p-0 justify-content-center bg-danger">
                        <i class="fas fa-envelope-open-text"></i>
                     </div>
                     <div class="col fs-md-16 fs-14 text-secondary">
                        support@coachingselect.com
                     </div>
                  </a>
                  <a href="tel:+918302598435" target="_blank" class="row justify-content-center text-left py-md-3 py-2 border-bottom border-light courses_box mx-md-3 mx-2 align-items-center">
                     <div class="col-auto w-40px h-40px rounded-20 d-grid align-items-center p-0 justify-content-center bg-purple">
                        <i class="fas fa-mobile-alt"></i>
                     </div>
                     <div class="col fs-md-16 fs-14 text-secondary">
                        +919636786126
                     </div>
                  </a>
                  <a href="https://wa.me/+919636786126/?text=Hi" target="_blank" class="row justify-content-center text-left py-md-3 py-2 border-bottom border-light courses_box mx-md-3 mx-2 align-items-center">
                     <div class="col-auto w-40px h-40px rounded-20 d-grid align-items-center p-0 justify-content-center bg-success">
                        <i class="fab fa-whatsapp"></i>
                     </div>
                     <div class="col fs-md-16 fs-14 text-secondary">
                        +919636786126
                     </div>
                  </a>
                  <a href="javascript:;" target="_blank" class="row justify-content-center text-left py-md-3 py-2 border-bottom border-light courses_box mx-md-3 mx-2 align-items-center">
                     <div class="col-auto w-40px h-40px rounded-20 d-grid align-items-center p-0 justify-content-center bg-secondary">
                        <i class="fas fa-map-marker-alt"></i>
                     </div>
                     <div class="col fs-md-16 fs-14 text-secondary">
                        Bhamashah Techno Hub, Jhalana Gram, Malviya Nagar, Jaipur, Rajasthan 302017
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Contact page End -->
</main>

<!-- question answer min max limit -->
   <script>
      $(document).on('submit', 'form', function(event) {
            
            var textarea_value = $("textarea",this).val();       
            
            if(textarea_value.length >= 25 && textarea_value.length <= 300) {
               return true;
            } else {
               
               $('#msg_is_required').removeClass('d-none').show().delay(2000).fadeOut('slow');

               event.preventDefault();
               return false;
            }
      });

      // recaptcha
      function validateForm() {
         var recaptcha = $("#g-recaptcha-response").val();
         if(recaptcha == "" ) {
               Swal.fire("Please Check the Recaptcha to proceed!");                 
   
               return false;

         } else {
               return true;
         }
      }
   </script>
@include('website/layouts/footer')