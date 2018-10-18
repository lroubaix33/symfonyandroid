<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CVController extends AbstractController {
    
    /**
     * @Route("/cv", name="cv_page")
     */
    public function renderCv() {
        return $this->render('cv/cv.html.twig', [
            'show' => false
        ]);
    }

    /**
     * @Route("/cv/download", name="download_cv_page")
     */
    public function downloadCv() {

        $file = new File('../public/pdf/cv_lroubaix.pdf');
        return $this->file($file, 'curriculum_vitae_lr.pdf');
    }

    /**
     * @Route("/cv/show", name="show_cv_page")
     */
    public function showCv() {

        return $this->render('cv/cv.html.twig', [
            'show' => true
        ]);
    }
}
