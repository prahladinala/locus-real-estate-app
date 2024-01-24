@extends('backend.index')

@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Blog List') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blogs') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blog List') }}</a></li>
                    </ul>
                </div>
                <div class="export-btn-area">
                    <a href="{{ route('admin.create.blogs') }}" class="export_btn">{{ get_phrase('Add new blog') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="eSection-wrap-2">
            @if(count($blogs) > 0)
            <!-- Table -->
            <div class="table-responsive">
              <table class="table eTable eTable-2">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ get_phrase('Creator') }}</th>
                    <th scope="col">{{ get_phrase('Title') }}</th>
                    <th scope="col">{{ get_phrase('Category') }}</th>
                    <th scope="col">{{ get_phrase('Status') }}</th>
                    <th scope="col">{{ get_phrase('Oprions') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        @php $user_name = $blog->blog_to_user->name; @endphp
                        @php $user_email = $blog->blog_to_user->email; @endphp
                        @php $blog_category_title = $blog->blog_to_category->title; @endphp
                      <tr>
                        <th scope="row">
                          <p class="row-number">{{ $loop->index + 1 }}</p>
                        </th>
                        <td>
                          <div
                            class="dAdmin_profile d-flex align-items-center min-w-200px"
                          >
                            <div class="dAdmin_profile_img">
                              <img
                                class="img-fluid"
                                width="50"
                                height="50"
                                src="{{ get_user_image($blog->user_id) }}"
                              />
                            </div>
                            <div class="dAdmin_profile_name">
                              <h4>{{ $user_name }}</h4>
                              <p>{{ $user_email }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="item min-w-200px">
                            <p class="info"><a class="title_link" href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}" target="_blank">{{ $blog->title }}</a></p>
                          </div>
                        </td>
                        <td>
                          <div class="dAdmin_info_name min-w-100px">
                            <p>{{ $blog_category_title }}</p>
                          </div>
                        </td>
                        <td>
                          <div class="dAdmin_info_name min-w-100px">
                            <?php if ($blog->status != 1): ?>
                                <span class="eBadge ebg-danger">{{ get_phrase("Inactive") }}</span>
                            <?php else: ?>
                                <span class="eBadge ebg-success">{{ get_phrase("Active") }}</span>
                            <?php endif; ?>
                          </div>
                        </td>
                        <td>
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
                                <a class="dropdown-item" href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}">{{ get_phrase('Edit') }}</a>
                              </li>
                              <li>
                                 @if($blog->status == '1')
                                    <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.blog_status.update', ['id' => $blog->id, 'status' => '0']) }}', 'undefined');">{{ get_phrase('Inactive') }}</a>
                                @else
                                    <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.blog_status.update', ['id' => $blog->id, 'status' => '1']) }}', 'undefined');">{{ get_phrase('Active') }}</a>
                                @endif
                              </li>
                              <li>
                                <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.blog.delete', ['id' => $blog->id]) }}', 'undefined');">{{ get_phrase('Delete') }}</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            @else
                @include('backend.admin.no_data_found')
            @endif
        </div>
    </div>
</div>
@endsection