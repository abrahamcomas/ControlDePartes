<div>
    @if($Detalles==0)
        <center><strong><h2>REPORTES</h2></strong></center>
        <hr> 
        <div class="row">
            <div class="col-xs-12 col-sm-22 col-md-12 col-lg-4">
                <input type="date"  class="form-control" wire:model="FechaDE" />
            </div>
            <div class="col-xs-12 col-sm-22 col-md-12 col-lg-4">
                <input type="date"  class="form-control" wire:model="FechaHasta" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                        <select  class="form-control" wire:model="perPage">
                            <option value="5" selected>Mostrar 5 por página</option>
                            <option value="10">Mostrar 10 por página</option>
                            <option value="15">Mostrar 15 por página</option>
                            <option value="20">Mostrar 20 por página</option>
                            <option value="25">Mostrar 25 por página</option>
                            <option value="30">Mostrar 30 por página</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                        <center>
                                <button wire:click="clear" type="button" class="btn btn-danger active">X</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <br> 
        <table table class="table table-hover">
        	<thead>
        		<tr>  
                    <th><center>N°</center></th> 
        			<th><center>PLACA</center></th>
                    <th><center>Fecha Ingreso</center></th>
                    <th><center>DETALLES</center></th>
                    <th><center>PDF</center></th>
        		</tr>
        	</thead> 
        	<tbody>
        		@foreach($posts as $post)
        		<tr>
                    <td><center>{{ $post->Id_Juzgado }}{{ $post->NumeroParte }}{{ $post->Anio }}</center></td>
        			<td><center>{{ $post->PlacaPatente }}</center></td>
                    <td><center>{{ $post->Fecha }}</center></td> 
        			<td> 
                        <center>
                            <button class="btn btn-primary" wire:click="M_Detalles({{ $post->Id_Multas }})">DETALLES</button>
                        </center>
        			</td>
                    <td> 
                        <center>
                            <a href="{{ $post->Ruta }}" class="btn btn-primary active" target="_blank">PDF</a>
                        </center>
        			</td>
        		</tr> 
        		@endforeach 
        	</tbody>
        </table>  
        {{ $posts->links() }}
        @if($FechaDE!='' AND $FechaHasta!='')
            <hr> 
            <center> 
               <a href="{{ route('ReportePDFJuz',['FechaDE'=> $FechaDE, 'FechaHasta'=>$FechaHasta]) }}" class="btn btn-success active">Imprimir PDF</a>
            </center>
            <hr> 
        @endif
    @else 
        <br>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div id="Multa">  
                    <div class="card">
                        <div class="btn-group" style=" width:100%;">	      
                            <button class="btn btn-danger" wire:click="O_Detalles">Volver</button>
                        </div>
                        <div class="card-body">
                           <table class="table table-striped table-bordered">
                                <tbody> 
                                @foreach($Datos as $post) 
                                        @if($post->TipoNotificacion==3)
                                            <tr>
                                                <td style="text-align: center;">
                                                    <strong>TIPO NOTIFICACIÓN = PERSONALMENTE</strong> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    NOMBRE = {{ $post->NombresC }}&nbsp;{{ $post->ApellidosCiu }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    RUT = {{ $post->RutCiudadano }} 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    PROFESIÓN = {{ $post->Profesion }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    NACIONALIDAD = {{ $post->NombreNac }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    DOMICILIO = {{ $post->Domicilio }}
                                                </td>
                                            </tr>
                                        @elseif($post->TipoNotificacion==2)
                                            <tr>
                                                <td style="text-align: center;">
                                                    <strong>TIPO NOTIFICACIÓN = EMPADRONADO</strong>    
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="text-align: center;">
                                                    <strong>TIPO NOTIFICACIÓN = POR ESCRITO</strong>    
                                                </td>
                                            </tr>
                                        @endif 
                                            <tr>
                                                <td style="text-align: center;">
                                                    <center>
                                                        <strong>DATOS VEHÍCULO</strong>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    PATENTE = {{ $post->PlacaPatente  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    TIPO VEHÍCULO = {{ $post->TipoVehiculo  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    MARCA = {{ $post->Marca  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    MODELO = {{ $post->Modelo  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    COLOR = {{ $post->Color  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <center>
                                                        <strong>DATOS CITACIÓN</strong> 
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    CITACIÓN = {{ $post->NombreJuzgado  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    FECHA CITACIÓN = {{ $post->FechaCitacion  }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <center>
                                                        <strong>DATOS INFRACCIÓN</strong> 
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    DESCRIPCIÓN INFRACCIÓN = {{ $post->descripcion }}
                                                </td>
                                            </tr>
                                            <tr> 
                                                <td style="text-align: center;">
                                                    LUGAR DE LA INFRACCIÓN = {{ $post->Lugar }} 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    HORA INFRACCIÓN = {{ $post->Hora }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    INFRACCIÓN ARTICULO = {{ $post->id_Articulo }}
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td style="text-align: center;">
                                                    FECHA INFRACCIÓN = {{ $post->Fecha }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    NOMBRE INSPECTOR = {{ $post->Nombres }}&nbsp;{{ $post->ApellidosInsp }}
                                                </td>
                                            </tr>

                                    @endforeach
                                    @foreach($Testigo as $post)
                                            <tr>
                                                <td style="text-align: center;">
                                                    TESTIGO = {{ $post->Nombres }}&nbsp;{{ $post->Apellidos }}
                                                </td>
                                            </tr>
                                    @endforeach

                                    @if($Imagenes!='[]')
                                        @foreach($Imagenes as $post) 
                                            <tr>
                                                <td> 
                                                    <center>
                                                        <a href="{{ $post->RutaImagen }}" download>
                                                            <img src="{{ $post->RutaImagen }}" class="img-fluid" alt="Responsive image">
                                                        </a>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <center>
                                                    <h4>FOTO NO DISPONIBLE</h4>
                                                </center>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>      
                            </table>
                        </div> 
                    </div>    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
        </div>
    @endif
</div>
  

