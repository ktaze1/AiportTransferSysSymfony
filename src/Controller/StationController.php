<?php

namespace App\Controller;

use App\Entity\Station;
use App\Form\Station1Type;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/station")
 */
class StationController extends AbstractController
{
    /**
     * @Route("/", name="user_station_index", methods={"GET"})
     */
    public function index(StationRepository $stationRepository): Response
    {
        $user = $this->getUser();
        return $this->render('station/index.html.twig', [
            'stations' => $stationRepository->findBy(['userid'=>$user->getId()]),
        ]);
    }

    /**
     * @Route("/new", name="user_station_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $station = new Station();
        $form = $this->createForm(Station1Type::class, $station);
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

                   $user = $this->getUser();
            $station->setUserid($user->getId());
                   $station->setStatus("New");
        
            $entityManager->persist($station);
            $entityManager->flush();

            return $this->redirectToRoute('user_station_index');
        }

        return $this->render('station/new.html.twig', [
            'station' => $station,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_station_show", methods={"GET"})
     */
    public function show(Station $station): Response
    {
        return $this->render('station/show.html.twig', [
            'station' => $station,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_station_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Station $station): Response
    {
        $form = $this->createForm(Station1Type::class, $station);
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

            return $this->redirectToRoute('user_station_index');
        }

        return $this->render('station/edit.html.twig', [
            'station' => $station,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_station_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Station $station): Response
    {
        if ($this->isCsrfTokenValid('delete'.$station->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($station);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_station_index');
    }

    
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
