<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Recipe;
use App\Entity\Product;
use App\Entity\RecipeProduct;
use App\Utils\TypeConfigurator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class RecipeType extends TypeConfigurator
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Titre de la recette :", "Titre de votre nouvelle recette"))
            ->add('people', IntegerType::class, $this->getConfiguration('Nombre de personnes :', 'Indiquez pour combien de personnes la recette est prévue'))
            ->add('level', IntegerType::class, $this->getConfiguration("Difficulté :", "Indiquez le niveau de difficulté de la recette (de 1 à 5)")) 
            ->add('image', FileType::class, $this->getConfiguration("Image :", "Ajouter une image"))
            ->add('prep_duration', IntegerType::class, $this->getConfiguration("Temps de préparation :", "Indiquez le nombre de minute(s) pour préparer la recette"))
            ->add('baking_duration', IntegerType::class, $this->getConfiguration("Temps de cuisson :", "Indiquez le nombre de minute(s) de cuisson pour la recette"))
            // ->add('recipe_products', EntityType::class, [
            //     'label' => 'Ajouter les ingrédients :',
            //     'class' => Product::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true,
            // ])
            ->add('content', TextType::class, $this->getConfiguration("Détails de la recette :", "Listez les instructions de votre recette "))
            ->add('tag', EntityType::class, [
                'label' => 'Choisir un tag :',
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
