<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PasswordUser;
use Hamcrest\Core\HasToString;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuario = User::find(Auth::user()->id);
        $usuario->roles = $usuario->getRoleNames();
        return view('admin.settings', compact('usuario'));
    }

    public function password(User $usuario, PasswordUser $request){

        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return back()->with('success', "Se ha cambiado la clave correctamente");

    }
}
