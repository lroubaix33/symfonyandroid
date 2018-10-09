<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;

class HomePageController extends AbstractController {
    /**
     * @Route("/", name="home_page")
     */
    public function home (UserRepository $repo) {
        
        $users = $repo->findAll();

        return $this->render('home_page/home_page.html.twig', [
            'users' => $users
        ]);
    }
}
