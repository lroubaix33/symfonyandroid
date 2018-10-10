<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_page")
     */
    public function showCategorys(CategoryRepository $repo)
    {
        $categorys = $repo->findAll();

        $category = new Category();

        foreach ($categorys as $category) {
            $result = $repo->findOneByIdJoinedToCategory($category->getId());
            $category->setCountOfMaterials($result[0][1]);
        }

        return $this->render('gestion_materiel/category.html.twig', [
            'categorys' => $categorys
        ]);
    }

    /**
     * @Route("/category/new", name="new_category_page")
     */
    public function newCategory (ObjectManager $manager, Request $request) {

        $category = new Category();

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {

            $category = $categoryForm->getData();
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_page');
        }

        return $this->render('/gestion_materiel/newcategory.html.twig', [
            'formcategory' => $categoryForm->createView()
        ]);
    }

    /**
     * @Route("/category/edit/{id}", name="edit_category_page")
     */
    public function updateCategory (Category $category, ObjectManager $manager, Request $request) {

        if (!$category) {
            $category = new Category();
        }

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {

            $category = $categoryForm->getData();
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_page');
        }

        return $this->render('/gestion_materiel/editcategory.html.twig', [
            'categoryform' => $categoryForm->createView()
        ]); 
    }

    /**
     * @Route("/category/delete/{id}", name="delete_category_page")
     */
    public function deleteCategory(ObjectManager $manager, Category $category) {

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($category);
        $manager->flush();

        return $this->redirect( $this->generateUrl('category_page') );
    }
}