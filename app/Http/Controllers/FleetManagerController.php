<?php

namespace App\Http\Controllers;
use App\Models\Fleet_manager;
use App\Models\Locomotive;
use App\Models\Wagon;

use Illuminate\Http\Request;

class FleetManagerController extends Controller
{
    public function index()
    {
        $rig = Fleet_manager::all();
        return response()->json($rig);
    }

    // Store a newly created fleet manager in the database
    public function store(Request $request)
    {
        // Method stub
    }

    // Display the specified fleet manager
    public function show($id)
    {
        if (!preg_match('/^[EC][0-9A-Fa-f]+$/', $id)) {
            return response()->json(['message' => 'Invalid ID format'], 400);
        }
        $type = strtoupper($id[0]) === 'E' ? 'locomotive' : 'wagon';
        $numericId = substr($id, 1);

        $rigInfo = Fleet_manager::where('rig_id', $numericId)
                                    ->where('rig_type', $type)
                                    ->first();

        if ($type === 'locomotive') {
            $model = Locomotive::find($numericId);
        } else {
            $model = Wagon::find($numericId);
        }

        if ($model) {
            return response()->json([
                'type' => $type,
                'rigInfo' => $rigInfo,
                'rigData' => $model
            ]);
        }

        return response()->json(['message' => 'Rig not found'], 404);
    }

    // Update the specified fleet manager in the database
    public function update(Request $request, $id)
    {
        // Method stub
    }

    // Remove the specified fleet manager from the database
    public function destroy($id)
    {
        // Method stub
    }
}
