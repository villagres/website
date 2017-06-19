<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class RepresentanteTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($estado){
		$resultSet = $this->tableGateway->select(array('estado' => $estado));
		return $resultSet;
	}
}