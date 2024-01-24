<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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
use App\Models\AgentReview;
use App\Models\Currency;
use App\Models\Review;
use App\Models\Package;
use App\Models\PendingSubscription;
use App\Models\Subscription;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Faq;
use Illuminate\Support\Facades\Hash;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Message;
use App\Models\Calculator_attribute;
use App\Models\MessageThread;
use Session;
use App\Models\EmailSubscribe;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $page_data['blogs'] = Blog::where('is_popular', 1)->where('status' , 1)->take(3)->get();
        $page_data['packages'] = Package::where('status', 1)->take(3)->get();
        $page_data['listings'] = Listing::take(6)->get();
        $page_data['cities'] = City::take(10)->get();
        $array = array();
        foreach(City::get() as $city){
            $country = Country::where('id',$city->country_id)->first();
            if(!in_array($city->country_id, $array)){
                array_push($array, $country->id);
            }
        }
        $countries = Country::whereIn('id', $array)->orderBy('name', 'asc')->get();
        $page_data['countries']= $countries;
        $page_data['categoris'] = Listing_arrtibute_type::where('listring_attribute_id', 1)->get();
        $page_data['property_category'] = Listing_arrtibute_type::where('listring_attribute_id', 1)->take(4)->get();
        $page_data['states'] = State::all();
        $page_data['featured_cities'] = City::where('is_featured', 1)->get();
        $page_data['reviews'] = Review::orderBy('id', 'DESC')->get();
        $page_data['faqs'] = Faq::all();
        $page_data['users'] = User::where('role', 'user')->get();
        return view('global.home', $page_data);
    }

    public function realEstateHome()
    {
        $page_data['blogs'] = Blog::where('is_popular', 1)->get();
        $page_data['listings'] = Listing::where('is_featured', 1)->get();
        $page_data['faqs'] = Faq::all();
        return view('real_estate.home', $page_data);
    }

    public function subscriptionPackages()
    {
        $page_data['packages'] = Package::where('status', 1)->take(3)->get();
        $page_data['faqs'] = Faq::all();
        return view('global.subscription', $page_data);
    }

    public function realeStateListings()
    {
        $page_data['categoris'] = Listing_arrtibute_type::all();
        $listings=Listing::paginate(8);
        $total_listings = count(Listing::where('status', 1)->get());
        $left_search_options=Listing::get();
        $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
        $real_estate_catagory=Listing_attribute::where('attribute_name','category')->where('listing_type_id',$listing_type)->first();
        if(!empty($real_estate_catagory)){
        $real_estate_categories=Listing_arrtibute_type::where('listring_attribute_id',$real_estate_catagory->id)->get();
        }else{
            $real_estate_categories = '';
        }


        $amenities_id=Listing_attribute::where('attribute_name','amenities')->where('listing_type_id',$listing_type)->first();
        if(!empty($amenities_id)){
         $all_amenities=Listing_arrtibute_type::where('listring_attribute_id',$amenities_id->id)->get();
        }else{
            $all_amenities = '';
        }  
        $area=Listing_arrtibute_type::where('type','area')->value('id');
        $max_area=Listing_attribute_value::where('listing_attribute_type_id',$area)->max('value');
        $page_data['max_area']=$max_area;
        $page_data['min_value']=Listing::where('listing_type_id',$listing_type)->min('price');
        $page_data['max_value']=Listing::where('listing_type_id',$listing_type)->max('price');
        $page_data['listings']=$listings;
        $page_data['total_listings']=$total_listings;
        $page_data['all_amenities']=$all_amenities;
        $page_data['cities']=City::all();
        $page_data['states']=State::all();
        $page_data['real_estate_categories']=$real_estate_categories;
        $page_data['left_search_options']=$left_search_options;
        $page_data['price_amount']="";

        $location_response = array();
        
        foreach($listings as $listing){

            $info = array(
                'name' => $listing->title,
                'lngLat' => [ $listing->longitude, $listing->latitude ]
            );
            array_push($location_response, $info);

        }
        
         $page_data['locations'] = json_encode($location_response);
         Session::forget('property_view');
         Session::put('property_view', 'grid_view');


         return view('real_estate.filter',$page_data);
    }


    public function realeStateListingsFilter(Request $request,$type = "")
    {

        $filter=$request->all();

        $left_search_options=Listing::get();
        $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
        $real_estate_catagory=Listing_attribute::where('attribute_name','category')->where('listing_type_id',$listing_type)->first();
        if($real_estate_catagory){
          $real_estate_categories=Listing_arrtibute_type::where('listring_attribute_id',$real_estate_catagory->id)->get();
        }else{
            $real_estate_categories = '';
        }


        $amenities_id=Listing_attribute::where('attribute_name','amenities')->where('listing_type_id',$listing_type)->first();
        if($amenities_id){
         $all_amenities=Listing_arrtibute_type::where('listring_attribute_id',$amenities_id->id)->get();
        }else{
            $all_amenities = '';
        }

         $query = Listing::query();

         if(!empty($type))
        {
            $listing_arrtibute_type =  Listing_arrtibute_type::where('slug',$type)->first();
            $query->where('listing_arrtibute_type_id', $listing_arrtibute_type->id);
            $page_data['type']= $type;
        } else if(!empty($filter['searched_category'])){
            $type = $filter['searched_category'];
            $listing_arrtibute_type =  Listing_arrtibute_type::where('slug',$type)->first();
            $query->where('listing_arrtibute_type_id', $listing_arrtibute_type->id);
            $page_data['type']= $type;
        }

        if(isset($filter['search']))
        {
            $query->where('slug', 'LIKE', "%{$filter['search']}%")
                ->orwhere('address', 'LIKE', "%{$filter['search']}%")
                ->orwhere('short_description', 'LIKE', "%{$filter['search']}%");

            $page_data['searched_word']= $filter['search'];
        }



        if(isset($filter['searched_type']))
        {
            $query->where('type', $filter['searched_type']);
            $page_data['searched_type']= $filter['searched_type'];
        }
        

        if(isset($filter['bedroom']))
        {
            $query->where('bedroom', $filter['bedroom']);
            $page_data['searched_bedroom']= $filter['bedroom'];


        }


        if(isset($filter['bathroom']))
        {
            $query->where('bathroom', $filter['bathroom']);
            $page_data['searched_bathroom']=$filter['bathroom'];

        }
        

        if(isset($filter['garage']))
        {

            $query->where('garage', $filter['garage']);
            $page_data['searched_garage']=$filter['garage'];


        }
        $priceRanges = $request->input('priceRanges');




        if(isset($filter['min_price']) && isset($filter['max_price']))
        {
            if($filter['min_price']!='' && $filter['max_price']!='')
            {
                $query->whereBetween('price', [$filter['min_price'], $filter['max_price']]);
            }
            $page_data['searched_min_price_range']=$filter['min_price'];
            $page_data['searched_max_price_range']=$filter['max_price'];
        }


        if(isset($filter['searched_amenities']))
        {

            $listing_id_array=array();
            $listing = Listing::get();
            foreach($listing as $value){
                $amenities = $value->amenities;
                foreach(json_decode($amenities) as $item){
                    if($item == $filter['searched_amenities']){
                        array_push($listing_id_array, $value->id);
                    }
                }
            }

            $query->whereIn('id', $listing_id_array);

            $page_data['searched_amenities'] = $filter['searched_amenities'];
        }


        if(isset($filter['searched_cities']))
        {

            $query->where('city_id', $filter['searched_cities']);

            $page_data['searched_cities']= $filter['searched_cities'];

        }

        if(isset($filter['searched_states']))
        {

            $query->where('state_id', $filter['searched_states']);

            $page_data['searched_states']= $filter['searched_states'];

        }

        $listings = $query->paginate(8);

        $total_listings = count(Listing::where('status', 1)->get());

        $area=Listing_arrtibute_type::where('type','area')->value('id');
        $max_area=Listing_attribute_value::where('listing_attribute_type_id',$area)->max('value');
        $page_data['max_area']=$max_area;
        $page_data['min_value']=Listing::where('listing_type_id',$listing_type)->min('price');
        $page_data['max_value']=Listing::where('listing_type_id',$listing_type)->max('price');
        $page_data['cities']=Listing::select('city_id')->distinct()->get();
        $page_data['country']=Listing::select('country_id')->distinct()->get();
        $page_data['states']=Listing::select('state_id')->distinct()->get();
        $page_data['listings']=$listings;
        $page_data['total_listings']=$total_listings;
        $page_data['cities']=City::all();
        $page_data['states']=State::all();
        $page_data['all_amenities']=$all_amenities;
        $page_data['real_estate_categories']=$real_estate_categories;
        $page_data['left_search_options']=$left_search_options;
        $page_data['price_amount']="";
        $page_data['categoris'] = Listing_arrtibute_type::all();
        
        $location_response = array();
        
        foreach($listings as $listing){

            $info = array(
                'name' => $listing->title,
                'lngLat' => [ $listing->longitude, $listing->latitude ]
            );
            array_push($location_response, $info);

        }
        
         $page_data['locations'] = json_encode($location_response);
         Session::forget('property_view');
         Session::put('property_view', 'grid_view');
        return view('real_estate.filter',$page_data);


    }

    public function setPropertyViewSession(Request $request,$view_type)
    {

        $request->session()->put('property_view', $view_type);

    }


    public function singlePropertyView($slug, $listing_id)
    {

        $page_data=array();
        $listing=Listing::find($listing_id);
        $listing_type=$listing->listing_to_listingtype;
        $listing_attribute=$listing_type->listingtype_to_attribute;
        $nearby_properties = $listing->listing_to_nearby;
        $category=Listing_arrtibute_type::where('id', $listing->listing_arrtibute_type_id)->first(); //from listing_attribute_type table
        $property_details_id=Listing_attribute::where('attribute_name','property_details')->value('id');
        $specific_property_value=Listing_attribute_value::where('listing_id',$listing_id)->get();
        //attribute_value_to_attribute_type->
        $amenity_id=$listing_type->listingtype_to_attribute->where('attribute_name','amenities')->first()->id;
        $amenities=Listing_arrtibute_type::where('listring_attribute_id',$amenity_id)->get();

        $related_listings=Listing::where('listing_arrtibute_type_id',$listing->listing_arrtibute_type_id)->where('id','!=',$listing->id)->get();
        $reviews=Review::where('listing_id',$listing->id)->where('status',1)->get();
        $avg_rating=0;

        if(Auth::check())
        {
            $user_review_count=Review::where('listing_id',$listing->id)->where('status',1)->where('user_id',auth()->user()->id)->get();

        }
        else{
            $user_review_count=Review::where('listing_id',$listing->id)->where('status',1)->get();
        }


        $page_data['user_review_count']=$user_review_count;

        foreach($reviews as $ratings)
        {
            $avg_rating+=(int)$ratings->rating;

        }

        $total_review=count($reviews);
        if($total_review==0)
        {
            $avg_rating=0;
        }
        else
        {
            $avg_rating=$avg_rating/$total_review;

        }


        $page_data['avg_rating']=$avg_rating;
        $page_data['total_review']=$total_review;



        foreach ($listing->listing_to_listing_attribute_type_values as $listing_property )
        {

            $type_name=get_property_type($listing_property->listing_attribute_type_id);

            if( strtolower($type_name)=='price' || strtolower($type_name)=='amount' || strtolower($type_name)=='value')
            {
                $listing['price']=$listing_property->value;
            }

        }

        $property_details=$listing->get_property_details($listing->listing_type_id,$listing->id);


        $page_data['property_details']= $property_details;
        $page_data['listing'] = $listing;
        $page_data['listing_type'] = $listing_type;
        $page_data['listing_attribute'] = $listing_attribute;
        $page_data['category'] = $category;
        $page_data['property_details_id'] = $property_details_id;
        $page_data['specific_property_value'] = $specific_property_value;
        $page_data['amenities'] = $amenities;
        $page_data['related_listings'] = $related_listings;
        $page_data['reviews'] = $reviews;

        $page_data['nearby_schools'] = $this->nearbyJson($nearby_properties->where('type', 'school'), $listing);
        $page_data['nearby_hospitals'] = $this->nearbyJson($nearby_properties->where('type', 'hospital'), $listing);
        $page_data['nearby_shopping_centers'] = $this->nearbyJson($nearby_properties->where('type', 'shopping center'), $listing);
        $page_data['nearby_parks'] = $this->nearbyJson($nearby_properties->where('type', 'park'), $listing);


        // Filter data
        $filter_listing_type = Listing_type::whereSlug('real-estate')->first()->value('id');
        $real_estate_catagory = Listing_attribute::where('attribute_name','category')->where('listing_type_id',$filter_listing_type)->first();
        $real_estate_categories = Listing_arrtibute_type::where('listring_attribute_id',$real_estate_catagory->id)->get();



        

        $amenities_id = Listing_attribute::where('attribute_name','amenities')->where('listing_type_id',$filter_listing_type)->first();
        $all_amenities = Listing_arrtibute_type::where('listring_attribute_id',$amenities_id->id)->get();

        $page_data['real_estate_categories'] = $real_estate_categories;
        $page_data['all_amenities'] = $all_amenities;
        $page_data['cities'] = City::all();
        $page_data['states'] = State::all();
        $page_data['categoris'] = Listing_arrtibute_type::all();
        $page_data['allmortgage'] = Calculator_attribute::orderBy('orders', 'ASC')->get();
        return view('real_estate.single_property',$page_data);

    }

    function nearbyJson($nearbys, $listing) {
        $response = array();

        foreach($nearbys as $nearby){

            $info = array(
                'name' => $nearby->name,
                'lngLat' => [ $nearby->longitude, $nearby->latitude ]
            );
            array_push($response, $info);

        }

        $info = array(
            'name' => $listing->title,
            'lngLat' => [ $listing->longitude, $listing->latitude ],
            'isPrimary' => true,
        );

        array_push($response, $info);

        return json_encode($response);
    }


    public function singlePropertyReview(Request $request, $listing_id)
    {

        if(!Auth::check())
        {
            return redirect()->route('login');

        }

         $data=$request->all();

             $extension="";
	    	if (isset($data['document'])) {
                $file = $data['document'];
	            $filename = $file->getClientOriginalName();
	            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file


	            $file->move(public_path('public/uploads/real_estate/review'), $filename);
	            $data['document'] = $filename;

	        } else {
	        	$data['document'] = '';
	        }

            if($extension=="pdf" || $extension=="jpg" || $extension=="png" || $extension=="docx" )
            {
                $final_file=$data['document'];
            }
            else{
                $final_file="";
            }


                $review= new Review;

                $review['rating']=$data['rating'];
                $review['review']=$data['review'];
                $review['user_id']=auth()->user()->id;
                $review['listing_id']=$listing_id;
                $review['document']=$final_file;
                $review['like']='[]';
                $review['dislike']='[]';
                $review['comment']='[]';

                $review->save();

                return redirect()->back()->with('message','You have successfully Review Done!.');






    }


    public function singlePropertyLikeDislike(Request $request)
    {
        $data=$request->all();

        $review=Review::where('listing_id',$data['listing_id'])->where('id',$data['review_id'])->first();


       $like=json_decode($review->like, true);
         $dislike=json_decode($review->dislike, true);

        $previous_like=$review->like;
        $previous_like=json_decode($previous_like,true);

        $previous_dislike=$review->dislike;
        $previous_dislike=json_decode($previous_dislike,true);


        if($data['type']=="like")
        {

            if(in_array(auth()->user()->id, $previous_dislike))
            {
                $index=array_search(auth()->user()->id, $previous_dislike);
                unset($previous_dislike[$index]);

                $total_dislike=count($previous_dislike);

                $new_dislike=json_encode($previous_dislike);
                $review->dislike=$new_dislike;


            }
            else{
                $total_dislike=count($previous_dislike);
            }

            if(!in_array(auth()->user()->id, $previous_like))
            {
                array_push($previous_like,auth()->user()->id);
                $total_like=count($previous_like);

            }
            else
            {
                $total_like=count($previous_like);
            }


            $new_like=json_encode($previous_like);

            $review->like=$new_like;
            $review->save();

            $react=array();
            $react['like']=$total_like;
            $react['dislike']=$total_dislike;


            echo json_encode($react);




        }

        if($data['type']=="dislike")
        {

            if(in_array(auth()->user()->id, $previous_like))
            {
                $index=array_search(auth()->user()->id, $previous_like);
                unset($previous_like[$index]);

                $total_like=count($previous_like);

                $new_like=json_encode($previous_like);
                $review->like=$new_like;


            }
            else{
                $total_like=count($previous_like);
            }

            if(!in_array(auth()->user()->id, $previous_dislike))
            {
                array_push($previous_dislike,auth()->user()->id);
                $total_dislike=count($previous_dislike);

            }
            else
            {
                $total_dislike=count($previous_dislike);
            }


            $new_dislike=json_encode($previous_dislike);

            $review->dislike=$new_dislike;
            $review->save();

            $react=array();
            $react['like']=$total_like;
            $react['dislike']=$total_dislike;


            echo json_encode($react);


        }


    }

    public function singlePropertyComment(Request $request)
    {
        $data=$request->all();

        $review=Review::find($data['review_id']);

        $previous_comment=json_decode($review->comment, true);


        $RandomNumber = rand(10000,99999);
        $previous_comment[auth()->user()->id.$RandomNumber]=$data['comment'];



        $new_comment=json_encode($previous_comment);
        $review->comment=$new_comment;

        $review->save();

        return redirect()->back()->with('message','commented succfully');


    }


    public function customerQuery(Request $request)
    {
        $data = $request->all();
        
        $message    = $data['message'];
        $receiver   = $data['agent_id'];

        $sender     = auth()->user()->id;

        //check if the thread between those 2 users exists, if not create new thread
        $check = MessageThread::where('sender', $sender)->where('receiver', $receiver)->count();

        if ($check == 0) {

            $data_message_thread= new MessageThread();
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['receiver']            = $receiver;

            $data_message_thread->save();


        }
        if ($check > 0) {
            $message_thread_code = MessageThread::where('sender', $sender)->where('receiver', $receiver)->value('message_thread_code');
        }


        $data_message= new Message();

        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['read_status']            = 0;

        $data_message->save();

        $response['code'] = $message_thread_code;

        $response['status'] = 'success';

        return $response;
    }

    // agent details for

    public function agentDetails(Request $request, $agent_id)
    {

        $data = $request->all();


       if (isset($data['type']) || isset($data['popular']))
       {
          $type=$data['type'];
          $popular=$data['popular'];

          $agentListings=Listing::when($type!='all', function ($q) use($type) {
                                    $q->where('type',$type);
                                   })
                                   ->when($popular=='new_to_old', function ($q) use($popular) {
                                    $q->orderBy('id', 'DESC');
                                   })
                                   ->when($popular=='high_to_low', function ($q) use($popular) {
                                    $q->orderBy('price', 'DESC');
                                   })
                                   ->when($popular=='low_to_high', function ($q) use($popular) {
                                    $q->orderBy('price', 'ASC');
                                   })
                                   ->where('user_id',$agent_id)
                                   ->get();


           $page_data['type']=$type;
           $page_data['popular']=$popular;

       }
       else
       {
        $agentListings=Listing::where('user_id',$agent_id)->get();
       }

        $agent=User::find($agent_id);
        $address=json_decode($agent->address, true);

        $company=json_decode($agent->company, true);

        if (is_array($company) && array_key_exists('real-estate', $company)) {
            $company = $company['real-estate'];
        } else {
            $company = "";
        }

        $agentReview=AgentReview::orderBy('id', 'DESC')->get();

        $rating= AgentReview::where('agent_id',$agent_id)->sum('rating');
        $total_review=0;
        if(Auth::check())
        {
            $user_review_count=AgentReview::where('user_id', auth()->user()->id)->where('agent_id',$agent->id)->count();
        }
        else{
            $user_review_count=0;
        }

        if($user_review_count>0)
        {
            $total_review=$user_review_count;
            $user_review_count=AgentReview::where('agent_id',$agent->id)->first();
            $user_review_count=$user_review_count->toArray();
            $hideReviewSection="";
            $avgrating=number_format($rating/$total_review,1);
        }
        else
        {
            $avgrating=0;
            $total_review=0;
            $user_review_count=array();
            $hideReviewSection="d-none";
        }


        $page_data['avgrating']=$avgrating;
        $page_data['total_review']=$total_review;
        $page_data['categoris'] = Listing_arrtibute_type::all();
        $page_data['cities'] = City::all();

        $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
        $real_estate_catagory=Listing_attribute::where('attribute_name','category')->where('listing_type_id',$listing_type)->first();
        $real_estate_categories=Listing_arrtibute_type::select('id','type')->where('listring_attribute_id',$real_estate_catagory->id)->get();

        $totalProperty=Listing::where('user_id',$agent_id)->count();
        $category_name=array();
        $category_count=array();
        $rent_count=Listing::where('user_id',$agent_id)->where('type','rent')->count();
        $sell_count=Listing::where('user_id',$agent_id)->where('type','sell')->count();

        foreach ($real_estate_categories as $category) {
            $counter=Listing::where('user_id',$agent_id)->where('listing_arrtibute_type_id',$category->id)->count();
            $category_count[$category->type]=$counter;

        }


        //totalFollowers

        $totalfollowers=0;
        $all_users=User::all();

        foreach ($all_users as $user) {

            $following=json_decode($user->following_agent, true);

            if(in_array($agent_id,$following))
            {
                $totalfollowers++;
            }

        }

        $page_data['hideReviewSection']=$hideReviewSection;
        $page_data['user_review_count']=$user_review_count;
        $page_data['totalfollowers']=$totalfollowers;
        $page_data['address']=$address;
        $page_data['company']=$company;
        $page_data['agent']=$agent;
        $page_data['agentListings']=$agentListings;
        $page_data['agentReview']  = AgentReview::where('agent_id',$agent_id)->get();
        $page_data['totalProperty']=$totalProperty;
        $page_data['category_name']=$category_name;
        $page_data['category_count']=$category_count;
        $page_data['rent_count']=$rent_count;
        $page_data['sell_count']=$sell_count;
        return view('real_estate.agent_details',$page_data);

    }

    public function saveAgentReview(Request $request,$agent_id)
    {

        if(Auth::check())
        {
            $data=$request->all();

            $newReview= new AgentReview();
            $newReview->user_id=auth()->user()->id;
            $newReview->agent_id=$agent_id;
            if($data['review']){
             $newReview->review=$data['review'];
            }else{
                $newReview->review = '';
            }
            $newReview->rating=$data['rating'];
            $newReview->save();

            return redirect()->route('agentDetails',$agent_id)->with('message','Review given successfully');

        }
        else{
            return redirect()->route('login')->with('message','Please login Frist');

        }


    }


    public function agentReviewLikeDislike(Request $request)
    {
        $data=$request->all();

        $review=AgentReview::where('agent_id',$data['agent_id'])->where('id',$data['review_id'])->count();

        if($review>0)
        {
            $review=AgentReview::where('agent_id',$data['agent_id'])->where('id',$data['review_id'])->first();

            $like=json_decode($review->like, true);
            $dislike=json_decode($review->dislike, true);

            $previous_like=$review->like;
            $previous_like=json_decode($previous_like,true);

            $previous_dislike=$review->dislike;
            $previous_dislike=json_decode($previous_dislike,true);


        if($data['type']=="like")
        {

            if(in_array(auth()->user()->id, $previous_dislike))
            {
                $index=array_search(auth()->user()->id, $previous_dislike);
                unset($previous_dislike[$index]);

                $total_dislike=count($previous_dislike);

                $new_dislike=json_encode($previous_dislike);
                $review->dislike=$new_dislike;


            }
            else{
                $total_dislike=count($previous_dislike);
            }

            if(!in_array(auth()->user()->id, $previous_like))
            {
                array_push($previous_like,auth()->user()->id);
                $total_like=count($previous_like);

            }
            else
            {
                $total_like=count($previous_like);
            }


            $new_like=json_encode($previous_like);

            $review->like=$new_like;
            $review->save();

            $react=array();
            $react['like']=$total_like;
            $react['dislike']=$total_dislike;


            echo json_encode($react);




        }

        if($data['type']=="dislike")
        {

            if(in_array(auth()->user()->id, $previous_like))
            {
                $index=array_search(auth()->user()->id, $previous_like);
                unset($previous_like[$index]);

                $total_like=count($previous_like);

                $new_like=json_encode($previous_like);
                $review->like=$new_like;


            }
            else{
                $total_like=count($previous_like);
            }

            if(!in_array(auth()->user()->id, $previous_dislike))
            {
                array_push($previous_dislike,auth()->user()->id);
                $total_dislike=count($previous_dislike);

            }
            else
            {
                $total_dislike=count($previous_dislike);
            }


            $new_dislike=json_encode($previous_dislike);

            $review->dislike=$new_dislike;
            $review->save();

            $react=array();
            $react['like']=$total_like;
            $react['dislike']=$total_dislike;


            echo json_encode($react);


        }

    }
    else
    {
        $react=array();
        $react['like']=0;
        $react['dislike']=0;
        echo json_encode($react);
    }


    }


    public function editAgentReview(Request $request, $agent_id)
    {
        $data=$request->all();

        $review=AgentReview::where('user_id',auth()->user()->id)->where('agent_id',$agent_id)->first();

        $editReview=AgentReview::find( $review->id);
         $editReview->rating=$data['rating'];
        if($data['review']){
         $editReview->review=$data['review'];
        }else{
            $editReview->review = '';
        }
        $editReview->save();

        return redirect()->route('agentDetails',$agent_id)->with('message','Review updated successfully');



    }

    public function editlistingReview(Request $request, $listing_id)
    {
        $data=$request->all();

        $review=Review::where('user_id',auth()->user()->id)->where('listing_id',$listing_id)->first();
        $slug = Listing::where('id', $listing_id)->value('slug');
        $editReview=Review::find( $review->id);
        $editReview->rating=$data['rating'];
        $editReview->review=$data['review'];
        $editReview->save();

        return redirect()->route('singlePropertyView',['slug' => $slug, 'id' => $listing_id])->with('message','Review updated successfully');



    }

    public function commentOnAgentReview(Request $request)
    {
        $data=$request->all();

        $id=$data['r_id'];
        $agent=$data['a_id'];
        $user=$data['u_id'];
        $comment=$data['comment'];


        $review=AgentReview::find($id);

        $user_comments=json_decode($review->comment,true);
        $index=auth()->user()->id."-".mt_rand(10000,99999);
        $user_comments[$index]= $comment;

        $review->comment=json_encode($user_comments);
        $review->save();

        return redirect()->back()->with('message','Comment added successfully');

    }

    public function commentOnListingReview(Request $request)
    {
        $data=$request->all();



        $id=$data['r_id'];
        $listing=$data['l_id'];
        $user=$data['u_id'];
        $comment=$data['comment'];


        $review=Review::find($id);

        $user_comments=json_decode($review->comment,true);
        $index=auth()->user()->id."-".mt_rand(10000,99999);
        $user_comments[$index]= $comment;

        $review->comment=json_encode($user_comments);
        $review->save();

        return redirect()->back()->with('message','Comment added successfully');

    }


    public function blogList(Request $request)
    {
        $filter=$request->all();

        $page_data = array();
        $tags = array();

        $query = Blog::query()->where('status', 1);

        if(isset($filter['search']))
        {
            $query->where('title', 'LIKE', "%{$filter['search']}%")
                ->orWhere('description', 'LIKE', "%{$filter['search']}%")
                ->orWhere('keywords', 'LIKE', "%{$filter['search']}%");

            $page_data['searched_word']= $filter['search'];
        }

        if(isset($filter['category']))
        {

            $query->where('blog_category_id', $filter['category']);

            $page_data['searched_category']= $filter['category'];
        }

        if(isset($filter['tag']))
        {
            $query->where('keywords', 'LIKE', "%{$filter['tag']}%");
            $page_data['search_tag']= $filter['tag'];
        }

        $page_data['blogs'] = $query->paginate(6);

        foreach($page_data['blogs'] as $blog) {

            $keywords = explode(', ', $blog->keywords);

            $length = count($keywords);

            for($i=0; $i<$length; $i++){
                if (!in_array($keywords[$i], $tags)) {
                    array_push($tags, $keywords[$i]);
                }
            }
        }
        $page_data['latest_blogs'] = Blog::where('status',1)->orderBy('id', 'DESC')->take(3)->get();
        $page_data['blog_categories'] = BlogCategory::all();
        $page_data['tags'] = $tags;

        return view('global.blog_grid', $page_data);
    }

    public function blogDetails($slug='', $blog_id='')
    {
        $page_data = array();
        $tags = array();

        $page_data['blog_details'] = Blog::find($blog_id);

        $keywords = explode(', ', $page_data['blog_details']->keywords);

        $length = count($keywords);

        for($i=0; $i<$length; $i++){
            if (!in_array($keywords[$i], $tags)) {
                array_push($tags, $keywords[$i]);
            }
        }
        $page_data['latest_blogs'] = Blog::where('status',1)->orderBy('id', 'DESC')->take(3)->get();
        $page_data['blog_categories'] = BlogCategory::all();
        $page_data['tags'] = $tags;
        
        return view('global.blog_details', $page_data);
    }


    public function contactUs()
    {
        return view('global.contact_us');
    }

    function emailSubscribe(Request $request) 
    {
        if(!empty($request->all()))
        {
            $data = new EmailSubscribe;
            $data['email'] = $request->email;
            $data->save();

            return redirect()->back()->with('message','Email subscribe successfully');
        }


        return redirect()->back()->with('error','Please provide a valid email');
    }




}
