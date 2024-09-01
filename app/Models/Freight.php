<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;

    protected $table = 'freights';

    protected $primaryKey = 'freight_id';
    
    protected $fillable = [
        'freight_name',
        'total_units',
        'total_weight',
        'total_value',
        'operation_id',
        'wagon_id',
    ];
}
