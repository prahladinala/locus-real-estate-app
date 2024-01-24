@extends('install.index')
  
@section('content')
<div class="row justify-content-center ins-two">
  <div class="col-md-6">
    <div class="card card_entry new_form">
      <div class="card-body px-4">
        <div class="panel panel-default ins-three" data-collapsed="0">
          <!-- panel body -->
          <div class="panel-body ins-four">
            <center>
              <i class="entypo-thumbs-up ins-five"></i>
              <h3>{{ __('Congratulations!! The installation was successfull') }}</h3>
            </center>
            <br>
            <center>
              <strong>
                {{ __("Before you start using your application, make it yours. Set your application name and title, admin login email and
                password. Remember the login credentials which you will need later on for signing into your account. After this step,
                you will be redirected to application's login page.") }}
              </strong>
            </center>
            <br>
            <div class="row">
              <div class="col-md-12">
                <form class="form-horizontal form-groups" method="post"
                  action="{{ route('finalizing_setup') }}">
                  @csrf 
                  <div class="form-group mb-2">
            				<label class="col-sm-3 control-label">{{ __('System Name') }}</label>
            				
            					<input type="text" class="form-control eForm-control" name="system_name"
                        required autofocus>
                    <div class="mt-2 f-14">
                      {{ __('The name of your application') }}
                    </div>
            			</div>
                  <hr>
                  <div class="form-group mb-2">
            				<label class="col-sm-3 control-label">{{ __('Your name') }}</label>
            				
            					<input type="text" class="form-control eForm-control" name="admin_name" placeholder="Ex: John Doe" required>
                    <div  class="mt-2 f-14">
                      {{ __('Full name of Administrator') }}
                    </div>
            			</div>
                  <hr>
                  <div class="form-group mb-2">
            				<label class="col-sm-3 control-label">{{ __('Your Email') }}</label>
            				
            					<input type="email" class="form-control eForm-control" name="admin_email" placeholder="Ex: john@example.com" required>
                    <div  class="mt-2 f-14">
                      {{ __('Email address for administrator login') }}
                    </div>
            			</div>
                  <hr>
                  <div class="form-group mb-2">
            				<label class="col-sm-3 control-label">{{ __('Password') }}</label>
            				
            					<input type="password" class="form-control eForm-control" name="admin_password" placeholder=""
                        required>
                    <div  class="mt-2 f-14">
                      {{ __('Admin login password') }}
                    </div>
            			</div>
                  <hr>
                  <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">{{ __('Your Phone') }}</label>
                    
                      <input type="number" class="form-control eForm-control" name="admin_phone" placeholder="Ex: +9020040060" required>
                    <div  class="mt-2 f-14">
                      {{ __('Phone of Administrator') }}
                    </div>
                  </div>
                  <hr>
                  <div class="form-group mb-2">
            				<label class="col-sm-3 control-label">{{ __('TimeZone') }}</label>
            				
                      <select class="form-select select_con eForm-select eChoice-multiple-with-remove" id="timezone" name="timezone">
                        <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
                        <?php foreach ($tzlist as $tz): ?>
                          <option value="{{ $tz  }}" {{ $tz == 'Asia/Dhaka' ?  'selected':'' }}>{{ $tz  }}</option>
                        <?php endforeach; ?>
                      </select>
                    <div  class="mt-2 f-14">
                      {{ __('Choose System TimeZone') }}
                    </div>
            			</div>
                  <hr>
                  <div class="form-group mb-2">
            				<label class="col-sm-3 control-label"></label>
            				<div class="col-sm-7">
            					<button type="submit" class="btn btn-primary btn_01">{{ __('Set me up') }}</button>
            				</div>
            			</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection