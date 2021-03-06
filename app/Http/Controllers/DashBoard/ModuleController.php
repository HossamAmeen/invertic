<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Module,Product};

class ModuleController extends CRUDController
{
     use APIResponseTrait;
    public function __construct(Module $model)
    {
        $this->model = $model;
    }
    public function deleteRelatedItems($id)
    {
        Product::where('module_id' , $id)->delete();
    }
}
