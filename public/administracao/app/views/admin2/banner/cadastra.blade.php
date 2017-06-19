@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12"><h1>Cadastro de Banners</h1></div>
			</div>
			<form action="{{Route('admin.gravaBanner')}}" method="POST">
			<div class="row">
				<div class="col-md-2"><span>Banner:</span></div>
				<div class="col-md-10"><input type="file" id="banner" name="banner"></div>
			</div>
			<div class="row">
				<div class="col-md-2"><span>Linha:</span></div>
				<div class="col-md-10">
					<select name="fila" id="fila">
						<option value="">Selecione</option>
						@if(isset($linhas))
							@foreach($linhas as $linha)
								<option value="{{$linha->id}}">{{$linha->linha}}</option>
							@endforeach
						@endif
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.banners')}}" class="btn btn-danger">Cancelar</a></div>
			</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop