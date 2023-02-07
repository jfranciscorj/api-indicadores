<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.index')->only('index');
        $this->middleware('can:admin.index')->only('show');
        $this->middleware('can:admin.create')->only('create', 'store');
        $this->middleware('can:admin.edit')->only('edit', 'update');
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
        $roles = Role::All();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permisos = Permission::all();

        return view('roles.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'direccion' => 'nullable|max:50'
        ]);

        $rol = Role::create(['name' => $request->name,'direccion' => $request->direccion, 'active' => 1]);

        $rol->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit', $rol)->with('success', 'El rol se creo con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        $rol = $role;
        $permisos = Permission::all();
        return view('roles.show', compact('rol', 'permisos'));
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
        $rol = Role::find($id);
        $permisos = Permission::all();
        return view('roles.edit', compact('rol', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rol = Role::find($id);

        $request->validate([
            'name' => 'required'
        ]);

        $rol->update($request->all());

        $rol->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit', $rol)->with('success', 'El rol se actualizo con éxito');
    }

    public function desactivar($id){

        $rol = Role::find($id);

        if(!$rol){
            abort(404);
        }

        $rol->active = 0;
        $rol->save();

        return back()->with('success', "Se ha desactivado correctamente");

    }

    public function activar($id){

        $rol = Role::find($id);

        if(!$rol){
            abort(404);
        }
        
        $rol->active = 1;
        $rol->save();

        return back()->with('success', "Se ha activado correctamente");

    }
}
