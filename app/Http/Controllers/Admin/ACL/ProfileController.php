<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $profile;
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function attachUsersProfile(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if (!$request->users || count($request->users) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um usuário');
        }

        $profile->users()->attach($request->users);

        return redirect()->route('profiles.users', $profile->id);
    }

    public function index()
    {
        $profiles = $this->profile->latest()->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    public function store(StoreProfileRequest $request)
    {
        $data = $request->all();

        $this->profile->create($data);

        return redirect()->route('profiles.index');
    }

    public function show($id)
    {
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.show', compact('profile'));
    }

    public function edit($id)
    {

        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    public function update(StoreProfileRequest $request, $id)
    {
        if(!$profile = $this->profile->find($id))
        return redirect()->back();

        $data = $request->all();
        $profile->update($data);

        return redirect()->route('profiles.index');
    }

    public function destroy($id)
    {
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }

        $profile->delete();

        return redirect()->route('profiles.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $profiles = $this->profile
        ->where(function ($query) use ($request) {
            if ($request->filter) {
                $filter = '%' . $request->filter . '%';
                $query->where('name', 'like', $filter);
            }
        })
        ->latest()
        ->paginate();

        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
    }
}
