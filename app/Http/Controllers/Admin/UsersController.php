<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\Profile;
use App\Models\Tenant;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    protected $user, $userRepository,$tenant, $profile;

    public function __construct(User $user, UserRepository $userRepository, Tenant $tenant, Profile $profile)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->tenant = $tenant;
        $this->profile = $profile;

    }

    public function index()
    {
        $users = User::latest()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {

        $profiles = $this->profile->get();

        return view('admin.pages.users.invite',compact('profiles'));
    }

    public function store(StoreUpdateUser $request)
    {
        $data = $request->only(['name', 'cellphoneReal', 'email', 'urlLive', 'nomeInGame', 'surnameInGame', 'cellphoneInGame', 'passaporte', 'foto']);

        $this->userRepository->createUser($data);

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

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

        if($request->foto){
            if(Storage::exists($user->foto)){
                Storage::delete($user->foto);
            }
            $data['foto'] = $request->foto->store('users');
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
            return redirect()->back()->with('error', 'Você quer mesmo se deletar do sistema? HA HA HA HA');
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->user
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('nomeInGame', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('email', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

    public function resetPassword($id){
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->back();
        }
    
        $name = strtolower(str_replace(' ', '', $user->name));
    

        $name = preg_replace('/[áàãâä]/ui', 'a', $name);
        $name = preg_replace('/[éèêë]/ui', 'e', $name);
        $name = preg_replace('/[íìîï]/ui', 'i', $name);
        $name = preg_replace('/[óòõôö]/ui', 'o', $name);
        $name = preg_replace('/[úùûü]/ui', 'u', $name);
        $name = preg_replace('/[ç]/ui', 'c', $name);
    
        $data['password'] = 'lk' . $name . date('Y');
    
        $data['password'] = bcrypt($data['password']);
    
        $user->update($data);
    
        return redirect()->route('users.index');
    }
}
