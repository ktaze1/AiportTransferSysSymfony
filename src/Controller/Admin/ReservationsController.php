<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Reservations;
use App\Form\Admin\ReservationsType;
use App\Repository\Admin\ReservationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/reservations")
 */
class ReservationsController extends AbstractController
{
    /**
     * @Route("/", name="admin_reservations_index", methods={"GET"})
     */
    public function index(ReservationsRepository $reservationsRepository): Response
    {
    
        return $this->render('admin/reservations/index.html.twig', [
            'reservations' => $reservationsRepository->getReservation(),
        ]);
    }

    /**
     * @Route("/new", name="admin_reservations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservations();
        $form = $this->createForm(ReservationsType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_reservations_index');
        }

        return $this->render('admin/reservations/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_reservations_show", methods={"GET"})
     */
    public function show($id, ReservationsRepository $reservation): Response
    {
        $reservation = $reservationsRepository->getReservation();
        return $this->render('admin/reservations/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    

    /**
     * @Route("/{id}/edit", name="admin_reservations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservations $reservation): Response
    {
        $form = $this->createForm(ReservationsType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_reservations_index');
        }

        return $this->render('admin/reservations/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_reservations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservations $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_reservations_index');
    }
}
