<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\ProgrammationCircuit;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getManager();
      $programmationCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
      dump($programmationCircuits);
        return $this->render('front/home.html.twig', [
        'programmationCircuits' => $programmationCircuits, 
        ]);
    }
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/circuit/{id}", name="front_circuit_show")
     */
    public function circuitShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        $programmationCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
        $circuit=null;
        foreach($programmationCircuits as $prog){
          if($id == $prog->getCircuit()->getId()){
            $circuit=$prog->getCircuit();
            $this->likes($circuit->getId());
            break;
          }
        }
        dump($circuit);
        //dump($this->get('session'));
        return $this->render('front/circuit_show.html.twig', [
        'circuit' => $circuit,
      ]);
    }
    /*
     * Manage likes
     */ 
    public function likes($id)
    {
        $likes = $this->get('session')->get('likes');
        if(! $likes){
          $likes=array();
        }
        // si l'identifiant n'est pas présent dans le tableau des likes, l'ajouter
        if (! in_array($id, $likes) )
        {
            $likes[] = $id;
        }
        else
        // sinon, le retirer du tableau
        {
            $likes = array_diff($likes, array($id));
        }
        $this->get('session')->set('likes', $likes);
        dump($likes);
    }
}

