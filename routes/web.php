<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth\LoginController;
use App\Http\Controllers\Updater;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return 'Application cache cleared';
});

Route::any('/contact-email', 'EmailController@sendEmail')->name('contact_email');
Route::get('/send-email', [EmailController::class, 'index']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Authentication Routes
Route::prefix('')->group(function () {
    // Login Routes
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    // Logout Route
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Password Reset Routes
    Route::get('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);
    Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    // Registration Routes
    Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

    // Email Verification Routes
    Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

    // New Email Verification
    Route::get('email/verification', [App\Http\Controllers\Auth\AuthController::class, 'VerificationGmail'])->name('verification');
    Route::post('/verify-code',  [App\Http\Controllers\Auth\AuthController::class, 'verifyCode'])->name('verification.verify');

});

Route::controller(AdminController::class)->middleware('auth')->group(function () {

    Route::get('admin/dashboard', 'dashboard')->name('admin.dashboard');
    //Listing Types
    Route::get('admin/listing-types', 'RealEstateCategoryPropertyAmenities')->name('admin.ListingTypes');
    //Real Estate Category Proparty Amenities
    Route::get('admin/listing-types/real-estate/{active_tab?}', 'RealEstateCategoryPropertyAmenities')->name('admin.RealEstateCategoryPropertyAmenities');
    //Real Estate Category
    Route::get('admin/real-estate/category/create/modal', 'RealEstateCategoryCreateModal')->name('admin.RealEstateCategoryCreateModal');
    Route::post('admin/real-estate/category/create/modal/post', 'RealEstateCategoryCreateModalPost')->name('admin.RealEstateCategoryCreateModalPost');
    Route::get('admin/real-estate/category/edit/modal/{id}', 'RealEstateCategoryEditModal')->name('admin.RealEstateCategoryEditModal');
    Route::post('admin/real-estate/category/edit/modal/post', 'RealEstateCategoryEditModalPost')->name('admin.RealEstateCategoryEditModalPost');
    Route::get('admin/real-estate/category/delete/{id}', 'RealEstateCategoryDelete')->name('admin.RealEstateCategoryDelete');
    //Real estate property
    Route::get('admin/real-estate/property/create/modal', 'RealEstatePropertyCreateModal')->name('admin.RealEstatePropertyCreateModal');
    Route::post('admin/real-estate/property/create/modal/post', 'RealEstatePropertyCreateModalPost')->name('admin.RealEstatePropertyCreateModalPost');
    Route::get('admin/real-estate/property/edit/modal/{id}', 'RealEstatePropertyEditModal')->name('admin.RealEstatePropertyEditModal');
    Route::post('admin/real-estate/property/edit/modal/post', 'RealEstatePropertyEditModalPost')->name('admin.RealEstatePropertyEditModalPost');
    Route::get('admin/real-estate/property/delete/{id}', 'RealEstatePropertyDelete')->name('admin.RealEstatePropertyDelete');
    //Real Amneity
    Route::get('admin/real-estate/amenity/create/modal', 'RealEstateAmenityCreateModal')->name('admin.RealEstateAmenityCreateModal');
    Route::post('admin/real-estate/amenity/create/modal/post', 'RealEstateAmenityCreateModalPost')->name('admin.RealEstateAmenityCreateModalPost');
    Route::get('admin/real-estate/amenity/edit/modal/{id}', 'RealEstateAmenityEditModal')->name('admin.RealEstateAmenityEditModal');
    Route::post('admin/real-estate/amenity/edit/modal/post', 'RealEstateAmenityEditModalPost')->name('admin.RealEstateAmenityEditModalPost');
    Route::get('admin/real-estate/amenity/delete/{id}', 'RealEstateAmenityDelete')->name('admin.RealEstateAmenityDelete');

    //State
    Route::get('admin/states/add/modal', 'AddStatesModal')->name('admin.AddStatesModal');
    Route::post('admin/states/add/modal/post', 'AddStatesModalPost')->name('admin.AddStatesModalPost');
    Route::get('admin/states/edit/modal/{id}', 'EditStatesModal')->name('admin.EditStatesModal');
    Route::post('admin/states/edit/modal/post', 'EditStatesModalPost')->name('admin.EditStatesModalPost');
    Route::get('admin/states/delete/{id}', 'DeleteState')->name('admin.DeleteState');

    //city
    Route::get('admin/cities/list', 'ListOfCities')->name('admin.cities');
    Route::get('admin/cities/add/modal', 'AddCitiesModal')->name('admin.AddCitiesModal');
    Route::post('admin/cities/add/modal/post', 'AddCitiesModalPost')->name('admin.AddCitiesModalPost');
    Route::get('admin/cities/edit/modal/{id}', 'EditCitiesModal')->name('admin.EditCitiesModal');
    Route::post('admin/cities/edit/modal/post', 'EditCitiesModalPost')->name('admin.EditCitiesModalPost');
    Route::get('admin/cities/delete/{id}', 'DeleteCities')->name('admin.DeleteCities');
    Route::get('admin/get_state/by_country',  'get_state_by_country')->name('get_state_by_country');

    //Smtp settings routes
    Route::get('admin/settings/smtp', 'smtpSettings')->name('admin.smtp_settings');
    Route::post('admin/smtp/update', 'smtpUpdate')->name('admin.smtp.update');
    //Payment Settings
    Route::get('admin/payment/settings', 'payment_settings')->name('admin.payment_settings');
    Route::post('admin/payment/settings/update', 'update_payment_settings')->name('admin.update_payment_settings');
    //Stripe/Paypal Payment
    Route::post('admin/stripe/update', 'update_stripe_payment')->name('admin.update_stripe_payment');
    Route::post('admin/paypal/update', 'update_paypal_payment')->name('admin.update_paypal_payment');
    //Map Settings
    Route::get('admin/map/settings', 'map_settings')->name('admin.map_settings');
    Route::post('admin/map/settings/update', 'update_map_settings')->name('admin.update_map_settings');

    //System settings
    Route::get('admin/settings/system', 'systemSettings')->name('admin.system_settings');
    Route::post('admin/system/update', 'systemUpdate')->name('admin.system.update');

    //Website settings
     Route::get('admin/settings/website', 'websiteSettings')->name('admin.website_settings');
     Route::post('admin/website/update', 'websiteUpdate')->name('admin.website.update');
     Route::post('admin/real_estate/update', 'realEstateUpdate')->name('admin.real_estate.update');

    Route::post('admin/website/bannar/add', 'bannarImageAdd')->name('admin.website_bannar.add');
    Route::post('admin/website/video-img', 'videoImageAdd')->name('admin.video_image');
    Route::post('admin/website/logo/add', 'logoImageAdd')->name('admin.website_logo.add');
    //SEO settings
    Route::get('admin/settings/seo/{route?}', 'seoSettings')->name('admin.seo_settings');
    Route::any('admin/seo/update/{route}', 'seoUpdate')->name('admin.seo.update');

    //Language  settings
    Route::get('admin/settings/language/{language?}', 'manageLanguage')->name('admin.language.manage');
    Route::post('admin/settings/language/add', 'addLanguage')->name('admin.language.add');
    Route::post('admin/settings/language/{language?}', 'updatedPhrase')->name('admin.language.update_phrase');
    Route::get('admin/settings/language/delete/{identifier}', 'deleteLanguage')->name('admin.language.delete');

    

    // User - customer
    Route::get('admin/customer', 'customerList')->name('admin.customer_list');
    Route::get('admin/customer/create_modal', 'createCustomerModal')->name('admin.customer.open_modal');
    Route::post('admin/customer/create', 'adminCustomerCreate')->name('admin.customer.create');
    Route::get('admin/customer/edit_modal/{id}', 'editCustomerModal')->name('admin.customer.open_edit_modal');
    Route::post('admin/customer/{id}', 'customerUpdate')->name('admin.customer.update');
    Route::get('admin/customer/delete/{id}', 'adminCustomerDelete')->name('admin.customer.delete');
    Route::get('admin/customer/to/agent/{id}', 'adminCustomerToAgent')->name('admin.customer.to.agent');
    Route::get('admin/customer/pdf', 'customerPdfGenerate')->name('admin.customerPdfGenerate');

    // Admin Archive To User
    Route::get('admin/customer/archive/{id}', 'adminCustomerArchive')->name('admin.customer.archive');
    Route::get('admin/customer/activeUser/{id}', 'activateUser')->name('admin.customer.activeUser');

    // User - agent
    Route::get('admin/agent', 'agentList')->name('admin.agent_list');
    Route::get('admin/agent/edit_modal/{id}', 'editAgentModal')->name('admin.agent.open_edit_modal');
    Route::post('admin/agent/{id}', 'agentUpdate')->name('admin.agent.update');
    Route::get('admin/agent/delete/{id}', 'adminAgentDelete')->name('admin.agent.delete');
    Route::get('admin/agent/ban/{id}', 'adminAgentBan')->name('admin.agent.ban');
    Route::get('admin/agent/unban/{id}', 'adminAgentUnban')->name('admin.agent.unban');
    Route::get('admin/agent/pdf', 'agentPdfGenerate')->name('admin.agentPdfGenerate');
    


    //Package routes
    Route::get('admin/package', 'adminPackage')->name('admin.package');
    Route::get('admin/package/create', 'createPackage')->name('admin.create.package');
    Route::post('admin/package_add', 'packageCreate')->name('admin.package.create');
    Route::get('admin/package/{id}', 'editPackage')->name('admin.edit.package');
    Route::post('admin/package/{id}', 'packageUpdate')->name('admin.package.update');
    Route::get('admin/package/delete/{id}', 'packageDelete')->name('admin.package.delete');

    //Subscription routes
    Route::get('admin/subscription/report', 'subscriptionReport')->name('admin.subscription.report');
    Route::get('admin/subscription/pending', 'subscriptionPendingPayment')->name('admin.subscription.pending');
    Route::get('admin/subscription/status/{id}', 'subscriptionPaymentStatus')->name('admin.subscription.approve.status');
    Route::get('admin/subscription/confirm/payment/{id}', 'subscriptionPaymentDelete')->name('admin.subscription.delete');
    Route::get('admin/subscription/approved', 'subscriptionApprovePayment')->name('admin.subscription.approved.payments');
    Route::get('admin/subscription/approved/payment/delete/{id}', 'subscriptionApprovePaymentDelete')->name('admin.subscription.approved.payment.delete');
    Route::get('admin/subscription/pdf', 'subscriptionReportPdf')->name('admin.subscriptionReportPdf');


    //Admin profile
    Route::get('admin/profile', 'adminProfile')->name('admin.profile');
    Route::post('admin/profile/update', 'profileUpdate')->name('admin.profile.update');
    Route::any('admin/password-action/{action_type}', 'password')->name('admin.password');


    //Admin blog category
    Route::get('admin/blog_category/list', 'blogCategoryList')->name('admin.blog_Category.list');
    Route::get('admin/blog_category/create', 'createBlogCategory')->name('admin.create.blog_category');
    Route::post('admin/blog_category_add', 'blogCategoryCreate')->name('admin.blog_category.create');
    Route::get('admin/blog_category/edit/{id}', 'editBlogCategory')->name('admin.blog_category.edit');
    Route::post('admin/blog_category/update/{id}', 'blogCategoryUpdate')->name('admin.blog_category.update');
    Route::get('admin/blog_category/delete/{id}', 'blogCategoryDelete')->name('admin.blog_category.delete');


    //Admin blogs
    Route::get('admin/blogs', 'blogList')->name('admin.blogs');
    Route::get('admin/blogs/create', 'createBlogs')->name('admin.create.blogs');
    Route::post('admin/blogs/add', 'blogsCreate')->name('admin.blogs.create');
    Route::get('admin/blogs/edit/{id}', 'editBlog')->name('admin.blog.edit');
    Route::post('admin/blog_edit/update/{id}', 'blogUpdate')->name('admin.blog.update');
    Route::get('admin/blog_status/update/{id}/{status}', 'blogStatusUpdate')->name('admin.blog_status.update');
    Route::get('admin/blogs/delete/{id}', 'blogDelete')->name('admin.blog.delete');


    //Admin blog settings
    Route::get('admin/blog/settings', 'blogSettings')->name('admin.blog.settings');
    Route::post('admin/blog/settings/update', 'blogSettingsUpdate')->name('admin.blog_settings.update');

    //FAQ
    Route::get('admin/settings/faq', 'faqViews')->name('admin.faq_views');
    Route::get('admin/settings/faq_add', 'faqAdd')->name('admin.faq_add');
    Route::post('admin/settings/faq_create', 'faqCreate')->name('admin.faq_create');
    Route::get('admin/settings/faq_edit/{id}', 'faqEdit')->name('admin.faq_edit');
    Route::post('admin/settings/faq_update/{id}', 'faqUpdate')->name('admin.faq_update');
    Route::get('admin/settings/faq/delete/{id}', 'faqDelete')->name('admin.faq.delete');

    //About routes
    Route::get('admin/settings/about', 'about')->name('admin.about');
    Route::any('admin/save_valid_purchase_code/{action_type?}', 'save_valid_purchase_code')->name('admin.save_valid_purchase_code');

    // Listings
    Route::get('admin/listings', 'listings')->name('admin.listings');
    Route::any('admin/listings/contactAgent/{id}', 'contactAgent')->name('admin.contactAgent');

    //Admin Contact settings
    Route::get('admin/contact/settings', 'contactSettings')->name('admin.contact.settings');
    Route::post('admin/contact/settings/update', 'contactSettingsUpdate')->name('admin.contact_settings.update');


    // Admin Mail To Agent
    Route::post('admin/message', 'sendAdminToAgentEmail')->name('mailAgent');

     //Mortgage settings routes
     Route::get('admin/settings/mortgage', 'mortgageSettings')->name('admin.mortgage_settings');
     Route::post('admin/mortgage_add', 'mortgageAdd')->name('admin.mortgage_add');
     Route::get('admin/mortgage/edit/{id}', 'mortgageEdit')->name('admin.mortgage_edit');
     Route::post('admin/mortgage/update/{id}', 'mortgageUpdate')->name('admin.mortgage_update');
     Route::get('admin/mortgage/delete/{id}', 'mortgageDelete')->name('admin.mortgage.delete');
     Route::any('admin/mortgage/section_sort_update', 'ajax_sort_section')->name('admin.section_sort_update');

});

Route::controller(HomeController::class)->group(function () {

    //Frontend site
    Route::get('real-estate/home', 'realEstateHome')->name('realEstateHome');
    //search listings
    Route::get('listings', 'realeStateListings')->name('realeStateListings');
    Route::get('listings/filter/{type?}', 'realeStateListingsFilter')->name('realeStateListingsFilter');

    Route::get('set/property/view/session/{view_type}', 'setPropertyViewSession')->name('setPropertyViewSession');

    Route::get('real-estate/{slug}/{id}', 'singlePropertyView')->name('singlePropertyView');

    //review

    Route::post('real-estate/single/porperty/review/{id}', 'singlePropertyReview')->name('singlePropertyReview');


    Route::get('real-estate/single/porperty/review/react', 'singlePropertyLikeDislike')->name('singlePropertyLikeDislike');
    Route::post('real-estate/review/comment', 'singlePropertyComment')->name('singlePropertyComment');

    //----------------------------------------------------------------

    Route::any('customer/message', 'customerQuery')->name('customerQuery');

    //----------------------------------------------------------------

    //agent details_page

    Route::get('agent/details/{id}', 'agentDetails')->name('agentDetails');

    //agent review

    Route::post('agent/review/save/{id}', 'saveAgentReview')->name('saveAgentReview');
    Route::get('real-estate/agent/review/react', 'agentReviewLikeDislike')->name('agentReviewLikeDislike');

    Route::post('agent/review/edit/post/{id}', 'editAgentReview')->name('editAgentReview');

    Route::post('listing/review/edit/post/{id}', 'editlistingReview')->name('editlistingReview');


    Route::post('agent/review/comment', 'commentOnAgentReview')->name('commentOnAgentReview');
    Route::post('listing/review/comment', 'commentOnListingReview')->name('commentOnListingReview');


    Route::get('pricing', 'subscriptionPackages')->name('subscriptionPackages');


    //Blog route
    Route::get('blog', 'blogList')->name('blogGrid');
    Route::get('blog_post/{slug}/{id}', 'blogDetails')->name('blogDetails');


    //Conact route
    Route::get('contact', 'contactUs')->name('contactUs');

    // Email Subscribe
    Route::post('email_subscribe', 'emailSubscribe')->name('emailSubscribe');


});



    Route::controller(CustomerController::class)->middleware(['auth', 'verified'])->group(function () {

        Route::get('customer/account', 'customerAccount')->name('customerAccount');
        Route::post('customer/account/update', 'customerAccountUpdate')->name('customerAccountUpdate');



        Route::get('customer/select/listings', 'select_listings')->name('select_listings');

        Route::get('country/wise/state/{id}', 'countryWiseState')->name('countryWiseState');
        Route::get('state/wise/city/{id}', 'stateWiseCity')->name('stateWiseCity');




        Route::get('agent/mylistings/select/listings', 'selectListigForMyListings')->name('selectListigForMyListings');
        Route::get('agent/mylistings/{type}', 'showMyListings')->name('showMyListings');


        Route::get('customer/appointment/{type}', 'customerAppointmentList')->name('customerAppointmentList');
        Route::get('customer/appointment/select/listings', 'selectListigForCustomerAppointment')->name('selectListigForCustomerAppointment');

        Route::get('agent/appointment/select/listings', 'selectListigForAgentAppointment')->name('selectListigForAgentAppointment');
        Route::get('agent/appointment/{type}', 'agentAppointmentList')->name('agentAppointmentList');
        Route::get('appointment/{id}', 'deleteAppointment')->name('deleteAppointment');

        Route::post('customer/book/appointment', 'customerBookAppointment')->name('customerBookAppointment');


        Route::get('customer/wishList', 'checkWishlist')->name('checkWishlist');

        //wishlists
        Route::get('customer/wishList/details/{type}', 'checkWishlistDetails')->name('checkWishlistDetails');
        Route::get('customer/wishlist/select/listings', 'selectListigForWishlist')->name('selectListigForWishlist');

        Route::get('customer/wishList/delete/{id}', 'checkWishlistDelete')->name('checkWishlistDelete');


        Route::get('agent/followUnfollow', 'followUnfollow')->name('followUnfollow');

        Route::get('customer/following_agent', 'followingAgentView')->name('followingAgentView');

        Route::get('agent/unfollow/{id}', 'unfollowAgent')->name('unfollowAgent');

        Route::get('agent/add_listings/{type}', 'add_listings_view')->name('add_listings_view');

        Route::post('agent/realstate/listing/save', 'saveRealEstateListing')->name('saveRealEstateListing');

        Route::get('agent/realstate/listing/edit/{id}', 'editRealEstateListing')->name('editRealEstateListing');

        Route::post('agent/realstate/listing/Update/{id}/{form}', 'updateRealEstateListing')->name('updateRealEstateListing');


        Route::get('set/listing_type/session', 'setListingTypeSession')->name('setListingTypeSession');
        Route::get('unset/listing_type/session', 'unsetListingTypeSession')->name('unsetListingTypeSession');



        Route::get('empty/{type}', 'empty')->name('empty');


        Route::get('agent/real-estate/listing/hide/{id}', 'hideRealEstateListing')->name('hideRealEstateListing');

        Route::get('agent/real-estate/listing/show/{id}', 'showRealEstateListing')->name('showRealEstateListing');

        Route::get('agent/real-estate/listing/delete/{id}', 'deleteRealEstateListing')->name('deleteRealEstateListing');


        Route::get('agent/real-estate/join/meeting/{id}', 'joinZoomAsAgent')->name('joinZoomAsAgent');
        Route::get('customer/real-estate/join/meeting/{id}', 'joinZoomAsCustomer')->name('joinZoomAsCustomer');



        Route::post('agent/listing/nearby/location/save', 'saveNearByLocation')->name('saveNearByLocation');

        Route::get('agent/listing/nearby/location/add/{listing_id}', 'addNearByLocation')->name('addNearByLocation');

        Route::get('agent/listing/nearby/location/edit/{id}', 'editNearByLocation')->name('editNearByLocation');

        Route::post('agent/listing/nearby/location/update/{id}', 'updateNearByLocation')->name('updateNearByLocation');

        Route::get('agent/listing/nearby/location/delete/{id}', 'deleteNearByLocation')->name('deleteNearByLocation');


        //--------------------------------------



        Route::get('customer/become_an_agent', 'becomeAnAgentFor')->name('becomeAnAgentFor');

        Route::get('agent/customer_messsage/{param1?}/{param2?}', 'customerMesssage')->name('customerMesssage');

        Route::post('agent/customer_messsage/message_read/{param1}', 'customerReplyMessage')->name('customerReplyMessage');

        Route::get('get_single_message/{param1}', 'getSingleMassege')->name('getSingleMassege');

        Route::get('customer/agent_messsage/{param1?}/{param2?}', 'agentMesssage')->name('agentMesssage');

        Route::get('get_agent_single_message/{param1}', 'getAgentSingleMassege')->name('getAgentSingleMassege');

        Route::post('customer/agent_messsage/message_read/{param1}', 'agentReplyMessage')->name('agentReplyMessage');

        Route::get('agent/subscription/status', 'subscriptionStatus')->name('subscriptionStatus');


        //----------------------------------------------------------------


        Route::get('customer/pay/subscription/{package_id}', 'paymentForSubscription')->name('paymentForSubscription');

        Route::post('agent/update/information', 'updateUserInfo')->name('updateUserInfo');



        //---------------------------

        Route::get('agent/subscription/details', 'subscriptionDetails')->name('subscriptionDetails');

        Route::get('agent/subscription/details_page', 'subscriptionDetailsOnly')->name('subscriptionDetailsOnly');

        Route::get('agent/subscription/download_invoice/{id}', 'subscriptionInvoice')->name('subscriptionInvoice');

        Route::get('agent/subscription/package', 'renewSubscription')->name('renewSubscription');

        Route::get('agent/subscription/package/purchase/{id}', 'purchasePackage')->name('purchasePackage');

        Route::get('agent/modify_billing/infromation', 'modifyBilling')->name('modifyBilling');


        //---------------------------
        Route::get('agent/blogs', 'blogList')->name('blogList');
        Route::get('agent/blogs/write', 'writeBlog')->name('writeBlog');
        Route::post('agent/blogs/add', 'blogAdd')->name('blogAdd');
        Route::get('agent/blogs/edit/{id}', 'editBlog')->name('editBlog');
        Route::post('agent/blogs/update/{id}', 'blogUpdate')->name('blogUpdate');
        Route::get('agent/blogs/delete/{id}', 'blogDelete')->name('blogDelete');

        // Zoom Link
        Route::post('agent/zoom/{id}', 'ZoomLink')->name('agent.zoom');


    });


        // Online Payment Gateways
Route::controller(PaymentController::class)->group(function () {

    // Paypal
    Route::post('customer/PayWithPaypal','payWithPaypal_ForSubscription')->name('payWithPaypal_ForSubscription');
    // Stripe
    Route::post('customer/PayWithStripe', 'PayWithStripe_ForSubscription')->name('PayWithStripe_ForSubscription');

    //Student Fee payment By Student
    Route::get('customer/payment/success/{user_data}/{response}', 'successfullyBecomeAnAgnet')->name('successfullyBecomeAnAgnet');
    Route::get('customer/payment/fail/{user_data}/{response}', 'failToBecomeAnAgnet')->name('failToBecomeAnAgnet');
});


// Email Routes

Route::controller(EmailController::class)->group(function () {
    Route::get('/confirm-subscription', 'subscriptionConfirmation')->name('subscriptionConfirmation');
});

//Updater routes are here
Route::controller(Updater::class)->middleware('auth', 'verified')->group(function () {

    Route::post('admin/addon/create', 'update')->name('admin.addon.create');
    Route::post('admin/addon/update', 'update')->name('admin.addon.update');
    Route::post('admin/product/update', 'update')->name('admin.product.update');

});
//End Updater routes

//Installation routes
Route::controller(InstallController::class)->group(function () {

    Route::get('/', 'index');
    Route::get('install/step0', 'step0')->name('step0');
    Route::get('install/step1', 'step1')->name('step1');
    Route::get('install/step2', 'step2')->name('step2');
    Route::any('install/step3', 'step3')->name('step3');
    Route::get('install/step4', 'step4')->name('step4');
    Route::get('install/step4/{confirm_import}', 'confirmImport')->name('step4.confirm_import');
    Route::get('install/install', 'confirmInstall')->name('confirm_install');
    Route::post('install/validate', 'validatePurchaseCode')->name('install.validate');
    Route::any('install/finalizing_setup', 'finalizingSetup')->name('finalizing_setup');
    Route::get('install/success', 'success')->name('success');

});
//Installation routes