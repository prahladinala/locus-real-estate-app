@extends('global.index')
@section('content')


@php 

$date = date('M d, Y', strtotime($blog_details->created_at));
$category_title = $blog_details->blog_to_category->title;
$aurthor_name = $blog_details->blog_to_user->name; 

isset($searched_word) ? "" : $searched_word ="";
isset($searched_category) ?"" : $searched_category =array();

@endphp
<!-- Blog Details   Area Start  -->
<div class="blog-details-area sec-margin">
  <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
              <div class="col-lg-12">
                <div class="blog-details-con">
                    <div class="l-blog-img">
                      <img class="img-fluid" src="{{ asset('public/uploads/blog/'.$blog_details->thumbnail) }}" alt="image">
                    </div>
                    <div class="l-blog-text">
                      <h4>{{ $blog_details->title }}</h4>
                      <div class="l-meta-top">
                          <ul>
                            <li class="d-flex align-items-center"><img src="{{ asset('public/assets/global/images/folder.svg') }}" alt="svg"> {{ $category_title }}</li>
                            <li class="d-flex align-items-center"><i class="fa-regular fa-user"></i>
                               {{ $aurthor_name }}
                              </li>
                            <li class="d-flex align-items-center"><img src="{{ asset('public/assets/global/images/Calendar.svg') }}" alt="svg"> <time datetime="2020-01-01">{{ $date }}</time></li>
                          </ul>
                        </div>
                        <p class="small-text">{!! $blog_details->description !!}</p>
                        @php $url = url()->current(); @endphp
                        <ul class="social-shares d-flex mt-5">
                          <li>{{ get_phrase('Share On') }} :</li>
                          <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}&display=popup" title="Click to share this post on Facebook" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                          </li>
                          <li>
                            <a href="https://www.instagram.com/?url={{ $url }}" title="Click to share this post on Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                          </li>
                          <li>
                            <a href="http://twitter.com/share?url={{ $url }}" title="Click to share this post on Twitter" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                          </li>
                          <li>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ $url }}" title="Click to share this post on Linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                          </li>
                        </ul>
                    </div>
                </div>
              </div>
                <!--  Review Area Start -->
            </div>
        </div>
        <div class="col-lg-4">
          <div class="l_sidebar-items">
              <div class=" wiget-items l-search-area">
                <h6 class="widget-titles">{{ get_phrase('Search') }}</h6>
                   <form action="{{ route('blogGrid') }}">
                          <button type="submit" ><svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.2912 16.4088C16.123 16.3072 15.9632 16.1923 15.8134 16.065C14.7756 15.0382 13.7421 14.0068 12.7128 12.9709C12.6752 12.9283 12.6404 12.8832 12.6089 12.8359C11.2055 14.0087 9.40376 14.595 7.57892 14.4727C5.75407 14.3503 4.04675 13.5288 2.81248 12.1791C1.57821 10.8294 0.91213 9.05564 0.952942 7.22714C0.993755 5.39865 1.73831 3.65638 3.03157 2.36312C4.32483 1.06986 6.06711 0.325298 7.8956 0.284485C9.72409 0.243673 11.4979 0.909751 12.8475 2.14402C14.1972 3.37829 15.0188 5.08561 15.1411 6.91046C15.2635 8.73531 14.6772 10.537 13.5044 11.9404C13.5552 11.9762 13.6039 12.0149 13.6503 12.0562C14.6795 13.0837 15.7073 14.1129 16.7335 15.144C16.8607 15.2935 16.9757 15.453 17.0773 15.6209V15.9045C17.035 16.0203 16.968 16.1254 16.8809 16.2125C16.7938 16.2996 16.6887 16.3666 16.573 16.4088H16.2912ZM2.26135 7.35713C2.25685 8.50189 2.59187 9.62228 3.22405 10.5767C3.85623 11.531 4.75718 12.2766 5.81301 12.719C6.86883 13.1614 8.03213 13.2808 9.15582 13.0621C10.2795 12.8435 11.3132 12.2966 12.1261 11.4906C12.939 10.6845 13.4946 9.6556 13.7228 8.5338C13.951 7.41201 13.8415 6.24774 13.4081 5.18819C12.9747 4.12864 12.2369 3.22138 11.2879 2.58111C10.3389 1.94084 9.22141 1.59631 8.07665 1.59107C6.54123 1.58573 5.06644 2.18995 3.97612 3.27103C2.8858 4.35212 2.26907 5.82171 2.26135 7.35713Z" fill="white" stroke="white" stroke-width="0.2"/>
                            </svg></button>
                          <input id="search" name="search" type="text" value="{{ $searched_word }}" placeholder="search here" class="form-control">
                   </form>
              </div>
              <div class="wiget-items categories">
                  <h6 class="widget-titles">{{ get_phrase('Categories') }}</h6>
                  <ul>
                    @foreach($blog_categories as $blog_category)
                      @php $blog_count = count($blog_category->blogCategory_to_blog()->get()); @endphp
                        <li>
                          <form id="bCategory_form-{{ $blog_category->id }}" method="get" action="{{ route('blogGrid') }}">
                            <input type="hidden" id="category" name="category" value="{{ $blog_category->id }}" />
                            <a href="javascript:{}" onclick="document.getElementById('bCategory_form-{{ $blog_category->id }}').submit();">
                              <p>{{ $blog_category->title }}</p>
                              <span>({{ $blog_count }})</span>
                            </a>
                          </form>
                        </li>
                      @endforeach
                  </ul>
              </div>
              <div class="wiget-items recent-posts-entry">
                <h6 class="widget-titles">{{ get_phrase('Recent Post') }}</h6>
                @foreach($latest_blogs as $latest)
                @php 
                $date = date('M d, Y', strtotime($latest->created_at)); 
                @endphp
                <a href="{{ route('blogDetails', ['slug' => slugify($latest->title), 'id' => $latest->id]) }}">
                  <div class="widget-post-bx">
                    <div class="widget-posts clearfix d-flex">
                      <div class="ttr-post-media"> <img src="{{ asset('public/uploads/blog/'.$latest->thumbnail) }}"  alt=""> </div>
                      <div class="ttr-post-info">
                        <div class="ttr-post-header">
                           <h6 class="post-titles">{{Str::limit($latest->title, 30) }}</h6>
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
                    @foreach($tags as $key => $tag)
                      <li><a href="{{ route('blogGrid', ['tag' => $tag]) }}">{{ $tag }}</a></li>
                    @endforeach
                  </ul>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- Blog Details Area End  -->
@endsection