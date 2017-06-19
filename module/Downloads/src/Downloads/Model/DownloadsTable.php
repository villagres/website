<?php

namespace Downloads\Model;

use Zend\Db\TableGateway\TableGateway;

class DownloadsTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchType($type)
	{
		$resultSet = $this->tableGateway->select(array('tipo' => $type));
		return $resultSet;
	}
}