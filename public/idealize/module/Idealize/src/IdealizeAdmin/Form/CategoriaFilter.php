<?php

namespace IdealizeAdmin\Form;

use Zend\Filter\File\RenameUpload;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\Size;

class CategoriaFilter extends InputFilter{

	public function __construct(){
		$arquivo = new FileInput('imagem');
		$arquivo->setRequired(false);
		$arquivo->getFilterChain()->attach(new RenameUpload(array(
			'target' => './public/img/categoria/categoria_',
			'use_upload_extension' => true,
			'randomize' => true,
		)));		
		$this->add($arquivo);
	}

}