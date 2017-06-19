<?php

namespace Idealize\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="regulamento")
 * @ORM\Entity(repositoryClass="Idealize\Entity\RegulamentoRepository")
 */
class Regulamento{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var int
	 */ 
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $regulamento;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $documento;	

	public function __construct($options = null){
		Configurator::configure($this,$options);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getRegulamento(){
		return $this->regulamento;
	}

	public function setRegulamento($regulamento){
		$this->regulamento = $regulamento;
	}

	public function getDocumento(){
		return $this->documento;
	}

	public function setDocumento($documento){
		$this->documento = $documento;
	}	

	public function toArray(){
		return array(
			'id' => $this->getId(),
			'regulamento' => $this->getRegulamento(),
			'documento' => $this->getDocumento()
		);
	}

}