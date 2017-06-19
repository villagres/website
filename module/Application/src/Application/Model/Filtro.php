<?php

namespace Application\Model;

class Filtro{
	public $id;
	public $tipo;
	public $filtro;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->tipo = (!empty($data['tipo'])) ? $data['tipo'] : null;
		$this->filtro = (!empty($data['filtro'])) ? $data['filtro'] : null;
		$this->filtro_en = (!empty($data['filtro_en'])) ? $data['filtro_en'] : null;
	}
}


