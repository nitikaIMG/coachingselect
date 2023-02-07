@include('website/layouts/header')
<main id="main">
   <section id="enterprise_section" class="enterprise_section creat_account overflow-unset">
      <div class="container">
         <div class="group-title-index mb-5">
            <h4 class="top-title">India's no.1 and fastest growing education portal</h4>
            <h2 class="center-title">Registration Form</h2>
         </div>
         <div class="row">
            <div class="col-md-8">
               <form id="enterprise_register" class="needs-validation">
                  @csrf
                  <div class="enterprise_login shadow rounded bg-secondary p-3">
                     <div class="p-4 border rounded bg-light">
                        <div class="registration-box pb-3 mb-4 border-bottom">
                           <h2 class="fs-16 text-secondary"><span class="bg-secondary h-35px rounded-pill d-inline-flex align-items-center mr-2 justify-content-center w-35px fs-14 shadow"><i class="fas fa-user-tie"></i></span> Account Information</h2>
                           <div class="needs-validation mt-4" novalidate="">
                              <div class="input-group-overlay form-group mb-3">
                                 <div class="input-group-prepend-overlay">
                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                 </div>
                                 <input type="text" name="name" id="enterprise_name" class="form-control" placeholder="Institute Name*" required="">
                              </div>
                              <div class="input-group-overlay form-group mb-3">
                                 <div class="input-group-prepend-overlay">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                 </div>
                                 <input 
                                    class="form-control prepended-form-control" 
                                    type="email" 
                                    id="enterprise_email" 
                                    name="email" 
                                    placeholder="Email*" required="">
                              </div>
                              <div class="input-group-overlay form-group mb-3">
                                 <div class="input-group-prepend-overlay">
                                    <span class="input-group-text">
                                       <i class="fas fa-mobile"></i></span>
                                 </div>
                                 <input 
                                    class="form-control prepended-form-control" 
                                    type="tel" 
                                    id="enterprise_mobile" 
                                    name="mobile" 
                                    placeholder="Mobile*" required=""
                                    pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaining 9 digit with 0-9" minlength="10" maxlength="10"
                                    onkeypress="return isNumberKey(event)" 
                                    >
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
                           </div>
                        </div>
                        <div class="registration-box pb-3 mb-2 border-bottom">
                           <h2 class="fs-16 text-secondary"><span class="bg-secondary h-35px rounded-pill d-inline-flex align-items-center mr-2 justify-content-center w-35px fs-14 shadow"><i class="fas fa-address-card"></i></span> Contact Information</h2>
                           <div class="needs-validation mt-4">
                              <div class="input-group-overlay form-group mb-3">
                                 <div class="input-group-prepend-overlay">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                 </div>
                                 <textarea 
                                    name="address"
                                    id="enterprise_address"
                                    class="form-control"  
                                    placeholder="Contact Address*" required=""></textarea>
                              </div>
                              <div class="input-group-overlay form-group">
                                 <select name="country" id="country_id" title="country" class="selectpicker w-100 show-tick" data-width="auto" data-container="body" data-live-search="true" placeholder="Country">
                                    <option value="" disabled selected="">Country </option>
                                    @if( !empty($countries) )
                                    @foreach($countries as $country)
                                    <option 
                                       value="{{$country->name}}"
                                    >{{$country->name}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                              </div>
                              <div class="input-group-overlay form-group">
                                 <select name="state" id="state_id" title="state" class="selectpicker w-100 show-tick" data-width="auto" data-container="body" data-live-search="true" placeholder="State">
                                    <option value="" selected disabled>State</option>
                                 </select>
                              </div>
                              <div class="input-group-overlay form-group">
                                 <select name="city" id="city_id" title="city" class="selectpicker w-100 show-tick" data-width="auto" data-container="body" data-live-search="true" placeholder="City">
                                    <option value="" disabled selected="">City </option>
                                 </select>
                              </div>

                           </div>
                        </div>
                     <div class="row">
                        <div class="col">
                           <button 
                              class="btn btn-primary shadow fs-14 d-inline-flex w-auto btn-block"
                              type="submit"
                              onclick="return enterprise_register(this)"   
                           >Create My Account</button>
                        </div>
                        <div class="col text-right">
                           <a 
                              href=""
                              class="btn btn-secondary shadow fs-14 d-inline-flex w-auto btn-block" type="submit">Cancel</a>
                        </div>
                     </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-4">
              <div class="row mx-0 d-block position-sticky top-100px right-0">
                  <div class="rounded bg-light border bg-secondary p-3">
                     <div class="p-3 rounded shadow bg-white">
                        <span class="fs-12 text-white d-inline-flex align-items-center justify-content-center py-1 px-2 mb-3 bg-secondary rounded">Why Join</span>
                        <h2 class="fs-18 font-weight-bold text-left mb-0 position-relative">Coaching Select - Enterprise?</h2>
                        <ul class="my-4 list-unstyled pl-2">
                           <li class="mb-3">
                              <p class="fs-14 mb-0 d-flex"><i class="far fa-star mr-2 mt-1 text-secondary"></i>Be able to Post, Edit and Delete Your Listings</p>
                           </li>
                           <li class="mb-3">
                              <p class="fs-14 mb-0 d-flex"><i class="far fa-star mr-2 mt-1 text-secondary"></i>See the vital statistics of your Listings by Response Viewer, eg. How many hits it received in the last 1 week/month.</p>
                           </li>
                           <li class="mb-3">
                              <p class="fs-14 mb-0 d-flex"><i class="far fa-star mr-2 mt-1 text-secondary"></i>Get personal control and enhanced functionalities for better management of your content!
                              </p>
                           </li>
                        </ul>
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </section>
</main>

@include('website/layouts/footer')

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