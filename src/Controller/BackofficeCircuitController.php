<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Entity\CircuitCategory;

use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/circuit")
 */
class BackofficeCircuitController extends AbstractController
{
    /**
     * @Route("/", name="admin_circuit_index", methods="GET")
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
        return $this->render('back/circuit/index.html.twig', ['circuits' => $circuitRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_circuit_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(CircuitCategory::class)->findAll();
        $circuit = new Circuit();
        $form = $this->createForm(CircuitType::class, $circuit,
                        array('categories' => $categories));
        $form->handleRequest($request);

        if($request->getMethod() === 'POST'){
          if ($form->isSubmitted() && $form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($circuit);
              $em->flush();
              $this->get('session')->getFlashBag()->add('success', ['Succès', 'Circuit ajouté']);

              return $this->redirectToRoute('admin_circuit_index');
          }else{
              $this->get('session')->getFlashBag()->add('error', ['Erreur', 'Champs invalides']);

              return $this->redirectToRoute('admin_circuit_index');
          }
        }
        else{
          return $this->render('back/circuit/new.html.twig', [
              'circuit' => $circuit,
              'form' => $form->createView(),
          ]);
        }
    }

    /**
     * @Route("/{id}", name="admin_circuit_show", methods="GET")
     */
    public function show(Circuit $circuit): Response
    {
        return $this->render('back/circuit/show.html.twig', ['circuit' => $circuit]);
    }

    /**
     * @Route("/{id}/edit", name="admin_circuit_edit", methods="GET|POST")
     */
    public function edit(Request $request, Circuit $circuit): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(CircuitCategory::class)->findAll();
        $form = $this->createForm(CircuitType::class, $circuit,
        array('categories' => $categories));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('success', ['Succès', 'Modification apportée']);

            return $this->redirectToRoute('admin_circuit_edit', ['id' => $circuit->getId()]);
        }
        return $this->render('back/circuit/edit.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_circuit_delete", methods="DELETE")
     */
    public function delete(Request $request, Circuit $circuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($circuit);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', ['Succès', 'Circuit supprimé']);
        }

        return $this->redirectToRoute('back_circuit_index');
    }
}
