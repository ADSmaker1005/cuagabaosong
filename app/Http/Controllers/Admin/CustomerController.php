<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy("status")
        ->when(request()->search_phone,function($q){
            $q->where("call",'like','%'.request()->search_phone.'%');
        })
        ->paginate(10);
        return view('admin.customer.index',compact('customers'));
    }

    public function store(Request $request)
    {
        Customer::create($request->all());
    }

    public function update(Request $request, $id)
    {
        Customer::FindOrFail($id)->update($request->all());
    }

    public function import(Request $request)
    {
        Customer::truncate();
        Excel::import(new CustomerImport,$request->file('excel'));
        return back()->with('success','Nhập dữ liệu thành công !');
    }
    public function export()
    {
        return Excel::download(new CustomerExport,'export.xlsx');
    }
    public function destroy($id)
    {
        Customer::FindorFail($id)->delete();
        return back()->with('danger','Xóa thành công !');
    }
}
