<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\MainSettings\District;
use App\Models\MainSettings\Province;
use App\Models\MainSettings\Street;
use App\Models\MainSettings\Ward;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function AjaxGetBillById($id)
    {
        $bill = Bill::FindOrFail($id);
        return response()->json($bill, 200);
    }

    public function AjaxGetProvinceId($id)
    {
        $province = Province::FindOrFail($id);
        return response()->json($province, 200);
    }
    
    public function AjaxGetAllProvince()
    {
        $province = Province::all();
        return response()->json($province, 200);
    }

    public function AjaxGetDistrictByprovice($id)
    {
        $district = District::where('province_id',$id)->get();
        return response()->json($district,200);
    }

    public function AjaxGetWardByProvinceDistrict(Request $request)
    {
        $ward = Ward::all()->where('province_id',$request->province)->where('district_id',$request->district);
        return response()->json($ward, 200);
    }

    public function AjaxGetStreetByProvinceDistrict(Request $request)
    {
        $street = Street::where('province_id',$request->province)->where('district_id',$request->district)->get();
        return response()->json($street, 200);
    }
}
