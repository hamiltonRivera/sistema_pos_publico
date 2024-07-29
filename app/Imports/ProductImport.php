<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            $date = intval($row[2]),
            'descripcion' => $row[0],
            'stock' => $row[1],
            'fecha_vencimiento' => $row[2] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d'),
            'precio_compra' =>$row[3],
            'precio_venta_unidad' => $row[4],
            'precio_venta_mayor' => $row[5],
            'category_id' => $row[6],
            'codigo' => $row[7]

        ]);
    }
}
