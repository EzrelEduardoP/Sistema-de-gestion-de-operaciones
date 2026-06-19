<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentHistory extends Model
{
    protected $fillable = [
        'incident_id',
        'old_status',
        'new_status',
        'changed_by',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Un registro de historial pertenece a una incidencia
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }

    // Un registro de historial fue hecho por un usuario
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
