<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Events\BeforeImport;

class CustomerImport implements ToModel
{
    public function model(array $row)
    {
        return new Customer([
           'name'     => $row[0],
           'call'    => $row[1],
           'address' => $row[2],
           'bill' => $row[3], 
           'note' => $row[4],
           'date_receive' => $row[5],
           'status_string' => $row[6],
           'source' => $row[7]
        ]);
    }
}
