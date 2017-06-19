<?php

class AdminController extends BaseController{

	public function showLogin(){
		return View::make('index');
	}

	public function doLogin(){							
		$credentials = [
        	'nome'=>Input::get('txtLogin'),
        	'password'=>Input::get('txtSenha')
        ];
        $rules = [
        	'nome' => 'required',
        	'password'=>'required'
        ];
        $validator = Validator::make($credentials,$rules);
        if($validator->passes())
        {
            if(Auth::attempt($credentials))
                return Redirect::to('admin');
            return Redirect::to('/');
        }
        else
        {
            return Redirect::to('/');
 
        }		
	}

	public function logout() {
  		Auth::logout();
  		return Redirect::to('/');
	}

	public function home(){
		if(Auth::check()){		
			return View::make('admin.home');
		}
		else{
			return Redirect::to('/');			
		}
	}
	
	public function especificacoes(){
		if(Auth::check()){
			return View::make('admin.especificacoes.home');
		}
		else{
			return Redirect::to('/');
		}
	}
	
	public function downloads(){
		if(Auth::check()){
			$tipos = TipoDownload::get();
			return View::make('admin.downloads.home')->with('tipos',$tipos)->with('status','NEW');
		}
		else{
			return Redirect::to('/');
		}
	}
	
	public function downloadsLista(){
		if(!Auth::check())
			return Redirect::to('/');
		$arquivos = Downloads::orderBy('dataAtualizacao','DESC')->paginate(10);
		return View::make('admin.downloads.lista')
			->with('arquivos',$arquivos);
	}
	
	public function validaDownload($data){
		$valido = true;		
		if(!isset($data['descricao']) || empty($data['descricao']) || $data['descricao'] == ''){
			$valido = false;
		}
		if(!isset($data['tipo']) || empty($data['tipo']) || $data['tipo'] == ''){
			$valido = false;
		}
		if(!isset($data['capa'])){
			$valido = false;
		}
		if(!isset($data['arquivo'])){
			$valido = false;
		}
		return $valido;
	}
	
	public function apagaDocumento(){
		if(!Auth::check())
			return Redirect::to('/');
		$id = Input::get('id');
		DB::beginTransaction();
		$capa = Downloads::select('capa')->where('id',$id)->first();
		$documento = Downloads::select('arquivo')->where('id',$id)->first();
		
		if($capa != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/documentos/capa/'.$capa->capa)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/documentos/capa/'.$capa->capa);	
			}
		}
		
		if($documento != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/documentos/arquivo/'.$documento->arquivo)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/documentos/arquivo/'.$documento->arquivo);	
			}
		}
				
		try{
			$arquivo = Downloads::where('id',$id)->delete();
			DB::commit();
			return ['status' => 'OK'];
		}catch(Exception $e){
			DB::rollback();
			return ['status' => 'NOK'];
		}		
	}
	
	public function downloadsImport(){
		ini_set("memory_limit",'4095M');
		set_time_limit(0);
		if(Auth::check()){
			$tipos = TipoDownload::get();
			$data = Input::all();			
			DB::beginTransaction();
			/*
			$json_data = file_get_contents("php://input");
			if(!empty($json_data)){
				$data = json_decode($json_data);
			}
			else{
				return ['status' => 'NOK','data' => $data];
			}
			*/
			$capa = '';
			$arquivo = '';
			$extensions = ['jpg','jpeg','pdf'];							
												
			
			if(!$this->validaDownload($data)){
				return View::make('admin.downloads.home')->with('tipos',$tipos)
					->with('status',"OBG");
				//return ['status' => 'OBG','data'=> $data];
			}
										
			//return ['status' => 'OK','data' => $data];
			
			$download = new Downloads;
			$download->tipo = $data['tipo'];
			$download->descricao = $data['descricao'];
			$download->dataAtualizacao = date('Y-m-d H:i:s');
			
			if(isset($data['capa']) && Input::hasFile('capa')){			
				if(Input::hasFile('capa')){
					$capa = Input::file('capa')->getClientOriginalExtension();				
					if(!in_array($capa,$extensions)){
						return View::make('admin.downloads.home')->with('tipos',$tipos)
							->with('status',"EXT");
						//return ['status' => 'EXT'];
					}
					$imagemCapa = 'capa_'.md5(Input::file('capa')->getClientOriginalName());
					$download->capa = $imagemCapa.".".$capa;
					Input::file('capa')->move($_SERVER["DOCUMENT_ROOT"].'/documentos/capa',$imagemCapa.".".$capa);
				}
			}
			
			if(isset($data['arquivo']) && Input::hasFile('arquivo')){			
				if(Input::hasFile('arquivo')){
					$arquivo = Input::file('arquivo')->getClientOriginalExtension();				
					if(!in_array($arquivo,$extensions)){
						return View::make('admin.downloads.home')->with('tipos',$tipos)
							->with('status',"EXT");
						//return ['status' => 'EXT'];
					}
					$imagemArquivo = 'arquivo_'.md5(Input::file('arquivo')->getClientOriginalName());
					$download->arquivo = $imagemArquivo.".".$arquivo;
					Input::file('arquivo')->move($_SERVER["DOCUMENT_ROOT"].'/documentos/arquivo',$imagemArquivo.".".$arquivo);
				}
			}
			
			try{
				$download->save();
				DB::commit();
				return View::make('admin.downloads.home')->with('tipos',$tipos)
					->with('status',"OK");
				//return ['status' => 'OK','data'=>$data];
			}catch(Exception $e){
				\DB::rollback();
				return View::make('admin.downloads.home')->with('tipos',$tipos)
					->with('status',"NOK");
				//return ['status' => 'NOK','data'=>$data];
			}
			
		}
		else{
			return Redirect::to('/');
		}
	}
	
	public function especificacoesImport(){
		if(Auth::check()){
			$data = Input::all();
			$file = '';
			$extensions = ['xls','xlsx'];
			if(isset($data['import']) && Input::hasFile('import')){			
				if(Input::hasFile('import')){								
					$file = Input::file('import')->getClientOriginalExtension();				
					if(!in_array($file,$extensions)){
						return ['status' => 'EXT'];
					}
					Input::file('import')->move($_SERVER["DOCUMENT_ROOT"],'especificacoes.'.$file);
					$objPHPExcel = \PHPExcel_IOFactory::load($_SERVER["DOCUMENT_ROOT"]."/especificacoes.".$file);
					if($objPHPExcel->getActiveSheet()->getHighestRow() > 1){
						$columnA = $objPHPExcel->getActiveSheet()->getCell('A1')->getValue();
						$columnB = $objPHPExcel->getActiveSheet()->getCell('B1')->getValue();
						$columnC = $objPHPExcel->getActiveSheet()->getCell('C1')->getValue();
						$columnD = $objPHPExcel->getActiveSheet()->getCell('D1')->getValue();
						$columnE = $objPHPExcel->getActiveSheet()->getCell('E1')->getValue();
						$columnF = $objPHPExcel->getActiveSheet()->getCell('F1')->getValue();
						$columnG = $objPHPExcel->getActiveSheet()->getCell('G1')->getValue();
						$columnH = $objPHPExcel->getActiveSheet()->getCell('H1')->getValue();
						$columnI = $objPHPExcel->getActiveSheet()->getCell('I1')->getValue();
						$columnJ = $objPHPExcel->getActiveSheet()->getCell('J1')->getValue();
						$columnK = $objPHPExcel->getActiveSheet()->getCell('K1')->getValue();
						$columnL = $objPHPExcel->getActiveSheet()->getCell('L1')->getValue();
						$columnM = $objPHPExcel->getActiveSheet()->getCell('M1')->getValue();
						$columnN = $objPHPExcel->getActiveSheet()->getCell('N1')->getValue();
						$columnO = $objPHPExcel->getActiveSheet()->getCell('O1')->getValue();
						$columnP = $objPHPExcel->getActiveSheet()->getCell('P1')->getValue();
						$columnQ = $objPHPExcel->getActiveSheet()->getCell('Q1')->getValue();
						$columnR = $objPHPExcel->getActiveSheet()->getCell('R1')->getValue();
						$columnS = $objPHPExcel->getActiveSheet()->getCell('S1')->getValue();
						$columnT = $objPHPExcel->getActiveSheet()->getCell('T1')->getValue();						
						/*
						$columnU = $objPHPExcel->getActiveSheet()->getCell('U1')->getValue();
						$columnV = $objPHPExcel->getActiveSheet()->getCell('V1')->getValue();
						$columnW = $objPHPExcel->getActiveSheet()->getCell('W1')->getValue();
						$columnX = $objPHPExcel->getActiveSheet()->getCell('X1')->getValue();
						$columnY = $objPHPExcel->getActiveSheet()->getCell('Y1')->getValue();
						$columnZ = $objPHPExcel->getActiveSheet()->getCell('Z1')->getValue();
						$columnAA = $objPHPExcel->getActiveSheet()->getCell('AA1')->getValue();
						$columnAB = $objPHPExcel->getActiveSheet()->getCell('AB1')->getValue();
						
						$columnO == "Resistência Impacto Unidade" &&
						$columnP == "Resistência Impacto Villagres" &&
						$columnQ == "Expansão Umidade Unidade" &&
						$columnR == "Expansão Umidade Villagres" &&
						
						$info->resistenciaImpactoUnidade = $objPHPExcel->getActiveSheet()->getCell('O'.$row)->getValue();
						$info->resistenciaImpactoVillagres = $objPHPExcel->getActiveSheet()->getCell('P'.$row)->getValue();
						$info->expansaoUmidadeUnidade = $objPHPExcel->getActiveSheet()->getCell('Q'.$row)->getValue();
						$info->expansaoUmidadeVillagres = $objPHPExcel->getActiveSheet()->getCell('R'.$row)->getValue();
						*/

						if($columnA == "Referência" &&
						   $columnB == "Descrição" &&
						   $columnC == "Formato" &&
						   $columnD == "Espessura" &&
						   $columnE == "Absorção Água Unidade" &&
						   $columnF == "Absorção Água Villagres" &&
						   $columnG == "Resistência Gretamento Unidade" &&
						   $columnH == "Resistência Gretamento Villagres" &&
						   $columnI == "Resistência Flexão Unidade" &&
						   $columnJ == "Resistência Flexão Villagres" &&
						   $columnK == "Coeficiente Atrito Unidade" &&
						   $columnL == "Coeficiente Atrito Villagres" &&
						   $columnM == "Carga Ruptura Unidade" &&
						   $columnN == "Carga Ruptura Villagres" &&						   
						   $columnO == "Resistência Manchamento Unidade" &&
						   $columnP == "Resistência Manchamento Villagres" &&
						   $columnQ == "Resistência Química Unidade" &&
						   $columnR == "Resistência Química Villagres" &&
						   $columnS == "Resistência Química Baixa Unidade" &&
						   $columnT == "Resistência Química Baixa Villagres"						   
						 ){
							\DB::beginTransaction();
							for($row = 2; $row <= $objPHPExcel->getActiveSheet()->getHighestRow(); $row++){
								$referencia = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();
								$info = \InfoTecnicas::where('idProduto','=',$referencia)->first();
								if(!$info){
									$info = new \InfoTecnicas;
								}
								$info->idProduto = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();
								$info->descricao = $objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue();
								$info->idFormato = $objPHPExcel->getActiveSheet()->getCell('C'.$row)->getValue();
								$info->espessura = $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue();
								$info->absorcaoAguaUnidade = $objPHPExcel->getActiveSheet()->getCell('E'.$row)->getValue();
								$info->absorcaoAguaVillagres = $objPHPExcel->getActiveSheet()->getCell('F'.$row)->getValue();
								$info->resistenciaGretamentoUnidade = $objPHPExcel->getActiveSheet()->getCell('G'.$row)->getValue();
								$info->resistenciaGretamentoVillagres = $objPHPExcel->getActiveSheet()->getCell('H'.$row)->getValue();
								$info->resistenciaFlexaoUnidade = $objPHPExcel->getActiveSheet()->getCell('I'.$row)->getValue();
								$info->resistenciaFlexaoVillagres = $objPHPExcel->getActiveSheet()->getCell('J'.$row)->getValue();
								$info->coeficienteAtritoUnidade = $objPHPExcel->getActiveSheet()->getCell('K'.$row)->getValue();
								$info->coeficienteAtritoVillagres = $objPHPExcel->getActiveSheet()->getCell('L'.$row)->getValue();
								$info->cargaRupturaUnidade = $objPHPExcel->getActiveSheet()->getCell('M'.$row)->getValue();
								$info->cargaRupturaVillagres = $objPHPExcel->getActiveSheet()->getCell('N'.$row)->getValue();								
								$info->resistenciaManchamentoUnidade = $objPHPExcel->getActiveSheet()->getCell('O'.$row)->getValue();
								$info->resistenciaManchamentoVillagres = $objPHPExcel->getActiveSheet()->getCell('P'.$row)->getValue();
								$info->resistenciaQuimicaUnidade = $objPHPExcel->getActiveSheet()->getCell('Q'.$row)->getValue();
								$info->resistenciaQuimicaVillagres = $objPHPExcel->getActiveSheet()->getCell('R'.$row)->getValue();
								$info->resistenciaQuimicaBaixaUnidade = $objPHPExcel->getActiveSheet()->getCell('S'.$row)->getValue();
								$info->resistenciaQuimicaBaixaVillagres = $objPHPExcel->getActiveSheet()->getCell('T'.$row)->getValue();								
								$info->save();								
							}
							try{
								\DB::commit();
								if(file_exists($_SERVER["DOCUMENT_ROOT"].'/especificacoes'.$file)){
									unlink($_SERVER["DOCUMENT_ROOT"].'/especificacoes'.$file);	
								}
								return ["status" => "OK"];
							}catch(Exception $e){
								\DB::rollback();
								return ["status" => "NOK"];
							}

						}
						else{
							return ["status" => "FNOK"];
						}
					}
					else{
						return ["status" => "EMP"];
					}
				}				
			}
			return ['status' => 'NOK'];
		}
		else{
			return Redirect::to('/');
		}
	}

	/*Representantes*/	
	public function representantes(){
		if(!Auth::check())
			return Redirect::to('/');
		$representantes = Representante::paginate(10);
		return View::make('admin.representante.home')
			->with('representantes',$representantes);
	}

	public function cadastraRepresentante(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.representante.cadastra');
	}

	public function editaRepresentante($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$representante = Representante::where('id',$id)->first();
		return View::make('admin.representante.edita')
			->with('representante',$representante);
	}

	public function gravaRepresentante(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$representante = Representante::where('id',$data['id'])->first();
		}
		else{
			$representante = new Representante;
		}
		$representante->nome = $data['nome'];
		$representante->nome_en = $data['nome_en'];
		$representante->estado = $data['estado'];
		$representante->informacoes = $data['informacoes'];
		$representante->informacoes_en = $data['informacoes_en'];
		try{
			$representante->save();
			DB::commit();
			return Redirect::route('admin.representantes');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.representantes');
		}	
	}

	public function apagaRepresentante($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$representante = Representante::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.representantes');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.representantes');
		}		
	}

	/*Banners*/
	public function banners(){
		if(!Auth::check())
			return Redirect::to('/');
		$banners = Banner::paginate(10);
		return View::make('admin.banner.home')
			->with('banners',$banners);
	}

	public function cadastraBanner(){
		if(!Auth::check())
			return Redirect::to('/');
		$linhas = Linha::select('id','linha')->get();
		return View::make('admin.banner.cadastra')
			->with('linhas',$linhas);		
	}

	public function editaBanner($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$linhas = Linha::select('id','linha')->get();
		$banner = Banner::where('id',$id)->first();
		return View::make('admin.banner.edita')
			->with('linhas',$linhas)
			->with('banner',$banner);
	}

	public function gravaBanner(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$banner = Banner::where('id',$data['id'])->first();
		}
		else{
			$banner = new Banner;
		}
		if(isset($data['banner']) && Input::hasFile('banner')){			
			if(Input::hasFile('banner')){								
				$imagem = 'banner_'.md5(Input::file('banner')->getClientOriginalName());
				$banner->imagem = $imagem;
				Input::file('banner')->move($_SERVER["DOCUMENT_ROOT"].'/img/banner',$imagem);
			}
		}

		$banner->linha = $data['linha'];
		$banner->lancamento = isset($data['lancamento']) ? 1 : 0;
		$banner->link = isset($data['link']) ? 1 : 0;
		$banner->endereco = $data['endereco'];
		
		try{
			$banner->save();
			DB::commit();
			return Redirect::route('admin.banners');
		}catch(Exception $e){
			\DB::rollback();
			return Redirect::route('admin.banners');
		}
	}

	public function apagaBanner($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$banner = Banner::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.banners');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.banners');
		}
		return;
	}

	public function removeBannerFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Banner::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/banner/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/banner/'.$arquivo->imagem);	
			}
			$banner = Banner::where('id',$id)->first();
			$banner->imagem = '';
			try{
				$banner->save();
				DB::commit();
				return Redirect::route('admin.editaBanner',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaBanner',$id);
			}
		}
			
	}

	/*Chamadas*/
	public function chamadas(){
		if(!Auth::check())
			return Redirect::to('/');
		$chamadas = Chamada::paginate(10);
		return View::make('admin.chamada.home')
			->with('chamadas',$chamadas);
	}	

	public function cadastraChamada(){
		if(!Auth::check())
			return Redirect::to('/');
		$materias = Materia::select('id','titulo')->get();
		return View::make('admin.chamada.cadastra')
			->with('materias',$materias);
	}

	public function editaChamada($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$materias = Materia::select('id','titulo')->get();
		$chamada = Chamada::where('id',$id)->first();
		return View::make('admin.chamada.edita')
			->with('materias',$materias)
			->with('chamada',$chamada);
	}

	public function gravaChamada(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$chamada = Chamada::where('id',$data['id'])->first();
		}
		else{
			$chamada = new Chamada;
		}		

		if(isset($data['imagem']) && Input::hasFile('imagem')){			
			if(Input::hasFile('imagem')){								
				$imagem = 'chamada_'.md5(Input::file('imagem')->getClientOriginalName());
				$chamada->imagem = $imagem;
				Input::file('imagem')->move($_SERVER["DOCUMENT_ROOT"].'/img/chamada',$imagem);
			}
		}
		
		if(isset($data['imagem_en']) && Input::hasFile('imagem_en')){			
			if(Input::hasFile('imagem_en')){								
				$imagem = 'chamada_en_'.md5(Input::file('imagem_en')->getClientOriginalName());
				$chamada->imagem_en = $imagem;
				Input::file('imagem_en')->move($_SERVER["DOCUMENT_ROOT"].'/img/chamada',$imagem);
			}
		}
	
		$chamada->nome = $data['nome'];
		$chamada->nome_en = $data['nome_en'];
		$chamada->materia = $data['materia'];		

		try{
			$chamada->save();
			DB::commit();
			return Redirect::route('admin.chamadas');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.chamadas');
		}

	}

	public function apagaChamada($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$chamada = Chamada::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.chamadas');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.chamadas');
		}
	}

	public function removeChamadaFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Chamada::select('imagem','imagem_en')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/chamada/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/chamada/'.$arquivo->imagem);
			}
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/chamada/'.$arquivo->imagem_en)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/chamada/'.$arquivo->imagem_en);
			}
			$chamada = Chamada::where('id',$id)->first();
			$chamada->imagem = '';
			$chamada->imagem_en = '';
			try{
				$chamada->save();
				DB::commit();
				return Redirect::route('admin.editaChamada',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaChamada',$id);
			}
		}
			
	}

	/*Filtros*/
	public function filtros(){
		if(!Auth::check())
			return Redirect::to('/');
		$filtros = Filtro::paginate(10);
		return View::make('admin.filtro.home')
			->with('filtros',$filtros);		
	}

	public function cadastraFiltro(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.filtro.cadastra');		
	}

	public function editaFiltro($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$filtro = Filtro::where('id',$id)->first();
		return View::make('admin.filtro.edita')
			->with('filtro',$filtro);		
	}

	public function gravaFiltro(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$filtro = Filtro::where('id',$data['id'])->first();
		}
		else{
			$filtro = new Filtro;
		}

		$filtro->tipo = $data['tipo'];
		$filtro->filtro = $data['filtro'];
		$filtro->filtro_en = $data['filtro_en'];

		try{
			$filtro->save();
			DB::commit();
			return Redirect::route('admin.filtros');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.filtros');
		}
	}

	public function apagaFiltro($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$filtro = Filtro::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.filtros');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.filtros');
		}
	}

	/*Textos*/
	public function textos(){
		if(!Auth::check())
			return Redirect::to('/');
		$textos = Texto::paginate(10);		
		return View::make('admin.texto.home')
			->with('textos',$textos);
	}

	public function cadastraTexto(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.texto.cadastra');
	}

	public function editaTexto($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$texto = Texto::where('id',$id)->first();
		return View::make('admin.texto.edita')
			->with('texto',$texto);
	}

	public function gravaTexto(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$texto = Texto::where('id',$data['id'])->first();
		}
		else{
			$texto = new Texto;
		}

		if(isset($data['imagem']) && Input::hasFile('imagem')){			
			if(Input::hasFile('imagem')){								
				$imagem = 'texto_'.md5(Input::file('imagem')->getClientOriginalName());
				$texto->imagem = $imagem;
				Input::file('imagem')->move($_SERVER["DOCUMENT_ROOT"].'/img/texto',$imagem);
			}
		}

		$texto->titulo = $data['titulo'];
		$texto->titulo_en = $data['titulo_en'];
		$texto->texto = $data['informacoes'];
		$texto->texto_en = $data['informacoes_en'];

		try{
			$texto->save();
			DB::commit();
			return Redirect::route('admin.textos');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.textos');
		}
	}

	public function apagaTexto($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$texto = Texto::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.textos');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.textos');
		}
	}

	public function removeTextoFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Texto::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/texto/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/texto/'.$arquivo->imagem);	
			}
			$texto = Texto::where('id',$id)->first();
			$texto->imagem = '';
			try{
				$texto->save();
				DB::commit();
				return Redirect::route('admin.editaTexto',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaTexto',$id);
			}
		}
			
	}

	/*Legendas*/
	public function legendas(){
		if(!Auth::check())
			return Redirect::to('/');
		$legendas = Legenda::paginate(10);
		return View::make('admin.legenda.home')
			->with('legendas',$legendas);
	}

	public function cadastraLegenda(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.legenda.cadastra');
	}

	public function editaLegenda($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$legenda = Legenda::where('id',$id)->first();
		return View::make('admin.legenda.edita')
			->with('legenda',$legenda);
	}

	public function gravaLegenda(){
		if(!Auth::check())
			return Redirect::to('/');		
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$legenda = Legenda::where('id',$data['id'])->first();
		}
		else{
			$legenda = new Legenda;
		}

		if(isset($data['imagem']) && Input::hasFile('imagem')){			
			if(Input::hasFile('imagem')){								
				$imagem = 'legenda_'.md5(Input::file('imagem')->getClientOriginalName());
				$legenda->imagem = $imagem;
				Input::file('imagem')->move($_SERVER["DOCUMENT_ROOT"].'/img/legenda',$imagem);
			}
		}

		$legenda->legenda = $data['legenda'];
		$legenda->legenda_en = $data['legenda_en'];

		try{
			$legenda->save();
			DB::commit();
			return Redirect::route('admin.legendas');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.legendas');
		}
	}

	public function apagaLegenda($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$legenda = Legenda::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.legendas');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.legendas');
		}
	}

	public function removeLegendaFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Legenda::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/legenda/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/legenda/'.$arquivo->imagem);	
			}
			$legenda = Legenda::where('id',$id)->first();
			$legenda->imagem = '';
			try{
				$legenda->save();
				DB::commit();
				return Redirect::route('admin.editaLegenda',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaLegenda',$id);
			}
		}
			
	}

	/*Departamentos*/
	public function departamentos(){
		if(!Auth::check())
			return Redirect::to('/');
		$departamentos = Departamento::paginate(10);
		return View::make('admin.departamento.home')
			->with('departamentos',$departamentos);
	}

	public function cadastraDepartamento(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.departamento.cadastra');
	}

	public function editaDepartamento($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$departamento = Departamento::where('id',$id)->first();
		return View::make('admin.departamento.edita')
			->with('departamento',$departamento);
	}

	public function gravaDepartamento(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		if(isset($data['id']) && $data['id'] != ''){
			$departamento = Departamento::where('id',$data['id'])->first();
		}
		else{
			$departamento = new Departamento;
		}

		$departamento->departamento = $data['departamento'];
		$departamento->departamento_en = $data['departamento_en'];
		$departamento->email = $data['email'];

		try{
			$departamento->save();
			DB::commit();
			return Redirect::route('admin.departamentos');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.departamentos');
		}
	}

	public function apagaDepartamento($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$departamento = Departamento::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.departamentos');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.departamentos');
		}
	}

	/*Matérias*/
	public function materias(){
		if(!Auth::check())
			return Redirect::to('/');
		$materias = Materia::paginate(10);
		return View::make('admin.materia.home')
			->with('materias',$materias);
	}

	public function cadastraMateria(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.materia.cadastra');
	}

	public function editaMateria($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$materia = Materia::where('id',$id)->first();
		return View::make('admin.materia.edita')
			->with('materia',$materia);
	}

	public function gravaMateria(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$materia = Materia::where('id',$data['id'])->first();
		}
		else{
			$materia = new Materia;
		}

		if(isset($data['imagemDestaque']) && Input::hasFile('imagemDestaque')){			
			if(Input::hasFile('imagemDestaque')){								
				$imagemDestaque = 'destaque_'.md5(Input::file('imagemDestaque')->getClientOriginalName());
				$materia->imagemDestaque = $imagemDestaque;
				Input::file('imagemDestaque')->move($_SERVER["DOCUMENT_ROOT"].'/img/materia',$imagemDestaque);
			}
		}

		if(isset($data['imagemMiniatura']) && Input::hasFile('imagemMiniatura')){			
			if(Input::hasFile('imagemMiniatura')){								
				$imagemMiniatura = 'miniatura_'.md5(Input::file('imagemMiniatura')->getClientOriginalName());
				$materia->imagemMiniatura = $imagemMiniatura;
				Input::file('imagemMiniatura')->move($_SERVER["DOCUMENT_ROOT"].'/img/materia',$imagemMiniatura);
			}
		}

		$materia->destaque = isset($data['destaque']) ? 1 : 0;
		$materia->tituloDestaque = $data['tituloDestaque'];
		$materia->tituloDestaque_en = $data['tituloDestaque_en'];
		$materia->titulo = $data['titulo'];
		$materia->titulo_en = $data['titulo_en'];
		$materia->olho = $data['olho'];
		$materia->olho_en = $data['olho_en'];
		$materia->texto = $data['texto'];
		$materia->texto_en = $data['texto_en'];

		try{	
			$materia->save();
			DB::commit();
			return Redirect::route('admin.materias');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.materias');
		}
	}

	public function apagaMateria($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$materia = Materia::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.materias');
		}
		catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.materias');
		}
	}

	public function removeImagemDestaqueFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Materia::select('imagemDestaque')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/materia/'.$arquivo->imagemDestaque)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/materia/'.$arquivo->imagemDestaque);	
			}
			$materia = Materia::where('id',$id)->first();
			$materia->imagemDestaque = '';
			try{
				$materia->save();
				DB::commit();
				return Redirect::route('admin.editaMateria',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaMateria',$id);
			}
		}
			
	}

	public function removeImagemMiniaturaFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Materia::select('imagemMiniatura')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/materia/'.$arquivo->imagemMiniatura)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/materia/'.$arquivo->imagemMiniatura);	
			}
			$materia = Materia::where('id',$id)->first();
			$materia->imagemMiniatura = '';
			try{
				$materia->save();
				DB::commit();
				return Redirect::route('admin.editaMateria',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaMateria',$id);
			}
		}
			
	}

	/*Na mídia*/
	public function midias(){
		if(!Auth::check())
			return Redirect::to('/');
		$midias = Midia::paginate(10);
		return View::make('admin.midia.home')
			->with('midias',$midias);
	}

	public function cadastraMidia(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.midia.cadastra');
	}

	public function editaMidia($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$midia = Midia::where('id',$id)->first();
		return View::make('admin.midia.edita')
			->with('midia',$midia);
	}

	public function gravaMidia(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$midia = Midia::where('id',$data['id'])->first();
		}else{
			$midia = new Midia;
		}

		if(isset($data['imagem']) && Input::hasFile('imagem')){			
			if(Input::hasFile('imagem')){								
				$imagem = 'midia_'.md5(Input::file('imagem')->getClientOriginalName());
				$midia->imagem = $imagem;
				Input::file('imagem')->move($_SERVER["DOCUMENT_ROOT"].'/img/midia',$imagem);
			}
		}

		$midia->titulo = $data['titulo'];
		$midia->titulo_en = $data['titulo_en'];
		$midia->olho = $data['olho'];
		$midia->olho_en = $data['olho_en'];
		$midia->texto = $data['texto'];
		$midia->texto_en = $data['texto_en'];

		try{
			$midia->save();
			DB::commit();
			return Redirect::route('admin.midias');
		}catch(Exception $e){
			Db::rollback();
			return Redirect::route('admin.midias');
		}

	}

	public function apagaMidia($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$midia = Midia::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.midias');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.midias');
		}
	}

	public function removeMidiaFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Midia::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/midia/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/midia/'.$arquivo->imagem);
			}
			$midia = Midia::where('id',$id)->first();
			$midia->imagem = '';
			try{
				$midia->save();
				DB::commit();
				return Redirect::route('admin.editaMidia',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaMidia',$id);
			}
		}
			
	}

	/*Coleções*/
	public function colecoes(){
		if(!Auth::check())
			return Redirect::to('/');
		$colecoes = Colecao::paginate(10);
		return View::make('admin.colecao.home')
			->with('colecoes',$colecoes);
	}

	public function cadastraColecao(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.colecao.cadastra');
	}

	public function editaColecao($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$colecao = Colecao::where('id',$id)->first();
		return View::make('admin.colecao.edita')
			->with('colecao',$colecao);
	}

	public function gravaColecao(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$colecao = Colecao::where('id',$data['id'])->first();
		}else{
			$colecao = new Colecao;
		}

		if(isset($data['imagem']) && Input::hasFile('imagem')){			
			if(Input::hasFile('imagem')){								
				$imagem = 'colecao_'.md5(Input::file('imagem')->getClientOriginalName());
				$colecao->imagem = $imagem;
				Input::file('imagem')->move($_SERVER["DOCUMENT_ROOT"].'/img/colecao',$imagem);
			}
		}

		$colecao->colecao = $data['colecao'];
		$colecao->colecao_en = $data['colecao_en'];
		$colecao->texto = $data['texto'];
		$colecao->texto_en = $data['texto_en'];

		try{
			$colecao->save();
			DB::commit();
			return Redirect::route('admin.colecoes');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.colecoes');			
		}

	}

	public function apagaColecao($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$colecao = Colecao::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.colecoes');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.colecoes');
		}
	}

	public function removeColecaoFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Colecao::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/colecao/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/colecao/'.$arquivo->imagem);	
			}
			$colecao = Colecao::where('id',$id)->first();
			$colecao->imagem = '';
			try{
				$colecao->save();
				DB::commit();
				return Redirect::route('admin.editaColecao',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaColecao',$id);
			}
		}
			
	}

	/*Linhas*/
	public function linhas(){
		if(!Auth::check())
			return Redirect::to('/');
		$linhas = Linha::paginate(10);
		return View::make('admin.linha.home')
			->with('linhas',$linhas);
	}

	public function cadastraLinha(){
		if(!Auth::check())
			return Redirect::to('/');
		$colecoes = Colecao::select('id','colecao')->get();
		$formatos = Filtro::select('id','filtro')->where('tipo','=','formato')->get();
		return View::make('admin.linha.cadastra')
			->with('colecoes',$colecoes)
			->with('formatos',$formatos);
	}

	public function editaLinha($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$colecoes = Colecao::select('id','colecao')->get();
		$formatos = Filtro::select('id','filtro')->where('tipo','=','formato')->get();
		$formatoLinha = LinhaFormato::select('linha_formato.id','linha_formato.idFiltro','flt.filtro')
					->leftJoin('filtro as flt','flt.id','=','linha_formato.idFiltro')
					->where('linha_formato.idLinha','=',$id)->get();		
		$linha = Linha::where('id',$id)->first();
		return View::make('admin.linha.edita')
			->with('colecoes',$colecoes)
			->with('formatos',$formatos)
			->with('formatoLinha',$formatoLinha)
			->with('linha',$linha);
	}

	public function gravaLinha(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$linha = Linha::where('id',$data['id'])->first();
		}
		else{
			$linha = new Linha;
		}

		if(isset($data['imagem']) && Input::hasFile('imagem')){			
			if(Input::hasFile('imagem')){								
				$imagem = 'linha_'.md5(Input::file('imagem')->getClientOriginalName());
				$linha->imagem = $imagem;
				Input::file('imagem')->move($_SERVER["DOCUMENT_ROOT"].'/img/linha',$imagem);
			}
		}

		$linha->linha = $data['linha'];
		$linha->colecao = $data['colecao'];
		$linha->lancamento = isset($data['lancamento']) ? 1 : 0;

		try{
			$linha->save();
			if(isset($data['formato'])){
				foreach($data['formato'] as $formato){
					$count = LinhaFormato::where('idFiltro',$formato)->where('idLinha',$linha->id)->count();
					if($count == 0){
						$fmt = new LinhaFormato;
						$fmt->idFiltro = $formato;
						$fmt->idLinha = $linha->id;
						$fmt->save();
					}
				}
			}
			DB::commit();
			return Redirect::route('admin.linhas');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.linhas');
		}
	}
	
	public function apagaLinha($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$linha = Linha::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.linhas');
		}catch(Exception $e){	
			DB::rollback();
			return Redirect::route('admin.linhas');
		}
	}

	public function removeLinhaFile($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = Linha::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/linha/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/linha/'.$arquivo->imagem);	
			}
			$linha = Linha::where('id',$id)->first();
			$linha->imagem = '';
			try{
				$linha->save();
				DB::commit();
				return Redirect::route('admin.editaLinha',$id);
			}catch(Exception $e){
				DB::rollback();
				return Redirect::route('admin.editaLinha',$id);
			}
		}
	}

	public function removeLinhaFormat($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$formato = LinhaFormato::where('id',$id)->delete();
			DB::commit();
			return Redirect::back();
		}catch(Exception $e){
			DB::rollback();
			return Redirect::back();
		}
	}

	/*Produtos*/
	public function produtos(){
		if(!Auth::check())
			return Redirect::to('/');
		$produtos = Produto::orderBy('referencia')->paginate(10);
		return View::make('admin.produto.home')
			->with('produtos',$produtos);
	}

	public function cadastraProduto(){
		if(!Auth::check())
			return Redirect::to('/');
		$colecoes = Colecao::select('id','colecao')->get();
		$linhas = Linha::select('id','linha')->get();
		$formatos = Filtro::select('id','filtro')->where('tipo','=','formato')->get();
		$acabamentos = Filtro::select('id','filtro')->where('tipo','=','acabamento')->get();
		$cores = Filtro::select('id','filtro')->where('tipo','=','cor')->get();
		$layouts = Filtro::select('id','filtro')->where('tipo','=','layout')->get();
		$indicacoes = Filtro::select('id','filtro')->where('tipo','=','indicacao')->get();
		$legendas = Legenda::select('id','legenda')->get();
		return View::make('admin.produto.cadastra')
			->with('colecoes',$colecoes)
			->with('linhas',$linhas)
			->with('formatos',$formatos)
			->with('acabamentos',$acabamentos)
			->with('cores',$cores)
			->with('layouts',$layouts)
			->with('indicacoes',$indicacoes)
			->with('legendas',$legendas);
	}

	public function editaProduto($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$colecoes = Colecao::select('id','colecao')->get();
		$linhas = Linha::select('id','linha')->get();
		$formatos = Filtro::select('id','filtro')->where('tipo','=','formato')->get();
		$acabamentos = Filtro::select('id','filtro')->where('tipo','=','acabamento')->get();
		$cores = Filtro::select('id','filtro')->where('tipo','=','cor')->get();
		$layouts = Filtro::select('id','filtro')->where('tipo','=','layout')->get();
		$indicacoes = Filtro::select('id','filtro')->where('tipo','=','indicacao')->get();
		$legendas = Legenda::select('id','legenda')->get();
		$faceProduto = FaceProduto::select('id','imagem')->where('produto',$id)->get();
		$imagemProduto = ImagemProduto::select('id','imagem')->where('produto',$id)->get();
		$legendaProduto = LegendaProduto::select('legenda_produto.id','legenda_produto.idLegenda','leg.legenda')
										->leftJoin('legenda as leg','leg.id','=','legenda_produto.idLegenda')
										->where('legenda_produto.idProduto',$id)->get();
		$produto = Produto::where('id',$id)->first();
		return View::make('admin.produto.edita')
			->with('colecoes',$colecoes)
			->with('linhas',$linhas)
			->with('formatos',$formatos)
			->with('acabamentos',$acabamentos)
			->with('cores',$cores)
			->with('layouts',$layouts)
			->with('indicacoes',$indicacoes)
			->with('legendas',$legendas)
			->with('faceProduto',$faceProduto)
			->with('imagemProduto',$imagemProduto)
			->with('legendaProduto',$legendaProduto)
			->with('produto',$produto);
	}

	public function gravaProduto(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != null){
			$produto = Produto::where('id',$data['id'])->first();
		}
		else{
			$produto = new Produto;
		}

		$produto->colecao = $data['colecao'];
		$produto->linha = $data['linha'];
		$produto->formato = $data['formato'];
		$produto->acabamento = $data['acabamento'];
		$produto->cor = $data['cor'];
		$produto->indicacao = $data['indicacao'];
		$produto->layout = $data['layout'];
		$produto->referencia = $data['referencia'];
		$produto->texto = $data['texto'];
		$produto->texto_en = $data['texto_en'];
		$produto->rodape = isset($data['rodape']) ? 1 : 0;
		$produto->lancamento = isset($data['lancamento']) ? 1 : 0;

		try{
			$produto->save();
			if(isset($data['faces']) && Input::hasFile('faces')){
				foreach($data['faces'] as $face){
					$imagem = 'face_'.md5($face->getClientOriginalName());
					$count = FaceProduto::where('imagem',$imagem)->where('produto',$produto->id)->count();
					if($count == 0){
						$fc = new FaceProduto;
						$fc->imagem = $imagem;
						$fc->produto = $produto->id;
						$face->move($_SERVER["DOCUMENT_ROOT"].'/img/produto/',$imagem);
						$fc->save();						
					}
				}
			}
						
			if(isset($data['imagens']) && Input::hasFile('imagens')){				
				foreach($data['imagens'] as $imgProduto){					
					$imagemProduto = 'imagem_'.md5($imgProduto->getClientOriginalName());
					$count = ImagemProduto::where('imagem',$imagemProduto)->where('produto',$produto->id)->count();					
					if($count == 0){
						$img = new ImagemProduto;
						$img->imagem = $imagemProduto;
						$img->produto = $produto->id;						
						$imgProduto->move($_SERVER["DOCUMENT_ROOT"].'/img/produto/',$imagemProduto);
						$img->save();					
					}
				}			
			}

			if(isset($data['legendas'])){
				foreach($data['legendas'] as $legenda){
					$count = LegendaProduto::where('idLegenda',$legenda)->where('idProduto',$produto->id)->count();
					if($count == 0){
						$leg = new LegendaProduto;
						$leg->idLegenda = $legenda;
						$leg->idProduto = $produto->id;
						$leg->save();
					}
				}
			}			
		 	DB::commit();
		 	return Redirect::route('admin.produtos');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.produtos');
		}
	}

	public function gravaFaceProduto($id){
		if(!Auth::check())
			return Redirect::to('/');
		if(Input::hasFile('faces')){
			DB::beginTransaction();
			$files = Input::file('faces');
			foreach($files as $file){
				$face = new FaceProduto;
				$imagem = 'face_'.md5($file->getClientOriginalName());
				$face->imagem;
				$face->produto = $id;
				$file->move($$_SERVER["DOCUMENT_ROOT"].'/img/produto/');
				$face->save();				
			}
			try{
				DB::commit();				
			}catch(Exception $e){
				DB::rollback();
			}
			
		}
	}

	public function gravaImagemProduto($id){
		if(!Auth::check())
			return Redirect::to('/');
		if(Input::hasFile('imagens')){
			DB::beginTransaction();
			$files = Input::file('imagens');
			foreach($files as $file){
				$image = new ImagemProduto;
				$imagem = 'imagem_'.md5($file->getClientOriginalName());
				$image->imagem = $imagem;
				$image->produto = $id;
				$file->move($_SERVER["DOCUMENT_ROOT"].'/img/produto/');
				$image->save();				
			}
			try{
				DB::commit();				
			}catch(Exception $e){
				DB::rollback();
			}
			
		}
	}

	public function gravaLegendaProduto($id){
		if(!Auth::check())
			return Redirect::to('/');
		if(	null !== Input::get('legendas') ){
			DB::beginTransaction();
			$legendas = Input::get('legendas');
			foreach($legendas as $legenda){				
				$count = LegendaProduto::where('idLegenda',$legenda)->count();
				if($count == 0){
					$leg = new LegendaProduto;
					$leg->idLegenda = $legenda;
					$leg->idProduto = $id;
					$leg->save();
				}
			}
			try{
				DB::commit();
			}catch(Exception $e){
				DB::rollback();
			}
		}
	}

	public function apagaProduto($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$produto = Produto::where('id',$id)->delete();
			$face = FaceProduto::where('produto',$id)->delete();
			$imagem = ImagemProduto::where('produto',$id)->delete();
			$legenda = LegendaProduto::where('idProduto',$id)->delete();
			DB::commit();
			return Redirect::route('admin.produtos');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.produtos');
		}
	}

	public function removeLegendaProduto($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$legenda = LegendaProduto::where('id',$id)->delete();
			DB::commit();
			return Redirect::back();
		}catch(Exception $e){
			DB::rollback();
			return Redirect::back();
		}
	}

	public function removeFaceProduto($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = FaceProduto::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/produto/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/produto/'.$arquivo->imagem);			
			}
			//$face = FaceProduto::where('id',$id)->first();
			//$face->imagem = '';
			try{
				FaceProduto::where('id',$id)->delete();
				//$face->save();
				DB::commit();
				return Redirect::back();
			}catch(Exception $e){
				DB::rollback();
				return Redirect::back();
			}
		}
	}

	public function removeImagemProduto($id){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$arquivo = ImagemProduto::select('imagem')->where('id',$id)->first();		
		if($arquivo != ''){
			if(file_exists($_SERVER["DOCUMENT_ROOT"].'/img/produto/'.$arquivo->imagem)){
				unlink($_SERVER["DOCUMENT_ROOT"].'/img/produto/'.$arquivo->imagem);
			}
			//$imagem = ImagemProduto::where('id',$id)->first();
			//$imagem->imagem = '';
			try{
				ImagemProduto::where('id',$id)->delete();
				//$imagem->save();
				DB::commit();
				return Redirect::back();
			}catch(Exception $e){
				DB::rollback();
				return Redirect::back();
			}
		}
	}

	/*Usuários*/
	public function usuarios(){
		if(!Auth::check())
			return Redirect::to('/');
		$usuarios = Usuario::paginate(10);
		return View::make('admin.usuario.home')
			->with('usuarios',$usuarios);
	}

	public function cadastraUsuario(){
		if(!Auth::check())
			return Redirect::to('/');
		return View::make('admin.usuario.cadastra');
	}

	public function editaUsuario($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		$usuario = Usuario::where('id',$id)->first();
		return View::make('admin.usuario.edita')
			->with('usuario',$usuario);
	}

	public function gravaUsuario(){
		if(!Auth::check())
			return Redirect::to('/');
		$data = Input::all();
		DB::beginTransaction();
		if(isset($data['id']) && $data['id'] != ''){
			$usuario = Usuario::where('id',$data['id'])->first();			
		}
		else{
			$usuario = new Usuario;
		}

		$usuario->nome = $data['nome'];
		$usuario->email = $data['email'];
		$usuario->password = Hash::make($data['password']);

		try{
			$usuario->save();
			DB::commit();
			return Redirect::route('admin.usuarios');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.usuarios');
		}
	}

	public function apagaUsuario($id = null){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		try{
			$usuario = Usuario::where('id',$id)->delete();
			DB::commit();
			return Redirect::route('admin.usuarios');
		}catch(Exception $e){
			DB::rollback();
			return Redirect::route('admin.usuarios');
		}
	}
	
	public function clearLancamentos(){
		if(!Auth::check())
			return Redirect::to('/');
		DB::beginTransaction();
		$produto = Produto::where('lancamento',1)->get();
		$linha = Linha::where('lancamento',1)->get();
		
		if((count($produto) == 0) and (count($linha) == 0))
			return ['status' => 'EMPTY'];
		
		if(count($produto) > 0):
			foreach($produto as $prod){
				$prod->lancamento = 0;
				$prod->save();				
			}
		endif;
		if(count($linha) > 0):
			foreach($linha as $line){
				$line->lancamento = 0;
				$line->save();
			}
		endif;
		try{			
			DB::commit();
			return ['status' => 'OK'];
		}catch(Exception $e){
			DB::rollback();
			return ['status' => 'NOK'];
		}
	}

}