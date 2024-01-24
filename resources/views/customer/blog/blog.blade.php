@extends('customer.index')
@section('customerRightPanel')
<div class="col-lg-9" id="blog_body">
	<div class="l_col_main">
	    <!-- Title -->
	    <div
	      class="d-flex justify-content-between align-items-center flex-wrap pt-26 pb-30 mb-16"
	    >
	      <div class="tableTitle-3 d-flex flex-wrap g-20 agent-head">
	        <h4>{{ get_phrase('All blogs') }}</h4>
	      </div>
	      <!-- Button -->
	      <a href="javascript:;" class="add-listing cg-10" onclick="add_blog()" 
	        ><i class="fa-solid fa-plus"></i> {{ get_phrase('Write a Blog') }}</a
	      >
	    </div>
		@if(count($blog_list) > 0)
	    <!-- Blog Start -->
	    <div class="row">
	    	@foreach($blog_list as $blog)
        	@php $date = date('M d, Y', strtotime($blog->created_at));
          	$length = strlen($blog->description); @endphp
	        <div class="col-lg-6 col-md-6 mb-40">
	            <!-- Blog Start -->
	            <div class="post-item">
                    <div class="post-image">
                        <a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}" target="_blank">
							
							@if($blog->thumbnail)
							<img src="{{ asset('public/uploads/blog/'.$blog->thumbnail) }}" width="200px" alt="...">
							@else
							<img src="{{ asset('public/uploads/blog/placeholder.jpg') }}" width="200px"
								alt="...">
							@endif

						</a>

                        <div class="over-icon-box">
                          <a class="l_edit-icon" href="javascript:;" onclick="editBlog('{{ $blog->id }}')"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                          <a class="l_delete-icon" href="javascript:;" onclick="confirmModal('{{ route('blogDelete', ['id' => $blog->id]) }}', 'undefined');" title="Delete"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <div class="post-meta">
                        <ul>
                           <li><i class="fa-regular fa-user"></i>{{ get_phrase('by') }}<span>&nbsp;{{ get_phrase('Agent') }}</span></li>
                           @if($blog->status)
                           		<li><span class="color-2">{{ get_phrase('Active') }}</span></li>
                           @else
                           		<li><span class="color-3">{{ get_phrase('Pending') }}</span></li>
                           @endif
                           <li>{{ $date }}</li>
                        </ul>
                        </div>
                    </div>
                    <div class="post-content">
                        <h3><a href="#">{{ $blog->title }}</a></h3>
                      	@if($length < 85)
                       		<p>{{ Str::limit(strip_tags($blog->description)) }}</p>
                      	@else
                       		<p>{{ Str::limit(strip_tags($blog->description), 80) }}...</p>
                      	@endif
                    </div>
                </div>
	            <!-- Blog End -->
	        </div>
	        @endforeach
	    </div>
		@else
			@include('no_data_found')
		@endif
	    <!-- Pagination -->
		<div class="adminPanel-pagi">
			{!! $blog_list->links('pagination::bootstrap-4') !!}
		</div>
	</div>
</div>

<script type="text/javascript">
	"use strict";
	function add_blog() {
        let url = "{{ route('writeBlog') }}";
        $.ajax({
            url: url,
            success: function(data){
                $('#blog_body').html(data);
            }
        });
    }

    function editBlog(blog_id) {
    	var url = '{{ route('editBlog', ['id' => ':blog_id']) }}';
    	url = url.replace(":blog_id", blog_id);
    	$.ajax({
		    url: url,
		    success: function(response){
		        $('#blog_body').html(response);
		    }
	    });
    }
</script>

@endsection