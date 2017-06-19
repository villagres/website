<?php

namespace Downloads\Model;

class Downloads
{
	public $id;
	public $capa;
	public $tipo;
	public $arquivo;
	public $descricao;
	public $dataAtualizacao;

	public function exchangeArray($data)
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->capa = (!empty($data['capa'])) ? $data['capa'] : null;
		$this->tipo = (!empty($data['tipo'])) ? $data['tipo'] : null;
		$this->arquivo = (!empty($data['arquivo'])) ? $data['arquivo'] : null;
		$this->descricao = (!empty($data['descricao'])) ? $data['descricao'] : null;
		$this->dataAtualizacao = date('Y-m-d H:i:s');
	}
}