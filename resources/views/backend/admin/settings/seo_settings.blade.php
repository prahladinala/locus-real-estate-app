@extends('backend.index')

@section('content')

<style type="text/css">
.bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white !important;
    background-color: #0d6efd;
    padding: 0.2rem;
    border-radius: 5px;
}
.og_image img {
    height: 48px;
    object-fit: cover;
    width: 86px;
    border-radius: 5px 5px 0 0;
}
</style>

<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gr-15">
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('SEO Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('SEO Settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="eSection-wrap">
            <div class="title">
                <h3>{{get_phrase('Manage SEO Settings')}}</h3>
            </div>
            <div class="eMain">
                <div class="row">
                    <div class="col-md-12 pb-3">
                        <div class="d-flex flex-column flex-md-row align-items-start vTabs-gap">
                            <div class="nav flex-row flex-md-column nav-pills eNav-Tabs-vertical" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($seo_meta_tags as $seo_meta_tag)
                                    <button class="nav-link @if($active_tab == $seo_meta_tag->route) active @endif" id="v-pills-v{{ $seo_meta_tag->route }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-v{{ $seo_meta_tag->route }}" type="button" role="tab" aria-controls="v-pills-v{{ $seo_meta_tag->route }}" aria-selected="false" >
                                        {{ $seo_meta_tag->route }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="tab-content eNav-Tabs-content" id="v-pills-tabContent">
                                @foreach($seo_meta_tags as $seo_meta_tag)
                                <div class="tab-pane fade @if($active_tab == $seo_meta_tag->route) show active @endif" id="v-pills-v{{ $seo_meta_tag->route }}" role="tabpanel" aria-labelledby="v-pills-v{{ $seo_meta_tag->route }}-tab">
                                    <div class="col-12 pb-3">
                                        <form class="eForm-sizing" action="{{ route('admin.seo.update', ['route' => $seo_meta_tag->route]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="fpb-7">
                                                <label for="title" class="eForm-label">{{ get_phrase('Title') }}</label>
                                                <input class="form-control eForm-control" id="title" name="title" type="text" value="{{ $seo_meta_tag->title }}" placeholder="Meta Title"/>
                                            </div>
                                            <div class="fpb-7">
                                                <label for="keywords" class="eForm-label">{{ get_phrase('Keywords') }}</label>
                                                <input type="text" class="form-control eForm-control" data-role="tagsinput" id = "keywords" name="keywords" value="{{ $seo_meta_tag->keywords }}"/>
                                                <small class="eForm-label text-muted">{{ get_phrase('Click the enter button after writing your keyword') }}</small>
                                            </div>
                                            <div class="fpb-7">
                                                <label for="description" class="eForm-label">{{ get_phrase('Description') }}</label>
                                                <Textarea class="form-control eForm-control" id="description" name="description" type="text" placeholder="Meta Description">{{ $seo_meta_tag->description }}</Textarea>
                                            </div>
                                            <div class="fpb-7">
                                                <label for="og_title" class="eForm-label">{{ get_phrase('Og Title') }}</label>
                                                <input type="text" class="form-control eForm-control" data-role="tagsinput" id = "og_title" name="og_title" value="{{ $seo_meta_tag->og_title }}"/>
                                            </div>
                                            <div class="fpb-7">
                                                <label for="canonical " class="eForm-label">{{ get_phrase(' Canonical Url') }}</label>
                                                <input type="text" class="form-control eForm-control" data-role="tagsinput" id = "canonical " name="canonical" placeholder="https://example.com/dresses/cocktail?gclid=ABCD." value="{{ $seo_meta_tag->canonical  }}"/>
                                            </div>
                                            <div class="fpb-7">
                                                <label for="og_description" class="eForm-label">{{ get_phrase('Og Description') }}</label>
                                                <Textarea class="form-control eForm-control" id="og_description" name="og_description" type="text">{{ $seo_meta_tag->og_description }}</Textarea>
                                            </div>
                                            <div class="fpb-7">
                                                <label for="og_image" class="eForm-label">{{ get_phrase('Og Image') }}</label>
                                                <div class="og_image">
                                                    @if($seo_meta_tag->og_image)
                                                    <img src="{{ asset('public/uploads/seo/'.$seo_meta_tag->og_image) }}" alt="....">
                                                    @else
                                                    <img src="{{ asset('public/uploads/blog/placeholder.jpg') }}" alt="...">
                                                    @endif
                                                 </div>
                                                <input type="file" class="form-control eForm-control" id = "og_image" name="og_image" value="{{ $seo_meta_tag->og_image }}"/>
                                                <input type="hidden" name="old_og_image" value="{{$seo_meta_tag->og_image}}">
                                            </div>
                                            <div class="fpb-7">
                                                <label for="json_ld" class="eForm-label">{{ get_phrase('Json Id') }}</label>
                                                <Textarea class="form-control eForm-control" id="json_ld" name="json_ld" placeholder='<script src="https://cdn.jsdelivr.net/npm/json ld"></script>'>{{ $seo_meta_tag->json_ld }}</Textarea>
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn-form">{{ get_phrase('Submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<script>
    "Use strict";
    function activeTab() {
        $(this).toggleClass("active");
    }
</script>