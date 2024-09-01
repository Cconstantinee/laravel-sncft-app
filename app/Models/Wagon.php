<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wagon extends Model
{
    use HasFactory;

    protected $table = 'wagons';

    protected $primaryKey = 'wagon_id';

    protected $fillable = [
        'train_id',
    ];

    public function train()
    {
        return $this->belongsTo(Train::class, 'train_id');
    }
}
