<?php

namespace App\Controller;

use App\Entity\CircuitCategory;
use App\Form\CircuitCategoryType;
use App\Repository\CircuitCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/circuit/category")
 */
class BackofficeCircuitCategoryController extends AbstractController
{
    /**
     * @Route("/", name="circuit_category_index", methods="GET")
     */
    public function index(CircuitCategoryRepository $circuitCategoryRepository): Response
    {
        return $this->render('back/circuit_category/index.html.twig', ['circuit_categories' => $circuitCategoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="circuit_category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $circuitCategory = new CircuitCategory();
        $form = $this->createForm(CircuitCategoryType::class, $circuitCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($circuitCategory);
            $em->flush();

            return $this->redirectToRoute('circuit_category_index');
        }

        return $this->render('back/circuit_category/new.html.twig', [
            'circuit_category' => $circuitCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_category_show", methods="GET")
     */
    public function show(CircuitCategory $circuitCategory): Response
    {
        return $this->render('back/circuit_category/show.html.twig', ['circuit_category' => $circuitCategory]);
    }

    /**
     * @Route("/{id}/edit", name="circuit_category_edit", methods="GET|POST")
     */
    public function edit(Request $request, CircuitCategory $circuitCategory): Response
    {
        $form = $this->createForm(CircuitCategoryType::class, $circuitCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('circuit_category_index', ['id' => $circuitCategory->getId()]);
        }

        return $this->render('back/circuit_category/edit.html.twig', [
            'circuit_category' => $circuitCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_category_delete", methods="DELETE")
     */
    public function delete(Request $request, CircuitCategory $circuitCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuitCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($circuitCategory);
            $em->flush();
        }

        return $this->redirectToRoute('circuit_category_index');
    }
}
