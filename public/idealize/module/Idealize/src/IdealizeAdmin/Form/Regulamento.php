<?php

	namespace IdealizeAdmin\Form;

	use Zend\Form\Form,
		Zend\Form\Element\Select,
		Zend\Form\Element\File;

	class Regulamento extends Form{

		public function __construct($name = null){

			parent::__construct('regulamento');
			$this->setAttribute('method','post');
			$this->setAttribute('enctype','multipart/form-data');

			$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden'
				)
			));

			$this->add(array(
				'name' => 'regulamento',
				'options' => array(
					'type' => 'text',
				),
				'attributes' => array(
					'id' => 'regulamento',
					'placeholder' => 'Entre com o nome do regulamento'
				)
			));

			$foto = new File('documento');
			$foto->setName('documento');
			$this->add($foto);			

			$this->add(array(
				'name' => 'submit',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
					'value' => 'Salvar',					
				)
			));

		}

	}