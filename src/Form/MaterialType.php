<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Material;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                'code' => 'Code du matériel', 'attr' => [
                'placeholder' => 'Code du matériel ...', 
                'class' => 'form-control']])

            ->add('libelle', TextType::class, [
                'libelle' => 'Libellé du matériel',
                'attr' => [
                'placeholder' => 'Libellé du matériel ...',
                'class' => 'form-control']])

            ->add('category', ChoiceType::class, [
                'choices' => [
                    new Category()
                ], 'attr' => [
                    'class' => 'form-control'
                ], 'libelle' => 'Catégorie'])

            ->add('is_delete', CheckboxType::class, [
                'label' => 'Hors service',
                'required' => true])

            ->add('motif_delete', TextType::class, [
                'libelle' => 'Commentaires',
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
