<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::with('products')->where('user_id',Auth::user()->id)->get();
        // return $wishlists;
        return view('front.site.wishlist',compact('wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wishlist=Wishlist::where('name',$request->name)->first();
        if($wishlist)
        return redirect()->route('wishlist.index')->with(['error'=>'تم حفظ القائمه من قبل']);

          if(strlen($request->name)>1){
              Wishlist::create([
                  'name'=>$request->name,
                  'user_id'=>Auth::user()->id
              ]);
          }
        return redirect()->route('wishlist.index')->with(['success'=>'تم حفظ القائمه بنجاح']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->products()->delete();
        $wishlist->delete();
        return redirect()->route('wishlist.index')->with(['success'=>'تم حذف القائمه بنجاح']);

    }

    public function deleteProduct(Wishlist $wishlist,Request $request){
        $temp = $wishlist->products()->where('products_id', $request->product_id)->first();
        if (!$temp) return redirect()->route('wishlist.index')->with(['error'=>'هذا العنصر غير موجود']);

        //remove-product
        $wishlist->products()->detach([$request->product_id]);
        return redirect()->route('wishlist.index')->with(['success'=>'تم حذف المنتج بنجاح']);
    }


    public function addProduct(Request $request,Product $product)
    {
        $wishlist=Wishlist::find($request->wishlist_id);
        //check if exist
        $temp = $wishlist->products()->where('products_id', $request->product_id)->first();
        if ($temp) return redirect()->route('wishlist.index')->with(['error'=>'هذا العنصر موجود']);

        //add-product
        $wishlist->products()->attach([$request->product_id]);
        return redirect()->back()->with(['success'=>'تم اضافه المنتج بنجاح']);
    }

    public function addwithoutwishlist(Request $request,Product $product){
        $wishlist=Wishlist::where('name',$request->name)->first();
        if($wishlist)
        return redirect()->route('wishlist.index')->with(['error'=>'تم حفظ القائمه من قبل']);
        if(strLen($request->name)<1) return redirect()->route('site')->with(['error'=>'ادخل اسم للقائمة الجديدة ']);

        if(strlen($request->name)>1){
           $wishlist = Wishlist::create([
                'name'=>$request->name,
                'user_id'=>Auth::user()->id
            ]);
        }
        $wishlist->products()->attach([$product->id]);
        return redirect()->back()->with(['success'=>'تم اضافه المنتج بنجاح']);
    }
}
