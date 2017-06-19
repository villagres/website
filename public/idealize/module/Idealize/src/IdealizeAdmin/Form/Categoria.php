<?php

	namespace IdealizeAdmin\Form;

	use Zend\Form\Form,
		Zend\Form\Element\Select,
		Zend\Form\Element\File,
		Zend\Form\Element\Image;

	class Categoria extends Form{

		public function __construct($name = null){
			parent::__construct('categoria');
			//$this->setInputFilter(new CategoriaFilter());
			$this->setAttribute('method','post');
			$this->setAttribute('enctype','multipart/form-data');
			$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden'
				)
			));
			$this->add(array(
				'name' => 'categoria',
				'options' => array(
					'type' => 'text',
				),
				'attributes' => array(
					'id' => 'categoria',
					'placeholder' => 'Entre com a categoria'
				)
			));
			
			$foto = new File('imagem');
			$foto->setName('imagem');
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

?>