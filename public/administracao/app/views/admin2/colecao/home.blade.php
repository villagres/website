@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Coleções</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraColecao')}}" class="btn btn-default">Nova Coleção</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Coleção</td>
							<td>Texto</td>							
							<td></td>
							<td></td>
						</tr>
						@if(isset($colecoes))
							@foreach($colecoes as $colecao)
								<tr>
									<td>{{$colecao->id}}</td>
									<td>{{$colecao->colecao}}</td>
									<td>{{$colecao->texto}}</td>							
									<td><a href="{{Route('admin.editaColecao',$colecao->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaColecao',$colecao->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$colecoes->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop