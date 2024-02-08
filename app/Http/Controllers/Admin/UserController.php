<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private User $user)
    {
        $this->user = $user;
    }

    public function index(User $user){
       $users = $this->user->paginate();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        $tenant_id = auth()->user()->tenant_id;
        return view('admin.pages.user.invite',compact('tenant_id'));
    }

    public function show($id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.user.show', compact('user'));
    }

    public function edit($id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.user.edit', compact('user'));
    }
}
