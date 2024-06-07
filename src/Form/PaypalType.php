<?php

namespace App\Form;

use App\Entity\Paypal;
// use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaypalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('fullName', TextType::class, [
            'label' => 'Full name',
            'attr' => ['placeholder' => 'Full name']
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => ['placeholder' => 'example@PayPal.com']
        ])
        ->add('address', TextType::class, [
            'label' => 'Address',
            'attr' => ['placeholder' => 'Address']
        ])
        // ->add('password', RepeatedType::class, [
        //     'type' => PasswordType::class,
        //     'first_options' => [
        //         'label' => 'Password', 
        //         'attr' => ['placeholder' => 'password']
        //     ],

        //     'second_options' => ['label' => 'Confirm Password', 'attr' => ['p  laceholder' => 'confirm - password']],
        // ])
        ->add('password', PasswordType::class, [
            'label' => 'Password',
            'attr' => ['placeholder' => 'Password']
        ])

        ->add('confirm_password', PasswordType::class, [
            'label' => 'Confirm Password',
            'attr' => ['placeholder' => 'Confirm Password']
        ]);
        //Login PayPal
        // ->add('email', EmailType::class, [
        //     'label' => 'PayPal Email Address',
        //     'required' => false,
        //     'attr' => ['placeholder' => 'example@paypal.com']
        // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paypal::class,
        ]);
    }
}
