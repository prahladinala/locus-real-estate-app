@extends('backend.index')
@section('content')



<div class="mainSection-title">
    <div class="row">
      <div class="col-12">
        <div
          class="d-flex justify-content-between align-items-center flex-wrap gr-15"
        >
          <div class="d-flex flex-column">
            <h4>{{ get_phrase('Agent') }}</h4>
            <ul class="d-flex align-items-center eBreadcrumb-2">
              <li><a href="#">{{ get_phrase('Home') }}</a></li>
              <li><a href="#">{{ get_phrase('Users') }}</a></li>
              <li><a href="#">{{ get_phrase('Agent') }}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Start Admin area -->
<div class="row">
  <div class="col-12">
    <div class="eSection-wrap-2">
      <div class="search-filter-area d-flex justify-content-md-between justify-content-center align-items-center flex-wrap gr-15">
        <form action="{{ route('admin.agent_list') }}">
          <div class="search-input d-flex justify-content-start align-items-center" >
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path
                  id="Search_icon"
                  data-name="Search icon"
                  d="M2,7A4.951,4.951,0,0,1,7,2a4.951,4.951,0,0,1,5,5,4.951,4.951,0,0,1-5,5A4.951,4.951,0,0,1,2,7Zm12.3,8.7a.99.99,0,0,0,1.4-1.4l-3.1-3.1A6.847,6.847,0,0,0,14,7,6.957,6.957,0,0,0,7,0,6.957,6.957,0,0,0,0,7a6.957,6.957,0,0,0,7,7,6.847,6.847,0,0,0,4.2-1.4Z"
                  fill="#797c8b"
                />
              </svg>
            </span>
            <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Search user" class="form-control" />
          </div>
        </form>
        <!-- Export Button -->
        @if(count($agents) > 0)
        <div class="position-relative">
          <button
            class="eBtn-3 dropdown-toggle"
            type="button"
            id="defaultDropdown"
            data-bs-toggle="dropdown"
            data-bs-auto-close="true"
            aria-expanded="false"
          >
            <span class="pr-10">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="12.31"
                height="10.77"
                viewBox="0 0 10.771 12.31"
              >
                <path
                  id="arrow-right-from-bracket-solid"
                  d="M3.847,1.539H2.308a.769.769,0,0,0-.769.769V8.463a.769.769,0,0,0,.769.769H3.847a.769.769,0,0,1,0,1.539H2.308A2.308,2.308,0,0,1,0,8.463V2.308A2.308,2.308,0,0,1,2.308,0H3.847a.769.769,0,1,1,0,1.539Zm8.237,4.39L9.007,9.007A.769.769,0,0,1,7.919,7.919L9.685,6.155H4.616a.769.769,0,0,1,0-1.539H9.685L7.92,2.852A.769.769,0,0,1,9.008,1.764l3.078,3.078A.77.77,0,0,1,12.084,5.929Z"
                  transform="translate(0 12.31) rotate(-90)"
                  fill="#00a3ff"
                />
              </svg>
            </span>
            {{ get_phrase('Export') }}
          </button>
          <ul
            class="dropdown-menu dropdown-menu-end eDropdown-menu-2"
          >
            <li>
                <a class="dropdown-item" id="pdf" href="{{ route('admin.agentPdfGenerate') }}">{{ get_phrase('PDF') }}</a>
            </li>
            <li>
                <a class="dropdown-item" id="print" href="javascript:;" onclick="printableDiv('agent_list')">{{ get_phrase('Print') }}</a>
            </li>
          </ul>
        </div>
        @endif
      </div>

      @if(count($agents) > 0)
      <!-- Table -->
      <div class="table-responsive">
        <table class="table eTable eTable-2">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">{{ get_phrase('Name') }}</th>
              <th scope="col">{{ get_phrase('Email') }}</th>
              <th scope="col">{{ get_phrase('User Info') }}</th>
              <th scope="col">{{ get_phrase('Oprions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($agents as $agent)
              <tr>
                <td scope="row">
                  <p class="row-number">{{ $loop->index + 1 }}</p>
                </td>
                <td>
                  <div class="dAdmin_profile d-flex align-items-center min-w-200px admin">
                    <div class="dAdmin_profile_img">
                      <img class="img-fluid" width="50" height="50" src="{{ get_user_image($agent->id) }}" />
                      @if($agent->archive == 1)
                        <span class="green"></span>
                        @elseif($agent->archive == 0)
                        <span class="red"></span>
                        @else
                        @endif
                    </div>
                    <div class="dAdmin_profile_name">
                      <h4>{{ $agent->name }}</h4>
                      @if($agent->is_agent==2)
                      <p><span class="eBadge ebg-danger ebadge_control">{{ get_phrase('Banned') }}</span></p>
                      @endif
                    </div>
                  </div>
                </td>
                <td>
                  <div class="dAdmin_info_name min-w-250px">
                    <p>{{ $agent->email }}</p>
                  </div>
                </td>
                <td>
                  <div class="dAdmin_info_name min-w-250px">
                    <p><span>{{ get_phrase('Phone') }}:</span> {{ $agent->phone }}</p>
                    <p>
                      @if(!empty($agent->address))
                      <?php $info = json_decode($agent->address); ?>
                      <span>{{ get_phrase('Address') }}:</span> <strong>{{ get_phrase('Cc') }}: </strong>{{ $info->country_code }}, <strong>{{ get_phrase('State') }}: </strong>{{ $info->state }}, <strong>{{ get_phrase('H') }}: </strong>{{ $info->addressline }}, <strong>{{ get_phrase('Zip code') }}: </strong>{{ $info->zipcode }}
                      @else
                      <span>{{ get_phrase('Address') }}:-</span>
                     @endif
                    </p>
                  </div>
                </td>
                <td>

                  <div class="adminTable-action">
                    <button type="button" class="eBtn eBtn-black dropdown-toggle table-action-btn-2" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ get_phrase('Actions') }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action">
                        <li>
                           <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('admin.agent.open_edit_modal', ['id' => $agent->id]) }}', '{{ get_phrase('Edit Agent') }}')">{{ get_phrase('Edit') }}</a>
                      </li>

                      @if($agent->is_agent==1)

                      <li>
                        <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.agent.ban', ['id' => $agent->id]) }}', 'undefined');">{{ get_phrase('Ban') }}</a>
                      </li>

                      @endif
                      @if($agent->is_agent==2)

                      <li>
                        <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.agent.unban', ['id' => $agent->id]) }}', 'undefined');">{{ get_phrase('Remove Ban') }}</a>
                      </li>

                      @endif
                      @if($agent['archive'] == '0')
                        <li>
                          <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.customer.activeUser', ['id' => $agent->id]) }}', 'undefined');">{{ get_phrase(' Active') }}</a>
                        </li>
                        @else
                        <li>
                          <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.customer.archive', ['id' => $agent->id]) }}', 'undefined');">{{ get_phrase('Deactive') }}</a>
                        </li>
                        @endif

                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="admin-tInfo-pagi d-flex justify-content-md-between justify-content-center align-items-center flex-wrap gr-15">
          <p class="admin-tInfo">{{ get_phrase('Showing').' 1 - '.count($agents).' '.get_phrase('from').' '.$agents->total().' '.get_phrase('data') }}</p>
          <div class="admin-pagi">
            {!! $agents->appends(request()->all())->links('pagination::bootstrap-4') !!}
          </div>
        </div>
        
      </div>
      @else
      <div class="empty_box center">
        <img class="mb-3" width="150px" src="{{ asset('public/assets/backend/images/no_data_img.png') }}" />
        <br>
        <span class="">{{ get_phrase('No data found') }}</span>
      </div>
      @endif

    </div>
  </div>
</div>
<!-- End Admin area -->

@if(count($agents) > 0)
<!-- Table -->
<div class="table-responsive agent_list display-none-view" id="agent_list">
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
      @foreach($agents as $agent)
        <tr>
          <td scope="row">
            <p class="row-number">{{ $loop->index + 1 }}</p>
          </td>
          <td>
            <div class="dAdmin_profile d-flex align-items-center min-w-200px admin">
              <div class="dAdmin_profile_img">
                <img class="img-fluid" width="50" height="50" src="{{ get_user_image($agent->id) }}" />
              </div>
                     
              <div class="dAdmin_profile_name">
                <h4>{{ $agent->name }}</h4>
                @if($agent->is_agent==2)
                <p><span class="eBadge ebg-danger">{{ get_phrase('Banned') }}</span></p>
                @endif

              </div>
            </div>
          </td>
          <td>
            <div class="dAdmin_info_name min-w-250px">
              <p>{{ $agent->email }}</p>
            </div>
          </td>
          <td>
            <div class="dAdmin_info_name min-w-250px">
              <p><span>{{ get_phrase('Phone') }}:-</span> {{ $agent->phone }}</p>
              <p>
                  @if(!empty($customer->address))
                    <?php $info = json_decode($customer->address); ?>
                    <span>{{ get_phrase('Address') }}:</span> <strong>{{ get_phrase('Cc') }}: </strong>{{ $info->country_code }}, <strong>{{ get_phrase('State') }}: </strong>{{ $info->state }}, <strong>{{ get_phrase('H') }}: </strong>{{ $info->addressline }}, <strong>{{ get_phrase('Zip code') }}: </strong>{{ $info->zipcode }}
                    @else
                      <span>{{ get_phrase('Address') }}:-</span>
                    @endif
                </p>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="admin-tInfo-pagi d-flex justify-content-md-between justify-content-center align-items-center flex-wrap gr-15">
    <p class="admin-tInfo">{{ get_phrase('Showing').' 1 - '.count($agents).' '.get_phrase('from').' '.$agents->total().' '.get_phrase('data') }}</p>
    <div class="admin-pagi">
      {!! $agents->appends(request()->all())->links('pagination::bootstrap-4') !!}
    </div>
  </div>
  
</div>
@endif

<script>
  "use strict";

  function printableDiv(printableAreaDivId) {
    var printContents = document.getElementById(printableAreaDivId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }

</script>
@endsection
