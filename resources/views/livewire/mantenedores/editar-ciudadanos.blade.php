<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
      @if($VariableVista==1)
         <center><strong><h2>CIUDADANO/A {{ $RutBuscado }}</h2></strong></center>
      @elseif($VariableVista==3)
        <center><strong><h2>BUSCAR CIUDADANO/A</h2></strong></center>
      @endif  
    <hr> 
    <div class="panel-body"> 
      @include('messages')  
      <div class="form-group"> 
        @if($VariableVista==3)
          <center><label for="Rut">RUT</label></center>
          <div class="form-label-group"> 
            <input type="text" class="form-control" wire:model="Rut" oninput="checkRut(this)" placeholder="Ingrese Rut" autocomplete="off">
          </div>
          <br>
          <center>
             <button type="button" class="btn btn-info active" wire:click="Buscar">Buscar</button>
          </center>
        @endif
      </div>
      
      <div wire:loading.delay wire:target="Buscar">
        <center>
          <h5><strong>Buscando Ciudadano/a...</strong></h5>
          <img src="{{ asset('Imagenes/Cargando.gif') }}" alt="Funny image">
        </center>
      </div>
      @if($VariableVista==1)
        <form>
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
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
               <center>
                <button type="button" class="btn btn-danger active" wire:click="Cancelar">Cancelar</button>
              </center> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <center>
                <button type="button" class="btn btn-info active" wire:click="update">EDITAR</button>
              </center> 
            </div>
          </div>                
        </form>
      @elseif($VariableVista==0)
        <hr>
          <h2>
            <center><strong>No Encontrado</strong></center> 
          </h2>
            <center>
              <button type="button" class="btn btn-success active" wire:click="Cancelar">Volver</button>
            </center>
       @elseif($VariableVista==4)
          <h2>
            <center><strong>Actualizado Corectamente</strong></center> 
          </h2>
           <center>
              <button type="button" class="btn btn-success active" wire:click="Cancelar">Aceptar</button>
            </center>
        <hr>
      @endif
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

 
