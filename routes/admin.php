<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\TestMailController;

Route::get('/admin', [HomeController::class, 'index']);
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.setting');
Route::get('/admin/settings/password', [PasswordController::class, 'index'])->name('admin.password');
Route::post('/admin/settings/password', [PasswordController::class, 'password'])->name('settings.password');

Route::get('/indicadores/data', [IndicadorController::class, 'indicadores']);
Route::get('/indicadores/data/{codigoIndicador}', [IndicadorController::class, 'dataIndicador']);
Route::post('/indicadores/{codigoIndicador}/nuevo', [IndicadorController::class, 'nuevo']);
Route::post('/indicadores/{codigoIndicador}', [IndicadorController::class, 'consultaIndicador']);
Route::get('/indicadores/{codigoIndicador}/{id}', [IndicadorController::class, 'detalleIndicador']);
Route::delete('/indicadores/{codigoIndicador}/{id}/delete', [IndicadorController::class, 'destroy']);
Route::resource('/indicadores', IndicadorController::class);

Route::post('/admin/roles/{rol}/activar/', [RoleController::class, "activar"])->name('roles.activar');
Route::post('/admin/roles/{rol}/desactivar', [RoleController::class, "desactivar"])->name('roles.desactivar');
Route::get('/admin/roles/exportar', [ExportController::class, "roles"])->name('export.roles');
Route::resource('/admin/roles', RoleController::class)->names('roles');

Route::get('/admin/usuarios/exportar', [ExportController::class, "usuarios"])->name('export.usuarios');
Route::post('/admin/usuarios/{usuario}/activar/', [UsuarioController::class, "activar"])->name('usuarios.activar');
Route::post('/admin/usuarios/{usuario}/desactivar', [UsuarioController::class, "desactivar"])->name('usuarios.desactivar');
Route::post('/admin/usuarios/{usuario}/password', [UsuarioController::class, "password"])->name('usuarios.password');
Route::resource('/admin/usuarios', UsuarioController::class);

Route::post('/admin/mail/test', [TestMailController::class, "test"])->name('mail.test');
Route::resource('/admin/mail', TestMailController::class);