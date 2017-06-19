<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class LinhaFormatoTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){	

		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('filtro', 'filtro.id = linha_formato.idFiltro', array('filtro'), 'left');				

		$resultSet = $this->tableGateway->selectWith($sqlSelect);
		$resultSet->buffer();	
		return $resultSet;	
	}
}