<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackEndController extends AbstractController
{
    /**
     * @Route("/admin", name="back_end")
     */
    public function index()
    {
        return $this->render('back_end/index.html.twig', [
            'controller_name' => 'BackEndController',
        ]);
    }
}
