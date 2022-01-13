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
            $data = Product::with('offer')->orderBy('id', 'DESC');
            $data = $this->filter($data);
            // return $data->get() ;
            $data = $data->get();
            return $this->APIResponse($data, null, 200);
        }
        return $data->get() ;
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
    public function filter($row)
    {

        if(request('color') != null){
         $row =$row->where('color' ,'like','%'. request('color').'%');
        }
        if(request('type') != null){
            $row =$row->where('type' ,'like','%'. request('type').'%');
           }
        if(request('capacity') != null){
         $row =$row->where('capacity' ,'like','%'. request('capacity').'%');
        }
        if(request('control') != null){
            $row =$row->where('control' ,'like','%'. request('control').'%');
           }
        if(request('technology') != null){
         $row =$row->where('technology' ,'like','%'. request('technology').'%');
        }
        if(request('micanthim') != null){
            $row =$row->where('micanthim' ,'like','%'. request('micanthim').'%');
        }
        if(request('shape') != null){
            $row =$row->where('shape' ,'like','%'. request('shape').'%');
        }
        if(request('characteristic') != null){
            $row =$row->where('characteristic' ,'like','%'. request('characteristic').'%');
        }
        
        if(request('guarantee') != null){
            $row =$row->where('guarantee' ,'like','%'. request('guarantee').'%');
        }

        if(request('min_price') != null){
            $row =$row->where('price' ,'>=', request('min_price'));
        }
        if(request('max_price') != null){
            $row =$row->where('price' ,'<=', request('max_price'));
        }
        if(request('brand_id') != null){
            $row =$row->where('brand_id' ,request('brand_id'));
        }
        if(request('module_id') != null){
            $row =$row->where('module_id' , request('module_id'));
        }
        return $row;
    }
}
