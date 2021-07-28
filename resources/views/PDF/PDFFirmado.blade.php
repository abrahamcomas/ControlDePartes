<?php
$Id_Multas;

$Datos  =   DB::table('Multas') 
->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
->leftjoin('TipoVehiculo', 'Vehiculos.TipoVehiculo', '=', 'TipoVehiculo.id')
->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
->select('Id_Inspectores','TipoNotificacion','Multas.Id_Juzgado AS Juzgado','Hora','InfraccionArticulo','DecLey','DetallesDecLey','Lugar','descripcion','NombreJuzgado','Parte','Anio','Fecha','Ciudadanos.Rut AS RutCiu','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Profesion','Licencia','FechaNacimiento','NombreNac','Domicilio','PlacaPatente','V_Descripcion','Marca','Modelo','Color','Inspectores.Nombres AS NombresIns','Inspectores.Apellidos AS ApellidosIns','FechaCitacion')
->where('Multas.Id_Multas', '=', $Id_Multas)->get();

foreach ($Datos as $user){ 
    //Multa
    $TipoNot     = $user->TipoNotificacion;  
    $Id_Juzgado  = $user->Juzgado;
    $Hora        = $user->Hora; 
    $InfraccionArticulo = $user->InfraccionArticulo;  
    $DecLey             = $user->DecLey; 
    $DetallesDecLey     = $user->DetallesDecLey; 
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
    $Profesion       = $user->Profesion;  
    $Licencia        = $user->Licencia;
    $FechaNacimiento = $user->FechaNacimiento; 
    $NombreNac       = $user->NombreNac;   
    $Domicilio       = $user->Domicilio; 
    //Veiculo
    $PlacaPatente = $user->PlacaPatente;
    $TipoVehiculo = $user->V_Descripcion;
    $Marca        = $user->Marca;
    $Modelo       = $user->Modelo;
    $Color        = $user->Color;
    // Inspectores
    $NombresIns   = $user->NombresIns;
    $ApellidosIns = $user->ApellidosIns;

     // Inspectores
     $Id_Inspectores   = $user->Id_Inspectores;
} 

$Testigo  =   DB::table('Inspectores')->select('Nombres','Apellidos')->where('id_inspector', '=', $Id_Inspectores)->get();

foreach ($Testigo as $user){ 

  $NombresTest     = $user->Nombres; 
  $ApellidosTest     = $user->Apellidos;   

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
    #ContenidoDercHeadAbajo2 { 
        margin-left: 400px;
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
  <div id="ContenidoIzqHead">
      		<center>
             DIRECCIÓN DE TRÁNSITO
          </center>  
      	</div>
  <div id="ContenidoDercHeadAbajo2">
      <center><p style="font-size: 12pt">DA CUENTA INF. TRANSITO.<br>
          <strong>Parte N° <?php echo $NumeroParte; ?></strong></p>
      </center>  
  </div>
  <center>  
    <?php if($Id_Juzgado==1){  ?>
        <h2>
          <strong><u>SEÑOR JUEZ <?php echo $NombreJuzgado ?> CURICÓ</u></strong>
        </h2>
    <?php }
    else{   ?>
        <h2>
          <strong><u>SEÑORA JUEZA <?php echo $NombreJuzgado ?> CURICÓ</u></strong>
        </h2>

   <?php }  ?>
   </center>
  <table>    
    <tbody>
      <tr>
        <td style="font-size: 12pt">
        Doy cuenta a U. S. que hoy  <strong><?php echo $dia; ?> <?php echo $numeroDia; ?> de <?php echo $mes;?></strong> del <strong><?php echo $anio;?></strong> a las <strong><?php echo $Hora; ?></strong> horas, en <strong><?php echo $Lugar; ?>, CURICÓ</strong>. Se cursó la siguiente infracción: <strong><?php echo $descripcion; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
        <br>
        <?php
            if($NombresC!='')
              {   ?>
                Infractor: <strong><?php echo $NombresC; ?> <?php echo $Apellidos; ?></strong>
        <?php }    
            else 
              {   ?>
                Infractor: <strong>PROPIETARIO DEL VEHICULO</strong>
        <?php }   ?>
        </td>
      </tr>
  <?php if($TipoNot=='3')
      {   ?>
      <tr>
        <td style="font-size: 12pt">
          Fecha Nac: <strong><?php echo $FechaNacidia; ?> <?php echo $FechaNacimes; ?> <?php echo $FechaAnio; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Rut: <strong><?php echo $Rut; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Nacionalidad: <strong><?php echo $NombreNac; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Domicilio: <strong><?php echo $Domicilio; ?></strong>
        </td>
      </tr>
  <?php }   ?>
      <tr>
        <td style="font-size: 12pt">
          Tipo de vehículo: <strong><?php echo $TipoVehiculo; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Color: <strong><?php echo $Color; ?></strong>
        </td> 
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Marca: <strong><?php echo $Marca; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Placa: <strong><?php echo $PlacaPatente; ?></strong>
        </td> 
      </tr>
  <?php if($TipoNot=='3')
      {   ?>  
      <tr>
        <td style="font-size: 12pt">
          Profesión u Oficio: <strong><?php echo $Profesion; ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt">
          Licencia Clase: <strong><?php echo $Licencia; ?></strong>
        </td>
      </tr>
  <?php }   ?>
      <tr>
        <td style="font-size: 12pt"> 
          Disposición Infringida:<strong><?php echo $InfraccionArticulo; ?> , </strong><?php echo $DecLey; ?></strong><?php echo $DetallesDecLey; ?></strong></strong>
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt"> 
        <strong>DENUNCIANTE</strong>:  <?php echo $NombresIns; ?> <?php echo $ApellidosIns; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspector Municipal
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt"> 
        <strong>TESTIGO</strong>: <?php echo $NombresTest; ?> <?php echo $ApellidosTest; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspector Municipal
        </td>
      </tr>
      <tr>
        <td style="font-size: 12pt"> 
        <br>
        Quedó citado (a)
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

      para comparecer ante U.S. a la audiencia del dia <strong><?php echo $diaFC;?> <?php echo $numeroDiaFC;?> de <?php echo $mesFC; ?> del <?php echo $anioFC; ?></strong> a las 09:15 horas bajo apercibimiento de rebeldía.<br>
    Curico, <strong><?php echo $dia; ?> <?php echo $numeroDia; ?> de <?php echo $mes;?> del <?php echo $anio;?></strong> 
        </td>
      </tr>
    </tbody>
  </table> 
  <table width="100%" border="0">
  	  <td>
  	    <div id="ContenidoIzqHead">
          <center>
            <P style="font-size: 13pt"> 
              <?php echo $NombresIns; ?> <?php echo $ApellidosIns; ?><br>
              <strong>Inspector Municipal</strong>
                <strong>DENUNCIANTE</strong><br>
              </P>
          </center>
          <strong>JAD</strong><br>
          <u>DISTRIBUCIÓN:</u><br>
          La indicada<br>
          Archivo
      	</div>
    	</td> 
      <td>
        <div id="FechaPrincipalHead"></div>
    	</td>
    	<td>
    	  <div id="ContenidoDercHead">
        <center>
            <P style="font-size: 13pt"> 
            <?php echo $NombresTest; ?> <?php echo $ApellidosTest; ?><br>
              <strong>Inspector Municipal</strong>
                <strong>TESTIGO</strong>
              </P>
          </center>
    	  </div>
      </td>
      <center>
            <P style="font-size: 13pt"> 
                <strong>Firmado electrónicamente por el denunciante bajo el amparo de la ley N°19.799</strong>
              </P>
          </center>
    </tr>
  </table>

    
 

  

   

    
      





