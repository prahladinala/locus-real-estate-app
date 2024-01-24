<style>
 .flag i{
    font-size:31px;
    color: #007BFF;
 }
 .control_position .form-check {
	margin-bottom: 8px;
}
.control_position .dash{
    margin-bottom: 2px;
}
</style>

<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.package.update', ['id' => $package->id]) }}">
         @csrf
        <div class="form-row">
            <div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Name') }}</label>
                <input type="text" class="form-control eForm-control" value="{{ $package->name }}" id="name" name = "name" placeholder="Provide package name" required>
            </div>
            <div class="control">
                 <label for="name" class="eForm-label">{{ get_phrase('Chose Package Icon') }}</label>
                <div class="fpb-7 control_position">
                  <div class="form-check dash">
                        <label class="form-check-label flag" for="one">
                            <i class="bi bi-flag-fill"></i>
                         </label>
                        
                         <input class="form-check-input" type="radio" name="icon_type" id="one" value="{{$package->icon_type}}" {{ ($package->icon_type=="1")? "checked" : "" }}>
                    </div>
                  <div class="form-check">
                       <label class="form-check-label" for="two">
                        <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M32.2388 5.20097L32.444 19.8006C32.3949 20.0541 32.3515 20.3084 32.2957 20.5604C31.6257 23.5679 29.0729 25.609 25.892 25.6701C24.0232 25.7063 22.1542 25.7201 20.2853 25.7451C16.0042 25.8023 11.7235 25.8877 7.44175 25.904C3.82701 25.9179 0.944267 23.1161 0.886595 19.5981C0.812865 15.0937 0.74956 10.5889 0.696679 6.08374C0.692461 5.83411 0.722469 5.58504 0.785908 5.34316C1.30349 3.4416 3.66842 2.79661 5.15169 4.16082C6.23617 5.15705 7.28976 6.18179 8.35799 7.1935C8.43561 7.26712 8.51811 7.33666 8.63235 7.4379C8.73117 7.32177 8.80392 7.22446 8.88917 7.13822C10.7221 5.30042 12.5554 3.46341 14.3889 1.62721C15.6248 0.388795 17.1611 0.369849 18.433 1.57311L24.1081 6.95631C24.1915 7.03547 24.2824 7.11454 24.3775 7.20077C24.4653 7.11932 24.5327 7.0574 24.5961 6.99393C25.6282 5.96136 26.6544 4.92324 27.6915 3.89622C28.4103 3.18415 29.2768 2.91164 30.2776 3.1696C31.2785 3.42756 31.9094 4.08626 32.1768 5.06693C32.193 5.11346 32.2138 5.15835 32.2388 5.20097Z" fill="#007BFF"/>
                         </svg>
                        </label>
                         <input class="form-check-input" type="radio" name="icon_type" id="two" value="{{$package->icon_type}}" {{ ($package->icon_type=="2")? "checked" : "" }}>
                    </div>
                  <div class="form-check">
                       <label class="form-check-label" for="three">
                         <svg width="33" height="31" viewBox="0 0 33 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32.2133 11.6225C31.9734 12.6241 31.5269 13.5675 30.901 14.3955C29.4141 16.35 27.9495 18.3204 26.4758 20.2844L19.8641 29.1001C18.1939 31.3271 15.0691 31.3416 13.3831 29.1331C9.5828 24.1457 5.78087 19.1593 1.97731 14.1741C1.42694 13.4554 1.0381 12.6318 0.836094 11.7568L9.04875 11.6957C9.57021 12.9843 10.0934 14.2782 10.6182 15.5774L15.3284 27.2559C15.663 28.0868 16.4156 28.4331 17.1588 28.1037C17.5504 27.9296 17.758 27.6137 17.9035 27.2352C18.8024 24.8942 19.7041 22.554 20.6085 20.2145C21.6806 17.4276 22.7548 14.6401 23.8313 11.852C23.8667 11.7598 23.9119 11.6699 23.9529 11.5648L32.2124 11.5033L32.2133 11.6225Z" fill="#007BFF"/>
                           <path d="M12.4112 0.155991C11.9547 1.36919 11.4993 2.58319 11.045 3.79797C10.4019 5.4879 9.75875 7.17543 9.12139 8.86692C9.0579 9.03615 8.98965 9.12143 8.78291 9.12217C6.19543 9.13423 3.60803 9.15668 1.02059 9.17434C0.938558 9.17495 0.861354 9.16432 0.76695 9.15703C0.913367 8.27242 1.26916 7.43322 1.80612 6.70596C2.98025 5.14804 4.16097 3.59327 5.37966 2.06701C6.20266 1.03397 7.32117 0.441802 8.647 0.238388C8.71629 0.223688 8.78463 0.20502 8.85167 0.18248L12.4112 0.155991Z" fill="#007BFF"/>
                           <path d="M23.8945 0.0707396C24.3368 0.183417 24.7887 0.26723 25.2181 0.414394C26.1231 0.722693 26.9135 1.28675 27.4885 2.03465C28.6835 3.56561 29.8714 5.10302 31.0523 6.64687C31.5745 7.32974 31.9419 8.11294 32.1303 8.94463L31.7808 8.94723C29.2746 8.96588 26.7683 8.98053 24.2622 9.00798C24.0226 9.00976 23.9114 8.95061 23.8227 8.72013C22.709 5.84173 21.5875 2.96713 20.458 0.0963135L23.8945 0.0707396Z" fill="#007BFF"/>
                           <path d="M17.6933 0.116847C17.7639 0.332263 17.8255 0.551745 17.9076 0.763877C18.939 3.40668 19.9715 6.04868 21.005 8.68987C21.0436 8.78876 21.0706 8.89253 21.1093 9.01301L11.8285 9.08207L15.2363 0.135132L17.6933 0.116847Z" fill="#007BFF"/>
                           <path d="M16.5484 23.2929L11.8584 11.6749L21.1285 11.6059C19.6221 15.5094 18.1195 19.4062 16.6207 23.2963L16.5484 23.2929Z" fill="#007BFF"/>
                           </svg>
                        </label>
                         <input class="form-check-input" type="radio" name="icon_type" id="three" value="{{$package->icon_type}}" {{ ($package->icon_type=="3")? "checked" : "" }}>
                    </div>
                </div>
            </div>  
            <div class="fpb-7">
                <label for="price" class="eForm-label">{{ get_phrase('Package price') }}</label>
                <input type="number" min="0" class="form-control eForm-control" value="{{ $package->price }}" id="price" name = "price" placeholder="Provide package price" required>
            </div>
            <div class="fpb-7">
                <label for="package_type" class="eForm-label">{{ get_phrase('Package Type') }}</label>
                <select name="package_type" id="package_type" class="form-select eForm-select eChoice-multiple-with-remove">
                    <option value="">{{ get_phrase('Select a package type') }}</option>
                    <option value="paid" {{ $package->package_type == 'paid' ?  'selected':'' }} >{{ get_phrase('Paid') }}</option>
                    <option value="trail" {{ $package->package_type == 'trail' ?  'selected':'' }}>{{ get_phrase('Trail') }}</option>
                </select>
            </div>
            <div class="fpb-7">
                <label for="interval" class="eForm-label">{{ get_phrase('Interval') }}</label>
                <select name="interval" id="interval" class="form-select eForm-select eChoice-multiple-with-remove">
                    <option value="">{{ get_phrase('Select a interval') }}</option>
                    <option value="Days" {{ $package->interval == 'Days' ?  'selected':'' }} >{{ get_phrase('Days') }}</option>
                    <option value="Monthly" {{ $package->interval == 'Monthly' ?  'selected':'' }} >{{ get_phrase('Monthly') }}</option>
                    <option value="Yearly" {{ $package->interval == 'Yearly' ?  'selected':'' }} >{{ get_phrase('Yearly') }}</option>
                </select>
            </div>
            <div class="fpb-7">
                <label for="duration" class="eForm-label">{{ get_phrase('Interval Preiod') }}</label>
                <input type="number" min="0" class="form-control eForm-control" id="duration" name = "duration"  value="{{ $package->duration }}" placeholder="Provide number of interval " required>
            </div>

            <div class="fpb-7">
                <label for="status" class="eForm-label">{{ get_phrase('Interval') }}</label>
                <select name="status" id="status" class="form-select eForm-select eChoice-multiple-with-remove">
                    <option value="">{{ get_phrase('Select a status') }}</option>
                    <option value="1" {{ $package->status == '1' ?  'selected':'' }} >{{ get_phrase('Active') }}</option>
                    <option value="0" {{ $package->status == '0' ?  'selected':'' }} >{{ get_phrase('Deactive') }}</option>
                </select>
            </div>
            <div class="fpb-7">
                <label for="description" class="eForm-label">{{ get_phrase('Description') }}</label>
                <textarea class="form-control eForm-control" id="description" name = "description" rows="2" placeholder="Provide a short description" required>{{ $package->description }}</textarea>
            </div>
            <div class="fpb-7">
                    <label class="eForm-label"> {{ get_phrase("Services")}} </label>
                    <div class="row">
                     @php $service_list = json_decode($package->services); @endphp
                      <div class="col-sm-10" id="inputContainer">
                        @foreach ($service_list as $service)
                            <input type="text" name="services[]" class="form-control eForm-control mt-2" value="{{$service}}">
                        @endforeach
                      </div>
                        <div class="col-sm-2 p-0">
                            <a href="javascript:void(0)" onclick="appendInput()" class="btn mb-1 mt-1 btn-primary"> <i class="fas fa-plus"></i></a>
                            <a href="javascript:void(0)" onclick="removeInput()" class="btn btn-danger"> <i class="fas fa-minus"></i></a>
                        </div>
                    </div>
             </div>
            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Update package') }}</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

    "use strict";

    $(document).ready(function () {
      $(".eChoice-multiple-with-remove").select2();
    });

    function appendInput() {
      var container = document.getElementById('inputContainer');
      var newInput = document.createElement('input');
      newInput.setAttribute('type', 'text');
      newInput.setAttribute('placeholder', '{{get_phrase('Write service')}}');
      newInput.setAttribute('class', 'eForm-control mt-2');
      newInput.setAttribute('name', 'services[]');
      container.appendChild(newInput);
    }

    function removeInput() {
      var container = document.getElementById('inputContainer');
      var inputs = container.getElementsByTagName('input');
      if (inputs.length > 0) {
        container.removeChild(inputs[inputs.length - 1]);
      }
    }
</script>