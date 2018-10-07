<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getManager();
      $circuits = $em->getRepository(Circuit::class)->findAll();
      dump($circuits);
        return $this->render('front/home.html.twig', [
        'circuits' => $circuits, 
        ]);
    }
}
