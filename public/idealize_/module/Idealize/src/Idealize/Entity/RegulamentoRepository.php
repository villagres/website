<?php
	
	namespace Idealize\Entity;

	use Doctrine\ORM\EntityRepository;

	class RegulamentoRepository extends EntityRepository{
		public function fetchPairs(){
			$entities = $this->findBy(array(), array('regulamento' => 'ASC'));				
			$array = array();
			foreach($entities as $entity){
				$array[$entity->getId()] = $entity->getRegulamento();
			}					
			return $array;
		}	
	}

?>