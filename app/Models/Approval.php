<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $guarded = ['id'];
    protected $with = ['order'];

    public function order()
    {
        return $this->belongsTo(VehicleOrder::class, 'vehicle_order_id');
    }
}
