<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProgrammationCircuit;
use App\Entity\Circuit;

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
            break;
          }
        }
        dump($circuit);
        return $this->render('front/circuit_show.html.twig', [
        'circuit' => $circuit,
        ]);
    }
}

