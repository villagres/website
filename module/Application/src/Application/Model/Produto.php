<?php

namespace Application\Model;

class Produto{
	public $id;
	public $colecao;
	public $linha;
	public $formato;
	public $acabamento;
	public $referencia;
	public $texto;
	public $cor;
	public $rodape;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->colecao = (!empty($data['colecao'])) ? $data['colecao'] : null;
		$this->linha = (!empty($data['linha'])) ? $data['linha'] : null;
		$this->formato = (!empty($data['formato'])) ? $data['formato'] : null;
		$this->acabamento = (!empty($data['acabamento'])) ? $data['acabamento'] : null;
		$this->referencia = (!empty($data['referencia'])) ? $data['referencia'] : null;
		$this->texto = (!empty($data['texto'])) ? $data['texto'] : null;
		$this->texto_en = (!empty($data['texto_en'])) ? $data['texto_en'] : null;
		$this->cor = (!empty($data['cor'])) ? $data['cor'] : null;
		$this->rodape = (!empty($data['rodape'])) ? $data['rodape'] : null;
		$this->lancamento = (!empty($data['lancamento'])) ? $data['lancamento'] : null;
	}
}