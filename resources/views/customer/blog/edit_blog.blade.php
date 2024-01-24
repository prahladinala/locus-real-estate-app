
<style>
    .og_image img {
        width: 100px;
        height: 66px;
        object-fit: cover;
        border-radius: 5px 5px 0 0;
   }
   .blog-sidebar-right textarea {
       height: 147px;
   }
</style>

<div class="col-lg-12">
    <div class="blog-sidebar-right">
        <div class="send-message-box">
            <div class="d-flex justify-content-end align-items-center flex-wrap g-12 mb-16">
                <a href="{{ route('blogList') }}" class="frontend-btn cg-10"><i class="fa-solid fa-arrow-left"></i> {{ get_phrase('Go Back') }}</a>
                <!-- Button -->
                <a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}" target="_blank" class="back-listing cg-10">{{ get_phrase('View on frontend') }} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="d-flex flex-wrap g-12 mb-16">
                <div class="tableTitle-3">
                    <h4 class="fz-24-sb-black">{{ get_phrase('Edit blog') }}</h4>
                </div>
            </div>
            <form action="{{ route('blogUpdate', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-20">
                    <label for="title" class="form-label">{{ get_phrase('Title') }}*</label>
                    <input type="text" id="title" class="form-control" placeholder="Enter blog title" name="title" value="{{ $blog->title }}" required>
                </div>
                <div class="mb-20">
                    <label for="blog_category_id" class="form-label">{{ get_phrase('Category') }}*</label>
                    <select name="blog_category_id" id="blog_category_id" class="form-select" required>
                        <option value="">{{ get_phrase("Select a category") }}</option>
                        @foreach($blog_categories as $blog_category)
                            <option value="{{ $blog_category->id }}" @if($blog_category->id == $blog->blog_category_id) selected @endif>{{ $blog_category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-20">
                    <label for="keywords" class="form-label">{{ get_phrase('Keywords') }}</label>
                    <input type="text" id="keywords" class="form-control" name="keywords" value="{{ $blog->keywords }}">
                </div>
                <div class="mb-20">
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Write something...">{{ $blog->description }}</textarea>
                </div>
                <div class="mb-21 blog-img-show">
                    <h5>{{ get_phrase('Blog thumbnail') }}</h5>
                    <div class="card overflow-hidden">
                        
                        @if($blog->thumbnail)
                        <img  id="file-ip-1-preview" class="img-fluied" src="{{ asset('public/uploads/blog/'.$blog->thumbnail) }}" alt="img" name="image" >
                        @else
                        <img class="w-100" src="{{ asset('public/uploads/blog/placeholder.jpg') }}" 
                            alt="...">
                        @endif
                         <div class="card-body">
                            <label for="file-ip-1" class="form-label">
                                <span><i class="fa-solid fa-camera"></i> {{ get_phrase('Choose a thumbnail') }}</span>
                                <p>{{get_phrase('(2000 x 1200)')}}</p>
                             </label>
                             <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);"  class="form-control d-none" name="thumbnail" id="thumbnail" >
                             <input class="form-control eForm-control-file" type="hidden" name="old_thumbnail"  value="{{$blog->thumbnail}}">
                         </div>
                    </div>
                </div>
                <div class="mb-20">
                    <label for="meta_title" class="form-label">{{ get_phrase('Meta Title') }}</label>
                    <input type="text" id="meta_title" class="form-control" placeholder="Enter meta title" name="meta_title" value="{{ $blog->meta_title }}">
                </div>
                <div class="mb-20">
                    <label for="meta_keywords" class="form-label">{{ get_phrase('Meta keywords') }}</label>
                    <input type="text" id="meta_keywords" class="form-control" placeholder="Enter meta keywords" name="meta_keywords" value="{{ $blog->meta_keywords }}">
                </div>
                <div class="mb-20">
                    <label for="meta_description" class="form-label">{{ get_phrase('Meta Description') }}</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" placeholder="Type your description">{{ $blog->meta_description }}</textarea>
                </div>
                <div class="mb-20">
                    <label for="og_title" class="eForm-label">{{ get_phrase('Og Title') }}</label>
                    <input type="text" class="form-control " data-role="tagsinput" id = "og_title" name="og_title" value="{{ $blog->og_title }}"/>
                </div>
                <div class="mb-20">
                    <label for="canonical " class="eForm-label">{{ get_phrase(' Canonical Url') }}</label>
                     <input type="text" class="form-control eForm-control" data-role="tagsinput" id = "canonical " name="canonical" value="{{ $blog->canonical  }}"/>
                </div>
                <div class="mb-20">
                    <label for="og_description" class="eForm-label">{{ get_phrase('Og Description') }}</label>
                    <Textarea class="form-control " id="og_description" name="og_description" type="text">{{ $blog->og_description }}</Textarea>
                </div>
                <div class="mb-20">
                    <label for="og_image" class="eForm-label">{{ get_phrase('Og Image') }}</label>
                    <div class="og_image">
                        @if($blog->og_image)
                        <img src="{{ asset('public/uploads/seo/'.$blog->og_image) }}" alt="....">
                        @else
                        <img src="{{ asset('public/uploads/blog/placeholder.jpg') }}" alt="...">
                        @endif
                     </div>
                    <input type="file" class="form-control" id = "og_image" name="og_image" value="{{ $blog->og_image }}"/>
                    <input type="hidden" name="old_og_image" value="{{$blog->og_image}}">
                </div>
                <div class="mb-20">
                    <label for="json_ld" class="eForm-label">{{ get_phrase('Json Id') }}</label>
                    <Textarea class="form-control eForm-control" id="json_ld" name="json_ld" placeholder='<script src="https://cdn.jsdelivr.net/npm/json ld"></script>'>{{ $blog->json_ld }}</Textarea>
                </div>
                <div class="mt-30">
                    <button type="submit" class="eBtn saveChanges-btn">{{ get_phrase('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    "use strict";

    $(document).ready(function () {
        $('#description').summernote({
            height: 330,
        });
    });

</script>