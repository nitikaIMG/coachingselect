@include('website/layouts/header')

<main id="main">
      <section class="thankyou">
          <div class="container">
             <div class="row">
                <div class="col-md-6">
                    <div class="row thankyou_outter rounded-15 mx-n1 position-relative p-md-5 p-3 overflow-hidden px-3 h-100">
                        <div class="col-12 thankyou_main z-index-1000 rounded-15 mx-n1 position-relative pb-5 overflow-hidden text-center px-md-4 px-3 h-100">
                            <h1 class="col-12 pt-md-5 pt-4 font-weight-bold fs-28 text-white">
                            Sorry! Payment Failed</h1>
                            <p class="col-12 fs-17 text-white mt-4">Our team will reach out to you soon.</p>
                            <p class="col-12 text-white mt-4">Alternatively you can also write to us at <a class="text-white font-weight-bold" href="mailto:support@coachingselect.com">support@coachingselect.com</a></p>
                        </div>
                    </div>
                </div>
             </div>
          </div>
      </section>
</main>

@include('website/layouts/footer')