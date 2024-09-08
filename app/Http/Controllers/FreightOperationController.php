<?php

namespace App\Http\Controllers;

use App\Models\FreightOperation;
use App\Models\Freight;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Services\FreightOperationFilterService;
use Illuminate\Support\Facades\Log;

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
public function destroy($operation_id)
{
    try {
        $operation = FreightOperation::findOrFail($operation_id);
        if ($operation->schedule_id) {
            Log::info('Deleting associated schedule with id: ' . $operation->schedule_id);
            Schedule::where('schedule_id', $operation->schedule_id)->delete();
        }
        Freight::where('operation_id', $operation_id)->update(['operation_id' => null]);
        Log::info('Deleting operation with id: ' . $operation_id);
        $operation->delete();

        return response()->json(['message' => 'Operation and associated data deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
}
