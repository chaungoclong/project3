<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\User;
use App\Traits\Authorization\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Role extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = [
        'title',
        'name',
        'is_default',
    ];

    // ============= RELATIONSHIP ===============
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function getRoleDefaultAttribute(): ?Role
    {
        return $this->where('is_default', true)->first();
    }
}
