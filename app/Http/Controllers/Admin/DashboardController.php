<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Profile;
use App\Models\Sale;
use App\Models\Wash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user(); // Obtém o usuário autenticado

        // Recupera perfis do usuário logado
        $profiles = $user->profiles;

        return view('admin.pages.home.home', compact('profiles'));
    }
}
