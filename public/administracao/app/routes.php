<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	return View::make('index');
});
*/

Route::get('/', array('uses' => 'AdminController@showLogin'));

Route::post('/', array('uses' => 'AdminController@doLogin'));

Route::get('logout', array('uses' => 'AdminController@logout'));

Route::group(array('before'=>'','prefix'=>'admin'),function(){

	/*Página Inicial*/
	Route::get('/',array('as'=>'admin.home','uses'=>'AdminController@home'));

	/*Representantes*/
	Route::get('/representantes',array('as'=>'admin.representantes','uses'=>'AdminController@representantes'));
	Route::get('/cadastra-representante',array('as'=>'admin.cadastraRepresentante','uses'=>'AdminController@cadastraRepresentante'));
	Route::get('/edita-representante/{id?}',array('as'=>'admin.editaRepresentante','uses'=>'AdminController@editaRepresentante'));
	Route::post('/grava-representante',array('as'=>'admin.gravaRepresentante','uses'=>'AdminController@gravaRepresentante'));
	Route::get('/apaga-representante/{id?}',array('as'=>'admin.apagaRepresentante','uses'=>'AdminController@apagaRepresentante'));

	/*Banner*/
	Route::get('/banners',array('as'=>'admin.banners','uses'=>'AdminController@banners'));
	Route::get('/cadastra-banner',array('as'=>'admin.cadastraBanner','uses'=>'AdminController@cadastraBanner'));
	Route::get('/edita-banner/{id?}',array('as'=>'admin.editaBanner','uses'=>'AdminController@editaBanner'));
	Route::post('/grava-banner',array('as'=>'admin.gravaBanner','uses'=>'AdminController@gravaBanner'));
	Route::get('/apaga-banner/{id?}',array('as'=>'admin.apagaBanner','uses'=>'AdminController@apagaBanner'));
	Route::get('/remove-banner/{id?}',array('as' => 'admin.removeBannerFile','uses' => 'AdminController@removeBannerFile'));

	/*Chamadas*/
	Route::get('/chamadas',array('as'=>'admin.chamadas','uses'=>'AdminController@chamadas'));
	Route::get('/cadastra-chamada',array('as'=>'admin.cadastraChamada','uses'=>'AdminController@cadastraChamada'));
	Route::get('/edita-chamada/{id?}',array('as'=>'admin.editaChamada','uses'=>'AdminController@editaChamada'));
	Route::post('/grava-chamada',array('as'=>'admin.gravaChamada','uses'=>'AdminController@gravaChamada'));
	Route::get('/apaga-chamada/{id?}',array('as'=>'admin.apagaChamada','uses'=>'AdminController@apagaChamada'));
	Route::get('/remove-chamada/{id?}',array('as' => 'admin.removeChamadaFile','uses' => 'AdminController@removeChamadaFile'));

	/*Filtros*/
	Route::get('/filtros',array('as'=>'admin.filtros','uses'=>'AdminController@filtros'));
	Route::get('/cadastra-filtro',array('as'=>'admin.cadastraFiltro','uses'=>'AdminController@cadastraFiltro'));
	Route::get('/edita-filtro/{id?}',array('as'=>'admin.editaFiltro','uses'=>'AdminController@editaFiltro'));
	Route::post('/grava-filtro',array('as'=>'admin.gravaFiltro','uses'=>'AdminController@gravaFiltro'));
	Route::get('/apaga-filtro/{id?}',array('as'=>'admin.apagaFiltro','uses'=>'AdminController@apagaFiltro'));

	/*Textos*/
	Route::get('/textos',array('as'=>'admin.textos','uses'=>'AdminController@textos'));
	Route::get('/cadastra-texto',array('as'=>'admin.cadastraTexto','uses'=>'AdminController@cadastraTexto'));
	Route::get('/edita-texto/{id?}',array('as'=>'admin.editaTexto','uses'=>'AdminController@editaTexto'));
	Route::post('/grava-texto',array('as'=>'admin.gravaTexto','uses'=>'AdminController@gravaTexto'));
	Route::get('/apaga-texto/{id?}',array('as'=>'admin.apagaTexto','uses'=>'AdminController@apagaTexto'));
	Route::get('/remove-texto/{id?}',array('as' => 'admin.removeTextoFile','uses' => 'AdminController@removeTextoFile'));

	/*Legendas*/
	Route::get('/legendas',array('as'=>'admin.legendas','uses'=>'AdminController@legendas'));
	Route::get('/cadastra-legenda',array('as'=>'admin.cadastraLegenda','uses'=>'AdminController@cadastraLegenda'));
	Route::get('/edita-legenda/{id?}',array('as'=>'admin.editaLegenda','uses'=>'AdminController@editaLegenda'));
	Route::post('/grava-legenda',array('as'=>'admin.gravaLegenda','uses'=>'AdminController@gravaLegenda'));
	Route::get('/apaga-legenda/{id?}',array('as'=>'admin.apagaLegenda','uses'=>'AdminController@apagaLegenda'));
	Route::get('/remove-legenda-file/{id?}',array('as' => 'admin.removeLegendaFile','uses' => 'AdminController@removeLegendaFile'));

	/*Departamentos*/
	Route::get('/departamentos',array('as'=>'admin.departamentos','uses'=>'AdminController@departamentos'));
	Route::get('/cadastra-departamento',array('as'=>'admin.cadastraDepartamento','uses'=>'AdminController@cadastraDepartamento'));
	Route::get('/edita-departamento/{id?}',array('as'=>'admin.editaDepartamento','uses'=>'AdminController@editaDepartamento'));
	Route::post('/grava-departamento',array('as'=>'admin.gravaDepartamento','uses'=>'AdminController@gravaDepartamento'));
	Route::get('/apaga-departamento/{id?}',array('as'=>'admin.apagaDepartamento','uses'=>'AdminController@apagaDepartamento'));

	/*Matérias*/
	Route::get('/materias',array('as'=>'admin.materias','uses'=>'AdminController@materias'));
	Route::get('/cadastra-materia',array('as'=>'admin.cadastraMateria','uses'=>'AdminController@cadastraMateria'));
	Route::get('/edita-materia/{id?}',array('as'=>'admin.editaMateria','uses'=>'AdminController@editaMateria'));
	Route::post('/grava-materia',array('as'=>'admin.gravaMateria','uses'=>'AdminController@gravaMateria'));
	Route::get('/apaga-materia/{id?}',array('as'=>'admin.apagaMateria','uses'=>'AdminController@apagaMateria'));
	Route::get('/remove-destaque/{id?}',array('as' => 'admin.removeImagemDestaqueFile','uses' => 'AdminController@removeImagemDestaqueFile'));
	Route::get('/remove-miniatura/{id?}',array('as' => 'admin.removeImagemMiniaturaFile','uses' => 'AdminController@removeImagemMiniaturaFile'));

	/*Na mídia*/
	Route::get('/midias',array('as'=>'admin.midias','uses'=>'AdminController@midias'));
	Route::get('/cadastra-midia',array('as'=>'admin.cadastraMidia','uses'=>'AdminController@cadastraMidia'));
	Route::get('/edita-midia/{id?}',array('as'=>'admin.editaMidia','uses'=>'AdminController@editaMidia'));
	Route::post('/grava-midia',array('as'=>'admin.gravaMidia','uses'=>'AdminController@gravaMidia'));
	Route::get('/apaga-midia/{id?}',array('as'=>'admin.apagaMidia','uses'=>'AdminController@apagaMidia'));
	Route::get('/remove-midia/{id?}',array('as' => 'admin.removeMidiaFile','uses' => 'AdminController@removeMidiaFile'));

	/*Coleções*/
	Route::get('/colecoes',array('as'=>'admin.colecoes','uses'=>'AdminController@colecoes'));
	Route::get('/cadastra-colecao',array('as'=>'admin.cadastraColecao','uses'=>'AdminController@cadastraColecao'));
	Route::get('/edita-colecao/{id?}',array('as'=>'admin.editaColecao','uses'=>'AdminController@editaColecao'));
	Route::post('/grava-colecao',array('as'=>'admin.gravaColecao','uses'=>'AdminController@gravaColecao'));
	Route::get('/apaga-colecao/{id?}',array('as'=>'admin.apagaColecao','uses'=>'AdminController@apagaColecao'));
	Route::get('/remove-colecao/{id?}',array('as' => 'admin.removeColecaoFile','uses' => 'AdminController@removeColecaoFile'));

	/*Linhas*/
	Route::get('/linhas',array('as'=>'admin.linhas','uses'=>'AdminController@linhas'));
	Route::get('/cadastra-linha',array('as'=>'admin.cadastraLinha','uses'=>'AdminController@cadastraLinha'));
	Route::get('/edita-linha/{id?}',array('as'=>'admin.editaLinha','uses'=>'AdminController@editaLinha'));
	Route::post('/grava-linha',array('as'=>'admin.gravaLinha','uses'=>'AdminController@gravaLinha'));	
	Route::get('/apaga-linha/{id?}',array('as'=>'admin.apagaLinha','uses'=>'AdminController@apagaLinha'));
	Route::get('/remove-linha/{id?}',array('as' => 'admin.removeLinhaFile','uses' => 'AdminController@removeLinhaFile'));
	Route::get('/remove-formato/{id?}',array('as' => 'admin.removeLinhaFormat','uses' => 'AdminController@removeLinhaFormat'));

	/*Produtos*/
	Route::get('/produtos',array('as'=>'admin.produtos','uses'=>'AdminController@produtos'));
	Route::get('/cadastra-produto',array('as'=>'admin.cadastraProduto','uses'=>'AdminController@cadastraProduto'));
	Route::get('/edita-produto/{id?}',array('as'=>'admin.editaProduto','uses'=>'AdminController@editaProduto'));
	Route::post('/grava-produto',array('as'=>'admin.gravaProduto','uses'=>'AdminController@gravaProduto'));
	Route::get('/apaga-produto/{id?}',array('as'=>'admin.apagaProduto','uses'=>'AdminController@apagaProduto'));
	Route::get('/remove-legenda/{id?}',array('as' => 'admin.removeLegendaProduto','uses' => 'AdminController@removeLegendaProduto'));
	Route::get('/remove-face/{id?}',array('as' => 'admin.removeFaceProduto','uses' => 'AdminController@removeFaceProduto'));
	Route::get('/remove-imagem/{id?}',array('as' => 'admin.removeImagemProduto','uses' => 'AdminController@removeImagemProduto'));

	/*Usuários*/
	Route::get('/usuarios',array('as'=>'admin.usuarios','uses'=>'AdminController@usuarios'));
	Route::get('/cadastra-usuario',array('as'=>'admin.cadastraUsuario','uses'=>'AdminController@cadastraUsuario'));
	Route::get('/edita-usuario/{id?}',array('as'=>'admin.editaUsuario','uses'=>'AdminController@editaUsuario'));
	Route::post('/grava-usuario',array('as'=>'admin.gravaUsuario','uses'=>'AdminController@gravaUsuario'));
	Route::get('/apaga-usuario/{id?}',array('as'=>'admin.apagaUsuario','uses'=>'AdminController@apagaUsuario'));
	
	/*Lançamentos*/
	Route::post('/limpa-lancamentos',array('as'=>'admin.clearLancamentos','uses'=>'AdminController@clearLancamentos'));
	
	/*Especificações*/
	Route::get('/especificacoes',array('as'=>'admin.especificacoes','uses'=>'AdminController@especificacoes'));
	Route::any('/especificacoesImport',array('as'=>'admin.especificacoesImport','uses'=>'AdminController@especificacoesImport'));
	
	/*Downloads*/
	Route::get('/downloads/novo',array('as'=>'admin.downloads','uses'=>'AdminController@downloads'));
	Route::get('/downloads',array('as'=>'admin.downloadsLista','uses'=>'AdminController@downloadsLista'));
	Route::post('/apaga-download',array('as'=>'admin.downloadsApaga','uses'=>'AdminController@apagaDocumento'));
	Route::post('/downloadsImport',array('as'=>'admin.downloadsImport','uses'=>'AdminController@downloadsImport'));
});