@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Matérias</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaMateria')}}" method="POST">
				@if(isset($materia))					
					<div class="row">
						<div class="col-md-2"><span>Título destaque:</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$materia['id']}}">
							<input type="text" id="tituloDestaque" name="tituloDestaque" value="{{$materia['tituloDestaque']}}">
						</div>
					</div>
					@if($materia['imagemDestaque'] != '')
					<div class="row">
						<div class="col-md-2"><span>Imagem destaque:</span></div>
						<div class="col-md-5">
							<input type="file" id="imagemDestaque" name="imagemDestaque">
						</div>
						<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/materia/'.$materia['imagemDestaque']}}" alt="Matéria"></div>
						<div class="col-md-1"><a href="" class="fa fa-times"></a></div>
					</div>
					@endif
					<div class="row">
						<div class="col-md-2"><span>Título:</span></div>
						<div class="col-md-10"><input type="text" id="titulo" name="titulo" value="{{$materia['titulo']}}"></div>
					</div>
					@if($materia['imagemMiniatura'] != '')
					<div class="row">
						<div class="col-md-2"><span>Imagem miniatura:</span></div>
						<div class="col-md-5">
							<input type="file" id="imagemMiniatura" name="imagemMiniatura">
						</div>
						<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/materia/'.$materia['imagemMiniatura']}}" alt="Matéria"></div>
						<div class="col-md-1"><a href="" class="fa fa-times"></a></div>
					</div>
					@endif
					<div class="row">
						<div class="col-md-2"><span>Olho:</span></div>
						<div class="col-md-10"><input type="text" id="olho" name="olho" value="{{$materia['olho']}}"></div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Texto:</span></div>
						<div class="col-md-10">
							<?php 
								$oFCKeditor = new FCKeditor('informacoes');						
								$oFCKeditor->BasePath = "/fckeditor/";		
								$oFCKeditor->Value = $materia['texto'];
								$oFCKeditor->Height = '300';
								echo $oFCKeditor->CreateHtml();
							?>																	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.materias')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop