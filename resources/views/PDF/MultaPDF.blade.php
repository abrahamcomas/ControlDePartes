<?php

    $qrimage= public_path('../public/QR/qr.png');
     \QRCode::url('www.pharalax.com')->setOutfile($qrimage)->png();

	  $Id_Multas;
   	$TipoNotificacion;
   	$NombresC;
   	$ApellidosCiu;
   	$RutCiudadano;
   	$Profesion;
   	$NombreNac;
   	$Domicilio;
   	$PlacaPatente;
   	$TipoVehiculo;
   	$Marca;
   	$Modelo; 
   	$Color;
   	$NombreJuzgado;
   	$FechaCitacion;
   	$descripcion;
   	$Lugar;
   	$Hora;
   	$id_Articulo;
   	$Fecha;
	$Nombres;
   	$ApellidosInsp;

   	$Id_Juzgad;
	$NumeroParte;
	$Anio;

	$NombresT;
	$ApellidosT;

        
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
            PATENTE: <?php echo $PlacaPatente; ?>
        </strong>
	<?php 	if($TipoNotificacion==1) 
			     {	?>
         			<strong>NOTIFICACIÓN ESCRITA</strong> 
	<?php 	 }
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
                FECHA = <?php echo $FechaCitacion; ?>
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
                FECHA = <?php echo $numeroDia; ?> de <?php echo $mes; ?> del <?php echo $anio; ?>
              <br>
                INSPECTOR = <?php echo $Nombres; ?>&nbsp;<?php echo $ApellidosInsp; ?>
          		<br>
                TESTIGO = <?php echo $NombresT; ?>&nbsp;<?php echo $ApellidosT; ?>
              <hr>  
              <img src='../public/QR/qr.png' width="100" height="100"/>
</div>                            


                 
  

   

    
      





