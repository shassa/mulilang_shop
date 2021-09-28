<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;
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
        $brands = Brands::where("translation_lang",$defultlang)->get();
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
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $collection=collect($request->brand);
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
    public function edit(Brands $brands)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brands $brands)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brands $brands)
    {
        //
    }
}
