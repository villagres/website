<?php

namespace Application\Model;

class Texto{
	public $id;
	public $titulo;
	public $imagem;
	public $texto;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->titulo = (!empty($data['titulo'])) ? $data['titulo'] : null;
		$this->titulo_en = (!empty($data['titulo_en'])) ? $data['titulo_en'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
		$this->texto = (!empty($data['texto'])) ? $data['texto'] : null;
		$this->texto_en = (!empty($data['texto_en'])) ? $data['texto_en'] : null;
	}

}