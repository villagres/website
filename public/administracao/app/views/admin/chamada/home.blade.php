@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Chamadas</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraChamada')}}" class="btn btn-default">Nova Chamada</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Nome</td>
							<td>Imagem</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($chamadas))
							@foreach($chamadas as $chamada)
								<tr>
									<td>{{$chamada->id}}</td>
									<td>{{$chamada->nome}}</td>
									<td>
										@if($chamada->imagem != '')
											<img src="{{'/img/chamada/'.$chamada->imagem}}">
										@endif
									</td>
									<td><a href="{{Route('admin.editaChamada',$chamada->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaChamada',$chamada->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$chamadas->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop