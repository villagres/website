@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Coleção</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaColecao')}}" method="POST" enctype="multipart/form-data">
				@if(isset($colecao))					
					<div class="row">
						<div class="col-md-2"><span>Coleção:</span></div>
						<div class="col-md-10">
							<input type="hidden" id name="id" value="{{$colecao['id']}}">
							<input type="text" id="colecao" name="colecao" value="{{$colecao['colecao']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Texto:</span></div>
						<div class="col-md-10">
							<?php 
								$oFCKeditor = new FCKeditor('texto');						
								$oFCKeditor->BasePath = "/fckeditor/";		
								$oFCKeditor->Height = '300';
								$oFCKeditor->Value = $colecao['texto'];
								echo $oFCKeditor->CreateHtml();
							?>							
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem:</span></div>
						<div class="col-md-5"><input type="file" id="imagem" name="imagem"></div>
						@if($colecao['imagem'] != '')
							<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/colecao/'.$colecao['imagem']}}" alt="Coleção"></div>
							<div class="col-md-1"><a href="{{Route('admin.removeColecaoFile',$colecao->id)}}" class="fa fa-times"></a></div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.colecoes')}}" class="btn btn-danger">Cancelar</a></div>
					</div>				
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop