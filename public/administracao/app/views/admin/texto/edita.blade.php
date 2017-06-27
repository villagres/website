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
			<form action="{{Route('admin.gravaTexto')}}" method="POST" enctype="multipart/form-data">
				@if(isset($texto))					
					<div class="row">
						<div class="col-md-2"><span>Título</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$texto['id']}}">
							<input type="text" id="titulo" name="titulo" value="{{$texto['titulo']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Título Ingles</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$texto['id']}}">
							<input type="text" id="titulo_en" name="titulo_en" value="{{$texto['titulo_en']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem</span></div>
						<div class="col-md-5"><input type="file" id="imagem" name="imagem"></div>
						@if($texto['imagem'] != '')
							<div class="col-md-1"><img src="{{'/img/texto/'.$texto['imagem']}}" alt="Texto"></div>
							<div class="col-md-1"><a href="{{Route('admin.removeTextoFile',$texto->id)}}" class="fa fa-times"></a></div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-2"><span>Texto</span></div>
						<div class="col-md-10">
							<textarea name="informacoes" id="informacoes" rows="10" cols="80">
								<?php echo $texto['texto']; ?>
				            </textarea>
				            <script>
				                $(function(){
								   CKEDITOR.replace( 'informacoes',{filebrowserBrowseUrl:roxyFileman,
								                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
								                                removeDialogTabs: 'link:upload;image:upload'}); 
								});
				            </script>
							<?php 
								/*
								$oFCKeditor = new FCKeditor('informacoes');						
								$oFCKeditor->BasePath = "/fckeditor/";		
								$oFCKeditor->Value = $texto['texto'];
								$oFCKeditor->Height = '300';
								echo $oFCKeditor->CreateHtml();
								*/
							?>								
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Texto Ingles</span></div>
						<div class="col-md-10">
							<textarea name="informacoes_en" id="informacoes_en" rows="10" cols="80">                
								<?php echo $texto['texto_en']; ?>
				            </textarea>
				            <script>
				                $(function(){
								   CKEDITOR.replace( 'informacoes_en',{filebrowserBrowseUrl:roxyFileman,
								                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
								                                removeDialogTabs: 'link:upload;image:upload'}); 
								});
				            </script>
							<?php 
								/*
								$oFCKeditor = new FCKeditor('informacoes_en');						
								$oFCKeditor->BasePath = "/fckeditor/";		
								$oFCKeditor->Value = $texto['texto_en'];
								$oFCKeditor->Height = '300';
								echo $oFCKeditor->CreateHtml();
								*/
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