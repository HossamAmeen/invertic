<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configration extends Model
{
     use SoftDeletes;
     protected $fillable = ['website_name' , 'email' , 'address' , 'phone' ,'phone2','phone3','phone4',
                            'about','facebook','twitter','instagram','whatsapp','description',"all_products_image","offers_image","how_choice_product_image",
                            'school_vision','join_us','join_us2','value','message','video','video2','en_about',
                            'terms_conditions','privacy_policy', 'user_id'];
     protected $hidden = [
         'user_id',"created_at" , 'updated_at' ,'deleted_at'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
