<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckData extends Model
{
    use HasFactory;
    protected $fillable = [
        'truck_id',
        'transport_id',
        'plate_top',
        'plate_bottom',
        'truck_type',
        'date_truck_enroll',
        'weight_max',
        'weight_all',
        'truck_insure_expired',
        'truck_tax_expired',
        'truck_product',
        'truck_fuel',
        'status_truck',
    ];
}
