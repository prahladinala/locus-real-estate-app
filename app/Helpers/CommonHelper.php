<?php

use App\Models\User;
use App\Models\SystemSetting;
use App\Models\Listing;
use App\Models\AgentReview;
use App\Models\Review;
use App\Models\Language;
//All common helper functions
if (! function_exists('get_user_image')) {
    function get_user_image($file_name_or_user_id = '') {
       
        if(is_numeric($file_name_or_user_id)){
            $user_id = $file_name_or_user_id;
            $file_name = "";
        }else{
            $user_id = "";
            $file_name = $file_name_or_user_id;
        }

        if($user_id > 0){
            $user_id = $file_name_or_user_id;
            $file_name = DB::table('users')->where('id', $user_id)->value('image');

            if(isset($file_name) && File::exists('public/uploads/user_image/'.$file_name)){
                return asset('public/uploads/user_image/'.$file_name);
            }else{
                return asset('public/uploads/user_image/no.jpg');
            }
        }
    }
}


if (! function_exists('get_listing_image_or_video')) {
    function get_listing_image_or_video($listing_id,$file_name) {


        $list=Listing::find($listing_id);
        $gallery=json_decode($list->gallery,true);
        $additional_gallery=json_decode($list->additional_gallery,true);
        $promo_video=json_decode($list->promo_video,true);

           if(!empty($gallery) && in_array($file_name, $gallery) )
           {
                return asset('public/uploads/real_estate/galleryImages/'.$file_name);

           }
           elseif(!empty($additional_gallery) && in_array($file_name, $additional_gallery) )
           {
                return asset('public/uploads/real_estate/additionalGallery/'.$file_name);
           }
           elseif(!empty($promo_video) && in_array($file_name, $promo_video) )
           {
                return asset('public/uploads/real_estate/promo_video/'.$file_name);
           }
           else
           {
              return asset('public/uploads/real_estate/placeholder.jpg');
           }



    }
}

if (!function_exists('agent_review')) {
    function agent_review($agent_id)
    {
        $rating= AgentReview::where('agent_id',$agent_id)->sum('rating');
        $total_review=0;

        if(Auth::check())
        {
            $user_review_count=AgentReview::where('user_id',auth()->user()->id)->where('agent_id',$agent_id)->count();

        }
        else
        {
            $user_review_count=AgentReview::where('agent_id',$agent_id)->count();

        }


        if($user_review_count>0)
        {
            $total_review=$user_review_count;
            $avgrating=number_format($rating/$total_review,1);
        }
        else
        {
            $avgrating=0;
            $total_review=0;
        }

        $summary['rating']= $avgrating;
        $summary['review']= $total_review;

        return $summary;


    }
}

if (!function_exists('listing_review')) {
    function listing_review($listing_id)
    {
        $reviews=Review::where('listing_id',$listing->id)->where('status',1)->get();
        $avg_rating=0;

        foreach($reviews as $ratings)
        {
            $avg_rating+=(int)$ratings->rating;

        }

        $total_review=count($reviews);
        if($total_review==0)
              $total_review=1;
        $avg_rating=$avg_rating/$total_review;

        $summary['rating']=$avg_rating;
        $summary['review']=$total_review;

        return $summary;


    }
}




if (!function_exists('addon_status')) {
    function addon_status($unique_identifier = '')
    {
        $result =  DB::table('addons')->where('unique_identifier', $unique_identifier)->value('status');
        return $result;
    }
}

if ( ! function_exists('get_all_language'))
{
    function get_all_language(){
        return DB::table('languages')->select('identifier')->distinct()->get();
    }
}

if (!function_exists('get_phrase'))
{
    function get_phrase($phrase = '') {

        $active_language = get_settings('language');
         $phrase = str_replace("'", "'", $phrase);
        $query = DB::table('languages')->where('identifier', $active_language)->where('phrase', $phrase);
        if($query->get()->count() == 0){
            $translated = $phrase;

            $all_language = get_all_language();

            if($all_language->count() > 0){
                foreach($all_language as $language){

                    if(DB::table('languages')->where('identifier', $language->identifier)->where('phrase', $phrase)->get()->count() == 0){
                        DB::table('languages')->insert(array('identifier' => $language->identifier, 'phrase' => $phrase, 'translated' => $translated));
                    }
                }
            }else{
                DB::table('languages')->insert(array('identifier' => 'english', 'phrase' => $phrase, 'translated' => $translated));
            }
            $translated = str_replace('_', "'", $translated);
            return $translated;
        }
        $translated = $query->value('translated');
        $translated = str_replace('_', "'", $translated);
        return $query->value('translated');
    }
}

if (! function_exists('remove_js')) {
    function remove_js($string = '') {
        return preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $string);
    }
}

if (!function_exists('date_formatter')) {
    function date_formatter($strtotime = "", $format = "")
    {
        if ($format == "") {
            return date('d', $strtotime) . ' ' . date('M', $strtotime) . ' ' . date('Y', $strtotime);
        }

        if ($format == 1) {
            return date('D', $strtotime) . ', ' . date('d', $strtotime) . ' ' . date('M', $strtotime) . ' ' . date('Y', $strtotime);
        }

        if($format == 2){
        	$time_difference = time() - $strtotime;
	        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
	        //864000 = 10 days
	        if($time_difference > 864000){ return dateFormatter($strtotime, 1); }

	        $condition = array(
	        	12 * 30 * 24 * 60 * 60	=> 'year',
	        	30 * 24 * 60 * 60		=>  'month',
	        	24 * 60 * 60            =>  'day',
	        	60 * 60                 =>  'hour',
	        	60                      =>  'minute',
	        	1                       =>  'second'
	        );

	        foreach( $condition as $secs => $str ){
	            $d = $time_difference / $secs;
	            if( $d >= 1 ){
	                $t = round( $d );
	                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
	            }
	        }
        }
    }
}

if (!function_exists('currency')) {
    function currency($price = "")
    {
        $currency_position = DB::table('system_settings')->where('key', 'currency_position')->value('value');
        $code = DB::table('system_settings')->where('key', 'system_currency')->value('value');
        $symbol = DB::table('currencies')->where('code', $code)->value('symbol');

        if($currency_position == 'left'){
            return $symbol.''.$price;
        } else {
            return $price.''.$symbol;
        }
    }
}

if (!function_exists('slugify')) {
    function slugify($string)
    {
        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        return strtolower($string);
    }
}
if (!function_exists('slug')) {
    function slug($string)
    {
        $string = preg_replace('~[^\\pL\d]+~u', '_', $string);
        $string = trim($string, '_');
        return strtolower($string);
    }
}

if (!function_exists('get_video_extension')) {
    function get_video_extension($url)
    {
        if (strpos($url, '.mp4') > 0) {
            return 'mp4';
        } elseif (strpos($url, '.webm') > 0) {
            return 'webm';
        } else {
            return 'unknown';
        }
    }
}

if (!function_exists('ellipsis')) {
    function ellipsis($long_string, $max_character = 30)
    {
        $short_string = strlen($long_string) > $max_character ? mb_substr($long_string, 0, $max_character) . "..." : $long_string;
        return $short_string;
    }
}


// Global Settings
if (!function_exists('get_settings')) {
    function get_settings($key = '', $type='')
    {
       $global_settings = DB::table('system_settings')->where('Key', $key)->value('value');


        if($type == 'json') {
            $global_settings = json_decode($global_settings);
        }

        return $global_settings;
    }
}


// Fronted Settings
if (!function_exists('get_frontend_settings')) {
    function get_frontend_settings($type = '', $description='')
    {
       $frontend_settings = DB::table('frontend_settings')->where('type', $type)->value('description');


        if($type == 'json') {
            $frontend_settings = json_decode($frontend_settings);
        }

        return $frontend_settings;
    }
}



if (!function_exists('get_search_options_by_values')) {
    function get_search_options_by_values($listing_attribute_type_id = '')
    {

       $search_checkbox_options = DB::table('listing_attribute_values')->where('listing_attribute_type_id', $listing_attribute_type_id)->orderBy('value', 'ASC')->get();
        return $search_checkbox_options;
    }
}

if (!function_exists('check_wishlist_status')) {
    function check_wishlist_status($listing_id = '')
    {

        if(!Auth::check())
        {
            return $color="";
        }

        $wishlist=auth()->user()->wishlist;
        $wishlist=json_decode($wishlist,true);
        if(in_array($listing_id,$wishlist))
            $color="active-color";
        else
            $color="";

        return $color;
    }
}

if (!function_exists('setListingTypeSessionHelper')) {
    function setListingTypeSessionHelper($listing_type_id = '')
    {
        Session::forget('listing_type_id');
        Session::put('listing_type_id', $listing_type_id);
    }
}

if (!function_exists('unsetListingTypeSessionHelper')) {
    function unsetListingTypeSessionHelper($listing_type_id = '')
    {
        Session::forget('listing_type_id');
    }
}

if (!function_exists('check_follower_status')) {
    function check_follower_status($agent_id = '')
    {

        if(!Auth::check())
        {
            return false;

        }

        $follower=auth()->user()->following_agent;
        $follower=json_decode($follower, TRUE);
        if(in_array($agent_id,$follower))
            return true;
        else
            return false;


    }
}

if (!function_exists('agent_total_follower')) {
    function agent_total_follower($agent_id = '')
    {
        $users=User::all();
        $total=0;
        foreach($users as $user)
        {
            $temp=$user->following_agent;
            $temp=json_decode($temp, TRUE);

            if(in_array($agent_id,$temp))
            {
                $total++;
            }


        }

        return $total;



    }
}

if (!function_exists('get_property_type')) {
    function get_property_type($listing_attribute_type_id = '')
    {

       $type_name = DB::table('listing_arrtibute_types')->where('id', $listing_attribute_type_id)->value('type');
        return $type_name;
    }
}

if (!function_exists('get_user_by_id')) {
    function get_user_by_id($id = '')
    {

       $user = DB::table('users')->where('id', $id)->value('name');
        return $user;
    }
}

if (!function_exists('set_config')) {
    function set_config($key = '', $value='')
    {
        $config = json_decode(file_get_contents(base_path('config/config.json')), true);

        $config[$key] = $value;

        file_put_contents(base_path('config/config.json'), json_encode($config));
    }
}

// Human readable time
if (!function_exists('time_formatter')) {
    function time_formatter($duration, $format = "")
    {
        if ($duration && $format == "") {
            $duration_array = explode(':', $duration);
            $hour   = $duration_array[0];
            $minute = $duration_array[1];
            $second = $duration_array[2];
            if ($hour > 0) {
                $duration = $hour . ' ' . 'hr' . ' ' . $minute . ' ' . 'min';
            } elseif ($minute > 0) {
                if ($second > 0) {
                    $duration = ($minute + 1) . ' ' . 'min';
                } else {
                    $duration = $minute . ' ' . 'min';
                }
            } elseif ($second > 0) {
                $duration = $second . ' ' . 'sec';
            } else {
                $duration = '00:00';
            }
        } elseif($seconds && $format == 'seconds_to_format') {
            $hours = floor($seconds / 3600);
            $mins = floor($seconds / 60 % 60);
            $secs = floor($seconds % 60);

            $duration = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } elseif($seconds && $format == 'format_to_seconds') {

        }
        return $duration;
    }
}

// RANDOM NUMBER GENERATOR FOR ELSEWHERE
if (!function_exists('random')) {
    function random($length_of_string, $lowercase = false)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        $randVal = substr(str_shuffle($str_result), 0, $length_of_string);
        if($lowercase){
        	$randVal = strtolower($randVal);
        }
        return $randVal;
    }
}

// RANDOM NUMBER GENERATOR FOR STUDENT CODE
if (! function_exists('student_code')) {
  function student_code($length_of_string = 8) {
    // String of all numeric character
    $str_result = '0123456789';
    // Shufle the $str_result and returns substring of specified length
    $unique_id = substr(str_shuffle($str_result), 0, $length_of_string);
    $splited_unique_id = str_split($unique_id, 4);
    $running_year = date('Y');
    $student_code = $running_year.'-'.$splited_unique_id[0].'-'.$splited_unique_id[1];
    return $student_code;
  }
}

// TEACHER PERMISSION. PROVIDE MODULE NAME AND TEACHERS ID
if (! function_exists('null_checker')) {
  function null_checker($value = "") {
    if (trim($value, "") == "") {
      return '('.get_phrase('not_found').')';
    }else{
      return $value;
    }
  }
}

// GET GRADE
if ( ! function_exists('get_grade'))
{
  function get_grade($acquired_number = "", $type = "") {
    if (empty($acquired_number)) {
      return "N/A";
    }else{
      $acquired_grade = DB::table('grades')->distinct()->get();
      if ($acquired_grade->count() > 0) {
        $founder = false;
        foreach ($acquired_grade as $grade) {
          if ($acquired_number >= $grade->mark_from && $acquired_number <= $grade->mark_upto) {
            $founder = true;
            if (!empty($type)) {
              return $grade[$type];
            }else{
              return $grade->name.'('.$grade->grade_point.')';
            }
          }
        }
        if(!$founder){
          return "N/A";
        }
      }else{
        return "N/A";
      }
    }
  }
}

if (!function_exists('get_active_currency')) {
    function get_active_currency()
    {
        $global_system_currency = GlobalSettings::where('key', 'system_currency')->get()->toArray();
        $global_system_currency = $global_system_currency[0]['value'];
        return $global_system_currency;
    }
}

if (!function_exists('relogin_user')) {
    function relogin_user($user_id='')
    {
        $user = User::find($user_id);
        Auth::login($user);

    }
}



if (!function_exists('get_payment_keys')) {
    function get_payment_keys($payment_method = '',$returnItem='')
    {
        $return_value;
        $global_system_currency = GlobalSettings::where('key', 'system_currency')->get()->toArray();
        $global_system_currency = $global_system_currency[0]['value'];

        if ($payment_method == "stripe") {
            $stripe = PaymentMethods::where('name', 'stripe')->first()->toArray();
            $stripe_keys = json_decode($stripe['payment_keys']);
            if ($stripe['mode'] == "test") {
                $return_value['test_key'] = $stripe_keys->test_key;
                $return_value['test_secret_key'] = $stripe_keys->test_secret_key;
                $return_value['currency'] = $global_system_currency;
                return    $return_value[$returnItem];
            } elseif ($stripe['mode'] == "live") {
                $return_value['public_live_key'] = $stripe_keys->public_live_key;
                $return_value['secret_live_key'] = $stripe_keys->secret_live_key;
                $return_value['currency'] = $global_system_currency;
                return    $return_value[$returnItem];
            }
        }


        if ($payment_method == "paytm") {
            $paytm = PaymentMethods::where('name', 'paytm')->first()->toArray();
            $paytm_keys = json_decode($paytm['payment_keys']);

            if ($paytm['mode'] == "test") {
                $return_value['environment'] = $paytm_keys->environment;
                $return_value['merchant_id'] = $paytm_keys->test_merchant_id;
                $return_value['merchant_key'] = $paytm_keys->test_merchant_key;
                $return_value['merchant_website'] = $paytm_keys->merchant_website;
                $return_value['channel'] = $paytm_keys->channel;
                $return_value['industry_type'] = $paytm_keys->industry_type;
                $return_value['currency'] = $global_system_currency;
                return    $return_value[$returnItem];

            } elseif ($paytm['mode'] == "live") {
                $return_value['environment'] = $paytm_keys->environment;
                $return_value['merchant_id'] = $paytm_keys->live_merchant_id;
                $return_value['merchant_key'] = $paytm_keys->live_merchant_key;
                $return_value['merchant_website'] = $paytm_keys->merchant_website;
                $return_value['channel'] = $paytm_keys->channel;
                $return_value['industry_type'] = $paytm_keys->industry_type;
                $return_value['currency'] = $global_system_currency;
                return    $return_value[$returnItem];

            }
        }


    }


}


if (!function_exists('count_unread_message_of_thread')) {

    function count_unread_message_of_thread($message_thread_code="")
    {
        $unread_message_counter = 0;
        $current_user = auth()->user()->id;
        $messages = DB::table('messages')->where('message_thread_code', $message_thread_code)->get();
        foreach ($messages as $row) {
            if ($row->sender != $current_user && $row->read_status == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }
}

if (!function_exists('count_unread_customer_messages')) {

    function count_unread_customer_messages()
    {
        $unread_message_counter = 0;
        $current_user = auth()->user()->id;
        $messages_thread = DB::table('message_thread')->where('receiver', auth()->user()->id)->get();
        foreach ($messages_thread as $thread) {
            $messages = DB::table('messages')->where('message_thread_code', $thread->message_thread_code)->get();
            foreach ($messages as $row) {
                if ($row->sender != $current_user && $row->read_status == '0')
                    $unread_message_counter++;
            }
        }
        return $unread_message_counter;
    }
}

if (!function_exists('count_unread_agent_messages')) {

    function count_unread_agent_messages()
    {
        $unread_message_counter = 0;
        $current_user = auth()->user()->id;
        $messages_thread = DB::table('message_thread')->where('sender', auth()->user()->id)->get();
        foreach ($messages_thread as $thread) {
            $messages = DB::table('messages')->where('message_thread_code', $thread->message_thread_code)->get();
            foreach ($messages as $row) {
                if ($row->sender != $current_user && $row->read_status == '0')
                    $unread_message_counter++;
            }
        }
        return $unread_message_counter;
    }
}

if(!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if(!function_exists('timeAgo')) {
    function timeAgo($time_ago) {
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            }
            else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an hour ago";
            }else{
                return "$hours hrs ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "yesterday";
            }else{
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a month ago";
            }else{
                return "$months months ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "one year ago";
            }else{
                return "$years years ago";
            }
        }
    }



}

if (!function_exists('set_config')) {
    function set_config($key = '', $value='')
    {
        $config = json_decode(file_get_contents(base_path('config/config.json')), true);

        $config[$key] = $value;

        file_put_contents(base_path('config/config.json'), json_encode($config));
    }
}




if (!function_exists('script_checker')) {
    function script_checker($string = '', $convert_string = true)
    {

        if ($convert_string == true) {
            $string = nl2br(htmlspecialchars($string));
        } else {
            //make script to string
            $string = str_replace("<script>", "&lt;script&gt;", $string);
            $string = str_replace("</script>", "&lt;/script&gt;", $string);

            //removing <script> tags
            $string = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $string);
            $string = preg_replace("/[<][^<]*script.*[>].*[<].*[\/].*script*[>]/i", "", $string);

            //removing inline js events
            $string = preg_replace("/([ ]on[a-zA-Z0-9_-]{1,}=\".*\")|([ ]on[a-zA-Z0-9_-]{1,}='.*')|([ ]on[a-zA-Z0-9_-]{1,}=.*[.].*)/", "", $string);

            //removing inline js
            $string = preg_replace("/([ ]href.*=\".*javascript:.*\")|([ ]href.*='.*javascript:.*')|([ ]href.*=.*javascript:.*)/i", "", $string);
        }

        return $string;
    }
}

