<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('is_active', true)->get();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:50|unique:drivers',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Driver::create([
            'name' => $request->name,
            'license_number' => $request->license_number,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => true,
        ]);

        return redirect()->route('admin.drivers')->with('success', 'Driver created successfully.');
    }
}
