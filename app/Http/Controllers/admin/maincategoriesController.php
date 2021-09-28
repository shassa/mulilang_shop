<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\maincategoriesRequest;
use App\Models\MainCategories;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class maincategoriesController extends Controller
{
    public function index(){
       $defultlang= getdefultlang();
       //    dd($defultlang);
       $categories = MainCategories::where("translation_lang",$defultlang)
       ->selection()->get();
       return view('admin.maincategories.index',compact('categories'));
    }

    public function create(){
       return view('admin.maincategories.create');
    }

    public function store(maincategoriesRequest $request){
      try{
         DB::beginTransaction();
         $collection=collect($request->category);
         $defultcategory=$collection->filter(function($val,$key){
            return $val['abbr'] == getdefultlang();
            });
            if($request->has('photo'))
            $photopath=uploadphoto('maincategories',$request->photo);
         $arrayofdefcat= array_values($defultcategory->all())[0];
         $defultcategoryid = MainCategories::insertGetId([
            'translation_lang'=>$arrayofdefcat['abbr'],
            'translation_of'=>0,
            'slug'=>$arrayofdefcat['name'],
            'name'=>$arrayofdefcat['name'],
            'photo'=>$photopath //storage/app/public/images/maincategory
         ]);
         $restcategories=$collection->filter(function($val,$key){
            return $val['abbr'] != getdefultlang();
         });
         $categoriesarray =[];
         if(isset($restcategories) && $restcategories->count()){
            foreach($restcategories as $restcategory){
               $categoriesarray []=[
                  'translation_lang'=>$restcategory['abbr'],
                  'translation_of'=>$defultcategoryid ,
                  'slug'=>$restcategory['name'],
                  'name'=>$restcategory['name'],
                  'photo'=>$photopath
               ];
            }
            MainCategories::insert($categoriesarray);
         }
         DB::commit();
         return redirect()->route('admin.main_categories')->with(['success'=>'تم حفظ القسم بنجاح']);
      }catch(Exception $ex){
         DB::rollBack();
         return redirect()->route('admin.main_categories')->with(['errors'=>'حدث خطا برجاء المحاوله مرة اخرى']);
      }
    }

    public function edit($id){
       $category= MainCategories::with('categories')->selection()->find($id);
       if($category->count()==0){
          return redirect()->route('admin.main_categories')->with(['errors'=>'هذا القسم غير موجود']);
       }
          return view('admin.maincategories.edit',compact('category'));
    }

    public function update(maincategoriesRequest $request,$id){

      try{
        $MainCategorie = MainCategories::find($id);
        if(!$MainCategorie)
           return redirect()->route('admin.main_categories')->with(['errors'=>'هذا القسم غير موجود']);

        if($request->has('category.0.active')){
            $request->request->add(['active'=>1]);
        }else{
             $request->request->add(['active'=>0]);
        }

        $MainCategorie->update([
            'name'=> $request->category[0]['name'],
            'active'=>$request->active
        ]);

        if($request->has('photo')){
            $photopath=uploadphoto('maincategories',$request->photo);
            $MainCategorie->update([
                'photo'=>$photopath
            ]);
          }
          return redirect()->route('admin.main_categories')->with(['success'=>'تم حفظ التعديلات بنجاح']);

       }catch(Exception $ex){
           return redirect()->route('admin.main_categories')->with(['errors'=>'هناك خطا فى التعديل']);
       }
    }

    public function destroy($id){
        try{
            $categories=MainCategories::find($id);
            if (!$categories)
              return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود ']);

              $vendors=$categories->vendors;
        //   dd($vendors);
            if(isset($vendors) && $vendors->count() > 0){
               return redirect()->route('admin.main_categories')->with(["error"=>"هذا القسم يحتوى على متاجر لا يمكن حذفه"]);
               }

                $image=Str::after($categories->photo,'storage');
                $image=base_path('storage'.$image);
                unlink($image);

             $categories->categories()->delete();
             $categories->delete();
            return redirect()->route('admin.main_categories')->with(["success"=>"تم حذف القسم بنجاح"]);
       }catch(Exception $ex){
         return $ex;
       }
    }

    public function changestatue($id){

        try{
            $categories=MainCategories::find($id);
            if (!$categories)
              return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود ']);

            $statue=$categories->active == 0 ? 1 : 0;
            //dd($statue);
            $categories->update(['active'=>$statue]);

            return redirect()->route('admin.main_categories')->with(["success"=>"تم تعديل الحاله بنجاح"]);

        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.main_categories')->with(['errors'=>'هناك خطا فى التعديل']);
        }
    }
}

