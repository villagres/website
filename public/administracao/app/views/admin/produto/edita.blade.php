@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h1>Edição de Produto</h1>
				</div>
			</div>
			<form action="{{Route('admin.gravaProduto')}}" method="POST" enctype="multipart/form-data">
			@if(isset($produto))				
				<div class="row">
					<div class="col-md-2"><span>Coleção:</span></div>
					<div class="col-md-10">
						<input type="hidden" id name="id" value="{{$produto->id}}">
						<select name="colecao" id="colecao">
							<option value="">Selecione</option>
							@if(isset($colecoes))
								@foreach($colecoes as $colecao)
									<option value="{{$colecao->id}}" {{$produto['colecao'] == $colecao->id ? "selected" : ''}}>{{$colecao->colecao}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Linha:</span></div>
					<div class="col-md-10"><select name="linha" id="linha">
							<option value="">Selecione</option>
							@if(isset($linhas))
								@foreach($linhas as $linha)
									<option value="{{$linha->id}}" {{$produto['linha'] == $linha->id ? "selected" : ''}}>{{$linha->linha}}</option>
								@endforeach
							@endif
						</select></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Formato:</span></div>
					<div class="col-md-10"><select name="formato" id="formato">
							<option value="">Selecione</option>
							@if(isset($formatos))
								@foreach($formatos as $formato)
									<option value="{{$formato->id}}" {{$produto['formato'] == $formato->id ? "selected" : ''}}>{{$formato->filtro}}</option>
								@endforeach
							@endif
						</select></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Acabamento:</span></div>
					<div class="col-md-10"><select name="acabamento" id="acabamento">
							<option value="">Selecione</option>
							@if(isset($acabamentos))
								@foreach($acabamentos as $acabamento)
									<option value="{{$acabamento->id}}" {{$produto['acabamento'] == $acabamento->id ? "selected" : ''}}>{{$acabamento->filtro}}</option>
								@endforeach
							@endif
						</select></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Cor:</span></div>
					<div class="col-md-10">
						<select name="cor" id="cor">
							<option value="">Selecione</option>
							@if(isset($cores))
								@foreach($cores as $cor)
									<option value="{{$cor->id}}" {{$produto['cor'] == $cor->id ? "selected" : ''}}>{{$cor->filtro}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Indicação:</span></div>
					<div class="col-md-10">
						<select name="indicacao" id="indicacao">
							<option value="">Selecione</option>
							@if(isset($indicacoes))
								@foreach($indicacoes as $indicacao)
									<option value="{{$indicacao->id}}" {{$produto['indicacao'] == $indicacao->id ? "selected" : ''}}>{{$indicacao->filtro}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Layout:</span></div>
					<div class="col-md-10">
						<select name="layout" id="layout">
							<option value="">Selecione</option>
							@if(isset($layouts))
								@foreach($layouts as $layout)
									<option value="{{$layout->id}}" {{$produto['layout'] == $layout->id ? "selected" : ''}}>{{$layout->filtro}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Referência:</span></div>
					<div class="col-md-10"><input type="text" id="referencia" name="referencia" value="{{$produto['referencia']}}"></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Rodapé:</span></div>
					<div class="col-md-1"><input type="checkbox" id="rodape" name="rodape" {{$produto['rodape'] == 1 ? "checked" : ""}}></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Lançamento:</span></div>
					<div class="col-md-1"><input type="checkbox" id="lancamento" name="lancamento" {{$produto['lancamento'] == 1 ? "checked" : ""}}></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Texto:</span></div>
					<div class="col-md-10">
						<textarea name="texto" id="texto" rows="10" cols="80">			                
							<?php echo $produto['texto']; ?>
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
							$oFCKeditor->Value = $produto['texto']; 
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
							<?php echo $produto['texto_en']; ?>
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
							$oFCKeditor->Value = $produto['texto_en']; 
							$oFCKeditor->Height = '300';
							echo $oFCKeditor->CreateHtml();
							*/
						?>						
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Legendas:</span></div>
					<div class="col-md-10"><select name="legendas[]" id="legendas[]" multiple>
							<option value="">Selecione</option>
							@if(isset($legendas))
								@foreach($legendas as $legenda)
									<option value="{{$legenda->id}}">{{$legenda->legenda}}</option>
								@endforeach
							@endif
						</select></div>
				</div>
				@if(isset($legendaProduto))
					@foreach($legendaProduto as $lp)
						@if($lp->legenda != '')
							<div class="row">
								<div class="col-md-5">
									<span>{{$lp->legenda}}</span>&nbsp;&nbsp;<a href="{{Route('admin.removeLegendaProduto',$lp->id)}}" class="fa fa-times"></a>
								</div>
							</div>
						@endif
					@endforeach
				@endif
				<div class="row">
					<div class="col-md-2"><span>Faces:</span></div>
					<div class="col-md-10"><input type="file" id="faces[]" name="faces[]" multiple></div>
				</div>
				@if(isset($faceProduto))
					@foreach($faceProduto as $fp)
						@if($fp->imagem != '')
							<div class="row">
								<div class="col-md-5">
									<img src="{{'/img/produto/'.$fp->imagem}}" alt="">&nbsp;&nbsp;<a href="{{Route('admin.removeFaceProduto',$fp->id)}}" class="fa fa-times"></a>
								</div>
							</div>
						@endif
					@endforeach
				@endif
				<div class="row">
					<div class="col-md-2"><span>Imagens:</span></div>
					<div class="col-md-10"><input type="file" id="imagens[]" name="imagens[]" multiple></div>
				</div>
				@if(isset($imagemProduto))
					@foreach($imagemProduto as $ip)
						@if($ip->imagem != '')
							<div class="row">
								<div class="col-md-5">
									<img src="{{'/img/produto/'.$ip->imagem}}" alt="">&nbsp;&nbsp;<a href="{{Route('admin.removeImagemProduto',$ip->id)}}" class="fa fa-times"></a>
								</div>
							</div>
						@endif
					@endforeach
				@endif
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.produtos')}}" class="btn btn-danger">Cancelar</a></div>				
				</div>
			@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop