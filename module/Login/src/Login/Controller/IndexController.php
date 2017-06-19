<?php
	namespace Login\Controller;
	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	use Zend\Authentication\Result;
	use Zend\Authentication\AuthenticationService;
	use Zend\Authentication\Storage\Session as SessionStorage;
	use Zend\Db\Adapter\Adapter as DbAdapter;
	use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
	use Zend\Db\TableGateway\TableGateway;
	use Login\Form\LoginForm;
	use Zend\File\Transfer\Adapter\Http;  
	
	class IndexController extends AbstractActionController{
		
		public function getAuthService(){
			if(!isset($this->authService)){
				$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
				$dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter,'usuario','user','pass');
				$authService = new AuthenticationService();
				$authService->setAdapter($dbTableAuthAdapter);
				$this->authService = $authService; 
			}
			return $this->authService;
		}
		
		public function indexAction(){
			$this->getAuthService()->getStorage()->clear();
			$form = new LoginForm();
			$viewModel = new ViewModel(array('form'=>$form));
			return $viewModel;
		}
		
		public function successAction(){
			$user = $this->getAuthService()->getStorage()->read();
			if($user != ''){
				return new ViewModel();
			}
			else{
				return $this->redirect()->toRoute(NULL,array('action'=>'index'));
			}
		}
		
		public function processAction(){
			$senha = md5($this->request->getPost('txtSenha'));
			$usuario = $this->request->getPost('txtUsuario');
			if($usuario != ''){
				$this->getAuthService()->getAdapter()->setIdentity($this->request->getPost('txtUsuario'))->setCredential($senha);
				$result = $this->getAuthService()->authenticate();
				if($result->isValid()){
					$this->getAuthService()->getStorage()->write($this->request->getPost('txtUsuario'));
					return $this->redirect()->toRoute(NULL,array('controller'=>'Index','action'=>'success'));
				}else{
					return $this->redirect()->toRoute(NULL,array('action'=>'index'));
				}	
			}
			else{
				return $this->redirect()->toRoute(NULL,array('action'=>'index'));
			}				
		}					
	}

?>