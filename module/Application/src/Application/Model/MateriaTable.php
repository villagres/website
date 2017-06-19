<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class MateriaTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function fetchMateria($id){
		$resultSet = $this->tableGateway->select(array('id' => $id));
		return $resultSet;
	}
}