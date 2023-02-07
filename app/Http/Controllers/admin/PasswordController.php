<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\PasswordUser;

class PasswordController extends Controller
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
        return view('admin.password');
    }

    public function password(PasswordUser $request){

        $usuario = User::find(Auth::user()->id);
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return back()->with('success', "Se ha cambiado la clave correctamente");

    }
}
