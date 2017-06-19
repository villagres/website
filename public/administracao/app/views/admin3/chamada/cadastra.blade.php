@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Chamadas</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaChamada')}}" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-2"><span>Nome:</span></div>
					<div class="col-md-10"><input type="text" id="nome" name="nome"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Imagem:</span></div>
					<div class="col-md-10"><input type="file" id="imagem" name="imagem"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Matéria:</span></div>
					<div class="col-md-10">
						<select name="materia" id="materia">
							<option value="">Selecione</option>
							@if(isset($materias))
								@foreach($materias as $materia)
									<option value="{{$materia->id}}">{{$materia->titulo}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.chamadas')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>			
		</div>
	</div>
	@include('layout.rodape')
@stop