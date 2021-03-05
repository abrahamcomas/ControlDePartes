<div class="row">
  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
	    <br> 
        <center>
          <h3> 
            <center>
              <strong>Tipos Articulos</strong>
            </center>
          </h3> 
        </center>
	    @include('messages')  
      	<div class="form-group">
        	<div class="form-label-group">
          		<select class="form-control" size="7" wire:model="ID_Articulo" required>
            		@foreach ($TipoArticulos as $row)
              			<option value="{{ $row->id_Articulo }}">{{ $row->NombreArt }}</option>
            		@endforeach
          		</select> 
        	</div>
      	</div>   
          
      	<div class="form-group">
        	<center><label for="Domicilio">AGREGAR</label></center>
        	<div class="form-label-group"> 
          		<input class="form-control" type="text" wire:model="ArticuloIngr">
        	</div>
      	</div> 
        <center>
           <button type="button" class="btn btn-info active" wire:click="Agregar">Agregar</button>
        </center> 
        <center>
        	<strong>
        		<br>
        		<h3><p style="color:#FF0000";>{{ $Resultado }}</p></h3>
        	</strong>  
        </center>    
  	</div>
  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
</div>

 
