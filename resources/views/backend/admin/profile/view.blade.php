@extends('backend.index')

@section('content')
    <!-- Start User Profile area -->
    <div class="user-profile-area custom-prof d-flex flex-wrap">
        <!-- Left side -->
        <div class="user-info d-flex flex-column">
            <div
            class="user-info-basic d-flex flex-column justify-content-center"
            >
                <div class="user-graphic-element-1">
                    <img src="{{ asset('public/assets/backend/images/sprial_1.png') }}" alt="" />
                </div>
                <div class="user-graphic-element-2">
                    <img src="{{ asset('public/assets/backend/images/polygon_1.png') }}" alt="" />
                </div>
                <div class="user-graphic-element-3">
                    <img src="{{ asset('public/assets/backend/images/circle_1.png') }}" alt="" />
                </div>
                <div class="userImg">
                    <img width="100%" src="{{ get_user_image(auth()->user()->id) }}" alt="" />
                </div>
                <div class="userContent text-center">
                    <h4 class="title">{{ auth()->user()->name }}</h4>
                    <p class="info">{{ get_phrase('Admin') }}</p>
                    <p class="user-status-verify">{{ get_phrase('Verified') }}</p>
                </div>
            </div>
            <div class="user-info-edit">
                <div
                    class="user-edit-title d-flex justify-content-between align-items-center"
                >
                    <h3 class="title">{{ get_phrase('Details info') }}</h3>
                </div>
                <div class="user-info-edit-items">
                    <div class="item">
                        <p class="title">{{ get_phrase('Email') }}</p>
                        <p class="info">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="item">
                        <p class="title">{{ get_phrase('Phone Number') }}</p>
                        <p class="info">{{ auth()->user()->phone }}</p>
                    </div>
                    <div class="item">
                        <p class="title">{{ get_phrase('Address') }}</p>
                        @if(auth()->user()->address)
                        <p class="info">
                            <?php $info = json_decode(auth()->user()->address); ?>
                            <strong>{{ get_phrase('Cc') }}: </strong>
                            {{ $info->country_code }}, 
                            <strong>{{ get_phrase('H') }}: </strong>{{ $info->addressline }}, <strong>{{ get_phrase('Zip code') }}: </strong>{{ $info->zipcode }}
                        </p>
                        @endif
                    </div>
                    @if(auth()->user()->social)
                    <?php $social = json_decode(auth()->user()->social); ?>
                    <div class="item">
                        <p class="title">{{ get_phrase('Website') }}</p>
                        <p class="info"><a class="social_link" href="{{ auth()->user()->website }}" target="_blank">{{ auth()->user()->website }}</a></p>
                    </div>
                    <div class="item">
                        <p class="title">{{ get_phrase('Facebook') }}</p>
                        <p class="info"><a class="social_link" href="{{ $social->facebook }}" target="_blank">{{ $social->facebook }}</a></p>
                    </div>
                    <div class="item">
                        <p class="title">{{ get_phrase('Twitter') }}</p>
                        <p class="info"><a class="social_link" href="{{ $social->twitter }}" target="_blank">{{ $social->twitter }}</a></p>
                    </div>
                    <div class="item">
                        <p class="title">{{ get_phrase('Linkedin') }}</p>
                        <p class="info"><a class="social_link" href="{{ $social->linkedin }}" target="_blank">{{ $social->linkedin }}</a></p>
                    </div>
                    <div class="item">
                        <p class="title">{{ get_phrase('About') }}</p>
                        <p class="info">{{ auth()->user()->about }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Right side -->
        <div class="user-details-info">
            
            <!-- Tab content -->
            <div class="tab-content eNav-Tabs-content" id="myTabContent">
                <div  class="tab-pane fade show active"  id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                    <div class="eForm-layouts">
                        <form action="{{route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                            @CSRF
                            
                            <div class="fpb-7">
                                <label for="eInputName" class="eForm-label">{{ get_phrase('Name') }}</label>
                                <input type="text" class="form-control eForm-control" id="eInputName" name="name" value="{{ auth()->user()->name }}"  placeholder="Your Name" aria-label="Your Name"/>
                            </div>
                            <div class="fpb-7">
                                <label for="eInputEmail" class="eForm-label">{{ get_phrase('Email') }}</label>
                                <input type="email" class="form-control eForm-control" id="eInputEmail" name="email" value="{{ auth()->user()->email }}" placeholder="example@email.com" aria-label="example@email.com"/>
                            </div>

                            <div class="fpb-7">
                                <label for="eGenderList" class="eForm-label">{{ get_phrase('Gender') }}</label>
                                <select name="gender" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search...">
                                    <option value="Male" @php strtolower(auth()->user()->gender) == 'male' ? 'selected':''; @endphp>{{ get_phrase('Male') }}</option>
                                    <option value="Female" @php strtolower(auth()->user()->gender) == 'female' ? 'selected':''; @endphp>{{ get_phrase('Female') }}</option>
                                </select>
                            </div>
                            <div class="fpb-7">
                                <label for="eInputPhone" class="eForm-label">{{ get_phrase('Phone Number') }}</label>
                                <input type="number" class="form-control eForm-control" id="eInputPhone" name="phone" value="{{ auth()->user()->phone }}"placeholder="00 (00) 12345 6789" aria-label="00 (00) 12345 6789"/>
                            </div>

                            <div class="fpb-7">
                                <label for="about" class="eForm-label">{{ get_phrase('About') }}</label>
                                <textarea class="form-control eForm-control" name="about" id="about" cols="5" rows="2" placeholder="Enter About" aria-label="Enter About">{{ auth()->user()->about }}</textarea>
                            </div>


                            <div class="fpb-7">
                                <label for="country_code" class="eForm-label">{{ get_phrase('Country code') }}</label>
                                <input type="text" class="form-control eForm-control" id="country_code" name="country_code" value="{{ isset($info->country_code) ? $info->country_code: ''  }}" placeholder="Enter County Code" aria-label="Enter County Code"/>
                            </div>

                            <div class="fpb-7">
                                <label for="addressline" class="eForm-label">{{ get_phrase('Address Line') }}</label>
                                <input type="text" class="form-control eForm-control" id="addressline" name="addressline" value="{{ isset($info->addressline) ? $info->addressline: ''  }}" placeholder="Enter Address Line" aria-label="Enter Address Line"/>
                            </div>

                            <div class="fpb-7">
                                <label for="zipcode" class="eForm-label">{{ get_phrase('Zip Code') }}</label>
                                <input type="text" class="form-control eForm-control" id="zipcode" name="zipcode" value="{{ isset($info->zipcode) ? $info->zipcode: ''  }}" placeholder="Enter Zip Code" aria-label="Enter Zip Code"/>
                            </div>

                            <div class="fpb-7">
                                <label for="website" class="eForm-label">{{ get_phrase('Website') }}</label>
                                <input type="text" class="form-control eForm-control" id="website" name="website" value="{{ auth()->user()->website }}" placeholder="Enter website link"/>
                            </div>

                            <div class="fpb-7">
                                <label for="facebook" class="eForm-label">{{ get_phrase('Facebook') }}</label>
                                <input type="text" class="form-control eForm-control" id="facebook" name="facebook" value="{{ isset($social->facebook) ? $social->facebook: ''  }}" placeholder="Enter facebook link"/>
                            </div>

                            <div class="fpb-7">
                                <label for="twitter" class="eForm-label">{{ get_phrase('Twitter') }}</label>
                                <input type="text" class="form-control eForm-control" id="twitter" name="twitter" value="{{ isset($social->twitter) ? $social->twitter: ''  }}" placeholder="Enter twitter link"/>
                            </div>

                            <div class="fpb-7">
                                <label for="linkedin" class="eForm-label">{{ get_phrase('Linkedin') }}</label>
                                <input type="text" class="form-control eForm-control" id="linkedin" name="linkedin" value="{{ isset($social->linkedin) ? $social->linkedin: ''  }}" placeholder="Enter linkedin link"/>
                            </div>


                            <div class="fpb-7">
                                <label for="image" class="eForm-label">{{ get_phrase('Photo') }}</label>
                                <input type="hidden" class="form-control" name="old_photo" value="{{ auth()->user()->image }}"/>
                                <input type="file" class="form-control eForm-control-file" name="photo" accept="image/*" />
                            </div>

                            <button type="submit" class="userFormEdit-btn btn">{{ get_phrase('Save Changes') }}</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End User Profile area -->
@endsection