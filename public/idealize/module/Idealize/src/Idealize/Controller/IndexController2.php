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

    	$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$repo = $em->getRepository('Idealize\Entity\Pessoa');

    	$pessoas = $repo->findAll();

        return new ViewModel(array('pessoas' => $pessoas));
    }

    public function pontuacaoAction(){
  
        $auth = new AuthenticationService;
        $sessionStorage = new SessionStorage("IdealizeAdmin");
        $auth->setStorage($sessionStorage);     
        $id = $auth->getIdentity()->getId();
        $usuario = $auth->getIdentity()->getNome();
        $empresa = $auth->getIdentity()->getEmpresa();      

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');        
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
                      (a.dtCadastro) as data
                      FROM Idealize\Entity\Pessoa a                      
                      where a.id = :id ")->setMaxResults(1)
                        ->setParameter('id',$id);        
        $resultado = $dados->getResult();
    	return new ViewModel(array('id'=>$id,'usuario'=>$usuario,'empresa'=>$empresa,'dados'=>$resultado));
    }

    public function adminAction(){
    	return new ViewModel();
    }
}
