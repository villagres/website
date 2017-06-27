<?php

	namespace IdealizeAdmin\Controller;

	use Zend\Mvc\Controller\AbstractActionController,
		Zend\View\Model\ViewModel;

	use Zend\Paginator\Paginator,
		Zend\Paginator\Adapter\ArrayAdapter;

	abstract class CrudController extends AbstractActionController{

		/**
		 * @var EntityManager
		 */
		protected $em;
		protected $service;
		protected $entity;
		protected $form;
		protected $route;
		protected $controller;

		public function indexAction(){
			$list = $this->getEm()
					->getRepository($this->entity)
					->findAll();
			
			$page = $this->params()->fromRoute('page');

			$paginator = new Paginator(new ArrayAdapter($list));
			$paginator->setCurrentPageNumber($page);
			$paginator->setDefaultItemCountPerPage(10);
			return new ViewModel(array('data' => $paginator,'page'=>$page));
		}

		public function relatorioPessoasAction(){
			$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');        
        	$dados = $em->createQuery(
				"SELECT a.id, a.dtCadastro, a.empresa, a.lojaParceira, a.nome, a.email, a.senha,
				(select min(x.dtPontos) from Idealize\Entity\Ponto x where x.idPessoa = a.id) as inicio,
				(select max(y.dtPontos) from Idealize\Entity\Ponto y where y.idPessoa = a.id) as fim  
				FROM Idealize\Entity\Pessoa a");	
        	$resultado = $dados->getResult();
        	$row = 2;

			$ea = new \PHPExcel();			
			$ews = $ea->getSheet(0);			
			$ews->setCellValue('a1', 'ID');
			$ews->setCellValue('b1', 'Data de cadastro');
			$ews->setCellValue('c1', 'Empresa');
			$ews->setCellValue('d1', 'Loja Parceira');
			$ews->setCellValue('e1', 'Nome');
			$ews->setCellValue('f1', 'E-mail');
			$ews->setCellValue('g1', 'Senha');
			$ews->setCellValue('h1', 'Início participação');
			$ews->setCellValue('i1', 'Fim participação');

			$ea->getActiveSheet()->getStyle('a1:h1')->getFont()->setBold(true);

			foreach($resultado as $result){
				$ews->setCellValue('a'.$row, $result['id']);
				$ews->setCellValue('b'.$row, $result['dtCadastro']);
				$ews->setCellValue('c'.$row, $result['empresa']);
				$ews->setCellValue('d'.$row, $result['lojaParceira']);
				$ews->setCellValue('e'.$row, $result['nome']);
				$ews->setCellValue('f'.$row, $result['email']);
				$ews->setCellValue('g'.$row, $result['senha']);
				$ews->setCellValue('h'.$row, $result['inicio']);
				$ews->setCellValue('i'.$row, $result['fim']);				
				$row++;
			}

			foreach(range('a','i') as $columnID)
			{
    			$ea->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="completo.xlsx"');
			header('Cache-Control: max-age=0');

			$writer = \PHPExcel_IOFactory::createWriter($ea, 'Excel2007');            			
			ob_end_clean();
			$writer->save('php://output');
			return new ViewModel();
		}

		public function relatorioPontosAction(){
			$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');        
        	$dados = $em->createQuery(
				"SELECT a.id, a.pontos, a.formato, a.dtPontos, a.metragem, a.lojaParceira, b.nome, b.empresa				
				FROM Idealize\Entity\Ponto a JOIN Idealize\Entity\Pessoa b with b.id = a.idPessoa");	
        	$resultado = $dados->getResult();
        	$row = 2;

			$ea = new \PHPExcel();			
			$ews = $ea->getSheet(0);			
			$ews->setCellValue('a1', 'ID');
			$ews->setCellValue('b1', 'Pontos');
			$ews->setCellValue('c1', 'Formato');
			$ews->setCellValue('d1', 'Data dos pontos');
			$ews->setCellValue('e1', 'Metragem (M²)');
			$ews->setCellValue('f1', 'Loja Parceira');
			$ews->setCellValue('g1', 'Nome');
			$ews->setCellValue('h1', 'Empresa');			

			$ea->getActiveSheet()->getStyle('a1:h1')->getFont()->setBold(true);

			foreach($resultado as $result){
				$ews->setCellValue('a'.$row, $result['id']);
				$ews->setCellValue('b'.$row, $result['pontos']);
				$ews->setCellValue('c'.$row, $result['formato']);
				$ews->setCellValue('d'.$row, $result['dtPontos']);
				$ews->setCellValue('e'.$row, $result['metragem']);
				$ews->setCellValue('f'.$row, $result['lojaParceira']);
				$ews->setCellValue('g'.$row, $result['nome']);
				$ews->setCellValue('h'.$row, $result['empresa']);			
				$row++;
			}

			foreach(range('a','h') as $columnID)
			{
    			$ea->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="pontos.xlsx"');
			header('Cache-Control: max-age=0');

			$writer = \PHPExcel_IOFactory::createWriter($ea, 'Excel2007');            			
			ob_end_clean();
			$writer->save('php://output');
			return new ViewModel();
		}

		public function newAction(){
			$list = $this->getEm()
					->getRepository($this->entity)
					->findAll();					

			$paginator = new Paginator(new ArrayAdapter($list));
			$paginator->setDefaultItemCountPerPage(10);

			$page = $paginator;

			// var_dump($page->getPages()->pageCount);die();

			$form = new $this->form();
			$request = $this->getRequest();
			if($request->isPost()){
				$form->setData($request->getPost());
				if($form->isValid()){	
					$service = $this->getServiceLocator()->get($this->service);
					$service->insert($request->getPost()->toArray());
					
					return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));	
					// return $this->redirect()->toUrl('/idealize/public/admin/usuarios/page/'.$page->getPages()->pageCount);
				}
			}			

			return new ViewModel(array('form'=>$form));
		}

		public function editAction(){
			$form = new $this->form();
			$request = $this->getRequest();
			$repository = $this->getEm()->getRepository($this->entity);
			$entity = $repository->find($this->params()->fromRoute('id',0));
			if($this->params()->fromRoute('id',0)){
				$form->setData($entity->toArray());
			}
			if($request->isPost()){
				$form->setData($request->getPost());
				if($form->isValid()){
					$service = $this->getServiceLocator()->get($this->service);
					$service->update($request->getPost()->toArray());
					
					return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));	
				}
			}

			return new ViewModel(array('form'=>$form));
		}

		public function deleteAction(){
			$service = $this->getServiceLocator()->get($this->service);
			if($service->delete($this->params()->fromRoute('id',0)))
				return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
		}

		/*
		 * @return EntityManager
		 */

		protected function getEm(){
			if(null === $this->em)
				$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			return $this->em;
		}


	}

?>