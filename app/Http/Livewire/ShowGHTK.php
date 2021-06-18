<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Models\MainSettings\District;
use App\Models\MainSettings\GhtkDeliverSetting;
use App\Models\MainSettings\Province;
use App\Models\MainSettings\Street;
use App\Models\MainSettings\Ward;
use Livewire\Component;

class ShowGHTK extends Component
{
    public $tel,$name,$address;
    public $form_province,$form_district,$form_ward,$form_street;

    public function render()
    {
        $bill = Bill::FindOrFail(request()->id);
        $provice = Province::all();
        $district = $this->form_province ? District::where("province_id",$this->form_province)->get() : "";
        $ward = ($this->form_district) ? (Ward::where("province_id",$this->form_province)->where("district_id",$this->form_district)->get()) : "";
        $street = ($this->form_district) ? Street::where("province_id",$this->form_province)->where("district_id",$this->form_district)->get() : "";

        $my_shop = GhtkDeliverSetting::first();

        if ($this->tel == null) {
            $this->tel = $bill->call;
        }
        if ($this->name == null) {
            $this->name = $bill->name;
        }
        if ($this->address == null) {
            $this->address =$bill->address;
        }

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

        $pick_province = $my_shop->pick_province;
        $pick_district = $my_shop->pick_district;
        $pick_ward = $my_shop->pick_ward;

        $bill_provice = Province::FindOrFail($this->form_province ? $this->form_province : $bill->province)->name;
        $bill_district = District::FindOrFail($this->form_district? $this->form_district : $bill->district)->name;
        $bill_ward = Ward::FindOrFail($this->form_ward ? $this->form_ward : $bill->ward)->_name;

        $data = [
            "pick_province" => $pick_province,
            "pick_district" => $pick_district,
            "province" => $bill_provice,
            "district" => $bill_district,
            "address" => $bill->address,
            "weight" => $carts->sum("weight"),
            "value" => $total,
            "transport" => "road",
            "deliver_option" => "xteam",
            "tags"=> [1]
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
        $price_transfer = json_decode(curl_exec($curl)) ;

        curl_close($curl);
        // dd($price_transfer);
        $xfast_data = array(
            "customer_district" => $bill_district,
            "customer_province" => $bill_provice,
            "customer_ward" => $bill_ward,
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

        $xfast = json_decode(curl_exec($curl));
        curl_close($curl);
        return view('admin.form.show.show-ghtk',compact('bill','provice','my_shop','district','ward','street','price_transfer','xfast'));
    }

}
