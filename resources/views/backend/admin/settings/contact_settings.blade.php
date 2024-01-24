@extends('backend.index')

@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Contact Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('Contact Settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-md-2">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-11 pb-1">
                        <div class="eForm-layouts">
                        	<form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.contact_settings.update') }}">
                                @csrf

                                <div class="fpb-7">
                                    <label for="system_email" class="eForm-label">{{ get_phrase('Email') }}</label>
                                    <input type="system_email" class="form-control eForm-control" value="{{ get_settings('system_email') }}"  id="system_email" name = "system_email" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="phone" class="eForm-label">{{ get_phrase('Phone') }}</label>
                                    <input type="number" class="form-control eForm-control" value="{{ get_settings('phone') }}" id="phone" name = "phone" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="address" class="eForm-label">{{ get_phrase('Address') }}</label>
                                    <textarea class="form-control eForm-control" id="address" name = "address" rows="5" required>{{ get_settings('address') }}</textarea>
                                </div>

                                <div class="fpb-7 pt-2">
                                    <button class="btn-form" type="submit">{{ get_phrase('Save Changes') }}</button>
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