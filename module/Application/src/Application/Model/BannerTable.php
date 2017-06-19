<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class BannerTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){
		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('linha', 'linha.id = banner.linha', array('id','linha'), 'left');
		//$sqlSelect->join(array('l' => 'linha'),'l.id = banner.linha',array('desc' => 'l.linha'),'left');

		$resultSet = $this->tableGateway->selectWith($sqlSelect);
				
		return $resultSet;
		
		
		//$resultSet = $this->tableGateway->select();
		//return $resultSet;
	}
}