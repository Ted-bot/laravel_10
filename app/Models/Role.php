<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Classes\Role as RoleName;
class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function isAdmin()
    {
        if($this->role->name == RoleName::ADMIN)
        {
            return true;
        }
        return false;
    }
}
