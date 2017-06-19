<?php

	namespace IdealizeAdmin\Controller;

	use Zend\View\Model\ViewModel;

	use Zend\Paginator\Paginator,
		Zend\Paginator\Adapter\ArrayAdapter;

	class PremiacaoController extends CrudController{
		public function __construct(){
			$this->entity = "Idealize\Entity\Premiacao";
			$this->form = "IdealizeAdmin\Form\Premiacao";
			$this->service = "Idealize\Service\Premiacao";
			$this->controller = "premiacao";
			$this->route = "idealize-admin";
		}

		public function newAction(){
			$list = $this->getEm()
					->getRepository($this->entity)
					->findAll();					

			$paginator = new Paginator(new ArrayAdapter($list));
			$paginator->setDefaultItemCountPerPage(10);

			$page = $paginator;

			// var_dump($page->getPages()->pageCount);die();

			$form = $this->getServiceLocator()->get($this->form);
			$request = $this->getRequest();
			if($request->isPost()){
				$form->setData(array_merge_recursive($request->getPost()->toArray(),$request->getFiles()->toArray()));
				if($form->isValid()){	
					$files = $request->getFiles();
					$filter = new \Zend\Filter\File\RenameUpload(array(
						"target" => "./public/img/premiacao/",
						"use_upload_extension " => true,
						"randomize" => true
					));
					$filter->filter($files['imagem']);					
					$data = $request->getPost()->toArray();					
					$last = scandir('./public/img/premiacao/',SCANDIR_SORT_DESCENDING);
					$temp = '';
					$newest = '';
					foreach($last as $l){
						if(!in_array($l,['.','..'])){							
							if(filemtime('./public/img/premiacao/'.$l) > $temp){
								$newest = $l;
								$temp = filemtime('./public/img/premiacao/'.$l);
							}
						}
					}					
					$data['imagem'] = $newest;					
					$service = $this->getServiceLocator()->get($this->service);
					$service->insert($data);
					
					// return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));	
					return $this->redirect()->toUrl('/idealize/public/admin/premiacao/page/'.$page->getPages()->pageCount);
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
				$form->setData(array_merge_recursive($request->getPost()->toArray(),$request->getFiles()->toArray()));				
				if($form->isValid()){
					$files = $request->getFiles();
					$filter = new \Zend\Filter\File\RenameUpload(array(
						"target" => "./public/img/premiacao/",
						"use_upload_extension " => true,
						"randomize" => true
					));
					$filter->filter($files['imagem']);					
					$data = $request->getPost()->toArray();					
					$last = scandir('./public/img/premiacao/',SCANDIR_SORT_DESCENDING);
					$temp = '';
					$newest = '';
					foreach($last as $l){
						if(!in_array($l,['.','..'])){							
							if(filemtime('./public/img/premiacao/'.$l) > $temp){
								$newest = $l;
								$temp = filemtime('./public/img/premiacao/'.$l);
							}
						}
					}					
					$data['imagem'] = $newest;					
					$service = $this->getServiceLocator()->get($this->service);
					$service->update($data);
					
					return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));	
				}
			}			
			return new ViewModel(array('form'=>$form));
		}		
	}

?>