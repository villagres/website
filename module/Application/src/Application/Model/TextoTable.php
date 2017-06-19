<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class TextoTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($id){
		$resultSet = $this->tableGateway->select(array('id' => $id));
		return $resultSet;
	}
}