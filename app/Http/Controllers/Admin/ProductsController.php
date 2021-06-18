<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Categories;
use App\Models\ProductOption;
use App\Models\ProductOptionCategories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin.products.index',compact('products'));
    }
    public function create()
    {
        $categories = Categories::where('type',1)->get();
        $optionCategories = ProductOptionCategories::all();
        return view('admin.products.form',compact('categories','optionCategories'));
    }

    public function store(Request $request)
    {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'keywords' => $request->keywords,
                'weight' => $request->weight,
                'name' => $request->name,
                'product_code' => $request->product_code,
                'slug' => $request->slug,
                'locate' => $request->locate,
                'img' => $request->img,
                'oldprice' => $request->oldprice,
                'newprice' => $request->newprice,
                'showindex' => $request->showindex,
                'banner' => $request->banner,
                'text' => $request->text,
                'infoname' => serialize($request->infoname),
                'infotext' => serialize($request->infotext),
                'content' => $request->content
            ];
            $products = Products::create($data);
            $carousel = [
                'type'=>'product',
                'img_id'=>$products->id,
                'image'=>$request->carousel
            ];
            Carousel::create($carousel);
            Products::FindOrFail($products->id)->OptionCategories()->attach($request->options);
            Products::FindOrFail($products->id)->Categories()->attach($request->categories);
            
            return redirect()->route('admin.products.index')->with('success','Thêm bài viết thành công !');
    }

    public function show($id)
    {
        $categories = Categories::where('type',1)->get();
        $products = Products::FindOrFail($id);
        $carousel = Carousel::where('type','product')->where('img_id',$id)->first();
        $optionCategories = ProductOptionCategories::all();
        return view('admin.products.form',compact('products','categories','carousel','optionCategories'));
    }
    public function update(Request $request,$id)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'weight' => $request->weight,
            'name' => $request->name,
            'product_code' => $request->product_code,
            'slug' => $request->slug,
            'locate' => $request->locate,
            'img' => $request->img,
            'oldprice' => $request->oldprice,
            'newprice' => $request->newprice,
            'showindex' => $request->showindex,
            'banner' => $request->banner,
            'text' => $request->text,
            'infoname' => serialize($request->infoname),
            'infotext' => serialize($request->infotext),
            'content' => $request->content
        ];
            Products::FindOrFail($id)->update($data);
            $carousel = Carousel::where('img_id')->where('type','product')->first();
            if ($carousel!=null) {
                Carousel::where('img_id')->where('type','product')->first()->update(['image'=>$request->carousel]);
            }else{
                $carousel = [
                    'type'=>'product',
                    'img_id'=>$id,
                    'image'=>$request->carousel
                ];
                Carousel::create($carousel);
            }
            
            Products::FindOrFail($id)->OptionCategories()->sync($request->options);
            Products::FindOrFail($id)->Categories()->sync($request->categories);
            return redirect()->route('admin.products.index')->with('warning','Cập nhật bài viết thành công !');
    }

    public function destroy($id)
    {
        Products::FindOrFail($id)->Categories()->detach();
        Products::FindOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('danger','Cập nhật bài viết thành công !');
    }

    public function optionCategories()
    {
        $categories = ProductOptionCategories::all();
        return view('admin.products.option-categories',compact('categories'));
    }

    public function optionCategoriesStore(Request $request)
    {
        ProductOptionCategories::create($request->all());
        return back()->with('success','Tạo danh mục chức năng thành công !');
    }

    public function optionCategoriesDelete($id)
    {
        ProductOptionCategories::FindOrFail($id)->delete();
        return back()->with('success','Xóa thành công !');
    }
    public function optionList()
    {
        $categories = ProductOptionCategories::all();
        return view('admin.products.option-list',compact('categories'));
    }

    public function optionStore(Request $request)
    {
        ProductOption::create($request->all());
        return back()->with('success','Tạo thành công');
    }

    public function optionDelete($id)
    {
        ProductOption::FindOrFail($id)->delete();
        return back()->with('danger','Xóa thành công');
    }
}
