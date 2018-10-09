<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;

use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ConnexionController extends AbstractController {
    /**
     * @Route("/register", name="register_page")
     */
    public function registration (  Request $request,
                                    ObjectManager $manager,
                                    UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRegisterAt(new \DateTime);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home_page');
        }

        return $this->render('connexion/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion_page")
     */
    public function login() {
        return $this->render('connexion/connexion.html.twig');
    }

    /**
     * @Route("/deconnexion", name="deconnexion_page")
     */
    public function logout() {
        return $this->render('...');
    }
}
