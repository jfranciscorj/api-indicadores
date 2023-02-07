<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestMailController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('mail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        //
        $request->validate([
            'correo' => 'required|email|max:255',
        ]);

        $usuario = Auth::user()->name;

        Mail::to($request->correo)
              ->send(new TestMail($usuario));

        return back()->with('success', "Correo enviado con exito.");
    }
}
