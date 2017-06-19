<?php
	
	namespace Idealize\Service;

	use Doctrine\ORM\EntityManager;	

	class Premiacao extends AbstractService{
		public function __construct(EntityManager $em){
			parent::__construct($em);
			$this->entity = 'Idealize\Entity\Premiacao';
		}

	}


?>