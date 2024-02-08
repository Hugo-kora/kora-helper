<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnviarConviteRequest;
use App\Mail\InviteMail;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class InviteController extends Controller
{

    public function sendInvite(EnviarConviteRequest $request)
    {
        $data = $request->all();
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
    
}
