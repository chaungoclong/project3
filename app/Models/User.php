<?php

namespace App\Models;

use App\Traits\Authorization\HasRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRole,
        AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function isCustomer(): bool
    {
        return (bool) optional($this->role)->isCustomer();
    }

    public function isAdmin(): bool
    {
        return (bool) optional($this->role)->isAdmin();
    }

    public function isEmployee(): bool
    {
        return (bool) optional($this->role)->isEmployee();
    }

    public function isWebGroup(): bool
    {
        return $this->role === null || $this->isCustomer();
    }

    public function isAdminGroup()
    {
        return $this->role !== null && !$this->isCustomer();
    }

    public function isActive(): bool
    {
        return (bool) $this->getRawOriginal('status');
    }
}
