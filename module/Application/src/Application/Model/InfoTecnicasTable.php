<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class InfoTecnicasTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function getInfoTecnicas($produto){
		$resultSet = $this->tableGateway->select(function(Select $select) use ($produto){
			$select->where->equalTo('idProduto',$produto);
		});
		$resultSet->buffer();
		return $resultSet;
	}
}