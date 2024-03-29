@extends('App')
@section('content') 
<br>
<div class="container-fluid">  
	<div class="row"> 
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
            <div class="col">
                <div class="card bg-light mb-3"> 
                    <div class="card-header">
                        <center><h5><strong>Lista </strong></h5></center> 
                    </div> 
                    <div class="card-body">
                        <div class="table-responsive">
                            <table table class="table table-hover">
                                <thead>
                                    <tr> 
                                        <th><center>Dispositivos</center></th>
                                        <th><center>IP</center></th>
                                        <th><center>Ultima Actividad</center></th>
                                        <th><center>Eliminar</center></th>
                                    </tr> 
                                </thead>
                                <tbody>  
                                    @foreach($sessiones as $post)
                                    <tr>
                                        <td><center>{{ $post->user_agent }}</center></td>
                                        <td><center>{{ $post->ip_address  }}</center></td>
                                        <td><center> {{ \Carbon\Carbon::createFromTimeStamp($post->last_activity)->diffForhumans() }} </center></td>
                                        <td><form method="POST" action="{{ route('EliminarVinculo') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $post->id }}" >
                                            <button type="submit" class="btn btn-danger active btn-info">Eliminar</button>
                                        </form></td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted">

                    </div>	
                </div> 
            </div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
	</div>
</div>
@endsection  