@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Chamadas</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaChamada')}}">
				@if(isset($chamada))					
					<div class="row">
						<div class="col-md-2"><span>Nome:</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$chamada['id']}}">
							<input type="text" id="nome" name="nome" value="{{$chamada['nome']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem:</span></div>
						<div class="col-md-5">
							<input type="file" id="imagem" name="imagem">								
						</div>
						<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/chamada/'.$chamada['imagem']}}" alt="Chamada"></div>
						<div class="col-md-1"><a href="" class="fa fa-times"></a></div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Matéria:</span></div>
						<div class="col-md-10">
							<select name="materia" id="materia">
								<option value="">Selecione</option>
								@if(isset($materias))
									@foreach($materias as $materia)
										<option value="{{$materia->id}}" {{$chamada['materia'] == $materia->id ? "selected" : ''}}>{{$materia->titulo}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.chamadas')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop