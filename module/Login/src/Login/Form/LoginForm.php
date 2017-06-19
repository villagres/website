<?php
namespace Login\Form;
use Zend\Form\Form;
class LoginForm extends Form{
	public function __construct($name = null){
		parent::__construct('Login');
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype', 'multipart/form-data');
		$this->add(array(
			'name' => 'txtUsuario',
			'attributes' => array(
				'type' => 'text',
			),
			'options' => array(
				'label' => utf8_encode('Usuário'),
			),
		));
		$this->add(array(
			'name' => 'txtSenha',
			'attributes' => array(
				'type' => 'password',
			),
			'options' => array(
				'label' => 'Senha',
			),
		));
		$this->add(array(
			'name' => 'btnLogar',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Logar',
			),
		));
	}
}

?>