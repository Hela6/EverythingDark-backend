<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => ['class' => 'd-flex flex-column mb-3'],
            ])
            ->add('intro', null, [
                'attr' => ['class' => 'd-flex flex-column mb-3'],
            ])
            ->add('content', null, [
                'attr' => ['class' => 'd-flex flex-column mb-3', 'style' => 'width: 300px'],
            ])
            ->add('image', UrlType::class, [ // Use the custom ImageUrlType
                'required' => true,
            ])
            ->add('user', null, [
                'attr' => ['class' => 'd-flex flex-column mb-3'],
            ])
            ->add('category', null, [
                'attr' => ['class' => 'd-flex flex-column mb-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
