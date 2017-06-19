<?php
	namespace IdealizeAdmin\Form;

	use Zend\Form\Form,
		Zend\Form\Element\Select;

	class Pessoa extends Form{

		protected $categorias;

		public function __construct($name=null, array $categorias = null, array $regulamentos = null){
			parent::__construct('pessoa');
			$this->categorias = $categorias;
			$this->regulamentos = $regulamentos;
			$this->setAttribute('method','post');
			$this->setInputFilter(new PessoaFilter);
			$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden'
				)
			));
			$this->add(array(
				'name' => 'nome',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'nome',
					'placeholder' => 'Entre com o nome'
				)
			));
			$this->add(array(
				'name' => 'empresa',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'empresa',
					'placeholder' => 'Entre com o nome da empresa'
				)
			));
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
			$regulamento = new Select();
			$regulamento->setName('regulamento')
					   ->setOptions(array('value_options'=>$this->regulamentos));					   
			$this->add($regulamento);
			$categorias = new Select();
			$categorias->setName('categoria')
					   ->setOptions(array('value_options'=>$this->categorias));					 
			$this->add($categorias);			
			$this->add(array(
				'name' => 'email',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'email',
					'placeholder' => 'Entre com o e-mail'
				)
			));
			$this->add(array(
				'name' => 'senha',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'senha',
					'placeholder' => 'Entre com a senha'
				)
			));
			$this->add(array(
				'name' => 'dtCadastro',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'dtCadastro',					
				)
			));
			$this->add(array(
				'name' => 'dtInicioParticipacao',
				'options' => array(
					'type' => 'text',					
				),
				'attributes' => array(
					'id' => 'dtInicioParticipacao',					
				)
			));
			$administrador = new Select();
			$administrador->setName("administrador")
					 ->setValueOptions(array(
					 	'0' => 'Não',
					 	'1' => 'Sim'					 	
					 ));
			$this->add($administrador);
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