<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;


class LinhaTable{
	protected $tableGateway;		

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;		
	}		

	public function fetchAll($colecao){			
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('linha','linha.id')
            ->where->equalTo('colecao','linha.colecao')
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('linha','linha.id')
            ->where->equalTo('colecao','linha.colecao')
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('linha');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2))->where(array('colecao' => $colecao));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
	
		/*
		//$resultSet = $this->tableGateway->select(array('colecao' => $colecao));
		$resultSet = $this->tableGateway->select(function(Select $select) use ($colecao){			
			
			$sub1 = new Select('produto');
			$sub1->columns(array('total' => new \Zend\Db\Sql\Expression('COUNT(*)')))
				 ->where->equalTo('linha','linha.id')
				 ->where->equalTo('colecao',$colecao)
				 ->where->notEqualTo('lancamento',1);
			
			$sub2 = new Select('produto');
			$sub2->columns(array('total' => new \Zend\Db\Sql\Expression('COUNT(*)')))
				 ->where->equalTo('linha','linha.id')
				 ->where->equalTo('colecao',$colecao)
				 ->where->equalTo('lancamento',1);				 			
			
			$select->columns(array(
				'id','linha','imagem','colecao','lancamento',
				'num_nao_lancamentos' => new \Zend\Db\Sql\Expression('?',array($sub1)),
				'num_lancamentos' => new \Zend\Db\Sql\Expression('?',array($sub2))
			));
		
			$select->where->equalTo('colecao',$colecao);				
						
		});
		$resultSet->buffer();
		return $resultSet;
		*/
	}	
	
	public function fetchLancamentos(){	
	
		$sub = new Select('produto');
        $sub->columns(array('num_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('linha','linha.id')
            ->where->equalTo('colecao','linha.colecao')
            ->where->equalTo('lancamento',1);      
			
		$subquery = str_replace('"','',str_replace("'",'',$sub->getSqlString()));		
        $subquery = new \Zend\Db\Sql\Expression("({$subquery})");
        $predicate = new \Zend\Db\Sql\Predicate\Expression("({$sub->getSqlString()})");			

        $sub2 = new Select('produto');
        $sub2->columns(array('num_nao_lancamentos' => new \Zend\Db\Sql\Expression('COUNT(*)')), FALSE)
            ->where->equalTo('linha','linha.id')
            ->where->equalTo('colecao','linha.colecao')
            ->where->NEST
				->notEqualTo('lancamento',1)
				->or
				->isNull('lancamento')
				->UNNEST;            
		
		$subquery2 = str_replace('"','',str_replace("'",'',$sub2->getSqlString()));
        $subquery2 = new \Zend\Db\Sql\Expression("({$subquery2})");
        $predicate2 = new \Zend\Db\Sql\Predicate\Expression("({$sub2->getSqlString()})");

        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select()->from('linha');
        $select->columns(array('*', 'num_lancamentos' => $subquery, 'num_nao_lancamentos' => $subquery2))->where(array('lancamento' => 1));        											
		
		$statement = $sql->prepareStatementForSqlObject($select); 

		$results = $statement->execute();

		$resultSet = new \Zend\Db\ResultSet\ResultSet();
		$resultSet->initialize($results);
		
		$resultSet->buffer();
		
		return $resultSet;
		
		/*
		$adapter = $this->tableGateway->adapter;
		
		$sql = new Sql($adapter);		
				
		//$resultSet = $this->tableGateway->select(array('colecao' => $colecao));
		$resultSet = $this->tableGateway->select(function(Select $select) use ($colecao){

			$sub = new Select('produto');		
			$sub->columns(array(new Expression('COUNT(*) as total')), FALSE)			
				->where->equalTo('linha','linha.id')
				->where->equalTo('colecao','linha.colecao')
				->where->NEST
				   ->notEqualTo('lancamento',1)
				   ->or
				   ->isNull('lancamento')
				   ->UNNEST
			;			

			$tg = new TableGateway('produto', $this->tableGateway->getAdapter(), null, null);			
				
			$sub2 = new Select('produto');
			$sub2->columns(array(new Expression('COUNT(*) as total2')), FALSE)			
				->where->equalTo('linha','linha.id')
				->where->equalTo('colecao','linha.colecao')
				->where->equalTo('lancamento',1)				   
			;        	
		
			//$statement1 = $sql->getSqlStringForSqlObject($sub);				
			//$subq = $adapter->query($statement1,$adapter::QUERY_MODE_EXECUTE);
			//$subquery = $subq->toArray();							
			
			//$statement2 = $sql->getSqlStringForSqlObject($sub2);				
			//$subq2 = $adapter->query($statement2,$adapter::QUERY_MODE_EXECUTE);
			//$subquery2 = $subq2->toArray();					
			
			$select->columns(array('id','linha','imagem','colecao','lancamento',
								   'num_nao_lancamentos' => new Expression('?',array($sub)),
								   'num_lancamentos' => new Expression('?',array($sub2))
			));
		
			//$select->where->equalTo('lancamento',1);				
			$select->where->equalTo('colecao',$colecao);					
			
		});											
		
		$resultSet->buffer();					
		
		return $resultSet;		
		*/
	}
	
	public function getLinha($linha){
		$resultSet = $this->tableGateway->select(array('id' => $linha));
		return $resultSet;
	}
	
	public function teste($linha){
		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('produto', 'produto.linha = linha.id', array(), 'left');				

		$resultSet = $this->tableGateway->selectWith($sqlSelect);
		$resultSet->buffer();	
		return $resultSet;
	}
	
	public function fetchFormatos(){
		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('linha_formato', 'linha_formato.idLinha = linha.id', array('*'), 'left');		
		$sqlSelect->join('filtro','filtro.id = linha_formato.idFiltro',array('filtro'),'left');

		$resultSet = $this->tableGateway->selectWith($sqlSelect);
		$resultSet->buffer();	
		return $resultSet;
	}
}