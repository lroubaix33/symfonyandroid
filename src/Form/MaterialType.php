<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Material;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'Code du matériel', 'attr' => [
                'placeholder' => 'Code du matériel ...', 
                'class' => 'form-control']])

            ->add('libelle', TextType::class, [
                'label' => 'Libellé du matériel',
                'attr' => [
                'placeholder' => 'Libellé du matériel ...',
                'class' => 'form-control']])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'libelle',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Catégorie du matériel',
            ])

            ->add('is_delete', CheckboxType::class, [
                'label' => 'Hors service ?',
                'required' => false
                ])

            ->add('motif_delete', TextType::class, [
                'label' => 'Commentaires',
                'attr' => [
                'placeholder' => 'Commentaires ...',
                'class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Material::class,
        ]);
    }
}
