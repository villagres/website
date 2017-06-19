@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Usuários</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraUsuario')}}" class="btn btn-default">Novo Usuário</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Nome</td>
							<td>E-mail</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($usuarios))
							@foreach($usuarios as $usuario)
								<tr>
									<td>{{$usuario->id}}</td>
									<td>{{$usuario->nome}}</td>
									<td>{{$usuario->email}}</td>
									<td><a href="{{Route('admin.editaUsuario',$usuario->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaUsuario',$usuario->id)}}" class="fa fa-times"></a></td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$usuarios->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop