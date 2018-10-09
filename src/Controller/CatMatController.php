<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CatMatController extends AbstractController
{
    /**
     * @Route("/catmat", name="catmat_page")
     */
    public function showCatMat()
    {
        return $this->render('gestion_materiel/catmat.html.twig');
    }
}
