@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Matérias</h1>					
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraMateria')}}" class="btn btn-default">Nova Matéria</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Título</td>							
							<td>Olho</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($materias))
							@foreach($materias as $materia)
								<tr>
									<td>{{$materia->id}}</td>
									<td>{{$materia->titulo}}</td>									
									<td>{{$materia->olho}}</td>
									<td><a href="{{Route('admin.editaMateria',$materia->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaMateria',$materia->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$materias->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop