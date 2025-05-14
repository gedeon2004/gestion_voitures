<?php
// src/Form/SearchClientType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cni', TextType::class, [
                'label' => 'CNI',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par CNI...',
                    'class' => 'form-control'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par nom...',
                    'class' => 'form-control'
                ]
            ])
            ->add('dateMin', DateType::class, [
                'label' => 'Né après le',
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'class' => 'form-control',
                    'max' => date('Y-m-d') // Limite à aujourd'hui
                ]
            ])
            ->add('dateMax', DateType::class, [
                'label' => 'Né avant le',
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'class' => 'form-control',
                    'max' => date('Y-m-d') // Limite à aujourd'hui
                ]
            ])
            ->add('search', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'margin-top: 1.8rem;' // Alignement vertical
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Désactive la protection CSRF pour les formulaires de recherche
            'csrf_protection' => false,
        ]);
    }
}