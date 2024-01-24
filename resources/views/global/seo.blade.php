    @php

    use Illuminate\Support\Facades\Request;
    use App\Models\SeoMetaTag;
    use App\Models\Blog;
    use App\Models\Listing;
    use App\Models\Listing_arrtibute_type;

    $sea_meta_tag = null;
    $route = request()->route();

    if ($route && !empty($route->getName()) && in_array($route->getName(), ['home', 'realeStateListings', 'subscriptionPackages', 'blogGrid', 'contactUs', 'login', 'register', 'password.request'])) {
        $sea_meta_tag = SeoMetaTag::where('name_route', $route->getName())->first();

        $meta_title = $sea_meta_tag ? $sea_meta_tag->title : '';
        $meta_keywords = $sea_meta_tag ? $sea_meta_tag->keywords : '';
        $meta_description = $sea_meta_tag ? $sea_meta_tag->description : '';
        $og_title = $sea_meta_tag ? $sea_meta_tag->og_title : '';
        $og_description = $sea_meta_tag ? $sea_meta_tag->og_description : '';
        $og_image = $sea_meta_tag ? $sea_meta_tag->og_image : '';
        $json_ld = $sea_meta_tag ? $sea_meta_tag->json_ld : '';
        $canonical = $sea_meta_tag ? $sea_meta_tag->canonical : '';
    } 
    elseif($route && !empty($route->getName()) && $route->getName() == 'blogDetails'){
        $sea_meta_tag = Blog::find($blog_details->id);

        $meta_title = $sea_meta_tag ? $sea_meta_tag->meta_title : '';
        $meta_keywords = $sea_meta_tag ? $sea_meta_tag->meta_keywords : '';
        $meta_description = $sea_meta_tag ? $sea_meta_tag->meta_description : '';

        $og_title = $sea_meta_tag ? $sea_meta_tag->og_title : '';
        $og_description = $sea_meta_tag ? $sea_meta_tag->og_description : '';
        $og_image = $sea_meta_tag ? $sea_meta_tag->og_image : '';
        $json_ld = $sea_meta_tag ? $sea_meta_tag->json_ld : '';
        $canonical = $sea_meta_tag ? $sea_meta_tag->canonical : '';

    } 
    elseif($route && !empty($route->getName()) && $route->getName() == 'singlePropertyView') 
    {
        $sea_meta_tag = Listing::find($listing->id);

        $meta_title = $sea_meta_tag ? $sea_meta_tag->meta_title : '';
        $meta_keywords = $sea_meta_tag ? $sea_meta_tag->meta_keywords : '';
        $meta_description = $sea_meta_tag ? $sea_meta_tag->meta_description : '';

        $og_title = $sea_meta_tag ? $sea_meta_tag->og_title : '';
        $og_description = $sea_meta_tag ? $sea_meta_tag->og_description : '';
        $og_image = $sea_meta_tag ? $sea_meta_tag->og_image : '';
        $json_ld = $sea_meta_tag ? $sea_meta_tag->json_ld : '';
        $canonical = $sea_meta_tag ? $sea_meta_tag->canonical : '';
    }
    elseif ($route && !empty($route->getName()) && $route->getName() == 'realeStateListingsFilter') {
            if (isset($type) && $type != '') {

                $sea_meta_tag = Listing_arrtibute_type::where('type', $type)->first();

                $meta_title = $sea_meta_tag ? $sea_meta_tag->meta_title : '';
                $meta_keywords = $sea_meta_tag ? $sea_meta_tag->meta_keywords : '';
                $meta_description = $sea_meta_tag ? $sea_meta_tag->meta_description : '';

                $og_title = $sea_meta_tag ? $sea_meta_tag->og_title : '';
                $og_description = $sea_meta_tag ? $sea_meta_tag->og_description : '';
                $og_image = $sea_meta_tag ? $sea_meta_tag->og_image : '';
                $json_ld = $sea_meta_tag ? $sea_meta_tag->json_ld : '';
                $canonical = $sea_meta_tag ? $sea_meta_tag->canonical : '';
            }else{
                $meta_title = $sea_meta_tag ? $sea_meta_tag->meta_title : '';
                $meta_keywords = $sea_meta_tag ? $sea_meta_tag->meta_keywords : '';
                $meta_description = $sea_meta_tag ? $sea_meta_tag->meta_description : '';

                $og_title = $sea_meta_tag ? $sea_meta_tag->og_title : '';
                $og_description = $sea_meta_tag ? $sea_meta_tag->og_description : '';
                $og_image = $sea_meta_tag ? $sea_meta_tag->og_image : '';
                $json_ld = $sea_meta_tag ? $sea_meta_tag->json_ld : '';
                $canonical = $sea_meta_tag ? $sea_meta_tag->canonical : '';
            }
    }
    else{
        $meta_title = $sea_meta_tag ? $sea_meta_tag->title : '';
        $meta_keywords = $sea_meta_tag ? $sea_meta_tag->keywords : '';
        $meta_description = $sea_meta_tag ? $sea_meta_tag->description : '';

        $og_title = $sea_meta_tag ? $sea_meta_tag->og_title : '';
        $og_description = $sea_meta_tag ? $sea_meta_tag->og_description : '';
        $og_image = $sea_meta_tag ? $sea_meta_tag->og_image : '';
        $json_ld = $sea_meta_tag ? $sea_meta_tag->json_ld : '';
        $canonical = $sea_meta_tag ? $sea_meta_tag->canonical : '';
       
    }

    
    @endphp


    <!-- take variable values from seo table -->
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_description }}">
    <meta name="og:title" content="{{ $og_title }}">
    <meta name="og:description" content="{{ $og_description }}">
    <link rel="canonical" href="{{ $canonical }}"/>
    <meta name="og:image" content="{{ asset('public/uploads/seo/'.$og_image) }}">
    <title>{{ get_phrase($meta_title) }}</title>
    {!! $json_ld !!}
    



    



