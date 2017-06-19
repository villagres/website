<?php

	namespace Idealize\Entity;

	use Doctrine\ORM\Mapping as ORM;
	use Doctrine\Common\Collections\ArrayCollection;

	/**
	 * @ORM\Entity 
	 * @ORM\Table(name="pessoa")
	 * @ORM\Entity(repositoryClass="Idealize\Entity\PessoaRepository")
	 */

	class Pessoa{

		public function __construct($options = null){
			Configurator::configure($this,$options);
			$this->pontos = new ArrayCollection();
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
		protected $nome;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $empresa;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $email;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $senha;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $administrador;
		
		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $dtCadastro;
		
		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $dtInicioParticipacao;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $regulamento;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $categoria;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $lojaParceira;

		/**
		 * @ORM\OneToMany(targetEntity="Idealize\Entity\Ponto",mappedBy="pessoa")
		 */
		protected $pontos;		

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getEmpresa(){
			return $this->empresa;
		}

		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($senha){
			$this->senha = $senha;
		}

		public function getAdministrador(){
			return $this->administrador;
		}
		
		public function getDtCadastro(){
			return $this->dtCadastro;
		}
		
		public function setDtCadastro($dtCadastro){
			$this->dtCadastro = $dtCadastro;
		}
		
		public function getDtInicioParticipacao(){
			return $this->dtInicioParticipacao;
		}
		
		public function setDtInicioParticipacao($dtInicioParticipacao){
			$this->dtInicioParticipacao = $dtInicioParticipacao;
		}

		public function getRegulamento(){
			return $this->regulamento;
		}

		public function setRegulamento($regulamento){
			$this->regulamento = $regulamento;
		}

		public function getCategoria(){
			return $this->categoria;
		}

		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}

		public function getLojaParceira(){
			return $this->lojaParceira;
		}

		public function setLojaParceira($lojaParceira){
			$this->lojaParceira = $lojaParceira;
		}	

		public function setAdministrador($administrador){
			$this->administrador = $administrador;
		}

		public function __toString(){
			return $this->nome;
		}

		public function getPontos(){
			return $this->pontos;
		}

		public function toArray(){
			return array(
				'id'=>$this->getId(),
				'nome'=>$this->getNome(),
				'empresa'=>$this->getEmpresa(),
				'email'=>$this->getEmail(),
				'senha'=>$this->getSenha(),
				'administrador'=>$this->getAdministrador(),
				'dtCadastro'=>$this->getDtCadastro(), 
				'regulamento'=>$this->getRegulamento(), 
				'categoria'=>$this->getCategoria(),
				'lojaparceira' => $this->getLojaParceira(),
				'dtInicioParticipacao' => $this->getDtInicioParticipacao()
			);
		}

	}


?>