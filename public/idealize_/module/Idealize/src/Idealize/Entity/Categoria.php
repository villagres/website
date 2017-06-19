<?php

namespace Idealize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="categoria_idealize")
 * @ORM\Entity(repositoryClass="Idealize\Entity\CategoriaRepository")
 */
class Categoria{

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
	protected $categoria;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $imagem;	

	public function __construct($options = null){
		Configurator::configure($this,$options);		
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}

	public function getImagem(){
		return $this->imagem;
	}

	public function setImagem($imagem){
		$this->imagem = $imagem;
	}

	public function toArray(){
		return array(
			'id' => $this->getId(),
			'categoria' => $this->getCategoria(),
			'imagem' => $this->getImagem()
		);
	}

}