<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Recipe;
use App\Entity\Product;
use App\Utils\TypeConfigurator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecipeType extends AbstractType
{
    private $congigurator;

    public function __construct(TypeConfigurator $configurator){
        $this->configurator = $configurator;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->configurator->getConfiguration("Titre de la recette :", "Tapez ici le titre de votre nouvelle recette !"))
            ->add('people', IntegerType::class, $this->configurator->getConfiguration('Nombre de personnes :', 'Indiquer pour combien de personne(s) est cette recette'))
            ->add('level', IntegerType::class, $this->configurator->getConfiguration("Difficulté :", "Niveau de difficulté de votre recette ")) 
            ->add('image', UrlType::class, $this->configurator->getConfiguration("Image :", "Votre image de profil"))
            ->add('prep_duration', IntegerType::class, $this->configurator->getConfiguration("Temps de préparation :", "Nombre de minute(s)"))
            ->add('baking_duration', IntegerType::class, $this->configurator->getConfiguration("Temps de cuisson :", "Nombre de minute(s)"))
            ->add('product', EntityType::class, [
                'label' => 'Ajouter les ingrédients :',
                'class' => Product::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('content', TextType::class, $this->configurator->getConfiguration("Détail de la recette :", "Listez les instructions de votre recette "))
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
