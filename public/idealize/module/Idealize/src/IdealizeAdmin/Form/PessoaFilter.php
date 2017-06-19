<?php 
	
	namespace IdealizeAdmin\Form;

	use Zend\InputFilter\InputFilter;

	class PessoaFilter extends InputFilter{
		public function __construct(){
			$this->add(array(
				'name' => 'nome',
				'required' => true,
				'filters' => array(
					array('name'=>'StripTags'),
					array('name'=>'StringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array('isEmpty' => 'Nome não pode estar em branco'),
						)
					)
				)
			));
			$this->add(array(
				'name' => 'empresa',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array('isEmpty' => 'Empresa não pode estar em branco'),
						)
					)
				)
			));
			$this->add(array(
				'name' => 'email',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim') 
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array('isEmpty' => 'E-mail não pode estar em branco'),
						)
					)
				)
			));
			$this->add(array(
				'name' => 'senha',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array('isEmpty' => 'Senha não pode estar em branco'),
						)
					)
				)
			));
		}
	}


?>