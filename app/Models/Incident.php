<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'device_id',
        'assigned_user_id',
        'type',
        'status',
        'priority',
        'description',
        'created_by',
    ];

     // Una incidencia pertenece a un dispositivo
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    // Una incidencia está asignada a un usuario (operador)
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    // Una incidencia tiene muchos registros de historial
    public function histories()
    {
        return $this->hasMany(IncidentHistory::class, 'incident_id');
    }

    //metodo para status que ya tiene predefinidos los estados de la incidencia
        public function scopePending($query)
    {
        return $query->where('status', 'pendiente');
    }

    public function scopeInProcess($query)
    {
        return $query->where('status', 'en proceso');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resuelto');
    }

    // Quién creó la incidencia
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope para incidencias activas
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pendiente', 'en proceso']);
    }
}
