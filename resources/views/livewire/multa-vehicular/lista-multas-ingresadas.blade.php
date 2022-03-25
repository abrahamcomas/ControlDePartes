<div>  
    @if($Detalles==0) 
    <br>
    <div class="row">  
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <center><h5><strong>LISTA INFRACCIÓNES</strong></h5></center>
                        </div> 
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body"> 
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <div class="form-label-group">
                                                <select class="form-control" wire:model="AnioSelect"> 
                                                    @foreach ($Anio as $row)
                                                        <option value="{{ $row->Anio }}">Año 20{{ $row->Anio }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <input class="form-control" type="text" placeholder="Buscar..." wire:model="search" />
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                                    <select  class="form-control" wire:model="perPage">
                                                        <option value="5" selected>Mostrar 5 por página</option>
                                                        <option value="10">Mostrar 10 por página</option>
                                                        <option value="15">Mostrar 15 por página</option>
                                                        <option value="20">Mostrar 20 por página</option>
                                                        <option value="25">Mostrar 25 por página</option>
                                                        <option value="30">Mostrar 30 por página</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <center>
                                                        <button wire:click="clear" type="button" class="btn btn-danger active">X</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if($posts->count())
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="MultasIngresadas" class="table table-striped table-bordered" style="width:100%" > 
                                                <thead>
                                                    <tr> 
                                                        <th><center>N°</center></th>
                                                        <th><center>PLACA</center></th>
                                                        <th><center>DETALLES</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($posts as $post)
                                                    <tr>
                                                        <td><center>{{ $post->Parte }}</center></td>
                                                        <td><center>{{ $post->PlacaPatente }}</center></td>
                                                        <td> 
                                                            <center>
                                                                <button class="btn btn-primary" wire:click="M_Detalles({{ $post->Id_Multas }})">DETALLES</button>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row"> 
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <center>
                                                    <strong>No hay resultados para la búsqueda "{{ $search }}"</strong> 
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
                                </div>
                            @endif                
                        </div>
                        <div class="card-footer text-muted">
                        {{ $posts->links() }}
                        </div>	
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    @else
        <br>
        <center>
            <button class="btn btn-danger" wire:click="O_Detalles">VOLVER</button>
        </center>
        <br>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div id="Multa">  
                    <div class="card">
                        <div class="card-header">
                                    @foreach($Datos as $post) 
                                        <!--<div class="btn-group" style=" width:100%;">	
                                            <a href="{{ $post->Ruta }}" class="btn btn-primary active" target="_blank">
                                                PDF N°{{ $post->Parte }}
                                            </a>
                                        </div>-->

                                        <form method="POST" action="{{ route('MostrarMultaPDF') }}">   
                                            @csrf             
                                            <input type="hidden" name="ID" value="{{ $post->Id_Multas  }}">
                                            <div class="btn-group" style=" width:100%;">	
                                                <button type="submit" class="btn btn-primary active" formtarget="_blank">   PDF</button>
                                            </div>
                                        </form> 
                        </div> 
                        <div class="card-body">
                        <center><strong><h2>{{ $post->PlacaPatente }}</h2></strong></center> 
                        <hr>
                            <div class="table-responsive">
                                <table table class="table table-hover">
                                            @if($post->TipoNotificacion==3)
                                                <div class="form-group">
                                                    <center>TIPO NOTIFICACIÓN</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="ESCRITO" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <center>NOMBRE</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="{{ $post->NombresC }}&nbsp;{{ $post->ApellidosCiu }}" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>   
                                                <div class="form-group">
                                                    <center>RUT</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="{{ $post->RutCiudadano }}" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <center>PROFESIÓN</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="{{ $post->Profesion }}" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <center>NACIONALIDAD</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="{{ $post->NombreNac }}" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>      
                                                <div class="form-group">
                                                    <center>DOMICILIO</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="{{ $post->Domicilio }}" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>               
                                            @elseif($post->TipoNotificacion==2)
                                                <div class="form-group">
                                                    <center>TIPO NOTIFICACIÓN</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="Empadronado" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <center>TIPO NOTIFICACIÓN</center>
                                                    <div class="form-label-group"> 
                                                        <input type="text" class="form-control" value="POR ESCRITO" 
                                                        disabled style="background-color:#D3D3D3;">
                                                    </div>
                                                </div>    
                                            @endif
                                            <center><strong>DATOS VEHÍCULO</strong> </center>
                                            <hr>
                                            <div class="form-group">
                                                <center>TIPO VEHÍCULO</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->TipoVehiculo }}" 
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>      
                                            <div class="form-group">
                                                <center>MARCA</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control"value="{{ $post->Marca }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>      
                                            <div class="form-group">
                                                <center>MODELO</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->Modelo }}" 
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <center>COLOR</center>
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control" value="{{ $post->Color }}" 
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>                                    
                                            <hr> 
                                            <center><strong>DATOS CITACIÓN</strong></center>
                                            <hr> 
                                            <div class="form-group">
                                                <center>JUZGADO</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->NombreJuzgado }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <center>FECHA CITACIÓN</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->FechaCitacion }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div> 
                                            <hr>
                                                <center><strong>DATOS INFRACCIÓN</strong></center>
                                            <hr> 
                                            <div class="form-group"> 
                                                <center><label for="Modelo">DESCRIPCIÓN INFRACCIÓN</label></center>
                                                <div class="form-label-group"> 
                                                    <textarea class="md-textarea form-control" rows="3" disabled>{{ $post->descripcion }}</textarea>
                                                </div>
                                            </div> 
                                            <div class="form-group"> 
                                                <center><label for="Modelo">LUGAR DE INFRACCIÓN</label></center>
                                                <div class="form-label-group"> 
                                                    <textarea class="md-textarea form-control" rows="3" disabled>{{ $post->Lugar }}</textarea>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <center><label for="Lugar">FECHA INFRACCIÓN</label></center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->Fecha }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div> 
                                            <div class="form-group"> 
                                                <center><label for="Modelo">HORA INFRACCIÓN</label></center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->Hora }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <center>INFRACCIÓN ARTÍCULO</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->InfraccionArticulo }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <center>DECRETO O LEY</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->DecLey }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>
                                            <div class="form-group">	
                                                <center>DETALLES</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->DetallesDecLey }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div> 
                                            </div>
                                        @endforeach   
                                        @foreach($Testigo as $post)
                                            <div class="form-group">
                                                <center><label for="Lugar">TESTIGO</label></center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->Nombres }}&nbsp;{{ $post->Apellidos }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div>
                        
                                        @if($Imagenes!='[]')
                                            @foreach($Imagenes as $post) 
                                                <tr>
                                                    <td> 
                                                        <center>
                                                            <a href="{{ $post->RutaImagen }}" download>
                                                                <img src="{{ $post->RutaImagen }}" alt="Foto" width="500" height="500"/>
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
                                            <hr>        
                                    @endforeach
                                </table> 
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <form method="POST" action="{{ route('MultaPDFSoloID') }}">   
                                @csrf             
                                <input type="hidden" name="IdMultaIngresada" value=" {{ $Id_Multas }} ">
                                <div class="btn-group" style=" width:100%;">	
                                    <button type="submit" class="btn btn-success active" formtarget="_blank">Imprimir Multa</button>
                                </div>
                            </form> 
                        </div> 
                    </div>    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
        </div>
    @endif
</div>


 