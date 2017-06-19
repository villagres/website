<?php
	
	namespace Idealize\Entity;

	use Doctrine\ORM\EntityRepository;

	class CategoriaRepository extends EntityRepository{
		public function fetchPairs(){
			$entities = $this->findBy(array(), array('categoria' => 'ASC'));				
			$array = array();
			foreach($entities as $entity){
				$array[$entity->getId()] = $entity->getCategoria();
			}					
			return $array;
		}	
	}

?>