@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Na Mídia</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaMidia')}}" method="POST" enctype="multipart/form-data">
				@if(isset($midia))					
					<div class="row">
						<div class="col-md-2"><span>Título:</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$midia['id']}}">
							<input type="text" id="titulo" name="titulo" value="{{$midia['titulo']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Título Ingles:</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$midia['id']}}">
							<input type="text" id="titulo_en" name="titulo_en" value="{{$midia['titulo_en']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Olho:</span></div>
						<div class="col-md-10"><input type="text" id="olho" name="olho" value="{{$midia['olho']}}"></div>				
					</div>
					<div class="row">
						<div class="col-md-2"><span>Olho Ingles:</span></div>
						<div class="col-md-10"><input type="text" id="olho_en" name="olho_en" value="{{$midia['olho_en']}}"></div>				
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem:</span></div>
						<div class="col-md-5"><input type="file" id="imagem" name="imagem"></div>
						@if($midia['imagem'] != '')
							<div class="col-md-1"><img src="{{'/img/midia/'.$midia['imagem']}}" alt="Mídia"></div>
							<div class="col-md-1"><a href="{{Route('admin.removeMidiaFile',$midia->id)}}" class="fa fa-times"></a></div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-2"><span>Texto:</span></div>
						<div class="col-md-10">
							<textarea name="texto" id="texto" rows="10" cols="80">			                
								<?php echo $midia['texto']; ?>
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
								$oFCKeditor->Value = $midia['texto'];
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
								<?php echo $midia['texto_en']; ?>
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
								$oFCKeditor->Value = $midia['texto_en'];
								$oFCKeditor->Height = '300';
								echo $oFCKeditor->CreateHtml();
								*/
							?>							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.midias')}}" class="btn btn-danger">Cancelar</a></div>
					</div>					
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop