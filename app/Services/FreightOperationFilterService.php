<?php
namespace App\Services;

use App\Models\FreightOperation;
use Illuminate\Support\Carbon;

class FreightOperationFilterService
{
    public function filter($filters)
    {
        $query = FreightOperation::with(['schedule', 'freight']);

        if (!empty($filters['departure_location'])) {
            $query->whereHas('schedule', function ($q) use ($filters) {
                $q->where('departure_location', $filters['departure_location']);
            });
        }

        if (!empty($filters['arrival_location'])) {
            $query->whereHas('schedule', function ($q) use ($filters) {
                $q->where('arrival_location', $filters['arrival_location']);
            });
        }

        if (!empty($filters['freight']) && is_array($filters['freight'])) {
            $query->whereHas('freight', function ($q) use ($filters) {
                $q->whereIn('freight_type', $filters['freight']);
            });
        }

        if (!empty($filters['date'])) {
            $date = Carbon::parse($filters['date']);
            $query->whereHas('schedule', function ($q) use ($date) {
                $q->whereDate('departure_time', $date);
            });
        }

        if (!empty($filters['date_range'])) {
            $startDate = Carbon::parse($filters['date_range']['start']);
            $endDate = Carbon::parse($filters['date_range']['end']);
            $query->whereHas('schedule', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('departure_time', [$startDate, $endDate]);
            });
        }

        return $query->get();
    }
}
