<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partner.index',compact('partners'));
    }

    public function store(Request $request)
    {
        Partner::create($request->all());
        return redirect()->route('admin.partner.index')->with('success','Tạo partner <<<'.$request->name.'>>> thành công !');
    }

    public function update(Request $request,$id)
    {
        Partner::FindOrFail($id)->update($request->all());
        return redirect()->route('admin.partner.index')->with('warning','Cập nhật thành công !');
    }

    public function destroy($id)
    {
        Partner::FindOrFail($id)->delete();
        return redirect()->route('admin.partner.index')->with('danger','Deleted !');
    }
    public function inline(Request $request)
    {
        if($request->ajax())
        {
            $partner = Partner::FindOrFail($request->pk)->update([$request->name => $request->value]);
            return response()->json($partner , 200);
        }else
        {
            return redirect()->route('admin.partner.index')->with('danger','Ajax inline error !');
        }
    }

    public function ajax($id)
    {
        $partner = Partner::FindOrFail($id);
        return response()->json($partner, 200);
    }
}
