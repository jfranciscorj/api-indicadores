<?php

namespace App\Exports;

use App\Models\Roles;
use illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RolesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Roles::all();
    }

    public function view(): View
    {
        return view('exports.roles', [
            'roles' => Roles::all()
        ]);
    }
}