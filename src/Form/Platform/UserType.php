<?php

namespace App\Form\Platform;

use App\Entity\Platform\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('namePrefix', TextType::class, [
                'label' => 'Name prefix',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'First name',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('middleName', TextType::class, [
                'label' => 'Middle name',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last name',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('nickName', TextType::class, [
                'label' => 'Nick name',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('birthName', TextType::class, [
                'label' => 'Birth name',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Birthdate',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('position', TextType::class, [
                'label' => 'Position',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
