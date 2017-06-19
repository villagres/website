<?php

namespace Application\Model;

class Linha{
	public $id;
	public $linha;
	public $imagem;
	public $colecao;
	public $lancamento;
	public $num_nao_lancamentos;
	public $num_lancamentos;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->linha = (!empty($data['linha'])) ? $data['linha'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
		$this->colecao = (!empty($data['colecao'])) ? $data['colecao'] : null;
		$this->lancamento = (!empty($data['lancamento'])) ? $data['lancamento'] : null;
		$this->num_nao_lancamentos = (!empty($data['num_nao_lancamentos'])) ? $data['num_nao_lancamentos'] : null;
		$this->num_lancamentos = (!empty($data['num_lancamentos'])) ? $data['num_lancamentos'] : null;
	}
}