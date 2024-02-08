<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Model
{
    use  HasFactory, HasUuids, SoftDeletes;

    protected $table = 'invites';

    protected $dates = ['deleted_at'];
    protected $fillable = ['email', 'token','profile_id', 'user_id'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'invite_profile');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
