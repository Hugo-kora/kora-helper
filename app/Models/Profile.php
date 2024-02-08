<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }    
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionsAvailableModel($filter = null)
    {
        $profileId = $this->id;
        
        $permissions = Permission::whereNotIn('permissions.id', function($query) use ($profileId) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id = '{$profileId}'");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
            }
        })
        ->get();
    
        $groupedPermissions = $permissions->groupBy(function ($item) {
            $prefix = explode('.', $item->name)[0];
            return $prefix;
        });
    
        return $groupedPermissions;
    }
    
    
    public function usersAvailable($filter = null)
    {
        $profileId = $this->id;
    
        $users = User::whereNotIn('users.id', function($query) use ($profileId) {
            $query->select('profile_user.user_id');
            $query->from('profile_user');
            $query->whereRaw("profile_user.profile_id = '{$profileId}'");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();
    
        return $users;
    }
}
