<?php

namespace App\Form;

use App\Entity\Discount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DiscountCode', TextType::class)
            ->add('DiscountPercentage', TextType::class)
            ->add('Start_date', DateTimeType::class)
            ->add('End_date', DateTimeType::class)
            ->add('save',SubmitType::class,[
                'label' => "Add"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Discount::class,
        ]);
    }
}
