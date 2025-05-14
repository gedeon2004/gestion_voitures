<?php
// src/Form/ClientType.php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('telephone', TelType::class)
            ->add('cni', TextType::class)
            ->add('adresse', TextareaType::class)
            ->add('dateNaissance', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                // Choix 1: Utilisation du datepicker natif (HTML5)
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'max' => 'now'|date('Y-m-d') // Empêche les dates futures
                ],
                'required' => false
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo (image)',
                'required' => false,
                'mapped' => false,
                'attr' => ['accept' => 'image/*']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter le Client'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}