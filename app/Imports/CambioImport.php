<?php

namespace App\Imports;

use App\Models\Cambio;
use Maatwebsite\Excel\Concerns\ToModel;

class CambioImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cambio([
            $date = intval($row[0]),
            'fecha' => $row[0] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d'),
            'valor' => $row[1]
        ]);
    }
}
