<?php
namespace Login\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
class User implements InputFilterAwareInterface{
	public $id;
	public $user;
	public $pass;
	public $nivel;
	protected $inputFilter;
	
	public function setPassword($clear_password){
		$this->pass = md5($clear_password);
	}
	
	function exchangeArray($data){
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->user = (isset($data['user'])) ? $data['user'] : null;
		if(isset($data['pass'])){
			$this->setPassword($data['pass']);
		}
		$this->nivel = (isset($data['nivel'])) ? $data['nivel'] : 2;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter){
		throw new \Exception('Não utilizado');
	}
	
	public function getInputFilter(){
		if(!$this->inputFilter){
			$inputFilter = new InputFilter();
			$inputFilter->add(array(
				'name' => 'id',
				'required' => 'false',
				'filters' => array(
					array('name' => 'Int')
				)
			));
			$inputFilter->add(array(
				'name' => 'user',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim')
				),
				'validators' => array(
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array(
								'isEmpty' => 'Campo não pode ser vazio'
							)
						)
					)
				)
			));
			$inputFilter->add(array(
				'name' => 'pass',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim') 
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 10
						)								
					),
					array(
						'name' => 'NotEmpty',
						'options' => array(
							'messages' => array(
								'isEmpty' => 'Campo não pode ser vazio'
							)	
						)								
					)
				) 
			));
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
	
}


?>