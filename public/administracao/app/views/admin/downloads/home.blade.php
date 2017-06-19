<?php 
	ini_set("memory_limit",'4095M');
	set_time_limit(0);
?>

@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')			
		<div class="col-md-9">
			<div class="principal">
				<h1>Importar Documento</h1>								
				<form id="frm-downloads" name="frm-downloads" action="{{Route('admin.downloadsImport')}}" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<span>Capa:</span>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-11">
						<input type="file" name="capa" id="capa">
					</div>
				</div>
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<span>Tipo:</span>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-11">
						<select name="tipo" id="tipo">
							<option value="">Selecione um tipo</option>
							@if(count($tipos) > 0)
								@foreach($tipos as $tipo)
									<option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<span>Documento:</span>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-11">
						<input type="file" name="arquivo" id="arquivo">
					</div>
				</div>
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<span>Descrição:</span>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-11">
						<input type="text" id="descricao" name="descricao">
					</div>
				</div>
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<span>Data Upload:</span>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-11">
						<input type="text" id="dtUpload" name="dtUpload" disabled value="<?php echo date('d/m/Y');?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">		
						<button type="submit" class="btn btn-default" name="btnImportar" id="btnImportar" style="margin-top: 20px;">Importar</button>
					</div>	
				</div>
				</form>
			</div>
		</div>		
	</div>
	<div id="modal1" class="modal fade" data-backdrop="static" role="diolog">
		<div class="modal-dialog">
			<div class="modal-content">                           
				<div class="modal-body">
					<p id="modalText">Formato inválido de arquivo.</p>
					<input id="inputMsg" type="button" data-dismiss="modal" value="Ok" style="width:50px;"/>                
				</div>
			</div>
		</div>
	</div>
	<div id="modal2" class="modal fade" data-backdrop="static" role="diolog">
		<div class="modal-dialog">
			<div class="modal-content">                           
				<div class="modal-body">
					<p id="modalText"><img src="/img/loading.gif" width="50px;">&nbsp;&nbsp;Importando o documento ...</p>                
				</div>
			</div>
		</div>
	</div>		
	
	<script type="text/javascript">
		var status = "{{ $status }}";
		
		$("#frm-downloads")[0].reset();
		$("#modal2").modal("hide");		
		
		if(status == 'OK'){
			$("#modal1").find("#modalText").text('Importação efetuada com sucesso!');
			$("#modal1").find("#inputMsg").addClass('btn btn-success');											
			$("#modal1").modal('show');
		}				
		if(status == 'EXT'){
			$("#modal1").find("#modalText").text('Formato inválido de arquivo! Formatos permitidos jpg, jpeg ou pdf');
			$("#modal1").find("#inputMsg").addClass('btn btn-danger');	
			$("#modal1").modal('show');
		}
		if(status == 'OBG'){
			$("#modal1").find("#modalText").text('É necessário preencher todos os campos!');
			$("#modal1").find("#inputMsg").addClass('btn btn-danger');	
			$("#modal1").modal('show');
		}		
		if(status == 'NOK'){
			$("#modal1").find("#modalText").text('Erro ao importar dados!');
			$("#modal1").find("#inputMsg").addClass('btn btn-danger');						
			$("#modal1").modal('show');
		}				
			
		$("#frm-downloads").on('submit',function(){						
			$("#modal2").modal("show");			
		});		
	</script>
	
	@include('layout.rodape')
@stop