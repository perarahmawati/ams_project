<?php

namespace App\Imports;

use App\Models\DataTable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataTableImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataTable([
            'item_name' => $row['item'],
            'manufacture_name' => $row['manufacture'],
            'serial_number' => $row['serial_number'],
            'configuration_status_name' => $row['configuration_status'],
            'location_name' => $row['location'],
            'description' => $row['description'],
        ]);
    }
}
