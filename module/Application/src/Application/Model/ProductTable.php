<?php namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class ProductTable extends AbstractTableGateway {

    protected $table = 'produto';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
	
	public function fetchAll($linha){						
		$resultSet = $this->select(function(Select $select) use ($linha){			
			$select->join('filtro','filtro.id = produto.formato',array('filtro'),'left');
			$select->where(array('produto.linha'=>$linha));
			$select->where->NEST
				   ->notEqualTo('lancamento',1)
				   ->or
				   ->isNull('lancamento')
				   ->UNNEST;
			$select->order(array('produto.formato' => 1,'produto.formato' => 6, 'produto.formato' => 7, 'produto.formato' => 8, 'produto.formato' => 21, 'produto.formato' => 5, 'produto.formato' => 4, 'produto.formato' => 2, 'produto.formato' => 3));
		});		
		return $resultSet;
	}
	
	public function fetchAll_en($linha){						
		$resultSet = $this->select(function(Select $select) use ($linha){			
			$select->join('filtro','filtro.id = produto.formato',array('filtro_en'),'left');
			$select->where(array('produto.linha'=>$linha));
			$select->where->NEST
				   ->notEqualTo('lancamento',1)
				   ->or
				   ->isNull('lancamento')
				   ->UNNEST;
			$select->order(array('produto.formato' => 1,'produto.formato' => 6, 'produto.formato' => 7, 'produto.formato' => 8, 'produto.formato' => 21, 'produto.formato' => 5, 'produto.formato' => 4, 'produto.formato' => 2, 'produto.formato' => 3));
		});		
		return $resultSet;
	}
	
	public function fetchLancamentos($linha){						
		$resultSet = $this->select(function(Select $select) use ($linha){			
			$select->join('filtro','filtro.id = produto.formato',array('filtro'),'left');
			$select->where(array('produto.linha'=>$linha));
			$select->where->equalTo('lancamento',1);
			$select->order(array('produto.formato' => 1,'produto.formato' => 6, 'produto.formato' => 7, 'produto.formato' => 8, 'produto.formato' => 21, 'produto.formato' => 5, 'produto.formato' => 4, 'produto.formato' => 2, 'produto.formato' => 3));
		});		
		return $resultSet;
	}
	
	public function fetchFace(){
		$resultSet = $this->select(function (Select $select){
			$select->join('face_produto','face_produto.produto = produto.id',array('imagem','produto'),'left');
			$select->where->isNotNull('face_produto.imagem');			
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function fetchProduto($referencia){
		//$resultSet = $this->select(array('referencia'=>$referencia));
		$resultSet = $this->select(function(Select $select) use ($referencia){
			$select->join('filtro','filtro.id = produto.formato',array('filtro'),'left');
			$select->join(array('a' => 'filtro'),'a.id = produto.acabamento',array('acabamento' => 'filtro'),'left');
			$select->join('linha','linha.id = produto.linha',array('linha'),'left');
			$select->where(array('produto.referencia'=>$referencia));
		});
		return $resultSet;
	}
	
	public function fetchProduto_en($referencia){
		//$resultSet = $this->select(array('referencia'=>$referencia));
		$resultSet = $this->select(function(Select $select) use ($referencia){
			$select->join('filtro','filtro.id = produto.formato',array('filtro_en'),'left');
			$select->join(array('a' => 'filtro'),'a.id = produto.acabamento',array('acabamento' => 'filtro_en'),'left');
			$select->join('linha','linha.id = produto.linha',array('linha'),'left');
			$select->where(array('produto.referencia'=>$referencia));
		});
		return $resultSet;
	}
	
	public function fetchFaces($referencia){
		$resultSet = $this->select(function(Select $select) use ($referencia){
			$select->join('face_produto','face_produto.produto = produto.id',array('imagem'),'left');
			$select->where(array('produto.referencia' => $referencia));
			$select->where->isNotNull('face_produto.imagem');
		});
		$resultSet->buffer();
		return $resultSet;
	}

	public function fetchImagens($referencia){
		$resultSet = $this->select(function(Select $select) use ($referencia){
			$select->join('imagem_produto','imagem_produto.produto = produto.id',array('imagem'),'left');
			$select->where(array('produto.referencia' => $referencia));
			$select->where->isNotNull('imagem_produto.imagem');
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function fetchLegendas($referencia){
		$resultSet = $this->select(function(Select $select) use ($referencia){
			$select->join('legenda_produto','legenda_produto.idProduto = produto.id',array('*'),'left');
			$select->join('legenda','legenda.id = legenda_produto.idLegenda',array('id','legenda','imagem'),'left');
			$select->where(array('produto.referencia' => $referencia));
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function fetchLegendas_en($referencia){
		$resultSet = $this->select(function(Select $select) use ($referencia){
			$select->join('legenda_produto','legenda_produto.idProduto = produto.id',array('*'),'left');
			$select->join('legenda','legenda.id = legenda_produto.idLegenda',array('id','legenda_en','imagem'),'left');
			$select->where(array('produto.referencia' => $referencia));
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function busca($formato,$colecao,$acabamento,$indicacao,$cor){
		$resultSet = $this->select(function(Select $select) use ($formato,$colecao,$acabamento,$indicacao,$cor){
			$select->join('colecao','colecao.id = produto.colecao',array('colecao'),'left');
			$select->join('linha','linha.id = produto.linha',array('linha'),'left');
			$select->join(array('a' => 'filtro'),'a.id = produto.formato',array('formato' => 'filtro'),'left');
			$select->join(array('b' => 'filtro'),'b.id = produto.acabamento',array('acabamento' => 'filtro'),'left');
			$select->join(array('c' => 'filtro'),'c.id = produto.indicacao',array('indicacao' => 'filtro'),'left');
			$select->join(array('d' => 'filtro'),'d.id = produto.cor',array('cor' => 'filtro'),'left');
			if($formato != ''){
				$select->where(array('a.id' => $formato));
			}
			if($colecao != ''){
				$select->where(array('colecao.id' => $colecao));
			}
			if($acabamento != ''){
				$select->where(array('b.id' => $acabamento));
			}
			if($indicacao != ''){
				$select->where(array('c.id' => $indicacao));
			}
			if($cor != ''){
				$select->where(array('d.id' => $cor));
			}
			/*
			$select->where->NEST
				   ->notEqualTo('produto.lancamento',1)
				   ->or
				   ->isNull('produto.lancamento')
				   ->UNNEST;
			*/
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
	public function busca_en($formato,$colecao,$acabamento,$indicacao,$cor){
		$resultSet = $this->select(function(Select $select) use ($formato,$colecao,$acabamento,$indicacao,$cor){
			$select->join('colecao','colecao.id = produto.colecao',array('colecao_en'),'left');
			$select->join('linha','linha.id = produto.linha',array('linha'),'left');
			$select->join(array('a' => 'filtro'),'a.id = produto.formato',array('formato' => 'filtro_en'),'left');
			$select->join(array('b' => 'filtro'),'b.id = produto.acabamento',array('acabamento' => 'filtro_en'),'left');
			$select->join(array('c' => 'filtro'),'c.id = produto.indicacao',array('indicacao' => 'filtro_en'),'left');
			$select->join(array('d' => 'filtro'),'d.id = produto.cor',array('cor' => 'filtro_en'),'left');
			if($formato != ''){
				$select->where(array('a.id' => $formato));
			}
			if($colecao != ''){
				$select->where(array('colecao.id' => $colecao));
			}
			if($acabamento != ''){
				$select->where(array('b.id' => $acabamento));
			}
			if($indicacao != ''){
				$select->where(array('c.id' => $indicacao));
			}
			if($cor != ''){
				$select->where(array('d.id' => $cor));
			}
			/*
			$select->where->NEST
				   ->notEqualTo('produto.lancamento',1)
				   ->or
				   ->isNull('produto.lancamento')
				   ->UNNEST;
			*/
		});
		$resultSet->buffer();
		return $resultSet;
	}
	
}
