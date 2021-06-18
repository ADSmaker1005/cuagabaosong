<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainSettings\GhtkDeliverSetting;
use App\Models\MainSettings\Province;
use Illuminate\Http\Request;

class GhtkController extends Controller
{
    public function index()
    {
        $info = GhtkDeliverSetting::all()->first();
        $provice = Province::all();
        return view('admin.default-deliver.ghtk',compact('info','provice'));
    }

    public function update(Request $request)
    {
        if(GhtkDeliverSetting::first() != null)
        {
            GhtkDeliverSetting::first()->update($request->all());
        }else{
            GhtkDeliverSetting::FirstOrCreate($request->all());
        }
        return redirect()->route('admin.ghtk-option.index')->with('success','Cập nhật thông tin GHTK thành công');
    }
}
