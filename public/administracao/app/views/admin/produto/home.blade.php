@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Produtos</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraProduto')}}" class="btn btn-default">Novo Produto</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>							
							<td>Referência</td>
							<td>Texto</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($produtos))
							@foreach($produtos as $produto)
								<tr>
									<td>{{$produto->id}}</td>							
									<td>{{$produto->referencia}}</td>
									<td>{{substr($produto->texto,0,150).'...'}}</td>
									<td><a href="{{Route('admin.editaProduto',$produto->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaProduto',$produto->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$produtos->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop