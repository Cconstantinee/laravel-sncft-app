<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet_manager extends Model
{
    use HasFactory;
    protected $table = 'fleet_manager';

    protected $primaryKey = ['rig_id', 'rig_type'];

    public $incrementing = false;

    protected $keyType = 'string';

    
    protected $fillable = [
        'rig_id',
        'rig_type',
        'rig_status',
        'maintenance_status',
        'notes',
    ];

    
    public function locomotive()
    {
        return $this->belongsTo(Locomotive::class, 'rig_id', 'locomotive_id')
                    ->where('rig_type', 'locomotive');
    }

    
    public function wagon()
    {
        return $this->belongsTo(Wagon::class, 'rig_id', 'wagon_id')
                    ->where('rig_type', 'wagon');
    }
}
