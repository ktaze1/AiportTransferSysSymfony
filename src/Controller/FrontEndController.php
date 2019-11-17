<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends AbstractController
{
    /**
     * @Route("/front/end", name="front_end")
     */
    public function index()
    {
        return $this->render('frontendindex.html.twig', [
            'controller_name' => 'FrontEndController',
        ]);
    }
}
