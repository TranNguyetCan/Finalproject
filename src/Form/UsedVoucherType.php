<?php

namespace App\Form;

use App\Entity\UsedVoucher;
use Doctrine\DBAL\Types\DateTimeImmutableType;
// use Doctrine\DBAL\Types\DateTimeType;
// use Doctrine\DBAL\Types\IntegerType;
// use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Validator\Constraints\DateTime;

class UsedVoucherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CusName', TextType::class )
            ->add('Voucher', TextType::class)
            ->add('Deal', IntegerType::class)
            ->add('UseAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable', 
                'html5'  => true, 
                'label' => 'Date of Use'
            ])
           ->add('save',SubmitType::class,[
            'label' => "Add"    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UsedVoucher::class,
        ]);
    }
}
