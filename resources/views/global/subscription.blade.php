@extends('global.index')
@section('content')
<style>
  .newslater-form .form-control::placeholder{
    font-size:14px;
  }
  .newslater-form .form-control{
    height: 30px;
  }
  .toggle-icon i, .crose-icon i {
	margin-top: 11px;
}
</style>
   <!-- Pricing Plan  Area Start   -->
   <section class="pricing_plan mt-5 pt-5 ">
      <div class="container">
         <div class="row">
               <div class="col-lg-12">
                  <div class="section-intro mb-50">
                     <p>{{ get_frontend_settings('pricing_subtitle') }}</p>
                     <h4>{{ get_frontend_settings('pricing_title') }}</h4>
                  </div>
               </div>
           </div>
           <div class="row">
              @foreach($packages as $package)   
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                 <div class="card packageBox">
                     <div class="card-head">
                        <span class="price_icon d-flex justify-content-center align-items-center">
                           @if($package->icon_type == 1)
                           <svg viewBox="0 0 32 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M9.26815 37.1424L0.25662 13.5267C0.256271 13.4693 0.251891 13.4117 0.243517 13.3543C-0.155679 11.5151 0.237636 9.95007 1.43148 8.69069C1.75609 8.34859 2.17418 8.10516 2.54981 7.81641L23.2731 0.288628C23.3085 0.299009 23.3447 0.304553 23.3808 0.305122C24.9095 0.0920977 26.5913 1.86676 26.1032 3.69634C25.5602 5.72812 25.0873 7.78493 24.5726 9.82698C24.5179 10.0462 24.5633 10.1529 24.7464 10.2824C26.4964 11.4941 28.2362 12.7223 29.9856 13.9325C30.8599 14.5364 31.2605 15.3698 31.1938 16.4106C31.1272 17.4513 30.6191 18.1595 29.6747 18.5026C22.4627 21.1143 15.2532 23.7318 8.04618 26.3549L7.7134 26.4758L7.8694 26.8846C8.99868 29.844 10.1166 32.8066 11.2652 35.759C11.5533 36.5015 11.5384 37.1093 10.977 37.6118L10.5124 37.7806C10.2785 37.7894 10.0421 37.7355 9.82472 37.6241C9.60736 37.5126 9.416 37.347 9.26815 37.1424Z" fill="#007BFF"/>
                              </svg>
                            @endif
                           @if($package->icon_type == 2)
                             <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32.2388 5.20097L32.444 19.8006C32.3949 20.0541 32.3515 20.3084 32.2957 20.5604C31.6257 23.5679 29.0729 25.609 25.892 25.6701C24.0232 25.7063 22.1542 25.7201 20.2853 25.7451C16.0042 25.8023 11.7235 25.8877 7.44175 25.904C3.82701 25.9179 0.944267 23.1161 0.886595 19.5981C0.812865 15.0937 0.74956 10.5889 0.696679 6.08374C0.692461 5.83411 0.722469 5.58504 0.785908 5.34316C1.30349 3.4416 3.66842 2.79661 5.15169 4.16082C6.23617 5.15705 7.28976 6.18179 8.35799 7.1935C8.43561 7.26712 8.51811 7.33666 8.63235 7.4379C8.73117 7.32177 8.80392 7.22446 8.88917 7.13822C10.7221 5.30042 12.5554 3.46341 14.3889 1.62721C15.6248 0.388795 17.1611 0.369849 18.433 1.57311L24.1081 6.95631C24.1915 7.03547 24.2824 7.11454 24.3775 7.20077C24.4653 7.11932 24.5327 7.0574 24.5961 6.99393C25.6282 5.96136 26.6544 4.92324 27.6915 3.89622C28.4103 3.18415 29.2768 2.91164 30.2776 3.1696C31.2785 3.42756 31.9094 4.08626 32.1768 5.06693C32.193 5.11346 32.2138 5.15835 32.2388 5.20097Z" fill="#007BFF"/>
                           </svg>
                            @endif
                           @if($package->icon_type == 3)
                            <svg width="33" height="31" viewBox="0 0 33 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M32.2133 11.6225C31.9734 12.6241 31.5269 13.5675 30.901 14.3955C29.4141 16.35 27.9495 18.3204 26.4758 20.2844L19.8641 29.1001C18.1939 31.3271 15.0691 31.3416 13.3831 29.1331C9.5828 24.1457 5.78087 19.1593 1.97731 14.1741C1.42694 13.4554 1.0381 12.6318 0.836094 11.7568L9.04875 11.6957C9.57021 12.9843 10.0934 14.2782 10.6182 15.5774L15.3284 27.2559C15.663 28.0868 16.4156 28.4331 17.1588 28.1037C17.5504 27.9296 17.758 27.6137 17.9035 27.2352C18.8024 24.8942 19.7041 22.554 20.6085 20.2145C21.6806 17.4276 22.7548 14.6401 23.8313 11.852C23.8667 11.7598 23.9119 11.6699 23.9529 11.5648L32.2124 11.5033L32.2133 11.6225Z" fill="#007BFF"/>
                                 <path d="M12.4112 0.155991C11.9547 1.36919 11.4993 2.58319 11.045 3.79797C10.4019 5.4879 9.75875 7.17543 9.12139 8.86692C9.0579 9.03615 8.98965 9.12143 8.78291 9.12217C6.19543 9.13423 3.60803 9.15668 1.02059 9.17434C0.938558 9.17495 0.861354 9.16432 0.76695 9.15703C0.913367 8.27242 1.26916 7.43322 1.80612 6.70596C2.98025 5.14804 4.16097 3.59327 5.37966 2.06701C6.20266 1.03397 7.32117 0.441802 8.647 0.238388C8.71629 0.223688 8.78463 0.20502 8.85167 0.18248L12.4112 0.155991Z" fill="#007BFF"/>
                                <path d="M23.8945 0.0707396C24.3368 0.183417 24.7887 0.26723 25.2181 0.414394C26.1231 0.722693 26.9135 1.28675 27.4885 2.03465C28.6835 3.56561 29.8714 5.10302 31.0523 6.64687C31.5745 7.32974 31.9419 8.11294 32.1303 8.94463L31.7808 8.94723C29.2746 8.96588 26.7683 8.98053 24.2622 9.00798C24.0226 9.00976 23.9114 8.95061 23.8227 8.72013C22.709 5.84173 21.5875 2.96713 20.458 0.0963135L23.8945 0.0707396Z" fill="#007BFF"/>
                                <path d="M17.6933 0.116847C17.7639 0.332263 17.8255 0.551745 17.9076 0.763877C18.939 3.40668 19.9715 6.04868 21.005 8.68987C21.0436 8.78876 21.0706 8.89253 21.1093 9.01301L11.8285 9.08207L15.2363 0.135132L17.6933 0.116847Z" fill="#007BFF"/>
                                <path d="M16.5484 23.2929L11.8584 11.6749L21.1285 11.6059C19.6221 15.5094 18.1195 19.4062 16.6207 23.2963L16.5484 23.2929Z" fill="#007BFF"/>
                             </svg>
                            @endif
                           </span>
                           <h4>{{ $package->name }}</h4>
                           <p>{{ $package->description }}</p>
                      </div>
                      <div class="card-body">
                        <div class="Eprice">
                           <h3>{{$package->price}}</h3>
                           <p>/{{$package->interval}}</p>
                        </div>
                        <ul class="packageFeatures">
                         @php $service_list = json_decode($package->services); @endphp
                            @foreach ($service_list as $service)
                           <li>
                              <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M10.3296 20.7221L0.560238 12.1574L9.30906 15.3444L22.8701 0.975588L10.3296 20.7221Z" fill="#47CE85"/>
                              </svg>
                              {{$service}}
                           </li>
                           @endforeach

                        </ul>
                           @if(auth()->user() && auth()->user()->role == 'admin')
                               <a href="javascript:;"  onclick="purchase_package('<?= $package->id ?>')" class="packageSubs_btn">{{ get_phrase('Enroll Now') }}</a>
                           @else
                                <a href="{{ route('paymentForSubscription',['package_id'=> $package->id]) }}" class="packageSubs_btn">{{ get_phrase('Enroll Now') }}</a>
                           @endif
                     </div>
                 </div>
              </div>
              @endforeach 
           </div>
      </div>
   </section>
   <!-- Pricing Plan  Area End   -->
   <!-- Faq   Area Start    -->
   <section class="faq-area">
      <div class="container">
         <div class="row">
            <div class="section-intro">
               <h4>{{get_frontend_settings('faq_title')}}</h4>
            </div>
            <div class="col-lg-12">
                 <div class="accordion_antry">
                     <div class="accordion" id="accordionExample">
                        @foreach($faqs as $key=>$faq)
                        <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne{{$key}}">
                                 <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">{{$faq->title}}</button>
                              </h2>
                              <div id="collapseOne{{$key}}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
                                 <div class="accordion-body">
                                 <p>{{$faq->description}}</p>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                    </div>
                 </div>    
            </div>
         </div>
      </div>
   </section>
   <!-- FAQ  Area End   -->




@endsection

<script type="text/javascript">
	"use strict";
	function purchase_package(package_id) {
		// body...
      toastr.error("You do not have access to enroll.");
	}
</script>