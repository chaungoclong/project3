<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Category extends Model implements Auditable
{
    use HasFactory,
        AuditableTrait;

    protected $fillable = [
        'code',
        'name',
        'parent_id',
        'image',
        'logo',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        return $value === 0 ? 'Disabled' : 'Enabled';
    }
}
