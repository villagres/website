@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12"><h1>Edição de Banners</h1></div>
			</div>
			<form action="{{Route('admin.gravaBanner')}}" method="POST" enctype="multipart/form-data">
			@if(isset($banner))		
				<div class="row">
					<div class="col-md-2"><span>Banner:</span></div>
					<div class="col-md-5">
						<input type="hidden" id name="id" value="{{$banner['id']}}">
						<input type="file" id="banner" name="banner">
					</div>
					@if($banner['imagem'] != '')
						<div class="col-md-1"><img src="{{'/img/banner/'.$banner['imagem']}}" alt="Banner"></div>
						<div class="col-md-1"><a href="{{Route('admin.removeBannerFile',$banner->id)}}" class="fa fa-times"></a></div>
					@endif
				</div>
				<div class="row">
					<div class="col-md-2"><span>Linha:</span></div>
					<div class="col-md-10">
						<select name="linha" id="linha">
							<option value="">Selecione</option>
							@if(isset($linhas))
								@foreach($linhas as $linha)
									<option value="{{$linha->id}}" {{$banner['linha'] == $linha->id ? "selected" : ""}}>{{$linha->linha}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Lançamento:</span></div>
					<div class="col-md-1"><input type="checkbox" id="lancamento" name="lancamento" {{$banner['lancamento'] == 1 ? "checked" : ""}}></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Link:</span></div>
					<div class="col-md-1"><input type="checkbox" id="link" name="link" {{$banner['link'] == 1 ? "checked" : ""}}></div>
				</div>
				<div class="row">
					<div class="col-md-2"><span>Endereço:</span></div>
					<div class="col-md-10"><input type="text" id="endereco" name="endereco" value="{{$banner['endereco']}}"></div>
				</div>
				<div class="row">
					<div class="col-md-12"><button type="submit" class="btn btn-default">Enviar</button><a href="{{Route('admin.banners')}}" class="btn btn-danger">Cancelar</a></div>
				</div>				
			@endif
			</form>
		</div>
	</div>
	@include('layout.rodape')
@stop