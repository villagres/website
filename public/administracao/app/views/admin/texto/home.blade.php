@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de textos</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraTexto')}}" class="btn btn-default">Novo texto</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Título</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($textos))
							@foreach($textos as $texto)
								<tr>
									<td>{{$texto->id}}</td>
									<td>{{$texto->titulo}}</td>
									<td><a href="{{Route('admin.editaTexto',$texto->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaTexto',$texto->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$textos->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop