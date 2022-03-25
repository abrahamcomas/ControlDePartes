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
use App\Http\Controllers\Sistema\VolverIndexController2;
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
 
//PAGINA LOGIN 
Route::get('/', function () { 
    return view('Login/Login');
})->name('Index'); 

//CERRAR SESION 
Route::get('/CerrarSesion', [CerrarLoginController::class, 'index'])->name('CerrarSesion');
Route::get('/CerrarSesion2', [CerrarLoginController2::class, 'index'])->name('CerrarSesion2');

//PAGINA PRINCIPAL
Route::get('/SistemaPartes',function () { 
    return view('Login/Login');
})->middleware('auth'); 
Route::post('SistemaPartes', [LoginController::class, 'index'])->name('Login'); 

// REGISTRO
Route::patch('/IngresoRegistro', [RegistroController::class, 'index'])->name('Registro');
Route::get('Registro', function () {
    return view('Registro/Registrarse');
})->name('Registrarse');

//RESTAURAR CONTRASEÑA POR CORREO
Route::get('/RecuperarContrasenia', function (){ 
    return view('Email/RecuperarContrasenia');
})->name('Recuperar');  
Route::post('/ContraseniaEnviada', [RContraseniaController::class, 'index'])->name('ContraseniaEnviada');
Route::get('/ResetearContrasenia', [ResetearContraseniaController::class, 'index'])->name('RestaurarC');

//INSPECTORES
Route::patch('/Restaurar', [RestaurarContController::class, 'index'])->name('Restaurar');

//FUNCIONARIO
Route::patch('/Restaurar2', [RestaurarContController2::class, 'index'])->name('Restaurar2');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////CAMBIAR CONTRASEÑA Y CORREO//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Cambiar Contrasenia y correo Inspectores 

//Navar contrasenia y correo inspectores
Route::get('/Sistema/CambioContraseniaInsp',function () { 
    return view('Sistema/CambiarContrasenia/CambiarContrasenia'); 
})->middleware('auth'); 
Route::post('/Sistema/CambioContraseniaInsp', function () {
    return view('Sistema/CambiarContrasenia/CambiarContrasenia'); 
})->middleware('auth')->name('CambiarContrasenia'); 
 
Route::get('/Sistema/CambiarCorreoInsp',function () { 
    return view('Sistema/CambiarCorreo/CambiarCorreo');
})->middleware('auth'); 
Route::post('/Sistema/CambiarCorreoInsp', function () {
    return view('Sistema/CambiarCorreo/CambiarCorreo'); 
})->middleware('auth')->name('CambiarCorreo');

 
//Navar contrasenia y correo funcionario sin control de sesiones
Route::get('Sistema/CambiarCorreoFunc', function () {
    return view('Sistema/CambiarCorreo/CambiarCorreo2'); 
})->middleware('auth:Funcionario')->name('CambiarCorreo2'); 

Route::get('/Sistema/CambioContraseniaFunc', function () {
    return view('Sistema/CambiarContrasenia/CambiarContraseniaFun'); 
})->middleware('auth:Funcionario')->name('CambiarContrasenia2'); 
//Fin Navar 

//Envio formulario post cambio contrasenia inspectores
Route::post('/Sistema/CambiarContrasenia', [CambiarContController::class, 'index'])->middleware('auth')->name('FormContrasenia');
//Envio formulario post cambio correo inspectores
Route::post('/Sistema/CambiarCorreoinsp', [CambiarCorreoControler::class, 'index'])->middleware('auth')->name('FormCorreo');

//Envio formulario post cambio contrasenia funcionarios
Route::post('/Sistema/CambioContraseniaFunc', [CambiarContController2::class, 'index'])->middleware('auth:Funcionario')->name('FormContrasenia2');
//Envio formulario post cambio correo funcionarios
Route::post('/Sistema/CambiarCorreoFunc', [CambiarCorreoController2::class, 'index'])->middleware('auth:Funcionario')->name('FormCorreo2');


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////PDF//////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/ReportePDFFirma', [ReportePDFJuzgado::class, 'index'])->middleware('auth')->name('ReportePdfJuzgadoInsp');

Route::post('/MostrarMultaPDF', [PDFtxtController::class, 'index'])->middleware('auth')->name('MostrarMultaPDF');  
Route::post('/MultaPDFJuzgado', [PDFtxtController::class, 'index'])->middleware('auth:Funcionario')->name('MostrarMultaPDF2');  


Route::get('/ReportePDF', [ReportesPDFInspector::class, 'index'])->middleware('auth')->name('ReportePDFIns');

//Firmar PDF subidos
//Route::post('/IngresoFirma', [FirmarDocumentoController::class, 'index'])->middleware('auth')->name('IngresoFirma'); 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////SISTEMA PRINCIPAL LOGIN//////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Route::post('/IngresoMulta', [IngresoMultaController::class, 'index'])->name('IngresoMulta');
//Route::post('/Multa', [MultaPDF::class, 'index'])->middleware('auth')->name('MultaPDF');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////APP NAVAR///////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//INSPECTORES 

//Multa
Route::get('/IngresarMultaCiudadano',function () { 
    return view('Posts/MultaVehicular/PostsAgregarCiudadano');
})->middleware('auth');
Route::post('/IngresarMultaCiudadano', function () { 
    return view('Posts/MultaVehicular/PostsAgregarCiudadano');
})->middleware('auth')->name('MultaVehicularCiudadano');

Route::get('/IngresoDatosCiudadano', function () { 
    return view('Login/Login');
})->middleware('auth'); 
Route::post('/IngresoDatosCiudadano', [IngCiudadanoController::class, 'index'])->middleware('auth')->name('IngresoCiudadano'); 

//FIRMAR MULTA
Route::get('/FirmarDocumento', function () { 
    return view('Posts/FirmarDocumento/FirmaDocumento'); 
})->middleware('auth'); 
Route::post('/FirmarDocumento', function () {
    $checksum = session('checksum');
    Session::forget('checksum');
    return view('Posts/FirmarDocumento/FirmaDocumento'); 
})->middleware('auth')->name('FirmarDocumento'); 
Route::post('/ConfirmarFirmaphp', [FirmaPDFGenerado::class, 'index'])->middleware('auth')->name('ConfirmarFirma'); 

//LISTA MULTAS 
Route::get('/ListaDeMultas',function () { 
    return view('Login/Login');
})->middleware('auth');
Route::post('/ListaDeMultas', function () { 
    return view('Posts/MultaVehicular/PostsListaDeMultas');
})->middleware('auth')->name('ListaDeMultas');

Route::get('/MultaPDF',function () { 
    return view('Login/Login'); 
})->middleware('auth');  
Route::post('/MultaPDF', [MultaPDFSoloID::class, 'index'])->middleware('auth')->name('MultaPDFSoloID');  

//OPCIONES 

Route::get('/ListaDeMultasIngresadas',function () { 
    return view('Login/Login');
})->middleware('auth');
Route::post('/ListaDeMultasIngresadas', function () { 
    return view('Posts/MultaVehicular/PostsMultasIngresadas');
})->middleware('auth')->name('ListaMultasIngresadas');
 
Route::get('/SacarReporte',function () { 
    return view('Login/Login');
})->middleware('auth'); 
Route::post('/SacarReporte', function () { 
    return view('Posts/Reportes/PostsReportes');
})->middleware('auth')->name('SacarReporte'); 

Route::get('/EditarCiudadano',function () { 
    return view('Login/Login');
})->middleware('auth');
Route::post('/EditarCiudadano', function () { 
    return view('Posts/Mantenedores/PostsEditarCiudadano');
})->middleware('auth')->name('EditarCiudadano');
 
Route::get('/TipoInfraccion',function () { 
    return view('Login/Login');
})->middleware('auth');
Route::post('/TipoInfraccion', function () { 
    return view('Posts/Mantenedores/PostsInfracciones');
})->middleware('auth')->name('AgregarTiposInfra');
 
Route::get('/AgregarArticulo',function () { 
    return view('Login/Login');
})->middleware('auth'); 
Route::post('/AgregarArticulo', function () { 
    return view('Posts/Mantenedores/PostsArticulos');
})->middleware('auth')->name('AgregarArticulo'); 

Route::get('/EliminarVinculo',function () { 
    return view('Login/Login');
})->middleware('auth');
Route::post('/EliminarVinculo', [EliminarVinculo::class, 'index'])->middleware('auth')->name('EliminarVinculo'); 

//SESSIONES
Route::post('/Sessiones', [SessionesController::class, 'index'])->middleware('auth')->name('Sessiones');  
Route::get('/Sessiones',function () { 
    return view('Login/Login');
})->middleware('auth');  

Route::get('/DataMultas', [MultasPendientesInsp::class, 'index'])->middleware('auth')->name('DataMul');

Route::get('/SistemaPrincipal', [VolverIndexController::class, 'index'])->middleware('auth')->name('VolverIndex');  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////JUZGADO///////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/ListaDeMultasJuzgado',function () { 
    
    $ID_Juzgado_T=Auth::guard('Funcionario')->user()->id_Funcionario;
    $FuncionarioActivo = FuncionarioActivo($ID_Juzgado_T);
    
    if($FuncionarioActivo==1){
        return view('Posts/MultaVehicular/PostsJuzIngresoMulta');
    }
    else{
        Auth::guard('Funcionario')->logout();
        Session::flush();
           return Redirect::to('/');
    }

   
})->middleware('auth:Funcionario')->name('JuzListaDeMultas'); 

Route::get('/ListaDeMultasJuzgadoIngresadas',function () { 
    
    $ID_Juzgado_T=Auth::guard('Funcionario')->user()->id_Funcionario;
    $FuncionarioActivo = FuncionarioActivo($ID_Juzgado_T);
    
    if($FuncionarioActivo==1){
        return view('Posts/MultaVehicular/PostsJustMultasIngr');
    }
    else{
        Auth::guard('Funcionario')->logout();
        Session::flush();
           return Redirect::to('/');
    }

   
})->middleware('auth:Funcionario')->name('JuzMultasIngr'); 

Route::get('/ReporteJuzgado',function () { 
    
    $ID_Juzgado_T=Auth::guard('Funcionario')->user()->id_Funcionario;
    $FuncionarioActivo = FuncionarioActivo($ID_Juzgado_T);
    
    if($FuncionarioActivo==1){
        return view('Posts/Reportes/PostsReporteJuzgado');
    }
    else{
        Auth::guard('Funcionario')->logout();
        Session::flush();
           return Redirect::to('/');
    }

   
})->middleware('auth:Funcionario')->name('JuzReportes'); 

Route::get('/ReportePDFJuzgado', [ReportePDFJuzgado::class, 'index'])->middleware('auth:Funcionario')->name('ReportePdfJuzgado');
Route::get('/ReportePDFJuzgadoFechas', [ReporteFechaJuzgado::class, 'index'])->middleware('auth:Funcionario')->name('ReportePDFJuz');
Route::get('/SistemaPrincipal2', [VolverIndexController2::class, 'index'])->middleware('auth:Funcionario')->name('VolverIndex2');


//QR
Route::get('/MostrarMultaQRMulta/{Id_Multas?}',function ($Id_Multas) { 
        $datos=DB::table('Document')->Select('Ruta')->where('id_Multa_T', '=', $Id_Multas)->get();
        foreach ($datos as $Dato){
            $Ruta = $Dato->Ruta;
        } 
        
        $NombreArchivo = substr($Ruta,1,-4);
    	
		$contents = Storage::disk('PDF')->get($Ruta);
			
		$decoded = base64_decode($contents);
        header('Content-Type: application/pdf');
		$file = $NombreArchivo.'.'.'pdf';
        header('Content-Disposition: inline; filename="'.basename($file).'"');
        echo $decoded;
}); 

Route::get('/MultaQR/{Token1}/{Token2}',function ($Token1,$Token2) { 

    $BuscarMulta =  DB::table('BuscarMulta') 
        ->select('Multa') 
        ->where('Token1', '=', $Token1) 
        ->where('Token2', '=', $Token2)
        ->first();


    
    if(!empty($BuscarMulta->Multa)){

        $Id_Multas= $BuscarMulta->Multa;
        
        $pdf = \PDF::loadView('PDF/ReportePDFJuzgado', compact('Id_Multas'));
        return $pdf->download('PDF.pdf');

    }
    else{
        return Redirect::to('https://web.curico.cl/');

    }
}); 
 