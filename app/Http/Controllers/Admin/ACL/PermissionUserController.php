<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PermissionUserController extends Controller
{
    public function __construct(private User $user)
    { 
    }

    public function syncProfilesOfUser(string $id, Request $request)
    {
        $user = $this->user->find($id);
    
        if (!$user) {
            return Redirect::back()->with('error', 'Userário não encontrado');
        }
    
        $profiles = $request->profiles;
    
        $user->profiles()->sync($profiles);
    
        return view('admin.pages.users.index')->with('message', 'ok');
    }
}
