<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Loaning;
use App\Entity\Material;
use App\Form\AddUserType;
use App\Form\LoaningType;
use App\Form\LoaningBackType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Repository\MaterialRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GestionMaterielController extends AbstractController {

    /**
     * @Route("/user", name="user_page")
     */
    public function showUsers (UserRepository $repo)
    {
        $users = $repo->findAll();

        return $this->render('/gestion_materiel/user.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/user/new", name="new_user_page")
     */
    public function addUser (ObjectManager $manager,
      Request $request,
       UserPasswordEncoderInterface $encoder) {
        
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $manager = $this->getDoctrine()->getManager();

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRegisterAt(new \DateTime());

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_page');
        }

        return $this->render('/gestion_materiel/newuser.html.twig', [
            'form' => $form->createView()
        ]); 
    }

    /**
     * @Route("/user/edit/{id}", name="edit_user_page")
     */
    public function updateUser (ObjectManager $manager,
    Request $request,
     UserPasswordEncoderInterface $encoder, User $user) {

        if (!$user) {
            $user = new User();
        }

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $manager = $this->getDoctrine()->getManager();

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRegisterAt(new \DateTime());

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_page');
        }

        return $this->render('/gestion_materiel/edituser.html.twig', [
            'form' => $form->createView()
        ]); 
    }

    /**
     * @Route("/user/delete/{id}", name="delete_user_page")
     */
    public function deleteUser (ObjectManager $manager, User $user) {

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($user);
        $manager->flush();

        return $this->redirect( $this->generateUrl('user_page') );
    }

    /**
     * @Route("/user/loaningback/{id}", name="loaning_back_page")
     */
    public function loaningBack (ObjectManager $manager,
     Loaning $loaning, 
     UserRepository $userR, 
     MaterialRepository $repo, 
     Request $request) {

        if (!$loaning) {
            $loaning = new Loaning();
        }

        $user = $userR->find($loaning->getUser());

        $material = $repo->findOneByIdJoinedToLoaning($loaning->getId());

        $loaningBackForm = $this->createForm(LoaningBackType::class, $loaning);
        $loaningBackForm->handleRequest($request);

        if ($loaningBackForm->isSubmitted() && $loaningBackForm->isValid()) {

            $loaning = $loaningBackForm->getData();
            $manager = $this->getDoctrine()->getManager();

            $material[0]->setLastLoaning(null);

            $manager->persist($loaning);
            $manager->flush();

            return $this->redirectToRoute('user_page');
        }

        return $this->render('/gestion_materiel/loaningback.html.twig', [
            'loaningbackform' => $loaningBackForm->createView(),
            'user' => $user,
            'material' => $material
        ]); 
    }
}