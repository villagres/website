@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de filtro</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaFiltro')}}" method="POST">
				<div class="row">
					<div class="col-md-2"><span>Tipo</span></div>
					<div class="col-md-10">
						<select name="tipo" id="tipo">
							<option value="">Selecione</option>
							<option value="acabamento">Acabamento</option>
							<option value="cor">Cor</option>
							<option value="formato">Formato</option>
							<option value="indicacao">Indicação de uso</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Filtro</span></div>
					<div class="col-md-10"><input type="text" id="filtro" name="filtro"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default">Enviar</button>
						<a href="{{Route('admin.filtros')}}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop