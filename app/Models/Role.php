<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\User;
use App\Traits\Authorization\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Role extends Model implements Auditable
{
    use HasFactory, HasPermissions, AuditableTrait;

    protected $fillable = [
        'title',
        'name',
        'is_default',
        'is_user_defined',
    ];

    // ============= RELATIONSHIP ===============
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_role',
            'role_id',
            'permission_id'
        );
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    /**
     * lay cac vai tro mac dinh
     * @return [type] [description]
     */
    public function getRoleDefaultAttribute(): ?Role
    {
        return $this->where('is_default', true)->first();
    }

    public function isCannotChange(): bool
    {
        return (bool) !$this->isUserDefined() || $this->isAdmin();
    }

    public function isUserDefined(): bool
    {
        return (bool) $this->is_user_defined;
    }

    public function isDefault(): bool
    {
        return (bool) $this->is_default;
    }

    public function isCanRegister(): bool
    {
        return $this->isCustomer();
    }

    public function isCustomer(): bool
    {
        return $this->name === config('role.customer.name');
    }

    public function isAdmin(): bool
    {
        return $this->name === config('role.admin.name');
    }

    public function isEmployee(): bool
    {
        return $this->name === config('role.employee.name');
    }
}
