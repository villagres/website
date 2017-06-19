@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Produto</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaProduto')}}" method="POST">
				<div class="row">
					<div class="col-md-2"><span>Coleção:</span></div>
					<div class="col-md-10">
						<select name="colecao" id="colecao">
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
					<div class="col-md-2"><span>Linha:</span></div>
					<div class="col-md-10">
						<select name="linha" id="linha">
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
					<div class="col-md-2"><span>Formato:</span></div>
					<div class="col-md-10">
						<select name="formato" id="formato">
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
					<div class="col-md-2"><span>Acabamento:</span></div>
					<div class="col-md-10">
						<select name="acabamento" id="acabamento">
							<option value="">Selecione</option>
							@if(isset($acabamentos))
								@foreach($acabamentos as $acabamento)
									<option value="{{$acabamento->id}}">{{$acabamento->filtro}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Referência:</span></div>
					<div class="col-md-10"><input type="text" id="referencia" name="referencia"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Texto:</span></div>
					<div class="col-md-10">
						<?php 
							$oFCKeditor = new FCKeditor('texto');						
							$oFCKeditor->BasePath = "/fckeditor/";		
							$oFCKeditor->Height = '300';
							echo $oFCKeditor->CreateHtml();
						?>						
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Legendas:</span></div>
					<div class="col-md-10">
						<select name="legendas" id="legendas" multiple>
							<option value="">Selecione</option>
							@if(isset($legendas))
								@foreach($legendas as $legenda)
									<option value="{{$legenda->id}}">{{$legenda->legenda}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Faces:</span></div>
					<div class="col-md-10"><input type="file" id="faces[]" name="faces[]"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Imagens:</span></div>
					<div class="col-md-10"><input type="file" id="imagens[]" name="imagens[]"></div>
				</div>
				<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.produtos')}}" class="btn btn-danger">Cancelar</a></div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop