@extends('App')
@section('content')
<div class="container-fluid">  
	<body onLoad="redireccionar()">
		<center><h3>Liquidaciones de Sueldo</h3></center> 
		<hr style="width:100%; border-color: green;">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading"> 
						<center><h3>Sesión expirada</h3></center>
					</div>
					<div class="panel-body"> 
					</div> 
				</div> 		
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
		</div>
	</body>
</div>
@endsection      
@section('scripts')
<script type="text/javascript">
  function redireccionar() {
    setTimeout("location.href='{{ route('Index') }}'", 2000);
  }
</script>
@endsection     