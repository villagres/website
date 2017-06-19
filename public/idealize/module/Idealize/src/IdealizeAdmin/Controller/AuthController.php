<?php

namespace IdealizeAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use IdealizeAdmin\Form\Login as LoginForm;

class AuthController extends AbstractActionController{
	public function indexAction(){
		$form = new LoginForm();
		$error = false;
		$request = $this->getRequest();
		if($request->isPost()){
			$form->setData($request->getPost());
			if($form->isValid()){
				$data = $request->getPost()->toArray();
				$auth = new AuthenticationService;
				$sessionStorage = new SessionStorage("IdealizeAdmin");
				$auth->setStorage($sessionStorage);
				$authAdapter = $this->getServiceLocator()->get('Idealize\Auth\Adapter');
				$authAdapter->setUsername($data['email'])
							->setPassword($data['password']);
				$result = $auth->authenticate($authAdapter);
				if($result->isValid()){
					$sessionStorage->write($auth->getIdentity()['user'],null);
					if($auth->getIdentity()->getAdministrador() == "1"){
						return $this->redirect()->toRoute('admin',array('controller'=>'index'));
					}else{
						return $this->redirect()->toRoute('home',array('controller'=>'index'));	
					}
				}
				else{					
					$error = true;
				}
			}	
		}
		return new ViewModel(array('form'=>$form,'error'=>$error));
	}

	public function logoutAction(){
		$auth = new AuthenticationService;
		$auth->setStorage(new SessionStorage('IdealizeAdmin'));
		$auth->clearIdentity();
		return $this->redirect()->toRoute('idealize-admin-auth');
	}

}