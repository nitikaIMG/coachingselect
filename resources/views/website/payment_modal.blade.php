<div class="row mx-0">
   <div class="col-6 px-0">
      <div class="basics_modal_inner bg-white py-4 px-4 h-100 d-flex align-items-center">
         <form 
            action="{{ action('Website/OrderController@order') }}" 
            method="post" class="row" autocomplete="FALSE">
            @csrf
            <div class="form-group col-12">
               <label class="form-control-label">Student Name</label>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text d-grid align-items-center justify-content-center w-50px bg-secondary">
                     <i class="fas fa-user"></i>
                     </span>
                  </div>
                  <input 
                     @if( session()->has('student') )
                        value="{{ session()->get('student')->name ?? '' }}"
                     @endif
                     type="text" name="name" class="form-control shadow-none h-50px" id="" placeholder="Full Name">
               </div>
            </div>
            <div class="form-group col-12">
               <label class="form-control-label">Parent Name</label>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text d-grid align-items-center justify-content-center w-50px bg-secondary">
                     <i class="fas fa-user"></i>
                     </span>
                  </div>
                  <input type="text" name="parent_name" class="form-control shadow-none h-50px" id="" placeholder="Enter Parent Name">
               </div>
            </div>
            <div class="form-group col-12">
               <label class="form-control-label">Email Id</label>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text d-grid align-items-center justify-content-center w-50px bg-secondary">
                        <i class="fas fa-envelope-open-text"></i>
                     </span>
                  </div>
                  <input 
                     @if( session()->has('student') )
                        value="{{ session()->get('student')->email ?? '' }}"
                     @endif
                  type="email" name="email" class="form-control shadow-none h-50px" id="" placeholder="Email Id">
               </div>
            </div>
            <div class="form-group col-12">
               <label class="form-control-label">Mobile Number</label>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text d-grid align-items-center justify-content-center w-50px bg-secondary">
                        <i class="fas fa-phone-volume"></i>
                     </span>
                  </div>
                  <input type="tel" name="mobile" class="form-control shadow-none h-50px" id="" placeholder="Enter Mobile Number"
                  onkeypress="return isNumberKey(event)" 
                  pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaing 9 digit with 0-9" minlength="10" maxlength="10"
                  >
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="col-6 bg-primary">
      <div class="basics_modal_left py-3">
         <div class="row align-items-center">
            <div class="col"> 
               <h3 class="fs-14 mb-0">Selected Course</h3>
            </div>
            <div class="col-auto"> 
               <a href="javascript:;" data-toggle="tooltip" data-placement="top" data-original-title="Change Course" title="" class="text-white fs-14"><i class="far fa-sync"></i></a>
            </div>
         </div>
         <div class="row bg-white rounded mx-0 mt-3 mb-2 py-3 shadow">
            <div class="col-6 mb-4">
               <div class="selectcourse_box text-left">
                  <i class="fal fa-users-class"></i>
                  <span class="text-gray fs-13 d-block mb-1 mt-1">Selected Class :</span>
                  <strong class="d-block fs-14">Class 4</strong>
               </div>
            </div>
            <div class="col-6 mb-4">
               <div class="selectcourse_box text-left">
                  <i class="fad fa-clipboard-list-check"></i>
                  <span class="text-gray fs-13 d-block mb-1 mt-1">Selected Plans :</span>
                  <strong class="d-block fs-14">3 Months Plan</strong>
               </div>
            </div>
            <div class="col-6 mb-0">
               <div class="selectcourse_box text-left">
                  <i class="fad fa-books"></i>
                  <span class="text-gray fs-13 d-block mb-1 mt-1">Selected Subjects :</span>
                  <strong class="d-block fs-14">Math</strong>
               </div>
            </div>
            <div class="col-6 mb-0">
               <div class="selectcourse_box text-left">
                  <i class="fad fa-money-check"></i>
                  <span class="text-gray fs-13 d-block mb-1 mt-1">Amount :</span>
                  <strong class="d-block fs-14">&#8377; 999</strong>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="row align-items-center py-3 border-bottom">
                  <div class="col-5">
                     <span class="text-white fs-14 d-block mb-0">SubTotal Amount :</span>
                  </div>
                  <div class="col-2 text-center">
                     <span class="text-white fs-14 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                  </div>
                  <div class="col-5 text-right">
                     <span class="text-white fs-14 d-block mb-0">&#8377; 999</span>
                  </div>
               </div>
               <div class="row align-items-center py-3 border-bottom bg-white">
                  <div class="col-5">
                     <span class="text-primary fs-14 d-block mb-0">Total Amount :</span>
                  </div>
                  <div class="col-2 text-center">
                     <span class="text-primary fs-14 d-block mb-0"><i class="fas fa-chevron-right"></i></span>
                  </div>
                  <div class="col-5 text-right">
                     <span class="text-primary fs-14 d-block mb-0">&#8377; 999</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="mt-4 col-12">
               <a href="javascript:;" class="btn btn-block btn-secondary h-50px align-items-center d-flex justify-content-center"><i class="fad fa-check-circle mr-1"></i>Proceed</a>
            </div>
         </div>
      </div>
   </div>
</div>