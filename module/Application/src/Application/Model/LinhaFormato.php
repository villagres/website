<?php

namespace Application\Model;

class LinhaFormato{
	public $id;
	public $idLinha;
	public $idFiltro;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->idLinha = (!empty($data['idLinha'])) ? $data['idLinha'] : null;
		$this->idFiltro = (!empty($data['idFiltro'])) ? $data['idFiltro'] : null;
	}
}