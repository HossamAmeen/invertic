<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     use SoftDeletes;
      protected $fillable = ['name','brand_id'];
     protected $hidden = [
         'user_id',"created_at" , 'updated_at','deleted_at' 
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
