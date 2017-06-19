<?php

namespace Downloads\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DownloadsController extends AbstractActionController
{

	protected $downloadsTable;
	protected $colecaoTable;
	protected $filtroTable;
	protected $bannerTable;

	public function getDownloadsTable()
	{
		if(!$this->downloadsTable){
			$sm = $this->getServiceLocator();
			$this->downloadsTable = $sm->get('Downloads\Model\DownloadsTable');
		}
		return $this->downloadsTable;
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

	public function indexAction()
	{
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
		
		return new ViewModel(
			array(
				'revistas' => $this->getDownloadsTable()->fetchType(2),
				'catalogos' => $this->getDownloadsTable()->fetchType(1),
				'manuais' => $this->getDownloadsTable()->fetchType(3),
				'logotipos' => $this->getDownloadsTable()->fetchType(4)
			)
		);
	}
}