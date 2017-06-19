@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')	
		<div class="col-md-9">
			<div class="principal">
				<h1>Importar Especificações</h1>
				<input type="file" name="import" id="import">
				<button type="button" class="btn btn-default" name="btnImportar" id="btnImportar" style="margin-top: 20px;">Importar</button>
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
	<script type="text/javascript">
	var url = "{{Route('admin.especificacoesImport')}}";
	$("#btnImportar").on('click',function(){
		var importForm = new FormData();
		var file = $("#import")[0].files[0];
		importForm.append('import',file);		
		$.ajax({
			url: url,
			type : 'POST',
			data: importForm,
			processData: false,
			contentType: false,
			async: false,
			success: function(data){				
				if(data.status == 'OK'){
					$("#modal1").find("#modalText").text('Importação efetuada com sucesso!');
					$("#modal1").find("#inputMsg").addClass('btn btn-success');											
				}				
				if(data.status == 'EXT'){
					$("#modal1").find("#modalText").text('Formato inválido de arquivo! Formatos permitidos xls ou xlsx');
					$("#modal1").find("#inputMsg").addClass('btn btn-danger');	
				}
				if(data.status == 'FNOK'){
					$("#modal1").find("#modalText").text('Formato inválido das colunas da planilha!');
					$("#modal1").find("#inputMsg").addClass('btn btn-danger');	
				}
				if(data.status == 'EMP'){
					$("#modal1").find("#modalText").text('Planilha vazia!');
					$("#modal1").find("#inputMsg").addClass('btn btn-danger');	
				}
				if(data.status == 'NOK'){
					$("#modal1").find("#modalText").text('Erro ao importar dados!');
					$("#modal1").find("#inputMsg").addClass('btn btn-danger');						
				}
				$("#modal1").modal('show');
			},
			error: function(data){				
				$("#modal1").find("#modalText").text('Erro ao importar os dados!');
				$("#modal1").find("#inputMsg").addClass('btn btn-danger');
				$("#modal1").modal('show');
			}
		});	
		//$('#modal1').modal('show');		
	});
	</script>
</div>
	@include('layout.rodape')
@stop