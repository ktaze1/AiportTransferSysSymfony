<?php

namespace App\Controller\Admin;

use App\Entity\Station;
use App\Form\StationType;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/station")
 */
class StationController extends AbstractController
{
    /**
     * @Route("/", name="admin_station_index", methods={"GET"})
     */
    public function index(StationRepository $stationRepository): Response
    {
        return $this->render('back_end/station/index.html.twig', [
            'stations' => $stationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_station_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $station = new Station();
        $form = $this->createForm(StationType::class, $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //** @var file $file  */

            $file = $form['image']->getData();
            if ($file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

                try{
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName,
                    );
                }
                catch(FileException $e){
                    // handle exception
                }
                $station->setImage($fileName);
            }
            $entityManager->persist($station);
            $entityManager->flush();
            return $this->redirectToRoute('admin_station_index');
        }

        return $this->render('back_end/station/new.html.twig', [
            'station' => $station,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_station_show", methods={"GET"})
     */
    public function show(Station $station): Response
    {
        return $this->render('back_end/station/show.html.twig', [
            'station' => $station,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_station_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Station $station): Response
    {
        $form = $this->createForm(StationType::class, $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                //** @var file $file  */
            $file = $form['image']->getData();
                if ($file) {
                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
    
                    try{
                        $file->move(
                            $this->getParameter('images_directory'),
                            $fileName,
                        );
                    }
                    catch(FileException $e){
                        // handle exception
                    }

                    $station->setImage($fileName);
                }
            $this->getDoctrine()->getManager()->flush();

                
                
            return $this->redirectToRoute('admin_station_index');
        }

        return $this->render('back_end/station/edit.html.twig', [
            'station' => $station,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_station_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Station $station): Response
    {
        if ($this->isCsrfTokenValid('delete'.$station->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($station);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_station_index');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
