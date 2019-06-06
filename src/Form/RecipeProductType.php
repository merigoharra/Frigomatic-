<?php

namespace App\Form;

use App\Entity\RecipeProduct;
use App\Utils\TypeConfigurator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecipeProductType extends TypeConfigurator
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
            'data_class' => RecipeProduct::class,
        ]);
    }
}
