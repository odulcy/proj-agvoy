<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Entity\ProgrammationCircuit;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getManager();
      $ProgrammationCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
      dump($ProgrammationCircuits);
        return $this->render('front/home.html.twig', [
        'ProgrammationCircuits' => $ProgrammationCircuits,
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
        $circuit = $em->getRepository(Circuit::class)->find($id);
        dump($circuit);
        return $this->render('front/circuit_show.html.twig', [
        'circuit' => $circuit,
        ]);
    }
}
