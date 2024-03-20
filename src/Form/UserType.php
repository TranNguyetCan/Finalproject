<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('fullname', TextType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text', 
                'placeholder' => 'Birthday'

            ])
            ->add(
                'gender',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'Male' => 0,
                        'Female' => 1
                    ),
                    'multiple' => false,
                    'expanded' => true
                )
            )
            // ->add('gender')

            ->add('phone', NumberType::class)
            // ->add('phone', NumberType::class, [
            //     'constraints' => [
            //         new Callback([
            //             'callback' => function ($phone, ExecutionContextInterface $context) {
            //                 if (!preg_match('/^0\d{9}$/', $phone)) {
            //                     $context->buildViolation('Số điện thoại không hợp lệ, số điện thoại phải bắt đầu từ số 0 và có đúng 10 chữ số.')
            //                         ->addViolation();
            //                 }
            //             },
            //         ]),
            //     ],
            // ])
            ->add('address', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => "Register"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
