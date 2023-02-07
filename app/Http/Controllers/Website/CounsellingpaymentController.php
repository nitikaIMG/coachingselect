<?php

# Paytm payment gateway
namespace App\Http\Controllers\Website;

use PaytmWallet;
use App\Http\Controllers\Controller;

use DB;

use App\Helpers\Helpers;

class CounsellingpaymentController extends Controller
{
    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function order()
    {        
        if(
          session()->get('order_counselling.is_email_verified') == 'yes'
          and
          session()->get('order_counselling.is_mobile_verified') == 'yes'
          and
          !empty(
            session()->get('order_counselling.counselling_id')
          )
          and
          !empty(
            session()->get('order_counselling.email')
          )
          and
          !empty(
            session()->get('order_counselling.mobile')
          )
          and
          !empty(
            session()->get('order_counselling.name')
          )
        ) {

          $counselling_id = session()->get('order_counselling.counselling_id');

          $counselling = DB::table('counselling')
                              ->where('id', $counselling_id)
                              ->first();

          if( !empty($counselling) ) {
            $remaining_amount=0;
            if(request()->get('registration_fee')==0){
                $final_price = request()->get('ttl_price');
            }else{
                $final_price = request()->get('registration_fee');
                $remaining_amount = request()->get('remaining_fee');
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
        
          $payment_id = DB::table('counselling_payment_process')
                          ->insertGetId($payment_process);

          // # order tbl entry
          $order = array();
          $order['is_email_verified'] = session()->get('order_counselling.is_email_verified');
          $order['is_mobile_verified'] = session()->get('order_counselling.is_mobile_verified');
          $order['email'] = session()->get('order_counselling.email');
          $order['mobile'] = session()->get('order_counselling.mobile');
          $order['parent_name'] = session()->get('order_counselling.parent_name') ?? '';
          $order['student_name'] = session()->get('order_counselling.name');
          $order['counselling_id'] = session()->get('order_counselling.counselling_id');
          $order['status'] = 'pending';
          $order['total_price'] = $payment_process['amount'];
          $order['payment_id'] = $payment_id;
          $order['transaction_id'] = $payment_process['transaction_id'];
          $order['quantity'] = 1;
          $order['order_id'] = $payment_process['order_id'];
          $order['user_id'] = $payment_process['user_id'];

          DB::table('counselling_order')
          ->insert($order);

          // if amount is 0
          if($final_price == 0) {
            $order_id = $payment_process['order_id'];
            $return_id = 0;
            $status = 'TXN_SUCCESS';

            $payment_process = array();
            $payment_process['status'] = $status;
            $payment_process['return_id'] = $return_id;

            DB::table('counselling_payment_process')
              ->where('order_id', $order_id)
              ->update($payment_process);
              
            $orders = array();
            $orders['status'] = $status;

            DB::table('counselling_order')
              ->where('order_id', $order_id)
              ->update($orders);

            return redirect()
                    ->action('Website\IndexController@thank_you')
                    ->with('success', 'Counselling Booked successfully');
          }
        
          $payment = PaytmWallet::with('receive');
          $payment->prepare([
            'order' => $payment_process['order_id'],
            'user' =>  $payment_process['user_id'],
            'mobile_number' => $order['mobile'],
            'email' => $order['email'],
            'amount' => $payment_process['amount'],
            'callback_url' => action('Website\CounsellingpaymentController@paymentCallback')
          ]);
          return $payment->receive();

        } else {
          return redirect()
                  ->back()
                  ->with('error', 'Something went wrong');
        }
    }

    
    public function discount_counseling()
    {

        $this->validate(
          request(),
          [
            'mobile' => 'required',
            'is_mobile_verified' => 'required',
            'is_email_verified' => 'required',
            'counselling_id' => 'required',
            'email' => 'required',
            'name' => 'required',
          ]
        );

        if(
          request()->get('is_email_verified') == 'yes'
          and
          request()->get('is_mobile_verified') == 'yes'
          and
          !empty(
            request()->get('counselling_id')
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
        ) {

          $counselling_id = request()->get('counselling_id');

          $counselling = DB::table('counselling')
                              ->where('id', $counselling_id)
                              ->first();

          if( !empty($counselling) ) {

            $discount_price = ($counselling->fee * $counselling->offer_percentage) / 100;
            $final_price = ($counselling->fee - $discount_price);
          
          } else {
            abort(404);
          }
        }

        if(
          empty($counselling)
        ) {
          abort(404);
        }

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
          
            $payment_id = DB::table('counselling_payment_process')
                            ->insertGetId($payment_process);

            // # order tbl entry
            $order = array();
            $order['is_email_verified'] = request()->get('is_email_verified');
            $order['is_mobile_verified'] = request()->get('is_mobile_verified');
            $order['email'] = request()->get('email');
            $order['mobile'] = request()->get('mobile');
            $order['parent_name'] = request()->get('parent_name') ?? '';
            $order['student_name'] = request()->get('name');
            $order['counselling_id'] = request()->get('counselling_id');
            $order['status'] = 'pending';
            $order['total_price'] = $payment_process['amount'];
            $order['payment_id'] = $payment_id;
            $order['transaction_id'] = $payment_process['transaction_id'];
            $order['quantity'] = 1;
            $order['order_id'] = $payment_process['order_id'];
            $order['user_id'] = $payment_process['user_id'];

            DB::table('counselling_order')
            ->insert($order);

          $order_id = $payment_process['order_id'];
          $return_id = 0;
          $status = 'TXN_SUCCESS';

          $payment_process = array();
          $payment_process['status'] = $status;
          $payment_process['return_id'] = $return_id;

          DB::table('counselling_payment_process')
            ->where('order_id', $order_id)
            ->update($payment_process);
            
          $orders = array();
          $orders['status'] = $status;

          DB::table('counselling_order')
            ->where('order_id', $order_id)
            ->update($orders);

          return redirect()
                  ->action('Website\IndexController@thank_you')
                  ->with('success', 'Counselling Booked successfully');
        }
          
        session([
          'order_counselling' => request()->all()
        ]);
        
        $header = new HeaderController();
        $footer = new FooterController();
        
        return view('website.discount_counseling', 
        compact('header', 'footer', 'counselling'));  
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

          DB::table('counselling_payment_process')
            ->where('order_id', $order_id)
            ->update($payment_process);
            
          $orders = array();
          $orders['status'] = $status;

          DB::table('counselling_order')
            ->where('order_id', $order_id)
            ->update($orders);
            
            try {
            
                // send mail
                $counselling_name = DB::table('counselling_order')
                                ->where('counselling_order.order_id', $order_id)
                                ->join('counselling', 'counselling.id', 'counselling_order.counselling_id')
                                ->value('counselling.name');
                                
                $category = DB::table('counselling_order')
                                ->where('counselling_order.order_id', $order_id)
                                ->join('counselling', 'counselling.id', 'counselling_order.counselling_id')
                                ->value('counselling.type');
                                
                $student = DB::table('counselling_order')
                                ->where('counselling_order.order_id', $order_id)
                                ->join('students', 'students.id', 'counselling_order.user_id')
                                ->select('students.*')
                                ->first();
                
                $fee = DB::table('counselling_order')
                    ->where('counselling_order.order_id', $order_id)
                    ->join('counselling', 'counselling.id', 'counselling_order.counselling_id')
                    ->value('counselling_order.total_price');
                
                $name = DB::table('counselling_order')
                    ->where('counselling_order.order_id', $order_id)
                    ->join('counselling', 'counselling.id', 'counselling_order.counselling_id')
                    ->value('counselling_order.student_name');
                
                $email = DB::table('counselling_order')
                    ->where('counselling_order.order_id', $order_id)
                    ->join('counselling', 'counselling.id', 'counselling_order.counselling_id')
                    ->value('counselling_order.email');
                
                $mobile = DB::table('counselling_order')
                    ->where('counselling_order.order_id', $order_id)
                    ->join('counselling', 'counselling.id', 'counselling_order.counselling_id')
                    ->value('counselling_order.mobile');
                
                $email = $student->email;
                
                $student_name = $student->name;
                        
                $subject = $student_name.', Your Registration for '.$counselling_name.' is confirmed';
                
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.counselling_purchase', compact('student_name', 'counselling_name', 'category', 'fee', 'name', 'email', 'mobile'), function ($m) use ($datamessage){
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
                  ->with('success', 'Payment Done. Counselling Booked successfully');
            
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
          
          $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
          $mobile = DB::table('students')
                    ->where('id', $user_id)
                    ->value('mobile');

          Helpers::sendTextSmsNew($sms, $mobile);
          
          DB::table('students')
            ->where('id', $user_id)
            ->update($student);

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
          
          $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
          
          Helpers::sendTextSmsNew($sms, $mobile);
          
          DB::table('students')
            ->where('id', $user_id)
            ->update($student);

          return 1;
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
}

