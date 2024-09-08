<?php

namespace App\Http\Controllers;

use App\Models\FreightOperation;
use Illuminate\Http\Request;
use App\Services\FreightOperationFilterService;
class FreightOperationController extends Controller
{
    protected $filterService;

    public function __construct(FreightOperationFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function index(Request $request)
    {
        $filters = $request->all(); // Get filters from request
        $operations = $this->filterService->filter($filters);

        $transformedData = $operations->map(function ($operation) {
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
                'freight' => $operation->freight->pluck('freight_type')->toArray(),
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
