<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDeliver;
use App\Models\Form;
use App\Models\MainSettings\District;
use App\Models\MainSettings\GhtkDeliverSetting;
use App\Models\MainSettings\Province;
use App\Models\MainSettings\Street;
use App\Models\MainSettings\Themes;
use App\Models\MainSettings\Ward;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $form = Form::all()->sortByDesc('id');
       
        return view('admin.form.index',compact('form'));
    }
    public function cartIndex()
    {
        $bills = Bill::orderByDesc('created_at')->paginate(10);
        return view('admin.form.cart',compact('bills'));
    }

    public function showGHTK()
    {
        return view('admin.form.show.index');
    }
    public function store(Request $request)
    {
        Form::create($request->all());
        return back()->with('success','Gửi thành công !');
    }

    public function printBill($id)
    {
        $bill = Bill::FindOrFail($id);
        $themes = Themes::first();
        return view('admin.form.print',compact('bill','themes'));
    }

    public function checkTransferGHTK(Request $request,$id)
    {
        $my_shop = GhtkDeliverSetting::first();
        $bill = Bill::FindOrFail($id);
        $carts = $bill->Carts;
        $total = 0;

        foreach ($carts as $cart) {
            $sub_total = 0;
            if ($cart->CartProductOptions->count() > 0)
            {
                foreach ($cart->CartProductOptions as $option)
                {
                    $sub_total +=$option->price;
                }
            }    
            $sub_total +=$cart->newprice*$cart->qty;
            $total += $sub_total;                     
        }

        $provice = Province::FindOrFail($request->province)->name;
        $district = District::FindOrFail($request->district)->name;
        
        $data = [
            "pick_province" => $my_shop->pick_province,
            "pick_district" => $my_shop->pick_district,
            "province" => $provice,
            "district" => $district,
            "address" => $bill->address,
            "weight" => $carts->sum("weight"),
            "value" => $request->total,
            "transport" => $request->transfer_type ? $request->transfer_type : "road",
            "deliver_option" => "xteam",
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 070fedab620154ef8d9B83176caA635c8435548b",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        
        return response()->json($response, 200);
    }

    public function checkXfast(Request $request,$id)
    {
        $my_shop = GhtkDeliverSetting::first();
        $bill = Bill::FindOrFail($id);

        $pick_province = $my_shop->pick_province;
        $pick_district = $my_shop->pick_district;
        $pick_ward = Ward::FindOrFail($my_shop->pick_ward)->_name;

        $province = Province::FindOrFail($request->province)->name;
        $district = District::FindOrFail($request->district)->name;
        $ward = Ward::FindOrFail($request->ward)->_name;
        

        $xfast_data = array(
            "customer_district" => $district,
            "customer_province" => $province,
            "customer_ward" => $ward,
            "customer_first_address" => $bill->address,
            "pick_province" => $pick_province,
            "pick_district" => $pick_district,
            "pick_ward"     => $pick_ward
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/x-team?" . http_build_query($xfast_data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 070fedab620154ef8d9B83176caA635c8435548b",
            ),
        ));

        $xfast = curl_exec($curl);
        curl_close($curl);
        return response()->json($xfast, 200);
    }
    public function deleteTransferGHTK()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/cancel/S1.17373471",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 070fedab620154ef8d9B83176caA635c8435548b",
            ),
        ));
        $code = json_decode(curl_exec($curl));
        curl_close($curl);
        return response()->json($code,200);
    }

    public function getLabelGHTK ()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/label/S1.8663516",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 070fedab620154ef8d9B83176caA635c8435548b",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

    }   

    public function sendGHTK(Request $request)
    {
        $bill = Bill::FindOrFail(request()->id);
        $my_shop = GhtkDeliverSetting::first();
        
        if ($request->district == null) {
            $province =Province::FindOrFail($bill->province);
            $district = District::FindOrFail($bill->district);
            
        }else{
            $province =Province::FindOrFail($request->province);
            $district = District::FindOrFail($request->district);
        }
        if ($request->ward == null) {
            $ward = Ward::FindOrFail($bill->ward);
        }else{
            $ward = Ward::FindOrFail($request->ward);
        }
        // dd($request->all());
        $carts = $bill->Carts;
        $products_array = [];
        $products_count = 0 ;
        foreach ($carts as $key => $cart) {
            $products_array[$products_count]['name'] = $cart->name;
            $products_array[$products_count]['weight'] = $cart->weight;
            $products_array[$products_count]['quantity'] = $cart->qty;
            $products_array[$products_count]['product_code'] = $cart->code == "0" ? $cart->id : $cart->code;
            $products_count ++;
        }
        $products =($products_array);
        // dd($products);

        
        $total = 0;
        foreach ($carts as $cart) {
            $sub_total = 0;
            if ($cart->CartProductOptions->count() > 0)
            {
                foreach ($cart->CartProductOptions as $option)
                {
                    $sub_total +=$option->price;
                }
            }    
            $sub_total +=$cart->newprice*$cart->qty;
            $total += $sub_total;                     
        }
        $data_transfer = [
            "pick_province" => $my_shop->pick_province ,
            "pick_district" => $my_shop->pick_district ,
            "province" => $province->name,
            "district" => $district->name,
            "address" => $bill->address,
            "weight" => $carts->sum('weight'),
            "value" => $total,
            "transport" => "road",
            "deliver_option" => "xteam",
            "tags" => $request->is_broke == "1" ? [1] : ""
        ];
        // dd($data_transfer);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data_transfer),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 070fedab620154ef8d9B83176caA635c8435548b",
            ),
        ));
        $pick_money_json = curl_exec($curl);
        curl_close($curl);
        if (json_decode($pick_money_json)->success == false) {
            return back()->with('danger',json_decode($pick_money_json)->message);
        }
        $pick_money = json_decode($pick_money_json);
        // dd($pick_money);
        $order_data = [
            "id" => "a".$pick_money->fee->a,
            "pick_name" => $my_shop->pick_name,
            "pick_address" => $my_shop->pick_address,
            "pick_province" => $my_shop->pick_province,
            "pick_district" => $my_shop->pick_district,
            "pick_ward" => $my_shop->pick_ward,
            "pick_tel" => $my_shop->pick_tel,
            "tel" => $request->tel,
            "name" => $request->name,
            "address" => $request->address,
            "province" => $province->name,
            "district" => $district->name,
            "ward" => $ward->_name,
            "hamlet" => "Khác",
            "is_freeship" => $request->is_freeship,
            "pick_money" =>$pick_money->fee->fee,
            "note" => $request->note,implode(", ",$request->more_note),
            "value" => $request->total_price,
            "transport"=>$request->transport,
            "pick_option" =>$request->pick_option,
            "deliver_option" =>"xteam",
            "tags" => $request->is_broke == "1" ? [1] : ""
        ];
        $json_order_data = json_encode(["products"=>$products,"order"=>$order_data]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $json_order_data,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "token: 070fedab620154ef8d9B83176caA635c8435548b"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if (json_decode($response)->success == 'false') {
            return back()->with('danger',json_decode($response)->message);
        }
        $xfast_data = array(
            "customer_district" => $district->name,
            "customer_province" => $province->name,
            "customer_ward" => $ward->_name,
            "customer_first_address" => $bill->address,
            "pick_province" => $my_shop->pick_province,
            "pick_district" => $my_shop->pick_district,
            "pick_ward"     => $my_shop->pick_ward
        );
        // dd($xfast_data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/x-team?" . http_build_query($xfast_data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 070fedab620154ef8d9B83176caA635c8435548b",
            ),
        ));

        $xfast = curl_exec($curl);
        curl_close($curl);
        if (json_decode($xfast)->success == 'false') {
            return back()->with('danger',json_decode($response)->message);
        }
        if (json_decode($response)->success == false) {
            return back()->with("danger",json_decode($response)->message);
        }
        else{
            $array = json_decode($response);
            $data = [
                "bill_id" => $request->id(),
                "partner_id" =>$array->partner_id,
                "label" => $array->label,
                "area" => $array->area,
                "fee" => $array->fee,
                "insurance_fee" => $array->insurance_fee,
                "estimated_pick_time" => $array->estimated_pick_time,
                "estimated_deliver_time" => $array->estimated_deliver_time,
                "products" => $array->products,
                "status_id" => $array->status_id
            ];
            BillDeliver::create($data);
            return back()->with("success","Thành công !");
        }
    }
}
