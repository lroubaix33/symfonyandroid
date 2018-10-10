<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="materiel_page")
     */
    public function showMateriel(MaterialRepository $repo)
    {
        $materials = $repo->findAll();

        return $this->render('gestion_materiel/materiel.html.twig', [
            'materials' => $materials
        ]);
    }

    /**
     * @Route("/materiel/new", name="new_material_page")
     */
    public function newMaterial(ObjectManager $manager, Request $request) {
        
        $material = new Material();

        $formMaterial = $this->createForm(MaterialType::class, $material);
        $formMaterial->handleRequest($request);

        if ($formMaterial->isSubmitted() && $formMaterial->isValid()) {

            $material = $formMaterial->getData();
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($material);
            $manager->flush();

            return $this->redirectToRoute('material_page');
        }

        return $this->render('/gestion_materiel/newmaterial.html.twig', [
            'materialform' => $formMaterial->createView()
        ]); 
    }
}
