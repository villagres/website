@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Filtros</h1>					
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraFiltro')}}" class="btn btn-default">Novo filtro</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Tipo</td>
							<td>Filtro</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($filtros))
							@foreach($filtros as $filtro)
								<tr>
									<td>{{$filtro->id}}</td>
									<td>{{$filtro->tipo}}</td>
									<td>{{$filtro->filtro}}</td>
									<td><a href="{{Route('admin.editaFiltro',$filtro->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaFiltro',$filtro->id)}}" class="fa fa-times"></a></td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$filtros->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop