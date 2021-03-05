<div>
    @if($Detalles==0)
        <center><strong><h2>MULTAS PENDIENTES</h2></strong></center>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <input type="text"  class="form-control" placeholder="Patente" wire:model="searchTerm" />
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
        </div>
        <br> 
        <table table class="table table-hover">
        	<thead>
        		<tr> 
                    <th><center>N°</center></th>
        			<th><center>PLACA</center></th>
                    <th><center>INSPECTOR</center></th>
                    <th><center>DETALLES</center></th>
        		</tr>
        	</thead>
        	<tbody>
        		@foreach($posts as $post)
        		<tr>
                    <td><center>{{ $post->Id_Multas }}</center></td>
        			<td><center>{{ $post->PlacaPatente }}</center></td>
                    <td><center>{{ $post->Apellidos }}</center></td> 
        			<td> 
                        <center>
                            <button class="btn btn-primary" wire:click="M_Detalles({{ $post->Id_Multas }})">DETALLES</button>
                        </center>
        			</td>
        		</tr>
        		@endforeach
        	</tbody>
        </table> 
        {{ $posts->links() }}
    @else 
        <hr>
        <center>
            <button class="btn btn-primary" wire:click="O_Detalles">Volver</button>
        </center>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div id="Multa"> 
                    <table> 
                        <center>
                            <h5><u>Municipalidad de Curicó</u></h5>
                            @foreach($Datos as $post1)
                                <strong><h4>Sistema Control de partes</h4>Multa N°{{ $post1->Id_Multas }}</strong>
                            @endforeach
                        </center>
                    </table>
                    <table>
                        <center>
                            @foreach($Datos as $post)
                                @if($post->TipoNotificacion==1)
                                    <hr>
                                    <strong>TIPO NOTIFICACIÓN = ESCRITO</strong> 
                                    <hr>
                                    NOMBRE = {{ $post->NombresC }}&nbsp;{{ $post->ApellidosCiu }}
                                    <br>
                                    RUT = {{ $post->RutCiudadano }} 
                                    <br>
                                    PROFESIÓN = {{ $post->Profesion }}
                                    <br>
                                    NACIONALIDAD = {{ $post->NombreNac }}
                                    <br>
                                    DOMICILIO = {{ $post->Domicilio }}
                                    <hr>
                                @else
                                    <hr>
                                    <strong>TIPO NOTIFICACIÓN = PERSONALMENTE</strong> 
                                    <hr>
                                @endif
                                    <strong>DATOS VEHÍCULO</strong> 
                                    <hr>
                                    PATENTE = {{ $post->PlacaPatente  }}
                                    <br>
                                    TIPO VEHÍCULO = {{ $post->TipoVehiculo  }}
                                    <br>
                                    MARCA = {{ $post->Marca  }}
                                    <br>
                                    MODELO = {{ $post->Modelo  }}
                                    <br>
                                    COLOR = {{ $post->Color  }}
                                    <hr>
                                    <strong>DATOS CITACIÓN</strong> 
                                    <hr>
                                    CITACIÓN = {{ $post->NombreJuzgado  }}
                                    <br>
                                    FECHA CITACIÓN = {{ $post->FechaCitacion  }}
                                    <hr>
                                    <strong>DATOS INFRACCIÓN</strong> 
                                    <hr>
                                    DESCRIPCIÓN INFRACCIÓN = {{ $post->descripcion }}
                                    <br>
                                    LUGAR DE LA INFRACCIÓN = {{ $post->Lugar }}
                                    <br>
                                    HORA INFRACCIÓN = {{ $post->Hora }}
                                    <br>
                                    INFRACCIÓN ARTICULO = {{ $post->id_Articulo }}
                                    <br>
                                    FECHA INFRACCIÓN = {{ $post->Fecha }}
                                    <br>
                                    NOMBRE INSPECTOR = {{ $post->Nombres }}&nbsp;{{ $post->ApellidosInsp }}
                                    <br>
                            @endforeach
                            @foreach($Testigo as $post)
                                    TESTIGO = {{ $post->Nombres }}&nbsp;{{ $post->Apellidos }}
                                    <br>
                            @endforeach
                            <hr>
                        </center>
                    </table>
                </div>  
                <center>
                    <a class="btn btn-info active" href="javascript:imprSelec('Multa')" >IMPRIMIR COMPROBANTE</a>
                </center>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
        </div>
    @endif
</div>
  

