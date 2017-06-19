<div class="col-md-3">
	<div class="menu">
		<nav>
			<ul>
				<li><a class="btn btn-default" href="{{Route('admin.representantes')}}">Representantes</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.banners')}}">Banner</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.chamadas')}}">Chamadas</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.filtros')}}">Filtros</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.textos')}}">Textos</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.legendas')}}">Legendas</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.departamentos')}}">Departamentos</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.materias')}}">Matérias</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.midias')}}">Na mídia</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.colecoes')}}">Coleções</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.linhas')}}">Linhas</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.produtos')}}">Produtos</a></li>
				<li><a class="btn btn-default" href="{{Route('admin.usuarios')}}">Usuários</a></li>
				<li><a class="btn btn-default" id="clear_lancamentos" href="#">Limpar Lançamentos</a></li>
				<li><a class="btn btn-default" id="especificacoes" href="{{Route('admin.especificacoes')}}">Especificações</a></li>
				<li><a class="btn btn-default" id="downloads" href="{{Route('admin.downloadsLista')}}">Downloads</a></li>
			</ul>
		</nav>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Exclusão de Lançamentos</h4>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja limpar todos os lançamentos?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary" id="confirm_clear">Sim</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalLoading" data-backdrop="static" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<center><span style="margin-top:5px;margin-right:15px;">Removendo itens da página de lançamentos </span><img src="{{asset('img/loading-gallery.gif')}}" style="width:50px;height:50px;"></center>
			</div>
		</div>
	</div>
</div>

<div id="modalMsg" class="modal fade" data-backdrop="static" role="diolog">
    <div class="modal-dialog">
        <div class="modal-content">                           
            <div class="modal-body">
                <p id="modalText"></p>
                <input id="inputMsg" type="button" value="Ok" style="width:50px;"/>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$("#clear_lancamentos").on('click',function(){
		$('#myModal').modal('show');		
	});
	
	
	$("#confirm_clear").on('click',function(){		
		
		var urlClear = "{{Route('admin.clearLancamentos')}}";

		$("#myModal").modal('hide');

		$("#modalLoading").modal('show');

		$.ajax({
			url: urlClear,
			type : 'POST',
			processData: false,
			contentType: false,
			async: false,
			success: function(data){
				$("#modalLoading").modal('hide');
				
				if(data.status == 'EMPTY'){
					$("#modalMsg").find("#modalText").text('Não existem lançamentos do ano de ' + (new Date).getFullYear() + ' para remover!');
					$("#modalMsg").find("#inputMsg").addClass('btn btn-default');	
				}
				if(data.status == 'OK'){
					$("#modalMsg").find("#modalText").text('Lançamentos do ano de ' + (new Date).getFullYear() + ' removidos com sucesso!');
					$("#modalMsg").find("#inputMsg").addClass('btn btn-success');	
				}
				if(data.status == 'NOK'){
					$("#modalMsg").find("#modalText").text('Erro ao remover os lançamentos do ano de ' + (new Date).getFullYear() + ' !');
					$("#modalMsg").find("#inputMsg").addClass('btn btn-danger');	
				}
				
				$("#modalMsg").modal('show');
			},
			error: function(data){
				$("#modalLoading").modal('hide');
				$("#modalMsg").find("#modalText").text('Erro ao remover os lançamentos do ano de ' + (new Date).getFullYear() + ' !');
				$("#modalMsg").find("#inputMsg").addClass('btn btn-danger');
				$("#modalMsg").modal('show');
			}
		});	

	});
	
	$("#inputMsg").on('click',function(){
		$("#modalMsg").find("#inputMsg").removeClass('btn');
		if($("#modalMsg").find("#inputMsg").hasClass('btn-success')){
			$("#modalMsg").find("#inputMsg").removeClass('btn-success');
		}
		if($("#modalMsg").find("#inputMsg").hasClass('btn-danger')){
			$("#modalMsg").find("#inputMsg").removeClass('btn-danger');
		}
		$("#modalMsg").find("#modalText").text('');
		$("#modalMsg").modal('hide');
	});	
	
</script>