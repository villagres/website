<?php
	
	namespace Idealize\Service;

	use Doctrine\ORM\EntityManager;
	use Idealize\Entity\Configurator;

	class Ponto extends AbstractService{
		public function __construct(EntityManager $em){
			parent::__construct($em);
			$this->entity = "Idealize\Entity\Ponto";
		}

		public function insert(array $data){
			$entity = new $this->entity($data);
			$entity->setPontos($data['ponto']);
			$entity->setDtPontos($data['dataponto']);
			$pessoa = $this->em->getReference("Idealize\Entity\Pessoa",$data['pessoa']);
			$entity->setIdPessoa($pessoa);			
			$this->em->persist($entity);
			$this->em->flush();
			return $entity;
		}

		public function update(array $data){
			$entity = $this->em->getReference($this->entity,$data['id']);
			$entity = Configurator::configure($entity,$data);
			$entity->setPontos($data['ponto']);
			$entity->setDtPontos($data['dataponto']);
			$pessoa = $this->em->getReference("Idealize\Entity\Pessoa",$data['pessoa']);
			$entity->setIdPessoa($pessoa);			
			$this->em->persist($entity);
			$this->em->flush();
			return $entity;
		}		
	}


?>