<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\Listing;
use App\Models\Listing_type;
use App\Models\Listing_attribute;
use App\Models\Listing_arrtibute_type;
use App\Models\Listing_attribute_value;
use PhpParser\Node\Expr\List_;
use Illuminate\Support\Str;
use App\Models\SystemSetting;
use App\Models\Currency;
use App\Models\Package;
use App\Models\PendingSubscription;
use App\Models\Subscription;
use App\Models\NearbyLocation;
use Illuminate\Support\Facades\Hash;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\AgentPaymentSettings;
use App\Models\Message;
use App\Models\MessageThread;
use App\Models\Blog;
use App\Models\BlogCategory;
use Auth;
use Dompdf\Dompdf;


class CustomerController extends Controller
{

    function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth()->user();
            $this->check_subscription_status(Auth()->user()->id);
            return $next($request);
        });


    }


    function check_subscription_status($user_id = ""){
        $current_route = Route::currentRouteName();
        $has_subscription = Subscription::where('user_id', $user_id)->get()->count();
        $current_subscription = Subscription::where('user_id', $user_id)->orderBy('id', 'DESC')->first();

        $today = date("Y-m-d");
        $today_time = strtotime($today);

        if($has_subscription != 0) {

            $expiry_status = strtotime($current_subscription->expire_date) < $today_time;
            if(
                ($current_route == 'selectListigForMyListings' && $expiry_status) ||
                ($current_route == 'select_listings' && $expiry_status) ||
                ($current_route == 'showMyListings' && $expiry_status) ||
                ($current_route == 'selectListigForAgentAppointment' && $expiry_status) ||
                ($current_route == 'agentAppointmentList' && $expiry_status) ||
                ($current_route == 'followUnfollow' && $expiry_status) ||
                ($current_route == 'unfollowAgent' && $expiry_status) ||
                ($current_route == 'hideRealEstateListing' && $expiry_status) ||
                ($current_route == 'showRealEstateListing' && $expiry_status) ||
                ($current_route == 'deleteRealEstateListing' && $expiry_status) ||
                ($current_route == 'joinZoomAsAgent' && $expiry_status) ||
                ($current_route == 'agentPaymentSettings' && $expiry_status) ||
                ($current_route == 'agentPaymentSettingsUpdate' && $expiry_status) ||
                ($current_route == 'editNearByLocation' && $expiry_status) ||
                ($current_route == 'updateNearByLocation' && $expiry_status) ||
                ($current_route == 'deleteNearByLocation' && $expiry_status) ||
                ($current_route == 'updateUserInfo' && $expiry_status) ||
                ($current_route == 'customerMesssage' && $expiry_status) ||
                ($current_route == 'customerReplyMessage' && $expiry_status) ||
                ($current_route == 'add_listings_view' && $expiry_status) ||
                ($current_route == 'blogList' && $expiry_status)
            )
            {
                redirect()->route('subscriptionDetails')->send();
            }

        }
    }


    function customerAccount()
    {
        unsetListingTypeSessionHelper();
        $page_data = array();
        $user=User::find(auth()->user()->id);
        $address= json_decode($user->address);
        $social= json_decode($user->social);
        $page_data['countries']=Country::all();
        $page_data['user']=$user;
        $page_data['address']=$address;
        $page_data['social']=$social;
        $page_data['account']='active';
        $page_data['navigation_name']='Account';

        return view('customer.account.account_info', $page_data);
    }

    function customerAccountUpdate(Request $request)
    {
        $data=$request->all();
        $page_data = array();
        $mgs_status='message';

        $updateUserInfo=User::find(auth()->user()->id);

        if($data['type']=="info")
        {
            if(!isset($data['gender']))
                $updateUserInfo['gender']='other';
            else
                $updateUserInfo['gender']=$data['gender'];


            $updateUserInfo['name']=$data['name'];
            $updateUserInfo['phone']=$data['phone'];

            if(empty($request->photo)){
                $updateUserInfo['image'] = $request->old_photo;
            }else{

                $photoPathName = 'uploads/user_image/' . $request->old_photo;
                if(file_exists($photoPathName)){
                    unlink($photoPathName);
                }
                $file_name = random(10).'.'.$data['photo']->extension();
                $data['photo']->move(public_path('uploads/user_image/'), $file_name);
                $updateUserInfo['image'] = $file_name;
            }

            if(empty($request->company_image)){
                $updateUserInfo['company'] = $request->old_company_image;
            }else{

                $photoPathName = 'uploads/company-image/' . $request->old_company_image;
                if(file_exists($photoPathName)){
                    unlink($photoPathName);
                }
                $file_name = random(10).'.'.$data['company_image']->extension();
                $data['company_image']->move(public_path('uploads/company-image/'), $file_name);
                $updateUserInfo['company'] = $file_name;
            }

            $social=array();
            $social['facebook']=$data['facebook'];
            $social['twitter']=$data['twitter'];
            $social['linkedin']=$data['linkedin'];
            $updateUserInfo['social']=json_encode($social);

            $updateUserInfo['about']=$data['about'];
            $updateUserInfo['website']=$data['website'];

            $mgs='User information updated';

        }elseif($data['type']=='address')
        {
            $address=array();
            $address['country_code']=$data['country_code'];
            $address['state']=$data['state'];
            $address['addressline']=$data['addressline'];
            $address['zipcode']=$data['zipcode'];

            $updateUserInfo['address']=json_encode($address);
            $mgs='Address updated';


        }
        elseif($data['type']=='pass')
        {
            $request->validate([
                'password' => 'required',
                'newpassword' => 'required|min:4|different:password',
            ]);

            if (Hash::check($request->password, auth()->user()->password)) {

                $updateUserInfo->password = Hash::make($request->newpassword);
                $mgs='Password updated';

            } else {

                $mgs_status="error";
                $mgs='Invalid password';
            }


        }

        $updateUserInfo->save();


        return redirect()->back()->with($mgs_status, $mgs);
    }


    public function select_listings()
    {
        unsetListingTypeSessionHelper();
        $page_data=array();
        $listing_type=Listing_type::all();
        $page_data['listings_types']=$listing_type;
        $page_data['createListing']='active';
        $page_data['navigation_name']='Create Listing';
        return view('customer.create_listing.select_listings', $page_data);

    }

    public function add_listings_view($type)
    {

        $type_check=Listing_type::find($type);


            if($type_check->slug=='real-estate')
            {
                $listing_type=Listing_type::find($type);
                $page_data=array();
                $page_data['countries']=Country::all();
                $attribute_category_id=Listing_attribute::where('listing_type_id',$type)->where('attribute_name','category')->value('id');
                $attribute_property_details_id=Listing_attribute::where('listing_type_id',$type)->where('attribute_name','property_details')->value('id');
                $attribute_amenities_id=Listing_attribute::where('listing_type_id',$type)->where('attribute_name','amenities')->value('id');

                $categories=Listing_arrtibute_type::where('listring_attribute_id',$attribute_category_id)->get();
                $property_details=Listing_arrtibute_type::where('listring_attribute_id',$attribute_property_details_id)->get();

                

                $property_type_id=Listing_arrtibute_type::where('listring_attribute_id',$attribute_property_details_id)->where('type','property_type')->value('id');
                $amenities=Listing_arrtibute_type::where('listring_attribute_id',$attribute_amenities_id)->get();


                $page_data['listings_type']=$listing_type;
                $page_data['categories']=$categories;
                $page_data['property_details']=$property_details;
                $page_data['amenities']=$amenities;
                $page_data['createListing']='active';
                $page_data['navigation_name']='Create Listing';
                return view("customer.create_listing.add_listings", $page_data);

            }
            else
            {
                echo "for other listing type";
            }





    }



    public function countryWiseState($id)
    {

        $row_id=Country::where('code',$id)->value('id');

        $states = State::get()->where('country_id', $row_id);
        $counter= State::get()->where('country_id', $row_id)->count();
        $options="";

        if($counter==0)
        {
            $options='<option value=""> No state found </option>';

        }
        else
        {
            foreach ($states as $state) :
                $options .= '<option value="' . $state->id . '">' . $state->title . '</option>';
            endforeach;

        }

        echo $options;



    }

    public function stateWiseCity($id)
    {
        $row_id=Country::where('code',$id)->value('id');
        $cities = City::get()->where('country_id', $row_id);
        $counter=City::get()->where('country_id', $row_id)->count();
        $options="";

        if($counter==0)
        {
            $options='<option value=""> No city found </option>';
        }
        else
        {
            foreach ($cities as $city) :
                $options .= '<option value="' . $city->id . '">' . $city->title . '</option>';
            endforeach;

        }
        echo $options;

    }


    public function selectListigForMyListings()
    {
        unsetListingTypeSessionHelper();
        $page_data=array();
        $listing_type=Listing_type::all();
        $page_data['listings_types']=$listing_type;
        $page_data['mylistings']='active';
        $page_data['navigation_name']='My Listings';
        return view('customer.mylisting.select_my_listings', $page_data);

    }


    public function showMyListings(Request $request,$listing_type)
    {
        setListingTypeSessionHelper($listing_type);
        $page_data=array();
        $page_data['mylistings']='active';
        $page_data['navigation_name']='My Listings';
        $page_data['current_route']='showMyListings';
        $type=Listing_type::find($listing_type);

        $filter=$request->all();

        if($type->slug=='real-estate')
        {
            if(isset($filter['action']))
            {
                $filter_type = $filter['listing_type'];
                $filter_status = $filter['status'];

                $page_data['typeButton']=$filter['type_tag'];
                $page_data['visibilityButton']=$filter['status_tag'];

                if($filter_type=='all' && $filter_status=='all')
                {
                    $listings=Listing::where('user_id',auth()->user()->id)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);

                }
                elseif($filter_type!='all' && $filter_status=='all')
                {
                    $listings=Listing::where('user_id',auth()->user()->id)->where('type',$filter_type)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);

                }
                elseif($filter_type=='all' && $filter_status!='all')
                {
                    $listings=Listing::where('user_id',auth()->user()->id)->where('status',$filter_status)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);



                }
                elseif($filter_type!='all' && $filter_status!='all')
                {
                    $listings=Listing::where('user_id',auth()->user()->id)->where('status',$filter_status)->where('type',$filter_type)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);

                }


            }
            else
            {

                $listings=Listing::where('user_id',auth()->user()->id)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);


            }

            $page_data['listings']=$listings;
            return view('customer.mylisting.my_listings', $page_data);

        }
        else{

            echo" FOR OTHER LISTING  TYPE";
        }



    }

    public function selectListigForCustomerAppointment()
    {
        unsetListingTypeSessionHelper();
        $page_data=array();
        $listing_type=Listing_type::all();
        $page_data['listings_types']=$listing_type;
        $page_data['customer_appointment']='active';
        $page_data['navigation_name']='Appointments';
        return view('customer.customer_appointment.select_listings_for_customer_appointment', $page_data);

    }

    public function customerAppointmentList($listing_type)//workflow
    {
        setListingTypeSessionHelper($listing_type);
        $page_data=array();
        $page_data['customer_appointment']='active';
        $page_data['navigation_name']='Appointments';
        $page_data['current_route']='customerAppointmentList';
        $type=Listing_type::find($listing_type);

        if($type->slug=='real-estate')
        {

            $customerAppointments=Appointment::where('customer_id',auth()->user()->id)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);
            $page_data['customerAppointments']=$customerAppointments;
            return view('customer.customer_appointment.customer_appointment', $page_data);

        }
        else{

            echo" FOR OTHER LISTING  TYPE";
        }
    }

    public function selectListigForAgentAppointment()
    {

        unsetListingTypeSessionHelper();
        $page_data=array();
        $listing_type=Listing_type::all();
        $page_data['listings_types']=$listing_type;
        $page_data['agent_appointment']='active';
        $page_data['navigation_name']='Appointments';
        return view('customer.agent_appointment.select_listings_for_agent_appointment', $page_data);

    }



    public function agentAppointmentList($listing_type)
    {
        setListingTypeSessionHelper($listing_type);
        $page_data=array();
        $page_data['agent_appointment']='active';
        $page_data['navigation_name']='Appointments';
        $page_data['current_route']='agentAppointmentList';

        $type=Listing_type::find($listing_type);

        if($type->slug=='real-estate')
        {

                $agentAppointments=Appointment::where('agent_id',auth()->user()->id)->where('listing_type_id',$listing_type)->orderBy('id', 'DESC')->paginate(5);
                $page_data['agentAppointments']=$agentAppointments;
                return view('customer.agent_appointment.agent_appointment', $page_data);

        }
        else{

            echo" FOR OTHER LISTING  TYPE";
        }


    }

    function customerBookAppointment(Request $request)
    {
        $data=$request->all();
        if(!Auth::check())
        {
            return redirect()->route()->with('warning','Please Login Frist');
        }elseif(Auth::check() && (auth()->user()->id == $data['agent_id'])){
            return redirect()->back()->with('error',"You Can't Book your own Bussiness!");
        }

        $meeting_date = date('d-m-Y H:i:s',strtotime($data['date']));
        $metting_time = date('H:i',strtotime($data['date']));
        $meeting_date_time=$meeting_date." ".$metting_time;

        $appointment= new Appointment();
        $appointment['date']=Carbon::parse($meeting_date);
        $appointment['time']=$metting_time;
        $appointment['type']=$data['appointment_type'];
        $appointment['listing_id']=$data['listing_id'];
        $appointment['listing_type_id']=$data['listing_type_id'];
        $appointment['agent_id']=$data['agent_id'];
        $appointment['name']=$data['name'];
        $appointment['phone']=$data['phone'];
        $appointment['email']=$data['email'];
        $appointment['message']=$data['message'];
        $appointment['customer_id']=auth()->user()->id;

        $appointment->save();

        return redirect()->back()->with('message','Appointment placed to Agent');

    }


    public function checkWishlist(Request $request)
    {
        $data=$request->all();
        $id=$data['listing_id'];
        $color=9;

        $wish=auth()->user()->wishlist;
        $wishlist=json_decode($wish, TRUE);

        $updateWishlist=User::find(auth()->user()->id);

        if(in_array($id,$wishlist))
        {
            if (($index = array_search($id, $wishlist)) !== false) {
                unset($wishlist[$index]);
            }

            $updateWishlist->wishlist=json_encode($wishlist);
            $color=0;

        }
        else
        {
            array_push($wishlist,$id);
            $updateWishlist->wishlist=json_encode($wishlist,JSON_FORCE_OBJECT);
            $color=1;

        }

        $updateWishlist->save();
        return $color;

    }

    public function checkWishlistDetails($listing_type) //work
    {
        setListingTypeSessionHelper($listing_type);
        $type=Listing_type::find($listing_type);
        $wish=auth()->user()->wishlist;
        $wishlist=json_decode($wish, TRUE);
        $page_data['wishlist']='active';
        $page_data['navigation_name']='Wishlists';
        $page_data['current_route']='checkWishlistDetails';


        if($type->slug=='real-estate')
        {

            $listings=Listing::whereIn('id', $wishlist)->where('listing_type_id',$listing_type)->where('status',1)->orderBy('id', 'DESC')->paginate(5);
            $page_data['listings']=$listings;
            return view('customer.wishlist.wishlists', $page_data);

        }
        else{

            echo" FOR OTHER LISTING  TYPE";
            return view('restaurant.list-post');
        }


    }

    public function checkWishlistDelete($id)
    {
        $wish=auth()->user()->wishlist;
        $wishlist=json_decode($wish, TRUE);

        $updateWishlist=User::find(auth()->user()->id);

        if(in_array($id,$wishlist))
        {
            if (($index = array_search($id, $wishlist)) !== false) {
                unset($wishlist[$index]);
            }

            $updateWishlist->wishlist=json_encode($wishlist);
            $updateWishlist->save();

        }


        return redirect()->back()->with('message', 'Listing removed');

    }

    public function followUnfollow(Request $request)
    {
        $data=$request->all();
        $id=$data['agent_id'];


        $follow=auth()->user()->following_agent;
        $follower=json_decode($follow, TRUE);



        $updateFollower=User::find(auth()->user()->id);

        if(in_array($id,$follower))
        {

            if (($index = array_search($id, $follower)) !== false) {
                unset($follower[$index]);
            }

            $updateFollower->following_agent=json_encode($follower);
            $status=0;

        }
        else
        {
            array_push($follower,$id);
            $updateFollower->following_agent=json_encode($follower,JSON_FORCE_OBJECT);
            $status=1;

        }

        $updateFollower->save();


        $totalfollowers=0;
        $all_users=User::all();

        foreach ($all_users as $user) {

            $following=json_decode($user->following_agent, true);

            if(in_array($id,$following))
            {
                $totalfollowers++;
            }

        }

        $response['status']=$status;
        $response['totalfollowers']=$totalfollowers;
        return $response;

    }

    public function followingAgentView()
    {
        unsetListingTypeSessionHelper();
        $page_data=array();
        $follower=auth()->user()->following_agent;
        $follower=json_decode($follower, TRUE);
        $followingAgents=User::whereIn('id', $follower)->paginate(5);
        $page_data['followingAgents']=$followingAgents;
        $page_data['following_agent']='active';
        $page_data['navigation_name']='Following Agent';

        return view('customer.following_agent.following_agent', $page_data);
    }

    public function unfollowAgent($id)
    {
        $follow=auth()->user()->following_agent;
        $follower=json_decode($follow, TRUE);

        $updateFollower=User::find(auth()->user()->id);

        if(in_array($id,$follower))
        {

            if (($index = array_search($id, $follower)) !== false) {
                unset($follower[$index]);
            }

            $updateFollower->following_agent=json_encode($follower);
            $updateFollower->save();

        }

        return redirect()->back()->with('message', 'Unfollowed Agent');

    }

    public function saveRealEstateListing(Request $request)
    {
        $data=$request->all();
        $country_id=Country::where('code',$data['country_id'])->value('id');
        $newListing=new Listing();
        $attribute_property_details_id=Listing_attribute::where('listing_type_id',$data['listing_type_id'])->where('attribute_name','property_details')->value('id');

        $property_information=Listing_arrtibute_type::where('listring_attribute_id',$attribute_property_details_id)->get();

        $newListing['title']=$data['title'];
        $newListing['slug']=Str::slug($data['title']);
        $newListing['listing_type_id']=$data['listing_type_id'];
        $newListing['listing_attribute_id']=2;
        $newListing['user_id']=auth()->user()->id;
        $newListing['listing_arrtibute_type_id']=$data['category'];
      

        $newListing['country_id']=$country_id;
        $newListing['state_id']=$data['state_id'];
        $newListing['city_id']=$data['city_id'];
        $newListing['price']=$data['price'];
        $newListing['latitude']=$data['latitude'];
        $newListing['longitude']=$data['longitude'];
        $address=$data['address'].",".$data['area'].",".$data['postalcode'];
        $newListing['address']=$address;
        $newListing['property_id']= rand(1000, 9999);
        $newListing['short_description']=$data['description'];
        $newListing['year_build_in']=$data['year_build_in'];
        $newListing['area']=$data['size'];
        $newListing['bedroom']=$data['bedroom'];
        $newListing['bathroom']=$data['bathroom'];
        $newListing['garage']=$data['garage'];
        $newListing['status']=$data['status'];
        $newListing['type']=$data['type'];
        $newListing['near_by']='{"0":"school","1":"hospital","2":"shopping center"}';
        $newListing->save();

        return redirect()->route('showMyListings',$data['listing_type_id'])->with('message','Listing added successfully');


    }

    public function editRealEstateListing(Request $request ,$listing_id)
    {

        unsetListingTypeSessionHelper();
        $data=$request->all();
        $page_data=array();
        $listing=Listing::find($listing_id);
        $page_data['listing']=$listing;
        $page_data['property_details']= Listing_arrtibute_type::where('listring_attribute_id', 2)->get();
        $page_data['all_categories']=$listing->get_categories($listing->listing_type_id);
        $page_data['all_amenities']=$listing->get_anenities($listing->listing_type_id);
        $page_data['active_amenities']=json_decode($listing->amenities,true);
        $page_data['countries']=Country::all();
        $page_data['mylistings']='active';
        $page_data['navigation_name']='My Listings';
        $page_data['nearby_loc']=json_decode($listing->near_by,true);

        $page_data['school_count']=NearbyLocation::where('listing_id',$listing->id)->where('nearby_id',0)->count();
        $page_data['hospital_count']=NearbyLocation::where('listing_id',$listing->id)->where('nearby_id',1)->count();
        $page_data['shoppingcenter_count']=NearbyLocation::where('listing_id',$listing->id)->where('nearby_id',2)->count();
        // $page_data['park_count']=NearbyLocation::where('listing_id',$listing->id)->where('nearby_id',3)->count();
        return view('customer.mylisting.edit_listing', $page_data);
    }

    public function updateRealEstateListing(Request $request, $listing_id="",$form="")
    {
        $data=$request->all();

        if($form=='basic')
        {
            //update listing table
            $updateListing=Listing::find($listing_id);
            $updateListing['title']=$data['title'];
            $updateListing['slug']=Str::slug($data['title']);
            $updateListing['listing_arrtibute_type_id']=$data['category'];
            $updateListing['type']=$data['type'];
            $updateListing['short_description']=$data['description'];
            $updateListing['year_build_in']=$data['year_build_in'];
            $updateListing['area']=$data['size'];
            $updateListing['bedroom']=$data['bedroom'];
            $updateListing['bathroom']=$data['bathroom'];
            $updateListing['garage']=$data['garage'];
            $updateListing['status']=$data['status'];
            $updateListing['price']=$data['price'];
            $updateListing->save();
        }
        elseif($form=='propertydetails')
        {
            $updateListing=Listing::find($listing_id);
            $updateListing['listing_arrtibute_type_id']=$data['category'];
            
            $updateListing->save();

            $property_details = Listing_arrtibute_type::where('listring_attribute_id', 2)->get();
            foreach($property_details as $property){
                if($property->attributetype_to_value($listing_id)->count() > 0) {
                    foreach($property->attributetype_to_value($listing_id) as $attributeValue){
                        $this->update_property_details($data[$property->slug.'_id'], $data[$property->slug], $listing_id);
                    }
                } else {

                    $Listing_attribute_values_table= new Listing_attribute_value();
                    $Listing_attribute_values_table['listing_attribute_type_id'] = $data[$property->slug.'_id'];
                    $Listing_attribute_values_table['value'] = $data[$property->slug];
                    $Listing_attribute_values_table['listing_id'] = $listing_id;
                    $Listing_attribute_values_table->save();
                    
                }
            }

        }
        elseif($form=='features')
        {
            $features=$data['features'];
            $features=json_encode($features,JSON_FORCE_OBJECT);
            $updateListing=Listing::find($listing_id);
            $updateListing['amenities']=$features;
            $updateListing->save();

        }
        elseif($form=='tag')
        {
            $updateListing=Listing::find($listing_id);

            if($request->og_image){
                $randome_name = rand();
                
                $attachment = $randome_name.'.'.$request->og_image->getClientOriginalExtension();
                $request->og_image->move(public_path('uploads/seo/'), $attachment);
                if(!empty($request->old_og_image) && file_exists(public_path('uploads/seo/' . $request->old_og_image))){
                    unlink(public_path('uploads/seo/' . $request->old_og_image));
                }
            
            }else{
                $attachment = $request->old_og_image;
            }

            $updateListing['meta_title']=$data['meta_title'];
            $updateListing['meta_keywords']=$data['meta_keywords'];
            $updateListing['meta_description']=$data['meta_description'];
            $updateListing['og_title']=$data['og_title'];
            $updateListing['og_description']=$data['og_description'];
            $updateListing['og_image']=$attachment;
            $updateListing['json_ld']=$data['json_ld'];
            $updateListing['canonical']=$data['canonical'];
            $updateListing->save();

        }
        elseif( $form =='address')
        {
            $country_id=Country::where('code',$data['country_id'])->value('id');
            $updateListing=Listing::find($listing_id);

            $updateListing['country_id']=$country_id;
            $updateListing['state_id']=$data['state_id'];
            $updateListing['city_id']=$data['city_id'];
            $updateListing['latitude']=$data['latitude'];
            $updateListing['longitude']=$data['longitude'];
            $address=$data['address'].",".$data['area'].",".$data['postalcode'];
            $updateListing['address']=$address;
            $updateListing->save();


        }
        elseif( $form =='model'){
            $updateListing=Listing::find($listing_id);
             if($request->model){
                $randome_name = rand();
                $attachment = $randome_name.'.'.$request->model->getClientOriginalExtension();
                $request->model->move(public_path('assets/uploads/3d'), $attachment);
                if(!empty($request->old_model) && (file_exists('public/assets/uploads/3d/'.$request->old_model))){
                    unlink(public_path('assets/uploads/3d/'.$request->old_model));
                }
            
            }else{
                $attachment = $request->old_model;
            }
            $updateListing['model']=$attachment;
            $updateListing->save();
        }

        elseif( $form =='media')
        {
            $updateListing=Listing::find($listing_id);
            $uploadedproperty=isset($data['uploadedproperty']) ? $data['uploadedproperty']:array();
            $property_files=isset($data['property_files']) ? $data['property_files']:array();

            $uploadedfloor=isset($data['uploadedfloor']) ? $data['uploadedfloor']:array();
            $floor_files=isset($data['floor_files']) ? $data['floor_files']:array();

            $uploadedvideo=isset($data['uploadedvideo']) ? $data['uploadedvideo']:null;
            $video_files=isset($data['video_files']) ? $data['video_files']:array();

            $uploadVideolink=isset($data['singleVideoLink']) ? $data['singleVideoLink']:null;
            $video_link=isset($data['video_link']) ? $data['video_link']:array();

            //update  gallery images
            $updateListing['gallery'] = json_encode($uploadedproperty,JSON_FORCE_OBJECT);
            $updateListing->save();


            if(count($property_files)>0)
            {

                $current_gallary_image=json_decode($updateListing->gallery,true);


                foreach( $request->property_files as $key => $media_file)
                {

                    $file_extention = strtolower($media_file->getClientOriginalExtension());


                    if ($file_extention == 'png' || $file_extention == 'jpg' || $file_extention == 'svg' || $file_extention == 'gif' ) {
                        $filename = "gallery".rand().'.'. $file_extention;
                            $destinationPath = public_path('/uploads/real_estate/galleryImages/');
                            $media_file->move($destinationPath, $filename);
                            array_push($current_gallary_image, $filename);
                    }

                }
                $updateListing['gallery'] = json_encode($current_gallary_image,JSON_FORCE_OBJECT);
                $updateListing->save();
            }


            //update additional gallery images
            $updateListing['additional_gallery'] = json_encode($uploadedfloor,JSON_FORCE_OBJECT);
            $updateListing->save();



            if(count($floor_files)>0)
            {
                $current_additional_gallery_image=json_decode($updateListing->additional_gallery,true);
                foreach( $request->floor_files as $key => $media_file)
                {
                    $file_extention = strtolower($media_file->getClientOriginalExtension());

                    if ($file_extention == 'png' || $file_extention == 'jpg' || $file_extention == 'svg' || $file_extention == 'gif' ) {
                        $filename = "additional_gallery".rand().'.'. $file_extention;
                            $destinationPath = public_path('/uploads/real_estate/additionalGallery/');
                            $media_file->move($destinationPath, $filename);
                            array_push($current_additional_gallery_image, $filename);
                    }

                }
                $updateListing['additional_gallery'] = json_encode($current_additional_gallery_image,JSON_FORCE_OBJECT);
                $updateListing->save();
            }


            $updateListing['promo_video'] = json_encode($uploadedvideo,JSON_FORCE_OBJECT);
            $updateListing->save();

            $updateListing['promo_video'] = $uploadVideolink ;
            $updateListing->save();
            $videos=isset($data['video']) ? $data['video']:array();

            if(count($videos)>0)
            {
                foreach( $videos as $key => $media_file)
                {
                    $file_extention = strtolower($media_file->getClientOriginalExtension());
                    if ($file_extention == 'mp4') {
                        $filename = "promo_video".rand().'.'. $file_extention;
                        $destinationPath = public_path('/uploads/real_estate/video/');
                        $media_file->move($destinationPath, $filename);
                    }
                }
                $updateListing['promo_video'] = $filename;
                $updateListing->save();
            }else{
                $promo_video = $data['video-hide'];
                $oldVideoPath = public_path('/uploads/real_estate/video/' . $promo_video);
                if (file_exists($oldVideoPath) && is_file($oldVideoPath)) {
                    unlink($oldVideoPath);
                }

            }
        }

       return redirect()->back()->with('message', 'Information Updated');

    }

    public function update_property_details($row_id,$value,$listing_id)
    {
        $updateProperty_details=Listing_attribute_value::where('id',$row_id)->where('listing_id',$listing_id)->first();
        $updateProperty_details['value']=$value;
        $updateProperty_details->save();

    }



    public function saveImage($media_file)
    {

        $extension = $media_file->getClientOriginalExtension();


        $filename = $request->first_name . rand(0, 500) . '.' . $extension;

        if ($file_extention == 'jpg' || $file_extention == 'png' || $file_extention == 'svg' || $file_extention == 'gif' ) {
        $media_file->save(public_path() . 'uploads/real_estate/images/' . $filename);
        $user->image = $filename;
        }


    }

    public function setListingTypeSession( Request $request)
    {
        $listing_type_id = $request->listing_type_id;
        Session::forget('listing_type_id');
        Session::put('listing_type_id', $listing_type_id);
        return "setListingTypeSession";

    }

    public function unsetListingTypeSession()
    {

        Session::forget('listing_type_id');
        return "unsetListingTypeSession";

    }


    public function selectListigForWishlist()
    {
        unsetListingTypeSessionHelper();
        $page_data=array();
        $listing_type=Listing_type::all();
        $page_data['listings_types']=$listing_type;
        $page_data['wishlist']='active';
        $page_data['navigation_name']='Wishlists';
        return view('customer.wishlist.select_listings_for_wishlist', $page_data);

    }

    public function hideRealEstateListing($id)
    {
        $listing= Listing::find($id);
        $listing->update(['status'=>0]);

        return redirect()->back()->with('message', 'Listing has been hidden');
    }

    public function showRealEstateListing($id)
    {
        $listing= Listing::find($id);
        $listing->update(['status'=>1]);

        return redirect()->back()->with('message', 'Listing has been visible');
    }

    public function deleteRealEstateListing($id)
    {
        $listing= Listing::find($id);
        $listing->delete();

        return redirect()->back()->with('message', 'Listing has been deleted');
    }

    public function deleteAppointment($id)
    {
        $appointment= Appointment::find($id);
        $appointment->delete();
        return redirect()->back()->with('message', 'Appointment deleted');
    }


    public function joinZoomAsAgent($appointment_id) {

        $appointment=Appointment::find($appointment_id);
        $page_data['appointment_details'] = $appointment;
        return view('customer.agent_appointment.zoom_agent', $page_data);//8888888
    }

    public function joinZoomAsCustomer($appointment_id) {

        $appointment=Appointment::find($appointment_id);
        $page_data['appointment_details'] = $appointment;
        return view('customer.customer_appointment.zoom_customer', $page_data);
    }

    //----------------------------------

    function agentPaymentSettings()
    {
        unsetListingTypeSessionHelper();
        $page_data = array();

        $payment_keys = AgentPaymentSettings::where('user_id', auth()->user()->id)->get();


        if(count($payment_keys)==0)
        {

          $this->insert_gateways();
          $payment_keys = AgentPaymentSettings::where('user_id', auth()->user()->id)->get();

        }

        foreach ($payment_keys as  $single_gateway_keys) {

            if($single_gateway_keys->name=="paypal")
            {
                $paypal=$single_gateway_keys->toArray();
                $paypal_keys=json_decode($paypal['payment_keys']);
                $page_data['paypal']=$paypal;
                $page_data['paypal_keys']=$paypal_keys;
            }
            elseif($single_gateway_keys->name=="stripe")
            {
                $stripe=$single_gateway_keys->toArray();
                $stripe_keys=json_decode($stripe['payment_keys']);
                $page_data['stripe']=$stripe;
                $page_data['stripe_keys']=$stripe_keys;
            }

        }


        $page_data['payment_settings']='active';
        $page_data['navigation_name']='Payment Settings';

        return view('customer.payment_settings.agent_payment_settings', $page_data);
    }

    function agentPaymentSettingsUpdate(Request $request)
    {
        $data=$request->all();

        $method=$data['method'];
        $update_id=$data['update_id'];



        if($method=='paypal')
        {

            $keys=array();
            $paypal=AgentPaymentSettings::find($update_id);
            $paypal['status']=$data['status'];
            $paypal['mode']=$data['mode'];
            $keys['test_client_id']=$data['test_client_id'];
            $keys['test_secret_key']=$data['test_secret_key'];
            $keys['live_client_id']=$data['live_client_id'];
            $keys['live_secret_key']=$data['live_secret_key'];
            $paypal['payment_keys']=json_encode($keys);
            $paypal['user_id']=auth()->user()->id;
            $paypal->save();


        }
        elseif($method=='stripe')
        {
            $keys=array();
            $stripe=AgentPaymentSettings::find($update_id);
            $stripe['status']=$data['status'];
            $stripe['mode']=$data['mode'];
            $keys['test_key']=$data['test_key'];
            $keys['test_secret_key']=$data['test_secret_key'];
            $keys['public_live_key']=$data['public_live_key'];
            $keys['secret_live_key']=$data['secret_live_key'];
            $stripe['payment_keys']=json_encode($keys);
            $stripe['user_id']=auth()->user()->id;
            $stripe->save();
        }


       return redirect()->back()->with('message', 'key has been updated');

    }

    public function insert_gateways()
    {
        $keys=array();
        $paypal= new AgentPaymentSettings;
        $paypal['name']="paypal";
        $paypal['image']="paypal.png";
        $paypal['status']=1;
        $paypal['mode']="test";
        $keys['test_client_id']=" ";
        $keys['test_secret_key']=" ";
        $keys['live_client_id']=" ";
        $keys['live_secret_key']=" ";
        $paypal['payment_keys']=json_encode($keys);
        $paypal['user_id']=auth()->user()->id;
        $paypal->save();

        $keys=array();
        $stripe= new AgentPaymentSettings ;
        $stripe['name']="stripe";
        $stripe['image']="stripe.png";
        $stripe['status']=1;
        $stripe['mode']="test";
        $keys['test_key']=" ";
        $keys['test_secret_key']=" ";
        $keys['public_live_key']=" ";
        $keys['secret_live_key']=" ";
        $stripe['payment_keys']=json_encode($keys);
        $stripe['user_id']=auth()->user()->id;
        $stripe->save();

    }


    public function saveNearByLocation(Request $request)
    {
        $data= $request->all();


        $listing=Listing::find($data['listing_id']);
        $nearby=json_decode($listing->near_by,true);
        $type=$nearby[$data['nearby_id']];

        $insertNearbyLocation = new NearByLocation();
        $insertNearbyLocation->name=$data['name'];
        $insertNearbyLocation->type=$type;
        $insertNearbyLocation->nearby_id=$data['nearby_id'];
        $insertNearbyLocation->latitude=$data['latitude'];
        $insertNearbyLocation->longitude=$data['longitude'];
        $insertNearbyLocation->listing_id=$listing->id;
        $insertNearbyLocation->save();

        return redirect()->back()->with('message', 'Location has been added');

    }



    public function deleteNearByLocation($id)
    {

        $deleteNearbyLocation =NearByLocation::find($id);
        $deleteNearbyLocation->delete();

         return redirect()->back()->with('message', 'Location has been deleted');
    }

    public function addNearByLocation($listing_id = "")
    {
        $listing= Listing::find($listing_id);
        $nearby_loc=json_decode($listing->near_by,true);
        $page_data['listing']=$listing;
        $page_data['nearby_loc']=$nearby_loc;

        return view('customer.near_by_form.add_nearby_location', $page_data);
    }


    public function editNearByLocation($id)
    {

        $editLocation =NearByLocation::find($id);
        $listing= Listing::find($editLocation->listing_id);
        $nearby_loc=json_decode($listing->near_by,true);
        $page_data['editLocation']=$editLocation;
        $page_data['listing']=$listing;
        $page_data['nearby_loc']=$nearby_loc;

        return view('customer.near_by_form.edit_nearby_location', $page_data);

    }

    public function updateNearByLocation(Request $request,$id)
    {

        $data= $request->all();
        $updateNearByLocation=NearbyLocation::find($id);
        $listing=Listing::find($updateNearByLocation->listing_id);
        $nearby=json_decode($listing->near_by,true);
        $type=$nearby[$data['nearby_id']];

        $updateNearByLocation->name=$data['name'];
        $updateNearByLocation->type=$type;
        $updateNearByLocation->nearby_id=$data['nearby_id'];
        $updateNearByLocation->latitude=$data['latitude'];
        $updateNearByLocation->longitude=$data['longitude'];

        $updateNearByLocation->save();




        return redirect()->back()->with('message', 'Location has been updated successfully');

    }



    public function becomeAnAgentFor()
    {
        $listings_type = Listing_type::all();
        $packages = Package::where('status', 1)->take(3)->get();
        $page_data = array();
        $page_data['listings_types'] = $listings_type;
        $page_data['packages'] = $packages;
        $page_data['become_an_agent'] = 'active';
        $page_data['current_route']='becomeAnAgentFor';
        $page_data['navigation_name'] = 'Become an Agent';
        return view('customer.become_an_agent.become_an_agent', $page_data);
    }

    public function paymentForSubscription($package_id)
    {
        $page_data = array();
        $user=User::find(auth()->user()->id);
        $page_data['user_details']=$user;
        $page_data['address']=json_decode($user->address);
        $page_data['package'] = Package::find($package_id);
        $page_data['countries'] = Country::all();
        $page_data['become_an_agent'] = 'active';
        $page_data['navigation_name'] = 'Become an Agent';

        $page_data['paypal']= json_decode(get_settings('paypal'));
        $page_data['stripe']= json_decode(get_settings('stripe'));


        return view('customer.become_an_agent.payment_gateways', $page_data);
    }

    public function updateUserInfo(Request $request)
    {
        $data = $request->all();
        $updateUserInfo=User::find(auth()->user()->id);

            $address=array();
            $updateUserInfo['name'] =$data['name'];
            $address['country_code']=$data['country_code'];
            $address['state']=$data['state'];
            $address['addressline']=$data['addressline'];
            $address['zipcode']=$data['zipcode'];
            $updateUserInfo['address']=json_encode($address);
            $updateUserInfo->save();

            return redirect()->back()->with('message', 'User information been updated successfully');


    }



    public function customerMesssage($param1 = '', $param2 = '')
    {
        if(empty($param1)) {
            $param1 = 'message_home';
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2; // $param2 = message_thread_code
            $this->mark_thread_messages_read($param2);
            $message_thread_details = MessageThread::where('message_thread_code' , $param2)->first();
            $page_data['first_sender'] = $message_thread_details->sender;
            $page_data['sender'] = $message_thread_details->message_to_sender->name;
            $page_data['receiver'] = $message_thread_details->message_to_receiver->name;
            $page_data['messages'] = Message::where('message_thread_code' , $param2)->get();
        } else {
            $page_data['current_message_thread_code'] = '';
        }
        $message_threads = MessageThread::where('receiver', auth()->user()->id)
                            ->get();

        $page_data['message_threads'] = $message_threads;
        $page_data['message_inner_page_name'] = $param1;
        $page_data['customer_messages'] = 'active';
        $page_data['navigation_name'] = 'Messaging with Customers';
        return view('customer.customer_messages.message', $page_data);
    }

    function mark_thread_messages_read($message_thread_code)
    {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        Message::where('sender', '!=', auth()->user()->id)
            ->where('message_thread_code', $message_thread_code)
            ->update([
                'read_status' => 1,
            ]);
    }

    public function customerReplyMessage(Request $request, $param1='')
    {
        $data = $request->all();

        $message    = $data['message'];
        $sender     = auth()->user()->id;

        $data_message['message_thread_code']    = $param1; //$param1 = message_thread_code
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['read_status']            = 0;

        Message::create($data_message);

        return redirect()->route('customerMesssage', ['param1' => 'message_read', 'param2' => $param1])->with('message','Message sent');
    }

    public function getSingleMassege($param1)
    {
        $page_data['current_message_thread_code'] = $param1;

        $message_thread_details = MessageThread::where('message_thread_code' , $param1)->first();
        $page_data['first_sender'] = $message_thread_details->sender;
        $page_data['sender'] = $message_thread_details->message_to_sender->name;
        $page_data['receiver'] = $message_thread_details->message_to_receiver->name;
        $page_data['messages'] = Message::where('message_thread_code' , $param1)->where('read_status', 0)->where('sender', '!=', auth()->user()->id)->get();
        $this->mark_thread_messages_read($param1);

        return view('customer.customer_messages.message_read', $page_data);
    }


    public function agentMesssage($param1 = '', $param2 = '')
    {
        if(empty($param1)) {
            $param1 = 'message_home';
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2; // $param2 = message_thread_code
            $this->mark_thread_messages_read($param2);
            $message_thread_details = MessageThread::where('message_thread_code' , $param2)->first();
            $page_data['first_sender'] = $message_thread_details->sender;
            $page_data['sender'] = $message_thread_details->message_to_sender->name;
            $page_data['receiver'] = $message_thread_details->message_to_receiver->name;
            $page_data['messages'] = Message::where('message_thread_code' , $param2)->get();
        } else {
            $page_data['current_message_thread_code'] = '';
        }

        $message_threads = MessageThread::where('sender', auth()->user()->id)
                            ->get();



        $page_data['message_threads'] = $message_threads;
        $page_data['message_inner_page_name'] = $param1;
        $page_data['agent_messages'] = 'active';
        $page_data['navigation_name'] = 'Messaging with Agents';
        return view('customer.agent_messages.message', $page_data);
    }

    public function getAgentSingleMassege($param1)
    {
        $page_data['current_message_thread_code'] = $param1;

        $message_thread_details = MessageThread::where('message_thread_code' , $param1)->first();
        $page_data['first_sender'] = $message_thread_details->sender;
        $page_data['sender'] = $message_thread_details->message_to_sender->name;
        $page_data['receiver'] = $message_thread_details->message_to_receiver->name;
        $page_data['messages'] = Message::where('message_thread_code' , $param1)->where('read_status', 0)->where('sender', '!=', auth()->user()->id)->get();
        $this->mark_thread_messages_read($param1);

        return view('customer.agent_messages.message_read', $page_data);
    }


    public function agentReplyMessage(Request $request, $param1='')
    {
        $data = $request->all();

        $message    = $data['message'];
        $sender     = auth()->user()->id;

        $data_message['message_thread_code']    = $param1; //$param1 = message_thread_code
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['read_status']            = 0;

        Message::create($data_message);

        return redirect()->route('agentMesssage', ['param1' => 'message_read', 'param2' => $param1])->with('message','Message sent');
    }

    public function subscriptionStatus($value='')
    {
        $subscriptions = Subscription::where('user_id', auth()->user()->id)->get();
        $today = date("Y-m-d");
        $today_time = strtotime($today);

        foreach($subscriptions as $subscription) {
            $expiry_status = strtotime($subscription['expire_date']) < $today_time;

            if($expiry_status){
                $active_subscription = 0;
            } else {
                $active_subscription = $subscription->package_id;
            }
        }

        $packages = Package::all();
        $page_data['subscriptions'] = $subscriptions;
        $page_data['active_subscription'] = $active_subscription;
        $page_data['packages'] = $packages;
        $page_data['subscription'] = 'active';
        $page_data['navigation_name'] = 'Subscription';
        return view('customer.subscription.subscription', $page_data);
    }

    //-----------------------------------------------------------------------------------------------------------------------------

    public function subscriptionDetails()
    {
        unsetListingTypeSessionHelper();
        $all_subscription = Subscription::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        $current_subscription = Subscription::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->first();
        $today = date("Y-m-d");
        $today_time = strtotime($today);

        $expiry_status = strtotime($current_subscription->expire_date) < $today_time;
        $current_package = Package::find($current_subscription->package_id);

        $page_data['all_subscription'] = $all_subscription;
        $page_data['current_subscription'] = $current_subscription;
        $page_data['current_package'] = $current_package;
        $page_data['expiry_status'] = $expiry_status;
        $page_data['subscription'] = 'active';
        $page_data['navigation_name'] = 'Subscription';
        return view('customer.subscription.subscription', $page_data);
    }

    public function subscriptionDetailsOnly()
    {
        $all_subscription = Subscription::where('user_id', auth()->user()->id)->get();
        $current_subscription = Subscription::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->first();
        $today = date("Y-m-d");
        $today_time = strtotime($today);

        $expiry_status = strtotime($current_subscription->expire_date) < $today_time;
        $current_package = Package::find($current_subscription->package_id);

        $page_data['all_subscription'] = $all_subscription;
        $page_data['current_subscription'] = $current_subscription;
        $page_data['current_package'] = $current_package;
        $page_data['expiry_status'] = $expiry_status;
        $page_data['subscription'] = 'active';
        $page_data['navigation_name'] = 'Subscription';
        return view('customer.subscription.subscription_details', $page_data);
    }

    public function renewSubscription()
    {
        $packages = Package::all();
        $page_data['packages'] = $packages;
        $page_data['subscription'] = 'active';
        $page_data['navigation_name'] = 'Subscription';
        return view('customer.subscription.renew_subscription', $page_data);
    }

    public function purchasePackage($id)
    {
        //ssssssssssssssssssssssssss
        $user=User::find(auth()->user()->id);
        $current_package = Package::find($id);

        $page_data['user_details']=$user;
        $page_data['address']=json_decode($user->address);
        $page_data['current_package'] = $current_package;
        $page_data['packages'] = Package::all();
        $page_data['countries'] = Country::all();
        $page_data['subscription'] = 'active';
        $page_data['navigation_name'] = 'Subscription';
        $page_data['paypal']= json_decode(get_settings('paypal'));
        $page_data['stripe']= json_decode(get_settings('stripe'));

        return view('customer.subscription.checkout_page', $page_data);
    }

    public function subscriptionInvoice($id='')
    {
        $subscriptionDetails = Subscription::find($id);
        $user=User::find(auth()->user()->id);
        $address= json_decode($user->address);
        $page_data['country']=Country::where('code', $address->country_code)->first();
        $page_data['subscriptionDetails'] = $subscriptionDetails;
        $page_data['address'] = $address;

        // test

        $pdf = new Dompdf();
        $html = view('customer.subscription.subscription_invoice', $page_data)->render();

        // Load the HTML into Dompdf
        $pdf->loadHtml($html);

        // Render the PDF
        $pdf->render();

        // Output the generated PDF to the browser
        return $pdf->stream('document.pdf');

        //end

        $pdf = PDF::loadView('customer.subscription.subscription_invoice', $page_data);

        $fileName =  'subscription_invoice_id-'.$id.'-'.time().'.'. 'pdf' ;

        return $pdf->download($fileName);
    }


    public function modifyBilling()
    {
        $user=User::find(auth()->user()->id);
        $page_data['user_details']=$user;
        $page_data['address']=json_decode($user->address);
        $page_data['countries'] = Country::all();

        $page_data['subscription'] = 'active';
        $page_data['navigation_name'] = 'Modify Billing Information';
        return view('customer.subscription.modify_billing_information', $page_data);
    }

    public function blogList()
    {
        $page_data['blogs'] = 'active';
        $page_data['navigation_name'] = 'Blog';
        $page_data['blog_list'] = Blog::where('user_id', auth()->user()->id)->paginate(4);
        return view('customer.blog.blog', $page_data);
    }

    public function writeBlog()
    {
        $page_data['blog_categories'] = BlogCategory::all();
        $page_data['blogs'] = 'active';
        $page_data['navigation_name'] = 'Write A Blog';
        return view('customer.blog.add_blog', $page_data);
    }

    public function blogAdd(Request $request)
    {
        $data=$request->all();
        $blog=new Blog;
        $blog['blog_category_id'] = $data['blog_category_id'];
        $blog['user_id'] = auth()->user()->id;
        $blog['title'] = $data['title'];
        $blog['description'] = $data['description'];
        $blog['is_popular'] = 0;
        $blog['status'] = 0;
        $blog['keywords'] = $data['keywords'];
        $blog['meta_title'] = $data['meta_title'];
        $blog['meta_keywords'] = $data['meta_keywords'];
        $blog['meta_description'] = $data['meta_description'];
        $blog['og_title'] = $data['og_title'];
        $blog['og_description'] = $data['og_description'];
        $blog['json_ld'] = $data['json_ld'];
        $blog['canonical'] = $data['canonical'];

        if(!empty($data['thumbnail'])){

            $thumbnailName = time().'.'.$data['thumbnail']->extension();

            $data['thumbnail']->move(public_path('uploads/blog/'), $thumbnailName);
            
            $blog['thumbnail']  = $thumbnailName;
        } else {
            $blog['thumbnail'] = '';
        }

        if(!empty($data['og_image'])){

            $thumbnailName = time().'.'.$data['og_image']->extension();

            $data['og_image']->move(public_path('uploads/seo/'), $thumbnailName);
            
            $blog['og_image']  = $thumbnailName;
        } else {
            $blog['og_image'] = '';
        }

        $blog->save();

        return redirect()->back()->with('message', 'Blog added successfully');
    }

    public function editBlog($id='')
    {
        $page_data['blog_categories'] = BlogCategory::all();
        $page_data['blog'] = Blog::find($id);
        $page_data['blogs'] = 'active';
        $page_data['navigation_name'] = 'Write A Blog';
        return view('customer.blog.edit_blog', $page_data);
    }

    public function blogUpdate(Request $request, $id='')
    {
        $data = $request->all();
        $blog = Blog::find($id);
        $data['is_popular'] = $blog->is_popular;

        if(!empty($data['thumbnail'])){
            $randome_name = rand();
            $thumbnail = $randome_name.'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('uploads/blog/'), $thumbnail);
            if(!empty($request->old_thumbnail) && file_exists(public_path('uploads/blog/' . $request->old_thumbnail))){
                unlink(public_path('uploads/blog/' . $request->old_thumbnail));
            }
        
        }else{
            $thumbnail = $request->old_thumbnail;
        }

        if(!empty($data['og_image'])){
            $randome_name = rand();
            $attachment = $randome_name.'.'.$request->og_image->getClientOriginalExtension();
            $request->og_image->move(public_path('uploads/seo/'), $attachment);
            if(!empty($request->old_og_image) && file_exists(public_path('uploads/seo/' . $request->old_og_image))){
                unlink(public_path('uploads/seo/' . $request->old_og_image));
            }
        
        }else{
            $attachment = $request->old_og_image;
        }

        Blog::where('id', $id)->update([
            'blog_category_id' => $data['blog_category_id'],
            'user_id' => auth()->user()->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'is_popular' => $data['is_popular'],
            'status' => $blog->status,
            'keywords' => $data['keywords'],
            'thumbnail' => $thumbnail,
            'meta_title' => $data['meta_title'],
            'meta_keywords' => $data['meta_keywords'],
            'meta_description' => $data['meta_description'],
            'og_title' => $data['og_title'],
            'og_description' => $data['og_description'],
            'json_ld' => $data['json_ld'],
            'canonical' => $data['canonical'],
            'og_image' => $attachment,
        ]); 

        return redirect()->back()->with('message','Blog updated successfully.');
    }

    public function blogDelete($id='')
    {
        $blog = Blog::find($id);

        $thumbnailPathName = 'public/uploads/blog/' . $blog->thumbnail;

        if(!empty($blog->thumbnail) && file_exists($thumbnailPathName)){
            unlink($thumbnailPathName);
        }

        $blog->delete();
        return redirect()->back()->with('message','Blog deleted successfully.');
    }


    // Zoom Link Agent
    public function ZoomLink(Request $request, $id){
        $validated = $request->all([
            'zoom_meeting_link' => 'required',
        ]);
        $zoom_update= Appointment::find($id);
        $zoom_update->zoom_meeting_link =  $request->zoom_meeting_link;
        $zoom_update->update();
        return redirect()->back()->with('message','Zoom Meeting Link Add successfully.');
    }


}

