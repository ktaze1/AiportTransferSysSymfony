<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SettingRepository;
use App\Repository\ImageRepository;
use App\Repository\StationRepository;
use App\Repository\Admin\TransportsRepository;
use App\Entity\Admin\Messages;
use App\Entity\Station;
use App\Form\Admin\MessagesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Bridge\Google\Smtp\GmailTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Mailer;

class FrontEndController extends AbstractController
{
    /**
     * @Route("/homepage", name="front_end")
     */
    public function index(SettingRepository $settingRepository, StationRepository $stationRepository)
    {
        $data = $settingRepository->findAll();
        $slider = $stationRepository->findBy([],['title'=>'ASC'], 4);
        $stations = $stationRepository->findBy([],['title'=>'ASC'], 4);
        
        return $this->render('front_end/index.html.twig', [
            'controller_name' => 'FrontEndController',
            'data' => $data,
            'slider' => $slider,
            'stations' => $stations
        ]);
    }
    /**
     * @Route("/", name="front_end2")
     */
    public function indexhome(SettingRepository $settingRepository, StationRepository $stationRepository)
    {
        $data = $settingRepository->findAll();
        $slider = $stationRepository->findBy([],['title'=>'ASC'], 4);
        $stations = $stationRepository->findBy([],['title'=>'ASC'], 4);
        
        return $this->render('front_end/index.html.twig', [
            'controller_name' => 'FrontEndController',
            'data' => $data,
            'slider' => $slider,
            'stations' => $stations
        ]);
    }


    
    /**
     * @Route("/stations/{id}", name="station_show", methods={"GET"})
     */
    public function show(StationRepository $stationRepository, $id, ImageRepository $imageRepository, TransportsRepository $transportsRepository): Response
    {
        
        $station = $stationRepository->findBy(['id' => $id]);
        $transports = $transportsRepository->findBy(['stationid' => $id]);
        return $this->render('front_end/stationslist.html.twig', [
            'station' => $station,
            'transports' => $transports,
        ]);
    }





    /**
     * @Route("/about", name="home_about")
     */
    public function about(SettingRepository $settingRepository)
    {
        $setting = $settingRepository->findAll();
        
        return $this->render('front_end/aboutus.html.twig', [
            'setting' => $setting,
        ]);
    }

      /**
     * @Route("/contact", name="home_contact", methods={"GET","POST"})
     */
    public function contact(SettingRepository $settingRepository, Request $request): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class,$message);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');

        $setting = $settingRepository->findAll();

        if($form->isSubmitted()) {
            if($this->isCsrfTokenValid('form-message', $submittedToken)){
                $entityManager = $this->getDoctrine()->getManager();
                $message->setStatus('new');
                $entityManager->persist($message);
                $entityManager->flush();


                $email = (new Email())
                ->from($setting[0]->getSmtpemail())
                ->to($form['email']->getData())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Regarding your contact form')
                ->html("Dear ".$form['name']->getData()."<br>
                        We received your message and we'll write back at you in no time <br>
                        ".$setting[0]->getCompany());

                $transport = new GmailTransport($setting[0]->getSmtpemail(), $setting[0]->getSmtppassword());
                $mailer = new Mailer($transport);
                $mailer->send($email);
            return $this->redirectToRoute('home_contact');
            }   
        }
        
        
        return $this->render('front_end/contact.html.twig', [
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }
}

