<div class="row">
	<div class="col-md-12">
		<nav class="navbar navbar-static-top topo">
  			<div class="container">
  				<div class="row">
  					<div class="col-md-2">
  						<img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/logo.png'}}" alt="Logo">		
  					</div>
  					<div class="col-md-8">
  						<span>Bem vindo, {{strtoupper(Auth::user()->nome)}}</span>
  					</div>
  					<div class="col-md-2">
  						<a class="btn btn-default" href="/logout">Sair</a>
  					</div>
  				</div>
  			</div>
		</nav>	
	</div>
</div>