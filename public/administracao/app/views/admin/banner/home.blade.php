@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Banners</h1>
				</div>
				<div class="col-md-3 btn-novo">
					<a href="{{Route('admin.cadastraBanner')}}" class="btn btn-default">Novo Banner</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Banner</td>
							<td></td>
							<td></td>
						</tr>
						@if(isset($banners))
							@foreach($banners as $banner)
								<tr>
									<td>{{$banner->id}}</td>
									<td>
										@if($banner->imagem != '')
											<img src="{{'/img/banner/'.$banner->imagem}}">
										@endif
									</td>
									<td><a href="{{Route('admin.editaBanner',$banner->id)}}" class="fa fa-pencil"></a></td>
									<td><a href="{{Route('admin.apagaBanner',$banner->id)}}" class="fa fa-times"></a></td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$banners->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop