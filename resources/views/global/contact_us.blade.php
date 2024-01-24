@extends('global.index')
@section('content')
@if(get_settings('recaptcha_status')==1)
<script src="{{ asset('public/assets/global/js/api.js') }}"></script>
@endif
<!-- Contact Us Area Start  -->
 <section class="contactUs-area">
  <div class="container">
      <div class="contact-title">
          <h3>{{ get_phrase('Contact us') }}</h3>
          <p>{{ get_phrase('Reach Out to Our Team for Assistance and Inquiries') }}</p>
      </div>
      <div class="row">
         <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="contact-icon-box text-center">
               <i class="fa-solid fa-phone"></i>
               <div class="icon-content">
                  <p><a href="tel:'{{ get_settings('phone') }}'">{{ get_settings('phone') }}</a></p>
                  <p><br /></p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="contact-icon-box text-center">
              <i class="fa-solid fa-envelope"></i>
               <div class="icon-content">
                  <p><a href="mailto: '{{ get_settings('system_email') }}'">{{ get_settings('system_email') }}</a></p>
                  <p><br /></p>
               </div>
            </div>
         </div>
         @php
            $destinationAddress = urlencode(get_settings('address'));
            $url = "https://www.google.com/maps/dir/?api=1&origin=current_location&destination={$destinationAddress}&travelmode=driving";
         @endphp
         <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="contact-icon-box text-center">
              <i class="fa-solid fa-location-dot"></i>
               <div class="icon-content">
                    <p><a href="{{ $url }}" target="_blank">{{ get_settings('address') }}</a></p>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
              <div class="send-message-box">
                  <h3>{{ get_phrase('Send a message') }}</h3>
                  <form action="{{ route('contact_email') }}" method="POST">
                    @csrf
                      <div class="group-form">
                          <div class="mb-33">
                              <input type="text" class="form-control" placeholder="Name*" id="customer_name" name="customer_name" required>
                          </div>
                          <div class="mb-33">
                              <input type="email" class="form-control" placeholder="email*" id="email" name="email" required>
                          </div>
                      </div>
                      <div class="group-form">
                          <div class="mb-33">
                              <input type="text" class="form-control" placeholder="Phone number*" id="phone" name="phone" required>
                          </div>
                          <div class="mb-33">
                              <input type="text" class="form-control" placeholder="company*" id="company" name="company" required>
                          </div>
                      </div>
                      <div class="mb-33">
                          <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Write Your Message*" required></textarea>
                      </div>
                      <div class="mb-33">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="check">
                            <label class="form-check-label" for="check">{{ get_phrase('I am bound by the terms of the service I accept Privacy Policy') }}.</label>
                          </div>
                      </div>
                      <!-- reCAPTCHA -->
                      @if(get_settings('recaptcha_status')==1)
                        <div class="g-recaptcha" data-sitekey="{{get_settings('recaptcha_sitekey')}}"></div><br/>
                      @endif

                      <button type="submit" class="btn btn-success">{{ get_phrase('Send Message') }}</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- Contact Us Area End  -->
@endsection