@extends('customer.index')
@section('customerRightPanel')

<div class="col-lg-9">
    <div class="dl_column_content d-flex flex-column rg-30">
        <!-- Basic Info -->
        <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
            <!-- Title -->
            <div class="tableTitle-1">
                <h4 class="fz-17-sb-black pb-22 mb-30 bd-b-1">
                    {{ get_phrase('Paypal Keys') }}
                </h4>
            </div>
            <!-- Form -->
            <form action="{{ route('agentPaymentSettingsUpdate') }}" method="post">
                @csrf
            <div class="dl_column_form d-flex flex-column rg-22">


                       <!-- Status -->
                <div class="row justify-content-between align-items-center">
                    <label for="paypal_status" class="col-sm-2 col-eForm-label">{{ get_phrase('Status') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <select name="status" id="paypal_status" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                            <option value="1"  @if($paypal['status'] == 1) selected @endif > {{  get_phrase('Active') }}</option>
                            <option value="0" @if($paypal['status'] == 0) selected @endif>{{  get_phrase('Inactive') }}</option>

                        </select>
                    </div>
                </div>
                 <!-- Mode -->
                <div class="row justify-content-between align-items-center">
                    <label for="paypal_mode" class="col-sm-2 col-eForm-label">{{ get_phrase('Mode') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <select name="mode" id="paypal_mode" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                            <option value="live"  @if($paypal['mode'] == 'live') selected @endif > {{  get_phrase('Live') }}</option>
                            <option value="test" @if($paypal['mode'] == 'test') selected @endif>{{  get_phrase('Sandbox') }}</option>

                        </select>
                    </div>
                </div>

                <!-- Client ID (Sandbox)-->
                <div class="row justify-content-between align-items-center">
                    <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Client ID') }} (Sandbox)</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Sandbox Client Id" class="form-control eForm-control2" id="test_client_id" name = "test_client_id" value="{{ $paypal_keys->test_client_id }}" />
                    </div>
                </div>
                     <!-- Sandbox -->
                     <div class="row justify-content-between align-items-center">
                        <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Client Secrect') }} (Sandbox)</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Sandbox Secrect Id" class="form-control eForm-control2" id="test_secret_key" name = "test_secret_key" value="{{ $paypal_keys->test_secret_key }}" />
                        </div>
                    </div>

                         <!-- Sandbox -->
                <div class="row justify-content-between align-items-center">
                    <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Client ID') }} (Live)</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Live Client Id" class="form-control eForm-control2" id="live_client_id" name = "live_client_id" value="{{ $paypal_keys->live_client_id }}" />
                    </div>
                </div>

                     <!-- Sandbox -->
                     <div class="row justify-content-between align-items-center">
                        <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Client Secrect') }} (Live)</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Live Secrect Id" class="form-control eForm-control2" id="live_secret_key" name = "live_secret_key" value="{{ $paypal_keys->live_secret_key }}" />
                        </div>
                    </div>


                <input type="hidden" id="method" name="method" value="paypal">
                <input type="hidden" id="update_id" name="update_id" value="{{ $paypal['id'] }}">



            </div>
            <!-- Button -->
            <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                <button  type="submit" class="eBtn saveChanges-btn">{{ get_phrase('Save Paypal Keys') }}</button>
            </div>
            </form>
        </div>
        <!-- Stripe -->
        <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
            <!-- Title -->
            <div class="tableTitle-1">
                <h4 class="fz-17-sb-black pb-22 mb-30 bd-b-1">{{ get_phrase('Stripe Keys') }}</h4>
            </div>
            <!-- Form -->
             <form action="{{ route('agentPaymentSettingsUpdate') }}" method="post">
                @csrf
                <div class="dl_column_form d-flex flex-column rg-22">


                    <!-- Status -->
             <div class="row justify-content-between align-items-center">
                 <label for="stripe_status" class="col-sm-2 col-eForm-label">{{ get_phrase('Status') }}</label>
                 <div class="col-sm-10 col-md-9 col-lg-10">
                     <select name="status" id="stripe_status" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                         <option value="1"  @if($stripe['status'] == 1) selected @endif > {{  get_phrase('Active') }}</option>
                         <option value="0" @if($stripe['status'] == 0) selected @endif>{{  get_phrase('Inactive') }}</option>

                     </select>
                 </div>
             </div>
              <!-- Mode -->
             <div class="row justify-content-between align-items-center">
                 <label for="stripe_mode" class="col-sm-2 col-eForm-label">{{ get_phrase('Mode') }}</label>
                 <div class="col-sm-10 col-md-9 col-lg-10">
                     <select name="mode" id="stripe_mode" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                         <option value="live"  @if($stripe['mode'] == 'live') selected @endif > {{  get_phrase('Live') }}</option>
                         <option value="test" @if($stripe['mode'] == 'test') selected @endif>{{  get_phrase('Sandbox') }}</option>

                     </select>
                 </div>
             </div>

             <!-- Test Public Key-->
             <div class="row justify-content-between align-items-center">
                 <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Test Public Key') }}</label>
                 <div class="col-sm-10 col-md-9 col-lg-10">
                     <input type="text" placeholder="Test Public Key" class="form-control eForm-control2" id="test_key" name = "test_key" value="{{$stripe_keys->test_key }}" />
                 </div>
             </div>
                  <!-- Sandbox -->
                  <div class="row justify-content-between align-items-center">
                     <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Client Secrect') }} (Sandbox)</label>
                     <div class="col-sm-10 col-md-9 col-lg-10">
                         <input type="text" placeholder="Test Sectect Key" class="form-control eForm-control2" id="test_secret_key" name = "test_secret_key" value="{{ $stripe_keys->test_secret_key }}" />
                     </div>
                 </div>

                      <!-- Sandbox -->
             <div class="row justify-content-between align-items-center">
                 <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Live Public Key') }}</label>
                 <div class="col-sm-10 col-md-9 col-lg-10">
                     <input type="text" placeholder="Live Public Key" class="form-control eForm-control2" id="public_live_key" name = "public_live_key" value="{{ $stripe_keys->public_live_key }}" />
                 </div>
             </div>

                  <!-- Sandbox -->
                  <div class="row justify-content-between align-items-center">
                     <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Live Secrect Key') }}</label>
                     <div class="col-sm-10 col-md-9 col-lg-10">
                         <input type="text"  class="form-control eForm-control2" id="secret_live_key" name = "secret_live_key" placeholder="Live Secrect Key" value="{{ $stripe_keys->secret_live_key }}" />
                     </div>
                 </div>


                 <input type="hidden" id="method" name="method" value="stripe">
                 <input type="hidden" id="update_id" name="update_id" value="{{ $stripe['id'] }}">



         </div>
            <!-- Button -->
            <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                <button type="submit" class="eBtn saveChanges-btn">{{ get_phrase('Save Stripe Keys') }}</button>
            </div>
             </form>
        </div>

    </div>
</div>




@endsection
