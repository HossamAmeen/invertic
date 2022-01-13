<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use SoftDeletes;
      protected $fillable = ['name', 'en_name',  'image',
       'price', 'color','description', 'type', 'capacity', 'control'
        ,'technology','micanthim','shape','characteristic','guarantee','brand_id',"module_id"
    ];
     protected $hidden = [
         'user_id',"created_at" , 'updated_at','deleted_at' 
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function offer()
    {
        return $this->hasOne(Offer::class);
    }
}
