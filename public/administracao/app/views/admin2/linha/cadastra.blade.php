@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Linha</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaLinha')}}" method="POST">
				<div class="row">
					<div class="col-md-2"><span>Linha:</span></div>
					<div class="col-md-10"><input type="text" id="linha" name="linha"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Imagem:</span></div>
					<div class="col-md-10"><input type="file" id="imagem" name="imagem"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Coleção:</span></div>
					<div class="col-md-10"><select name="colecao" id="colecao">
							<option value="">Selecione</option>
							@if(isset($colecoes))
								@foreach($colecoes as $colecao)
									<option value="{{$colecao->id}}">{{$colecao->colecao}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Formato:</span></div>
					<div class="col-md-10"><select name="formato" id="formato" multiple>
							<option value="">Selecione</option>
							@if(isset($formatos))
								@foreach($formatos as $formato)
									<option value="{{$formato->id}}">{{$formato->filtro}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.linhas')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop