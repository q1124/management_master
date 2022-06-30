<?php

namespace App\Imports;

use App\Models\Deposit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DepositImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Deposit([
            'c_date' => Date::excelToDateTimeObject($row[0]),
            'amount' => $row[1],
            'rate' => $row[2],
            'jpy' => $row[3],
            'note' => $row[4],
            'user_id' => (int)str_replace('CM', '', $row[5])
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
