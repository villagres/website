<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $filtroTable;
	protected $bannerTable;
	protected $colecaoTable;
	protected $chamadaTable;
	
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
	
	public function getColecaoTable(){
		if (!$this->colecaoTable) {
             $sm = $this->getServiceLocator();
             $this->colecaoTable = $sm->get('Application\Model\ColecaoTable');
         }
         return $this->colecaoTable;
	}
	
	public function getChamadaTable(){
		if (!$this->chamadaTable) {
             $sm = $this->getServiceLocator();
             $this->chamadaTable = $sm->get('Application\Model\ChamadaTable');
         }
         return $this->chamadaTable;
	}
	
	public function idiomasAction(){
		$lang = $this->params()->fromQuery('lang');		
		
		switch($lang){
			case 'enus': 				
				setcookie('language', 'en_US', (time() + (1 * 24 * 3600))); 				
				break;
			//case 'ptbr': $_SESSION['language'] = 'pt_BR'; break;
			default: 				
				setcookie('language', 'pt_BR');				
				break;
		}
	}
	
    public function indexAction()
    {		
		$acabamentos = $this->getFiltroTable()->fetchAcabamento();
		$formatos = $this->getFiltroTable()->fetchFormato();
		$indicacoes = $this->getFiltroTable()->fetchIndicacao();
		$cores = $this->getFiltroTable()->fetchCor();
		$banners = $this->getBannerTable()->fetchAll();
		$colecoes = $this->getColecaoTable()->fetchAll();
		$chamadas = $this->getChamadaTable()->fetchAll();		
		
		$this->layout()->acabamentos = $acabamentos;				
		$this->layout()->formatos = $formatos; 
		$this->layout()->indicacoes = $indicacoes;
		$this->layout()->cores = $cores;
		$this->layout()->banners = $banners;
		$this->layout()->colecoes = $colecoes;
		$this->layout()->chamadas = $chamadas;
        return new ViewModel();
    }
}
