@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">		
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Representante</h1>	
				</div>
			</div>
			<form action="{{Route('admin.gravaRepresentante')}}" method="POST">			
			@if(isset($representante))				
				<div class="row">
					<div class="col-md-2">
						<span>Nome:</span>					
					</div>
					<div class="col-md-10">
						<input type="hidden" id="id" name="id" value="{{$representante['id']}}">
						<input type="text" id="nome" name="nome" value="{{$representante['nome']}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<span>Estado:</span>					
					</div>
					<div class="col-md-10">
						<select name="estado" id="estado">
							<option value="">Selecione</option>
							<option value="AC" {{$representante['estado'] == "AC" ? "selected" : ""}}>Acre</option>
							<option value="AL" {{$representante['estado'] == "AL" ? "selected" : ""}}>Alagoas</option>
							<option value="AP" {{$representante['estado'] == "AP" ? "selected" : ""}}>Amapá</option>
							<option value="AM" {{$representante['estado'] == "AM" ? "selected" : ""}}>Amazonas</option>
							<option value="BA" {{$representante['estado'] == "BA" ? "selected" : ""}}>Bahia</option>
							<option value="CE" {{$representante['estado'] == "CE" ? "selected" : ""}}>Ceará</option>
							<option value="DF" {{$representante['estado'] == "DF" ? "selected" : ""}}>Distrito Federal</option>
							<option value="ES" {{$representante['estado'] == "ES" ? "selected" : ""}}>Espírito Santo</option>
							<option value="GO" {{$representante['estado'] == "GO" ? "selected" : ""}}>Goiás</option>
							<option value="MA" {{$representante['estado'] == "MA" ? "selected" : ""}}>Maranhão</option>
							<option value="MT" {{$representante['estado'] == "MT" ? "selected" : ""}}>Mato Grosso</option>
							<option value="MS" {{$representante['estado'] == "MS" ? "selected" : ""}}>Mato Grosso do Sul</option>
							<option value="MG" {{$representante['estado'] == "MG" ? "selected" : ""}}>Minas Gerais</option>
							<option value="PA" {{$representante['estado'] == "PA" ? "selected" : ""}}>Pará</option>
							<option value="PB" {{$representante['estado'] == "PB" ? "selected" : ""}}>Paraíba</option>
							<option value="PR" {{$representante['estado'] == "PR" ? "selected" : ""}}>Paraná</option>
							<option value="PE" {{$representante['estado'] == "PE" ? "selected" : ""}}>Pernambuco</option>
							<option value="PI" {{$representante['estado'] == "PI" ? "selected" : ""}}>Piauí</option>
							<option value="RJ" {{$representante['estado'] == "RJ" ? "selected" : ""}}>Rio de Janeiro</option>
							<option value="RN" {{$representante['estado'] == "RN" ? "selected" : ""}}>Rio Grande do Norte</option>
							<option value="RS" {{$representante['estado'] == "RS" ? "selected" : ""}}>Rio Grande do Sul</option>
							<option value="RO" {{$representante['estado'] == "RO" ? "selected" : ""}}>Rondônia</option>
							<option value="RR" {{$representante['estado'] == "RR" ? "selected" : ""}}>Roraima</option>
							<option value="SC" {{$representante['estado'] == "SC" ? "selected" : ""}}>Santa Catarina</option>
							<option value="SP" {{$representante['estado'] == "SP" ? "selected" : ""}}>São Paulo</option>
							<option value="SE" {{$representante['estado'] == "SE" ? "selected" : ""}}>Sergipe</option>
							<option value="TO" {{$representante['estado'] == "TO" ? "selected" : ""}}>Tocantins</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Informações:</span></div>
					<div class="col-md-10">
						<?php 
							$oFCKeditor = new FCKeditor('informacoes');						
							$oFCKeditor->BasePath = "/fckeditor/";		
							$oFCKeditor->Value = $representante['informacoes'];		
							$oFCKeditor->Height = '300';
							echo $oFCKeditor->CreateHtml();
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.representantes')}}" class="btn btn-danger">Cancelar</a></div>
				</div>				
			@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop