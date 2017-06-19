<?php
	
	namespace Idealize\Entity;

	use Doctrine\ORM\Mapping as ORM;


	/**
	 * @ORM\Entity
	 * @ORM\Table(name="pontos")
	 * @ORM\Entity(repositoryClass="Idealize\Entity\PontoRepository")
	 */
	class Ponto{

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
		protected $pontos;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $formato;

 		/**
 		 * @ORM\Column(type="text")
 		 * @var string
 		 */
		protected $dtPontos;

		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */		
		protected $metragem;
		
		/**
		 * @ORM\Column(type="text")
		 * @var string
		 */
		protected $lojaParceira;

		/**
		 * @ORM\ManyToOne(targetEntity="Idealize\Entity\Pessoa",inversedBy="ponto")
		 * @ORM\JoinColumn(name="idPessoa",referencedColumnName="id")
		 */		
		protected $idPessoa;

		public function __construct($options = null){
			Configurator::configure($this,$options);
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getPontos(){
			return $this->pontos;
		}

		public function setPontos($pontos){
			$this->pontos = $pontos;
		}

		public function getFormato(){
			return $this->formato;
		}

		public function setFormato($formato){
			$this->formato = $formato;
		}

		public function getDtPontos(){
			return $this->dtPontos;
		}

		public function setDtPontos($dtPontos){
			$this->dtPontos = $dtPontos;
		}

		public function getMetragem(){
			return $this->metragem;
		}

		public function setMetragem($metragem){
			$this->metragem = $metragem;
		}

		public function getLojaParceira(){
			return $this->lojaParceira;
		}

		public function setLojaParceira($lojaParceira){
			$this->lojaParceira = $lojaParceira;
		}

		public function getIdPessoa(){
			return $this->idPessoa;
		}		

		public function setIdPessoa($idPessoa){
			$this->idPessoa = $idPessoa;
		}

		public function toArray(){
			return array(
				'id' => $this->getId(),
				'ponto' => $this->getPontos(),
				'formato' => $this->getFormato(),
				'dataponto' => $this->getDtPontos(),
				'pessoa' => $this->getIdPessoa()->getId(),
				'metragem' => $this->getMetragem(),
				'lojaparceira' => $this->getLojaParceira()
			);
		}
	}
