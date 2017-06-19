<?php

	namespace Idealize\Entity;

	use Doctrine\ORM\EntityRepository;

	class PessoaRepository extends EntityRepository{
		public function fetchPairs(){
			$entities = $this->findBy(array(), array('nome' => 'ASC'));
			$array = array();
			foreach($entities as $entity){
				$array[$entity->getId()] = $entity->getNome();
			}
			return $array;
		}

		public function findByEmailAndPassword($email,$password){
			$user = $this->findOneByEmail($email);
			if($user){
				if($password == $user->getSenha()){
					return $user;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
	}

?>