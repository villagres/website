@extends('layout.master')

@section('title','Administração')

@section('content')
	@include('layout.topo')
	<div class="row">
		@include('layout.menu')	
		<div class="col-md-9">
			<div class="principal">
				<h1>Selecione uma opção</h1>
			</div>
		</div>
	</div>
	@include('layout.rodape')
@stop