<style type="text/css">
    .dl-plan-coupon {
        max-width: 21.75rem !important;
        background-color: #fff;
        border-radius: 0.3125rem;
    }
</style>

<div class="paymentDetails-wrap">
    <div class="row">
        <div class="col-lg-7">
            <div class="dl_column_content d-flex flex-column rg-30">
                <!-- Basic Info -->
                <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
                    <div class="d-flex justify-content-between align-items-center flex-wrap g-12 mb-16">
                        <div class="tableTitle-3">
                            <h4 class="fz-17-sb-black pb-8">
                                {{ get_phrase('Enter your payment details') }}
                            </h4>
                        </div>
                        <!-- Button -->
                        <a href="javascript:;" onclick="goto_packages()" class="back-listing cg-10"><i class="fa-solid fa-arrow-left"></i> {{ get_phrase('Go Back') }}</a>
                    </div>
                    <!-- Title -->
                    <div class="tableTitle-2 pb-30">
                        <p class="fz-15-r-gray">
                            {{ get_phrase('Billing and account information will be updated if this information is edited.') }}
                        </p>
                    </div>
                    <!-- Form -->
                    <form id="update_form" action="{{ route('updateUserInfo') }}" method="post">
                        @csrf
                        <div class="dl_column_form d-flex flex-column rg-22">
                            <!-- Name -->
                            <div class="row justify-content-between align-items-center">
                                <label for="inputFullName" class="col-sm-3 col-eForm-label">{{ get_phrase('Full name') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Your name" class="form-control eForm-control2" id="name" name="name" value="{{ $user_details->name }}" />
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="row justify-content-between align-items-center">
                                <label for="inputEmail" class="col-sm-3 col-eForm-label">{{ get_phrase('Email') }}</label>
                                <div class="col-sm-9">
                                    <input type="email" placeholder="example@info.com" class="form-control eForm-control2" id="inputEmail" readonly value="{{ $user_details->email }}" />
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="row justify-content-between align-items-center">
                                <label for="inputAddressLine" class="col-sm-3 col-eForm-label">{{ get_phrase('Address') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="New york, 5th Avenue" class="form-control eForm-control2" id="addressline" name="addressline" value="{{ $address->addressline }}" />
                                </div>
                            </div>



                            <div class="row justify-content-between align-items-center">
                                <label for="countries" class="col-sm-3 col-eForm-label">Country</label>
                                <div class="col-sm-9">
                                    <select id="countries" name="country_code" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                                        <option value="NN">
                                            {{ get_phrase('Select a Country') }}
                                        </option>

                                        @foreach($countries as $key => $country)

                                        <option value="{{ $country->code }}" @if($address->country_code==$country->code) selected @endif>
                                            {{ $country->name }}
                                        </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- State -->
                            <div class="row justify-content-between align-items-center">
                                <label for="inputState" class="col-sm-3 col-eForm-label">{{ get_phrase('State') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="State" class="form-control eForm-control2" id="state" name="state" value="{{ $address->state }}" />
                                </div>
                            </div>
                            <!-- Zip code -->
                            <div class="row justify-content-between align-items-center">
                                <label for="inputZipCode" class="col-sm-3 col-eForm-label">{{ get_phrase('Zip Code') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="26474" class="form-control eForm-control2" id="zipcode" name="zipcode" value="{{ $address->zipcode }}" />
                                </div>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                            <a href="javascript:{}" onclick="document.getElementById('update_form').submit();" class="eBtn saveChanges-btn">{{ get_phrase('Update') }}</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Sidebar -->
            <div class="dl-plan-coupon boxShadow-06">
                <!-- Dropdown -->
                <div class="plan-select d-flex justify-content-between align-items-center pt-30 pb-20 px-30 g-16">
                    <div class="logo">
                        <img src="{{ asset('public/assets/global/images/logo/logo.png') }}" alt="" />
                    </div>
                </div>
                <!-- Sub-total -->
                <ul class="sub-total">
                    <li class="d-flex justify-content-between align-items-center">
                        <p>{{ $current_package->name.' '.get_phrase('Plan') }}</p>
                        <p>{{ currency($current_package->price) }}</p>
                    </li>
                </ul>
                <!-- Total -->
                <div class="total-plan px-30 py-13 bg-green d-flex justify-content-between align-items-center">
                    <p>{{ get_phrase('TOTAL') }}</p>
                    <p>{{ currency($current_package->price) }}</p>
                </div>
            </div>
            <br>
            <!-- Payment Information -->
            <div class="dl_column_item pt-22 px-30 pb-25 boxShadow-06 bg-white">
                <!-- Title -->
                <div class="tableTitle-2">
                    <h4 class="fz-17-sb-black pb-8">
                        {{ get_phrase('Payment Information') }}
                    </h4>
                </div>
                  <!-- Button -->
                  <div class="dl_form_btn d-flex flex-wrap justify-content-start g-16 pt-30 pb-16">

                    @if($paypal->status==1)

                    <a href="javascript:{}" onclick="document.getElementById('paypal_form').submit();" class="eBtn pay-card">
                        <img src=" {{ asset('public/assets/customer/images/Paypal-Logo.png') }}" alt="" />
                    </a>

                    @endif
                    @if($stripe->status==1)
                    <a href="javascript:{}" onclick="document.getElementById('stripe_form').submit();" class="eBtn pay-card">
                        <img src=" {{ asset('public/assets/customer/images/stripe-logo.png') }}" alt="" />
                    </a>
                    @endif
                </div>
                <!-- Conditions text -->
                <h4 class="fz-12-r-gray">
                    {{ get_phrase('By clicking "Start now" you agree to the') }}
                    <a href="#" class="text-green"><ins>{{ get_phrase('terms and conditions') }}</ins></a>
                </h4>
            </div>
        </div>
    </div>


    <form id="paypal_form" action="{{ route('payWithPaypal_ForSubscription',['success_url'=> 'successfullyBecomeAnAgnet','cancle_url' => 'failToBecomeAnAgnet','payment_method'=>'paypal']) }}" method="post" class="paypal-form form">
        @csrf
        <hr class="border mb-4">
        <input type="hidden" name="expense_type" value="Subscription">
        <input type="hidden" name="package_id" value="{{  $current_package->id }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="amount" value="{{ $current_package->price }}">
   </form>

   <form id="stripe_form" action="{{ route('PayWithStripe_ForSubscription',['success_url'=> 'successfullyBecomeAnAgnet','cancle_url' => 'failToBecomeAnAgnet','payment_method'=>'stripe']) }}" method="post" class="stripe-form form">
        @csrf
        <hr class="border mb-4">
        <input type="hidden" name="expense_type" value="Subscription">
        <input type="hidden" name="package_id" value="{{  $current_package->id }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="amount" value="{{ $current_package->price }}">
   </form>


</div>

<script type="text/javascript">
    "use strict";

    $(document).ready(function () {
      $(".eChoice-multiple-without-remove").select2();
    });

</script>
