<div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            @include('messages')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
	@if($Principal==0) 
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="col">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <center><strong><h2>MULTAS</h2></strong></center> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table table class="table table-hover">
                                    <thead>
                                        <tr> 
                                            <th><center>N°</center></th>
                                            <th><center>Placa</center></th>
                                            <th><center>Detalles</center></th>
                                            <th><center>PDF</center></th>
                                            <th><center>Firmar</center></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($posts as $post)
                                        <tr>
                                            <td><center>{{ $post->Id_Juzgado }}{{ $post->NumeroParte }}</center></td>
                                            <td><center>{{ $post->PlacaPatente  }}</center></td>
                                            <td> 
                                                <center>
                                                    <button class="btn btn-success active" wire:click="M_Detalles({{ $post->Id_Multas }})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                                                        <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z"/>
                                                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z"/>
                                                        </svg>
                                                    </button>
                                                </center>
                                            </td>
                                        @if($post->Firma==0)
                                            <td>    
                                                <center>
                                                    <a href="{{ route('ReportePdfJuzgado',['Id_Multas'=>$post->Id_Multas]) }}" class="btn btn-danger active" target="_blank">
                                                       PDF
                                                    </a>
                                                </center>
                                            </td>
                                            <td>    
                                                <center>
                                                    <button class="btn btn-danger active" wire:click="ConfirmarIng({{ $post->Id_Multas }})">
                                                        Pendiente
                                                    </button>
                                                </center>
                                            </td>
                                        @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $posts->links() }}
                        </div>	
                    </div> 
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        </div>
    @endif 
    @if($Detalles==1) 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="col">
                    <div class="card bg-light mb-3" >
                        <div class="card-header">
                            <div class="btn-group" style=" width:100%;">	
                                <button class="btn btn-danger active" wire:click="VolverDetalles">
                                    Volver
                                </button>
                            </div>
                        </div>
                        @foreach ($Datos as $post)
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
                                                <center>Juzgado</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->NombreJuzgado }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <center>Fecha Citación</center>
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
                                                <center><label for="Modelo">Lugar De Infracción</label></center>
                                                <div class="form-label-group"> 
                                                    <textarea class="md-textarea form-control" rows="3" disabled>{{ $post->Lugar }}</textarea>
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
                                                <center>Infracción Artículo</center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->InfraccionArticulo }}"
                                                    disabled style="background-color:#D3D3D3;">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <center><label for="Lugar">FECHA INFRACCIÓN</label></center>
                                                <div class="form-label-group"> 
                                                    <input type="text" class="form-control" value="{{ $post->Fecha }}"
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
                            <div class="btn-group" style=" width:100%;">	
                                <button class="btn btn-danger active" wire:click="VolverDetalles">
                                    Volver
                                </button>
                            </div>	      
                        </div>	
                    </div>
                </div>                                          
	        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        </div>
    @endif 
        <div  id="MostrarFor" style="display:none">
            <center> 
                <img src="{{URL::asset('Imagenes/12.gif')}}" width="220" height="220"/>
                <h5><strong>Firmando archivo, espere por favor...</strong></h5>
            </center>
        </div>
	@if($ConfirmarIngreso==1)  
        <br>
        <div class="row" id="IngresoFirma">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="col">
                    <div class="card bg-light mb-3" >
                        <div class="card-header">
                            <center><h5>¿DESEA FIRMAR DOCUMENTO?</h5></center> 
                            @include('messages')
                        </div>   
                        <div class="card-body">
                            <form method="POST" action="{{ route('ConfirmarFirma') }}">
                                @csrf   
                                <center><label><strong>Al firmar el documento confirma el envío al tribunal de turno.</strong></label></center>
                                <br>
                                <input type="hidden" class="form-control" name="ID_Multa" value="{{ $Id_Multas }}"  >

                                    @foreach($TipoFirma as $post) 
                                        @if($post->TipoFirma==1)
                                            <center><label><strong>Firma atendida</strong></label></center>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="OTP"  placeholder="Ingrese OTP" autocomplete="off">
                                            </div>
                                            <hr>
                                        @else
                                            <center><label><strong>Firma desatendida</strong></label></center>
                                        @endif
                                    @endforeach
                                <div class="form-label-group">
                                    <input type="password" class="form-control" name="Contrasenia"  placeholder="Confirme Contraseña Usuario" autocomplete="off">
                                </div>
                                <br>
                            	<center>
                                    <button type="submit" id="btnEnviar1" class="btn btn-success active btn-info">Aceptar</button>
                                </center>
                            </form>   
                        </div> 
                        <div class="btn-group">
                            <button class="btn btn-danger btn-lg" id="CancelarConfirmarIngreso"  wire:click="CancelarConfirmarIngreso">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        </div>
    @endif  
</div>

  