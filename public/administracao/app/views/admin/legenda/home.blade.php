@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Legendas</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraLegenda')}}" class="btn btn-default">Nova Legenda</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Legenda</td>							
							<td></td>
							<td></td>
						</tr>
						@if(isset($legendas))
							@foreach($legendas as $legenda)
								<tr>
									<td>{{$legenda->id}}</td>
									<td>{{$legenda->legenda}}</td>							
									<td><a href="{{Route('admin.editaLegenda',$legenda->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaLegenda',$legenda->id)}}" class="fa fa-times"></a></td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$legendas->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop