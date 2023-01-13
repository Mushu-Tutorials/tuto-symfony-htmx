<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'attr' => [
                    'placeholder' => 'Username',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Firstname',
                'attr' => [
                    'placeholder' => 'Firstname',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Lastname',
                'attr' => [
                    'placeholder' => 'Lastname',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Update',
                'attr' => [
                    'class' => 'ml-3 inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white',
                    'hx-post' => $options['action'],
                    'hx-target' => '#htmx-user-edit',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
