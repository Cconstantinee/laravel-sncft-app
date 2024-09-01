<?php

namespace App\Http\Controllers;

use App\Models\FreightOperation;
use Illuminate\Http\Request;

class FreightOperationController extends Controller
{
    public function index()
    {
        $operations = FreightOperation::with(['schedule','freight'])->get();

        // Check if operation exists
        $transformedData = $operations->map(function($operation) {
            return [
                'operationId' => $operation->operation_id,
                'departure' => [
                    'location' => $operation->schedule->departure_location,
                    'time' => $operation->schedule->departure_time->toIso8601String()
                ],
                'arrival' => [
                    'location' => $operation->schedule->arrival_location,
                    'time' => $operation->schedule->arrival_time->toIso8601String()
                ],
                'freight' => $operation->freight->pluck('freight_type')->toArray(), // Collect freight types into an array
                'status' => $operation->status
            ];
        });
    
        return response()->json($transformedData);
    }
//-------------------------------------------------------------------------------------------
    public function show($id)
    {
        // Fetch the operation with related models
        $operation = FreightOperation::with(['schedule','train','freight','route'])->find($id);

        // Check if operation exists
        if (!$operation) {
            return response()->json(['error' => 'Operation not found'], 404);
        }

        // Return the operation data as JSON
        return response()->json($operation);
    }
//-------------------------------------------------------------------------------------------

    
}
