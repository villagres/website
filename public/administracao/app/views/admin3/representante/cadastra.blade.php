@extends('layout.master')

@section('title','Administração')

@section('content')	
	@include('layout.topo')
	<div class="row">		
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Cadastro de Representante</h1>	
				</div>
			</div>
			<form action="{{Route('admin.gravaRepresentante')}}" method="POST">
			<div class="row">
				<div class="col-md-2">
					<span>Nome:</span>					
				</div>
				<div class="col-md-10"><input type="text" id="nome" name="nome"></div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<span>Estado:</span>					
				</div>
				<div class="col-md-10">
					<select name="estado" id="estado">
						<option value="">Selecione</option>
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapá</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceará</option>
						<option value="DF">Distrito Federal</option>
						<option value="ES">Espírito Santo</option>
						<option value="GO">Goiás</option>
						<option value="MA">Maranhão</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Pará</option>
						<option value="PB">Paraíba</option>
						<option value="PR">Paraná</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piauí</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RO">Rondônia</option>
						<option value="RR">Roraima</option>
						<option value="SC">Santa Catarina</option>
						<option value="SP">São Paulo</option>
						<option value="SE">Sergipe</option>
						<option value="TO">Tocantins</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><span>Informações:</span></div>
				<div class="col-md-10">
					<?php 
						$oFCKeditor = new FCKeditor('informacoes');						
						$oFCKeditor->BasePath = "/fckeditor/";		
						$oFCKeditor->Height = '300';
						echo $oFCKeditor->CreateHtml();
					?>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.representantes')}}" class="btn btn-danger">Cancelar</a></div>
			</div>
			</form>
		</div>
	</div>
	@include('layout.rodape')	
@stop