<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Admin\Reservations;
use App\Form\Admin\ReservationsType;
use App\Repository\UserRepository;
use App\Repository\StationRepository;
use App\Repository\Admin\TransportsRepository;
use App\Repository\Admin\ReservationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Mapping\ClassMetadata;
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('user/show.html.twig');
    }

     /**
     * @Route("/comments", name="user_comments", methods={"GET"})
     */
    public function comments(): Response
    {
        return $this->render('user/comments.html.twig');
    }
     /**
     * @Route("/reservations", name="user_reservations", methods={"GET"})
     */
    public function reservations(ReservationsRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservations = $reservationRepository->findBy(['userid' => $user->getId()]);
        return $this->render('user/reservations.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

             //** @var file $file  */
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
                 // handle exception
             }
                 $user->setImage($fileName);
             }


              // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, $id, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        
        $user = $this->getUser();
        if($user->getId() != $id){
            echo "Wrong User";
        }
        
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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

                $user->setImage($fileName);
            }

             // encode the plain password
             $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $this->getDoctrine()->getManager()->flush();

         

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

       
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }


     /**
     * @Route("/reservation/{sid}/{bid}", name="user_reservations_new", methods={"GET","POST"})
     */
    public function newreservation(Request $request, $sid, $bid, StationRepository $stationRepository, TransportsRepository $transportsRepository): Response
    {
        
        $station = $stationRepository->findOneBy(['id'=>$sid]);
        $transport = $transportsRepository->findOneBy(['id'=> $bid]);

        $departuretime=$_REQUEST["departuretime"];
        $ticketcount = $_REQUEST["ticketcount"];

        $data["total"] = $ticketcount * $transport->getPrice();
        $reservation = new Reservations();
        $form = $this->createForm(ReservationsType::class, $reservation);
        $form->handleRequest($request);

        $submittedToken =  $request->request->get('token');
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();

            $data["departuretime"] = $departuretime;
            $reservation->setStatus('New');
            $reservation->setStationid($sid);
            $reservation->setTransportsid($bid);
            $reservation->setTotal($data["total"]);
            $user = $this->getUser();
            $reservation->setUserid($user->getId());
            $reservation->setDeparturetime(\DateTime::createFromFormat('Y-m-d', $departuretime));
            $reservation->setCreatedAt(new \DateTime());
    
            $reservation->setUpdatedAt(new \DateTime());
            $entityManager->persist($reservation);

            
            $entityManager->flush();

            return $this->redirectToRoute('user_reservations');
        }

        return $this->render('user\newreservation.html.twig', [
            'station' => $station,
            'transport' => $transport,
            'reservation' => $reservation,
            'ticketcount' => $ticketcount,
            'departuretime' => $departuretime,
            'form' => $form->createView(),
        ]);
    }


}
