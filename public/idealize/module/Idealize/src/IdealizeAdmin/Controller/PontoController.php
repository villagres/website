<?php

	namespace IdealizeAdmin\Controller;
	use Zend\View\Model\ViewModel;

	use Zend\Paginator\Paginator,
		Zend\Paginator\Adapter\ArrayAdapter;

	class PontoController extends CrudController{
		public function __construct(){
			$this->entity = "Idealize\Entity\Ponto";
			$this->form = "IdealizeAdmin\Form\Ponto";
			$this->service = "Idealize\Service\Ponto";
			$this->controller = "pontos";
			$this->route = "idealize-admin";
		}		

		public function newAction(){
			$list = $this->getEm()
					->getRepository($this->entity)
					->findAll();					

			$paginator = new Paginator(new ArrayAdapter($list));
			$paginator->setDefaultItemCountPerPage(10);

			$page = $paginator;

			$form = $this->getServiceLocator()->get($this->form);			
			$request = $this->getRequest();			
			if($request->isPost()){				
				$form->setData($request->getPost());				
				if($form->isValid()){
					$service = $this->getServiceLocator()->get($this->service);						
					$service->insert($request->getPost()->toArray());
					
					return $this->redirect()->toUrl('/idealize/public/admin/pontos/page/'.$page->getPages()->pageCount);
				}
			}			

			return new ViewModel(array('form'=>$form));
		}

		public function editAction(){			
			$form = $this->getServiceLocator()->get($this->form);
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

	}

?>