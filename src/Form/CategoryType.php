<?php
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class)
        ->add('descriptions', TextType::class)
        ->add('save',SubmitType::class,[
            'label' => "Add"
        ]);
        // $builder
    //     ->add('paymentMethod', ChoiceType::class, [
    //         'label' => 'Payment Method',
    //         'choices' => [
    //             'PayPal' => 'paypal',
    //             'Cash' => 'cash',
    //             'Voucher' => 'voucher',
    //         ],
    //         'required' => true,
    //     ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}

?>