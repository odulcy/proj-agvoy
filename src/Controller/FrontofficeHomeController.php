<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Entity\ProgrammationCircuit;
use App\Entity\CircuitCategory;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getManager();
      $programmationCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
      $circuitCategories = $em->getRepository(CircuitCategory::class)->findAll();
      $likes = $this->get('session')->get('likes');
      dump($programmationCircuits);
        return $this->render('front/home.html.twig', [
          'programmationCircuits' => $programmationCircuits,
          'circuitCategories' => $circuitCategories,
          'likes' => $likes
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
        $progCircuit = $em->getRepository(ProgrammationCircuit::class)->find($id);
        if($progCircuit){
          $circuit=$progCircuit->getCircuit();
          return $this->render('front/circuit_show.html.twig', [
          'circuit' => $circuit,
          'programmation' => $progCircuit
        ]);
        }
        else{
          throw $this->createNotFoundException('Impossible de trouver le circuit demandé');
        }
    }
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/category/{id}", name="front_category_show")
     */
    public function categoryShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(CircuitCategory::class)->find($id);
        if($category){
          $circuit=$category->getCircuits();
          $progCircuit=array();
          foreach ($circuit as $c) {
            $progCircuit = array_merge($progCircuit,$c->getProgrammationCircuits()->toArray());
          }
          dump($progCircuit);
          return $this->render('front/category.html.twig', [
          'programmationCircuits' => $progCircuit
        ]);
        }
        else{
          throw $this->createNotFoundException('Impossible de trouver le circuit demandé');
        }
    }

    /**
     * Manage likes
     *
     * @Route("/like/{id}", name="front_set_like")
     */
    public function like($id)
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
        return $this->redirectToRoute('frontoffice_home');
    }
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/my-likes", name="front_likes_show")
     */
    public function myLikes()
    {
        $likes = $this->get('session')->get('likes');
        if(! $likes){
          $likes=array();
        }
        $em = $this->getDoctrine()->getManager();
        $programmationCircuits=array();
        foreach ($likes as $id) {
          $programmationCircuits[] = $em->getRepository(ProgrammationCircuit::class)->find($id);
        }
        return $this->render('front/mylikes.html.twig', [
        'programmationCircuits' => $programmationCircuits
      ]);
    }
}
