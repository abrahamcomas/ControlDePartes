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
   <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
         <div class="card bg-light mb-3">
            <div class="card-header">
               <center><strong><h5>TIPOS ARTÍCULOS</h5></strong></center>
            </div> 
            <div class="card-body">
               <div id="global">
                  <table class="table table-striped table-bordered" style="height:15px;">
                     <tbody>
                        @foreach($TipoArticulos as $post)
                           <tr>
                              <td>
                                 <center>
                                    {{ $post->NombreArt }}
                                 </center>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table> 
               </div> 
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
   </div>
   <br>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
         <div class="card bg-light mb-3">
            <div class="card-body">
               <center><label for="Domicilio">AGREGAR</label></center>
               <div class="form-label-group"> 
                     <input class="form-control" type="text" wire:model="ArticuloIngr">
               </div>
            </div>
            <div class="card-footer text-muted">
            <div class="btn-group" style=" width:100%;">	
               <button type="button" class="btn btn-info active" wire:click="Agregar">Agregar</button>
            </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
         <div class="card bg-light mb-3">
            <div class="card-body">
            <strong><h5><p><center>{{ $Resultado }}</center></p></h5></strong>  
            </div>
         </div> 
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
   </div> 
</div>