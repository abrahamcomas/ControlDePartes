<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Auth\Middleware\Authenticate;  
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Registro\RegistroController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\CerrarLoginController;
use App\Http\Controllers\Login\CerrarLoginController2;

use App\Http\Controllers\Email\RContraseniaController;
use App\Http\Controllers\Email\ResetearContraseniaController;
use App\Http\Controllers\Email\RestaurarContController;
use App\Http\Controllers\Email\RestaurarContController2;
use App\Http\Controllers\Sistema\VolverIndexController;
use App\Http\Controllers\Sistema\CambiarContController;
use App\Http\Controllers\Sistema\CambiarContController2;
use App\Http\Controllers\Sistema\CambiarCorreoControler;
use App\Http\Controllers\Sistema\CambiarCorreoController2;
use App\Http\Controllers\MultaVehicular\IngCiudadanoController; 
use App\Http\Controllers\MultaVehicular\IngresoMultaController; 
use App\Http\Livewire\MultaVehicular\AgregarMulta; 
use App\Http\Controllers\ReportesPDF\ReportesPDFInspector;
use App\Http\Controllers\ReportesPDF\ReportePDFJuzgado;
use App\Http\Controllers\ReportesPDF\ReporteFechaJuzgado;

use App\Http\Controllers\DataTable\MultasPendientesInsp;

use App\Http\Controllers\MultaPDF\MultaPDF;
use App\Http\Controllers\MultaPDF\MultaPDFSoloID;


use App\Http\Controllers\FirmaDigital\FirmarDocumentoController;
use App\Http\Controllers\FirmaDigital\FirmaPDFGenerado;
use App\Http\Controllers\FirmaDigital\PDFtxtController;

use App\Http\Controllers\Sessiones\SessionesController;
use App\Http\Controllers\Sessiones\EliminarVinculo;
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { 
    return view('Login/Login');
})->name('Index'); 

//VOLVER A PRINCIPAL SI NO ESTA AUTENTICADO
Route::get('Sistema', function (){ 
    return view('Login/Login');
})->name('LoginVolver'); 

//Volver Index
Route::get('SistemaPrincipal', [VolverIndexController::class, 'index'])->middleware('auth')->name('VolverIndex');


//PAGINA PRINCIPAL LOGIN 
Route::post('SistemaPartes', [LoginController::class, 'index'])->name('Login'); 
Route::get('SistemaPartes')->middleware('auth'); 











Route::get('SistemaPrincipal2', [VolverIndexController::class, 'index'])->middleware('auth:Funcionario')->name('VolverIndex2');















Route::get('Sistema/Principal', [CerrarLoginController::class, 'NoLogin']);

// REGISTRO
Route::patch('IngresoRegistro', [RegistroController::class, 'index'])->name('Registro');
Route::get('Registro', function () {
    return view('Registro/Registrarse');
})->name('Registrarse');

//CERRAR SESION 
Route::get('CerrarSesion', [CerrarLoginController::class, 'index'])->name('CerrarSesion');
Route::get('CerrarSesion2', [CerrarLoginController2::class, 'index'])->name('CerrarSesion2');




 
//RESTAURAR CONTRASEÑA POR CORREO
Route::patch('Restaurar', [RestaurarContController::class, 'index'])->name('Restaurar');
Route::patch('Restaurar2', [RestaurarContController2::class, 'index'])->name('Restaurar2');
Route::post('Login/RecuperarContrasenia', [RContraseniaController::class, 'index'])->name('ContraseniaEnviada');
Route::get('ResetearContrasenia', [ResetearContraseniaController::class, 'index'])->name('RestaurarC');
Route::get('RecuperarContrasenia', function (){ 
    return view('Email/RecuperarContrasenia');
})->name('Recuperar');  
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////SISTEMA PRINCIPAL LOGIN//////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


















Route::post('Sistema/ConfirmarCambioContrasenia', [CambiarContController::class, 'index'])->name('FormContrasenia');

//Cambiar Contrasenia Funcionarios
Route::get('Sistema/ConfirmarCambioContraseniaF', function () {
    return view('Sistema/CambiarContrasenia/CambiarContraseniaFun'); 
})->middleware('auth:Funcionario')->name('CambiarContrasenia2'); 

Route::post('Sistema/ConfirmarCambioContraseniaF', [CambiarContController2::class, 'index'])->name('FormContrasenia2');





 











Route::post('Sistema/CambiarCorreo1', [CambiarCorreoControler::class, 'index'])->name('FormCorreo');

//Cambiar Correo Funcionario
Route::get('Sistema/CambiarCorreo2', function () {
    return view('Sistema/CambiarCorreo/CambiarCorreo2'); 
})->middleware('auth:Funcionario')->name('CambiarCorreo2'); 
  
Route::post('Sistema/CambiarCorreo2', [CambiarCorreoController2::class, 'index'])->name('FormCorreo2');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Ingreso Multa Vehicular/////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////








Route::post('/IngresoMulta', [IngresoMultaController::class, 'index'])->name('IngresoMulta');
// Route::post('/Ing', [IngCiudadanoController::class, 'index'])->middleware('auth')->name('AgregarMultas2'); 
 
 

Route::get('/post', AgregarMulta::class)->name('MultaVehicular')->middleware('auth');

























Route::view('/ListaDeMultasJuzgado', 'Posts/MultaVehicular/PostsJuzIngresoMulta')->middleware('auth:Funcionario')->name('JuzListaDeMultas'); 
Route::view('/ListaDeMultasJuzgadoIngresadas', 'Posts/MultaVehicular/PostsJustMultasIngr')->middleware('auth:Funcionario')->name('JuzMultasIngr'); 


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Mantenedores////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


 


















Route::view('/EditarVehiculo','Posts/Mantenedores/PostsEditarVehiculo')->middleware('auth')->name('EditarVehiculo'); 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Mantenedores////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////REPORTES PDF////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/ReportePDF', [ReportesPDFInspector::class, 'index'])->middleware('auth')->name('ReportePDFIns');






Route::get('/ReportePDFJuzgado', [ReportePDFJuzgado::class, 'index'])->middleware('auth:Funcionario')->name('ReportePdfJuzgado');
Route::get('/ReportePDFfIRMA', [ReportePDFJuzgado::class, 'index'])->middleware('auth')->name('ReportePdfJuzgado');















Route::view('/ReporteJuzgado','Posts/Reportes/PostsReporteJuzgado')->middleware('auth:Funcionario')->name('JuzReportes');  

Route::get('/ReportePDFJuzgadoFechas', [ReporteFechaJuzgado::class, 'index'])->middleware('auth:Funcionario')->name('ReportePDFJuz');




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////DATA TABLES////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/DataMultas', [MultasPendientesInsp::class, 'index'])->middleware('auth')->name('DataMul');

Route::post('/Multa', [MultaPDF::class, 'index'])->middleware('auth')->name('MultaPDF');

Route::post('/MultaPDF', [MultaPDFSoloID::class, 'index'])->middleware('auth')->name('MultaPDFSoloID');  



 
 

//FIRMAR DOCUMENTO

//Cambiar Correo Funcionario


Route::get('FirmarDocumento2', function () {
    return view('FirmarDocumento/FirmarDocumento');  
})->middleware('auth')->name('FirmarDocumento2'); 


Route::post('/IngresoFirma', [FirmarDocumentoController::class, 'index'])->middleware('auth')->name('IngresoFirma'); 


Route::post('/ConfirmarFirmaphp', [FirmaPDFGenerado::class, 'index'])->middleware('auth')->name('ConfirmarFirma'); 















Route::post('/MostrarMultaPDF', [PDFtxtController::class, 'index'])->middleware('auth')->name('MostrarMultaPDF');  


Route::post('/Sessiones', [SessionesController::class, 'index'])->middleware('auth')->name('Sessiones');  
Route::get('/Sessiones')->middleware('auth');  


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////APP NAVAR///////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//INSPECTORES 

//Devuelve la vista para ingresar el ciudadano
// Route::view('/IngresarMultaCiudadano', 'Posts/MultaVehicular/PostsAgregarCiudadano')->middleware('auth')->name('MultaVehicularCiudadano');  
Route::get('/IngresarMultaCiudadano', function () { 
    return view('Posts/MultaVehicular/PostsAgregarCiudadano');
})->middleware('auth');
Route::post('/IngresarMultaCiudadano', function () { 
    return view('Posts/MultaVehicular/PostsAgregarCiudadano');
})->middleware('auth')->name('MultaVehicularCiudadano');
 
Route::get('/FirmarDocumento', function () {
    return view('Posts/FirmarDocumento/FirmaDocumento'); 
})->middleware('auth'); 
Route::post('/FirmarDocumento', function () {
    $checksum = session('checksum');
    Session::forget('checksum');
    return view('Posts/FirmarDocumento/FirmaDocumento'); 
})->middleware('auth')->name('FirmarDocumento'); 

//Route::view('ListaDeMultas', 'Posts/MultaVehicular/PostsListaDeMultas')->middleware('auth')->name('ListaDeMultas'); 
Route::get('/ListaDeMultas', function () { 
    return view('Posts/MultaVehicular/PostsListaDeMultas');
})->middleware('auth');
Route::post('/ListaDeMultas', function () { 
    return view('Posts/MultaVehicular/PostsListaDeMultas');
})->middleware('auth')->name('ListaDeMultas');

//Route::view('ListaDeMultasIngresadas', 'Posts/MultaVehicular/PostsMultasIngresadas')->middleware('auth')->name('ListaMultasIngresadas'); 
Route::get('/ListaDeMultasIngresadas', function () { 
    return view('Posts/MultaVehicular/PostsMultasIngresadas');
})->middleware('auth');
Route::post('/ListaDeMultasIngresadas', function () { 
    return view('Posts/MultaVehicular/PostsMultasIngresadas');
})->middleware('auth')->name('ListaMultasIngresadas');
 
//Route::view('/SacarReporte','Posts/Reportes/PostsReportes')->middleware('auth')->name('SacarReporte'); 
Route::get('/SacarReporte', function () { 
    return view('Posts/Reportes/PostsReportes');
})->middleware('auth'); 
Route::post('/SacarReporte', function () { 
    return view('Posts/Reportes/PostsReportes');
})->middleware('auth')->name('SacarReporte'); 

//Route::view('/EditarCiudadano','Posts/Mantenedores/PostsEditarCiudadano')->middleware('auth')->name('EditarCiudadano'); 
Route::get('/EditarCiudadano', function () { 
    return view('Posts/Mantenedores/PostsEditarCiudadano');
})->middleware('auth');
Route::post('/EditarCiudadano', function () { 
    return view('Posts/Mantenedores/PostsEditarCiudadano');
})->middleware('auth')->name('EditarCiudadano');

//Route::view('/TipoInfraccion','Posts/Mantenedores/PostsInfracciones')->middleware('auth')->name('AgregarTiposInfra'); 
Route::get('/TipoInfraccion', function () { 
    return view('Posts/Mantenedores/PostsInfracciones');
})->middleware('auth');
Route::post('/TipoInfraccion', function () { 
    return view('Posts/Mantenedores/PostsInfracciones');
})->middleware('auth')->name('AgregarTiposInfra');

//Route::view('/AgregarArticulo','Posts/Mantenedores/PostsArticulos')->middleware('auth')->name('AgregarArticulo'); 
Route::get('/AgregarArticulo', function () { 
    return view('Posts/Mantenedores/PostsArticulos');
})->middleware('auth'); 
Route::post('/AgregarArticulo', function () { 
    return view('Posts/Mantenedores/PostsArticulos');
})->middleware('auth')->name('AgregarArticulo'); 

Route::get('/Sistema/CambiarCorreo', function () {
    return view('Sistema/CambiarCorreo/CambiarCorreo'); 
})->middleware('auth'); 
Route::post('/Sistema/CambiarCorreo', function () {
    return view('Sistema/CambiarCorreo/CambiarCorreo'); 
})->middleware('auth')->name('CambiarCorreo'); 

Route::get('/Sistema/ConfirmarCambioContrasenia', function () {
    return view('Sistema/CambiarContrasenia/CambiarContrasenia'); 
})->middleware('auth'); 
Route::post('/Sistema/ConfirmarCambioContrasenia', function () {
    return view('Sistema/CambiarContrasenia/CambiarContrasenia'); 
})->middleware('auth')->name('CambiarContrasenia');  


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////MULTAS///////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::post('/IngresoDatosCiudadano', [IngCiudadanoController::class, 'index'])->name('IngresoCiudadano'); 
Route::view('/IngresoDatosCiudadano', 'Posts/MultaVehicular/PostsAgregarMulta')->middleware('auth'); 

Route::post('/EliminarVinculo', [EliminarVinculo::class, 'index'])->name('EliminarVinculo'); 

