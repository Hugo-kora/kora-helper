<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tenant extends Model
{

    use HasFactory,HasUuids;

    protected $fillable = [
         'name','url', 'logo', 'active'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
