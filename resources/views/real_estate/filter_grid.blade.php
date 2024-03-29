<div class="row">

    @php $counter=1 @endphp
    @forelse ($listings as $listing)
        @php
            $counter++;
            $image = json_decode($listing->gallery, true);
            if (!empty($image)) {
                $image = $image[0];
            } else {
                $image = 'nophoto';
            }
            $property_details = $listing->get_property_details($listing->listing_type_id, $listing->id);
        @endphp



        <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
            <!-- Single Product -->
            <a href="{{ route('singlePropertyView', ['slug' => $listing->slug, 'id' => $listing->id]) }}">
                <div class="product-entry">
                    <div class="product-img">
                        <span class="featured">{{ ucfirst($listing->type) }}</span>
                        <img src="{{ get_listing_image_or_video($listing->id, $image) }}" alt="" />
                        @php $wish_status=check_wishlist_status($listing->id);@endphp
                        <span id="grid_{{ $listing->id }}" class="wishlist {{ $wish_status }}"
                            onclick="wishlist_check('<?= $listing->id ?>'); return false;">
                            @if ($wish_status == 'active-color')
                                <i class="fa-solid fa-heart"></i>
                            @else
                                <i class="fa-regular fa-heart"></i>
                            @endif

                        </span>
                    </div>
                    <div class="product-details grid_list_p">
                        @php
                            if (strlen($listing->title) < 41) {
                                $title = $listing->title;
                            } else {
                                $title = substr($listing->title, 0, 30) . '...';
                            }
                            $location = ucfirst($listing->address);
                            
                            if (strlen($location) < 31) {
                                $location = $location;
                            } else {
                                $location = substr($location, 0, 30) . '...';
                            }
                        @endphp
                        <div class="list_price">
                            <div>
                                <div class="product-location  d-flex mb-0">
                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_164_877)">
                                            <path
                                                d="M15.3713 2.85199C13.9334 1.33418 12.0216 0.498291 9.9881 0.498291C7.95459 0.498291 6.04272 1.33418 4.60482 2.85199C3.1669 4.36985 2.375 6.38786 2.375 8.5343C2.375 12.8766 6.26462 16.4882 8.35428 18.4285C8.64467 18.6982 8.89544 18.931 9.09524 19.128C9.34555 19.3748 9.66684 19.4983 9.98807 19.4983C10.3094 19.4983 10.6306 19.3748 10.8809 19.128C11.0807 18.931 11.3315 18.6982 11.6219 18.4285C13.7115 16.4882 17.6012 12.8766 17.6012 8.5343C17.6011 6.38786 16.8093 4.36985 15.3713 2.85199ZM10.9254 17.5929C10.6287 17.8684 10.3724 18.1064 10.1611 18.3147C10.0641 18.4104 9.91206 18.4104 9.81496 18.3147C9.6037 18.1064 9.34741 17.8684 9.05066 17.5929C7.08612 15.7688 3.42934 12.3733 3.42934 8.53434C3.42934 4.71697 6.37153 1.61131 9.98803 1.61131C13.6045 1.61131 16.5467 4.71697 16.5467 8.53434C16.5467 12.3733 12.89 15.7688 10.9254 17.5929Z"
                                                fill="#007BFF" />
                                            <path
                                                d="M9.98879 4.68933C8.13883 4.68933 6.63379 6.27795 6.63379 8.23069C6.63379 10.1834 8.13883 11.772 9.98879 11.772C11.8388 11.772 13.3438 10.1834 13.3438 8.23069C13.3438 6.27795 11.8388 4.68933 9.98879 4.68933ZM9.98879 10.659C8.72025 10.659 7.6882 9.56963 7.6882 8.23065C7.6882 6.89167 8.72025 5.80228 9.98879 5.80228C11.2573 5.80228 12.2894 6.89167 12.2894 8.23065C12.2894 9.56963 11.2573 10.659 9.98879 10.659Z"
                                                fill="#007BFF" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_164_877">
                                                <rect width="18" height="19" fill="white"
                                                    transform="translate(0.988281 0.498291)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p>{{ $location }}</p>
                                </div>
                                <h3 class="product-title mt-0 mb-0">{{ $title }}</h3>
                            </div>
                            <div class="antry_list_price">
                                <div>
                                    <div class="item-price-1">{{ currency($listing->price) }}</div>
                                </div>
                            </div>
                        </div>
                        <p class="l_text">{{Str::limit(strip_tags($listing->short_description), 80)}}</p>
                        <div class="product-meta d-flex justify-content-between align-items-center">
                            <div class="product-meta-item">
                                <img class="bed" src="{{ asset('public/assets/real-estate/images/double.png') }}" alt="">
                                <div><span class="number">{{ $listing->bedroom }}</span>
                                    {{ get_phrase('Bed') }}</div>
                            </div>
                            <div class="product-meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.2196 7.37785H1.92022V1.83965C1.92022 1.46518 2.24617 1.13669 2.6182 1.13669H3.9035C4.26634 1.13669 4.55844 1.45203 4.56152 1.83635C3.96193 1.99732 3.45766 2.58859 3.45766 3.21268V4.09302C3.45766 4.2737 3.59603 4.42151 3.76516 4.42151H5.91753C6.08666 4.42151 6.22502 4.2737 6.22502 4.09302V3.21271C6.22502 2.57873 5.75457 1.99732 5.17651 1.83965C5.17651 1.09071 4.60768 0.479736 3.90353 0.479736H2.61823C1.90794 0.479736 1.30527 1.10386 1.30527 1.83965V7.37785C0.797916 7.37455 0.385897 7.81474 0.382812 8.35673C0.382812 8.63922 0.493507 8.90529 0.690306 9.09252V10.8138C0.690306 12.1507 1.24686 13.2971 2.14778 14.0427L1.64352 15.1136C1.56664 15.2745 1.62815 15.4716 1.78189 15.5537C1.93256 15.6358 2.11705 15.5701 2.1939 15.4059L2.66744 14.3974C3.28857 14.7522 3.98346 14.9361 4.68761 14.9296H10.8373C11.5414 14.9361 12.2363 14.7522 12.8575 14.3974L13.331 15.4059C13.4079 15.5669 13.5924 15.6325 13.743 15.5537C13.8937 15.4749 13.9552 15.2745 13.8814 15.1136L13.3771 14.0394C14.278 13.297 14.8346 12.1474 14.8346 10.8105V9.08923C15.0283 8.90855 15.1421 8.64248 15.1421 8.36329C15.1421 7.81803 14.73 7.37785 14.2196 7.37785ZM4.86902 2.45063C5.23491 2.45063 5.61006 2.83495 5.61006 3.21271V3.76456H4.07262V3.21271C4.07262 2.8481 4.48773 2.45063 4.86902 2.45063ZM14.2196 10.8138C14.2196 12.788 12.7652 14.276 10.8373 14.276H4.68758C2.75966 14.276 1.30527 12.7879 1.30527 10.8138V9.34877H14.2196V10.8138ZM14.2196 8.69178H1.31449C1.16076 8.69178 1.02239 8.57353 1.00086 8.41256C0.973182 8.20892 1.12077 8.0348 1.30527 8.0348H14.2104C14.3641 8.0348 14.5025 8.15305 14.524 8.31402C14.5517 8.5177 14.4041 8.69178 14.2196 8.69178Z"
                                        fill="#007BFF" />
                                </svg>

                                <div><span class="number">{{ $listing->bathroom }}</span>
                                    {{ get_phrase('Bat') }}</div>
                            </div>
                            <div class="product-meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.8237 1.52173H4.97971C4.88797 1.52173 4.79998 1.55823 4.73511 1.6232C4.67023 1.68817 4.63379 1.77629 4.63379 1.86817C4.63379 1.96006 4.67023 2.04818 4.73511 2.11315C4.79998 2.17812 4.88797 2.21462 4.97971 2.21462H12.8237C13.0179 2.21481 13.2041 2.29216 13.3415 2.42969C13.4788 2.56722 13.5561 2.75371 13.5563 2.94822V10.8044C13.5563 10.8962 13.5928 10.9844 13.6576 11.0493C13.7225 11.1143 13.8105 11.1508 13.9022 11.1508C13.994 11.1508 14.082 11.1143 14.1468 11.0493C14.2117 10.9844 14.2482 10.8962 14.2482 10.8044V2.94822C14.2477 2.57 14.0975 2.2074 13.8305 1.93996C13.5634 1.67253 13.2014 1.52212 12.8237 1.52173Z"
                                        fill="#007BFF" />
                                    <path
                                        d="M13.0684 11.9352C13.0025 11.8722 12.9149 11.8371 12.8239 11.8371C12.7328 11.8371 12.6452 11.8722 12.5793 11.9352C12.5472 11.9674 12.5217 12.0055 12.5043 12.0476C12.4869 12.0896 12.4779 12.1346 12.4779 12.1801C12.4779 12.2256 12.4869 12.2707 12.5043 12.3127C12.5217 12.3547 12.5472 12.3929 12.5793 12.4251L13.0673 12.9137H3.60608C3.4119 12.9135 3.22574 12.8361 3.08844 12.6986C2.95114 12.5611 2.87392 12.3746 2.87371 12.1801V2.70455L3.36151 3.1932C3.42741 3.25618 3.515 3.29132 3.60609 3.29132C3.69717 3.29132 3.78476 3.25618 3.85066 3.1932C3.88279 3.16104 3.90828 3.12286 3.92566 3.08083C3.94305 3.0388 3.952 2.99375 3.952 2.94826C3.952 2.90276 3.94305 2.85771 3.92566 2.81568C3.90828 2.77365 3.88279 2.73547 3.85066 2.70331L2.77236 1.62326C2.70646 1.56028 2.61888 1.52515 2.52779 1.52515C2.4367 1.52515 2.34911 1.56028 2.28321 1.62326L1.20469 2.70331C1.1399 2.76831 1.10352 2.85641 1.10352 2.94826C1.10352 3.0401 1.1399 3.1282 1.20469 3.1932C1.27059 3.25618 1.35818 3.29132 1.44927 3.29132C1.54035 3.29132 1.62794 3.25618 1.69384 3.1932L2.18187 2.70455V12.1801C2.18228 12.5583 2.33246 12.9209 2.59946 13.1883C2.86646 13.4558 3.22847 13.6062 3.60608 13.6066H13.0673L12.5793 14.0953C12.5472 14.1275 12.5217 14.1656 12.5043 14.2077C12.4869 14.2497 12.478 14.2947 12.478 14.3402C12.478 14.3857 12.4869 14.4308 12.5043 14.4728C12.5217 14.5148 12.5472 14.553 12.5793 14.5852C12.6114 14.6174 12.6495 14.6429 12.6915 14.6603C12.7335 14.6777 12.7784 14.6866 12.8239 14.6866C12.8693 14.6866 12.9143 14.6777 12.9562 14.6603C12.9982 14.6429 13.0363 14.6174 13.0684 14.5852L14.147 13.5051C14.1791 13.473 14.2046 13.4348 14.222 13.3928C14.2393 13.3507 14.2483 13.3057 14.2483 13.2602C14.2483 13.2147 14.2393 13.1696 14.222 13.1276C14.2046 13.0856 14.1791 13.0474 14.147 13.0152L13.0684 11.9352Z"
                                        fill="#007BFF" />
                                    <path
                                        d="M9.23441 10.4509C9.32613 10.4508 9.41406 10.4143 9.47891 10.3494C9.54376 10.2844 9.58023 10.1963 9.58033 10.1045V6.76342C9.58099 6.49573 9.50051 6.23414 9.34954 6.01324C9.19857 5.79234 8.98422 5.62252 8.73482 5.52624C8.48542 5.42996 8.21272 5.41175 7.95276 5.47402C7.69281 5.53629 7.45784 5.6761 7.27893 5.87498C7.15534 5.73796 7.00454 5.6283 6.8362 5.55301C6.66785 5.47772 6.48567 5.43847 6.3013 5.43775C6.07976 5.43769 5.86195 5.49486 5.66892 5.60376C5.6646 5.51344 5.62519 5.4284 5.55911 5.36679C5.49303 5.30518 5.40552 5.27189 5.31526 5.27402C5.225 5.27616 5.13916 5.31355 5.07606 5.37821C5.01296 5.44288 4.9776 5.52969 4.97754 5.62011V10.1045C4.97754 10.1964 5.01398 10.2845 5.07886 10.3495C5.14373 10.4144 5.23172 10.4509 5.32346 10.4509C5.4152 10.4509 5.50319 10.4144 5.56806 10.3495C5.63293 10.2845 5.66938 10.1964 5.66938 10.1045V6.76342C5.6697 6.59581 5.73641 6.43517 5.85486 6.31676C5.97332 6.19835 6.13384 6.13185 6.3012 6.13185C6.46856 6.13185 6.62908 6.19835 6.74754 6.31676C6.86599 6.43517 6.9327 6.59581 6.93302 6.76342V10.1045C6.93302 10.1964 6.96947 10.2845 7.03434 10.3495C7.09921 10.4144 7.1872 10.4509 7.27894 10.4509C7.37069 10.4509 7.45867 10.4144 7.52354 10.3495C7.58842 10.2845 7.62486 10.1964 7.62486 10.1045V6.76342C7.62486 6.5956 7.69143 6.43465 7.80992 6.31598C7.92841 6.19731 8.08911 6.13064 8.25668 6.13064C8.42425 6.13064 8.58496 6.19731 8.70345 6.31598C8.82194 6.43465 8.88851 6.5956 8.88851 6.76342V10.1045C8.88861 10.1963 8.92508 10.2844 8.98993 10.3494C9.05478 10.4143 9.1427 10.4508 9.23441 10.4509Z"
                                        fill="#007BFF" />
                                    <path
                                        d="M11.9304 5.63728L11.9854 5.56228C12.0993 5.39437 12.1602 5.19609 12.1603 4.99311C12.1603 4.72149 12.0526 4.46101 11.8608 4.26895C11.6691 4.07689 11.409 3.96899 11.1378 3.96899C10.8666 3.96899 10.6065 4.07689 10.4147 4.26895C10.223 4.46101 10.1152 4.72149 10.1152 4.99311C10.1152 5.08499 10.1517 5.17311 10.2166 5.23808C10.2814 5.30305 10.3694 5.33955 10.4612 5.33955C10.5529 5.33955 10.6409 5.30305 10.7058 5.23808C10.7706 5.17311 10.8071 5.08499 10.8071 4.99311C10.8074 4.94278 10.8191 4.89319 10.8414 4.84809C10.8637 4.80299 10.8959 4.76357 10.9357 4.73282C10.9755 4.70207 11.0217 4.68079 11.0709 4.67062C11.1201 4.66044 11.171 4.66163 11.2197 4.67409C11.2684 4.68655 11.3136 4.70995 11.3519 4.74252C11.3902 4.77509 11.4205 4.81597 11.4407 4.86206C11.4609 4.90815 11.4703 4.95824 11.4682 5.00852C11.4662 5.0588 11.4527 5.10795 11.4289 5.15224L10.3506 6.31157C10.2925 6.37363 10.2538 6.45135 10.2392 6.53517C10.2246 6.61898 10.2349 6.70523 10.2686 6.7833C10.3023 6.86138 10.3581 6.92787 10.4291 6.97459C10.5001 7.02132 10.5832 7.04624 10.6681 7.0463H11.793C11.8848 7.0463 11.9728 7.0098 12.0376 6.94483C12.1025 6.87985 12.139 6.79173 12.139 6.69985C12.139 6.60797 12.1025 6.51985 12.0376 6.45488C11.9728 6.38991 11.8848 6.35341 11.793 6.35341H11.2611L11.9052 5.66751C11.914 5.65791 11.9225 5.64776 11.9304 5.63728Z"
                                        fill="#007BFF" />
                                </svg>

                                <div><span class="number">{{ $listing->area }}</span>
                                    {{ get_phrase('Sqft') }}</div>
                            </div>
                        </div>

                    </div>

                </div>
            </a>
        </div>


    @empty

        @include('no_data_found')
    @endforelse


</div>

@if (Auth::check())
    <script>
        "use strict";

        function wishlist_check(listing_id) {
            let url = "{{ route('checkWishlist') }}";
            var list = '#list_' + listing_id;
            var grid = '#grid_' + listing_id;

            $.ajax({
                url: url,
                data: {
                    listing_id: listing_id
                },
                success: function(response) {
                    console.log(response);

                    if (response == 1) {
                        $(grid).html('<i class="fa-solid fa-heart"></i>');
                        $(list).html('<i class="fa-solid fa-heart"></i>');
                        $(list).addClass('active-color');
                        $(grid).addClass('active-color');
                        toastr.success("Item Add To Wishlist!");
                    } else if (response == 0) {
                        $(grid).html('<i class="fa-regular fa-heart"></i>');
                        $(list).html('<i class="fa-regular fa-heart"></i>');
                        $(list).removeClass('active-color');
                        $(grid).removeClass('active-color');
                        toastr.success("Item Remove To Wishlist!");
                    }
                }
            });
        }
    </script>
@else
    <script>
        "use strict";
        
        function wishlist_check(listing_id) {
            toastr.error("Please log in first");
        }
    </script>
@endif
