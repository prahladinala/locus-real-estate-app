@extends('global.index')
@section('content')

    @php
        isset($searched_word) ? '' : ($searched_word = '');
        isset($searched_category) ? '' : ($searched_category = []);
    @endphp

    <!-- Blog Grid Area Start  -->
    <div class="blog-grid-area sec-margin">
        <div class="container">
            <div class="row">
                @if (count($blogs) > 0)
                    <div class="col-lg-8">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                @php $date = date('M d, Y', strtotime($blog->created_at));
                                $length = strlen($blog->description); @endphp
                                <div class="col-lg-6 col-md-6 mb-40">
                                    <!-- Blog Start -->
                                    <div class="post-item antry-blog-post h-100">
                                        <div class="post-image">
                                            <a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}"><img
                                                    src="{{ asset('public/uploads/blog/' . $blog->thumbnail) }}" alt="blog-image"></a>
                                        </div>
                                        <div class="post-content blog_lest  mt-0">
                                            <div class="post-meta ">
                                                <ul class="blog_metas">
                                                    <li>
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_164_1319)">
                                                                <path
                                                                    d="M15.5299 1.87337H14.7383V1.08171C14.7383 0.871743 14.6549 0.670379 14.5064 0.521913C14.3579 0.373447 14.1566 0.290039 13.9466 0.290039C13.7367 0.290039 13.5353 0.373447 13.3868 0.521913C13.2384 0.670379 13.1549 0.871743 13.1549 1.08171V1.87337H6.82161V1.08171C6.82161 0.871743 6.73821 0.670379 6.58974 0.521913C6.44127 0.373447 6.23991 0.290039 6.02995 0.290039C5.81998 0.290039 5.61862 0.373447 5.47016 0.521913C5.32169 0.670379 5.23828 0.871743 5.23828 1.08171V1.87337H4.44661C3.39719 1.87463 2.3911 2.29207 1.64904 3.03413C0.906979 3.77619 0.489538 4.78228 0.488281 5.83171L0.488281 15.3317C0.489538 16.3811 0.906979 17.3872 1.64904 18.1293C2.3911 18.8713 3.39719 19.2888 4.44661 19.29H15.5299C16.5794 19.2888 17.5855 18.8713 18.3275 18.1293C19.0696 17.3872 19.487 16.3811 19.4883 15.3317V5.83171C19.487 4.78228 19.0696 3.77619 18.3275 3.03413C17.5855 2.29207 16.5794 1.87463 15.5299 1.87337ZM2.07161 5.83171C2.07161 5.20182 2.32184 4.59773 2.76724 4.15233C3.21264 3.70693 3.81673 3.45671 4.44661 3.45671H15.5299C16.1598 3.45671 16.7639 3.70693 17.2093 4.15233C17.6547 4.59773 17.9049 5.20182 17.9049 5.83171V6.62337H2.07161V5.83171ZM15.5299 17.7067H4.44661C3.81673 17.7067 3.21264 17.4565 2.76724 17.0111C2.32184 16.5657 2.07161 15.9616 2.07161 15.3317V8.20671H17.9049V15.3317C17.9049 15.9616 17.6547 16.5657 17.2093 17.0111C16.7639 17.4565 16.1598 17.7067 15.5299 17.7067Z"
                                                                    fill="#9098A4" />
                                                                <path
                                                                    d="M9.98828 13.3525C10.6441 13.3525 11.1758 12.8209 11.1758 12.165C11.1758 11.5092 10.6441 10.9775 9.98828 10.9775C9.33244 10.9775 8.80078 11.5092 8.80078 12.165C8.80078 12.8209 9.33244 13.3525 9.98828 13.3525Z"
                                                                    fill="#9098A4" />
                                                                <path
                                                                    d="M6.03027 13.3525C6.68611 13.3525 7.21777 12.8209 7.21777 12.165C7.21777 11.5092 6.68611 10.9775 6.03027 10.9775C5.37444 10.9775 4.84277 11.5092 4.84277 12.165C4.84277 12.8209 5.37444 13.3525 6.03027 13.3525Z"
                                                                    fill="#9098A4" />
                                                                <path
                                                                    d="M13.9463 13.3525C14.6021 13.3525 15.1338 12.8209 15.1338 12.165C15.1338 11.5092 14.6021 10.9775 13.9463 10.9775C13.2905 10.9775 12.7588 11.5092 12.7588 12.165C12.7588 12.8209 13.2905 13.3525 13.9463 13.3525Z"
                                                                    fill="#9098A4" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_164_1319">
                                                                    <rect width="19" height="19" fill="white" transform="translate(0.488281 0.290039)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        {{ $date }}
                                                    </li>
                                                    @if ($blog->is_popular)
                                                        <li><span class="color-2">{{ get_phrase('Featured') }}</span></li>
                                                    @else
                                                        <li><span class="color-2"> </span></li>
                                                    @endif
                                                    <li>
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_180_70)">
                                                                <path
                                                                    d="M9.03711 9.29004C9.92713 9.29004 10.7972 9.02612 11.5372 8.53165C12.2772 8.03719 12.854 7.33438 13.1946 6.51212C13.5352 5.68985 13.6243 4.78505 13.4506 3.91213C13.277 3.03922 12.8484 2.2374 12.2191 1.60806C11.5898 0.978724 10.7879 0.550141 9.91502 0.376507C9.0421 0.202874 8.1373 0.291989 7.31503 0.632583C6.49277 0.973178 5.78996 1.54995 5.2955 2.28997C4.80103 3.03 4.53711 3.90003 4.53711 4.79004C4.5383 5.98315 5.01279 7.12705 5.85644 7.97071C6.7001 8.81436 7.844 9.28885 9.03711 9.29004ZM9.03711 1.79004C9.63045 1.79004 10.2105 1.96599 10.7038 2.29563C11.1972 2.62528 11.5817 3.09381 11.8087 3.64199C12.0358 4.19017 12.0952 4.79337 11.9795 5.37531C11.8637 5.95725 11.578 6.4918 11.1584 6.91136C10.7389 7.33092 10.2043 7.61664 9.62238 7.7324C9.04044 7.84815 8.43724 7.78874 7.88906 7.56168C7.34088 7.33462 6.87234 6.9501 6.5427 6.45675C6.21306 5.9634 6.03711 5.38339 6.03711 4.79004C6.03711 3.99439 6.35318 3.23133 6.91579 2.66872C7.4784 2.10611 8.24146 1.79004 9.03711 1.79004Z"
                                                                    fill="#9098A4" />
                                                                <path
                                                                    d="M9.03711 10.79C7.24751 10.792 5.53177 11.5038 4.26633 12.7693C3.00089 14.0347 2.28909 15.7504 2.28711 17.54C2.28711 17.739 2.36613 17.9297 2.50678 18.0704C2.64743 18.211 2.8382 18.29 3.03711 18.29C3.23602 18.29 3.42679 18.211 3.56744 18.0704C3.70809 17.9297 3.78711 17.739 3.78711 17.54C3.78711 16.1477 4.34023 14.8123 5.3248 13.8277C6.30936 12.8432 7.64472 12.29 9.03711 12.29C10.4295 12.29 11.7649 12.8432 12.7494 13.8277C13.734 14.8123 14.2871 16.1477 14.2871 17.54C14.2871 17.739 14.3661 17.9297 14.5068 18.0704C14.6474 18.211 14.8382 18.29 15.0371 18.29C15.236 18.29 15.4268 18.211 15.5674 18.0704C15.7081 17.9297 15.7871 17.739 15.7871 17.54C15.7851 15.7504 15.0733 14.0347 13.8079 12.7693C12.5424 11.5038 10.8267 10.792 9.03711 10.79Z"
                                                                    fill="#9098A4" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_180_70">
                                                                    <rect width="18" height="18" fill="white" transform="translate(0.0371094 0.290039)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                        @php
                                                            $name = App\Models\User::where('id', $blog->user_id)->first();
                                                        @endphp
                                                        {{ get_phrase('by') }}<span>&nbsp;
                                                            @if ($blog->user_id == 1)
                                                                {{ get_phrase('admin') }}
                                                            @else
                                                                {{ substr($name->name, 0, 6) }}
                                                            @endif
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h3><a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}">{{ $blog->title }}</a></h3>
                                            @if ($length < 85)
                                                <p> {{ Str::limit(strip_tags($blog->description), 80) }}</p>
                                            @else
                                                <p>{{ Str::limit(strip_tags($blog->description), 85) }}</p>
                                            @endif
                                            <a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}"
                                                class="read-more">{{ get_phrase('Read More') }}<i class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                    <!-- Blog End -->
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="pagination-items">
                            {!! $blogs->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                @else
                    <div class="col-lg-8">
                        <div class="row">
                            @include('no_data_found')
                        </div>
                    </div>
                @endif
                <div class="col-lg-4">
                    <div class="l_sidebar-items">
                        <div class=" wiget-items l-search-area">
                            <h6 class="widget-titles">{{ get_phrase('Search') }}</h6>
                            <form action="{{ route('blogGrid') }}">
                                <button type="submit"><svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.2912 16.4088C16.123 16.3072 15.9632 16.1923 15.8134 16.065C14.7756 15.0382 13.7421 14.0068 12.7128 12.9709C12.6752 12.9283 12.6404 12.8832 12.6089 12.8359C11.2055 14.0087 9.40376 14.595 7.57892 14.4727C5.75407 14.3503 4.04675 13.5288 2.81248 12.1791C1.57821 10.8294 0.91213 9.05564 0.952942 7.22714C0.993755 5.39865 1.73831 3.65638 3.03157 2.36312C4.32483 1.06986 6.06711 0.325298 7.8956 0.284485C9.72409 0.243673 11.4979 0.909751 12.8475 2.14402C14.1972 3.37829 15.0188 5.08561 15.1411 6.91046C15.2635 8.73531 14.6772 10.537 13.5044 11.9404C13.5552 11.9762 13.6039 12.0149 13.6503 12.0562C14.6795 13.0837 15.7073 14.1129 16.7335 15.144C16.8607 15.2935 16.9757 15.453 17.0773 15.6209V15.9045C17.035 16.0203 16.968 16.1254 16.8809 16.2125C16.7938 16.2996 16.6887 16.3666 16.573 16.4088H16.2912ZM2.26135 7.35713C2.25685 8.50189 2.59187 9.62228 3.22405 10.5767C3.85623 11.531 4.75718 12.2766 5.81301 12.719C6.86883 13.1614 8.03213 13.2808 9.15582 13.0621C10.2795 12.8435 11.3132 12.2966 12.1261 11.4906C12.939 10.6845 13.4946 9.6556 13.7228 8.5338C13.951 7.41201 13.8415 6.24774 13.4081 5.18819C12.9747 4.12864 12.2369 3.22138 11.2879 2.58111C10.3389 1.94084 9.22141 1.59631 8.07665 1.59107C6.54123 1.58573 5.06644 2.18995 3.97612 3.27103C2.8858 4.35212 2.26907 5.82171 2.26135 7.35713Z"
                                            fill="white" stroke="white" stroke-width="0.2" />
                                    </svg></button>
                                <input id="search" name="search" type="text" value="{{ $searched_word }}" placeholder="search here" class="form-control">
                            </form>
                        </div>
                        <div class="wiget-items categories">
                            <h6 class="widget-titles">{{ get_phrase('Categories') }}</h6>
                            <ul>
                                @foreach ($blog_categories as $blog_category)
                                    @php $blog_count = count($blog_category->blogCategory_to_blog()->get()); @endphp
                                    <li>
                                        <a href="{{ route('blogGrid', ['category' => $blog_category->id]) }}">
                                            <p>{{ $blog_category->title }}</p>
                                            <span>({{ $blog_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wiget-items recent-posts-entry">
                            <h6 class="widget-titles">{{ get_phrase('Recent Post') }}</h6>
                            @foreach ($latest_blogs as $latest)
                                @php
                                    $date = date('M d, Y', strtotime($latest->created_at));
                                @endphp
                                <a href="{{ route('blogDetails', ['slug' => slugify($latest->title), 'id' => $latest->id]) }}">
                                    <div class="widget-post-bx">
                                        <div class="widget-posts clearfix d-flex align-items-center">
                                            <div class="ttr-post-media"> <img src="{{ asset('public/uploads/blog/' . $latest->thumbnail) }}" alt=""> </div>
                                            <div class="ttr-post-info">
                                                <div class="ttr-post-header">
                                                    <h6 class="post-titles">{{ Str::limit($latest->title, 30) }}</h6>
                                                </div>
                                                <ul class="media-posts">
                                                    <li><i class="fa-regular fa-calendar-days"></i>{{ $date }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="wiget-items  tags-area">
                            <h6 class="widget-titles">{{ get_phrase('Tag') }}</h6>
                            <ul>
                                @foreach ($tags as $key => $tag)
                                    <li><a href="{{ route('blogGrid', ['tag' => $tag]) }}">{{ $tag }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Area End  -->
@endsection
