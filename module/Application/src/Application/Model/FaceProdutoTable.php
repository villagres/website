<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class FaceProdutoTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){
		$resultSet = $this->tableGateway->select();
		return $resultSet->current();
	}
	
	public function fetchProduto($produto){
		$resultSet = $this->tableGateway->select(array('produto' => $produto));
		return $resultSet;
	}
}