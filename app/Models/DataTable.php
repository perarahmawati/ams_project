<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTable extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'item_name', 
        'manufacturer_name', 
        'serial_number', 
        'configuration_status_name',
        'location_name',
        'description',
        'position_status_name'
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_name');
    }

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class, 'manufacturer_name');
    }

    public function configurationStatus(){
        return $this->belongsTo(ConfigurationStatus::class, 'configuration_status_name');
    }

    public function location(){
        return $this->belongsTo(Location::class, 'location_name');
    }

    public function positionStatus(){
        return $this->belongsTo(PositionStatus::class, 'position_status_name');
    }
}
