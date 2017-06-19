@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Departamento</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaDepartamento')}}">
				@if(isset($departamento))					
					<div class="row">
						<div class="col-md-2"><span>Departamento:</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$departamento['id']}}">
							<input type="text" id="departamento" name="departamento" value="{{$departamento['departamento']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>E-mail:</span></div>
						<div class="col-md-10"><input type="text" id="email" name="email" value="{{$departamento['email']}}"></div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.departamentos')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop