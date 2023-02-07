<?php

# Paytm payment gateway
namespace App\Http\Controllers\Website;

use PaytmWallet;
use App\Http\Controllers\Controller;

use DB;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

use App\Helpers\Helpers;

class OrderController extends Controller
{
    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function order()
    {

        if(
          session()->get('order.is_email_verified') == 'yes'
          and
          session()->get('order.is_mobile_verified') == 'yes'
          and
          !empty(
            session()->get('order.coaching_courses_detail_id')
          )
          and
          !empty(
            session()->get('order.email')
          )
          and
          !empty(
            session()->get('order.mobile')
          )
          and
          !empty(
            session()->get('order.name')
          )
          and
          !empty(
            session()->get('student')
          )
        ) {

          $coaching_courses_detail_id = session()->get('order.coaching_courses_detail_id');

          $coaching_course = DB::table('coaching_courses_detail')
                              ->where('id', $coaching_courses_detail_id)
                              ->first();

          if( !empty($coaching_course) ) {
            $remaining_amount=0;
            if(request()->get('registration_fee')==0){
                $final_price = request()->get('ttl_price');
            }else{
                $final_price = request()->get('registration_fee');
                $remaining_amount = request()->get('remaining_fee');
            }

            if( empty( request()->get('discount_total') ) ){
                $discount_total = 0;
            }else{
                $discount_total = request()->get('discount_total') ?? 0;

                $discount_total = number_format($discount_total, 2, '.', '');
            }
                      
          } else {
            abort(404);
          }
                    
          # payment_process tbl entry
          $payment_process = array();
          $payment_process['user_id'] = session()->get('student')->id;
          $payment_process['order_id'] = 'CS-' . rand(1000, 9999) . '-' . time();
          $payment_process['transaction_id'] = 'CS-TXN' . rand(1000, 9999) . '-' . time();
          $payment_process['amount'] = number_format($final_price, 2, '.', '');
          $payment_process['payment_by'] = 'paytm';
          $payment_process['return_id'] = '';
          
          if( 
            ! empty(
              request()->get('code')
            )
          ) {

            $code = request()->get('code');

            $is_code_valid = DB::table('offers')
                        ->where('offercode', $code)
                        ->first();

            if( !empty($is_code_valid) ) {
              $payment_process['coupon_id'] = request()->get('code');
            } else {
              $payment_process['coupon_id'] = '';
            }
          }
          $payment_process['status'] = 'pending';
        
          $payment_id = DB::table('payment_process')
                          ->insertGetId($payment_process);

          // # order tbl entry
          $order = array();
          $order['coaching_courses_detail_id'] = session()->get('order.coaching_courses_detail_id');
          $order['is_email_verified'] = session()->get('order.is_email_verified');
          $order['is_mobile_verified'] = session()->get('order.is_mobile_verified');
          $order['email'] = session()->get('order.email');
          $order['mobile'] = session()->get('order.mobile');
          $order['parent_name'] = session()->get('order.parent_name') ?? '';
          $order['student_name'] = session()->get('order.name');
          $order['status'] = 'pending';
          $order['total_price'] = $payment_process['amount'];
          $order['payment_id'] = $payment_id;
          $order['transaction_id'] = $payment_process['transaction_id'];
          $order['quantity'] = 1;
          $order['order_id'] = $payment_process['order_id'];
          $order['user_id'] = $payment_process['user_id'];
          
          $order['remaining_amount'] = $remaining_amount;
          
          $order['discount_total'] = $discount_total;
          
          $order['invoice_number'] = str_pad(
                                      DB::table('orders')
                                        ->orderBy('invoice_number', 'desc')
                                        ->value('invoice_number') + 1, 4, 0, STR_PAD_LEFT
                                    );

          DB::table('orders')
          ->insert($order);
        
          $payment = PaytmWallet::with('receive');
          $payment->prepare([
            'order' => $payment_process['order_id'],
            'user' =>  $payment_process['user_id'],
            'mobile_number' => $order['mobile'],
            'email' => $order['email'],
            'amount' => $payment_process['amount'],
            'callback_url' => action('Website\OrderController@paymentCallback')
          ]);

          $student = DB::table('students')
                    ->where('id', session()->get('student')->id)
                    ->first();

          session([
            'student' => $student
          ]);

          return $payment->receive();

        } else {
          return redirect()
                  ->back()
                  ->with('error', 'Something went wrong');
        }
    }

    /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); 
                
        if($transaction->isSuccessful()){
          //Transaction Successful

          $response = $transaction->response();

          $order_id = $response['ORDERID'];
          $return_id = $response['TXNID'];
          $status = $response['STATUS'];

          $payment_process = array();
          $payment_process['status'] = $status;
          $payment_process['return_id'] = $return_id;

          DB::table('payment_process')
            ->where('order_id', $order_id)
            ->update($payment_process);
            
          $orders = array();
          $orders['status'] = $status;

          DB::table('orders')
            ->where('order_id', $order_id)
            ->update($orders);
            
          try {
          
              // send mail
              $course_name = DB::table('orders')
                              ->where('orders.order_id', $order_id)
                              ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                              ->value('coaching_courses_detail.name');
              
              $coaching_name = DB::table('orders')
                              ->where('orders.order_id', $order_id)
                              ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                              ->join('coaching', 'coaching.id', 'coaching_courses_detail.coaching_id')
                              ->value('coaching.name');
                              
              $coaching_image = DB::table('orders')
                              ->where('orders.order_id', $order_id)
                              ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                              ->join('coaching', 'coaching.id', 'coaching_courses_detail.coaching_id')
                              ->value('coaching.image');
                      
              $student = DB::table('orders')
                              ->where('orders.order_id', $order_id)
                              ->join('students', 'students.id', 'orders.user_id')
                              ->select('students.*')
                              ->first();
              
              $course_fee = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('coaching_courses_detail.fee');
                  
              $amount_paid = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('orders.total_price');
                  
              $remaining_amount = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('orders.remaining_amount');
              
              $name = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('orders.student_name');
              
              $email = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('orders.email');
              
              $mobile = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('orders.mobile');

              $date = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('orders.created_at');
              
              $date = date('Y-m-d h:i', strtotime($date));
              
              $course_type = DB::table('orders')
                  ->where('orders.order_id', $order_id)
                  ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                  ->value('coaching_courses_detail.offering');
              
              $offer_percentage = DB::table('orders')
                            ->where('orders.order_id', $order_id)
                            ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                            ->value('coaching_courses_detail.offer_percentage');
              
              $course_discount = ($course_fee * $offer_percentage) / 100;
              
              $additional_discount = DB::table('orders')
                                    ->where('orders.order_id', $order_id)
                                    ->join('coaching_courses_detail', 'coaching_courses_detail.id', 'orders.coaching_courses_detail_id')
                                    ->value('orders.discount_total');
                        
              $email = $student->email;
              
              $student_name = $student->name;
                      
              $subject = $student_name.', Your Registration for '.$course_name.' at '.$coaching_name.' is confirmed';
              
              if( !empty($email) ) {
                      
                $datamessage['email']=$email;
                $datamessage['subject']=$subject;
              
                \Mail::send('mails.course_purchase', compact('student_name', 'course_name', 'coaching_name', 'course_fee', 'name', 'email', 'mobile', 'date', 'course_type', 'amount_paid', 'remaining_amount', 'coaching_image',
                'course_discount', 'additional_discount'
                  ), function ($m) use ($datamessage){
                  $m->from('support@coachingselect.com', 'CoachingSelect');
                  $m->to($datamessage['email'])->subject($datamessage['subject']);
                });
              
              }
                              
          } catch(\Exception $e) {
              // ignore mail error
              
          }

          $student = DB::table('orders')
                      ->where('orders.order_id', $order_id)
                      ->join('students', 'students.id', 'orders.user_id')
                      ->select('students.*')
                      ->first();

          session()->forget('enterprise');
          
          session([
            'student' => $student
          ]);
                      
          return redirect()
                  ->action('Website\IndexController@thank_you')
                  ->with('success', 'Payment Done. Course Buyed successfully');
            
        }else if($transaction->isFailed()){
          
          $response = $transaction->response();

          $order_id = $response['ORDERID'];

          $student = DB::table('orders')
                      ->where('orders.order_id', $order_id)
                      ->join('students', 'students.id', 'orders.user_id')
                      ->select('students.*')
                      ->first();

          session()->forget('enterprise');
          
          session([
            'student' => $student
          ]);
          
          return redirect()
                   ->action('Website\IndexController@index')
                  ->with('error', 'Payment Failed');
            
        }else if($transaction->isOpen()){
          
          $response = $transaction->response();

          $order_id = $response['ORDERID'];

          $student = DB::table('orders')
                      ->where('orders.order_id', $order_id)
                      ->join('students', 'students.id', 'orders.user_id')
                      ->select('students.*')
                      ->first();

          session()->forget('enterprise');
          
          session([
            'student' => $student
          ]);
          
          return redirect()
                  ->action('Website\IndexController@index')
                  ->with('success', 'Payment is in processing.');
            
        } else {
          return redirect()
                  ->action('Website\IndexController@index')
                  ->with('success', 'Something went wrong');
            
        }

    }    

    public function otp() {
      if
      (
        ! empty(
            request()->get('email')
        )
      ) {
        $email = request()->get('email');

        if(
          session()->has('student')
        ) {
          $user_id = session()->get('student')->id;

          $student = array();
          // $student['code'] = 1234;
          $student['code'] = rand(1000, 9999);
          DB::table('students')
            ->where('id', $user_id)
            ->update($student);

          $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
          $mobile = DB::table('students')
                      ->where('id', $user_id)
                      ->value('mobile');

          Helpers::sendTextSmsNew($sms, $mobile);

          return 1;
        }
      }

      if
      (
        ! empty(
            request()->get('mobile')
        )
      ) {
        $mobile = request()->get('mobile');

        if(
          session()->has('student')
        ) {
          $user_id = session()->get('student')->id;

          $student = array();
          // $student['code'] = 1234;
          $student['code'] = rand(1000, 9999);

          DB::table('students')
            ->where('id', $user_id)
            ->update($student);

          $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
          
          Helpers::sendTextSmsNew($sms, $mobile);

          return 1;
        } else {
          
          $student = array();
          // $student['code'] = 1234;
          $student['code'] = rand(1000, 9999);
          
          $is_exists = DB::table('students')
                      ->where('mobile', $mobile)
                      ->exists();
          
          if($is_exists) {

            DB::table('students')
              ->where('mobile', $mobile)
              ->update($student);

            $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
            $mobile = DB::table('students')
                        ->where('mobile', $mobile)
                        ->value('mobile');

            Helpers::sendTextSmsNew($sms, $mobile);

            return 1;
          } else {
            return 0;
          }
        }
      }

      return 0;
    }

    public function otp_verify() {
      if
      (
        ! empty(
            request()->get('otp')
        )
      ) {
        
        if(
          session()->has('student')
        ) {
          $user_id = session()->get('student')->id;

          $code = request()->get('otp');
          
          $is_exists = DB::table('students')
                      ->where('id', $user_id)
                      ->where('code', $code)
                      ->exists();

          if($is_exists) {
            return 1;
          } else {
            return 0;
          }
        }
      }

      return 0;
    }

    public function discount() {

      try {
        $this->validate(
          request(),
          [
            'mobile' => 'required',
            'is_mobile_verified' => 'required',
            'is_email_verified' => 'required',
            'coaching_courses_detail_id' => 'required',
            'email' => 'required',
            'name' => 'required',
          ]
        );
      } catch(\Exception $e) {
        
        return redirect()
                ->action('Website\IndexController@index')
                ->with('error', $e->getMessage());
        
      }

      if(
        request()->get('is_email_verified') == 'yes'
        and
        request()->get('is_mobile_verified') == 'yes'
        and
        !empty(
          request()->get('coaching_courses_detail_id')
        )
        and
        !empty(
          request()->get('email')
        )
        and
        !empty(
          request()->get('mobile')
        )
        and
        !empty(
          request()->get('name')
        )
        and
        !empty(
          session()->get('student')
        )
      ) {

        $registration_fee= 0;$remaining_fee= 0;
        if(!empty(request()->get('registration_fee'))){
            $registration_fee= request()->get('registration_fee');
        }
        if(!empty(request()->get('remaining_fee'))){
            $remaining_fee= request()->get('remaining_fee');
        }
        $coaching_courses_detail_id = request()->get('coaching_courses_detail_id');

        $coaching_course = DB::table('coaching_courses_detail')
                            ->where('id', $coaching_courses_detail_id)
                            ->first();

        if( !empty($coaching_course) ) {

            $discount_price = ($coaching_course->fee * $coaching_course->offer_percentage) / 100;
            $final_price = ($coaching_course->fee - $discount_price);
          
          } else {
            abort(404);
          }
      }
      
      if(
        empty($coaching_course)
      ) {
        abort(404);
      }

      $coaching_course->course = DB::table('coaching_courses')
                                      ->join('coaching','coaching.id','coaching_courses.coaching_id')->where('coaching_courses.id', $coaching_course->coaching_courses_id)
                                      ->select('coaching_courses.name as course_name', 'coaching.name as coaching_name','coaching.image as coaching_image')
                                      ->first();;

      // if amount is 0
      if($final_price == 0) {

        # payment_process tbl entry
        $payment_process = array();
        $payment_process['user_id'] = session()->get('student')->id;
        $payment_process['order_id'] = 'CS-' . rand(1000, 9999) . '-' . time();
        $payment_process['transaction_id'] = 'CS-TXN' . rand(1000, 9999) . '-' . time();
        $payment_process['amount'] = $final_price;
        $payment_process['payment_by'] = 'paytm';
        $payment_process['return_id'] = '';
        
        if( 
          ! empty(
            request()->get('code')
          )
        ) {

          $code = request()->get('code');

          $is_code_valid = DB::table('offers')
                      ->where('offercode', $code)
                      ->first();

          if( !empty($is_code_valid) ) {
              $payment_process['coupon_id'] = request()->get('code');
            } else {
              $payment_process['coupon_id'] = '';
            }
          }

          $payment_process['status'] = 'pending';
        
          $payment_id = DB::table('payment_process')
                          ->insertGetId($payment_process);

          // # order tbl entry
          $order = array();
          $order['is_email_verified'] = request()->get('is_email_verified');
          $order['is_mobile_verified'] = request()->get('is_mobile_verified');
          $order['email'] = request()->get('email');
          $order['mobile'] = request()->get('mobile');
          $order['parent_name'] = request()->get('parent_name') ?? '';
          $order['student_name'] = request()->get('name');
          $order['coaching_courses_detail_id'] = request()->get('coaching_courses_detail_id');
          $order['status'] = 'pending';
          $order['total_price'] = $payment_process['amount'];
          $order['payment_id'] = $payment_id;
          $order['transaction_id'] = $payment_process['transaction_id'];
          $order['quantity'] = 1;
          $order['order_id'] = $payment_process['order_id'];
          $order['user_id'] = $payment_process['user_id'];

          DB::table('orders')
          ->insert($order);

          $order_id = $payment_process['order_id'];
          $return_id = 0;
          $status = 'TXN_SUCCESS';

          $payment_process = array();
          $payment_process['status'] = $status;
          $payment_process['return_id'] = $return_id;

          DB::table('payment_process')
            ->where('order_id', $order_id)
            ->update($payment_process);
            
          $orders = array();
          $orders['status'] = $status;

          DB::table('orders')
            ->where('order_id', $order_id)
            ->update($orders);

          return redirect()
                  ->action('Website\IndexController@thank_you')
                  ->with('success', 'Course Booked successfully');
      }
      
      session([
        'order' => request()->all()
      ]);
      
      $header = new HeaderController();
      $footer = new FooterController();
      
      return view('website.discount', compact('header', 'footer', 'coaching_course','registration_fee','remaining_fee'));
    }

    public function code() {
        $code = request()->get('code');
        $final_price = request()->get('final_price');

        $currentdate = date('Y-m-d H:i:s');

        $is_code_valid = DB::table('offers')
                        ->where('offercode', $code)
                        ->where('start_date','<=', $currentdate)
                        ->where('expire_date','>=', $currentdate)
                        ->where('is_shown', 'yes')
                        ->where('status', 'enable')
                        ->first();
                        
        if (!empty($is_code_valid)) {
            $max = $is_code_valid->maxamount;
            $min = $is_code_valid->minamount;
            if ($max >= $final_price && $min <= $final_price) {
                
            } else {
              return 0;
            }
        }

        if (
            !empty(session()->get('student'))
            and
            !empty( $is_code_valid )
          ) {
          
            $user_id = session()->get('student')->id;

            $total_used = DB::table('payment_process')
                          ->where('user_id', $user_id)
                          ->where('coupon_id', $code)
                          ->where('status', 'TXN_SUCCESS')
                          ->count();
          
            if ($total_used >= $is_code_valid->user_time) {
                
              return 0;
            }
        }

        if( !empty($is_code_valid) ) {
            if($is_code_valid->bonus_type =='per'){
                $ttlamount= $final_price*$is_code_valid->bonus/100;
            }else{
                $ttlamount=$is_code_valid->bonus;
            }

            return $ttlamount;
        } else {
          return 0;
        }
    }

    public function enterprise_otp() {
      if
      (
        ! empty(
            request()->get('email')
        )
      ) {
        $email = request()->get('email');

        if(
          session()->has('enterprise')
        ) {
          $user_id = session()->get('enterprise')->id;

          $student = array();
          $student['code'] = rand(1000, 9999);
          
          DB::table('coaching')
            ->where('id', $user_id)
            ->update($student);

          $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
          $mobile = DB::table('coaching')
                      ->where('id', $user_id)
                      ->value('mobile');

          Helpers::sendTextSmsNew($sms, $mobile);

          return 1;
        }
      }

      if
      (
        ! empty(
            request()->get('mobile')
        )
      ) {
        $mobile = request()->get('mobile');

        if(
          session()->has('enterprise')
        ) {
          $user_id = session()->get('enterprise')->id;

          $student = array();
          // $student['code'] = 1234;
          $student['code'] = rand(1000, 9999);
          
          DB::table('coaching')
            ->where('id', $user_id)
            ->update($student);

          $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
          $mobile = DB::table('coaching')
                      ->where('id', $user_id)
                      ->value('mobile');

          Helpers::sendTextSmsNew($sms, $mobile);

          return 1;
        } else {
          
          $student = array();
          // $student['code'] = 1234;
          $student['code'] = rand(1000, 9999);

          $is_exists = DB::table('coaching')
                      ->where('mobile', $mobile)
                      ->exists();
          
          if($is_exists) {

            DB::table('coaching')
              ->where('mobile', $mobile)
              ->update($student);

            $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
            $mobile = DB::table('coaching')
                        ->where('mobile', $mobile)
                        ->value('mobile');

            Helpers::sendTextSmsNew($sms, $mobile);

            return 1;
          } else {
            return 0;
          }
        }
      }

      return 0;
    }
}