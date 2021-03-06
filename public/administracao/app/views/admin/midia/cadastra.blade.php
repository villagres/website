@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Na Mídia</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaMidia')}}" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-2"><span>Título:</span></div>
					<div class="col-md-10"><input type="text" id="titulo" name="titulo"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Título Ingles:</span></div>
					<div class="col-md-10"><input type="text" id="titulo_en" name="titulo_en"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Olho:</span></div>
					<div class="col-md-10"><input type="text" id="olho" name="olho"></div>				
				</div>
				<div class="row">
					<div class="col-md-2"><span>Olho Ingles:</span></div>
					<div class="col-md-10"><input type="text" id="olho_en" name="olho_en"></div>				
				</div>
				<div class="row">
					<div class="col-md-2"><span>Imagem:</span></div>
					<div class="col-md-10"><input type="file" id="imagem" name="imagem"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Texto:</span></div>
					<div class="col-md-10">
						<textarea name="texto" id="texto" rows="10" cols="80">			
			            </textarea>
			            <script>
			                $(function(){
							   CKEDITOR.replace( 'texto',{filebrowserBrowseUrl:roxyFileman,
							                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
							                                removeDialogTabs: 'link:upload;image:upload'}); 
							});
			            </script>
						<?php 
							/*
							$oFCKeditor = new FCKeditor('texto');						
							$oFCKeditor->BasePath = "/fckeditor/";		
							$oFCKeditor->Height = '300';
							echo $oFCKeditor->CreateHtml();
							*/
						?>						
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Texto Ingles:</span></div>
					<div class="col-md-10">
						<textarea name="texto_en" id="texto_en" rows="10" cols="80">			
			            </textarea>
			            <script>
			                $(function(){
							   CKEDITOR.replace( 'texto_en',{filebrowserBrowseUrl:roxyFileman,
							                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
							                                removeDialogTabs: 'link:upload;image:upload'}); 
							});
			            </script>
						<?php 
							/*
							$oFCKeditor = new FCKeditor('texto_en');						
							$oFCKeditor->BasePath = "/fckeditor/";		
							$oFCKeditor->Height = '300';
							echo $oFCKeditor->CreateHtml();
							*/
						?>						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.midias')}}" class="btn btn-danger">Cancelar</a></div>
				</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop