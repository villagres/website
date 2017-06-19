<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class ProdutoTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function countLancamentos(){
		$resultSet = $this->tableGateway->select(function(Select $select){
			$select->where->equalTo('linha','linha.id')
				   ->where->equalTo('colecao','linha.colecao')
				   ->where->equalTo('lancamento',1)
				   ->count();
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function fetchAll($cod){		
		//$resultSet = $this->tableGateway->select(array('linha' => $cod));
		$resultSet = $this->tableGateway->select(function(Select $select) use ($cod){			
			$select->where->equalTo('linha',$cod);
			$select->where->notEqualTo('lancamento',1);
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function fetchLancamentos($cod){		
		//$resultSet = $this->tableGateway->select(array('linha' => $cod));
		$resultSet = $this->tableGateway->select(function(Select $select) use ($cod){
			$select->where->equalTo('linha',$cod);
			$select->where->equalTo('lancamento',1);
		});
		$resultSet->buffer();
		return $resultSet;
	}

	public function fetchProduto($id){
		$resultSet = $this->tableGateway->select(array('id' => $id));
		$resultSet->buffer();
		return $resultSet;
	}

	public function search($formato,$colecao,$acabamento,$indicacao,$cor){		
		$resultSet = $this->tableGateway->select(function(Select $select) use ($formato,$colecao,$acabamento,$indicacao,$cor){
			if(!empty($formato))
				$select->where->equalTo('formato',$formato);
			if(!empty($colecao))
				$select->where->equalTo('colecao',$colecao);
			if(!empty($acabamento))
				$select->where->equalTo('acabamento',$acabamento)
			if(!empty($indicacao))
				$select->where->equalTo('indicacao',$indicacao);
			if(!empty($cor))
				$select->where->equalTo('cor',$cor);
		});
		$resultSet->buffer();
		return $resultSet;
	}
}