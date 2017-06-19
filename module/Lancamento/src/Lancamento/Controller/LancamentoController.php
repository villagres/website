<?php

namespace Lancamento\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LancamentoController extends AbstractActionController{
	protected $linhaTable;
	protected $linhaFormatoTable;
	protected $colecaoTable;
	protected $filtroTable;
	protected $bannerTable;
	protected $produtoTable;
	protected $legendaProdutoTable;
	protected $imagemProdutoTable;
	protected $faceProdutoTable;
	protected $teste;
	
	public function teste(){
		if(!$this->teste){
			$sm = $this->getServiceLocator();
			$this->teste = $sm->get('Application\Model\ProdutoTable');
		}
		return $this->teste;
	}
		
	public function getProdutoTable(){
		if (!$this->produtoTable) {
			 $sm = $this->getServiceLocator();
			 $this->produtoTable = $sm->get('Application\Model\ProductTable');
		 }
		 return $this->produtoTable;
	}
		
	public function getLinhaTable(){
		if (!$this->linhaTable) {
			 $sm = $this->getServiceLocator();
			 $this->linhaTable = $sm->get('Application\Model\LinhaTable');
		 }
		 return $this->linhaTable;
	}
		
	public function getLinhaFormatoTable(){
		if (!$this->linhaFormatoTable) {
			 $sm2 = $this->getServiceLocator();
			 $this->linhaFormatoTable = $sm2->get('Application\Model\LinhaFormatoTable');
		 }
		 return $this->linhaFormatoTable;
	}
				
	public function getColecaoTable(){
		if (!$this->colecaoTable) {
			 $sm = $this->getServiceLocator();
			 $this->colecaoTable = $sm->get('Application\Model\ColecaoTable');
		 }
		 return $this->colecaoTable;
	}
		
	public function getFiltroTable(){
		if (!$this->filtroTable) {
            $sm = $this->getServiceLocator();
            $this->filtroTable = $sm->get('Application\Model\FiltroTable');
        }
        return $this->filtroTable;
	}
	
	public function getBannerTable(){
		if (!$this->bannerTable) {
             $sm = $this->getServiceLocator();
             $this->bannerTable = $sm->get('Application\Model\BannerTable');
         }
         return $this->bannerTable;
	}
	
	public function indexAction(){
		$acabamentos = $this->getFiltroTable()->fetchAcabamento();
		$formatos = $this->getFiltroTable()->fetchFormato();
		$indicacoes = $this->getFiltroTable()->fetchIndicacao();
		$cores = $this->getFiltroTable()->fetchCor();
		$banners = $this->getBannerTable()->fetchAll();
		$colecoes = $this->getColecaoTable()->fetchAll();
		$this->layout()->acabamentos = $acabamentos;				
		$this->layout()->formatos = $formatos; 
		$this->layout()->indicacoes = $indicacoes;
		$this->layout()->cores = $cores;
		$this->layout()->banners = $banners;
		$this->layout()->colecoes = $colecoes;
			
		$colecao = $this->params()->fromRoute('id',0);
		//$linhas = $this->getLinhaTable()->fetchAll($colecao);
		$linhas = $this->getLinhaTable()->fetchLancamentos();
		$formatos = $this->getFiltroTable()->fetchLinhas();			
		$view = new ViewModel(array('linhas' => $linhas,'formatos'=>$formatos));
		return $view;
	}

	public function linhaAction(){
		$acabamentos = $this->getFiltroTable()->fetchAcabamento();
		$formatos = $this->getFiltroTable()->fetchFormato();
		$indicacoes = $this->getFiltroTable()->fetchIndicacao();
		$cores = $this->getFiltroTable()->fetchCor();
		$banners = $this->getBannerTable()->fetchAll();
		$colecoes = $this->getColecaoTable()->fetchAll();
		$this->layout()->acabamentos = $acabamentos;				
		$this->layout()->formatos = $formatos; 
		$this->layout()->indicacoes = $indicacoes;
		$this->layout()->cores = $cores;
		$this->layout()->banners = $banners;
		$this->layout()->colecoes = $colecoes;
		$cod = $this->params()->fromRoute('id',0);
		//$produtos = $this->getProdutoTable()->fetchAll($cod);
		$produtos = $this->getProdutoTable()->fetchLancamentos($cod);
		$faceProduto = $this->getProdutoTable()->fetchFace();
		$linha = $this->getLinhaTable()->getLinha($cod);
		$view = new ViewModel(array(
			'produtos' => $produtos,
			'faces' => $faceProduto,
			'linha' => $linha
			));
		return $view;
	}

	public function produtoAction(){
		$acabamentos = $this->getFiltroTable()->fetchAcabamento();
		$formatos = $this->getFiltroTable()->fetchFormato();
		$indicacoes = $this->getFiltroTable()->fetchIndicacao();
		$cores = $this->getFiltroTable()->fetchCor();
		$banners = $this->getBannerTable()->fetchAll();
		$colecoes = $this->getColecaoTable()->fetchAll();
		$this->layout()->acabamentos = $acabamentos;				
		$this->layout()->formatos = $formatos; 
		$this->layout()->indicacoes = $indicacoes;
		$this->layout()->cores = $cores;
		$this->layout()->banners = $banners;
		$this->layout()->colecoes = $colecoes;
		$cod = $this->params()->fromRoute('id',0);
		$produtos = $this->getProdutoTable()->fetchProduto($cod);
		$faceProduto = $this->getProdutoTable()->fetchFaces($cod);
		$imagemProduto = $this->getProdutoTable()->fetchImagens($cod);
		$legendaProduto = $this->getProdutoTable()->fetchLegendas($cod);
		$view = new ViewModel(array(
			'produtos' => $produtos,
			'faces' => $faceProduto,
			'imagens' => $imagemProduto,
			'legendas' => $legendaProduto
			));
		return $view;
	}
	
}