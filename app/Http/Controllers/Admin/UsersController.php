<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePassword;
use App\Http\Requests\StoreUpdateUser;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $user, $userRepository, $tenant, $profile;

    public function __construct(User $user, UserRepository $userRepository, Profile $profile)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->profile = $profile;
    }

    public function index()
    {
        $users = $this->user::latest()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {

        $profiles = $this->profile->get();

        return view('admin.pages.users.create', compact('profiles'));
    }

    public function store(StoreUpdateUser $request)
    {
        $data = $request->validated();

        $profileIds = $request->input('profiles_ids', []);

        $user = $this->userRepository->createUser($data, $profileIds);

        return redirect()->route('users.index');
    }


    public function show($userId)
    {
        $user = $this->userRepository->getUserById($userId);

        return view('admin.pages.users.show', compact('user'));
    }

    public function edit($id)
    {

        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    public function update(StoreUpdateUser $request, $id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        $user_id = auth()->user()->id;
        if ($user_id == $id) {
            return redirect()->back()->with('error', 'Você não pode se deletar do sistema');
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->user
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('email', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

    public function showChangePasswordForm()
    {
        $user = Auth::user();
        return view('admin.pages.users.change-password', compact('user'));
    }

    public function changePassword(StoreUpdatePassword $request)
    {

        if (Auth::check()) {
            $user = User::find(Auth::id());

            if ($user) {
                $user->password = bcrypt($request->password);
                $user->temporary_password = null;
                $user->must_change_password = false;
                $user->save();

                return redirect()->route('users.index');
            }
        }

        return redirect()->back()->with('error', 'Não foi possível alterar a senha.');
    }

    public function changeTemporaryPassword(User $user)
    {
        $temporaryPassword = Str::random(10);

        $user->temporary_password = $temporaryPassword;
        $user->password = Hash::make($temporaryPassword);
        $user->must_change_password = true;
        $user->save();

        session()->flash('success', 'Senha temporária redefinida com sucesso.');

        return redirect()->route('users.index');
    }
}
