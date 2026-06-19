<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'status',
        'location',
        'metadata',
        'client_id',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'metadata' => 'array', // Convierte JSON a array de manera automatica
    ];

    // Un dispositivo pertenece a un cliente (para usuario)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Un dispositivo tiene muchos eventos
    public function events()
    {
        return $this->hasMany(DeviceEvent::class, 'device_id');
    }

    // Un dispositivo tiene muchas incidencias
    public function incidents()
    {
        return $this->hasMany(Incident::class, 'device_id');
    }
    //metodo para ayudarme al estatus del dispositivo que ya tiene predefinidos los estados del dispositivo
    public function scopeActive($query)
    {
        return $query->where('status', 'activo');
    }

    public function scopeByClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    // Auditoría: quién creó el dispositivo
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Auditoría: quién modificó por última vez
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
