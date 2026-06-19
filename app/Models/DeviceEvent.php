<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceEvent extends Model
{
    protected $fillable = [
        'device_id',
        'type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Un evento tiene un dispositivo
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    // Scope para filtrar eventos por tipo
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope para eventos recientes
    public function scopeRecent($query, $hours = 24)
    {
        return $query->where('created_at', '>=', now()->subHours($hours));
    }
}
