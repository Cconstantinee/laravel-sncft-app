<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locomotive extends Model
{
    use HasFactory;

    protected $table = 'locomotives';

    protected $primaryKey = 'locomotive_id';
    
    protected $fillable = [
        'locomotive_name',
    ];
}
