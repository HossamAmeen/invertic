<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Brand};

class BrandController extends CRUDController
{
     use APIResponseTrait;
    public function __construct(Brand $model)
    {
        $this->model = $model;
    }
}
