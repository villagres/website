<?php

namespace Application\Model;

class Banner{
	public $id;
	public $imagem;
	public $linha;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
		$this->linha = (!empty($data['linha'])) ? $data['linha'] : null;
		$this->lancamento = (!empty($data['lancamento'])) ? $data['lancamento'] : null;
		$this->link = (!empty($data['link'])) ? $data['link'] : null;
		$this->endereco = (!empty($data['endereco'])) ? $data['endereco'] : null;
	}

}