<?php
 
 	$user =  DB::table('Multas') 
            ->leftjoin('Inspectores', 'Multas.Id_Inspector', '=', 'Inspectores.id_inspector')
            ->leftjoin('Ciudadanos', 'Multas.Id_Ciudadanos', '=', 'Ciudadanos.id_Ciudadano')
            ->leftjoin('Nacionalidad', 'Ciudadanos.ID_Nacionalidad', '=', 'Nacionalidad.id_Nacionalidad')
            ->leftjoin('Juzgado', 'Multas.Id_Juzgado', '=', 'Juzgado.id_Juzgado')
            ->leftjoin('TipoInfraccion', 'Multas.id_TipoInfraccion', '=', 'TipoInfraccion.id_Infraccion')
            ->leftjoin('Vehiculos', 'Multas.Id_Vehiculo', '=', 'Vehiculos.id_Vehiculo')
            ->leftjoin('Articulo', 'Multas.InfraccionArticulo', '=', 'Articulo.id_Articulo')
            ->select('Id_Multas','NumeroParte','Anio','Multas.Id_Juzgado AS Id_Juzgad','PlacaPatente','TipoVehiculo','Marca','Modelo','Color','NombreJuzgado','FechaCitacion','descripcion','NombreArt','Hora','InfraccionArticulo','DecLey','DetallesDecLey','Nombres','Inspectores.Apellidos AS ApellidosInsp','NombresC','Ciudadanos.Apellidos AS ApellidosCiu','Ciudadanos.Rut AS RutCiudadano','Profesion','NombreNac','TipoNotificacion','Domicilio','id_Articulo','Fecha','Lugar')
            ->where('Multas.Id_Multas', '=', $IdMultaIngresada)->first();

    $BuscarMulta =  DB::table('BuscarMulta') 
            ->where('Multa', '=', $IdMultaIngresada)->first();

    $Token1= $BuscarMulta->Token1;
    $Token2= $BuscarMulta->Token2;

    $contenido='controldeparte.test/MultaQR/'.$Token1.'/'.$Token2.'';
	$qrimage= public_path('../public/QR/qr.png');
	\QRCode::url($contenido)->setOutfile($qrimage)->png();
 
	   	$TipoNotificacion= $user->TipoNotificacion;
	   	$NombresC= $user->NombresC;
	   	$ApellidosCiu= $user->ApellidosCiu;
	   	$RutCiudadano= $user->RutCiudadano;
	   	$Profesion= $user->Profesion; 
	   	$NombreNac= $user->NombreNac; 
	   	$Domicilio= $user->Domicilio;
	   	$PlacaPatente= $user->PlacaPatente;
	   	$TipoVehiculo= $user->TipoVehiculo;
	   	$Marca= $user->Marca;
	   	$Modelo= $user->Modelo; 
	   	$Color= $user->Color;
	   	$NombreJuzgado= $user->NombreJuzgado;
	   	$FechaCitacion= $user->FechaCitacion;
	   	$descripcion= $user->descripcion;
	   	$Lugar= $user->Lugar;
	   	$Hora= $user->Hora;
	   	$id_Articulo= $user->InfraccionArticulo;
		$DecLey= $user->DecLey;
		$DetallesDecLey= $user->DetallesDecLey;
	   	$Fecha= $user->Fecha;
		$Nombres= $user->Nombres;
	   	$ApellidosInsp= $user->ApellidosInsp;
	   	$Id_Juzgad= $user->Id_Juzgad;
		$NumeroParte= $user->NumeroParte;
		$Anio= $user->Anio;   
	

 	$Testigo =  DB::table('Multas') 
        ->leftjoin('Testigos', 'Multas.Id_Multas', '=', 'Testigos.id_Multas_T')
        ->leftjoin('Inspectores', 'Testigos.Id_Inspectores', '=', 'Inspectores.id_inspector')
        ->select('Nombres','Apellidos')
        ->where('Multas.Id_Multas', '=', $IdMultaIngresada)->first();

	
		$NombresT= $Testigo->Nombres;
		$ApellidosT= $Testigo->Apellidos;
	
       
	
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
?>
<head>
  	<meta charset="UTF-8">
  	<title>Documento PDF</title>
  	<style>
	  	/*.padre {
			  background-color: #fafafa;
			  margin: 1rem;
			  padding: 1rem;
			  border: 2px solid #ccc;
			  text-align: center;
		}*/
	 
	    #FechaPrincipalHead { 
			font-size: 20px;
			height: 170px;
			margin: -45px;
			padding: 10px;
			page-break-inside: avoid; 
			width: 190px;
	    }
	    #Fecha { 
	  	font-size:12px;
			height: 90px;
			margin: -45px;
			padding: 10px;
			page-break-inside: avoid; 
			width: 190px;
	    }
	    #Texto { 
	  	font-size:12px;
	  	font-family: Vegur, 'PT Sans', Verdana, sans-serif;
			height: 100px;
			margin: -45px;
			padding: 10px;
			page-break-inside: avoid; 
			width: 190px; 
	  		
	    }

 	</style>
</head>
<div id="FechaPrincipalHead">
    <img src="../public/Imagenes/escudo.png" width="100" height="100"/>
    <strong>Municipalidad de Curicó</strong>  
</div>
<div id="Fecha">
	<hr>
	  <strong>Multa N°  <?php echo $Id_Juzgad; ?><?php echo $NumeroParte; ?><?php echo $Anio; ?></strong>
    <strong><?php echo $dia; ?> <?php echo $numeroDia; ?> de <?php echo $mes; ?> del <?php echo $anio; ?></strong>
  <hr>
</div>
<div id="Texto"> 
		<strong>
			PROPIETARIO DEL VEHÍCULO
		</strong> 
        <strong>
            PATENTE: <?php echo $PlacaPatente; ?>
        </strong>
	<?php 	if($TipoNotificacion==1) 
			{	?>
         		<strong>NOTIFICACIÓN ESCRITA</strong> 
	<?php 	}
          	elseif($TipoNotificacion==2)  
			{ 	?>
         		<strong>NOTIFICACIÓN EMPADRONADO</strong> 
	<?php	}	
			else 
			{	?>
            	<strong>NOTIFICACIÓN PERSONALMENTE</strong> 
              	<br>
	        	NOMBRE = <?php echo $NombresC ?>&nbsp;<?php echo $ApellidosCiu ?>
	    		<br>
	            RUT = <?php echo $RutCiudadano; ?>
	     		<br>
	            PROFESIÓN = <?php echo $Profesion; ?>
				<br>
	            NACIONALIDAD = <?php echo $NombreNac; ?>
	    		<br>
	            DOMICILIO = <?php echo $Domicilio; ?>                             
    <?php 	} 	?>
               <hr>
               <strong>DATOS CITACIÓN</strong> 
               <hr>
                    <?php echo $NombreJuzgado; ?>
              	<br>
            
	<?php   if($TipoNotificacion==2) 
			{	?>
         		<strong>A espera de citación por parte de ese JPL.</strong> 
	<?php 	}
           else  
			{ 	?> 
         		FECHA =    <?php echo $diaFC; ?> <?php echo $numeroDiaFC; ?> de <?php echo $mesFC; ?> <?php echo $anioFC; ?>                   
    <?php 	} 	?>
				<hr>  
			    <strong>DATOS INFRACCIÓN</strong> 
              	<hr>  
                DESCRIPCIÓN = <?php echo $descripcion; ?>
              	<br>
                LUGAR = <?php echo $Lugar; ?> 
          		<br>
                HORA = <?php echo $Hora; ?>
              	<br>
                ARTICULO = <?php echo $id_Articulo; ?>
              	<br>
	<?php   if($DecLey=='Decreto') 
			{	?>
         		 DECRETO = <?php echo $DetallesDecLey; ?>
	<?php 	}
           else  
			{ 	?> 
         		 LEY =      <?php echo $DetallesDecLey; ?>             
    <?php 	} 	?>
              	<br>
                FECHA = <?php echo $numeroDia; ?> de <?php echo $mes; ?> del <?php echo $anio; ?>
              <!--	<br>
                INSPECTOR = <?php echo $Nombres; ?>&nbsp;<?php echo $ApellidosInsp; ?>
          		<br>
                TESTIGO = <?php echo $NombresT; ?>&nbsp;<?php echo $ApellidosT; ?>
              	<hr>  
            	<img src='../public/QR/qr.png' width="100" height="100"/>-->
         
</div>                            


                 
  

   

    
      





