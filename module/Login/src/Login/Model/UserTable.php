<?php
	namespace Login\Model;
	use Zend\Db\Adapter\Adapter;
	use Zend\Db\ResultSet\ResultSet;
	use Zend\Db\TableGateway\TableGateway;
	class UserTable{
		protected $tableGateway;
		
		public function __construct(TableGateway $tableGateway){
			$this->tableGateway = $tableGateway;
		}
		
		public function saveUser(User $user){
			$data = array(
				'id' => $user->id,
				'user' => $user->user,
				'pass' => $user->pass,
				'nivel' => $user->nivel
			);
			$id = (int)$user->id;
			if($id == 0){
				$this->tableGateway->insert($data);
			}
			else{
				if($this->getUser($id)){
					$this->tableGateway->update($data,array('id' => $id));
				}
				else{
					throw new \Exception('Usuário não existe');
				}
			}
		}
		
		public function getUser($id){
			$id = (int)$id;
			$rowset = $this->tableGateway->select(array('id'=>$id));
			$row = $rowset->current();
			if(!$row){
				throw new \Exception('Não foi possível encontrar o usuário');
			}
			return $row;
		}
		
		public function fetchAll(){
			$resultSet = $this->tableGateway->select(array('nivel'=>2));
			return $resultSet;
		}
		
		public function deleteUser($id){
			$this->tableGateway->delete(array('id'=>$id));
		}	
	}	
?>