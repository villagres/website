<?php 

namespace Application\Model;

class Colecao{
	public $id;
	public $colecao;
	public $texto;
	public $imagem;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->colecao = (!empty($data['colecao'])) ? $data['colecao'] : null;
		$this->colecao_en = (!empty($data['colecao_en'])) ? $data['colecao_en'] : null;
		$this->texto = (!empty($data['texto'])) ? $data['texto'] : null;
		$this->texto_en = (!empty($data['texto_en'])) ? $data['texto_en'] : null;
		$this->imagem = (!empty($data['imagem'])) ? $data['imagem'] : null;
	}
}