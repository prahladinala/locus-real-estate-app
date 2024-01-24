<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.customer.update',['id'=>$user->id]) }}">
        @csrf
        <div class="form-row">
            <div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Name') }}</label>
                <input type="text" class="form-control eForm-control" id="name" name = "name" value="{{ $user->name }}" placeholder="Enter Name" aria-label="Enter Name" required>
            </div>

            @php
            $info = json_decode($user->address)
            @endphp

            <div class="fpb-7">
                <label for="country_code" class="eForm-label">{{ get_phrase('Country code') }}</label>
                <input type="text" class="form-control eForm-control" id="country_code" name="country_code" value="{{ isset($info->country_code) ? $info->country_code: ''  }}" placeholder="Enter County Code" aria-label="Enter County Code" required />
            </div>

            <div class="fpb-7">
                <label for="state" class="eForm-label">{{ get_phrase('State') }}</label>
                <input type="text" class="form-control eForm-control" id="state" name="state" value="{{ isset($info->state) ? $info->state: ''  }}" placeholder="Enter State" aria-label="Enter State" />
            </div>

            <div class="fpb-7">
                <label for="addressline" class="eForm-label">{{ get_phrase('Address Line') }}</label>
                <input type="text" class="form-control eForm-control"  id="addressline" name="addressline" value="{{ isset($info->addressline) ? $info->addressline: ''  }}" placeholder="Enter Address Line"  aria-label="Enter Address Line" required />
            </div>

            <div class="fpb-7">
                <label for="zipcode" class="eForm-label">{{ get_phrase('Zip Code') }}</label>
                <input type="text" class="form-control eForm-control" id="zipcode" name="zipcode" value="{{ isset($info->zipcode) ? $info->zipcode: ''  }}" placeholder="Enter Zip Code" aria-label="Enter Zip Code" />
            </div>


            <div class="fpb-7">
                <label for="phone" class="eForm-label">{{ get_phrase('Phone number') }}</label>
                <input type="number" class="form-control eForm-control" id="phone" name = "phone" value="{{ $user->phone }}" placeholder="Enter Phone" aria-label="Enter Phone" required>
            </div>


            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('update') }}</button>
            </div>
        </div>
    </form>
</div>

