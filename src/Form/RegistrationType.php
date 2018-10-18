<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // NAME
            ->add('name', null, [
                'label' => 'Nom d\'utilisateur', 
                'attr' => [
                'placeholder' => 'Votre nom ...',
                'class' => 'form-control']])
            
            // USERNAME
            ->add('username', null, [
                'label' => 'Prénom d\'utilisateur', 
                'attr' => [
                'placeholder' => 'Votre prénom ...', 
                'class' => 'form-control']])

            // EMAIL
            ->add('email', null, ['label' => 'Email', 
                'attr' => [
                'placeholder' => 'Email...', 
                'class' => 'form-control']])
            
            // PASSWORD
            ->add('password', PasswordType::class, ['label' => 'Mot de passe', 
                'attr' => [
                'placeholder' => 'Mot de passe ...', 
                'class' => 'form-control']])

            // CONFIRM PASSWORD
            ->add('confirm_password', PasswordType::class, [
                'label' => 'Confirmation',
                'attr' => [
                'placeholder' => 'Confirmez le mot de passe ...',
                'class' => 'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
