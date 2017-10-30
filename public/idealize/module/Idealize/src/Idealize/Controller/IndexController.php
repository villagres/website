<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Idealize\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

	$auth = new AuthenticationService;
        $sessionStorage = new SessionStorage("IdealizeAdmin");
        $auth->setStorage($sessionStorage);           
        $dtCadastro = $auth->getIdentity()->getDtCadastro(); 
		$dtInicioParticipacao = $auth->getIdentity()->getDtInicioParticipacao();

        $categoria = $auth->getIdentity()->getCategoria();        
        $regulamento = $auth->getIdentity()->getRegulamento();

        // var_dump($auth->getIdentity());die();

	 $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

      $imgCategoria = $em->createQuery(" SELECT a.imagem FROM Idealize\Entity\Categoria a where a.id = :id ")->setMaxResults(1)->setParameter('id',$categoria);          
      $dadosCategoria = $imgCategoria->getResult();      

      $imgRegulamento = $em->createQuery(" SELECT a.documento FROM Idealize\Entity\Regulamento a where a.id = :id ")->setMaxResults(1)->setParameter('id',$regulamento);
      $dadosRegulamento = $imgRegulamento->getResult();

      $premiacoes = $em->createQuery(" SELECT a.pontuacao, a.imagem FROM Idealize\Entity\Premiacao a where a.regulamento = :id ORDER BY a.pontuacao ASC ")->setParameter('id',$regulamento);
      $dadosPremiacoes = $premiacoes->getResult();

      if(!empty($dadosCategoria)){
        $imagemCategoria = $dadosCategoria[0]['imagem'];
      }
      else{
        $imagemCategoria = '';
      }

      if(!empty($dadosRegulamento)){
        $imagemRegulamento = $dadosRegulamento[0]['documento'];        
      }
      else{
        $imagemRegulamento = '';
      }      

      if(!empty($dadosPremiacoes)){
        $prizes = $dadosPremiacoes;
      }
      else{
        $prizes = '';
      }

    	$repo = $em->getRepository('Idealize\Entity\Pessoa');      

    	$pessoas = $repo->findAll();

        return new ViewModel(array('pessoas' => $pessoas,'dtCadastro' => $dtCadastro, 'regulamento' => $regulamento, 'imagemRegulamento' => $imagemRegulamento, 'categoria' => $categoria, 'imagemCategoria' => $imagemCategoria, 'premiacoes' => $prizes, 'dtInicioParticipacao' => $dtInicioParticipacao));
    }

    public function pontuacaoAction(){
  
        $auth = new AuthenticationService;
        $sessionStorage = new SessionStorage("IdealizeAdmin");
        $auth->setStorage($sessionStorage);     
        $id = $auth->getIdentity()->getId();
        $usuario = $auth->getIdentity()->getNome();
        $empresa = $auth->getIdentity()->getEmpresa();
	$dtCadastro = $auth->getIdentity()->getDtCadastro();
	$dtInicioParticipacao = $auth->getIdentity()->getDtInicioParticipacao();
  $regulamento = $auth->getIdentity()->getRegulamento();      

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');   

        $premiacoes = $em->createQuery(" SELECT a.pontuacao, a.imagem FROM Idealize\Entity\Premiacao a where a.regulamento = :id ORDER BY a.pontuacao ASC ")->setParameter('id',$regulamento);
      $dadosPremiacoes = $premiacoes->getResult();

      if(!empty($dadosPremiacoes)){
        $prizes = $dadosPremiacoes;
      }
      else{
        $prizes = '';
      }

        $dados = $em->createQuery(
                      "SELECT a.id,
                      (select sum(x.pontos) from Idealize\Entity\Ponto x where x.idPessoa = a.id and x.formato = '60x60') as sessenta,
                      (select sum(y.pontos) from Idealize\Entity\Ponto y where y.idPessoa = a.id and y.formato = '50x100') as cinquenta,
                      (select sum(z.pontos) from Idealize\Entity\Ponto z where z.idPessoa = a.id and z.formato = '24,5x100') as vinteequatro,
                      (select sum(r.pontos) from Idealize\Entity\Ponto r where r.idPessoa = a.id and r.formato = '24,5x100(Touch)') as vinteequatrot,
                      (select sum(w.pontos) from Idealize\Entity\Ponto w where w.idPessoa = a.id and w.formato = '71x71') as setentaeum,
                      (select sum(q.pontos) from Idealize\Entity\Ponto q where q.idPessoa = a.id and q.formato = '25x25(Santa)') as vinteecinco,
					  (select sum(s.pontos) from Idealize\Entity\Ponto s where s.idPessoa = a.id and s.formato = '30x30') as trinta,
					  (select sum(k.pontos) from Idealize\Entity\Ponto k where k.idPessoa = a.id and k.formato = '62x107(Touch)') as sessentaedoist,
					  (select sum(l.pontos) from Idealize\Entity\Ponto l where l.idPessoa = a.id and l.formato = '71x71(Touch)') as setentaeumt,
					  (select sum(m.pontos) from Idealize\Entity\Ponto m where m.idPessoa = a.id and m.formato = '49x99(Touch)') as quarentaenovet,
					  (select sum(n.pontos) from Idealize\Entity\Ponto n where n.idPessoa = a.id and n.formato = '30x107(Touch)') as trintat,
					  (select sum(o.pontos) from Idealize\Entity\Ponto o where o.idPessoa = a.id and o.formato = '31x108') as trintaeum,
					  (select sum(p.pontos) from Idealize\Entity\Ponto p where p.idPessoa = a.id and p.formato = '63x108') as sessentaetres,
            (select sum(f.pontos) from Idealize\Entity\Ponto f where f.idPessoa = a.id and f.formato = 'BÔNUS DE ANIVERSÁRIO') as bonusaniversario,
            (select sum(g.pontos) from Idealize\Entity\Ponto g where g.idPessoa = a.id and g.formato = 'ENVIO DE FOTO DE AMBIENTE') as enviofotoambiente,
                      (a.dtCadastro) as data,
					  (a.dtInicioParticipacao) as data2
                      FROM Idealize\Entity\Pessoa a                      
                      where a.id = :id ")->setMaxResults(1)
                        ->setParameter('id',$id);        
        $resultado = $dados->getResult();
    	return new ViewModel(array('id'=>$id,'usuario'=>$usuario,'empresa'=>$empresa,'dtCadastro'=>$dtCadastro,'dados'=>$resultado, 'premiacoes'=>$prizes,'dtInicioParticipacao'=>$dtInicioParticipacao));
    }

    public function adminAction(){
    	return new ViewModel();
    }
}
