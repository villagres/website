<?php

namespace Application\Model;

class Departamento{
	public $id;
	public $departamento;
	public $email;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->departamento = (!empty($data['departamento'])) ? $data['departamento'] : null;
		$this->departamento_en = (!empty($data['departamento_en'])) ? $data['departamento_en'] : null;
		$this->email = (!empty($data['email'])) ? $data['email'] : null;
	}
}