<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Offer,Inquiry};

class ProductController extends CRUDController
{
     use APIResponseTrait;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $requestArray = $request->all();
        $product = $this->model->create($requestArray);
        if($request->title!=null){
            $offerRequest = [
                'title' => $request->title,
                'image'=> $request->offer_image,
                'price'=>$request->price_after_discount,
                'discount'=>$request->discount,
                'product_id'=>$product->id
            ];
            // return $product;
            // return $offerRequest;
            $offer = Offer::create($offerRequest);

        }
        return $this->APIResponse(null, null, 200);
    }

    public function update($id , Request $request){
            
        $row = $this->model->Find($id);
        if(!isset($row)){
            return $this->APIResponse(null, "this item not found or deleted", 404);
        }
        $requestArray = $request->all();
        
        $row->update($requestArray);

        if($request->title!=null){
            $offerRequest = [
                'title' => $request->title,
                'image'=> $request->offer_image,
                'price'=>$request->price_after_discount,
                'discount'=>$request->discount,
                'product_id'=>$row->id
            ];
            $offer = Offer::where('product_id',$row->id)->first();
            if(isset($offer)){
                $offer = Offer::update($offerRequest);
            }
            else
            $offer = Offer::create($offerRequest);
            
        }
        else
        {
            $offer = Offer::where('product_id',$row->id)->first();
            if(isset($offer)){
                $offer->delete();
            }
        }

        return $this->APIResponse(null, null, 200);
    }

    protected function with()
    {
        return ['offer'];
    }
    public function deleteRelatedItems($id)
    {
        Inquiry::where('product_id' , $id)->delete();
        Offer::where('product_id' , $id)->delete();
    }
}
