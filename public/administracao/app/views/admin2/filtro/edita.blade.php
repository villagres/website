@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de filtro</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaFiltro')}}">
				@if(isset($filtro))					
					<div class="row">
						<div class="col-md-2"><span>Tipo</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$filtro['id']}}">
							<select name="tipo" id="tipo">
								<option value="">Selecione</option>
								<option value="acabamento" {{$filtro['tipo'] == 'acabamento' ? "selected" : ''}}>Acabamento</option>
								<option value="cor" {{$filtro['tipo'] == 'cor' ? "selected" : ''}}>Cor</option>
								<option value="formato" {{$filtro['tipo'] == 'formato' ? "selected" : ''}}>Formato</option>
								<option value="indicacao" {{$filtro['tipo'] == 'indicacao' ? "selected" : ''}}>Indicação de uso</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Filtro</span></div>
						<div class="col-md-10"><input type="text" id="filtro" name="filtro" value="{{$filtro['filtro']}}"></div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-default">Enviar</button>
							<a href="{{Route('admin.filtros')}}" class="btn btn-danger">Cancelar</a>
						</div>
					</div>				
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop