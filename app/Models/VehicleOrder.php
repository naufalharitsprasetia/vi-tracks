<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleOrder extends Model
{
    protected $guarded = ['id'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function approvals()
    {
        return $this->hasMany(Approval::class, 'vehicle_order_id', 'id');
    }
}
