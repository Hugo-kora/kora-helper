<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Mail\InviteMail;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class SendInviteController extends Controller
{

    public function showInviteForm( Request $request)
    {

        $token = $request->query('token');
        return view('admin.pages.invite.create', compact('token'));
    }

    public function sendInvite(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'tenant_ids' => 'required|array',
            'profiles_ids' => 'required|array',
        ]);
    
        $token = Str::random(32);
    
        $invite = new Invite();
        $invite->email = $request->input('email');
        $invite->token = $token;
        $invite->save();
    
        // Associar perfis ao convite
        $profile_id = $request->input('profiles_ids');
        $invite->profiles()->attach($profile_id);
    
        $email = $request->input('email');
        Mail::to($email)->send(new InviteMail($token));
    
        return redirect()->back()->with('success', 'O convite foi enviado com sucesso.');
    }
    
    public function acceptInvite(StoreUser $request, $token)
    {
        $data = $request->only(['name', 'cellphoneReal', 'password', 'urlLive', 'nomeInGame', 'surnameInGame', 'cellphoneInGame', 'passaporte']);
        $invite = Invite::where('token', $token)->first();
    
        if (!$invite) {
            return redirect()->route('admin.index')->with('error', 'Convite inválido');
        }

        $profileIds = $invite->profiles->pluck('id')->toArray();
    
        $data['password'] = bcrypt($data['password']);
        $data['email'] = $invite->email;
    
        $user = User::create($data);
    
        // Atualizar a tabela profile_user
        $user->profiles()->attach($profileIds);
    
        // Excluir convite
        $invite->delete();
    
        foreach ($profileIds as $profileId) {
            $invite->profiles()->detach($profileId);
        }
    
        return redirect()->route('admin.index');
    }
    
    
}
