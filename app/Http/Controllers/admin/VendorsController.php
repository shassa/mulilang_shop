<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategories;
use App\Models\Vendors;
use App\Notifications\VendorCreated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class VendorsController extends Controller
{
    public function index(){
        $vendors=Vendors::selection()->paginate(PAGINATION);

        return view('admin.vendors.index',compact('vendors'));
    }

    public function create(){

        $categories=MainCategories::where([['translation_of',0],['active',1]])->get();

        return view('admin.vendors.create',compact('categories'));
    }

    public function store(VendorRequest $request){

         try{
            $photopath="";
            if(!$request->has('active'))
                $request->request->add(['active'=>0]);
            if($request->has('logo'))
               $photopath=uploadphoto('vendors',$request->logo);

               $vendor= Vendors::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'address'=>$request->address,
                            'mobile'=>$request->mobile,
                            'password'=>$request->password,
                            'category_id'=>$request->category_id,
                            'logo'=>$photopath,
                            'active'=>$request->active
                        ]);
                Notification::send($vendor,new VendorCreated($vendor));
            return redirect()->route('admin.vendors')->with(['success'=>'تم الحفظ بنجاح']);

        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.vendors')->with(['errors'=>'حدث خطا برجاء المحاوله مرة اخرى']);
        }
    }

    public function edit($id){
       try{
         $vendor =Vendors::selection()->find($id);
         if(!$vendor)
            return redirect()->route('admin.vendors')->with(['errors'=>'هذا المتجر غير موجود']);

            $categories=MainCategories::where([['translation_of',0],['active',1]])->get();

        return view('admin.vendors.edit',compact('vendor','categories'));

       }catch(Exception $ex){
           return $ex;
           return redirect()->route('admin.vendors')->with(['errors'=>'هذا المتجر غير موجود']);
       }

    }

    public function update($id,VendorRequest $request){
       try{
            $vendor =Vendors::selection()->find($id);
            if(!$vendor)
            return redirect()->route('admin.vendors')->with(['errors'=>'هذا المتجر غير موجود']);

            $data=[];

            //prepare request
            if($request->has('password') && !is_null($request->password)){
                $data['password']=$request->password;
             }

             if($request->has('active')){
                 $request->request->add(['active'=>1]);
             }else{
                  $request->request->add(['active'=>0]);
             }

             $data = $request->except('_token', 'id', 'logo', 'password');

             DB::beginTransaction();

            if($request->has('logo')){
                $photopath=uploadphoto('vendors',$request->logo);
                $vendor->update([
                    'logo'=>$photopath
                ]);
              }

              $vendor->update($data);

               DB::commit();
               return redirect()->route('admin.vendors')->with(["success"=>"تم التعديل على  المتجر بنجاح"]);

        }catch(Exception $ex){
            return $ex;
            DB::rollBack();
            return redirect()->route('admin.vendors')->with(['errors'=>'هذا المتجر غير موجود']);
        }

    }

    public function destroy($id){
        Vendors::find($id)->delete();
        return redirect()->route('admin.vendors')->with(["success"=>"تم حذف المتجر بنجاح"]);
       }

       public function changestatue($id){

        try{
            $vendor=Vendors::find($id);
            if (!$vendor)
              return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود ']);

            $statue=$vendor->active == 0 ? 1 : 0;
            //dd($statue);
            $vendor->update(['active'=>$statue]);

            return redirect()->route('admin.vendors')->with(["success"=>"تم تعديل الحاله بنجاح"]);

        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.vendors')->with(['errors'=>'هناك خطا فى التعديل']);
        }
    }


}
