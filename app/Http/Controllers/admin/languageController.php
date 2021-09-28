<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\languageRequest;
use Illuminate\Http\Request;
use App\Models\Language;
use Exception;

class languageController extends Controller
{
    public function index(){
      $languages = Language::select()->paginate(PAGINATION);
       return view('admin.languages.index',compact('languages'));
    }

    public function create(){
        return view('admin.languages.create');
     }

     public function store(languageRequest $request){
         try{
           if(!$request->has('active'))
             $request->request->add(['active'=> 0]);

            Language::create($request->except(["_token"]));
            return redirect()->route('admin.language')->with(["success"=>"تم حفظ اللغه بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.language')->with(["error"=>"حدث خطا اثناء الاضافه حاول مرة اخرى"]);
        }
     }

     public function update(languageRequest $request,$id){
      try{
          $language = Language::find($id);
          if(!$language)
          return redirect()->route('admin.language')->with(["error"=>" هذه اللغه غير موجوده"]);

           if(!$request->has('active'))
           $request->request->add(['active'=> 0]);

          $language->update($request->except(["_token"]));
         return redirect()->route('admin.language')->with(["success"=>"تم حفظ اللغه بنجاح"]);
     }catch(Exception $ex){
         return redirect()->route('admin.language')->with(["error"=>"حدث خطا اثناء الاضافه حاول مرة اخرى"]);
     }
  }

     public function destroy($id){
       Language::find($id)->delete();
       return redirect()->route('admin.language')->with(["success"=>"تم حذف اللغه بنجاح"]);
      }

      public function edit($id){
       $languages=Language::find($id);
       if(!$languages)
       return redirect()->route('admin.language')->with(["error"=>"حدث خطا اثناء الاضافه حاول مرة اخرى"]);

       return view('admin.languages.edit',compact('languages'));

      }

}
