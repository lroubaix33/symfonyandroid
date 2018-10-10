<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, ['label' => 'Code de la catégorie', 'attr' => [
                'placeholder' => 'Code de la catégorie ...', 'class' => 'form-control']])
            ->add('libelle', TextType::class, ['label' => 'Libellé de la catégorie', 'attr' => [
                'placeholder' => 'Libellé de la catégorie ...', 'class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
