<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackEndController extends AbstractController
{
    /**
     * @Route("/admin", name="back_end")
     */
    public function index()
    {
        return $this->render('/backendindex.html.twig', [
            'controller_name' => 'BackEndController',
        ]);
    }
}
