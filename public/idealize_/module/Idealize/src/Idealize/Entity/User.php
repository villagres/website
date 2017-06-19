<?php 

namespace Idealize\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Idealize\Entity\UserRepository")
 */
class User{

	/**
	 * @ORM\Entity
	 * @ORM\Table(name="users")
	 * @ORM\Entity(repositoryClass="Idealize\Entity\UserRepository")
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
	protected $email;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $password;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $salt;	

	public function __construct($options=null){
		Configurator::configure($this,$options);
		$this->salt = base_convert(sha1(uniqid(mt_rand(),true)),16,36);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
		return $this;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
		return $this;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$hashSenha = hash('sha512',$password.$this->salt);
		for($i=0;$i<64000;$i++){
			$hashSenha = hash('sha512',$hashSenha);
		}
		$this->password = $hashSenha;
		return $this;
	}

	public function toArray(){
		return array(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'email' => $this->getEmail(),
			'password' => $this->getPassword(),
			'salt' => $this->salt

		);
	}

}