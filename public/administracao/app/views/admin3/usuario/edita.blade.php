@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de usuário</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaUsuario')}}" method="POST">
				@if(isset($usuario))					
					<div class="row">
						<div class="col-md-2"><span>Nome:</span></div>
						<div class="col-md-10">
							<input type="hidden" id="id" name="id" value="{{$usuario['id']}}">
							<input type="text" id="nome" name="nome" value="{{$usuario['nome']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>E-mail:</span></div>
						<div class="col-md-10"><input type="text" id="email" name="email" value="{{$usuario['email']}}"></div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Senha:</span></div>
						<div class="col-md-10"><input type="password" id="password" name="password" value="{{$usuario['password']}}"></div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.usuarios')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop