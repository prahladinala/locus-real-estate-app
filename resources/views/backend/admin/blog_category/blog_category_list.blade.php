@extends('backend.index')

@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Blog Categories') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blogs') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blog Categories') }}</a></li>
                    </ul>
                </div>
                <div class="export-btn-area">
                    <a href="javascript:;" class="export_btn" onclick="largeModal('{{ route('admin.create.blog_category') }}', 'Create New Blog Category')">{{ get_phrase('Add blog category') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($blog_categories) > 0)
<div class="row justify-content-center mt-4">
	<div class="col-7">
		<div class="eSection-wrap">
			<!-- Table -->
			<div class="table-responsive">
				<table class="table eTable eTable-2">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">{{ get_phrase('Title') }}</th>
							<th scope="col">{{ get_phrase('Number of Blog') }}</th>
							<th scope="col">{{ get_phrase('Oprions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($blog_categories as $blog_category)
						<tr>
							<td scope="row">
								<p class="row-number">{{ $loop->index + 1 }}</p>
							</td>
							<td>
								<div class="dAdmin_profile d-flex align-items-center min-w-150px">
									<div class="dAdmin_profile_name">
										<h4>{{ $blog_category->title }}</h4>
									</div>
								</div>
							</td>
							<td class="text-center">
								<div class="dAdmin_info_name max-w-100px">
									<p>{{ count($blog_category->blogCategory_to_blog) }}</p>
								</div>
							</td>
							<td>
								<div class="adminTable-action">
									<button type="button" class="eBtn eBtn-black dropdown-toggle table-action-btn-2" data-bs-toggle="dropdown" aria-expanded="false">{{ get_phrase('Actions') }}</button>
									<ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action">
										<li>
											<a class="dropdown-item" href="javascript:;" onclick="largeModal('{{ route('admin.blog_category.edit', ['id' => $blog_category['id']]) }}', '{{ get_phrase('Edit blog category') }}')">{{ get_phrase('Edit') }}</a>
										</li>
										<li>
											<a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.blog_category.delete', ['id' => $blog_category['id']]) }}', 'undefined')">{{ get_phrase('Delete') }}</a>
										</li>
									</ul>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
			@include('backend.admin.no_data_found')
		</div>
	</div>
</div>
@endif
@endsection