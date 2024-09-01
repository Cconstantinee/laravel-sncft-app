<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $table = 'trains';

    protected $primaryKey = 'train_id';

    protected $fillable = [
        'train_operator',
        'locomotive_id',
    ];

    public function locomotive()
    {
        return $this->belongsTo(Locomotive::class, 'locomotive_id');
    }
}
