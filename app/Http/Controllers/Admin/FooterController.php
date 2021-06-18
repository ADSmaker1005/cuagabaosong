<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainSettings\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::all()->first();
        return view('admin.footer',compact('footer'));
    }

    public function update(Request $request)
    {
        if(Footer::first() != null)
        {
            Footer::first()->update($request->all());
        }else{
        Footer::firstOrCreate($request->all());
        }
        return redirect()->route('admin.footer.index')->with('success','Cập nhật thành công');
    }
}
