<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class ColecaoTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('colecao','colecao.id')            
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('colecao','colecao.id')            
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('colecao');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
		
		//$resultSet = $this->tableGateway->select();
		//return $resultSet;
	}
	
	public function getCollection($id){
		$resultSet = $this->tableGateway->select(array('id' => $id));
		return $resultSet;
	}
}