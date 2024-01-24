@php
    $shools = json_decode($nearby_schools);
    $shopping_centers = json_decode($nearby_shopping_centers);
    $hospitals = json_decode($nearby_hospitals);
    $parks = json_decode($nearby_parks);
@endphp
<style>
    #map {
      height: 550px;
      width: 100%;
    }
    .map-view{
        height: 450px;
        width: 100%;
    }
</style>

<div class="row section-margin-top">
    <div class="col-lg-12">
        <div class="nearby-area">
            <h3 class="rl-title f-28">{{ get_phrase('Nearby') }}</h3>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="map-item map_a_new">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#real" onclick="changeView({{ $nearby_schools }}, '1')">
                            <svg width="99" height="98" viewBox="0 0 99 98" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M98.3804 49.6811C98.3804 44.3428 94.016 40.0167 88.6305 40.0167H76.2216C74.7538 40.0167 73.5625 41.1975 73.5625 42.6525V94.7312C73.5625 96.1861 74.7538 97.3669 76.2216 97.3669H92.176C95.6044 97.3669 98.3804 94.6117 98.3804 91.2168V49.6811ZM78.8806 45.2882V92.0954H92.176C92.6652 92.0954 93.0623 91.7018 93.0623 91.2168V49.6811C93.0623 47.2562 91.0769 45.2882 88.6305 45.2882H78.8806Z" fill="#007BFF"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.6988 42.6525C25.6988 41.1975 24.5075 40.0167 23.0397 40.0167H10.6308C5.24527 40.0167 0.880859 44.3428 0.880859 49.6811V91.2168C0.880859 94.6117 3.65692 97.3669 7.08534 97.3669H23.0397C24.5075 97.3669 25.6988 96.1861 25.6988 94.7312V42.6525ZM20.3807 45.2882H10.6308C8.18442 45.2882 6.19899 47.2562 6.19899 49.6811V91.2168C6.19899 91.7018 6.59608 92.0954 7.08534 92.0954H20.3807V45.2882Z" fill="#007BFF"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M67.3569 0.723145C68.8247 0.723145 70.0159 1.90396 70.0159 3.35888V13.9018C70.0159 15.3568 68.8247 16.5376 67.3569 16.5376H52.2888V20.6423C52.2888 22.0972 51.0976 23.278 49.6298 23.278C48.162 23.278 46.9707 22.0972 46.9707 20.6423V3.35888C46.9707 1.90396 48.162 0.723145 49.6298 0.723145H67.3569Z" fill="#007BFF"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M34.5554 97.3669H23.0399C21.5721 97.3669 20.3809 96.1861 20.3809 94.7312V42.8141C20.3809 39.6688 21.9267 36.7168 24.5255 34.9069C29.3082 31.5753 38.6469 25.0703 44.0253 21.3241C47.3899 18.98 51.8713 18.98 55.2359 21.3241C60.6143 25.0703 69.9529 31.5753 74.7357 34.9069C77.3345 36.7168 78.8803 39.6688 78.8803 42.8141V94.7312C78.8803 96.1861 77.689 97.3669 76.2212 97.3669H64.7057V75.7222C64.7057 73.1568 63.6775 70.7003 61.8481 68.8869C60.0222 67.0735 57.5404 66.0578 54.9558 66.0578H44.3053C41.7207 66.0578 39.2389 67.0735 37.4131 68.8869C35.5836 70.7003 34.5554 73.1568 34.5554 75.7222V97.3669ZM39.8736 97.3669V75.7222C39.8736 74.5555 40.3416 73.4379 41.1712 72.6156C42.0044 71.7897 43.1318 71.3293 44.3053 71.3293H54.9558C56.1293 71.3293 57.2568 71.7897 58.0899 72.6156C58.9196 73.4379 59.3876 74.5555 59.3876 75.7222V97.3669H39.8736ZM49.6306 34.1373C43.77 34.1373 39.0085 38.857 39.0085 44.6662C39.0085 50.4789 43.77 55.1951 49.6306 55.1951C55.4911 55.1951 60.2526 50.4789 60.2526 44.6662C60.2526 38.857 55.4911 34.1373 49.6306 34.1373ZM49.6306 39.4088C52.5591 39.4088 54.9345 41.7634 54.9345 44.6662C54.9345 47.569 52.5591 49.9236 49.6306 49.9236C46.7021 49.9236 44.3266 47.569 44.3266 44.6662C44.3266 41.7634 46.7021 39.4088 49.6306 39.4088Z" fill="#007BFF"/>
                                    </svg>

                            <span>{{ get_phrase('School') }}
                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00882 4.43439H12.8374L10.3329 1.5979C10.2615 1.51775 10.2049 1.42239 10.1662 1.31733C10.1276 1.21227 10.1077 1.09958 10.1077 0.985765C10.1077 0.87195 10.1276 0.759261 10.1662 0.6542C10.2049 0.549138 10.2615 0.453782 10.3329 0.373634C10.4755 0.213056 10.6684 0.122925 10.8696 0.122925C11.0707 0.122925 11.2636 0.213056 11.4062 0.373634L14.672 4.08091C14.9579 4.4028 15.1194 4.83997 15.1211 5.29655C15.1174 5.75014 14.956 6.1838 14.672 6.50357L11.4062 10.2108C11.3353 10.2907 11.2511 10.3539 11.1585 10.3969C11.066 10.4398 10.9669 10.4618 10.8669 10.4614C10.7668 10.461 10.6679 10.4382 10.5756 10.3945C10.4833 10.3508 10.3995 10.2869 10.3291 10.2065C10.2586 10.1261 10.2028 10.0308 10.1648 9.92601C10.1269 9.8212 10.1075 9.70895 10.1079 9.59567C10.1082 9.48238 10.1283 9.37029 10.1669 9.26578C10.2055 9.16128 10.2619 9.0664 10.3329 8.98658L12.8374 6.15871H1.00882C0.80693 6.15871 0.613305 6.06787 0.470544 5.90619C0.327783 5.7445 0.247584 5.52521 0.247584 5.29655C0.247584 5.06789 0.327783 4.8486 0.470544 4.68691C0.613305 4.52523 0.80693 4.43439 1.00882 4.43439Z" fill="white"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="map-item map_a_new">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#real" onclick="changeView({{ $nearby_shopping_centers }}, '2')">
                        <svg width="96" height="94" viewBox="0 0 96 94" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_209_547)">
                            <path d="M88.6445 5.37622H54.1328C50.5519 5.37622 47.6387 8.05285 47.6387 11.3429V47.8854C49.0119 48.2535 50.3653 48.6936 51.6944 49.2102C56.1139 50.9277 60.082 53.3853 63.4883 56.5149C66.8945 59.6445 69.5694 63.2903 71.4388 67.3508C72.9337 70.5982 73.8572 74.0004 74.2017 77.4994C77.4774 78.2077 79.9238 80.9133 79.9238 84.1358V85.8406C79.9238 88.3747 79.057 90.725 77.5852 92.6596H88.6445C92.2254 92.6596 95.1387 89.9829 95.1387 86.6929V11.3429C95.1387 8.05285 92.2254 5.37622 88.6445 5.37622ZM81.8721 33.3342C83.4091 33.3342 84.6553 34.4791 84.6553 35.8913C84.6553 37.3035 83.4091 38.4484 81.8721 38.4484H60.9053C59.3682 38.4484 58.1221 37.3035 58.1221 35.8913C58.1221 34.4791 59.3682 33.3342 60.9053 33.3342H81.8721ZM65.1729 20.5485C65.1729 19.1363 66.419 17.9914 67.9561 17.9914H74.8213C76.3584 17.9914 77.6045 19.1363 77.6045 20.5485C77.6045 21.9607 76.3584 23.1056 74.8213 23.1056H67.9561C66.419 23.1056 65.1729 21.9607 65.1729 20.5485ZM60.9053 48.6769C59.3682 48.6769 58.1221 47.532 58.1221 46.1198C58.1221 44.7076 59.3682 43.5627 60.9053 43.5627H81.8721C83.4091 43.5627 84.6553 44.7076 84.6553 46.1198C84.6553 47.532 83.4091 48.6769 81.8721 48.6769H60.9053Z" fill="#007BFF"/>
                            <path d="M34.4643 49.9494C19.5378 51.2408 7.59344 62.8175 5.91016 77.4765H68.5849C66.9016 62.8175 54.9572 51.2408 40.0307 49.9494V44.4205V44.0283H42.1079C43.645 44.0283 44.8911 42.7953 44.8911 41.2744C44.8911 39.7535 43.645 38.5205 42.1079 38.5205H32.387C30.8499 38.5205 29.6038 39.7535 29.6038 41.2744C29.6038 42.7953 30.8499 44.0283 32.387 44.0283H34.4643V44.4205V49.9494ZM25.8999 64.6387C23.7835 66.1124 22.0203 68.0813 20.8012 70.3327C20.2995 71.2593 19.3384 71.7864 18.3457 71.7864C17.9019 71.7864 17.4521 71.6812 17.0335 71.4594C15.6786 70.741 15.1689 69.072 15.8948 67.7314C17.5219 64.7269 19.8739 62.1 22.6968 60.1344C23.9531 59.2591 25.6898 59.5578 26.5745 60.8018C27.4588 62.0455 27.1569 63.7634 25.8999 64.6387ZM35.3921 61.6676C34.7872 61.6676 34.1779 61.7003 33.5811 61.7648C33.4783 61.776 33.3763 61.7813 33.2755 61.7813C31.8739 61.7813 30.6679 60.7365 30.5122 59.3261C30.3454 57.8142 31.4486 56.4545 32.9766 56.2894C33.7734 56.2033 34.5861 56.1596 35.3921 56.1596C36.9291 56.1596 38.1753 57.3927 38.1753 58.9135C38.1753 60.4344 36.9291 61.6676 35.3921 61.6676Z" fill="#007BFF"/>
                            <path d="M74.3574 86.6562V84.8203C74.3574 83.8063 73.5267 82.9844 72.502 82.9844H1.99414C0.969365 82.9844 0.138672 83.8063 0.138672 84.8203V86.6562C0.138672 90.712 3.46163 94 7.56055 94H54.1328H66.9355C71.0345 94 74.3574 90.712 74.3574 86.6562Z" fill="#007BFF"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_209_547">
                            <rect width="95" height="94" fill="white" transform="translate(0.138672)"/>
                            </clipPath>
                            </defs>
                            </svg>

                            <span>{{ get_phrase('Shopping Center') }}<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00882 4.43439H12.8374L10.3329 1.5979C10.2615 1.51775 10.2049 1.42239 10.1662 1.31733C10.1276 1.21227 10.1077 1.09958 10.1077 0.985765C10.1077 0.87195 10.1276 0.759261 10.1662 0.6542C10.2049 0.549138 10.2615 0.453782 10.3329 0.373634C10.4755 0.213056 10.6684 0.122925 10.8696 0.122925C11.0707 0.122925 11.2636 0.213056 11.4062 0.373634L14.672 4.08091C14.9579 4.4028 15.1194 4.83997 15.1211 5.29655C15.1174 5.75014 14.956 6.1838 14.672 6.50357L11.4062 10.2108C11.3353 10.2907 11.2511 10.3539 11.1585 10.3969C11.066 10.4398 10.9669 10.4618 10.8669 10.4614C10.7668 10.461 10.6679 10.4382 10.5756 10.3945C10.4833 10.3508 10.3995 10.2869 10.3291 10.2065C10.2586 10.1261 10.2028 10.0308 10.1648 9.92601C10.1269 9.8212 10.1075 9.70895 10.1079 9.59567C10.1082 9.48238 10.1283 9.37029 10.1669 9.26578C10.2055 9.16128 10.2619 9.0664 10.3329 8.98658L12.8374 6.15871H1.00882C0.80693 6.15871 0.613305 6.06787 0.470544 5.90619C0.327783 5.7445 0.247584 5.52521 0.247584 5.29655C0.247584 5.06789 0.327783 4.8486 0.470544 4.68691C0.613305 4.52523 0.80693 4.43439 1.00882 4.43439Z" fill="white"/>
                                </svg>
                                </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="map-item map_a_new">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#real" onclick="changeView({{ $nearby_hospitals }}, '3')">
                        <svg width="95" height="92" viewBox="0 0 95 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_209_551)">
                            <path d="M53.1562 16.5312H50.4023V13.8359C50.4023 12.3461 49.1706 11.1406 47.6484 11.1406C46.1263 11.1406 44.8945 12.3461 44.8945 13.8359V16.5312H42.1406C40.6184 16.5312 39.3867 17.7368 39.3867 19.2266C39.3867 20.7164 40.6184 21.9219 42.1406 21.9219H44.8945V24.6172C44.8945 26.107 46.1263 27.3125 47.6484 27.3125C49.1706 27.3125 50.4023 26.107 50.4023 24.6172V21.9219H53.1562C54.6784 21.9219 55.9102 20.7164 55.9102 19.2266C55.9102 17.7368 54.6784 16.5312 53.1562 16.5312Z" fill="#007BFF"/>
                            <path d="M8.91016 43.4844H11.6641V38.0938H8.91016C4.35446 38.0938 0.648438 41.7209 0.648438 46.1797V89.3047C0.648438 90.7945 1.88017 92 3.40234 92H11.6641V70.4375H6.15625V65.0469H11.6641V59.6562H6.15625V54.2656H11.6641V48.875H6.15625V46.1797C6.15625 44.6951 7.39073 43.4844 8.91016 43.4844Z" fill="#007BFF"/>
                            <path d="M86.3867 38.0938H83.6328V43.4844H86.3867C87.9061 43.4844 89.1406 44.6951 89.1406 46.1797V48.875H83.6328V54.2656H89.1406V59.6562H83.6328V65.0469H89.1406V70.4375H83.6328V92H91.8945C93.4167 92 94.6484 90.7945 94.6484 89.3047V46.1797C94.6484 41.7209 90.9424 38.0938 86.3867 38.0938Z" fill="#007BFF"/>
                            <path d="M69.8633 11.1406H66.9258V2.69531C66.9258 1.20552 65.694 0 64.1719 0H31.125C29.6028 0 28.3711 1.20552 28.3711 2.69531V11.1406H25.4336C20.8779 11.1406 17.1719 14.7678 17.1719 19.2266C17.1719 31.2275 17.1719 75.5065 17.1719 92C20.2388 92 36.3128 92 39.3867 92C39.3867 90.8552 39.3867 82.3289 39.3867 81.2188H55.9102C55.9102 82.3635 55.9102 90.8899 55.9102 92C58.9771 92 75.0511 92 78.125 92C78.125 83.6864 78.125 27.7482 78.125 19.2266C78.125 14.7678 74.419 11.1406 69.8633 11.1406ZM44.8945 65.0469H33.8789V59.6562H44.8945V65.0469ZM44.8945 54.2656H33.8789V48.875H44.8945V54.2656ZM44.8945 43.4844H33.8789V38.0938H44.8945V43.4844ZM61.418 65.0469H50.4023V59.6562H61.418V65.0469ZM61.418 54.2656H50.4023V48.875H61.418V54.2656ZM61.418 43.4844H50.4023V38.0938H61.418V43.4844ZM61.418 13.8359V32.7031H33.8789V13.8359V5.39062H61.418V13.8359Z" fill="#007BFF"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_209_551">
                            <rect width="94" height="92" fill="white" transform="translate(0.648438)"/>
                            </clipPath>
                            </defs>
                            </svg>
                            <span>{{ get_phrase('Hospital') }}<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00882 4.43439H12.8374L10.3329 1.5979C10.2615 1.51775 10.2049 1.42239 10.1662 1.31733C10.1276 1.21227 10.1077 1.09958 10.1077 0.985765C10.1077 0.87195 10.1276 0.759261 10.1662 0.6542C10.2049 0.549138 10.2615 0.453782 10.3329 0.373634C10.4755 0.213056 10.6684 0.122925 10.8696 0.122925C11.0707 0.122925 11.2636 0.213056 11.4062 0.373634L14.672 4.08091C14.9579 4.4028 15.1194 4.83997 15.1211 5.29655C15.1174 5.75014 14.956 6.1838 14.672 6.50357L11.4062 10.2108C11.3353 10.2907 11.2511 10.3539 11.1585 10.3969C11.066 10.4398 10.9669 10.4618 10.8669 10.4614C10.7668 10.461 10.6679 10.4382 10.5756 10.3945C10.4833 10.3508 10.3995 10.2869 10.3291 10.2065C10.2586 10.1261 10.2028 10.0308 10.1648 9.92601C10.1269 9.8212 10.1075 9.70895 10.1079 9.59567C10.1082 9.48238 10.1283 9.37029 10.1669 9.26578C10.2055 9.16128 10.2619 9.0664 10.3329 8.98658L12.8374 6.15871H1.00882C0.80693 6.15871 0.613305 6.06787 0.470544 5.90619C0.327783 5.7445 0.247584 5.52521 0.247584 5.29655C0.247584 5.06789 0.327783 4.8486 0.470544 4.68691C0.613305 4.52523 0.80693 4.43439 1.00882 4.43439Z" fill="white"/>
                                </svg>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Near By Modal Start -->
<div class="modal fade rel-modal nearBy-modal" id="real" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-map-marker-alt me-2"></i> {{ get_phrase('Nearby Locations') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="all-tab-control">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-school" role="tabpanel" aria-labelledby="pills-school-tab" tabindex="0">
                            <div class="antrytab-manage">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="map-view" id="map1"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="tab-wiget">
                                            <ul id="location-list1">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Shopping-Center" role="tabpanel" aria-labelledby="pills-Shopping-Center-tab" tabindex="0">
                            <div class="antrytab-manage">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="map-view" id="map2"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="tab-wiget">
                                            <ul id="location-list2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Hospital" role="tabpanel" aria-labelledby="pills-Hospital-tab" tabindex="0">
                            <div class="antrytab-manage">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="map-view" id="map3"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="tab-wiget">
                                            <ul id="location-list3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="ct-nav-control">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-school-tab" data-bs-toggle="pill" data-bs-target="#pills-school" type="button" role="tab" aria-controls="pills-school" aria-selected="true"><i class="fa fa-graduation-cap me-2" onclick="changeView({{ $nearby_schools }}, '1')"></i> {{ get_phrase('Schools') }} <span>{{ count($shools) > 0 ? count($shools)-1 : count($shools) }}</span> </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link res-colors" id="pills-Shopping-Center-tab" data-bs-toggle="pill" data-bs-target="#pills-Shopping-Center" type="button" role="tab" aria-controls="pills-Shopping-Center" aria-selected="false" onclick="changeView({{ $nearby_shopping_centers }}, '2')"><i class="fas fa-shopping-cart"></i> {{ get_phrase('Shopping-Center') }} <span>{{ count($shopping_centers) > 0 ? count($shopping_centers)-1 : count($shopping_centers) }}</span></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link hos-color" id="pills-Hospital-tab" data-bs-toggle="pill" data-bs-target="#pills-Hospital" type="button" role="tab" aria-controls="pills-Hospital" aria-selected="false" onclick="changeView({{ $nearby_hospitals }}, '3')"> <i class="fa-solid fa-house-medical me-2"></i>{{ get_phrase('Hospital') }} <span>{{ count($hospitals) > 0 ? count($hospitals)-1 : count($hospitals) }}</span></button>
                            </li>
                        </ul> 
                    </div>                                                         
                </div>
            </div>
        </div>
    </div>
</div>                  
<!-- Near By Modal End -->

<script>
"use strict";
        
// Replace 'YOUR_MAPBOX_ACCESS_TOKEN' with your actual Mapbox access token
mapboxgl.accessToken = "{{ get_settings('map_access_token') }}";


var locations = <?=$nearby_schools; ?>;
function changeView(locations = <?=$nearby_schools; ?>, num = 1) {
    
    if(num == 1) {
        $("#pills-school").addClass("show active");
        $('#pills-Shopping-Center').removeClass('show active');
        $("#pills-Hospital").removeClass("show active");

        $("#pills-school-tab").addClass("active");
        $('#pills-Shopping-Center-tab').removeClass('active');
        $("#pills-Hospital-tab").removeClass("active");
  
    } else if(num == 2) {
        $('#pills-Shopping-Center').addClass('show active');
        $("#pills-school").removeClass("show active");
        $("#pills-Hospital").removeClass("show active");

        $('#pills-Shopping-Center-tab').addClass('active');
        $("#pills-school-tab").removeClass("active");
        $("#pills-Hospital-tab").removeClass("active");
  
    } else if(num == 3) {
        $('#pills-Hospital').addClass('show active');
        $("#pills-school").removeClass("show active");
        $("#pills-Shopping-Center").removeClass("show active");

        $("#pills-Hospital-tab").addClass("active");
        $("#pills-school-tab").removeClass("active");
        $('#pills-Shopping-Center-tab').removeClass('active');
  
    }
    setTimeout(() => {

        mapboxgl.accessToken = "{{ get_settings('map_access_token') }}";

        let selectedMarker = null; // Variable to store the reference to the selected marker
        locations = locations;
        console.log(locations)
        // Initialize the map
        var map = new mapboxgl.Map({
        container: 'map'+num,
        style: 'mapbox://styles/mapbox/streets-v11',
        center: locations[0].lngLat,
        zoom: 12
        });

        // Create markers for each location
        document.getElementById('location-list'+num).innerHTML = '';
        locations.forEach((location, index) => {
            let marker;

            if (location.isPrimary) {
                // Create a red marker for the primary location with a larger size
                marker = new mapboxgl.Marker({ color: '#FF0000' });
            } else {
                // Create the default marker for other locations
                marker = new mapboxgl.Marker();
                
                // Create list items for non-primary locations
                let listItem = document.createElement('li');
                let listItemContent = `<span><i class="fa fa-graduation-cap"></i></span>${location.name}`;
                listItem.innerHTML = listItemContent;

                // Add a click event listener to each list item
                listItem.addEventListener('click', (event) => {
                event.stopPropagation(); // Prevents the click event from propagating to the map
                map.flyTo({ center: location.lngLat });

                // Remove the 'active' class from all list items
                let listItems = document.querySelectorAll('#location-list'+num+' li');
                listItems.forEach((item) => {
                    item.classList.remove('active');
                });

                // Add the 'active' class to the clicked list item
                listItem.classList.add('active');

                // Remove the previously selected marker's custom style
                if (selectedMarker) {
                    selectedMarker.getElement().querySelector('svg').removeAttribute('style');
                }

                // Increase the size of the clicked marker's icon
                marker.getElement().querySelector('svg').setAttribute('style', 'transform: scale(1.5);');
                selectedMarker = marker;
                });

                // Add the list item to the location list
                document.getElementById('location-list'+num).appendChild(listItem);
            }

            marker.setLngLat(location.lngLat)
            .setPopup(new mapboxgl.Popup({ offset: 25 })
            .setHTML(`<h3>${location.name}</h3><p>${location.lngLat}</p>`))
            .addTo(map);
        });
    }, 800);
}


</script>