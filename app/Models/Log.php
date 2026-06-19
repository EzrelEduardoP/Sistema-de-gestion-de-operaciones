<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    // Un log pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope para filtrar por acción
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    // Scope para filtrar por usuario
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope para logs recientes
    public function scopeRecent($query, $hours = 24)
    {
        return $query->where('created_at', '>=', now()->subHours($hours));
    }
}
