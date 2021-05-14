<?php
$fecha_hoy=date("d/m/Y");
$Id_Multas;

$Datos  =   DB::table('Multas') 
->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
->leftjoin('TipoVehiculo', 'Vehiculos.TipoVehiculo', '=', 'TipoVehiculo.id')
->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
->select('TipoNotificacion','Hora','Lugar','descripcion','NombreJuzgado','Parte','Anio','Fecha','Ciudadanos.Rut AS RutCiu','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','FechaNacimiento','NombreNac','Domicilio','PlacaPatente','Descripcion_TV','Marca','Modelo','Color','Inspectores.Nombres AS NombresIns','Inspectores.Apellidos AS ApellidosIns','FechaCitacion')
->where('Multas.Id_Multas', '=', $Id_Multas)->get();

foreach ($Datos as $user){
    //Multa
    $TipoNot     = $user->TipoNotificacion;  
    $Hora        = $user->Hora;  
    $Lugar       = $user->Lugar;      
    $descripcion = $user->descripcion; 
    $FechaCitacion = $user->FechaCitacion;   
    //Juzgado
    $NombreJuzgado = $user->NombreJuzgado;    
    $NumeroParte   = $user->Parte;    
    $Anio          = $user->Anio;
    $Fecha         = $user->Fecha;     
    //Ciudadano
    $Rut             = $user->RutCiu;    
    $NombresC        = $user->NombresC;    
    $Apellidos       = $user->ApellidosCiu;
    $FechaNacimiento = $user->FechaNacimiento;  
    $NombreNac       = $user->NombreNac;   
    $Domicilio       = $user->Domicilio; 
    //Veiculo
    $PlacaPatente = $user->PlacaPatente;
    $TipoVehiculo = $user->Descripcion_TV;
    $Marca        = $user->Marca;
    $Modelo       = $user->Modelo;
    $Color        = $user->Color;
    // Inspectores
    $NombresIns   = $user->NombresIns;
    $ApellidosIns = $user->ApellidosIns;

} 
        
$numeroDia = date('d', strtotime($Fecha));
$dia = date('l', strtotime($Fecha));
$mes = date('F', strtotime($Fecha));
$anio = date('Y', strtotime($Fecha));

if($mes=='January'){
  $mes= 'Enero';
  }
elseif($mes=='February'){   
  $mes= 'Febrero';
  }
elseif($mes=='March'){  
  $mes= 'Marzo';
  }
elseif($mes=='April'){
     $mes= 'Abril';
  }
elseif($mes=='May'){
     $mes= 'Mayo';
  }
elseif($mes=='June'){
     $mes= 'Junio';
  }
elseif($mes=='July'){ 
     $mes= 'Julio';
  }
elseif($mes=='August'){  
     $mes= 'Agosto';
  }
elseif($mes=='September'){  
     $mes= 'Septiembre';
  }
elseif($mes=='October'){  
     $mes= 'Octubre';
  }
elseif($mes=='November'){  
     $mes= 'Noviembre';
  }
else{  
     $mes= 'Diciembre';
  }

if($dia=='Monday'){
  $dia= 'Lunes';
  }
elseif($dia=='Tuesday'){   
  $dia= 'Martes';
  }
elseif($dia=='Wednesday'){  
  $dia= 'Miércoles';
  }
elseif($dia=='Thursday'){
     $dia= 'Jueves';
  }
elseif($dia=='Friday'){
     $dia= 'Viernes';
  }
elseif($dia=='Saturday'){
     $dia= 'Sábado';
  }
else{ 
     $dia= 'Domingo';
  }
 

$FechaNacidia = date('d', strtotime($FechaNacimiento));
$FechaNacimes = date('F', strtotime($FechaNacimiento));
$FechaAnio = date('Y', strtotime($FechaNacimiento));

if($FechaNacimes=='January'){
  $FechaNacimes= 'Enero';
  }
elseif($FechaNacimes=='February'){   
  $FechaNacimes= 'Febrero';
  }
elseif($FechaNacimes=='March'){  
  $FechaNacimes= 'Marzo';
  }
elseif($FechaNacimes=='April'){
     $FechaNacimes= 'Abril';
  }
elseif($FechaNacimes=='May'){
     $FechaNacimes= 'Mayo';
  }
elseif($FechaNacimes=='June'){
     $FechaNacimes= 'Junio';
  }
elseif($FechaNacimes=='July'){ 
     $FechaNacimes= 'Julio';
  }
elseif($FechaNacimes=='August'){  
     $FechaNacimes= 'Agosto';
  }
elseif($FechaNacimes=='September'){  
     $FechaNacimes= 'Septiembre';
  }
elseif($FechaNacimes=='October'){  
     $FechaNacimes= 'Octubre';
  }
elseif($FechaNacimes=='November'){  
     $FechaNacimes= 'Noviembre';
  }
else{  
     $FechaNacimes= 'Diciembre';
  }

$FechaCitacion = date('Y', strtotime($FechaCitacion));



$numeroDiaFC = date('d', strtotime($FechaCitacion));
$diaFC = date('l', strtotime($FechaCitacion));
$mesFC = date('F', strtotime($FechaCitacion));
$anioFC = date('Y', strtotime($FechaCitacion));

if($mesFC=='January'){
  $mesFC= 'Enero';
  }
elseif($mesFC=='February'){   
  $mesFC= 'Febrero';
  }
elseif($mesFC=='March'){  
  $mesFC= 'Marzo';
  }
elseif($mesFC=='April'){
     $mesFC= 'Abril';
  }
elseif($mesFC=='May'){
     $mesFC= 'Mayo';
  }
elseif($mesFC=='June'){
     $mesFC= 'Junio';
  }
elseif($mesFC=='July'){ 
     $mesFC= 'Julio';
  }
elseif($mesFC=='August'){  
     $mesFC= 'Agosto';
  }
elseif($mesFC=='September'){  
     $mesFC= 'Septiembre';
  }
elseif($mesFC=='October'){  
     $mesFC= 'Octubre';
  }
elseif($mesFC=='November'){  
     $mesFC= 'Noviembre';
  }
else{  
     $mesFC= 'Diciembre';
  }

if($diaFC=='Monday'){
  $diaFC= 'Lunes';
  }
elseif($diaFC=='Tuesday'){   
  $diaFC= 'Martes';
  }
elseif($diaFC=='Wednesday'){  
  $diaFC= 'Miércoles';
  }
elseif($diaFC=='Thursday'){
     $diaFC= 'Jueves';
  }
elseif($diaFC=='Friday'){
     $diaFC= 'Viernes';
  }
elseif($diaFC=='Saturday'){
     $diaFC= 'Sábado';
  }
else{ 
     $diaFC= 'Domingo';
  }
?>
<head>
  <meta charset="UTF-8">
  <title>Documento PDF</title>
  <style>
    h4{
    text-align: center;
    text-transform: uppercase;
    }
    #ContenidoIzqHead { 
      margin-left: 00px;
      width: 200px; 
      font-size: 15px;
    }
    #FechaPrincipalHead { 
        width: 120px; 
        font-size: 13px;
        margin-left: 160px;
    }
    #ContenidoDercHead { 
        margin-right: 0px;
        margin-top: 0px;
    }
    #ContenidoDercHeadAbajo { 
        margin-left: 500px;
        margin-right: 0px;
        margin-top: 0px;
    }
    #TablaIzq { 
      width: 400px; 
      font-size: 11px;
      margin-right: 0px;
      margin-top: 0px;
    }
    #TablaDer { 
      width: 300px; 
      font-size: 11px;
      margin-left: 0px;
      margin-top: 0px;
    }
    #TablaIzqF { 
      width: 350px; 
      font-size: 11px;
      margin-right: 0px;
      margin-top: 0px;
    }
    #TablaDerF { 
      width: 350px; 
      font-size: 11px;
      margin-left: 0px;
      margin-top: 0px;
    }
  </style>
</head>
  <table width="100%" border="0">
    <tr>
  	  <td>
  	    <div id="ContenidoIzqHead">
      		<center>
              <img src="../public/Imagenes/escudo.png" width="100" height="100"/>
          </center>  
      	</div>
    	</td>
      <td>
        <div id="FechaPrincipalHead"></div>
    	</td>
    	<td>
    	  <div id="ContenidoDercHead">
           
            <img src="../public/Imagenes/Curico.png" width="100" height="100"/>
    	  </div>
      </td>
    </tr>
  </table>
  <div id="ContenidoDercHeadAbajo">
    <h4>
      <strong>Parte N° <?php echo $NumeroParte; ?></strong>
    </h4>
  </div>
  <center>  
    <h2>
      <strong><u>SEÑOR JUEZ <?php echo $NombreJuzgado ?> CURICÓ</u></strong>
    </h2>
    <p style="font-size: 14pt">
      Doy cuenta a usted que hoy  <strong><?php echo $dia; ?> <?php echo $numeroDia; ?> de <?php echo $mes;?> del <?php echo $anio;?></strong> a las <strong><?php echo $Hora; ?></strong> horas, en <strong><?php echo $Lugar; ?> CURICÓ</strong>. Se cursó la siguiente infracción <strong><?php echo $descripcion; ?></strong>
    </p>
  </center>
  <br>
  <table>    
    <tbody>
      <tr>
        <td style="font-size: 14pt">
      <?php
            if($NombresC!='')
              {   ?>
                Infractor: <strong><?php echo $NombresC; ?> <?php echo $Apellidos; ?></strong>
      <?php   }    
            else 
              {   ?>
                Infractor: <strong>PROPIETARIO DEL VEHICULO</strong>
      <?php   }   ?>
        </td>
      </tr>
      <?php
          if($FechaNacimiento!='')
            { ?>
              <tr>
                <td style="font-size: 14pt">
                  Fecha Nac: <strong><?php echo $FechaNacidia; ?> <?php echo $FechaNacimes; ?> <?php echo $FechaAnio; ?></strong>
                </td>
              </tr>
      <?php  } 
          if($Rut!='')
              {   ?>
              <tr>
                <td style="font-size: 14pt">
                  Rut: <strong><?php echo $Rut; ?></strong>
                </td>
              </tr>
      <?php   }  
          if($NombreNac!='')
              {   ?>
              <tr>
                <td style="font-size: 14pt">
                  Nacionalidad: <strong><?php echo $NombreNac; ?></strong>
                </td>
              </tr>
      <?php   }  
          if($Domicilio!='')
              {   ?>
              <tr>
                <td style="font-size: 14pt">
                  Domicilio: <strong><?php echo $Domicilio; ?></strong>
      <?php   }   ?>
        </td>
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Tipo de vehiculo: <strong><?php echo $TipoVehiculo; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Color: <strong><?php echo $Color; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Placa: <strong><?php echo $PlacaPatente; ?></strong>
        </td> 
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Marca: <strong><?php echo $Marca; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Profesion u Oficio: <strong><?php echo $Domicilio; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Licencia Clase:X
        </td>
      </tr>
      <tr>
        <td style="font-size: 14pt">
          Disposición Infringida:<strong>?????</strong>
        </td>
      </tr style="font-size: 14pt">
      <td>
        <tr>
          Denunciante:<strong><?php echo $Domicilio; ?></strong>
        </tr>
      </td> 
     
    </tbody>
  </table>
    <p style="font-size: 14pt">
    <strong>DENUNCIANTE</strong> <?php echo $NombresIns; ?> <?php echo $ApellidosIns; ?> <strong>Inspector Municipal</strong></p> 
    <br>
    <center>
      <p style="font-size: 14pt">
      Quedo citado (a)
<?php if($TipoNot=='1')
      {   ?>
         <strong>POR ESCRITO</strong>
<?php }
elseif($TipoNot=='2')
      {   ?>
          <strong>EMPADRONADO</strong>
<?php }
else  {   ?>
          <strong>PERSONALMENTE</strong>
<?php }   ?>

      para comparecer ante U.S. a la audiencia del dia <strong><?php echo $diaFC;?> <?php echo $numeroDiaFC;?> de <?php echo $mesFC; ?> del <?php echo $anioFC; ?></strong> a las 09:15 horas bajo apercibimiento de rebeldia.
    Curico, fecha actual 
        </p>
  </center>
    
 

  

   

    
      





