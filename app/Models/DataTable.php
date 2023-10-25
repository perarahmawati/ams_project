<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTable extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'item_name', 
        'manufacture_name', 
        'serial_number', 
        'configurationstatus_name',
        'location_name',
        'description'
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_name');
    }

    public function manufacture(){
        return $this->belongsTo(Manufacture::class, 'manufacture_name');
    }

    public function configurationStatus(){
        return $this->belongsTo(ConfigurationStatus::class, 'configurationstatus_name');
    }

    public function location(){
        return $this->belongsTo(Location::class, 'location_name');
    }
}
