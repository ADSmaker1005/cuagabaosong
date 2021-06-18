<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index',compact('banners'));
    }

    public function store(Request $request)
    {
        Banner::create($request->all());
        return redirect()->route('admin.banner.index')->with('success','Tạo banner <<<'.$request->name.'>>> thành công !');
    }

    public function update(Request $request,$id)
    {
        Banner::FindOrFail($id)->update($request->all());
        return redirect()->back()->with('warning','Cập nhật thành công !');
    }

    public function destroy($id)
    {
        Banner::FindOrFail($id)->delete();
        return redirect()->back()->with('danger','Deleted !');
    }
    public function inline(Request $request)
    {
        if($request->ajax())
        {
            $banner = Banner::FindOrFail($request->pk)->update([$request->name => $request->value]);
            return response()->json($banner , 200);
        }else
        {
            return redirect()->back()->with('danger','Ajax inline error !');
        }
    }

    public function ajax($id)
    {
        $banner = Banner::FindOrFail($id);
        return response()->json($banner, 200);
    }
}
