<!-- Tabs -->
<div class="price-list bd-r-5 box-shadow-06 px-30 pt-30 pb-30">
    <div class="d-flex justify-content-between align-items-center flex-wrap g-12 mb-16">
        <div class="tableTitle-3">
            <h4 class="fz-24-sb-black">{{ get_phrase('Pacakges') }}</h4>
        </div>
        <!-- Button -->
        <a href="javascript:;" onclick="go_back()" class="back-listing cg-10"><i class="fa-solid fa-arrow-left"></i> {{ get_phrase('Go Back') }}</a>
    </div>
    <div class="row flex-wrap justify-content-center">
      @foreach($packages as $package)
      <div class="col-lg-4 col-md-6">
        <div class="packageBox text-center">
            <div class="position-relative">
                <h4 class="packageTitle">{{ $package->name }}</h4>
                <p class="packagePrice"><span>{{ currency($package->price) }}</span>/{{ $package->interval }}</p>
                <ul class="packageFeatures">
                    <li class="mainFeature">{{ $package->description }}</li>
                </ul>
                <a href="javascript:;" onclick="purchase_package('<?= $package->id ?>')" class="packageSubs_btn">{{ get_phrase('Get Started') }}</a>
            </div>
        </div>
      </div>
      @endforeach
    </div>
</div>