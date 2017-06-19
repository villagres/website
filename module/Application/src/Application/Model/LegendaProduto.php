<?php

namespace Application\Model;

class LegendaProduto{
	public $id;
	public $idLegenda;
	public $idProduto;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->idLegenda = (!empty($data['idLegenda'])) ? $data['idLegenda'] : null;
		$this->idProduto = (!empty($data['idProduto'])) ? $data['idProduto'] : null;
	}
}