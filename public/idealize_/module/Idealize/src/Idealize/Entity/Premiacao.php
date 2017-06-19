<?php

namespace Idealize\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="premiacao")
 * @ORM\Entity(repositoryClass="Idealize\Entity\PremiacaoRepository")
 */

class Premiacao{

	public function __construct($options = null){
		Configurator::configure($this,$options);
	}

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var int
	 */	
	protected $id;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $descricao;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */	
	protected $pontuacao;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $regulamento;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $imagem;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getPontuacao(){
		return $this->pontuacao;
	}

	public function setPontuacao($pontuacao){
		$this->pontuacao = $pontuacao;
	}

	public function getRegulamento(){
		return $this->regulamento;
	}

	public function setRegulamento($regulamento){
		$this->regulamento = $regulamento;
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
			'descricao' => $this->getDescricao(),
			'pontuacao' => $this->getPontuacao(),
			'regulamento' => $this->getRegulamento(),
			'imagem' => $this->getImagem()
		);
	}

}