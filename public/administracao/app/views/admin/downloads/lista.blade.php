@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<h1>Gerenciamento de Arquivos</h1>
				</div>
				<div class="col-md-3 btn-novo"><a href="{{Route('admin.downloads')}}" class="btn btn-default">Novo Arquivo</a></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@if(isset($arquivos) && count($arquivos) > 0)
					<table class="table table-bordered">
						<tr class="titulo">
							<td>ID</td>
							<td>Imagem</td>
							<td>Descrição</td>
							<td></td>							
						</tr>						
							@foreach($arquivos as $arquivo)
								<tr>
									<td>{{$arquivo->id}}</td>									
									<td>
										@if($arquivo->capa != '')
											<img src="{{'/documentos/capa/'.$arquivo->capa}}">
										@endif
									</td>
									<td>{{$arquivo->descricao}}</td>									
									<td><a onclick="confirmaExclusao({{$arquivo->id}})" class="fa fa-times"></a></td>
								</tr>	
							@endforeach						
					</table>
					@else
						<p>Não existem arquivos cadastrados.</p>
					@endif					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{$arquivos->links()}}
				</div>
			</div>
		</div>
		<div id="modal1" class="modal fade" data-backdrop="static" role="diolog">
			<div class="modal-dialog">
				<div class="modal-content">                           
					<div class="modal-body">
						<p id="modalText">Tem certeza que deseja excluir esse documento?.</p>
						<input id="inputIdExclusao" type="hidden" value="" style="width:50px;"/>
						<input id="inputMsgSim" onclick="excluirDocumento()" type="button" value="Sim" style="width:50px;"/>
						<input id="inputMsg" type="button" data-dismiss="modal" value="Não" style="width:50px;"/>
					</div>
				</div>
			</div>
		</div>
		<div id="modal2" class="modal fade" data-backdrop="static" role="diolog">
			<div class="modal-dialog">
				<div class="modal-content">                           
					<div class="modal-body">
						<p id="modalText"><img src="/img/loading.gif" width="50px;">&nbsp;&nbsp;Excluindo o documento ...</p>                
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var url = "{{Route('admin.downloadsApaga')}}";			
			
			function confirmaExclusao(id){
				$("#modal1").modal("show");
				$("#modal1").find("#inputIdExclusao").val(id);
			}
			
			function excluirDocumento(){
				$("#modal2").modal('show');
				var importForm = new FormData();
				var id = $("#inputIdExclusao").val();				
				importForm.append('id',id);				
				$.ajax({
					url: url,
					type : 'POST',
					data: importForm,
					processData: false,
					contentType: false,
					async: true,
					success: function(data){				
						if(data.status == 'OK'){
							$("#modal1").find("#modalText").text('Documento excluído com sucesso!');
							$("#modal1").find("#inputMsgSim").css('display','none');	
							$("#modal1").find("#inputMsg").addClass('btn btn-success');											
							$("#modal1").find("#inputMsg").val('OK');	
						}										
						if(data.status == 'NOK'){
							$("#modal1").find("#modalText").text('Erro ao excluir documento!');
							$("#modal1").find("#inputMsgSim").css('display','none');	
							$("#modal1").find("#inputMsg").addClass('btn btn-danger');
							$("#modal1").find("#inputMsg").val('OK');	
						}						
						$("#modal2").modal('hide');
						$("#modal1").modal('show');
					},
					error: function(data){				
						$("#modal1").find("#modalText").text('Erro ao excluir documento!');
						$("#modal1").find("#inputMsgSim").css('display','none');	
						$("#modal1").find("#inputMsg").addClass('btn btn-danger');
						$("#modal1").find("#inputMsg").val('OK');	
						$("#modal2").modal('hide');
						$("#modal1").modal('show');
					}
				});
			}					
		</script>
	</div>
	@include('layout.rodape')
@stop