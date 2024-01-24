<?php

namespace App\Http\Controllers;

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
use App\Models\SubcriptionPayment;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\FrontendSettings;
use App\Models\Language;
use App\Models\Faq;
use App\Models\SeoMetaTag;
use App\Models\Calculator_attribute;
use Illuminate\Support\Facades\Hash;
use DateTimeZone;
use Carbon\Carbon;
use DB;
use PDF;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Mail;

use App\Mail\AdminsendAgentMail;



class AdminController extends Controller
{
    function dashboard()
    {
        $page_data['listing'] = Listing::get();
        $page_data['user'] = User::where('role', 'user')->get();
        $page_data['agent'] = User::where('is_agent', 1)->get();
        $page_data['subscriptions'] = SubcriptionPayment::sum('amount');   
        $monthly_amount = array(0);
        for ($i = 1; $i <= 12; $i++) {
            $total_amount = date('t', strtotime(date("Y-$i-1 00:00:00")));
            $amount = SubcriptionPayment::whereDate('created_at', '>=', date("Y-$i-1 00:00:00"))->whereDate('created_at', '<=', date("Y-$i-$total_amount 23:59:59"))->get();
            if (count($amount) > 0) {
                array_push($monthly_amount, array_sum($amount->pluck('amount')->toArray()));
            } else {
                array_push($monthly_amount, 0);
            }
        }
        $page_data['monthly_amount'] = $monthly_amount;
        // $page_data = array();
        return view('backend.admin.dashboard', $page_data);
    }

    public function ListingTypes()
    {
        $page_data = array();
        $page_data['listing_types'] = Listing_type::all();
        return view('backend.admin.listings.listing_type', $page_data);
    }

    function RealEstateCategoryPropertyAmenities($active_tab = "")
    {
        $page_data = array();
        $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
        //category
        $listing_attribute_category=Listing_attribute::where('listing_type_id', $listing_type)->where('attribute_name','category')->value('id');
        $categories=Listing_arrtibute_type::where('listring_attribute_id',$listing_attribute_category)->get();
        //property
        $listing_attribute_property=Listing_attribute::where('listing_type_id', $listing_type)->where('attribute_name','property_details')->value('id');
        $properties=Listing_arrtibute_type::where('listring_attribute_id',$listing_attribute_property)->get();
        //Amenities
        $listing_attribute_amenity=Listing_attribute::where('listing_type_id', $listing_type)->where('attribute_name','amenities')->value('id');
        $amenities=Listing_arrtibute_type::where('listring_attribute_id',$listing_attribute_amenity)->get();

        $page_data['active_tab']= !empty($active_tab) ? $active_tab : 'category';

        $page_data['categories']=$categories;
        $page_data['properties']=$properties;
        $page_data['amenities']=$amenities;
        $page_data['listing_title'] = Listing_type::whereSlug('real-estate')->first()->value('title');

        return view('backend.admin.real_estate.listing_type', $page_data);
    }

    function RealEstateCategoryCreateModal()
    {
        $page_data = array();
        return view('backend.admin.real_estate.category.create_category_form', $page_data);
    }

    function RealEstateCategoryCreateModalPost(Request $request) {
        try{
            $validatedData = $request->validate([
                'type' => 'required|unique:listing_arrtibute_types|max:255',
            ]);
            $data=$request->all();
            
            // Property Image Add
            if($request->property_image){
                $imageName = rand();
                $image = $imageName.'.'.$request->property_image->getClientOriginalExtension();
                $request->property_image->move(public_path('uploads/real_estate/property-image'),$image);
                $data_image['property_image'] = $image;
            }else{
                $image = ""; 
            }

            if($request->og_image){
                $imageName = rand();
                $og_image = $imageName.'.'.$request->og_image->getClientOriginalExtension();
                $request->og_image->move(public_path('uploads/seo'),$og_image);
                $data_image['og_image'] = $og_image;
            }else{
                $og_image = ""; 
            }
           

            $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
            $listing_attribute=Listing_attribute::where('listing_type_id', $listing_type)->where('attribute_name','category')->value('id');
            $newCategory= new Listing_arrtibute_type;
            $newCategory['listring_attribute_id']= $listing_attribute;
            $newCategory['type']= $data['type'];
            $newCategory['slug']= slugify($data['type']);
            $newCategory['property_image']= $image;
            $newCategory['meta_keywords']= $data['meta_keywords'];
            $newCategory['meta_title']= $data['meta_title'];
            $newCategory['meta_description']= $data['meta_description'];
            $newCategory['og_title']= $data['og_title'];
            $newCategory['og_description']= $data['og_description'];
            $newCategory['json_ld']= $data['json_ld'];
            $newCategory['og_image']= $og_image;
            $newCategory['canonical']= $data['canonical'];
            $newCategory->save();
           
            return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'category'])->with('message', 'Category Created Successfully');
       }catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Category type already exists.');
        }
    }

    function RealEstateCategoryEditModal($id)
    {
        $page_data = array();
        $category=Listing_arrtibute_type::find($id);
        $page_data['category']=$category;
        return view('backend.admin.real_estate.category.edit_category_form', $page_data);
    }

    function RealEstateCategoryEditModalPost(Request $request)
    {
        
        $data=$request->all();
        if($request->property_image){
            $randome_name = rand();
            $attachment = $randome_name.'.'.$request->property_image->getClientOriginalExtension();
            $request->property_image->move(public_path('uploads/real_estate/property-image/'), $attachment);
            
            if(!empty($request->old_property_image) && (file_exists(public_path('uploads/real_estate/property-image/'.$request->old_property_image)))){
            
                unlink(public_path('uploads/real_estate/property-image/'.$request->old_property_image));
            }
        
        }else{
            $attachment = $request->old_property_image;
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
        $updateCategory=Listing_arrtibute_type::find($data['id']);
        $updateCategory['type']= $data['type'];
        $updateCategory['slug']= slugify($data['type']);
        $updateCategory['property_image']= $attachment;
        $updateCategory['meta_title']= $data['meta_title'];
        $updateCategory['meta_keywords']= $data['meta_keywords'];
        $updateCategory['meta_description']= $data['meta_description'];
        $updateCategory['og_title']= $data['og_title'];
        $updateCategory['og_description']= $data['og_description'];
        $updateCategory['json_ld']= $data['json_ld'];
        $updateCategory['canonical']= $data['canonical'];
        $updateCategory['og_image']= $attachment;
        $updateCategory->save();
        return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'category'])->with('message', 'Category Updated Successfully');

    }

    function RealEstateCategoryDelete(Request $request ,$id)
    {
        Listing_arrtibute_type::find($id)->delete();
        return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'category'])->with('error', 'Category Deleted Successfully');

    }

    //poperty

    function RealEstatePropertyCreateModal()
    {
        $page_data = array();
        return view('backend.admin.real_estate.property.create_property_form', $page_data);
    }

    function RealEstatePropertyCreateModalPost(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'type' => 'required|unique:listing_arrtibute_types|max:255',
            ]);
        $data=$request->all();

        $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
        $listing_attribute=Listing_attribute::where('listing_type_id', $listing_type)->where('attribute_name','property_details')->value('id');
        $newPoperty= new Listing_arrtibute_type;
        $newPoperty['listring_attribute_id']= $listing_attribute;
        $newPoperty['type']= $data['type'];
        $newPoperty['slug']= slug($data['type']);
        $newPoperty->save();

        return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'property'])->with('message', 'Property Details Created Successfully');
    }catch (ValidationException $e) {
        return redirect()->back()->with('error', 'Property Information already exists.');
    }

    }

    function RealEstatePropertyEditModal($id)
    {
        $page_data = array();
        $property=Listing_arrtibute_type::find($id);
        $page_data['property']=$property;

        return view('backend.admin.real_estate.property.edit_property_form', $page_data);
    }

    function RealEstatePropertyEditModalPost(Request $request)
    {

        $data=$request->all();
        $updateProperty=Listing_arrtibute_type::find($data['id']);
        $updateProperty['type']= $data['type'];
        $updateProperty['slug']= slug($data['type']);
        $updateProperty->save();

        return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'property'])->with('message', 'Property Updated Successfully');


    }

    function RealEstatePropertyDelete(Request $request ,$id)
    {
        Listing_arrtibute_type::find($id)->delete();
        return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'property'])->with('error', 'Property Deleted Successfully');

    }

     //Amenities Amenity amenity


     function RealEstateAmenityCreateModal()
     {
         $page_data = array();
         return view('backend.admin.real_estate.amenity.create_amenity_form', $page_data);
     }

     function RealEstateAmenityCreateModalPost(Request $request)
     {
        $data=$request->all();

        $listing_type=Listing_type::whereSlug('real-estate')->first()->value('id');
        $listing_attribute=Listing_attribute::where('listing_type_id', $listing_type)->where('attribute_name','amenities')->value('id');
        $newPoperty= new Listing_arrtibute_type;
        $newPoperty['listring_attribute_id']= $listing_attribute;
        $newPoperty['type']= $data['type'];
        $newPoperty['font_awesome_class']= $data['font_awesome_class'];
        $newPoperty->save();

        return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'amenity'])->with('msg', 'Amenity Details Created Successfully');

     }

     function RealEstateAmenityEditModal($id)
     {
         $page_data = array();
         $amenity=Listing_arrtibute_type::find($id);
         $page_data['amenity']=$amenity;

         return view('backend.admin.real_estate.amenity.edit_amenity_form', $page_data);
     }

     function RealEstateAmenityEditModalPost(Request $request)
     {
         $data=$request->all();
         $updateAmenity=Listing_arrtibute_type::find($data['id']);
         $updateAmenity['type']= $data['type'];
         $updateAmenity['font_awesome_class']= $data['font_awesome_class'];
         $updateAmenity->save();

         return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'amenity'])->with('msg', 'Amenity Updated Successfully');

     }

     function RealEstateAmenityDelete(Request $request ,$id)
     {
         Listing_arrtibute_type::find($id)->delete();
         return redirect()->route('admin.RealEstateCategoryPropertyAmenities', ['active_tab' => 'amenity'])->with('msg', 'Amenity Deleted Successfully');

     }

     //state
 
     function AddStatesModal()
     {
         $page_data = array();
         $countries=Country::all();
         $page_data['countries']=$countries;
         return view('backend.admin.state.add_state', $page_data);
     }

     function AddStatesModalPost(Request $request)
     {
        if ($request->hasFile('thumbnail')) {
            $imageName = rand();
            $imageExtension = $request->thumbnail->getClientOriginalExtension();
            $image = $imageName . '.' . $imageExtension;
            $request->thumbnail->move(public_path('assets/uploads/state'), $image);
            $data_image['thumbnail'] = $image;
        } else {
            $image = "";
        }
         $data=$request->all();
         $newState=new State;
         $newState['country_id']=$data['country_id'];
         $newState['title']=$data['title'];
         $newState['thumbnail']=$image;
         $newState['slug']=Str::of($data['title'])->slug('-');
         $newState->save();

         return redirect()->back()->with('msg', 'State added Successfully');

     }
     

     function EditStatesModal($id)
     {
         $page_data = array();
         $state=State::find($id);
         $countries=Country::all();
         $page_data['countries']=$countries;
         $page_data['state']=$state;
         return view('backend.admin.state.edit_state', $page_data);
     }

     function EditStatesModalPost(Request $request)
     {
         //  Thumbnail Image
         if($request->thumbnail){
            $randome_name = rand();
            $attachment = $randome_name.'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('assets/uploads/state'), $attachment);
            if($request->old_thumbnail && file_exists('public/assets/uploads/state/'.$request->old_thumbnail)){
               
                unlink(public_path('assets/uploads/state/'.$request->old_thumbnail));
            }
        
        }else{
            $attachment = $request->old_thumbnail;
        }
         $data=$request->all();
         $updateState=State::find($data['id']);
         $updateState['country_id']=$data['country_id'];
         $updateState['title']=$data['title'];
         $updateState['thumbnail']= $attachment;
         $updateState->save();

         return redirect()->back()->with('msg', 'State updated Successfully');

     }

     function DeleteState($id)
     {
         State::find($id)->delete();
         return redirect()->back()->with('msg', 'State deleted Successfully');
     }

     //city

     function ListOfCities()
     {
         $page_data = array();
         $states=State::all();
         $countries=Country::all();
         $cities=City::all();
         $page_data['states']=$states;
         $page_data['countries']=$countries;
         $page_data['cities']=$cities;

         return view('backend.admin.city.index', $page_data);
     }

     function AddCitiesModal()
     {
         $page_data = array();
         $countries=Country::all();
         $states=State::all();
         $page_data['countries']=$countries;
         $page_data['states']=$states;
         return view('backend.admin.city.add_city', $page_data);
     }

     function AddCitiesModalPost(Request $request)
     {
         $data=$request->all();
         $newCity=new City;
         $newCity['country_id']=$data['country_id'];
         $newCity['state_id']=$data['state_id'];
         $newCity['title']=$data['title'];
         $newCity['slug']=Str::of($data['title'])->slug('-');
         $newCity->save();

         return redirect()->back()->with('msg', 'City added Successfully');

     }

     function EditCitiesModal($id)
     {
         $page_data = array();
         $city=City::find($id);
         $countries=Country::all();
         $states=State::all();
         $page_data['countries']=$countries;
         $page_data['city']=$city;
         $page_data['states']=$states;
         return view('backend.admin.city.edit_city', $page_data);
     }

     function EditCitiesModalPost(Request $request)
     {
         $data=$request->all();
         $updateCity=City::find($data['id']);
         $updateCity['country_id']=$data['country_id'];
         $updateCity['state_id']=$data['state_id'];
         $updateCity['title']=$data['title'];
         $updateCity->save();

         return redirect()->back()->with('msg', 'City updated Successfully');

     }

     function DeleteCities($id)
     {
         City::find($id)->delete();
         return redirect()->back()->with('msg', 'City deleted Successfully');
     }

     public function get_state_by_country(Request $request)
     {

         $data = $request->all();
         $states = State::where('country_id', $data['country_id'])->get();
         $no_state="No State Found";

         if(count($states)>0)
         {
            foreach ($states as $state)
            echo '<option value="' . $state->id . '">' . $state->title . '</option>';
         }
         else{

            echo '<option value="">'.$no_state.'</option>';
         }


     }

     public function smtpSettings()
     {
         return view('backend.admin.settings.smtp_settings');
     }

     public function smtpUpdate(Request $request)
     {
         $data = $request->all();



         unset($data['_token']);
         foreach($data as $key => $value){
             if($key == 'smtp_protocol'){
                 set_config('MAIL_MAILER', $value);
             }elseif($key == 'smtp_crypto'){
                 set_config('MAIL_ENCRYPTION', $value);
             }elseif($key == 'smtp_host'){
                 set_config('MAIL_HOST', $value);
             }elseif($key == 'smtp_port'){
                 set_config('MAIL_PORT', $value);
             }elseif($key == 'smtp_user'){
                 set_config('MAIL_USERNAME', $value);
             }elseif($key == 'smtp_pass'){
                 set_config('MAIL_PASSWORD', $value);
             }elseif($key == 'smtp_from_email'){
                 set_config('MAIL_FROM_ADDRESS', $value);
             }
             SystemSetting::where('key', $key)->update([
                 'key' => $key,
                 'value' => $value,
             ]);
         }

         return redirect()->back()->with('message','Smtp settings updated successfully.');
     }

     public function payment_settings()
     {


         $page_data=array();
         $global_currency = SystemSetting::where('key', 'system_currency')->first()->toArray();
         $global_currency = $global_currency['value'];
         $global_currency_position = SystemSetting::where('key', 'currency_position')->first()->toArray();
         $global_currency_position = $global_currency_position['value'];
         $currencies = Currency::all()->toArray();
         $page_data['global_currency']=$global_currency;
         $page_data['global_currency_position']=$global_currency_position;
         $page_data['currencies']=$currencies;


         return view('backend.admin.payment_credentials.payment_settings', $page_data);
     }



     public function update_payment_settings(Request $request)
     {
         $data = $request->all();
         $update_id = $data['method'];
         if ($data['method'] == 'currency') {
             SystemSetting::where('key', 'system_currency')->update([
                 'value' =>  $data['global_currency'],
             ]);
             SystemSetting::where('key', 'currency_position')->update([
                 'value' =>  $data['currency_position'],
             ]);
         }
         return redirect()->route('admin.payment_settings')->with('message', 'key has been updated');
     }
    //  Stripe Payment Update
     public function update_stripe_payment(Request $request)
     {
         $data = $request->all();
         $stripeArray = [
            'status' => $data['status'],
            'mode' => $data['mode'],
            'test_key' => $data['test_key'],
            'test_secret_key' => $data['test_secret_key'],
            'public_live_key' => $data['public_live_key'],
            'secret_live_key' => $data['secret_live_key'],
        ];
    
        SystemSetting::where('key', 'stripe')->update([
            'value' => json_encode($stripeArray), 
        ]);
    
        return redirect()->back()->with('message', 'Stripe Payment Update Successfully!');
     }
    //  Paypal Payment Update
     public function update_paypal_payment(Request $request)
     {
         $data = $request->all();
         $paypalArray = [
            'status' => $data['status'],
            'mode' => $data['mode'],
            'test_client_id' => $data['test_client_id'],
            'test_secret_key' => $data['test_secret_key'],
            'live_client_id' => $data['live_client_id'],
            'live_secret_key' => $data['live_secret_key'],
        ];
    
        SystemSetting::where('key', 'paypal')->update([
            'value' => json_encode($paypalArray), 
        ]);
    
        return redirect()->back()->with('message', 'Paypal Payment Update Successfully!');
     }







     public function map_settings()
     {
         $page_data=array();

         return view('backend.admin.settings.map_settings', $page_data);
     }



     public function update_map_settings(Request $request)
     {

         $data = $request->all();
             SystemSetting::where('key', 'active_map')->update([
                 'value' =>  $data['active_map'],
             ]);
             SystemSetting::where('key', 'default_location')->update([
                 'value' =>  $data['default_location'],
             ]);
             SystemSetting::where('key', 'max_zoom_level')->update([
                'value' =>  $data['max_zoom_level'],
            ]);

            SystemSetting::where('key', 'min_zoom_listings_page')->update([
                'value' =>  $data['min_zoom_listings_page'],
            ]);

            SystemSetting::where('key', 'min_zoom_directory_page')->update([
                'value' =>  $data['min_zoom_directory_page'],
            ]);

            if($data['active_map']=='mapbox')
            {
                SystemSetting::where('key', 'map_access_token')->update([
                    'value' =>  $data['map_access_token'],
                ]);

            }


         return redirect()->route('admin.map_settings')->with('message', 'Map has been updated');
     }

     //system settings


    public function systemSettings()
    {
        $page_data=array();
        $countries=Country::all();
        $timezones = DateTimeZone::listIdentifiers();


        $page_data['countries']=$countries;
        $page_data['timezones']=$timezones;
        return view('backend.admin.settings.system_settings',$page_data);
    }

    public function systemUpdate(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
        foreach ($data as $key => $value) {
            SystemSetting::where('key', $key)->update([
                'key' => $key,
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('message', 'System settings updated successfully.');
    }

    // user
    // customer
    public function customerList(Request $request)
    {
        $page_data=array();

        $search = $request['search'] ?? "";

        if($search != "") {

            $customers = User::where(function ($query) use($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->where('role', 'user')
                        ->where('is_customer', 1)
                        ->where('is_agent', 0);
                })->orWhere(function ($query) use($search) {
                    $query->where('email', 'LIKE', "%{$search}%")
                        ->where('role', 'user')
                        ->where('is_customer', 1)
                        ->where('is_agent', 0);
                })->paginate(10);

        } else {
            $customers = User::where('role','user')->where('is_customer',1)->where('is_agent', 0)->paginate(10);
        }

        $page_data['customers']=$customers;
        $page_data['search'] = $search;
        
        return view('backend.admin.user.customer.customer_list',$page_data);
    }

    public function createCustomerModal()
    {
        return view('backend.admin.user.customer.add_customer');
    }

    public function adminCustomerCreate(Request $request)
    {
        $data = $request->all();

        $customer= new User;
        $customer['name']=$data['name'];
        $customer['email']=$data['email'];
        $customer['password']=Hash::make($data['password']);

        $address['country_code'] = $request->country_code;
        $address['state'] = !empty($request->state) ? $request->state : '';
        $address['addressline'] = $request->addressline;
        $address['zipcode'] = !empty($request->zipcode) ? $request->zipcode : '';
        $customer['address'] = json_encode($address);

        $customer['phone']=$data['phone'];
        $customer['role']="user";
        $customer['archive']= 1;
        $customer['email_verified_at']= now();
        $customer['is_customer']=1;
        $customer->save();

        return redirect()->back()->with('message','Customer Added Successfully');
    }

    public function editCustomerModal($id)
    {
        $user = User::find($id);
        $page_data['user']=$user;
        return view('backend.admin.user.customer.edit_customer',$page_data);
    }

    public function customerUpdate(Request $request,$id)
    {
        $data = $request->all();

        $customer= User::find($id);
        $customer['name']=$data['name'];

        $address['country_code'] = $request->country_code;
        $address['state'] = !empty($request->state) ? $request->state : '';
        $address['addressline'] = $request->addressline;
        $address['zipcode'] = !empty($request->zipcode) ? $request->zipcode : '';
        $customer['address'] = json_encode($address);

        $customer['phone']=$data['phone'];
        $customer->save();

        return redirect()->back()->with('message','Customer Edited Successfully');

    }

    public function adminCustomerDelete($id)
    {
        $user = User::find($id)->delete();

        return redirect()->back()->with('message','Customer deleted Successfully');
    }
    //Admin Archive User
    
        public function adminCustomerArchive($id){
            $user = User::find($id);
            $user->update(['archive' => 0]);
            return redirect()->back()->with('message', 'User Deactivated successfully.');
        }
        public function activateUser($id){
            $user = User::find($id);
            $user->update(['archive' => 1]);
            return redirect()->back()->with('message', 'User activated successfully.');
        }


    public function adminCustomerToAgent($id)
    {
        $customer = User::find($id);
        $customer['is_agent']=1;
        $customer->save();

        return redirect()->back()->with('message','Agent Updated successfully');
    }

    // Admin Mail To Agent
    public function sendAdminToAgentEmail(Request $request)
    {
        config([
                'mail.mailers.smtp.transport' => get_settings('smtp_protocol'),
                'mail.mailers.smtp.host' => get_settings('smtp_host'),
                'mail.mailers.smtp.port' => get_settings('smtp_port'),
                'mail.mailers.smtp.username' => get_settings('smtp_user'),
                'mail.mailers.smtp.password' => get_settings('smtp_pass'),
                'mail.mailers.smtp.encryption' => get_settings('smtp_crypto'),
                'mail.from.address' => get_settings('smtp_from_email'),
                'mail.from.name' => get_settings('system_title'),
         ]);

        $data = $request->all();
        $userEmail = User::where('id' , $request->all()['id'])->first();
        $agentEmail = $userEmail->email;
        $adminMessage = $data['message'];
        Mail::to($agentEmail)->send(new AdminsendAgentMail(['message' => $adminMessage]));
        return redirect()->back()->with('message','Admin Send Message successfully');
    }



    // agent

    public function agentList(Request $request)
    {
        $page_data=array();

        $search = $request['search'] ?? "";

        if($search != "") {

            $agents = User::where(function ($query) use($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->where('role', 'user')
                        ->where('is_agent', 1)
                        ->orWhere('is_agent', 2);
                })->orWhere(function ($query) use($search) {
                    $query->where('email', 'LIKE', "%{$search}%")
                        ->where('role', 'user')
                        ->where('is_agent', 1)
                        ->orWhere('is_agent', 2);
                })->paginate(10);

        } else {
            $agents = User::where('role','user')->where('is_agent', 1)->orWhere('is_agent', 2)->paginate(10);
        }

        $page_data['agents'] = $agents;
        $page_data['search'] = $search;
        return view('backend.admin.user.agent.agent_list',$page_data);
    }

    public function editAgentModal($id)
    {
        $user = User::find($id);
        $page_data['user']=$user;
        return view('backend.admin.user.agent.edit_agent',$page_data);
    }

    public function agentUpdate(Request $request,$id)
    {
        $data = $request->all();

        $agent= User::find($id);
        $agent['name']=$data['name'];
        
        $address['country_code'] = $request->country_code;
        $address['state'] = !empty($request->state) ? $request->state : '';
        $address['addressline'] = $request->addressline;
        $address['zipcode'] = !empty($request->zipcode) ? $request->zipcode : '';
        $agent['address'] = json_encode($address);

        $agent['phone']=$data['phone'];
        $agent->save();

        return redirect()->back()->with('message','agent Edited Successfully');
    }

    public function adminAgentDelete($id)
    {
        $user = User::find($id)->delete();

        return redirect()->back()->with('message','Agent deleted Successfully');
    }


    public function adminAgentBan($id)
    {
        $agent= User::find($id);
        $agent['is_agent']=2;
        $agent->save();
        return redirect()->back()->with('message','agent Banned Successfully');
    }

    public function adminAgentUnban($id)
    {
        $agent= User::find($id);
        $agent['is_agent']=1;
        $agent->save();
        return redirect()->back()->with('message','Ban removed Succesfully');
    }

    public function adminPackage()
    {
        $page_data=array();
        $packages = Package::all();
        $page_data['packages']=$packages;

        return view('backend.admin.package.package',$page_data);
    }

    public function createPackage()
    {
        return view('backend.admin.package.add_package');
    }

    public function packageCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'price' => 'required',
            'package_type' => 'required',
            'interval' => 'required',
            'duration' => 'required',
            'icon_type' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $data = array(
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
            'icon_type' => $request->icon_type,
            'package_type' => $request->package_type,
            'interval' => $request->interval,
            'duration' => $request->duration,
            'description' => $request->description,
            'services' => json_encode($request->services)
        );
        // $data = $request->all();
        Package::insert($data);
        return redirect()->back()->with('message', 'You have successfully create a packgae.');
    }

    public function editPackage($id)
    {
        $package = Package::find($id);
        $page_data['package']=$package;
        return view('backend.admin.package.edit_package',$page_data);
    }

    public function packageUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'price' => 'required',
            'package_type' => 'required',
            'interval' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'icon_type' => 'required',
            'status' => 'required',
        ]);
        $data = array(
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
            'icon_type' => $request->icon_type,
            'package_type' => $request->package_type,
            'interval' => $request->interval,
            'duration' => $request->duration,
            'description' => $request->description,
            'services' => json_encode($request->services)
        );
        Package::where('id', $id)->update($data);

        return redirect()->back()->with('message', 'You have successfully update package.');
    }

    public function packageDelete($id)
    {
        $package = Package::find($id)->delete();
        return redirect()->back()->with('message', 'You have successfully delete a package.');
    }


    public function subscriptionReport(Request $request)
    {

        if (count($request->all()) > 0) {
            $data = $request->all();
            $date = explode('-', $data['eDateRange']);
            $date_from = Carbon::parse($date[0] . ' 00:00:00');
            $date_to  = Carbon::parse($date[1] . ' 23:59:59');
            $subscriptions = Subscription::where('created_at', '>=', $date_from->toArray()['formatted'])
                ->where('created_at', '<=', $date_to->toArray()['formatted'])
                ->get();
        } else {
            $date_from = new Carbon('first day of January this year');
            $date_to = new Carbon('first day of december this year');
            $subscriptions = Subscription::where('created_at', '>=', $date_from->toArray()['formatted'])
                ->where('created_at', '<=', $date_to->toArray()['formatted'])
                ->get();
        }



        $page_data['subscriptions']=$subscriptions;
        $page_data['date_from']=$date_from;
        $page_data['date_to']=$date_to;

        return view('backend.admin.subscription.subscription_report',$page_data);
    }


    public function subscriptionPendingPayment()
    {
        $pending_subscriptions = PendingSubscription::where('paid_by', 'offline')
            ->where('status', 'pending')
            ->get();


            $page_data['pending_subscriptions']=$pending_subscriptions;
        return view('backend.admin.subscription.pending', $page_data);
    }

    public function subscriptionPaymentStatus( $id = "")
    {



           $pending_subscription = PendingSubscription::find($id);
          $package = Package::find($pending_subscription->package_id);

            if(strtolower($package->interval)=='days')
            {
               $expire_date= Carbon::now()->addDays($package->duration);

            }
             elseif(strtolower($package->interval)=='monthly')
            {
                $monthly=$package->duration*30;
                $expire_date = Carbon::now()->addMonth($monthly);

            }
             elseif(strtolower($package->interval)=='yearly')
            {
                $yearly=$package->duration*365;
                $expire_date = Carbon::now()->addYear($yearly);

            }


            $last_package = Subscription::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();



            Subscription::create([
                'user_id' => $pending_subscription->user_id,
                'package_id' => $pending_subscription->package_id,
                'paid_amount' => $pending_subscription->price,
                'payment_method' => ucwords($pending_subscription->paid_by),
                'transaction_keys' => json_encode(array()),
                'expire_date' => $expire_date,
                'status' => 'approve',
            ]);

            PendingSubscription::where('id', $id)->update([
                'status' => "approve",
            ]);

            if (!empty($last_package)) {
                $last_package = $last_package->toArray();

                Subscription::where('id',  $last_package['id'])->update([
                    'status' => "0",
                ]);
            }


        return redirect()->back()->with('message', 'payment has been approved');
    }

    public function subscriptionPaymentDelete($id)
    {

        $payment_history = PendingSubscription::find($id);
        $payment_history->delete();
         return redirect()->back()->with('message', 'Payment has deleted');
    }

    public function subscriptionApprovePayment()
    {

        $PendingSubscriptions = PendingSubscription::where('paid_by', 'offline')
            ->where('status', 'approve')
            ->get();
        return view('backend.admin.subscription.approve', ['PendingSubscriptions' => $PendingSubscriptions]);
    }

    public function adminProfile()
    {
        return view('backend.admin.profile.view');
    }

    public function profileUpdate(Request $request)
    {
        $data['name'] = $request->name;
        $old_email = User::find(auth()->user()->id)->value('email');
        if($request->email != $old_email) {
            $check_duplicate = User::where('email', $request->email)->get();
            if(count($check_duplicate) == 0) {
                $data['email'] = $request->email;
            } else {
                return redirect()->back()->with('error', 'Sorry this email already exists');
            }
        } else {
            $data['email'] = $old_email;
        }

        $data['gender'] = $request->gender;
        $data['phone'] = $request->phone;
        $data['website'] = $request->website;

        $social['facebook'] = $request->facebook;
        $social['twitter'] = $request->twitter;
        $social['linkedin'] = $request->linkedin;
        $data['social'] = json_encode($social);

        $data['about'] = $request->about;
        
        $address['country_code'] = $request->country_code;
        $address['addressline'] = $request->addressline;
        $address['zipcode'] = $request->zipcode;
        $data['address'] = json_encode($address);


        if(empty($request->photo)){
            $data['image'] = $request->old_photo;
        }else{
            $file_name = random(10).'.png';
            $data['image'] = $file_name;

            $request->photo->move(public_path('uploads/user_image/'), $file_name);
        }

        User::where('id', auth()->user()->id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'social' => $data['social'],
            'gender' => $data['gender'],
            'image' => $data['image']
        ]);
        
        return redirect(route('admin.profile'))->with('message', get_phrase('Profile info updated successfully'));
    }


    public function password($action_type = null, Request $request) 
    {
        if($action_type == 'update'){

            if($request->new_password != $request->confirm_password){
                return back()->with("error", "Confirm Password Doesn't match!");
            }


            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Current Password Doesn't match!");
            }

            $data['password'] = Hash::make($request->new_password);
            User::where('id', auth()->user()->id)->update($data);

            return redirect(route('admin.password', 'edit'))->with('message', get_phrase('Password changed successfully'));
        }

        return view('backend.admin.profile.password');
    }


    //Blog categories start from here
    public function blogCategoryList()
    {
        $blog_categories = BlogCategory::all();
        $page_data['blog_categories'] = $blog_categories;
        return view('backend.admin.blog_category.blog_category_list', $page_data);
    }

    public function createBlogCategory()
    {
        return view('backend.admin.blog_category.add_blog_category');
    }

    public function blogCategoryCreate(Request $request)
    {
        $data=$request->all();
        $blogCategory=new BlogCategory;
        $blogCategory['title']=$data['title'];
        $blogCategory['subtitle']=$data['subtitle'];
        $blogCategory['slug']=Str::of($data['title'])->slug('-');

        $blogCategory->save();

        return redirect()->back()->with('message', 'Blog category added successfully');
    }

    public function editBlogCategory($id='')
    {
        $page_data['blog_category'] = BlogCategory::find($id);
        return view('backend.admin.blog_category.edit_blog_category', $page_data);
    }

    public function blogCategoryUpdate(Request $request, $id='')
    {
        $data = $request->all();

        unset($data['_token']);

        BlogCategory::where('id', $id)->update($data);    

        return redirect()->back()->with('message', 'Blog category updated successfully');
    }

    public function blogCategoryDelete($id='')
    {
        $blog_category = BlogCategory::find($id);
        $blog_category->delete();
        return redirect()->back()->with('message','You have successfully deleted blog category.');
    }


    //Blogs start from here
    public function blogList()
    {
        $blogs = Blog::all();
        $page_data['blogs'] = $blogs;
        $blog_categories = BlogCategory::all();
        $page_data['blog_categories'] = $blog_categories;
        return view('backend.admin.blogs.blog_list', $page_data);
    }


    public function createBlogs()
    {
        $blog_categories = BlogCategory::all();
        $page_data['blog_categories'] = $blog_categories;
        return view('backend.admin.blogs.add_blog', $page_data);
    }

    public function blogsCreate(Request $request)
    {
        $data=$request->all();
        if (isset($data['is_popular'])) {
            $is_popular = $request->is_popular;
        } else {
            $is_popular = 0;
        }

        $blog=new Blog;
        $blog['blog_category_id'] = $data['blog_category_id'];
        $blog['user_id'] = auth()->user()->id;
        $blog['title'] = $data['title'];
        $blog['description'] = $data['description'];
        $blog['is_popular'] = $is_popular;
        $blog['status'] = 1;
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
        $blog_categories = BlogCategory::all();
        $page_data['blog_categories'] = $blog_categories;
        $blog = Blog::find($id);
        $page_data['blog'] = $blog;
        return view('backend.admin.blogs.edit_blog', $page_data);
    }

    public function blogUpdate(Request $request, $id='')
    {
        $data = $request->all();
        $blog = Blog::find($id);


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


        if (isset($data['is_popular'])) {
            $data['is_popular'] = $request->is_popular;
        } else {
            $data['is_popular'] = 0;
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

    public function blogStatusUpdate($id='', $status='')
    {
        $blog = Blog::find($id);
        Blog::where('id', $id)->update([
            'status' => $status,
        ]);
        return redirect()->back()->with('message','Status updated successfully.');
    }

    public function blogDelete($id='')
    {
        $blog = Blog::find($id);

        $thumbnailPathName = 'public/uploads/blog/' . $blog->thumbnail;

        if(!file_exists($thumbnailPathName)){
            unlink($thumbnailPathName);
        }

        $blog->delete();
        return redirect()->back()->with('message','Blog deleted successfully.');
    }


    //Blog settings start from here
    public function blogSettings()
    {
        return view('backend.admin.blog_settings.blog_settings');
    }

    public function blogSettingsUpdate(Request $request)
    {
        $data = $request->all();

        $key = 'agents_blog_permission';
        $value = $data['agents_blog_permission'];

        if(DB::table('system_settings')->where('key', $key)->get()->count() > 0) {
            SystemSetting::where('key', $key)->update([
                'key' => $key,
                'value' => $value,
            ]);
        } else {
            SystemSetting::create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        $type = 'blog_visibility_on_home_page';
        $description = $data['blog_visibility_on_home_page'];

        if(DB::table('frontend_settings')->where('type', $type)->get()->count() > 0) {
            FrontendSettings::where('type', $type)->update([
                'type' => $type,
                'description' => $description,
            ]);
        } else {
            FrontendSettings::create([
                'type' => $type,
                'description' => $description,
            ]);
        }

        return redirect()->back()->with('message','Blog settings updated successfully.');
    }


    //Website settings start from here
    public function websiteSettings()
    {
        return view('backend.admin.settings.website_settings');
    }

    public function websiteUpdate(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
        foreach ($data as $type => $description) {
            if(DB::table('frontend_settings')->where('type', $type)->get()->count() > 0) {
                FrontendSettings::where('type', $type)->update([
                    'type' => $type,
                    'description' => $description,
                ]);
            } else {
                FrontendSettings::create([
                    'type' => $type,
                    'description' => $description,
                ]);
            }
        }

        return redirect()->back()->with('message', 'Website settings updated successfully.');
    }


    // Website Logo Add
     public function logoImageAdd(Request $request){
        $validated = $request->all([
            'light_logo' => 'required',
            'dark_logo' => 'required',
            'footer_logo' => 'required',
            'favicon' => 'required',
        ]);
        if($request->light_logo){
            // Frontend Header Logo
            $imagename = rand();
            $logoImage = $imagename.'.'.$request->light_logo->extension();
            $request->light_logo->move(public_path('assets/uploads/logo'),$logoImage);
            $data_image['light_logo'] = $logoImage;
            }else{
                $logoImage = $request->old_light_logo;
            }
            $data = array(
                'type' => $logoImage,
            );
            $image = FrontendSettings::where('type', 'light_logo')->update(['description' => $logoImage]);

           if($image){
            if($request->old_light_logo && file_exists('public/assets/uploads/logo/'.$request->old_light_logo)) {
                unlink(public_path('assets/uploads/logo/'.$request->old_light_logo));
            }
            
        }
        if($request->dark_logo){
            // Frontend Header Logo
            $imagename = rand();
            $logoImage = $imagename.'.'.$request->dark_logo->extension();
            $request->dark_logo->move(public_path('assets/uploads/logo'),$logoImage);
            $data_image['dark_logo'] = $logoImage;
            }else{
                $logoImage = $request->old_dark_logo;
            }
            $data = array(
                'type' => $logoImage,
            );
            $image = FrontendSettings::where('type', 'dark_logo')->update(['description' => $logoImage]);

           if($image){
            if($request->old_dark_logo && file_exists('public/assets/uploads/logo/'.$request->old_dark_logo)) {
                unlink(public_path('assets/uploads/logo/'.$request->old_dark_logo));
            }
            
        }
        if($request->footer_logo){
            // Frontend Footer Logo
            $imagename2 = rand();
            $logoImage2 = $imagename2.'.'.$request->footer_logo->extension();
            $request->footer_logo->move(public_path('assets/uploads/logo'),$logoImage2);
            $data_image['footer_logo'] = $logoImage2;
            }else{
                $logoImage2 = $request->old_footer_logo;
            }
            $data = array(
                'type' => $logoImage2,
            );
            $image2 = FrontendSettings::where('type', 'footer_logo')->update(['description' => $logoImage2]);

           if($image2){
                if($request->old_footer_logo && file_exists('public/assets/uploads/logo/'.$request->old_footer_logo)) {
                    unlink(public_path('assets/uploads/logo/'.$request->old_footer_logo));
                }
           }
        if($request->favicon){
            // Frontend Favicon Logo
            $imagename2 = rand();
            $logoImage2 = $imagename2.'.'.$request->favicon->extension();
            $request->favicon->move(public_path('assets/uploads/logo'),$logoImage2);
            $data_image['favicon'] = $logoImage2;
            }else{
                $logoImage2 = $request->old_favicon;
            }
            $data = array(
                'type' => $logoImage2,
            );
            $image2 = FrontendSettings::where('type', 'favicon')->update(['description' => $logoImage2]);

           if($image2){
                if($request->old_favicon && file_exists('public/assets/uploads/logo/'.$request->old_favicon)) {
                    unlink(public_path('assets/uploads/logo/'.$request->old_favicon));
                }
           }
            return redirect()->back()->with('message', "Logo  Update successfully");
     }
    // Frontend Bannar Image Add 
    public function bannarImageAdd(Request $request){
        $validated = $request->all([
            'bannar_image' => 'required'
        ]);
        if($request->bannar_image){
            // Frontend Bannar Image
            $imagename = rand();
            $bannarImage = $imagename.'.'.$request->bannar_image->extension();
            $request->bannar_image->move(public_path('assets/uploads/bannar'),$bannarImage);
            $data_image['bannar_image'] = $bannarImage;
            }else{
                $bannarImage =  $request->old_bannar_image;
            }
            $data = array(
                'type' => $bannarImage,
            );
        
           $image = FrontendSettings::where('type', 'bannar')->update(['description' => $bannarImage]);
           if($image){
            if($request->old_bannar_image){
                unlink(public_path('assets/uploads/bannar/'.$request->old_bannar_image));
            }
           }
            return redirect()->back()->with('message', "Banner Update successfully");
    }
    // Frontend Video Image Add 
    public function videoImageAdd(Request $request){
        $validated = $request->all([
            'video_image' => 'required'
        ]);
        if($request->video_image){
            $imagename = rand();
            $videoImage = $imagename.'.'.$request->video_image->extension();
            $request->video_image->move(public_path('assets/uploads/bannar'),$videoImage);
            $data_image['video_image'] = $videoImage;
            }else{
                $videoImage =  $request->old_video_image;
            }
            $data = array(
                'type' => $videoImage,
            );
        
           $image = FrontendSettings::where('type', 'video_image')->update(['description' => $videoImage]);
           if($image){
            if($request->old_video_image){
                unlink(public_path('assets/uploads/bannar/'.$request->old_video_image));
            }
           }
            return redirect()->back()->with('message', "Video Image Update successfully");
    }



    public function realEstateUpdate(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
        foreach ($data as $type => $description) {
            if(DB::table('frontend_settings')->where('type', $type)->get()->count() > 0) {
                FrontendSettings::where('type', $type)->update([
                    'type' => $type,
                    'description' => $description,
                ]);
            } else {
                FrontendSettings::create([
                    'type' => $type,
                    'description' => $description,
                ]);
            }
        }

        return redirect()->back()->with('message', 'Real-Estate settings updated successfully.');
    }


    public function faqViews()
    {
        $faqs = Faq::all();
        return view('backend.admin.settings.faq_views', ['faqs' => $faqs]);
    }

    public function faqAdd()
    {
        return view('backend.admin.settings.add_faq');
    }

    public function faqCreate(Request $request)
    {
        $data = $request->all();

        Faq::create($data);

        return redirect()->back()->with('message', 'You have successfully create a faq.');
    }

    public function faqEdit($id="")
    {
        $faq = Faq::find($id);
        return view('backend.admin.settings.edit_faq', ['faq' => $faq]);
    }

    public function faqUpdate(Request $request, $id="")
    {
        $data = $request->all();

        unset($data['_token']);

        Faq::where('id', $id)->update($data);

        return redirect()->back()->with('message', 'You have successfully create a faq.');
    }

    public function faqDelete($id='')
    {
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->back()->with('message', 'You have successfully delete a faq.');
    }

    public function about()
    {

        $purchase_code = get_settings('purchase_code');
        $returnable_array = array(
            'purchase_code_status' => get_phrase('Not found'),
            'support_expiry_date'  => get_phrase('Not found'),
            'customer_name'        => get_phrase('Not found')
        );

        $personal_token = "gC0J1ZpY53kRpynNe4g2rWT5s4MW56Zg";
        $url = "https://api.envato.com/v3/market/author/sale?code=" . $purchase_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . $personal_token;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:' . $purchase_code . '.json';
        $ch_verify = curl_init($verify_url . '?code=' . $purchase_code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        $response = json_decode($cinit_verify_data, true);

        if (is_array($response) && isset($response['verify-purchase']) && count($response['verify-purchase']) > 0) {

            //print_r($response);
            $item_name         = $response['verify-purchase']['item_name'];
            $purchase_time       = $response['verify-purchase']['created_at'];
            $customer         = $response['verify-purchase']['buyer'];
            $licence_type       = $response['verify-purchase']['licence'];
            $support_until      = $response['verify-purchase']['supported_until'];
            $customer         = $response['verify-purchase']['buyer'];

            $purchase_date      = date("d M, Y", strtotime($purchase_time));

            $todays_timestamp     = strtotime(date("d M, Y"));
            $support_expiry_timestamp = strtotime($support_until);

            $support_expiry_date  = date("d M, Y", $support_expiry_timestamp);

            if ($todays_timestamp > $support_expiry_timestamp)
                $support_status    = 'expired';
            else
                $support_status    = 'valid';

            $returnable_array = array(
                'purchase_code_status' => $support_status,
                'support_expiry_date'  => $support_expiry_date,
                'customer_name'        => $customer,
                'product_license'      => 'valid',
                'license_type'         => $licence_type
            );
        } else {
            $returnable_array = array(
                'purchase_code_status' => 'invalid',
                'support_expiry_date'  => 'invalid',
                'customer_name'        => 'invalid',
                'product_license'      => 'invalid',
                'license_type'         => 'invalid'
            );
        }


        $data['application_details'] = $returnable_array;
        return view('backend.admin.settings.about', $data);
    }


    function curl_request($code = '')
    {
        $purchase_code = $code;

        $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";
        $url = "https://api.envato.com/v3/market/author/sale?code=" . $purchase_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . $personal_token;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:' . $purchase_code . '.json';
        $ch_verify = curl_init($verify_url . '?code=' . $purchase_code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        $response = json_decode($cinit_verify_data, true);


        if (is_array($response) && count($response['verify-purchase']) > 0) {
            return true;
        } else {
            return false;
        }
    }


    //Don't remove this code for security reasons
    function save_valid_purchase_code($action_type, Request $request)
    {
        if($action_type == 'update'){
            $data['value'] = $request->purchase_code;

            $status = $this->curl_request($data['value']);
            if($status){  
                SystemSetting::where('key', 'purchase_code')->update($data);
                session()->flash('message', get_phrase('Purchase code has been updated'));
                echo 1;
            }else{
                echo 0;
            }
        }else{
            return view('backend.admin.settings.save_purchase_code_form');
        }
        
    }

    public function listings()
    {
        $page_data = array();
        $page_data['listings'] = Listing::all();

        return view('backend.admin.listings.listings', $page_data);
    }

    public function contactAgent($id = "")
    {
        $page_data = array();

        $page_data['agent_details'] = User::find($id);
        $page_data['agent_id'] = $id;
        return view('backend.admin.listings.contact_agent', $page_data);
    }

    function agentPdfGenerate() 
    {
        $page_data=array();

        $agents = User::where('role','user')->where('is_agent', 1)->get();

        $page_data['agents'] = $agents;
        $pdf = PDF::loadView('backend.admin.user.agent.pdf_view', $page_data);
        // download PDF file with download method
        return $pdf->download('agent-list-'.time().'.pdf');
        
    }

    function customerPdfGenerate() 
    {
        $page_data=array();

        $customers = User::where('role','user')->where('is_agent', 0)->get();

        $page_data['customers'] = $customers;

        // share data to view
        $pdf = PDF::loadView('backend.admin.user.customer.pdf_view', $page_data);
        // download PDF file with download method
        return $pdf->download('customer-list-'.time().'.pdf');
        
    }

    function subscriptionReportPdf() 
    {
        $date_from = new Carbon('first day of January this year');
        $date_to = new Carbon('first day of december this year');
        $subscriptions = Subscription::where('created_at', '>=', $date_from->toArray()['formatted'])
            ->where('created_at', '<=', $date_to->toArray()['formatted'])
            ->get();



        $page_data['subscriptions']=$subscriptions;

        $pdf = PDF::loadView('backend.admin.subscription.pdf_view', $page_data);
        // download PDF file with download method
        return $pdf->download('subscription-list-'.time().'.pdf');
    }

    //Blog settings start from here
    public function contactSettings()
    {
        return view('backend.admin.settings.contact_settings');
    }

    public function contactSettingsUpdate(Request $request)
    {
        $data = $request->all();

        $key = 'system_email';
        $value = $data['system_email'];

        if(DB::table('system_settings')->where('key', $key)->get()->count() > 0) {
            SystemSetting::where('key', $key)->update([
                'key' => $key,
                'value' => $value,
            ]);
        } else {
            SystemSetting::create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        $key1 = 'phone';
        $value1 = $data['phone'];

        if(DB::table('system_settings')->where('key', $key1)->get()->count() > 0) {
            SystemSetting::where('key', $key1)->update([
                'key' => $key1,
                'value' => $value1,
            ]);
        } else {
            SystemSetting::create([
                'key' => $key1,
                'value' => $value1,
            ]);
        }

        $key2 = 'address';
        $value2 = $data['address'];

        if(DB::table('system_settings')->where('key', $key2)->get()->count() > 0) {
            SystemSetting::where('key', $key2)->update([
                'key' => $key2,
                'value' => $value2,
            ]);
        } else {
            SystemSetting::create([
                'key' => $key2,
                'value' => $value2,
            ]);
        }

        return redirect()->back()->with('message','Contact settings updated successfully.');
    }

    function seoSettings($active_tab="")
    {
        $page_data=array();
        $page_data['seo_meta_tags']=SeoMetaTag::all();
        $page_data['active_tab'] = !empty($active_tab) ? $active_tab : 'Home';

        return view('backend.admin.settings.seo_settings',$page_data);
    }


    function seoUpdate(Request $request, $route="")
    {
        if(!empty($request->all()))
        {

            if($request->og_image){
                $imagename = rand();
                $attachment = $imagename.'.'.$request->og_image->extension();
                $request->og_image->move(public_path('uploads/seo/'),$attachment);
                $data_image['og_image'] = $attachment;
                if (!empty($attachment)) {
                    if ($request->old_og_image && file_exists(public_path('uploads/seo/' . $request->old_og_image))) {
                        unlink(public_path('uploads/seo/' . $request->old_og_image));
                    }
                }
                }else{
                    $attachment =  $request->old_og_image;
                }
            
               

            $updateSeo = SeoMetaTag::where('route', $route)->first();
            $updateSeo->title = $request->title;
            $updateSeo->keywords = $request->keywords;
            $updateSeo->description = $request->description;
            $updateSeo->og_title = $request->og_title;
            $updateSeo->og_description = $request->og_description;
            $updateSeo->json_ld = $request->json_ld;
            $updateSeo->canonical = $request->canonical;
            $updateSeo->og_image = $attachment;
            $updateSeo->save();
            $page_data=array();
            $page_data['seo_meta_tags'] = SeoMetaTag::all();
            $page_data['active_tab'] = $route;

            return redirect('/admin/settings/seo/'.$route)->with('message', 'SEO updated Successfully');
        }

        return redirect()->back()->with('error', 'Seo update failed');
    }


    // Language Settings
 

    public function manageLanguage($language = '')
    {
        if(!empty($language)) {

            $edit_profile = $language;
            $phrases = Language::where('identifier', $language)->get();
            $languages = get_all_language();

            return view('backend.admin.language.manage_language', ['languages' => $languages, 'edit_profile' => $edit_profile, 'phrases' => $phrases]);
        } else {

            $languages = get_all_language();
            return view('backend.admin.language.manage_language', ['languages' => $languages]);

        }
    }

    public function addLanguage(Request $request){

        $language = $request->language;
        if ($language == 'n-a') {
            return redirect('admin/settings/language')->with('error', "Language name can not be empty or can not have special characters");
        }

        $phrases = Language::where('identifier', 'english')->get();

        foreach($phrases as $phrase){
            Language::create([
                'identifier' => $language,
                'phrase' => $phrase->phrase,
                'translated' => $phrase->translated,
            ]);
        }

        return redirect('admin/settings/language')->with('message', "Language added successfully");
    }

    public function updatedPhrase(Request $request , $language = "")
    {
        $current_editing_language = $request->currentEditingLanguage;
        $updatedValue = $request->updatedValue;
        $phrase = $request->phrase;

        $query = Language::where('identifier', $current_editing_language)
            ->where('phrase', $phrase)->first();

        if (!empty($query) && $query->count() > 0) {
            $query->translated = $updatedValue;
            $query->save();
        }
    }

    public function deleteLanguage($name='')
    {
        $language = Language::where('identifier', $name)->get();
        $language->map->delete();
        return redirect()->back()->with('message', 'You have successfully delete a language.');
    }


  //Mortgage Calculator
  public function mortgageSettings(){
    $page_data['allmortgage']=Calculator_attribute::orderBy('orders', 'ASC')->get();
    return view('backend.admin.mortgage_calculate.mortgage_list',$page_data);
  } 

 public function mortgageAdd(Request $request){
    $validated = $request->validate([
        'title' => 'required',
        'attribute_type' => 'required',
        'conditions' => 'required',
    ]);
    $maxValue = DB::table('calculator_attribute')->max('orders');
    $data = array(
        'title' => $request->title,
        'attribute_type' => $request->attribute_type,
        'conditions' => $request->conditions,
        'orders' => $maxValue + 1,
    );
    Calculator_attribute::insert($data);
     return redirect()->back()->with('message', 'You have successfully create a Mortgage.');
   }

    // Mortgage Edit
    public function mortgageEdit($id){
        $page_data['mortgage'] = Calculator_attribute::find($id);
        return view('backend.admin.mortgage_calculate.edit_mortgage',$page_data);
    }
    // Mortgage Update
    public function mortgageUpdate(Request $request,$id){
        $data = $request->all();
        $updateMortgage = Calculator_attribute::find($id);
        $updateMortgage['title'] = $data['title'];
        $updateMortgage['attribute_type'] = $data['attribute_type'];
        $updateMortgage['conditions'] = $data['conditions'];
        $updateMortgage->save();
        return redirect()->route('admin.mortgage_settings')->with('message', 'Mortgage Updated Successfully');
    }

    // Sorting Mortgage
    public function ajax_sort_section(Request $request) {
        $data = $request->all();
        $count = 1;
        foreach ($data as $value) {
            $sort = Calculator_attribute::find($value);
            $sort->orders = $count++;
            $sort->save();
        }
        return redirect()->back()->with('message', 'You have successfully Order a Mortgage.');
    }
   // Mortgage Delete
   public function mortgageDelete($id){
        Calculator_attribute::find($id)->delete();
        return redirect()->back()->with('message', 'Mortgage deleted Successfully');
    }




}
