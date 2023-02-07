@include('website/layouts/header')

<main id="main">
      <section class="thankyou">
          <div class="container">
             <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-7">
                    <div class="row thankyou_outter rounded-15 mx-md-n1 position-relative p-xl-5 p-lg-4 p-md-3 p-2 overflow-hidden px-3 h-100">
                        <div class="col-12 thankyou_main z-index-1000 rounded-15 mx-n1 position-relative pb-5 overflow-hidden text-center px-md-4 px-3 h-100">

                            @if( 
                                preg_match('/counselling/', url()->previous())
                            )
                                <h1 class="col-12 pt-md-5 pt-4 font-weight-bold fs-xl-28 fs-lg-22 fs-md-17 fs-17 text-white">
                                    Thank you for showing interest in CoachingSelect Counselling Session.
                                </h1>

                                <p class="col-12 fs-lg-17 fs-md-14 fs-13 text-white mt-lg-4 mt-md-2 pt-2">
                                    Our representative will get in touch with you shortly.    
                                </p>
                            @elseif( 
                                preg_match('/coaching/', url()->previous())
                            )
                                <h1 class="col-12 pt-md-5 pt-4 font-weight-bold fs-xl-28 fs-lg-22 fs-md-17 fs-17 text-white">
                                {{$msg}}</h1>

                                <p class="col-12 fs-lg-17 fs-md-14 fs-13 text-white mt-lg-4 mt-md-2 pt-2">
                                    Our representative will get in touch with you shortly.    
                                </p>
                            @else 
                                <h1 class="col-12 pt-md-5 pt-4 font-weight-bold fs-xl-28 fs-lg-22 fs-md-17 fs-17 text-white">
                                {{$msg}}.</h1>

                                <p class="col-12 fs-lg-17 fs-md-14 fs-13 text-white mt-lg-4 mt-md-2 pt-2">
                                    Please note, a confirmation email has been sent to your provided email.    
                                </p>
                                <p class="col-12 fs-lg-17 fs-md-14 fs-13 text-white mt-lg-4 mt-md-2 pt-2">
                                    Check your Spam folder if you can't find the mail in your Inbox.
                                </p>
                            @endif

                            @if( 
                                preg_match('/plans/', url()->previous())
                            )
                            @else
                            <p class="col-12 fs-lg-17 fs-md-14 fs-13 text-white mt-lg-4 mt-md-2 pt-2">
                                Join our telegram group and stay updated with the latest updates on Education!
                            </p>
                            @endif

                            <p class="col-12 text-white mt-4">
                                Also write to us at <a class="text-white font-weight-bold fs-lg-17 fs-md-14 fs-13" href="mailto:support@coachingselect.com">support@coachingselect.com</a> for more information.
                            </p>
                            
                            @if( 
                                preg_match('/plans/', url()->previous())
                            )
                            @else
                            <p class="col-12 text-white mt-4">
                                <a target="_blank" class="bg bg-white p-2 rounded-pill text-primary font-weight-bold" href="https://t.me/coachingselect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                                    </svg> Join Now
                                </a>
                            </p>   
                            @endif

                            @if( 
                                preg_match('/plans/', url()->previous())
                            )
                            <p class="col-12 text-white mt-4">
                                <a class="btn btn-block bg bg-white p-2 rounded-pill text-primary font-weight-bold" 
                                    href="{{ action('Website\EnterpriseController@index') }}">
                                    Home
                                </a>
                            </p>   
                            @else
                            @endif
                        </div>
                    </div>
                </div>
             </div>
          </div>
      </section>
</main>

@include('website/layouts/footer')