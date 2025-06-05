<?php

namespace App\Http\Controllers;

use App\Models\TravelRecord;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TravelRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicleFilter = $request->query('vehicle');

        $query = TravelRecord::with('vehicle')->latest();

        if ($vehicleFilter) {
            $query->whereHas('vehicle', function ($q) use ($vehicleFilter) {
                $q->where('license_plate', $vehicleFilter);
            });
        }

        return view('travelrecord', [
            'vehicles' => Vehicle::all(),
            'travelRecords' => $query->paginate(15)->appends($request->query()), // preserve filters in pagination
            'selectedVehicle' => $vehicleFilter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'start_location' => 'required|string|max:255',
            'end_location' => 'required|string|max:255',
            'distance' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        TravelRecord::create($request->all());

        return redirect()->route('travelrecords.index')->with('success', 'Travel record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelRecord $travelRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelRecord $travelRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelRecord $travelRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelRecord $travelRecord)
    {
        //
    }
}
