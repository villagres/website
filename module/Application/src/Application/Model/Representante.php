<?php

namespace Application\Model;

class Representante{
	public $id;
	public $nome;
	public $estado;
	public $informacoes;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
		$this->nome_en = (!empty($data['nome_en'])) ? $data['nome_en'] : null;
		$this->estado = (!empty($data['estado'])) ? $data['estado'] : null;
		$this->informacoes = (!empty($data['informacoes'])) ? $data['informacoes'] : null;
		$this->informacoes_en = (!empty($data['informacoes_en'])) ? $data['informacoes_en'] : null;
	}
}