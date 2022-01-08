<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Inquiry};

class InquiryController extends CRUDController
{
     use APIResponseTrait;
    public function __construct(Inquiry $model)
    {
        $this->model = $model;
    }
}
