<?php

namespace Application\Model;

class Chamada{
	public $id;
	public $nome;
	public $imagem;
	public $materia;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
		$this->nome_en = (!empty($data['nome_en'])) ? $data['nome_en'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
		$this->imagem_en = (!empty($data['imagem_en'])) ? $data['imagem_en'] : null;
		$this->materia = (!empty($data['materia'])) ? $data['materia'] : null;
	}
}