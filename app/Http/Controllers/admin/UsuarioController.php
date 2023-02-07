<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PasswordUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\StoreUser;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.index')->only('index');
        $this->middleware('can:admin.index')->only('show');
        $this->middleware('can:admin.create')->only('create', 'store');
        $this->middleware('can:admin.edit')->only('edit', 'update', 'password');
        $this->middleware('can:admin.edit')->only('desactivar', 'activar');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = collect();

        $users = User::all();

        foreach($users as $user){
            $user->roles = $user->getRoleNames();
            $usuarios->push($user);
        }
 
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('active','1')->get();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        //

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);

        $usuario->active = 1;

        $usuario->save();

        $usuario->roles()->sync($request->rol);
        
        return redirect()->route('usuarios.show', $usuario)->with('success', "Se ha creado el usuario correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $usuario = User::find($id);
        $usuario->roles = $usuario->getRoleNames();

        if(!$usuario){
            abort(404);
        }

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuario = User::find($id);
        
        if(!$usuario){
            abort(404);
        }

        $roles = Role::all();

        return view('usuarios.edit', compact('usuario', 'roles'));
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $usuario)
    {
        //
        $correoActual = $usuario->email;
        $correoNuevo = $request->email;

        if($correoActual != $correoNuevo){
            $existe = User::where('email', $request->email)->count();
            if($existe == 1){
                return back()->with('error', "El correo elecontronico ya se encuentra en uso");
            } 
        } 

        $usuario->roles()->sync($request->rol);
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        $usuario->save();

        return back()->with('success', "Se ha actualizado el usuario correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function desactivar(Request $request, User $usuario){

        $usuario->active = 0;
        $usuario->save();

        return back()->with('success', "Usuario desactivado correctamente");

    }

    public function activar(User $usuario){

        $usuario->active = 1;
        $usuario->save();

        return back()->with('success', "Usuario activado correctamente");

    }

    public function password(User $usuario, PasswordUser $request){

        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return back()->with('success', "Se ha cambiado la clave correctamente");

    }

}
