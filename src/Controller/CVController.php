<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CVController extends AbstractController {
    
    /**
     * @Route("/cv", name="cv_page")
     */
    public function renderCv() {
        return $this->render('cv/cv.html.twig');
    }
}
