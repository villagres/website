<?php

	namespace IdealizeAdmin\Controller;

	use Zend\View\Model\ViewModel;

	class RegulamentoController extends CrudController{

		public function __construct(){
			$this->entity = "Idealize\Entity\Regulamento";
			$this->form = "IdealizeAdmin\Form\Regulamento";
			$this->service = "Idealize\Service\Regulamento";
			$this->controller = "regulamento";
			$this->route = "idealize-admin";
		}		

		public function newAction(){			
			$form = new $this->form();
			$request = $this->getRequest();
			if($request->isPost()){
				$form->setData(array_merge_recursive($request->getPost()->toArray(),$request->getFiles()->toArray()));
				if($form->isValid()){	
					$files = $request->getFiles();
					$filter = new \Zend\Filter\File\RenameUpload(array(
						"target" => "./public/img/regulamento/",
						"use_upload_extension " => true,
						"randomize" => true
					));
					$filter->filter($files['documento']);					
					$data = $request->getPost()->toArray();					
					$last = scandir('./public/img/regulamento/',SCANDIR_SORT_DESCENDING);
					$temp = '';
					$newest = '';
					foreach($last as $l){
						if(!in_array($l,['.','..'])){							
							if(filemtime('./public/img/regulamento/'.$l) > $temp){
								$newest = $l;
								$temp = filemtime('./public/img/regulamento/'.$l);
							}
						}
					}					
					$data['documento'] = $newest;					
					$service = $this->getServiceLocator()->get($this->service);
					$service->insert($data);
					
					return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
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
				$form->setData(array_merge_recursive($request->getPost()->toArray(),$request->getFiles()->toArray()));
				if($form->isValid()){
					$files = $request->getFiles();
					$filter = new \Zend\Filter\File\RenameUpload(array(
						"target" => "./public/img/regulamento/",
						"use_upload_extension " => true,
						"randomize" => true
					));
					$filter->filter($files['documento']);					
					$data = $request->getPost()->toArray();					
					$last = scandir('./public/img/regulamento/',SCANDIR_SORT_DESCENDING);
					$temp = '';
					$newest = '';
					foreach($last as $l){
						if(!in_array($l,['.','..'])){							
							if(filemtime('./public/img/regulamento/'.$l) > $temp){
								$newest = $l;
								$temp = filemtime('./public/img/regulamento/'.$l);
							}
						}
					}					
					$data['documento'] = $newest;					
					$service = $this->getServiceLocator()->get($this->service);
					$service->update($data);
					
					return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));	
				}
			}

			return new ViewModel(array('form'=>$form));
		}

	}