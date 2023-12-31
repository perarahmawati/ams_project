<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function dataTable(){
        return $this->hasMany(DataTable::class, 'configuration_status_name');
    }
}
