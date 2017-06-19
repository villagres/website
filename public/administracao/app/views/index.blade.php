@extends('layout.master')

@section('title','Administração')

@section('content')
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">			
			<div class="login">
				<form action="" method="POST">
				<div class="row">
					<div class="col-md-12">
						<h1><img src="img/logo.png" alt="Logo"></h1>
					</div>					
				</div>
				<div class="row">					
					<div class="col-md-12"><input type="text" id="txtLogin" name="txtLogin" placeholder="Entre com o login"></div>
				</div>
				<div class="row">
					
					<div class="col-md-12"><input type="password" id="txtSenha" name="txtSenha" placeholder="Entre com a senha"></div>
				</div>
				<div class="row">
					<div class="col-md-12"><input type="submit" class="btn btn-default"></input></div>
				</div>
				</form>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
@stop