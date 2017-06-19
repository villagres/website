<?php
	namespace IdealizeAdmin\Form;

	use Zend\Form\Form,
		Zend\Form\Element\Select,
		Zend\Form\Element\File,
		Zend\Form\Element\Image;

	class Premiacao extends Form{

		protected $regulamentos;

		public function __construct($name=null, array $regulamentos = null){
			parent::__construct('premiacao');			
			$this->regulamentos = $regulamentos;
			$this->setAttribute('method','post');			
			$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden'
				)
			));
			$this->add(array(
				'name' => 'descricao',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'descricao',
					'placeholder' => 'Entre com a descrição'
				)
			));
			$this->add(array(
				'name' => 'pontuacao',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'pontuacao',
					'placeholder' => 'Entre com a pontuação'
				)
			));
			$regulamento = new Select();
			$regulamento->setName('regulamento')
					   ->setOptions(array('value_options'=>$this->regulamentos));					   
			$this->add($regulamento);
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