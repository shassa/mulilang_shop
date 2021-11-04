<?php

namespace App\Http\Controllers;

use App\Events\AddProduct;
use App\Http\Requests\ProductRequest;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        $products = Product::where("translation_lang",$defultlang)->get();
        return view('admin.product.index',compact('products'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $defultlang= getdefultlang();
        $brands=Brands::where('vendor_id',Auth::guard('admin')->user()->id)->get();
        $stores=Store::where('vendor_id',Auth::guard('admin')->user()->id)->get();
        return view('admin.product.create',compact('brands','stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            $sq_code=random_int(0,60000);
            DB::beginTransaction();
            $collection=collect($request->product);
            $defultbrand=$collection->filter(function($val,$key){
               return $val['abbr'] == getdefultlang();
               });
               if($request->has('photo'))
               $photopath=uploadphoto('products',$request->photo);
                $arrayofdefcat= array_values($defultbrand->all());
                // return $arrayofdefcat;
                $defultbrandid = Product::insertGetId([
               'translation_lang'=>$arrayofdefcat[0]['abbr'],
               'translation_of'=>0,
               'name'=>$arrayofdefcat[0]['name'],
               'price'=>$arrayofdefcat[0]['price'],
               'brand_id'=>$arrayofdefcat[0]['brand_id'],
               'photo'=>$photopath ,
               'sq_code'=>$sq_code
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
                     'price'=>$restbrand['price'],
                     'brand_id'=>$restbrand['brand_id'],
                     'photo'=>$photopath,
                     'sq_code'=>$sq_code

                  ];
               }
               $product=Product::insert($brandsarray);
               if($product && $request->has('quantity')){
                 Product::where('id',$defultbrandid)->first()->stores()->attach($request->store_id,['quantity'=>$request->quantity]);
               }

            }
            event(new AddProduct(Product::where('id',$defultbrandid)->first())); // dispatch event from here
            DB::commit();
            return redirect()->route('products.index')->with(['success'=>'تم حفظ المنتج بنجاح']);
         }catch(Exception $ex){
             return $ex;
            DB::rollBack();
            return redirect()->route('products.index')->with(['errors'=>'حدث خطا برجاء المحاوله مرة اخرى']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(!$product)
        return redirect()->route('products.index')->with(["errors"=>"هذا المنتج غير موجودة"]);
        $brands=Brands::where('vendor_id',Auth::guard('admin')->user()->id)->get();
        $stores=Store::where('vendor_id',Auth::guard('admin')->user()->id)->get();
        return view('admin.product.edit',compact('product','brands','stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,Product $product)
    {
        // try{

            if(!$product)
               return redirect()->route('products.index')->with(['errors'=>'هذا المنتج غير موجود']);
             if($request->has('photo')){
                $photopath=uploadphoto('maincategories',$request->photo);
                $product->update([
                    'photo'=>$photopath
                ]);
              }

            $product->update([
                'name'=> $request->product[0]['name'],
                'price'=> $request->product[0]['price'],
                'translation_lang'=>$request->product[0]['abbr'],
                'brand_id'=> $request->product[0]['brand_id']
            ]);


              return redirect()->route('products.index')->with(['success'=>'تم حفظ التعديلات بنجاح']);

        //    }catch(Exception $ex){
        //        return redirect()->route('products.index')->with(['errors'=>'هناك خطا فى التعديل']);
        //    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(!$product)
        return redirect()->route('products.index')->with(['success'=>'هذا المنتج غير متاح ']);
        $product->products()->delete();
        $product->delete();
        return redirect()->route('products.index')->with(['success'=>'تم حذف المنتج بنجاح']);
    }

    public function updateStore(Product $product,Request $request)
    {
        $product->stores()->updateExistingPivot($request->store_id,['quantity'=>$request->quantity],false);
        return redirect()->route('products.index')->with(['success'=>'تم حفظ التعديلات بنجاح']);

    }
}
