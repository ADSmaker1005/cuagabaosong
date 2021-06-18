<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index ()
    {
        $categories = Categories::all();
        return view('admin.categories.index',compact('categories'));
    }
    public function store(Request $request)
    {
        Categories::create($request->all());
        return redirect()->route('admin.categories.index')->with('success','Tạo banner <<<'.$request->name.'>>> thành công !');
    }

    public function update(Request $request,$id)
    {
        Categories::FindOrFail($id)->update($request->all());
        return redirect()->route('admin.categories.index')->with('warning','Cập nhật thành công !');
    }

    public function updateParent(Request $request,$id)
    {
        Categories::FindOrFail($id)->update($request->all());
        return redirect()->back()->with('warning','Cập nhật thành công !');
    }

    public function destroy($id)
    {
        Categories::FindOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('danger','Deleted !');
    }

    public function inline(Request $request)
    {
        $category =Categories::FindOrFail($request->pk)->update([$request->name => $request->value]);
        return response()->json($category, 200);
    }

    public function sortIndex()
    {
        $categories = Categories::with('childs')->whereNull('parent_id')->get();
        $menu =  Categories::all();
        return view('admin.categories.sort.index',compact('categories','menu'));
    }

    public function sortUpdate(Request $request)
    {
        if($request->has('ids')){
            $arr = explode(',',$request->ids);
            foreach($arr as $sortOrder => $id)
            {
                $category =Categories::FindOrFail($id);
                $category->sort_id = $sortOrder;
                $category->save();
            }
        }
        return ['success'=> true,'warning','Updated'];
    }

    public function ajaxGetById($id)
    {
        $categories = Categories::FindOrFail($id);
        return response()->json($categories, 200);
    }
}
