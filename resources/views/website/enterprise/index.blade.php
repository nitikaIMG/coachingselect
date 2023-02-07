@include('website.layouts.header')
<main id="main">
   <div class="enterprise_dashboard pb-5 overflow-hidden" id="layoutSidenav">
      <div id="layoutSidenav_content">
         <main>
            <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col">
                        <div class="page-header-content">
                           <h1 class="page-header-title fs-md-35 fs-20 d-flex">
                              <div class="page-header-icon mr-md-3 mr-2"><i class="fad fa-at text-white"></i></div>
                              <span class="text-white text-capitalize">
                              Hi, {{ session()->get('enterprise')->name ?? '' }}
                              </span>
                           </h1>

                           @if(
                              session()->get('enterprise')->is_paid_member == 'yes'
                           )
                              <div class="text-white page-header-subtitle fs-md-19 fs-14 text-capitalize">
                                 Welcome To Your Dashboard (Paid User)
                              </div>
                           @else                              
                              <div class="text-white page-header-subtitle fs-md-19 fs-14 text-capitalize">
                                 Welcome to your dashboard
                              </div>
                           @endif
                        </div>
                     </div>
                     <div class="col-auto mb-md-0 mb-3">
                     </div>
                  </div>
               </div>
            </div>
            <div class="container-fluid card_enterprises_outer">
               
               <div class="row mb-2">
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <div class="card border-0">
                        <div class="bg-primary text-white card-header">
                           Email:
                        </div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item py-md-3 py-2 fs-md-15 fs-14">
                              {{
                                 session()->get('enterprise')->email ?? ''
                              }}
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <div class="card border-0">
                        <div class="bg-primary text-white card-header">
                           Mobile:
                        </div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item py-md-3 py-2 fs-md-15 fs-14">
                              {{
                                 session()->get('enterprise')->mobile ?? ''
                              }}
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <div class="card border-0">
                        <div class="bg-primary text-white card-header">
                           Password
                        </div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item">
                              <a href="javascript:;" data-toggle="modal" data-target="#Change-password" data-backdrop="static" data-keyboard="false" data-dismiss="modal" class="btn btn-xs btn-green fs-md-14 fs-13 border-0 rounded-pill"><span class="mr-2"><i class="fal fa-key"></i></span><span>Change Password</span></a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>

               <div class="row">
               
                  @if(
                     session()->get('enterprise')->is_paid_member == 'no'
                  )
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">
                                    Want to become a Prime Member?
                                    <br/>
                                 </div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <form 
                                       action="{{ action('Website\EnterpriseProfileController@become_prime_member')}}"
                                       method="POST"
                                       id="become_prime_member"
                                    >
                                    @csrf
                                    </form>
                                    <button 
                                       type="button"
                                       onclick="return confirmation('become_prime_member', 'Are you sure you want to become a Prime Member?')"
                                       class="btn btn-sm fs-11 btn-green border-0 rounded-pill">
                                       <span>Request to become a Prime Member &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span>
                                    </button>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-award"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif

                  @if(
                     session()->get('enterprise')->is_paid_member == 'yes'
                  )
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">Page Views</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $enterprise->total_views ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@index')}}"
                                       class="invisible btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-users"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">
                                    Add Coaching
                                 </div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{ action('Website\EnterpriseProfileController@enterprise_profile')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-plus"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">Student Reviews</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $enterprise->total_reviews ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@reviews')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-star"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">
                                 <!-- Total Student Reviews -->
                                 </div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    Advertising Plans
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@plans')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>Upgrade Your Plan &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-level-up"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  @if(
                     session()->get('enterprise')->is_paid_member == 'yes'
                  )
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">Banner Ad Tracking</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $total_advertisement ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@totalclicks')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-ad"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">Course Purchase</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $total_courses ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@totalcourses')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-book"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">Total Search Leads</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $total_searchlead ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@searchlead')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-search"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">Total Page Leads</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $total_pagelead ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@pagelead')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fas fa-search"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-lg-4 col-md-6 mb-md-4 mb-3">
                     <!-- Dashboard info widget 1-->
                     <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                 <div class="small font-weight-bold text-capitalize text-primary mb-1">
                                    Total Purchase Leads</div>
                                 <div class="h5 fs-md-16 fs-14 mb-3">
                                    {{ $total_purchaselead ?? 0 }}
                                 </div>
                                 <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                                    <a 
                                       href="{{action('Website\EnterpriseController@purchaselead')}}"
                                       class="btn btn-sm fs-md-13 fs-12 btn-green border-0 rounded-pill">
                                       <span>OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></span></a>
                                 </div>
                              </div>
                              <div class="ml-2 fs-md-50 fs-34 position-relative">
                                 <i class="fa fa-shopping-cart"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif

               </div>

               </div>
            </div>
         </main>
      </div>
   </div>
</main>

<div class="modal comman_modal_popup fade" id="Change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content border-0">
         <div class="modal-body p-0 row mx-0 border-0 position-relative">
            <div class="col-auto position-absolute right-5px top-5px fs-19 text-primary z-index-1 d-grid align-items-center justify-content-center px-0 border border-primary w-30px h-30px rounded-pill class-cards" data-dismiss="modal"><i class="fas fa-times"></i></div>
            <div class="card shadow-lg col-md-12 border-0 mb-0">
               <div class="card-body py-5 px-sm-5">
                  <div>
                     <div class="mb-md-5 mb-4 text-center">
                        <h6 class="h3 mb-1 fs-md-24 fs-18">Change Password</h6>
        
                     </div>
                     <span class="clearfix"></span>
                     <form action="" method="post" class="row" autocomplete="FALSE" id="change_password_form">
                        @csrf
                        <div class="form-group col-12 mb-3">
                           <div class="d-flex align-items-center justify-content-between">
                              <div>
                                 <label class="form-control-label">Current Password</label>
                              </div>
                           </div>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                    <i class="fas fa-key"></i>
                                 </span>
                              </div>
                              <input required type="password" name="old_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px"  placeholder="Password">
                           </div>
                           
                           <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                              <span class="d-grid align-items-center justify-content-center  w-md-20px w-15px h-md-20px h-15px">
                                 <span class="fa fa-info text-dark fs-12" style="
                                    /* right: 19px; */
                                 "></span>
                              </span>
                           </div>
                        </div>
                        <div class="form-group col-12 mb-3">
                           <div class="d-flex align-items-center justify-content-between">
                              <div>
                                 <label class="form-control-label">New Password</label>
                              </div>
                           </div>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                    <i class="fas fa-key"></i>
                                 </span>
                              </div>
                              <input required type="password" name="new_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px"  placeholder="Password">
                           </div>
                           
                           <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                              <span class="d-grid align-items-center justify-content-center  w-md-20px w-15px h-md-20px h-15px">
                                 <span class="fa fa-info text-dark fs-12" style="
                                    /* right: 19px; */
                                 "></span>
                              </span>
                           </div>
                        </div>
                        <div class="form-group col-12 mb-3">
                           <div class="d-flex align-items-center justify-content-between">
                              <div>
                                 <label class="form-control-label">Confirm Password</label>
                              </div>
                           </div>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text d-grid align-items-center justify-content-center w-md-50px w-40px bg-secondary">
                                    <i class="fas fa-key"></i>
                                 </span>
                              </div>
                              <input required type="password" name="confirm_password" class="form-control fs-xl-15 fs-lg-14 fs-md-14 fs-13 shadow-none h-md-50px h-40px"  placeholder="Password">
                           </div>

                           <div class="position-absolute right-0 i_btn" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="Password rules - <br/>
                                    1) Min. of 6 characters <br/>
                                    2) Must include letters and numbers <br/>">
                              <span class="d-grid align-items-center justify-content-center  w-md-20px w-15px h-md-20px h-15px">
                                 <span class="fa fa-info text-dark fs-12" style="
                                    /* right: 19px; */
                                 "></span>
                              </span>
                           </div>
                        </div>
                        <div class="mt-md-4 mt-2 col-12">                              
                           <button type="submit" class="btn btn-sm btn-block btn-sm btn-primary h-md-50px h-40px align-items-center d-grid" onclick="return change_password()">Change Password</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('website.layouts.footer')

<!-- change password -->
      
<script>
   function change_password() {

      if(! $('#change_password_form').valid() ) 
         return;

      if (
         $('#change_password_form input[name="old_password"]').val() == '' ||
         $('#change_password_form input[name="new_password"]').val() == '' ||
         $('#change_password_form input[name="confirm_password"]').val() == '' 
      ) {

         $('.modal.show').find('form .error_message_to_show').remove();
         $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please fill out required fields'+'</p>');

         return false;

      } else {

         if(! (/[A-Za-z]/i.test($('#change_password_form input[name="confirm_password"]').val()) &&
           /[0-9]/.test($('#change_password_form input[name="confirm_password"]').val()) &&
           $('#change_password_form input[name="confirm_password"]').val().length >= 6) ) {

            $('.modal.show').find('form .error_message_to_show').remove();
            $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Password does not match'+'</p>');

            return false;
         }

         if(! (/[A-Za-z]/i.test($('#change_password_form input[name="new_password"]').val()) &&
         /[0-9]/.test($('#change_password_form input[name="new_password"]').val()) &&
         $('#change_password_form input[name="new_password"]').val().length >= 6) ) {
               
            $('.modal.show').find('form .error_message_to_show').remove();
            $('.modal.show').find('form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+'Please enter a valid new password'+'</p>');
            
            return false;
         }

         var url = '{{ action("Website\EnterpriseProfileController@change_password") }}';
         var post_data = $('#change_password_form').serialize();

         $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: post_data,
            success: function(data) {

               if (data.success) {

                  $('#change_password_form').find('.error_message_to_show').remove();
                  $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-success text-center"> '+data.message+'</p>');
                  
                  $('.modal').modal('hide');

                  document.getElementById("change_password_form").reset();

               } else {

                  $('#change_password_form').find('.error_message_to_show').remove();
                  $('#change_password_form').prepend('<p class="col-12 error_message_to_show text-danger text-center"> '+data.message+'</p>');

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
   function confirmation(form, msg) {
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