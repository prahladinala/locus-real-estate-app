@extends('backend.index')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Packages') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Packages') }}</a></li>
                    </ul>
                </div>
                <div class="export-btn-area">
					<div class="export-btn-area">
						<a href="javascript:;" class="export_btn" onclick="rightModal('{{ route('admin.create.package') }}', 'Create package')"><i class="bi bi-plus"></i>{{ get_phrase('Add Package') }}</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="eSection-wrap">
				<div class="eMain">
					<div class="row">
						<div class="col-md-8 pb-3">
							<div class="eForm-layouts">
								<p class="column-title">{{ get_phrase('FRONTEND PRICING SETTINGS') }}</p>
								<form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.website.update') }}">
									@csrf 
									<div class="fpb-7">
										<label for="pricing_subtitle" class="eForm-label">{{ get_phrase('Pricing Subtitle') }}</label>
										<input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('pricing_subtitle'); }}" id="pricing_subtitle" name = "pricing_subtitle" required>
									</div>
									<div class="fpb-7">
										<label for="pricing_title" class="eForm-label">{{ get_phrase('Pricing Title') }}</label>
										<input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('pricing_title'); }}" id="website_title" name = "pricing_title" required>
									</div>
									<div class="fpb-7 pt-2">
										<button type="submit" class="btn-form">{{ get_phrase('Submit') }}</button>
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
<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
        	@if(count($packages) > 0)
				<table class="table eTable">
					<thead>
	                    <th>#</th>
	                    <th>{{ get_phrase('Package') }}</th>
	                    <th>{{ get_phrase('Price') }}</th>
	                    <th>{{ get_phrase('Interval') }}</th>
	                    <th>{{ get_phrase('duration') }}</th>
	                    <th>{{ get_phrase('Status') }}</th>
	                    <th class="text-end">{{ get_phrase('Action') }}</th>
	                </thead>
	                <tbody>
	                	@foreach($packages as $package)
	                		<tr>
	                			<td>{{ $loop->index + 1 }}</td>
	                			<td><strong>{{ $package->name }}</strong></td>
	                			<td>{{ $package->price }}</td>
	                			<td>{{ $package->interval }}</td>
	                			<td>{{ $package->duration }}</td>
	                			<td>
	                				<?php if ($package->status != '1'): ?>
			                            <span class="eBadge ebg-danger">{{ get_phrase('Deactive') }}</span>
			                        <?php else: ?>
			                            <span class="eBadge ebg-success">{{ get_phrase('Active') }}</span>
			                        <?php endif; ?>
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
	                                        <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('admin.edit.package', ['id' => $package->id]) }}', 'Edit Package')">{{ get_phrase('Edit') }}</a>
	                                      </li>
	                                    </ul>
	                                </div>
			                    </td>
	                		</tr>
	                	@endforeach
	                </tbody>
				</table>
			@else
				<div class="empty_box center">
                    <img class="mb-3" width="150px" src="{{ asset('public/assets/backend/images/no_data_img.png') }}" />
                    <br>
                    {{ get_phrase('No data found') }}
                </div>
			@endif
		</div>
	</div>
</div>
@endsection
