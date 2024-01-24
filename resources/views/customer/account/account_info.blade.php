@extends('customer.index')
@section('customerRightPanel')




<div class="col-lg-9">
    <div class="dl_column_content d-flex flex-column rg-30">
        <!-- Basic Info -->
        <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
            <!-- Title -->
            <div class="tableTitle-1">
                <h4 class="fz-17-sb-black pb-22 mb-30 bd-b-1">
                {{ get_phrase('Basic Info') }}
                </h4>
            </div>
            <!-- Form -->
            <form action="{{ route('customerAccountUpdate') }}" enctype="multipart/form-data" method="post">
                @csrf
            <div class="dl_column_form d-flex flex-column rg-22">
                <!-- Name -->
                <div class="row justify-content-between align-items-center">
                    <label for="name"  class="col-sm-2 col-eForm-label">{{ get_phrase('Full name') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Your name" class="form-control eForm-control2" id="name" name="name" value="{{ $user->name }}" />
                    </div>
                </div>
                <!-- Email -->
                <div class="row justify-content-between align-items-center">
                    <label for="email" class="col-sm-2 col-eForm-label">{{ get_phrase('Email') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="email" placeholder="example@info.com" class="form-control eForm-control2" id="email" name="email" value="{{ $user->email }}" readonly/>
                    </div>
                </div>
                <!-- Phone -->
                <div class="row justify-content-between align-items-center">
                    <label for="phone"  class="col-sm-2 col-eForm-label">{{ get_phrase('Phone') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="number" placeholder="+88 (00) 1234 56789" class="form-control eForm-control2" id="phone" name="phone" value="{{ $user->phone }}"/>
                    </div>
                </div>
                <!-- Facebook -->
                <div class="row justify-content-between align-items-center">
                    <label for="facebook" class="col-sm-2 col-eForm-label">{{ get_phrase('Facebook') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Write down facebook url" class="form-control eForm-control2" id="facebook" name="facebook" value="{{ $social->facebook ??"" }}"/>
                    </div>
                </div>
                <!-- Twitter -->
                <div class="row justify-content-between align-items-center">
                    <label for="twitter" class="col-sm-2 col-eForm-label">{{ get_phrase('Twitter') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Write down twitter url" class="form-control eForm-control2" id="twitter" name="twitter" value="{{ $social->twitter ??"" }}"/>
                    </div>
                </div>
                <!-- Linkedin -->
                <div class="row justify-content-between align-items-center">
                    <label for="linkedin" class="col-sm-2 col-eForm-label">{{ get_phrase('Linkedin') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Write down linkedin url" class="form-control eForm-control2" id="linkedin" name="linkedin" value="{{ $social->linkedin ??"" }}"/>
                    </div>
                </div>
                @if(auth()->user()->is_agent==1)
                <!-- Website Url -->
                <div class="row justify-content-between align-items-center">
                    <label for="website" class="col-sm-2 col-eForm-label">{{ get_phrase('Website') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="Write down Website url" class="form-control eForm-control2" id="website" name="website" value="{{ $user->website }}"/>
                    </div>
                </div>
                @else
                   <input type="hidden" placeholder="Write down Website url" class="form-control eForm-control2" id="website" name="website" value=" "/>
                @endif
                <!-- Gender -->
                <div class="row justify-content-between align-items-center">
                    <label class="col-sm-2 col-eForm-label">{{ get_phrase('Gender') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <div class="dl-gender-wrap d-flex justify-content-between">
                            <div class="gender-item">
                                <div class="form-check">
                                    <input type="radio" name="gender" class="form-check-input dl-radio" value="male" id="male" @if($user->gender=='male') checked @endif /><label for="male" class="form-check-label">{{ get_phrase('Male') }}</label>
                                </div>
                            </div>
                            <div class="gender-item">
                                <div class="form-check">
                                    <input type="radio" name="gender" class="form-check-input dl-radio" value="female" id="female" @if($user->gender=='female') checked @endif /><label for="female" class="form-check-label">{{ get_phrase('Female') }}</label>
                                </div>
                            </div>
                            <div class="gender-item">
                                <div class="form-check">
                                    <input type="radio" name="gender" class="form-check-input dl-radio" value="other" id="other" @if($user->gender=='other') checked @endif  /><label for="other" class="form-check-label">{{ get_phrase('Other') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bio -->
                <input type="hidden"  name="type" value="info">
                <div class="row justify-content-between align-items-start">
                    <label for="bio" class="col-sm-2 col-eForm-label">{{ get_phrase('Bio') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <textarea class="form-control eForm-control2" id="bio" name="about" placeholder="Type your keyword"> {{ $user->about }}</textarea>
                    </div>
                </div>
                <!-- Profile Photo -->
                <div class="row justify-content-between align-items-start">
                    <label class="col-sm-2 col-eForm-label">{{ get_phrase('Profile Photo') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="hidden" class="form-control" name="old_photo" value="{{ auth()->user()->image }}"/>
                        <input type="file" class="form-control eForm-control-file" name="photo" accept="image/*" />
                    </div>
                </div>
                @if(auth()->user()->is_agent==1)
                <!-- Agent Company Photo -->
                 <div class="row justify-content-between align-items-start">
                    <label class="col-sm-2 col-eForm-label">{{ get_phrase('Company Logo (160 X 160)') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="hidden" class="form-control" name="old_company_image" value="{{$user->company}}"/>
                        <input type="file" class="form-control eForm-control-file" name="company_image" accept="image/*" />
                    </div>
                </div>
                @endif
            </div>
            <!-- Button -->
            <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                <button  type="submit" class="eBtn saveChanges-btn">{{ get_phrase('Save Changes') }}</button>
            </div>
            </form>
        </div>
        <!-- Address -->
        <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
            <!-- Title -->
            <div class="tableTitle-1">
                <h4 class="fz-17-sb-black pb-22 mb-30 bd-b-1">{{ get_phrase('Address') }}</h4>
            </div>
            <!-- Form -->
             <form action="{{ route('customerAccountUpdate') }}" method="post">
                @csrf
            <div class="dl_column_form d-flex flex-column rg-22">

                <div class="row justify-content-between align-items-center">
                    <label for="countries" class="col-sm-2 col-eForm-label">{{ get_phrase('Country') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <select id="countries" name="country_code" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                            <option value="NN">
                            {{ get_phrase('Select a Country') }}
                            </option>

                            @foreach($countries as $key => $country)

                            <option value="{{ $country->code }}" @if($address && $address->country_code == $country->code) selected @endif>
                                {{ $country->name }}
                            </option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <input type="hidden" name="type" value="address">
                <!-- State -->
                <div class="row justify-content-between align-items-center">
                    <label for="state" class="col-sm-2 col-eForm-label">State</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="State" class="form-control eForm-control2" id="state" name="state" value="{{ $address->state ?? "" }}" />
                    </div>
                </div>
                <!-- Address line -->
                <div class="row justify-content-between align-items-center">
                    <label for="addressline" class="col-sm-2 col-eForm-label">{{ get_phrase('Address line') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="New york, USA" class="form-control eForm-control2" id="addressline" name="addressline" value="{{ $address->addressline ?? "" }}" />
                    </div>
                </div>
                <!-- Zip code -->
                <div class="row justify-content-between align-items-center">
                    <label for="zipcode" class="col-sm-2 col-eForm-label">{{ get_phrase('Zip Code') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="text" placeholder="26474" class="form-control eForm-control2" id="zipcode"  name="zipcode" value="{{ $address->zipcode ?? "" }}"/>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                <button type="submit" class="eBtn saveChanges-btn">{{ get_phrase('Save Changes') }}</button>
            </div>
             </form>
        </div>
        <!-- Password -->
        <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
            <!-- Title -->
            <div class="tableTitle-1">
                <h4 class="fz-17-sb-black pb-22 mb-30 bd-b-1">{{ get_phrase('Password') }}</h4>
            </div>
            <!-- Form -->
            <form action="{{ route('customerAccountUpdate') }}" method="post">
                @csrf
            <div class="dl_column_form d-flex flex-column rg-22">
                <!-- Old Password -->
                <div class="row justify-content-between align-items-center">
                    <label for="password" class="col-sm-2 col-eForm-label">{{ get_phrase('Old Password') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="password" placeholder="********" class="form-control eForm-control2 eForm-password" id="password" name="password" autocomplete="off" />
                    </div>
                </div>
                <input type="hidden" name="type" value="pass">
                <!-- New Password -->
                <div class="row justify-content-between align-items-center">
                    <label for="newpassword" class="col-sm-2 col-eForm-label">{{ get_phrase('New Password') }}</label>
                    <div class="col-sm-10 col-md-9 col-lg-10">
                        <input type="password" placeholder="********" class="form-control eForm-control2 eForm-password" id="newpassword"  name="newpassword" autocomplete="off" />
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                <button type="submit" class="eBtn saveChanges-btn">{{ get_phrase('Save Changes') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
