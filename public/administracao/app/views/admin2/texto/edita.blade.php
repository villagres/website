@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Textos</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaTexto')}}">
				@if(isset($texto))					
					<div class="row">
						<div class="col-md-2"><span>Título</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$texto['id']}}">
							<input type="text" id="titulo" name="titulo" value="{{$texto['titulo']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem</span></div>
						<div class="col-md-5"><input type="file" id="imagem" name="imagem"></div>
						@if($texto['imagem'] != '')
							<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/texto/'.$texto['imagem']}}" alt="Texto"></div>
							<div class="col-md-1"><a href="" class="fa fa-times"></a></div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-2"><span>Texto</span></div>
						<div class="col-md-10">
							<?php 
								$oFCKeditor = new FCKeditor('informacoes');						
								$oFCKeditor->BasePath = "/fckeditor/";		
								$oFCKeditor->Value = $texto['texto'];
								$oFCKeditor->Height = '300';
								echo $oFCKeditor->CreateHtml();
							?>								
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.textos')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop