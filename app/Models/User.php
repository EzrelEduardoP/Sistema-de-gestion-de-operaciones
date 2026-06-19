<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //un usuario tiene muchos dispositivos
    public function devices(){
        return $this->hasMany(Device::class, 'client_id');
    }
    //un usuario tiene muchos incidentes asignados
    public function assignedIncidents(){
        return $this->hasMany(Incident::class, 'assigned_user_id');
    }
    //un usuario tiene muchos cambios de historial
    public function incidentsHistory(){
        return $this->hasMany(IncidentHistory::class, 'changed_by');
    }
    //un usuario tiene muchos logs
    public function logs(){
        return $this->hasMany(Log::class, 'user_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
