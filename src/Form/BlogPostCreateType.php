<?php

namespace App\Form;

use App\Entity\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BlogPostCreateType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BlogPost::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('subtitle', TextType::class)
            ->add('content', TextType::class)
            ->add('headImage', FileType::class,[
                'label'=> 'Main image (required)',
                'mapped'=> false,
                'required'=>true,
                'constraints' => [
                    new File([
                        'maxSize' => '12m',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])]
            ])
            ->add('extraImages', FileType::class, [
                'multiple' => true,
                'required' => false,
                'mapped'=> false,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'bg-button text-button-text py-2 px-5 mt-2 rounded'],
            ]);

    }
}