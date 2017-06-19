<?php

namespace Application\Model;

class Legenda{
	public $id;
	public $legenda;
	public $imagem;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->legenda = (!empty($data['legenda'])) ? $data['legenda'] : null;
		$this->legenda_en = (!empty($data['legenda_en'])) ? $data['legenda_en'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
	}
}