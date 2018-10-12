<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Material;
use App\Repository\CategoryRepository;
use App\Repository\MaterialRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatMatController extends AbstractController
{
    /**
     * @Route("/catmat", name="catmat_page")
     */
    public function showCatMat(CategoryRepository $repo, MaterialRepository $repoM)
    {
        $categorys = $repo->findAll();
        $materials = $repoM->findAll();

        return $this->render('gestion_materiel/catmat.html.twig', [
            'categorys' => $categorys,
            'materials' => $materials
        ]);
    }

    /**
     * @Route("/catmat/find/{id}", name="show_material")
     */
    public function find (Category $categ, MaterialRepository $repo, CategoryRepository $repoC) {

        $categorys = $repoC->findAll();

        $materials = $repo->findBy(
            ['category' => $categ]
        );

        return $this->render('gestion_materiel/catmat.html.twig', [
            'materials' => $materials,
            'categorys' => $categorys
        ]);
    }
}
