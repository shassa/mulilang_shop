<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\maincategoriesRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\MainCategories;
use App\Models\SubCategories;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defultlang= getdefultlang();
        $subcategories = SubCategories::with('maincategory')->where("translation_lang",$defultlang)
        ->selection()->get();
        return view('admin.subcategories.index',compact('subcategories'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincategories=MainCategories::where('translation_lang',getdefultlang())->get();
        return view('admin.subcategories.create',compact('maincategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(maincategoriesRequest $request)
    {
        try{
            DB::beginTransaction();
            $collection=collect($request->category);
            $defultcategory=$collection->filter(function($val,$key){
               return $val['abbr'] == getdefultlang();
               });
               if($request->has('photo'))
               $photopath=uploadphoto('subcategories',$request->photo);
            $arrayofdefcat= array_values($defultcategory->all())[0];
            $defultcategoryid = SubCategories::insertGetId([
               'translation_lang'=>$arrayofdefcat['abbr'],
               'translation_of'=>0,
               'category_id'=>$request->category_id,
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
                     'category_id'=>$request->category_id,
                     'slug'=>$restcategory['name'],
                     'name'=>$restcategory['name'],
                     'photo'=>$photopath
                  ];
               }
               SubCategories::insert($categoriesarray);
            }
            DB::commit();
            return redirect()->route('admin.sub_categories')->with(['success'=>'تم حفظ القسم بنجاح']);
         }catch(Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.sub_categories')->with(['errors'=>'حدث خطا برجاء المحاوله مرة اخرى']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($maincategoryid)
    {
        $defultlang= getdefultlang();
        $subcategories = MainCategories::with('subCategoeies')
        ->selection()->find($maincategoryid);
        // return $subcategories;
        return view('admin.subcategories.show',compact('subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category= SubCategories::with('subCategories')->selection()->find($id);
        if($category->count()==0){
           return redirect()->route('admin.sub_categories')->with(['errors'=>'هذا القسم غير موجود']);
        }
           return view('admin.subcategories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(maincategoriesRequest $request, $id)
    {
      try{
        $SubCategorie = SubCategories::find($id);
        if(!$SubCategorie)
           return redirect()->route('admin.sub_categories')->with(['errors'=>'هذا القسم غير موجود']);

        if($request->has('category.0.active')){
            $request->request->add(['active'=>1]);
        }else{
             $request->request->add(['active'=>0]);
        }

        $SubCategorie->update([
            'name'=> $request->category[0]['name'],
            'active'=>$request->active
        ]);

        if($request->has('photo')){
            $photopath=uploadphoto('subcategories',$request->photo);
            $SubCategorie->update([
                'photo'=>$photopath
            ]);
          }
          return redirect()->route('admin.sub_categories')->with(['success'=>'تم حفظ التعديلات بنجاح']);

       }catch(Exception $ex){
           return redirect()->route('admin.sub_categories')->with(['errors'=>'هناك خطا فى التعديل']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories=SubCategories::find($id);
        if (!$categories)
            return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود ']);

            $image=Str::after($categories->photo,'storage');
            $image=base_path('storage'.$image);
            unlink($image);

            $categories->subCategories()->delete();
            $categories->delete();
        return redirect()->route('admin.main_categories')->with(["success"=>"تم حذف القسم بنجاح"]);

    }


    public function changestatue($id){

        $categories=SubCategories::find($id);
        if (!$categories)
            return redirect()->route('admin.sub_categories')->with(['error' => 'هذا القسم غير موجود ']);

        $statue=$categories->active == 0 ? 1 : 0;
        $categories->update(['active'=>$statue]);

        return redirect()->route('admin.sub_categories')->with(["success"=>"تم تعديل الحاله بنجاح"]);
    }
}
