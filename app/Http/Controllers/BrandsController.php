<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brands;
use App\Models\Language;
use App\Models\Vendors;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defultlang= getdefultlang();
        //    dd($defultlang);
        $brands = Brands::with('vendor')->where("translation_lang",$defultlang)->get();
        return view('admin.brands.index',compact('brands'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        try{
            DB::beginTransaction();
            $collection=collect($request->brand);
            $id=Auth::guard('admin')->user()->id;
            $defultbrand=$collection->filter(function($val,$key){
               return $val['abbr'] == getdefultlang();
               });
               if($request->has('photo'))
               $photopath=uploadphoto('brands',$request->photo);
                $arrayofdefcat= array_values($defultbrand->all())[0];
                $defultbrandid = Brands::insertGetId([
               'translation_lang'=>$arrayofdefcat['abbr'],
               'translation_of'=>0,
               'name'=>$arrayofdefcat['name'],
               'vendor_id'=>$id,
               'photo'=>$photopath //storage/app/public/images/brands
            ]);
            $restbrands=$collection->filter(function($val,$key){
               return $val['abbr'] != getdefultlang();
            });
            $brandsarray =[];
            if(isset($restbrands) && $restbrands->count()){
               foreach($restbrands as $restbrand){
                  $brandsarray []=[
                     'translation_lang'=>$restbrand['abbr'],
                     'translation_of'=>$defultbrandid ,
                     'name'=>$restbrand['name'],
                     'vendor_id'=>$id,
                     'photo'=>$photopath
                  ];
               }
               Brands::insert($brandsarray);
            }
            DB::commit();
            return redirect()->route('brands.index')->with(['success'=>'تم حفظ القسم بنجاح']);
         }catch(Exception $ex){
             return $ex;
            DB::rollBack();
            return redirect()->route('brands.index')->with(['errors'=>'حدث خطا برجاء المحاوله مرة اخرى']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brand)
    {
        if(!$brand)
        return redirect()->route('brands.index')->with(["errors"=>"هذه الماركة غير موجودة"]);
        $vendors=Vendors::all();
        return view('admin.brands.edite',compact('brand','vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brands $brand)
    {
        if(!$brand)
        return redirect()->route('brands.index')->with(["errors"=>"هذه الماركة غير موجودة"]);
        $brand->update([
            'name'=> $request->brand[0]['name'],
            'translation_lang'=>$request->brand[0]['abbr'],
            'vendor_id'=> $request->brand[0]['vendor_id']
        ]);
        if($request->has('photo')){
            $photopath=uploadphoto('maincategories',$request->photo);
            $brand->update([
                'photo'=>$photopath
            ]);
          }
        return redirect()->route('brands.index')->with(["success"=>"تم التعديل بنجاح"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brands $brand)
    {
        $brand->brands()->delete();
        $brand->delete();
        return redirect()->route('brands.index')->with(["success"=>"تم حذف القسم بنجاح"]);
    }
}
