<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SettingRepository;

class FrontEndController extends AbstractController
{
    /**
     * @Route("/homepage", name="front_end")
     */
    public function index(SettingRepository $settingRepository)
    {
        $data = $settingRepository->findOneBy(['id' => 1]);
        
        return $this->render('front_end/index.html.twig', [
            'controller_name' => 'FrontEndController',
            'data' => $data,
        ]);
    }
}
