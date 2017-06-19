@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Departamento</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaDepartamento')}}" method="POST">
				<div class="row">
					<div class="col-md-2"><span>Departamento:</span></div>
					<div class="col-md-10"><input type="text" id="departamento" name="departamento"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>E-mail:</span></div>
					<div class="col-md-10"><input type="text" id="email" name="email"></div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.departamentos')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop