@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Matérias</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaMateria')}}" method="POST">
				<div class="row">
					<div class="col-md-2"><span>Título destaque:</span></div>
					<div class="col-md-10"><input type="text" id="titDestaque" name="titDestaque"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Imagem destaque:</span></div>
					<div class="col-md-10"><input type="file" id="imgDestaque" name="imgDestaque"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Título:</span></div>
					<div class="col-md-10"><input type="text" id="titulo" name="titulo"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Imagem miniatura:</span></div>
					<div class="col-md-10"><input type="file" id="imgMiniatura" name="imgMiniatura"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Olho:</span></div>
					<div class="col-md-10"><input type="text" id="olho" name="olho"></div>
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
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.materias')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop