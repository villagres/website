@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de usuário</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaUsuario')}}" method="POST">
				<div class="row">
					<div class="col-md-2"><span>Nome:</span></div>
					<div class="col-md-10"><input type="text" id="nome" name="nome"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>E-mail:</span></div>
					<div class="col-md-10"><input type="text" id="email" name="email"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Senha:</span></div>
					<div class="col-md-10"><input type="password" id="senha" name="senha"></div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.usuarios')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop