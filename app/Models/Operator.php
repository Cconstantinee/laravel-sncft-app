<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $table = 'operators';

    protected $primaryKey = 'operator_id';

    protected $fillable = [
        'operator_first_name',
        'operator_last_name',
    ];
}
