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
        if (!$operations) {
            return response()->json(['error' => 'Operations not found'], 404);
        }

        // Return the operation data as JSON
        return response()->json($operations);
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
