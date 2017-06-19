@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Departamentos</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraDepartamento')}}" class="btn btn-default">Novo Departamento</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Departamento</td>
							<td>E-mail</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($departamentos))
							@foreach($departamentos as $departamento)
								<tr>
									<td>{{$departamento->id}}</td>
									<td>{{$departamento->departamento}}</td>
									<td>{{$departamento->email}}</td>
									<td><a href="{{Route('admin.editaDepartamento',$departamento->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaDepartamento',$departamento->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$departamentos->links()}}
				</div>
			</div>			
		</div>
	</div>
	@include('layout.rodape')
@stop