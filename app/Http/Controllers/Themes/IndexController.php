<?php

namespace App\Http\Controllers\Themes;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Carousel;
use App\Models\Categories;
use App\Models\Form;
use App\Models\MainSettings\Contact;
use App\Models\MainSettings\Province;
use App\Models\Partner;
use App\Models\Posts;
use App\Models\ProductOptionCategories;
use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        $categories = Categories::all();
        $partners = Partner::all();
        $products = Products::all();
        $posts = Posts::where('locate',1)->get();
        return view('themes.index',compact('banner','categories','partners','products','posts'));
    }

    public function view(Request $request,$slug)
    {
        if ($request->type == "flashsale") {
            $products = Products::where('showindex',"1")->get();
            return view('themes.slug.flashsale',compact('products'));
        }
        $categories = Categories::all();
        if($request->type == "0")
        {
            $postCategories = Categories::where('slug',$slug)->where('type',0)->first();
            return view('themes.slug.posts',compact('postCategories','categories'));
        }
        if($request->type == "1")
        {
            $productCategory = Categories::where('slug',$slug)->where('type',1)->first();
            return view('themes.slug.products',compact('productCategory','categories'));
        }
        
    }

    public function show($slug,$name)
    {
        if (Categories::where('slug',$slug)->first() != null) {
            if(Categories::where('slug',$slug)->first()->type == 0)
            {
                $categories = Categories::where('slug',$slug)->first();
                $posts = $categories->posts->where('slug',$name)->first();
                return view('themes.show.posts',compact('categories','posts'));
            }else
    
            if(Categories::where('slug',$slug)->first()->type == 1)
            {
                $categories = Categories::where('slug',$slug)->first();
                $products = $categories->products->where('slug',$name)->first();
                $carousels =Carousel::where('type','product')->where('img_id',$products->id)->first() != null ? explode(',',Carousel::where('type','product')->where('img_id',$products->id)->first()->image) : '';
                $form = Form::where('product_id',$products->id)->get();
                $productsitem = Products::all()->random()->get();
                return view('themes.show.products',compact('categories','products','productsitem','form','carousels'));
            }
        }
        if($slug == "gio-hang") 
        {
            $provice = Province::all();
            $productsitem = Products::all()->random()->take(12)->get();
            return view('themes.cart.index',compact('productsitem','provice'));
        }
        if($slug == "lien-he")
        {
            $contact = Contact::first();
            return view('themes.show.contact',compact('contact'));
        }
    }

    public function form(Request $request)
    {
        Form::create($request->all());
        return back();
    }
}
