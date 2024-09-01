<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return response()->json($schedule);
    }

    public function store(Request $request)
    {
        $request->validate([
            'departure_location_id' => 'required',
            'departure_time' => 'required|date',
            'arrival_location_id' => 'required',
            'arrival_time' => 'required|date',
            'status' => 'required',
        ]);

        $schedule = Schedule::create($request->all());
        return response()->json($schedule, 201);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());
        return response()->json($schedule);
    }

    public function destroy($id)
    {
        Schedule::destroy($id);
        return response()->json(null, 204);
    }
}
