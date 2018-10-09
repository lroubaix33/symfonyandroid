<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="materiel_page")
     */
    public function showMateriel()
    {
        return $this->render('gestion_materiel/materiel.html.twig');
    }
}
