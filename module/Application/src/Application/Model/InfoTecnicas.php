<?php

namespace Application\Model;

class InfoTecnicas{
	public $id;
	public $idProduto;
	public $descricao;
	public $idFormato;
	public $espessura;
	public $absorcaoAguaUnidade;
	public $absorcaoAguaVillagres;
	public $resistenciaGretamentoUnidade;
	public $resistenciaGretamentoVillagres;
	public $resistenciaFlexaoUnidade;
	public $resistenciaFlexaoVillagres;
	public $coeficienteAtritoUnidade;
	public $coeficienteAtritoVillagres;
	public $cargaRupturaUnidade;
	public $cargaRupturaVillagres;
	public $resistenciaCongelamentoUnidade;
	public $resistenciaCongelamentoVillagres;
	public $resistenciaChoqueTermicoUnidade;
	public $resistenciaChoqueTermicoVillagres;
	public $resistenciaImpactoUnidade;
	public $resistenciaImpactoVillagres;
	public $expansaoUmidadeUnidade;
	public $expansaoUmidadeVillagres;
	public $resistenciaManchamentoUnidade;
	public $resistenciaManchamentoVillagres;
	public $resistenciaQuimicaUnidade;
	public $resistenciaQuimicaVillagres;
	public $resistenciaQuimicaBaixaUnidade;
	public $resistenciaQuimicaBaixaVillagres;
	public $resistenciaQuimicaAltaUnidade;
	public $resistenciaQuimicaAltaVillagres;

	public function exchangeArray($data){
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->idProduto = (!empty($data['idProduto'])) ? $data['idProduto'] : null;
		$this->descricao = (!empty($data['descricao'])) ? $data['descricao'] : null;
		$this->descricao_en = (!empty($data['descricao_en'])) ? $data['descricao_en'] : null;
		$this->idFormato = (!empty($data['idFormato'])) ? $data['idFormato'] : null;
		$this->espessura = (!empty($data['espessura'])) ? $data['espessura'] : null;
		$this->absorcaoAguaUnidade = (!empty($data['absorcaoAguaUnidade'])) ? $data['absorcaoAguaUnidade'] : null;
		$this->absorcaoAguaVillagres = (!empty($data['absorcaoAguaVillagres'])) ? $data['absorcaoAguaVillagres'] : null;
		$this->resistenciaGretamentoUnidade = (!empty($data['resistenciaGretamentoUnidade'])) ? $data['resistenciaGretamentoUnidade'] : null;
		$this->resistenciaGretamentoVillagres = (!empty($data['resistenciaGretamentoVillagres'])) ? $data['resistenciaGretamentoVillagres'] : null;
		$this->resistenciaGretamentoVillagres_en = (!empty($data['resistenciaGretamentoVillagres_en'])) ? $data['resistenciaGretamentoVillagres_en'] : null;
		$this->resistenciaFlexaoUnidade = (!empty($data['resistenciaFlexaoUnidade'])) ? $data['resistenciaFlexaoUnidade'] : null;
		$this->resistenciaFlexaoVillagres = (!empty($data['resistenciaFlexaoVillagres'])) ? $data['resistenciaFlexaoVillagres'] : null;
		$this->coeficienteAtritoUnidade = (!empty($data['coeficienteAtritoUnidade'])) ? $data['coeficienteAtritoUnidade'] : null;
		$this->coeficienteAtritoVillagres = (!empty($data['coeficienteAtritoVillagres'])) ? $data['coeficienteAtritoVillagres'] : null;
		$this->cargaRupturaUnidade = (!empty($data['cargaRupturaUnidade'])) ? $data['cargaRupturaUnidade'] : null;
		$this->cargaRupturaVillagres = (!empty($data['cargaRupturaVillagres'])) ? $data['cargaRupturaVillagres'] : null;
		$this->resistenciaCongelamentoUnidade = (!empty($data['resistenciaCongelamentoUnidade'])) ? $data['resistenciaCongelamentoUnidade'] : null;
		$this->resistenciaCongelamentoVillagres = (!empty($data['resistenciaCongelamentoVillagres'])) ? $data['resistenciaCongelamentoVillagres'] : null;
		$this->resistenciaChoqueTermicoUnidade = (!empty($data['resistenciaChoqueTermicoUnidade'])) ? $data['resistenciaChoqueTermicoUnidade'] : null;
		$this->resistenciaChoqueTermicoVillagres = (!empty($data['resistenciaChoqueTermicoVillagres'])) ? $data['resistenciaChoqueTermicoVillagres'] : null;
		$this->resistenciaImpactoUnidade = (!empty($data['resistenciaImpactoUnidade'])) ? $data['resistenciaImpactoUnidade'] : null;
		$this->resistenciaImpactoVillagres = (!empty($data['resistenciaImpactoVillagres'])) ? $data['resistenciaImpactoVillagres'] : null;
		$this->expansaoUmidadeUnidade = (!empty($data['expansaoUmidadeUnidade'])) ? $data['expansaoUmidadeUnidade'] : null;
		$this->expansaoUmidadeVillagres = (!empty($data['expansaoUmidadeVillagres'])) ? $data['expansaoUmidadeVillagres'] : null;
		$this->resistenciaManchamentoUnidade = (!empty($data['resistenciaManchamentoUnidade'])) ? $data['resistenciaManchamentoUnidade'] : null;
		$this->resistenciaManchamentoVillagres = (!empty($data['resistenciaManchamentoVillagres'])) ? $data['resistenciaManchamentoVillagres'] : null;
		$this->resistenciaManchamentoVillagres_en = (!empty($data['resistenciaManchamentoVillagres_en'])) ? $data['resistenciaManchamentoVillagres_en'] : null;
		$this->resistenciaQuimicaUnidade = (!empty($data['resistenciaQuimicaUnidade'])) ? $data['resistenciaQuimicaUnidade'] : null;
		$this->resistenciaQuimicaVillagres = (!empty($data['resistenciaQuimicaVillagres'])) ? $data['resistenciaQuimicaVillagres'] : null;
		$this->resistenciaQuimicaBaixaUnidade = (!empty($data['resistenciaQuimicaBaixaUnidade'])) ? $data['resistenciaQuimicaBaixaUnidade'] : null;
		$this->resistenciaQuimicaBaixaVillagres = (!empty($data['resistenciaQuimicaBaixaVillagres'])) ? $data['resistenciaQuimicaBaixaVillagres'] : null;
		$this->resistenciaQuimicaAltaUnidade = (!empty($data['resistenciaQuimicaAltaUnidade'])) ? $data['resistenciaQuimicaAltaUnidade'] : null;
		$this->resistenciaQuimicaAltaVillagres = (!empty($data['resistenciaQuimicaAltaVillagres'])) ? $data['resistenciaQuimicaAltaVillagres'] : null;
	}
}