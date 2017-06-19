<?php

namespace Application\Model;

class Materia{
	public $id;
	public $destaque;
	public $tituloDestaque;
	public $imagemDestaque;
	public $titulo;
	public $imagemMiniatura;
	public $olho;
	public $texto;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->destaque = (!empty($data['destaque'])) ? $data['destaque'] : null;
		$this->tituloDestaque = (!empty($data['tituloDestaque'])) ? $data['tituloDestaque'] : null;
		$this->tituloDestaque_en = (!empty($data['tituloDestaque_en'])) ? $data['tituloDestaque_en'] : null;
		$this->imagemDestaque = (!empty($data['imagemDestaque'])) ? $data['imagemDestaque'] : null;
		$this->titulo = (!empty($data['titulo'])) ? $data['titulo'] : null;
		$this->titulo_en = (!empty($data['titulo_en'])) ? $data['titulo_en'] : null;
		$this->imagemMiniatura = (!empty($data['imagemMiniatura'])) ? $data['imagemMiniatura'] : null;
		$this->olho = (!empty($data['olho'])) ? $data['olho'] : null;
		$this->olho_en = (!empty($data['olho_en'])) ? $data['olho_en'] : null;
		$this->texto = (!empty($data['texto'])) ? $data['texto'] : null;
		$this->texto_en = (!empty($data['texto_en'])) ? $data['texto_en'] : null;
	}
}