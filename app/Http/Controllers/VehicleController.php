<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('is_active', true)->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        // Validate and store the vehicle data
        $request->validate([
            'plate_number' => 'required|string|max:20|unique:vehicles',
            'ownership' => 'required|in:MILIK,SEWA',
            'vehicle_type' => 'required|in:ANGKUTAN_ORANG,ANGKUTAN_BARANG',
            'fuel_type' => 'nullable|string|max:20',
            'brand' => 'required|string|max:50',
        ]);

        Vehicle::create([
            'plate_number' => $request->plate_number,
            'ownership' => $request->ownership,
            'vehicle_type' => $request->vehicle_type,
            'fuel_type' => $request->fuel_type,
            'brand' => $request->brand,
            'is_active' => true,
        ]);

        // Redirect or return response as needed
        return redirect()->route('admin.vehicles')->with('success', 'Vehicle created successfully.');
    }
}
