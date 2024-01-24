<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $table = 'listings';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'listing_type_id',
        'user_id',
        'listing_attribute_id',
        'listing_arrtibute_type_id',
        'country_id',
        'state_id',
        'city_id',
        'latitude',
        'longitude',
        'address',
        'short_description',
        'long_description',
        'year_build_in',
        'area',
        'bedroom',
        'bathroom',
        'garage',
        'gallery',
        'thumbnail',
        'banner',
        'promo_video',
        'is_featured',
        'status',
        'model',
        'og_title',
        'og_description',
        'json_ld',
        'og_image',
        'canonical',
        'created_at',
        'updated_at',
    ];

    public function listings_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }



    public function listing_to_listingtype()
    {
        return $this->belongsTo(Listing_type::class,'listing_type_id','id');
    }

    public function listing_to_city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function listing_to_state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function listing_to_country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }



    public function listing_to_listing_attribute()
    {
        return $this->belongsTo(Listing_attribute::class,'listing_attribute_id','id');
    }


    public function listing_to_listing_attribute_type()
    {
        return $this->hasOne(Listing_arrtibute_type::class,'listing_attribute_type_id','id');
    }

    public function listing_to_listing_attribute_type_values()
    {
        return $this->hasMany(Listing_attribute_value::class,'listing_id','id');
    }

    public function listing_to_review()
    {
        return $this->hasMany(Review::class,'listing_id','id');
    }

    public function listing_to_appointment()
    {
        return $this->hasMany(Appointment::class, 'listing_id', 'id');
    }

    public function listing_to_nearby()
    {
        return $this->hasMany(NearbyLocation::class, 'listing_id', 'id');
    }

    public function get_property_details($listing_type_id,$listing_id)
    {

        $property_details_id=Listing_attribute::where('listing_type_id',$listing_type_id)->where('attribute_name','property_details')->value('id');
        $property_entity=Listing_arrtibute_type::where('listring_attribute_id',$property_details_id)->get();

        $property_details=array();

        foreach($property_entity as $entity)
        {

                $row=Listing_attribute_value::where('listing_attribute_type_id',$entity->id)->where('listing_id',$listing_id)->first();
                $count=Listing_attribute_value::where('listing_attribute_type_id',$entity->id)->where('listing_id',$listing_id)->get()->count();

                if($count>0)
                {
                    $property_details[$entity->slug."_id"]=$row->id;
                    $property_details[$entity->slug]=$row->value;
                    $property_details['listing_id']=$row->listing_id;
                }
                else
                {
                    $property_details[$entity->slug]=" ";

                }


        }



        $object = (object) $property_details;


       return $object;



    }


    public function get_categories($listing_type_id)
    {
        $attribute_category_id=Listing_attribute::where('listing_type_id',$listing_type_id)->where('attribute_name','category')->value('id');
        $categories=Listing_arrtibute_type::where('listring_attribute_id',$attribute_category_id)->get();
        $object = (object) $categories;
        return $object;

    }

    public function get_anenities($listing_type_id)
    {
        $attribute_amenities_id=Listing_attribute::where('listing_type_id',$listing_type_id)->where('attribute_name','amenities')->value('id');
        $amenities=Listing_arrtibute_type::where('listring_attribute_id',$attribute_amenities_id)->get();
        $object = (object) $amenities;
        return $object;



    }


    public function get_location_by_nearby_id($listing_id,$nearby_id)
    {
        return NearbyLocation::where('listing_id',$listing_id)->where('nearby_id',$nearby_id)->get();
    }

    public function category_name($id)
    {
        $name=Listing_arrtibute_type::find($id);
        return $name->type;
    }




















}
