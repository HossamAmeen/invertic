<?php

namespace App\Http\Controllers\DashBoard;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon, File , Hash;

class CRUDController extends Controller
{
    use APIResponseTrait;
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $rows = $this->model;
        $rows = $this->filter($rows);
        $with = $this->with();
        if (!empty($with))
        {
            $rows = $rows->with($with);
        }
        $attributes = $this->attributes();
        $rows = $rows->orderBy('id', 'DESC')->get($attributes);

        return $this->APIResponse($rows, null, 200);
    }

    public function store(Request $request){
        
        // if (isset($request->validator) && $request->validator->fails())
        // {
        //     return $this->APIResponse(null , $request->validator->messages() ,  422);
        // }

        $requestArray = $request->all();
        // return $request->all() ;
        if(isset($requestArray['password']) )
        $requestArray['password'] =  Hash::make($requestArray['password']);
       
        // if(isset($requestArray['image']) )
        // {
        //     // return "TesT";
        //     $fileName = $this->storeFile($request->image  );
        //     $requestArray['image'] =  $fileName;
        // }
       
        // $requestArray['user_id'] = Auth::user()->id;
        $this->model->create($requestArray);
        return $this->APIResponse(null, null, 200);
    }

    public function show($id)
    {
        $item = $this->model->Find($id);
        if(!isset($item)){
            return $this->APIResponse(null, "this item not found or deleted", 404);
        }
        $with = $this->with();
        // return $with;
        if (!empty($with))
        {
            $item = $this->model::with($with)->get()->find($id);
            // $rows = $rows->with($with);
        }
        return $this->APIResponse($item, null, 200);
    }

    public function edit($id)
    {
        $item = $this->model->FindOrFail($id);
        $with = $this->with();
        // return $with;
        if (!empty($with))
        {
            $item = $this->model::with($with)->get()->find($id);
            // $rows = $rows->with($with);
        }
        return $this->APIResponse($item, null, 200);
    }

    public function update($id , Request $request){
        
        // if (isset($request->validator) && $request->validator->fails())
        // {
        //     return $this->APIResponse(null , $request->validator->messages() ,  422);
        // }
    
        $row = $this->model->Find($id);
        if(!isset($row)){
            return $this->APIResponse(null, "this item not found or deleted", 404);
        }
        $requestArray = $request->all();
        if(isset($requestArray['password']) && $requestArray['password'] != ""){
            $requestArray['password'] =  Hash::make($requestArray['password']);
        }else{
            unset($requestArray['password']);
        }
        // if(isset($requestArray['image']) )
        // {
        //     $fileName = $this->storeFile($request->image  );
        //     $requestArray['image'] =  $fileName;
        // }
        
        // $requestArray['user_id'] = Auth::user()->id;
        $row->update($requestArray);
        return $this->APIResponse(null, null, 200);
    }

    public function destroy($id)
    {

        $row = $this->model->Find($id);
        if(!isset($row)){
            return $this->APIResponse(null, "this item not found or deleted", 404);
        }
        if(isset($row->file) && is_file(asset($row->file)))
        {
            // unlink(asset($row->file));
        }
        if(isset($row->file) && is_file(asset($row->image)))
        {
            // unlink(asset($row->image));
        }
        $row->delete();
        $this->deleteRelatedItems($id);
        return $this->APIResponse(null, null, 200);
    }

    protected function filter($rows)
    {
        return $rows;
    }

    protected function with()
    {
        return [];
    }


    protected function append()
    {
        return [];
    }

    protected function attributes()
    {
        return '*';
    }

    public function deleteRelatedItems($rowId)
    {
        
    }

    protected function storeFile($file, $folderName = null)
    {
        $path = 'uploads/'.$folderName.'/'.date("Y-m-d");
        $path = 'uploads/'.date("Y-m-d");
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        $name = time().'.'.$file->getClientOriginalExtension();
        $file->move($path, $name);

        return $path .'/'. $name;
    }
    public function uploadFile(Request $request)
    {
        $path = 'uploads/'.$folderName.'/'.date("Y-m-d");
        $path = 'uploads/'.date("Y-m-d");
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
        }
        $file = $request->image;
        $name = time().'.'.$file->getClientOriginalExtension();
        $file->move($path, $name);
        return $this->APIResponse(['path'=>asset($path .'/'. $name)], null, 200);
        return $path .'/'. $name;
    }

}
