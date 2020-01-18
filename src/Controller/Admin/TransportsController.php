<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Transports;
use App\Form\Admin\TransportsType;
use App\Repository\Admin\TransportsRepository;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/admin/transports")
 */
class TransportsController extends AbstractController
{
    /**
     * @Route("/", name="admin_transports_index", methods={"GET"})
     */
    public function index(TransportsRepository $transportsRepository): Response
    {
        return $this->render('admin/transports/index.html.twig', [
            'transports' => $transportsRepository->getTransport(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="admin_transports_new", methods={"GET","POST"})
     */
    public function new(Request $request, $id, StationRepository $stationRepository, TransportsRepository $transportsRepository): Response
    {
        $station = $stationRepository->findOneBy(['id' => $id]);
        $transports = $transportsRepository->findBy(['stationid'=> $id]);


        $transport = new Transports();
        $form = $this->createForm(TransportsType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $transport->setStationid($id);
            $file = $form['image']->getData();
            echo($file);
            if ($file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            try{
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName,
                );
            }
            catch(FileException $e){
                echo $e;
            }
                $transport->setImage($fileName);
            }
            $entityManager->persist($transport);
            $entityManager->flush();

            return $this->redirectToRoute('admin_transports_new', ['id' => $id]);
        }

        return $this->render('admin/transports/new.html.twig', [
            'transports' => $transports,
            'station' => $station,
            'transport' => $transport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_transports_show", methods={"GET"})
     */
    public function show(Transports $transport): Response
    {
        return $this->render('admin/transports/show.html.twig', [
            'transport' => $transport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_transports_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, $sid, Transports $transport): Response
    {
        $form = $this->createForm(TransportsType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form['image']->getData();
            echo($file);
            if ($file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            try{
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName,
                );
            }
            catch(FileException $e){
                echo $e;
            }
                $transport->setImage($fileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_transports_new', ['id' => $sid]);
        }

        return $this->render('admin/transports/edit.html.twig', [
            'transport' => $transport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/{sid}", name="admin_transports_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $sid, Transports $transport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transport);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin_transports_new', ['id' => $sid]);
    }

      /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
