<?php

namespace Application\Model;

class FaceProduto{
	public $id;
	public $imagem;
	public $produto;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
		$this->produto = (!empty($data['produto'])) ? $data['produto'] : null;
	}

}