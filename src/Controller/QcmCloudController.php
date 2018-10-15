<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QcmCloudController extends AbstractController
{
    /**
     * @Route("/qcmcloud", name="qcm_cloud_page")
     */
    public function showApk()
    {
        return $this->render('qcm_cloud/qcmcloud.html.twig');
    }
}
