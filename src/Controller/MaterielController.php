<?php

namespace App\Controller;

use App\Entity\Loaning;
use App\Entity\Material;
use App\Entity\Material1;
use App\Form\LoaningType;
use App\Form\MaterialType;
use App\Repository\CategoryRepository;
use App\Repository\MaterialRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaterielController extends AbstractController
{
    /**
     * @Route("/material", name="material_page")
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
    public function newMaterial(ObjectManager $manager, Request $request, CategoryRepository $repo) {

        $material = new Material();
        $material1 = new Material1();

        $formMaterial = $this->createForm(MaterialType::class, $material);
        $formMaterial->handleRequest($request);

        if ($formMaterial->isSubmitted() && $formMaterial->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $material = $formMaterial->getData();

            $category = $repo->find($material->getCategory());
            $category->setCountOfMaterials($category->getCountOfMaterials() + 1);

            $manager->persist($category);
            $manager->flush();

            $manager->persist($material);
            $manager->flush();

            $material1->setLibelle($material->getLibelle());
            $material1->setCode($material->getCode());
            $material1->setIsDelete($material->getIsDelete());
            $material1->setMotifDelete($material->getMotifDelete());

            $manager->persist($material1);
            $manager->flush();

            return $this->redirectToRoute('material_page');
        }

        return $this->render('/gestion_materiel/newmaterial.html.twig', [
            'materialform' => $formMaterial->createView()
        ]); 
    }

    /**
     * @Route("/material/edit/{id}", name="edit_material_page")
     */
    public function updateMaterial (Material $material,
      ObjectManager $manager,
       Request $request) {

        if (!$material && !$_material) {
            $material = new Material();
        }

        $materialForm = $this->createForm(MaterialType::class, $material);
        $materialForm->handleRequest($request);

        if ($materialForm->isSubmitted() && $materialForm->isValid()) {

            $material = $materialForm->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($material);
            $manager->flush();

            return $this->redirectToRoute('material_page');
        }

        return $this->render('/gestion_materiel/editmaterial.html.twig', [
            'materialform' => $materialForm->createView()
        ]); 
    }

    /**
     * @Route("/material/delete/{id}", name="delete_material_page")
     */
    public function deleteMaterial(ObjectManager $manager, Material $material, CategoryRepository $repo) {

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($material);

        $category = $repo->find($material->getCategory());

        if ($category->getCountOfMaterials() == 1) {
            $category->setCountOfMaterials(null);
        } else {
            $category->setCountOfMaterials($category->getCountOfMaterials() - 1);
        }

        $manager->persist($category);
        $manager->flush();

        return $this->redirect( $this->generateUrl('material_page') );
    }

    /**
     * @Route("/material/attrib/{id}", name="attrib_material_page")
     */
    public function attribMaterial(Material $material,
      MaterialRepository $repo,
        ObjectManager $manager,
         Request $request) {

        $loaning = new Loaning();

        // $material = $repo->find($material);

        $loaningForm = $this->createForm(LoaningType::class, $loaning);
        $loaningForm->handleRequest($request);

        if ($loaningForm->isSubmitted() && $loaningForm->isValid()) {

            $loaning = $loaningForm->getData();
            $manager = $this->getDoctrine()->getManager();

            $loaning->addMaterial($material);

            $manager->persist($loaning);
            $manager->flush();

            return $this->redirectToRoute('material_page');
        }

        return $this->render('/gestion_materiel/attribloaning.html.twig', [
            'loaningform' => $loaningForm->createView(),
            'material' => $material
        ]);
    }
}
