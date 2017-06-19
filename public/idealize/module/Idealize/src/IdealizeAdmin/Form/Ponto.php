<?php
	namespace IdealizeAdmin\Form;

	use Zend\Form\Form,
		Zend\Form\Element\Select;


	class Ponto extends Form{

		protected $pessoas;

		public function __construct($name=null, array $pessoas = null){
			parent::__construct('frmPontos');
			$this->pessoas = $pessoas;
			$this->setAttribute('method','post');
			$this->setAttribute('enctype','multipart/form-data');
			$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden'
				)
			));
			$this->add(array(
				'name' => 'ponto',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'ponto',
					'placeholder' => 'Entre com o número de pontos'
				)
			));
			$formatos = new Select();
			$formatos->setName("formato")
					 ->setValueOptions(array(
					 	'24,5x100' => '24,5x100',
					 	'24,5x100(Touch)' => '24,5x100(Touch)',
					 	'25x25(Santa)' => '25x25(Santa)',
						'30x30' => '30x30',
						'30x107(Touch)' => '30x107(Touch)',
						'31x108' => '31x108',
						'49x99(Touch)' => '49x99(Touch)',
					 	'50x100' => '50x100',
					 	'60x60' => '60x60',
						'62x107(Touch)' => '62x107(Touch)',
						'63x108' => '63x108',
						'71x71(Touch)' => '71x71(Touch)',
					 	'71x71' => '71x71'
					 ));
			$this->add($formatos);

			$this->add(array(
				'name' => 'metragem',
				'options' => array(
					'type' => 'text',
				),
				'attributes' => array(
					'id' => 'metragem',
					'placeholder' => 'Entre com a metragem'
				)
			));

			$pessoa = new Select();
			$pessoa->setName("pessoa")
				   ->setOptions(array('value_options'=>$this->pessoas)
				   	);
			$this->add($pessoa);

			$this->add(array(
				'name' => 'lojaparceira',
				'options' => array(
					'type' => 'text',
				),
				'attributes' => array(
					'id' => 'lojaparceira',
					'placeholder' => 'Entre com a loja parceira'
				)
			));

			$this->add(array(
				'name' => 'dataponto',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'dataponto',					
				)
			));

			$this->add(array(
				'name' => 'submit',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
					'value' => 'Salvar',					
				)
			));
		}
	}