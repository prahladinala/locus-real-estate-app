<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.customer.create') }}">
        @csrf
        <div class="form-row">
            <div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Name') }}</label>
                <input type="text" class="form-control eForm-control" id="name" name = "name" placeholder="Enter Name" aria-label="Enter Name" required>
            </div>

            <div class="fpb-7">
                <label for="email" class="eForm-label">{{ get_phrase('Email') }}</label>
                <input type="email" class="form-control eForm-control" id="email" name = "email" placeholder="Enter Email" aria-label="Enter Email" required>
            </div>

            <div class="fpb-7">
                <label for="password" class="eForm-label">{{ get_phrase('Password') }}</label>
                <input type="password" class="form-control eForm-control" id="password" name = "password" placeholder="Enter Password" aria-label="Enter Password" required>
            </div>

            <div class="fpb-7">
                <label for="country_code" class="eForm-label">{{ get_phrase('Country code') }}</label>
                <input type="text" class="form-control eForm-control" id="country_code" name="country_code" placeholder="Enter County Code" aria-label="Enter County Code" required />
            </div>

            <div class="fpb-7">
                <label for="state" class="eForm-label">{{ get_phrase('State') }}</label>
                <input type="text" class="form-control eForm-control" id="state" name="state" placeholder="Enter State" aria-label="Enter State" />
            </div>

            <div class="fpb-7">
                <label for="addressline" class="eForm-label">{{ get_phrase('Address Line') }}</label>
                <input type="text" class="form-control eForm-control"  id="addressline" name="addressline" placeholder="Enter Address Line"  aria-label="Enter Address Line" required />
            </div>

            <div class="fpb-7">
                <label for="zipcode" class="eForm-label">{{ get_phrase('Zip Code') }}</label>
                <input type="text" class="form-control eForm-control" id="zipcode" name="zipcode" placeholder="Enter Zip Code" aria-label="Enter Zip Code" />
            </div>


            <div class="fpb-7">
                <label for="phone" class="eForm-label">{{ get_phrase('Phone number') }}</label>
                <input type="number" class="form-control eForm-control" id="phone" name="phone" placeholder="Enter Phone" aria-label="Enter Phone" required>
            </div>


            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Create') }}</button>
            </div>
        </div>
    </form>
</div>

