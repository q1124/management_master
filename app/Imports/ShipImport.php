<?php

namespace App\Imports;

use App\Models\Ship;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ShipImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ship([
            'transport_id' => $row[0],
            'tw_no' => $row[1],
            'weight' => $row[2],
            'price_buy' => $row[3],
            'price_ship' => $row[4],
            'price_total' => $row[5],
            'user_id' => (int)str_replace('CM', '', $row[6])
//            'c_date' => Date::excelToDateTimeObject($row['c_date']),
//            'amount' => $row['amount'],
//            'rate' => $row['rate'],
//            'jpy' => $row['jpy'],
//            'note' => $row['note'],
//            'user_id' => $row['user_id']
        ]);
    }

//    public function headingRow(): int
//    {
//        return 2;
//    }
    public function startRow(): int
    {
        return 2;
    }
}
