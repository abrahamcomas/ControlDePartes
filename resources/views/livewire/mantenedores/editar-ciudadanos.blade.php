<div>
  <div class="row"> 
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
      <div class="card bg-light mb-3">
        <div class="card-body">
          @include('messages') 
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
  </div>
  @if($VariableVista==3)
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card bg-light mb-3">
          <div class="card-header">
            <center><strong><h5>BUSCAR</h5></strong></center>
          </div>
          <div class="card-body">
            <div class="form-label-group"> 
              <input type="text" class="form-control" wire:model="Rut" oninput="checkRut(this)" placeholder="Ingrese Rut" autocomplete="off">
            </div>
          </div>
          <div class="card-footer text-muted">
            <div class="btn-group" style=" width:100%;">	
              <button type="button" class="btn btn-info active" wire:click="Buscar">Buscar</button>
            </div>   
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
  @endif
    <div class="row" wire:loading.delay wire:target="Buscar">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card bg-light mb-3">
          <div class="card-body">
            <center><strong><h2>Buscando Ciudadano/a...</h2></strong></center>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
  @if($VariableVista==1)
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card bg-light mb-3">
          <div class="card-header">
            @if($VariableVista==1)
              <center><strong><h5>{{ $RutBuscado }}</h5></strong></center>
            @endif 
          </div>
          <div class="card-body">
            <div class="form-group">
              <center><label for="Nombres">NOMBRES</label></center>
              <div class="form-label-group"> 
                <input type="text" class="form-control" wire:model="NombresC">
              </div>
            </div>    
            <div class="form-group">
              <center><label for="Apellidos">APELLIDOS</label></center>
              <div class="form-label-group"> 
                <input type="text" class="form-control" wire:model="Apellidos">
              </div>
            </div>    
            <div class="form-group">
              <center><label for="Profesion">PROFESIÓN</label></center>
              <div class="form-label-group"> 
                <input type="text" class="form-control" wire:model="Profesion">
              </div>
            </div>  
            <div class="form-group">
              <center><label for="Nacionalidad">NACIONALIDAD <strong>({{ $NombreNac }})</strong></label></center>
              <div class="form-label-group">
                <select class="form-control" size="3" wire:model="ID_Nacionalidad" required>
                  @foreach ($Nacionalidad as $row)
                    <option value="{{ $row->id_Nacionalidad }}">{{ $row->NombreNac }}</option>
                  @endforeach
                </select> 
              </div>
            </div>   
            <div class="form-group">
              <center><label for="FechaNacimiento">FECHA NACIMIENTO</label></center>
              <div class="form-label-group"> 
                <input type="date" class="form-control" wire:model="FechaNacimiento">
              </div>
            </div>
            <div class="form-group">
              <center><label for="Domicilio">DOMICILIO</label></center>
              <div class="form-label-group"> 
                <input class="form-control" type="text" wire:model="Domicilio">
              </div>
            </div>              
          </div>
          <div class="card-footer text-muted">
            <div class="btn-group" style=" width:100%;">	
              <button type="button" class="btn btn-danger active" wire:click="Cancelar">Cancelar</button>
              <button type="button" class="btn btn-info active" wire:click="update">EDITAR</button>
            </div>   
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
      
    @elseif($VariableVista==0)
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
          <div class="card bg-light mb-3">
            <div class="card-body">
              <center><strong><h5>No Encontrado</h5></strong></center> 
            </div>
            <div class="card-footer text-muted">
              <div class="btn-group" style=" width:100%;">	
                <button type="button" class="btn btn-danger active" wire:click="Cancelar">Volver</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      </div>
    @elseif($VariableVista==4)
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
          <div class="card bg-light mb-3">
            <div class="card-body">
              <center><strong><h5>Actualizado Corectamente</h5></strong></center> 
            </div>
            <div class="card-footer text-muted">
              <div class="btn-group" style=" width:100%;">	
                <button type="button" class="btn btn-success active" wire:click="Cancelar">Aceptar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      </div>
    @endif

</div>

 
