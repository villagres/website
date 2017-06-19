@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Coleção</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaColecao')}}" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-2"><span>Coleção:</span></div>
					<div class="col-md-10"><input type="text" id="colecao" name="colecao"></div>
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
					<div class="col-md-2"><span>Imagem:</span></div>
					<div class="col-md-10"><input type="file" id="imagem" name="imagem"></div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.colecoes')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop