<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'attr' => [
                    'placeholder' => 'Nouvelle tache à réaliser',
                    'class' => 'm-2'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le titre ne peut pas etre vide',
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Description de cette tache',
                    'class' => 'm-2'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'La description ne peut pas etre vide'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}