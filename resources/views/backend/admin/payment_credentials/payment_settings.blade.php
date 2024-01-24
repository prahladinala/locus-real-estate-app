@extends('backend.index')
@section('content')

<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Payment settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('Payment settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="eSection-wrap">
            <div class="title">
                <h3>{{ get_phrase('System Currency'); }}</h3>
            </div>
            <div class="eMain">
                <div class="row">
                    <div class="col-12 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" class="col-12 live-class-settings-form" action="{{ route('admin.update_payment_settings') }}" id="live-class-settings-form">
                                @csrf 

                                <div class="fpb-7">
                                    <label for="global_currency" class="eForm-label">{{ get_phrase('Global Currency'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "global_currency" name="global_currency" required>
                                        <option value="">{{ get_phrase('Select system currency'); }}</option>

                                        @foreach($currencies as $currency)
                                        <option value="{{ $currency['code']; }}"
                                          @if ($global_currency == $currency['code']) selected @endif> {{ $currency['code'];}}
                                        </option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="fpb-7">
                                    <label for="currency_position" class="eForm-label">{{ get_phrase('Currency Position'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove"  id = "currency_position" name="currency_position" required>
                                        <option value="left" @if ($global_currency_position == 'left') selected @endif >  {{  get_phrase('Left'); }}</option>
                                        <option value="right" @if ($global_currency_position == 'right')  selected @endif >  {{   get_phrase('Right'); }}</option>
                                        <option value="left-space" @if ($global_currency_position == 'left-space')  selected @endif >  {{   get_phrase('Left with a space'); }}</option>
                                        <option value="right-space" @if ($global_currency_position == 'right-space') selected @endif> >  {{   get_phrase('Right with a space'); }}</option>
                                      </select>
                                </div>

                                <input type="hidden" id="method" name="method" value="currency">


                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form" onclick="">{{ get_phrase('Update Currency'); }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php 
    $stripeArray = json_decode(get_settings('stripe'), true);
    $paypalArray = json_decode(get_settings('paypal'), true);
@endphp

<div class="row">
    <div class="col-8">
        <div class="eSection-wrap">
            <div class="title">
                <h3>{{ get_phrase('Stripe Settings'); }}</h3>
            </div>
            <div class="eMain">
                <div class="row">
                    <div class="col-12 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" class="col-12 live-class-settings-form" action="{{route('admin.update_stripe_payment')}}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="statuss" class="eForm-label">{{ get_phrase('Active'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "statuss" name="status" required>
                                       <option value="0" @if ($stripeArray['status'] == 0) selected @endif>No</option>
                                       <option value="1" @if ($stripeArray['status'] == 1) selected @endif>Yes</option>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="mods" class="eForm-label">{{ get_phrase('Mode'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "modes" name="mode" required>
                                       <option value="test"  @if ($stripeArray['mode'] == 'test') selected @endif>Test</option>
                                       <option value="live" @if ($stripeArray['mode'] == 'live') selected @endif>Live</option>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="test_key" class="eForm-label">{{ get_phrase('public key'); }}</label>
                                    <input type="text" class="form-control eForm-control" id="test_key" name = "test_key" value="{{$stripeArray['test_key']}}" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="test_secret_key" class="eForm-label">{{ get_phrase('secret key'); }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{$stripeArray['test_secret_key']}}" id="test_secret_key" name = "test_secret_key" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="public_live_key" class="eForm-label">{{ get_phrase('public live key'); }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{$stripeArray['public_live_key']}}" id="public_live_key" name = "public_live_key" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="secret_live_key" class="eForm-label">{{ get_phrase('secret live key'); }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{$stripeArray['secret_live_key']}}" id="secret_live_key" name = "secret_live_key" required>
                                </div>
                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form" onclick="">{{ get_phrase('Save Changes'); }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <div class="eSection-wrap">
            <div class="title">
                <h3>{{ get_phrase('Paypal Settings'); }}</h3>
            </div>
            <div class="eMain">
                <div class="row">
                    <div class="col-12 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" class="col-12 live-class-settings-form" action="{{route('admin.update_paypal_payment')}}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="status" class="eForm-label">{{ get_phrase('Active'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "status" name="status" required>
                                    <option value="0" @if ($paypalArray['status'] == 0) selected @endif>No</option>
                                       <option value="1" @if ($paypalArray['status'] == 1) selected @endif>Yes</option>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="mode" class="eForm-label">{{ get_phrase('Mode'); }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "mode" name="mode" required>
                                        <option value="test"  @if ($paypalArray['mode'] == 'test') selected @endif>Test</option>
                                       <option value="live" @if ($paypalArray['mode'] == 'live') selected @endif>Live</option>
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="test_client_id" class="eForm-label">{{ get_phrase('public key'); }}</label>
                                    <input type="text" class="form-control eForm-control" id="test_client_id" name = "test_client_id" value="{{$paypalArray['test_client_id']}}" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="test_secret_key" class="eForm-label">{{ get_phrase('secret key'); }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{$paypalArray['test_secret_key']}}" id="test_secret_key" name = "test_secret_key" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="live_client_id" class="eForm-label">{{ get_phrase('public live key'); }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{$paypalArray['live_client_id']}}" id="live_client_id" name = "live_client_id" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="live_secret_key" class="eForm-label">{{ get_phrase('secret live key'); }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{$paypalArray['live_secret_key']}}" id="live_secret_key" name = "live_secret_key" required>
                                </div>
                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form" onclick="">{{ get_phrase('Save Changes'); }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('js')
<script type="text/javascript">

    "use strict";

    $(document).ready(function () {
      $(".eChoice-multiple-with-remove").select2();
    });
</script>

@endsection

