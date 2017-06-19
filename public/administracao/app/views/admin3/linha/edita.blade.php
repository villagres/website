@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Linha</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaLinha')}}" method="POST" enctype="multipart/form-data">
				@if(isset($linha))				
					<div class="row">
						<div class="col-md-2"><span>Linha:</span></div>
						<div class="col-md-10">
							<input type="hidden" id="id" name="id" value="{{$linha['id']}}">
							<input type="text" id="linha" name="linha" value="{{$linha['linha']}}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Imagem:</span></div>
						<div class="col-md-5"><input type="file" id="imagem" name="imagem"></div>
						@if($linha['imagem'] != '')
							<div class="col-md-1"><img src="{{'http://'.$_SERVER['SERVER_NAME'].'/img/linha/'.$linha['imagem']}}" alt="Linha"></div>
							<div class="col-md-1"><a href="{{Route('admin.removeLinhaFile',$linha->id)}}" class="fa fa-times"></a></div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-2"><span>Coleção:</span></div>
						<div class="col-md-10">
							<select name="colecao" id="colecao">
								<option value="">Selecione</option>
								@if(isset($colecoes))
									@foreach($colecoes as $colecao)
										<option value="{{$colecao->id}}" {{$linha['colecao'] == $colecao->id ? 'selected' : ''}}>{{$colecao->colecao}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2"><span>Formato:</span></div>
						<div class="col-md-10"><select name="formato[]" id="formato[]" multiple>
								<option value="">Selecione</option>
								@if(isset($formatos))
									@foreach($formatos as $formato)
										<option value="{{$formato->id}}">{{$formato->filtro}}</option>	
									@endforeach
								@endif
							</select>
						</div>						
					</div>
					@if(isset($formatoLinha))
						@foreach($formatoLinha as $fl)
							<div class="row">
								<div class="col-md-5">
									<span>{{$fl->filtro}}</span>&nbsp;&nbsp;<a href="{{Route('admin.removeLinhaFormat',$fl->id,$linha->id)}}" class="fa fa-times"></a>
								</div>								
							</div>
						@endforeach
					@endif
					<div class="row">
						<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.linhas')}}" class="btn btn-danger">Cancelar</a></div>
					</div>				
				@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop