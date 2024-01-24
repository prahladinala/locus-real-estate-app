
@extends('backend.index')
@section('content')


<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Pending Request') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Subscriptions') }}</a></li>
                        <li><a href="#">{{ get_phrase('Pending Request') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
			@if(count($pending_subscriptions) > 0)
				<table class="table eTable">
					<thead>
	                    <th>#</th>
	                    <th>{{ get_phrase('User') }}</th>
                        <th>{{ get_phrase('package') }}</th>
	                    <th>{{ get_phrase('Price') }}</th>
	                    <th>{{ get_phrase('Payment For') }}</th>
	                    <th>{{ get_phrase('Payment Document') }}</th>
	                    <th>{{ get_phrase('Status') }}</th>
	                    <th class="text-center">{{ get_phrase('Action') }}</th>
	                </thead>
	                <tbody>
	                	@foreach($pending_subscriptions as $pending_subscription)

	                		<tr>
	                			<td>{{ $loop->index + 1 }}</td>
                                <td><strong>{{ $pending_subscription->pendingsubscription_to_user->name }}</strong></td>
                                <td>{{ $pending_subscription->pendingsubscription_to_package->name }}</td>
	                			<td>{{ currency($pending_subscription->price) }}</td>
	                			<td>{{ ucwords($pending_subscription->payment_type) }}</td>
                                <td>
								{{ get_phrase('download file') }}
	                			</td>
	                			<td>
	                				<span class="eBadge ebg-info">{{ get_phrase('Pending') }}</span>
	                			</td>
	                			<td class="text-start">
	                				<div class="adminTable-action">
	                                    <button
	                                      type="button"
	                                      class="eBtn eBtn-black dropdown-toggle table-action-btn-2"
	                                      data-bs-toggle="dropdown"
	                                      aria-expanded="false"
	                                    >
	                                      {{ get_phrase('Actions') }}
	                                    </button>
	                                    <ul
	                                      class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action"
	                                    >
	                                      <li>
	                                        <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.subscription.approve.status', ['id' => $pending_subscription->id]) }}', 'undefined');">{{ get_phrase('Approve') }}</a>
	                                      </li>
	                                      <li>
	                                        <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.subscription.delete', ['id' => $pending_subscription->id]) }}', 'undefined');">{{ get_phrase('Delete') }}</a>
	                                      </li>
	                                    </ul>
	                                </div>
			                    </td>
	                		</tr>
	                	@endforeach
	                </tbody>
				</table>
			@else
				@include('backend.admin.no_data_found')
			@endif
		</div>
	</div>
</div>
@endsection
