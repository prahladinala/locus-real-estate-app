<style>
  .admin-tInfo {
  font-size: 15px;
  font-weight: 500;
  line-height: 23px;
  color: #797c8b;
}
.eTable-2 {
  > :not(caption) > {
    * > {
      * {
        border-bottom: 1px dashed #dedede;
        padding: 20px 16px !important;
        &:first-child {
          padding-left: 0px !important;
        }
      }
    }
  }
  > :not(:first-child) {
    border-top: 1.2px solid #dedede !important;
  }
  thead {
    tr {
      th {
        font-size: 13px;
        font-weight: 500;
        color: #797c8b;
        border-bottom: 1.1px solid #dedede !important;
      }
    }
  }
  tbody {
    tr {
      &:not(:last-child) {
        border-bottom: 1px dashed #dedede;
      }
    }
  }
}
.eTable-2 > :not(caption) > *:last-child > * {
  border-bottom-color: transparent !important;
}
.row-number {
  font-size: 14px;
  font-weight: 500;
  line-height: 21px;
  color: #797c8b;
}
</style>

    <!-- Start Admin area -->
    <div class="row">
      <div class="col-12">
        <div class="eSection-wrap-2">

            @if(count($customers) > 0)
            <!-- Table -->
            <div class="table-responsive">
                <table class="table eTable eTable-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ get_phrase('Name') }}</th>
                            <th scope="col">{{ get_phrase('Email') }}</th>
                            <th scope="col">{{ get_phrase('User Info') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)

                            <tr>
                                <td scope="row">
                                    <p class="row-number">{{ $loop->index + 1 }}</p>
                                </td>
                                <td>
                                    <div class="dAdmin_profile d-flex align-items-center min-w-200px">
                                        <div class="dAdmin_profile_img">
                                            <img
                                            class="img-fluid"
                                            width="50"
                                            height="50"
                                            src="{{ get_user_image($customer->id) }}"
                                            />
                                        </div>
                                        <div class="dAdmin_profile_name">
                                            <h4>{{ $customer->name }}</h4>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dAdmin_info_name min-w-250px">
                                        <p>{{ $customer->email }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dAdmin_info_name min-w-250px">
                                        <p><span>{{ get_phrase('Phone') }}:</span> {{ $customer->phone }}</p>
                                        <p>
                                            <?php $info = json_decode($customer->address); ?>
                                            <span>{{ get_phrase('Address') }}:</span> <strong>{{ get_phrase('Cc') }}: </strong>{{ $info->country_code }}, <strong>{{ get_phrase('State') }}: </strong>{{ $info->state }}, <strong>{{ get_phrase('H') }}: </strong>{{ $info->addressline }}, <strong>{{ get_phrase('Zip code') }}: </strong>{{ $info->zipcode }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @else
            <div class="empty_box center">
                <img class="mb-3" width="150px" src="{{ asset('public/assets/backend/images/no_data_img.png') }}" />
                <br>
                
                <span class="text-center">{{ get_phrase('No data found') }}</span>
            </div>
            @endif

        </div>
      </div>
    </div>
