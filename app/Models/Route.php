<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    // Table name (if different from the pluralized model name)
    protected $table = 'routes';

    // Primary key fields (for composite primary key)
    protected $primaryKey = ['location', 'operation_id', 'rail_id'];

    public $incrementing = false; // Composite keys are not auto-incrementing

    // Fillable fields for mass assignment
    protected $fillable = [
        'location',
        'operation_id',
        'rail_id',
        'arrival_time',
        'elapsed_time',
    ];

    // Cast attributes to specific data types
    protected $casts = [
        'arrival_time' => 'datetime',
        'elapsed_time' => 'integer',
    ];

    // Define the relationship with FreightOperation
    public function freightOperation()
    {
        return $this->belongsTo(FreightOperation::class, 'operation_id');
    }
}
