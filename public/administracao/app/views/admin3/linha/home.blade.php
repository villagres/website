@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Linhas</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraLinha')}}" class="btn btn-default">Nova Linha</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Linha</td>														
							<td></td>
							<td></td>
						</tr>
						@if(isset($linhas))
							@foreach($linhas as $linha)
								<tr>
									<td>{{$linha->id}}</td>
									<td>{{$linha->linha}}</td>														
									<td><a href="{{Route('admin.editaLinha',$linha->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaLinha',$linha->id)}}" class="fa fa-times"></a></td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$linhas->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop