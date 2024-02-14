<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'email', 'password', 'created_by', 'updated_by', 'deleted_by', 'created_by_email', 'updated_by_email', 'deleted_by_email', 'temporary_password']; // Adicionando 'temporary_password' ao $fillable

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->email, config('acl.super_admins'));
    }

    public function profilesAvailable($filter = null)
    {
        $userId = $this->id;

        $profiles = Profile::whereNotIn('profiles.id', function ($query) use ($userId) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id = '{$userId}'");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter) {
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();

        return $profiles;
    }

    public function shouldChangePassword()
    {
        return $this->must_change_password;
    }
}
