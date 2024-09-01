<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreightOperation extends Model
{
    use HasFactory;

    protected $table = 'freight_operations';

    protected $primaryKey = 'operation_id';

    protected $fillable = [
        'schedule_id',
        'freight_id',
        'train_id',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function train()
    {
        return $this->belongsTo(Train::class, 'train_id');
    }

    public function freight(){
        return $this->hasMany(Freight::class,'operation_id');
    }
    public function route(){
        return $this->hasMany(Route::class,'operation_id');
    }
}
