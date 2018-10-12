<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Loaning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class LoaningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_loaning', DateTimeType::class, [
                'label' => 'Date d\'emprunt',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                    'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
                ]])
              
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom de l\'utilisateur',
            ])
            
            ->add('note', TextType::class, [
                'label' => 'Remarque',
                'attr' => [
                'placeholder' => 'Votre remarque ...',
                'class' => 'form-control'
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loaning::class,
        ]);
    }
}
