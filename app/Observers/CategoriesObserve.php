<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoriesObserve
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    public function creating(Category $categories)
    {
        $categories->created_by = $this->user->id;
        $categories->created_by_email = $this->user->email;
    }

    public function updating(Category $categories)
    {
        $categories->updated_by = $this->user->id;
        $categories->url= Str::kebab($this->user['name']);
        $categories->updated_by_email = $this->user->email;
    }

    public function deleting(Category $categories)
    {
        $categories->deleted_by = $this->user->id;
        $categories->deleted_by_email = $this->user->email;
    }
}
