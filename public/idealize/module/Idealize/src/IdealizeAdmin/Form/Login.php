<?php
	namespace IdealizeAdmin\Form;

	use Zend\Form\Form;

	class Login extends Form{
		public function __construct($name=null){
			parent::__construct('login');
			$this->setAttribute('method','post');		
			$this->add(array(
				'name' => 'email',
				'options' => array(
					'type' => 'text',
					//'label' => 'E-mail: '
				),
				'attributes' => array(
					'id' => 'email',
					//'placeholder' => 'Entre com o e-mail'
				)
			));
			$this->add(array(
				'name' => 'password',
				'options' => array(
					'type' => 'password',
					//'label' => 'Senha: '
				),
				'attributes' => array(
					'id' => 'password',
					'type' => 'password',
					///'placeholder' => 'Entre com a senha'
				)
			));
			$this->add(array(
				'name' => 'submit',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
					'value' => 'Login',
					'id' => 'btnEnvia'
					//'class' => 'btn-success'
				)
			));
		}
	}
?>