<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product};

class ProductController extends CRUDController
{
     use APIResponseTrait;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
