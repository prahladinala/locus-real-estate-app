@extends('customer.index')
@section('customerRightPanel')

<div class="col-lg-9">
  <div class="dl_column_content d-flex flex-column rg-30">
    <!-- Billing Information -->
    <div
      class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white"
    >
      <!-- Title -->
      <div class="tableTitle-2 pb-30">
        <h4 class="fz-17-sb-black pb-8">{{ get_phrase('Billing Information') }}</h4>
        <p class="fz-15-r-gray">
          {{ get_phrase('Lorem Ipsum available but the majority have suffered
          alteration') }}
        </p>
      </div>
      <!-- Form -->
      <form id="update_form" action="{{ route('updateUserInfo') }}" method="post">
        @csrf
        <div class="dl_column_form d-flex flex-column rg-22">
          <!-- Customer Name -->
          <div class="row justify-content-between align-items-center">
            <label
              for="inputCustomerName"
              class="col-sm-2 col-eForm-label"
              >{{ get_phrase('Customer name') }}</label
            >
            <div class="col-sm-10 col-md-9 col-lg-10">
             <input type="text" placeholder="Your name" class="form-control eForm-control2" id="name" name="name" value="{{ $user_details->name }}" />
            </div>
          </div>
          <!-- Billing Email -->
          <div class="row justify-content-between align-items-center">
            <label
              for="inputBillingEmail"
              class="col-sm-2 col-eForm-label"
              >{{ get_phrase('Billing Email') }}</label
            >
            <div class="col-sm-10 col-md-9 col-lg-10">
              <input type="email" placeholder="example@info.com" class="form-control eForm-control2" id="inputEmail" readonly value="{{ $user_details->email }}"/>
            </div>
          </div>
          <!-- Billing Address -->
          <div class="row justify-content-between align-items-center">
            <label
              for="inputBillingAddress"
              class="col-sm-2 col-eForm-label"
              >{{ get_phrase('Address') }}</label
            >
            <div class="col-sm-10 col-md-9 col-lg-10">
              <input type="text" placeholder="New york, 5th Avenue" class="form-control eForm-control2" id="addressline" name="addressline" value="{{ $address->addressline }}" />
            </div>
          </div>
          <!-- Country -->
          <div class="row justify-content-between align-items-center">
            <label for="countries" class="col-sm-2 col-eForm-label"
              >{{ get_phrase('Country') }}</label
            >
            <div class="col-sm-10 col-md-9 col-lg-10">
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
            <label for="inputState" class="col-sm-2 col-eForm-label"
              >{{ get_phrase('State') }}</label
            >
            <div class="col-sm-10 col-md-9 col-lg-10">
              <input type="text" placeholder="State" class="form-control eForm-control2" id="state" name="state" value="{{ $address->state }}"/>
            </div>
          </div>
          <!-- Zip code -->
          <div class="row justify-content-between align-items-center">
            <label for="inputZipCode" class="col-sm-2 col-eForm-label"
              >{{ get_phrase('Zip Code') }}</label
            >
            <div class="col-sm-10 col-md-9 col-lg-10">
              <input type="text" placeholder="26474" class="form-control eForm-control2" id="zipcode"  name="zipcode" value="{{ $address->zipcode }}"/>
            </div>
          </div>
        </div>
        <!-- Button -->
        <div
          class="dl_form_btn d-flex justify-content-end g-20 pt-40"
        >
          <a href="javascript:{}" onclick="document.getElementById('update_form').submit();" class="eBtn saveChanges-btn">{{ get_phrase('Save Changes') }}</a>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection