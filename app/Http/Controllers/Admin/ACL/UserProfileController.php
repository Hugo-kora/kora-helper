<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    protected $profile, $user;

    public function __construct(Profile $profile, User $user)
    {
        $this->profile = $profile;
        $this->user = $user;
        
    }

    public function attachUserProfile(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um perfil');
        }

        $user->profiles()->attach($request->profiles);

        return redirect()->route('users.profiles', $user->id);
    }

    public function users($idUser)
    {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $profiles = $user->profiles()->paginate();

        return view('admin.pages.users.profiles.profiles', compact('profiles', 'user'));
    }

    public function profilesAvailable(Request $request, $idUser)
    {
        $user = $this->user->find($idUser);
    
        if (!$user) {
            return redirect()->back();
        }
    
        $filters = $request->except('_token');
        $profiles = $user->profilesAvailable($request->filter);
    
        return view('admin.pages.users.profiles.available', compact('user', 'profiles', 'filters'));
    }

    public function attachUsersProfile(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if (!$request->users || count($request->users) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $profile->users()->attach($request->users);

        return redirect()->route('profiles.users', $profile->id);
    }

    public function detachUserProfile($idProfile, $idUser)
    {
        $profile = $this->profile->find($idProfile);
        $user = $this->user->find($idUser);
    
        if (!$profile || !$user) {
            return redirect()->back();
        }
    
        $user = $profile->user;
    
        if ($user) {
            Auth::logoutOtherDevices($user->password);
        }
    
        $profile->users()->detach($user);
    
        return redirect()->route('users.profiles', $profile->id);
    }
}
