<?php
$fecha_hoy=date("d/m/Y");
$FechaDE; 
$FechaHasta;
$idTipoInfraccion; 
$id_inspector;


if($idTipoInfraccion==0){
    $Datos  =  DB::table('Multas') 
    ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
    ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
    ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
    ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
    ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
    ->select('Id_Multas','NumeroParte','Anio','Id_Juzgado','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','FechaCitacion','descripcion','NombreArt','Hora','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar','EstadoMulta')
    ->whereBetween('Multas.Fecha', [$FechaDE, $FechaHasta])
    ->where('Inspectores.id_inspector', '=', $id_inspector)->get();

}
else{
    $Datos  =  DB::table('Multas') 
    ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
    ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
    ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
    ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
    ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
    ->select('Id_Multas','NumeroParte','Anio','Id_Juzgado','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','FechaCitacion','descripcion','NombreArt','Hora','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar','EstadoMulta')
    ->whereBetween('Multas.Fecha', [$FechaDE, $FechaHasta])
    ->where('TipoInfraccion.id_Infraccion', '=', $idTipoInfraccion)
    ->where('Inspectores.id_inspector', '=', $id_inspector)->get();

}





$DatosInspector  =   DB::table('Inspectores') 
->select('Rut','Nombres','Apellidos')
->where('id_inspector', '=', $id_inspector)->get();

foreach ($DatosInspector as $user){
        
    $Rut 		= $user->Rut; 
    $Nombres 	= $user->Nombres;
    $Apellidos 	= $user->Apellidos;
      
}



$FechaCitacion=date("Y-m-d");
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
              width: 300px; 
              font-size: 14px;
            }
            #FechaPrincipalHead { 
                width: 170px; 
                font-size: 14px;
                margin-left: 160px;
            }
            #ContenidoDercHead { 
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
              		I.MUNICIPALIDAD DE CURICO<br> 
                  	SISTEMA CONTROL DE PARTES
              	</div>
          	</td>
            <td>
              <div id="FechaPrincipalHead">{{ $diaFC }} {{ $numeroDiaFC }} de {{ $mesFC }} {{ $anioFC }}</div>
          	</td>
          	<td>
          	<div id="ContenidoDercHead">
              <img src="../public/Imagenes/escudo.png" width="100" height="100"/>
          	</div>
        </td>
        </tr>
    </table>
    <center>  
          <h2>
            <strng>REPORTE INSPECTOR</strong>
          </h2>
          <h3>
            <strng><?php echo $Nombres; ?> <?php echo $Apellidos; ?></strong> 
        	<br>
            <strng><?php echo $Rut; ?></strong>
          </h3>
    </center> 
    <hr>
    <table  width="100%" border="1"  > 
        <thead>
            <tr> 
              <th>
                  <center>N°</center>
                </th>
                <th>
                  <center>Patente</center>
                </th>
                <th>
                  <center>Descripción</center>
                </th>
                <th>
                  <center>Artículo</center>
                </th>
                <th>
                  <center>Fecha</center>
                </th>
                <th>
                  <center>Hora</center>
                </th>
                <th>
                  <center>Estado</center>
                </th>
            </tr> 
        </thead>
        <tbody>
    <?php   foreach ($Datos as $row): ?>
        	<tr>
                <td>
                  <center><?php echo $row->Id_Juzgado; ?><?php echo $row->NumeroParte; ?><?php echo $row->Anio; ?></center>
                </td>
            	  <td>
                	<center><?php echo $row->PlacaPatente; ?></center>
              	</td>
                <td>
                  	<center><?php echo $row->descripcion;  ?></center>
                </td>
                <td>
                  	<center><?php echo $row->NombreArt;  ?></center>
                </td>
              	<td>
                	<center><?php echo $row->Fecha;  ?></center>
              	</td>
                <td>
                  <center><?php echo $row->Hora;  ?></center>
                </td>
    <?php 
          if($row->EstadoMulta==0)
          { ?>
                <td><center>Pendiente</center></td>
    <?php   }
            else
            {   ?>
        <td><center>Ingresada</center></td>
    <?php   }
            ?> 
            </tr>
    <?php   endforeach ?> 
        </tbody> 
    </table>
     
     
     
      
     

   

    
      




