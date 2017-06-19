<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class FiltroTable{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchFormato(){	
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('formato','filtro.id')            
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('formato','filtro.id')            
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('filtro');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2))->where(array('tipo' => 'formato'));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
		
		//$resultSet = $this->tableGateway->select(array('tipo' => 'formato'));
		//return $resultSet;
	}

	public function fetchAcabamento(){
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('acabamento','filtro.id')            
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('acabamento','filtro.id')            
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('filtro');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2))->where(array('tipo' => 'acabamento'));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
		
		//$resultSet = $this->tableGateway->select(array('tipo' => 'acabamento'));
		//return $resultSet;
	}

	public function fetchIndicacao(){
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('indicacao','filtro.id')            
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('indicacao','filtro.id')            
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('filtro');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2))->where(array('tipo' => 'indicacao'));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
		
		//$resultSet = $this->tableGateway->select(array('tipo' => 'indicacao'));
		//return $resultSet;
	}

	public function fetchCor(){
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('cor','filtro.id')            
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('cor','filtro.id')            
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('filtro');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2))->where(array('tipo' => 'cor'));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
		
		//$resultSet = $this->tableGateway->select(array('tipo' => 'cor'));
		//return $resultSet;
	}
	
	public function fetchLinhas(){
		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('linha_formato', 'linha_formato.idFiltro = filtro.id', array('idLinha'), 'left');				
		$sqlSelect->join('linha','linha.id = linha_formato.idLinha',array('id'),'left');

		$resultSet = $this->tableGateway->selectWith($sqlSelect);
		$resultSet->buffer();	
		return $resultSet;
	}
	
	public function getFiltro($id){
		$resultSet = $this->tableGateway->select(array('id' => $id));
		$resultSet->buffer();
		return $resultSet;
	}

}