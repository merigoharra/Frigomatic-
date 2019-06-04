<?php

namespace App\Form;

use App\Entity\UserProduct;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Utils\TypeConfigurator;

class UserProductType extends TypeConfigurator
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class, $this->getConfiguration('Quantité a ajouter :', 'Ex : 8', true, ['attr' => [
                'value' => 1
                ]
            ]))
            ->add('product')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProduct::class,
        ]);
    }
}
