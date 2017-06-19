@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9"><h1>Gerenciamento de Representantes</h1></div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraRepresentante')}}" class="btn btn-default">Novo Representante</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Nome</td>
							<td>Estado</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($representantes))
							@foreach($representantes as $representante)
								<tr>
									<td>{{$representante->id}}</td>
									<td>{{$representante->nome}}</td>
									<td>{{$representante->estado}}</td>
									<td><a href="{{Route('admin.editaRepresentante',$representante->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaRepresentante',$representante->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif 
					</table>										
				</div>				
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$representantes->links()}}		
				</div>	
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop