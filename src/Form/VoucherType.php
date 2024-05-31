<?php

namespace App\Form;

use App\Entity\Voucher;
use App\Entity\ProSize;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class VoucherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('deal', IntegerType::class)
            ->add('start_date', DatetimeType::class)
            ->add('end_date', DateTimeType::class)
            ->add('description', TextareaType::class)
            ->add('proSize', EntityType::class, [
                'class' => ProSize::class,
                'choice_label' => function (ProSize $proSize) {
                    return sprintf('%s (%s)', $proSize->getProduct()->getName(), $proSize->getSize()->getName());
                },
            ])
            ->add('save', SubmitType::class, [
                'label' => "Next"
            ]);
    }
}
