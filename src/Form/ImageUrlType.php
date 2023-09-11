<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageUrlType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['placeholder' => 'Image URL'], // Placeholder text for the input field
        ]);
    }

    public function getParent()
    {
        return TextType::class; // Use a text input field
    }
}
