@php use Carbon\Carbon; @endphp

<style type="text/css">
  .subscription_active_status{
    color: #007BFF;
  }

  .subscription_deactive_status{
    color: #EF181B;
  }
</style>

<div class="dl_column_content d-flex flex-column rg-30">
  <!--Account -->
  @if($expiry_status)
  <div
    class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white"
  >
    <!-- Title -->
    <div class="tableTitle-3 pb-20 mb-30 bd-b-1">
      <h4 class="fz-20-sb-black pb-10">{{ get_phrase('Expired Subscription') }}</h4>
    </div>
    <!-- Expired Content -->
    <div class="subscription-expired px-30 py-30 bd-r-5">
      <h3 class="fz-18-sb-black pb-10">
        {{ get_phrase('Your subscription has expired') }}
      </h3>
      <p class="fz-15-r-gray pb-30">
        {{ get_phrase('Your package has expired, please renew your package') }}.
      </p>
      <a href="javascript:;" onclick="renew_subscription()" class="eBtn expired-btn">{{ get_phrase('Renew Subscription') }}</a>
    </div>
  </div>
  @else
  <div
    class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white"
  >
    <div
      class="d-flex justify-content-between align-items-center flex-wrap pb-22 mb-30 bd-b-1"
    >
      <!-- Title -->
      <div class="tableTitle-3">
        <h4 class="fz-20-sb-black pb-10">{{ get_phrase($current_package->name).' '.get_phrase('Account') }}</h4>
        <p class="fz-15-r-gray">{{ get_phrase($current_package->description).' '.get_phrase('Plan') }}</p>
      </div>
      <!-- Button -->
      
    </div>
    <p class="fz-15-r-gray">
      {{ get_phrase('Your current package price is') }}

      @php $date = date('M d, Y, h:m a', strtotime($current_subscription->expire_date)); @endphp
      <span class="fz-24-b-black">{{ currency($current_package->price) }}.</span> {{ get_phrase('It will exipired on ') }} {{ $date }}
    </p>
  </div>
  @endif
  <!-- Payment Method -->
  <div
    class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white"
  >
    <!-- Title -->
    <div class="tableTitle-3 pb-22 mb-25 bd-b-1">
      <h4 class="fz-20-sb-black">{{ get_phrase('Payment Method') }}</h4>
    </div>
    <!-- Card Info -->
    <div class="card-info d-flex align-items-center g-8">
      <div class="icon text-black">
        <i class="fa-solid fa-credit-card"></i>
      </div>
      <p class="fz-15-r-gray">{{ ucfirst($current_subscription->payment_method) }}</p>
    </div>
  </div>
  <!-- Invoicing -->
  <div
    class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white"
  >
    <div
      class="d-flex justify-content-between align-items-center flex-wrap"
    >
      <!-- Title -->
      <div class="tableTitle-3">
        <h4 class="fz-20-sb-black pb-10">{{ get_phrase('Invoicing') }}</h4>
        @php $last_payment_date = date('d-m-Y', strtotime($current_subscription->created_at)); @endphp
        <p class="fz-15-r-gray">{{ get_phrase('Last payment:').' ' }}{{ $last_payment_date }}</p>
      </div>
      <!-- Button -->
      <a href="{{ route('modifyBilling') }}" class="modify-bill"
        >{{ get_phrase('Modify Billing Information') }}</a
      >
    </div>
  </div>
  <!-- Billing History -->
  <div
    class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white"
  >
    <!-- Title -->
    <div class="tableTitle-3">
      <h4 class="fz-20-sb-black">{{ get_phrase('Billing History') }}</h4>
    </div>
    <!-- Table -->
    <div class="table-responsive">
      <table class="table eTable eTable-2 last_t_cell table-pb0">
        <!-- Table Head -->
        <thead>
          <tr>
            <th scope="col">{{ get_phrase('Package') }}</th>
            <th scope="col">{{ get_phrase('Reference') }}</th>
            <th scope="col">{{ get_phrase('Date') }}</th>
            <th scope="col">{{ get_phrase('Price') }}</th>
            <th scope="col">{{ get_phrase('Status') }}</th>
            <th scope="col">{{ get_phrase('Download') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_subscription as $row)

          @php
          $today = date("Y-m-d");
          $today_time = strtotime($today);

          $expiry_status = strtotime($row->expire_date) < $today_time;

          $created_at = date('d-m-Y', strtotime($row->created_at));
          $expire_date = date('d-m-Y', strtotime($row->expire_date));
          @endphp
          <tr>
            <td>
              <div class="dl_table_package">
                <h4 class="fz-15-m-black">{{ get_phrase($row->subscription_to_package->name) }}</h4>
              </div>
            </td>
            <td>
              <div class="dl_property_id">
                <p>{{ $created_at }}</p>
              </div>
            </td>
            <td>
              <div
                class="dl_property_time d-flex flex-column g-8"
              >
                <span class="eBadge-2">{{ $expire_date }}</span>
              </div>
            </td>
            <td>
              <div class="dl_table_package">
                <h4 class="fz-15-sb-black">{{ currency($row->subscription_to_package->price) }}</h4>
              </div>
            </td>
            <td>
              @if($expiry_status)
              <div class="subscription_deactive_status">
                <i class="fa-solid fa-check"></i>
              </div>
              @else
              <div class="subscription_active_status">
                <i class="fa-solid fa-check"></i>
              </div>
              @endif
            </td>
            <td>
              <div class="tDownloadIcon">
                <a class="invoiceTag" href="{{ route('subscriptionInvoice', ['id' => $row->id]) }}" target="_blank"><i class="fa-solid fa-download"></i></a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
