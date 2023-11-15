<?php

namespace App\Imports;

use App\Models\DataTable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Item;
use App\Models\Manufacturer;
use App\Models\ConfigurationStatus;
use App\Models\Location;
use App\Models\PositionStatus;

class DataTableImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $item_id = $this->getIdFromName($row['item'], Item::class);
        $manufacturer_id = $this->getIdFromName($row['manufacturer'], Manufacturer::class);
        $configuration_status_id = $this->getIdFromName($row['configuration_status'], ConfigurationStatus::class);
        $location_id = $this->getIdFromName($row['location'], Location::class);
        $position_status_id = $this->getIdFromName($row['position_status'], PositionStatus::class);

        return new DataTable([
            'item_name' => $item_id,
            'manufacturer_name' => $manufacturer_id,
            'serial_number' => $row['serial_number'],
            'configuration_status_name' => $configuration_status_id,
            'location_name' => $location_id,
            'description' => $row['description'],
            'position_status_name' => $position_status_id,
        ]);
    }

    private function getIdFromName($name, $modelClass)
    {
        $model = $modelClass::where('name', $name)->first();
        return $model ? $model->id : null;
    }
}
