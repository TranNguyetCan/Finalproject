<?php

namespace App\Form;

use App\Entity\OrderDetail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('deliveryLocal', TextType::class)
            ->add('total', NumberType::class)
            ->add('status', HiddenType::class, array(
                'data' => 0
            ))
            ->add('cusName', TextType::class)
            ->add('cusPhone', TextType::class);
            
    }
}
