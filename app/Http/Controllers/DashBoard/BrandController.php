<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Brand,Module,Product};

class BrandController extends CRUDController
{
     use APIResponseTrait;
    public function __construct(Brand $model)
    {
        $this->model = $model;
    }
    public function with()
    {
        return ['modules'];
    }
    public function deleteRelatedItems($id)
    {
        Module::where('brand_id' , $id)->delete();
        Product::where('brand_id' , $id)->delete();
    }
}
