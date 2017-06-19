<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class LegendaProdutoTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($produto){
		$select = new \Zend\Db\Sql\Select;
		$select->from('legenda');
		$select->join('legenda_produto','legenda.id = legenda_produto.idLegenda',array('*'),'left');
		$select->where(array('legenda_produto.idProduto' => $produto));
		$resultSet = $this->tableGateway->selectWith($select);
		return $resultSet;
	}
}