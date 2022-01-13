<?php

namespace App\Http\Controllers;
use App\Http\Controllers\APIResponseTrait;
use App\Models\{Inquiry,Article,Product,Configration ,Brand, Complaint , Team};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use APIResponseTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function request(Request $request)
     {
        Inquiry::create($request->all());
        return $this->APIResponse(null, null, 200);
     }
    public function brands()
    {
        $data = Brand::with('modules')->orderBy('id', 'DESC')->get();
        return $this->APIResponse($data, null, 200);
    }
    public function articles($id = null )
    {
        if($id == null)
        $data = Article::orderBy('id', 'DESC')->get(['id','title' , 'description' ,'image']);
        else
        $data = Article::find($id);
        if(!isset($data)){
            return $this->APIResponse(null, null, 404);
        }
        return $this->APIResponse($data, null, 200);
    }
    public function products($product_id = null)
    {
        if($product_id != null)
        {
            $data = Product::with('offer')->find($product_id);
            if(!isset($data)){
                return $this->APIResponse(null, "هذا المنتج غير موجود", 404);
            }
        }
        else
        {
            $data = Product::with('offer')->orderBy('id', 'DESC')->get();
        }
       
        return $this->APIResponse($data, null, 200);
    }
    public function configrations()
    {
        $data = Configration::first();
        return $this->APIResponse($data, null, 200);
    }
    public function complaint(Request $request)
    {
        if($request->complaint == null || $request->complaint == " ")
        {
            return $this->APIResponse(null, 'complaint is required', 400);
        }
        Complaint::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'complaint' => $request->complaint
        ]);
        return $this->APIResponse(null, null, 200);
    }

}
