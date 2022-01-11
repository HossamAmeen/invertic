<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
     use SoftDeletes;
      protected $fillable = ['name','address','phone','status','product_id'  ];
     protected $hidden = [
         'user_id' , 'updated_at','deleted_at' 
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
