<?php
	
	namespace Idealize\Service;

	use Doctrine\ORM\EntityManager;	

	class Categoria extends AbstractService{
		public function __construct(EntityManager $em){
			parent::__construct($em);
			$this->entity = 'Idealize\Entity\Categoria';
		}

	}


?>