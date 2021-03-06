@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Legenda</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaLegenda')}}">
				@if(isset($legenda))					
					<div class="row">
						<div class="col-md-2"><span>Legenda</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$legenda['id']}}">
							<input type="text" id="legenda" name="legenda" value="{{$legenda['legenda']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem</span></div>
						<div class="col-md-5"><input type="file" id="imagem" name="imagem"></div>
						<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/legenda/'.$legenda['imagem']}}" alt="Legenda"></div>
						<div class="col-md-1"><a href="" class="fa fa-times"></a></div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.legendas')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop