<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $primaryKey = 'schedule_id';
    
    protected $fillable = [
        'departure_location',
        'departure_time',
        'arrival_location',
        'arrival_time',
        'status',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];
}
