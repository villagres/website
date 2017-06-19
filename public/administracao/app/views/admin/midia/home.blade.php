 @extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Na Mídia</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.cadastraMidia')}}" class="btn btn-default">Novo Na Mídia</a></div>
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
						@if(isset($midias))
							@foreach($midias as $midia)
								<tr>
									<td>{{$midia->id}}</td>
									<td>{{$midia->titulo}}</td>
									<td>{{$midia->olho}}</td>														
									<td><a href="{{Route('admin.editaMidia',$midia->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaMidia',$midia->id)}}" class="fa fa-times"></a></td>
								</tr>	
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$midias->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop