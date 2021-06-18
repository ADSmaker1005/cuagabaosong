<?php

namespace App\Http\Controllers\Themes;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Cart;
use App\Models\MainSettings\Province;
use App\Models\ProductOption;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $provice = Province::all();
        return view('themes.cart.index',compact('provice'));
    }
    public function store(Request $request)
    {
       
        $bill=[
            'name'=>$request->name,
            'call'=>$request->call,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'street' => $request->street,
            'address'=>$request->address
        ];
        $carts =\Cart::content();
        $bill =Bill::create($bill);
        foreach ($carts as $cart) {
            $cart_data =[
                'bill_id'=>$bill->id,
                'qty' => $cart->qty,
                'weight'=>$cart->weight,
                'name'=>$cart->name,
                'img'=>$cart->id->img,
                'newprice'=>$cart->id->newprice
            ];
            $cart_store = Cart::create($cart_data);
            
            if ($cart->options->first() != null) {
                $cart_store->CartProductOptions()->attach($cart->options->first());
            }
        }
        
        \Cart::destroy();
        return redirect()->route('index')->with('success','Đặt hàng thành công !!!');
    }
    public function addCart(Request $request,$id)
    {
        
        $product = Products::FindOrFail($id);
        \Cart::add(['id'=>$product,'name'=>$product->name,'qty' =>$request->quality,'price' =>$product->newprice,'weight'=>$product->weight,'options'=>['option'=> $request->option]]);
        return back()->with('success',$product->name.' Số lượng: '.$request->quality.' thêm thành công !');
    }
    public function buyNow(Request $request,$id)
    {
        $product= Products::FindOrFail($id);
        \Cart::add(['id'=>$product,'name'=>$product->name,'qty' =>$request->quality,'price' =>$product->newprice,'weight'=>$product->weight,'options'=>['option'=> $request->option]]);
        $productsitem = Products::all()->random()->take(12)->get();
        $provice = Province::all();
        return view('themes.cart.index',compact('productsitem','provice'))->with('success','Thêm '.$product->name.' thành công !');
    }

    public function deleteRow(Request $request)
    {
        $productsitem = Products::all()->random()->take(12)->get();
        \Cart::remove($request->rowId);
        $provice = Province::all();
        return view('themes.cart.index',compact('productsitem','provice'))->with('success','Cập nhật giỏ hàng thành công !');
    }
    public function deleteAll()
    {
        \Cart::destroy();
        $provice = Province::all();
        $productsitem = Products::all()->random()->take(12)->get();
        return view('themes.cart.index',compact('productsitem','provice'))->with('success','Đã xóa toàn bộ hàng !');
    }

    public function updateRow(Request $request,$rowId)
    {
        $productsitem = Products::all()->random()->take(12)->get();
        $provice = Province::all();
        \Cart::update($rowId, ['qty' => $request->cartqty]);
        return view('themes.cart.index',compact('productsitem','provice'))->with('success','Cập nhật giỏ hàng thành công !');
    }
}
