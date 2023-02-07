<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\RolesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.index');
    }

    public function roles(){
        return Excel::download(new RolesExport, 'roles.xlsx');
    }

    public function usuarios(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
